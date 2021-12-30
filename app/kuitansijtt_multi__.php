<?php
session_start();
if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include('include/sambung.php');
//include_once ("include/queryfunctions.php");
//include_once ("include/functions.php");

//require_once('include/errorhandler.php');
//require_once('include/sessionchecker.php');
//require_once('include/common.php');
//require_once('include/rupiah.php');
//require_once('include/config.php');
require_once('finance/include/rupiah.php');
//require_once('include/sessioninfo.php');
//require_once('include/db_functions.php');
//require_once('include/getheader.php');

$dbpdo = DB::create();

$id 	= $_REQUEST["id"];
$ref 	= $_REQUEST["ref"];
$status = $_REQUEST["status"];

if(empty($ref)) {
	echo "Ma'af transaksi tidak ada";
	exit;
}

//OpenDb();
if ($status == "calon") 
{	
	$sqlstr = "SELECT p.replid AS id, p.idbesarjttcalon, b.besar, c.nopendaftaran, c.nama, j.nokas, 
				   j.transaksi, date_format(p.tanggal, '%d-%b-%Y') as tanggal, p.keterangan, p.jumlah, 
				   p.petugas, j.idtahunbuku 
			  FROM penerimaanjttcalon p, besarjttcalon b, jurnal j, calonsiswa c 
			 WHERE p.idbesarjttcalon = b.replid AND j.replid = p.idjurnal AND b.idcalon = c.replid AND p.replid = '$id'
		  ORDER BY p.tanggal, p.replid";
} 
else 
{
	$sqlstr = "SELECT p.replid AS id, p.idbesarjtt, b.besar, b.nis, s.nama, j.nokas, 
				   j.transaksi, date_format(p.tanggal, '%d-%b-%Y') as tanggal, p.keterangan, p.jumlah, 
				   p.petugas, j.idtahunbuku, k.kelas, t.tingkat 
			  FROM penerimaanjtt p, besarjtt b, jurnal j, siswa s, kelas k, tingkat t 
			 WHERE p.idbesarjtt = b.replid AND j.replid = p.idjurnal AND b.nis = s.nis and s.idkelas=k.replid and k.idtingkat=t.replid AND p.ref='$ref'
		  ORDER BY p.tanggal, p.replid";
	// p.replid = '$id' 
} 

$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$row=$sql->fetch(PDO::FETCH_OBJ);
//$result = QueryDb($sql);
//$row = mysql_fetch_row($result);

$nokas = $row->nokas; //[5];
$transaksi = $row->transaksi; //[6];
$tanggal = $row->tanggal; //[7];
$jumlah = $row->jumlah; //[9];
$petugas = $row->petugas; //[10];
$nis = $row->nis; //[3];
$nama = $row->nama; //[4];
$total = $row->besar; //[2];
$idbesarjtt = $row->idbesarjtt; //[1];
$idtahunbuku = $row->idtahunbuku; //[11];
$keterangan = $row->keterangan; //[8];
$kelas = $row->kelas; //[12];
$tingkat = $row->tingkat; //[13];

$sqlstr = "SELECT date_format(now(), '%d-%m-%Y') as tanggal";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$row=$sql->fetch(PDO::FETCH_OBJ);

//$result = QueryDb($sql);
//$row = mysql_fetch_row($result);
$tglcetak = $row->tanggal; //[0];

$sqlstr = "SELECT sum(jumlah) jumlah FROM penerimaanjtt$status WHERE idbesarjtt$status = '$idbesarjtt'";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$row=$sql->fetch(PDO::FETCH_OBJ);
//$result = QueryDb($sql);
//$row = mysql_fetch_row($result);
$jumlahbayar = $row->jumlah; //[0];

$sqlstr = "SELECT departemen FROM tahunbuku WHERE replid='$idtahunbuku'";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$row=$sql->fetch(PDO::FETCH_OBJ);
//$result = QueryDb($sql);
//$row = @mysql_fetch_array($result);
$departemen=$row->departemen;

$sqlid = "SELECT * FROM identitas WHERE departemen='$departemen'";
$sql=$dbpdo->prepare($sqlid);
$sql->execute();
$rowid=$sql->fetch(PDO::FETCH_OBJ);
//$resultid = QueryDb($sqlid); 
//$rowid = @mysql_fetch_object($resultid);
$namaid = $rowid->nama;
$alamat1id = $rowid->alamat1;
$te1p1id = "Telp. : " . $rowid->telp1;

	
$sql_multi = "SELECT p.replid AS id, p.idbesarjtt, b.besar, b.nis, s.nama, j.nokas, 
	   j.transaksi, date_format(p.tanggal, '%d-%b-%Y') as tanggal, p.keterangan, p.jumlah, 
	   p.petugas, j.idtahunbuku, dp.nama namadp 
  	FROM penerimaanjtt p, besarjtt b, jurnal j, siswa s, datapenerimaan dp 
 	WHERE p.idbesarjtt = b.replid AND j.replid = p.idjurnal AND b.nis = s.nis and b.idpenerimaan=dp.replid AND p.ref = '$ref' 
	ORDER BY p.tanggal, p.replid";

$total = 0;

$data=array();

$i 		= 1;		
$size	= 340;
$sizeadd = 20;
$results=$dbpdo->prepare($sql_multi);
$results->execute();
$jmldata = $results->rowCount();

//$results	=	mysql_query($sql_multi);
//$jmldata1 = mysql_num_rows($results);
while ($data2 = $results->fetch(PDO::FETCH_OBJ)) {	
	$nokas	=	$data2->namadp;	
	$jumlah	=	$data2->jumlah;
				
	$data[]=$i.';'.$nokas.';'.$jumlah;
	
	$total = $total + $data2->jumlah;
	
	$i++;	
	$size = $size + $sizeadd;
				
}


/*-------get data belum lunas----------*/
$sql_multi2 = "select b.nis, b.besar, SUM(p.jumlah) AS jumlah, (ifnull(b.besar,0) - SUM(ifnull(p.jumlah,0)) ) cicilan, c.nama, d.kelas, e.tingkat, f.nama namaterima, b.idpenerimaan, 0 id_pjtt, 0 nomor from datapenerimaan f left join besarjtt b on f.replid=b.idpenerimaan left join penerimaanjtt p on b.replid = p.idbesarjtt left join siswa c on b.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid where b.nis='$nis' AND b.info2 = '$idtahunbuku' and f.idkategori='JTT' GROUP BY b.nis, f.nama, b.idpenerimaan having (ifnull(b.besar,0) - sum(ifnull(b.potongan,0)) - SUM(ifnull(p.jumlah,0)) ) > 0 order by f.nourut ";
//echo $sql_multi2;
$res2=$dbpdo->prepare($sql_multi2);
$res2->execute();
$jmldata1 = $res2->rowCount();

//$res2 = QueryDb($sql_multi2);
//$jmldata = mysql_num_rows($res2);

$i = 1;
$total2 = 0;
while($row2 =$res2->fetch(PDO::FETCH_OBJ)) {
	
	$nama = $row2->nama; //[4];
	$tingkat = $row2->tingkat; //[6];
	$kelas = $row2->kelas; //[5];
	$namaterima = $row2->namaterima; //[7];
	$idpenerimaan2 = $row2->idpenerimaan; //[8];
	$id_pjtt = $row2->id_pjtt; //[9];
	$besar = $row2->besar; //[1];
	$jumlah = $row2->jumlah; //[2];
	$bcicilan = $row2->cicilan; //[3];

	$data2[]=$i.';'.$namaterima.';'.$bcicilan;
	
	$i++;	
	$size = $size + $sizeadd;

	$total2 = $total2 + $bcicilan;	
}	
/*--------------------------------------/\---*/


//-----start PDF
require('pdf/fpdf2.php');	  	
class PDF extends FPDF
{
	
	var $col=0;
	//Ordinate of column start
	var $y0;
	
	function Header()
	{
		//Page header
		global $namaid;
		global $alamat1id;
		global $te1p1id;
		global $title;
		global $nis;
		global $nama;
		global $kelas;
		
		$this->SetFont('Arial','',8);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		
		$this->Cell(50,2,$namaid,0,1,'L',false);
		$this->Ln(1);
		
		$this->Cell(20,2,$alamat1id,0,1,'L',true);
		$this->Ln(1);
		
		$this->Cell(20,2,$te1p1id,0,1,'L',true);
		$this->Ln(2);
		
		$this->SetLineWidth(0.2);
		$this->Line(85, 20, 10, 20);
		$this->Ln(2);
				
		$this->SetFont('Arial','',8);
		$w=$this->GetStringWidth($title)+6;
		$this->SetX((90-$w)/2);
		//$this->SetDrawColor(0,80,180);
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		//$this->SetLineWidth(1);
		
		
		$this->Cell($w,5,$title,0,1,'C',true);
		$this->Ln(2);
		
		//--set header
		$this->Cell(25,5,'Telah terima dari :',0,0,'L',false);
		$this->Ln(5);
		
		$this->Cell(12,2,'NIS',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$nis,0,1,'L',true);
		$this->Ln(2);
		
		$this->Cell(12,2,'Nama',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$nama,0,1,'L',true);
		$this->Ln(2);
		
		$this->Cell(12,2,'Kelas',0,0,'L',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(50,2,$kelas,0,1,'L',true);
		$this->Ln(2);
		
		//Save ordinate
		$this->y0=$this->GetY();
	}
	
	function Footer()
	{
		//Page footer
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->SetTextColor(128);
		//$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
		
	}

	var $B;
	var $I;
	var $U;
	var $HREF;
	
	
	function PDF($orientation='P',$unit='mm', $format='auto') 
	{
		//Call parent constructor
		//$size = 300;
		global $size;
		global $sizeadd;
		
		$this->FPDF($orientation,$unit,$format,$size); //$size = tinggi
		//Initialization
		$this->B=0;
		$this->I=0;
		$this->U=0;
		$this->HREF='';
		
	}

	//Load data
		
	function LoadData($file)
	{		
		//Read file lines
		//$lines=file($file);
		$lines=($file);
		$cekdata = $file[1];
		if( !empty($cekdata) )  {
			foreach($lines as $line) {
				$data[]=explode(';',$line);
			}
		} else {			
			$data[]=explode(';',$file[0]);
			
		}
			
		//foreach($lines as $data)
			//$data[]=explode(';',chop($line));
		return $data;
	}
	
	//Simple table
	//function Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
	//$i=0;
	function BasicTable($header,$data)
	{
		//Header
		$i=0;				
		foreach($header as $col) {
			if ($i==0) { $this->Cell(10,7,$col,1,0,"C"); }
			if ($i==1) { $this->Cell(40,7,$col,1,0,"C"); }
			if ($i==2) { $this->Cell(25,7,$col,1,0,"C"); }
			$i++;
		}
		$this->Ln();
		
		//Data		
		foreach($data as $row)
		{	
			$i=0;
			foreach($row as $col) {
				
				if ($i==0) { $this->Cell(10,6,$col,1,0,"L"); }
				if ($i==1) { $this->Cell(40,6,$col,1,0,"L"); }
				if ($i==2) { 
					$jumlah = number_format($col,"0",".",",");
					$this->Cell(25,6,$jumlah,1,0,"R"); 
				}
				$i++;
			}
			$this->Ln();
			
		}	
		
		//-----set sub group
		global $total;
		global $terbilang;
		global $tanggalcetak;
		global $getuser;
		
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',8);
		
		$this->Ln(2);
		$this->Cell(53,2,'Total',0,0,'R',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(20,2,$total,0,1,'R',true);
		$this->Ln(2);
		
		//$size = $size + $sizeadd;
		
		$this->Cell(5000,5,$terbilang,0,1,'L',true);
		$this->Ln(5);
		
		//$size = $size + $sizeadd;
		
		$this->Cell(46,2,'',0,0,'R',false);
		$this->Cell(100,2,$tanggalcetak,0,1,'L',true);		
		$this->Ln(2);
		
		//$size = $size + $sizeadd;
		
		$this->Cell(46,2,'Kasir',0,1,'C',false);		
		$this->Ln(8);
		
		//$size = $size + $sizeadd;
		
		$this->Cell(46,2,$getuser,0,1,'C',false);		
		$this->Ln(2);
		
				
	}
	
	
	/**
	* Biaya-biaya yang belum di bayar
	*/
	
	function BasicTable2($header2,$data2)
	{
		//Header
		global $jmldata1;
		
		//--biaya yang belum lunas
		$this->Cell(4,2,'',0,0,'R',false);
		$this->Cell(30,2,'Biaya-biaya yang belum lunas',0,1,'C',false);		
		$this->Ln(2);
		
		$i=0;				
		foreach($header2 as $col) {
			if ($i==0) { $this->Cell(10,7,$col,1,0,"C"); }
			if ($i==1) { $this->Cell(40,7,$col,1,0,"C"); }
			if ($i==2) { $this->Cell(25,7,$col,1,0,"C"); }
			$i++;
		}
		$this->Ln();
		
		//Data		
		foreach($data2 as $row)
		{	
			$i=0;
			foreach($row as $col) {
				
				if ($i==0) { $this->Cell(10,6,$col,1,0,"L"); }
				if ($i==1) { $this->Cell(40,6,$col,1,0,"L"); }
				if ($i==2) { 
					$jumlah = number_format($col,"0",".",",");
					$this->Cell(25,6,$jumlah,1,0,"R"); 
				}
				$i++;
			}
			$this->Ln();
			
		}	
		
		//-----set sub group
		global $total2;
		
		$this->SetFillColor(255,255,255);
		$this->SetTextColor(0,0,0);
		$this->SetFont('Arial','',8);
		
		$this->Ln(2);
		$this->Cell(53,2,'Total',0,0,'R',true);
		$this->Cell(2,2,':',0,0,'L',false);
		$this->Cell(20,2,$total2,0,1,'R',true);
		$this->Ln(2);
		
		//---------------------/\			
	}
		
}
				
$pdf=new PDF();

$title='BUKTI PEMBAYARAN UANG SEKOLAH';
$pdf->SetTitle($title);	
$pdf->SetTitle($nis);	
$pdf->SetTitle($nama);

$terbilang = "(" . KalimatUang($total) . ")";
$pdf->SetTitle($terbilang);

$kelas = $tingkat . "/" . $kelas;
$pdf->SetTitle($kelas);
$total = number_format($total,"0",".",",");
$total2 = number_format($total2,"0",".",",");
$pdf->SetTitle($total);
$pdf->SetTitle($size);

$G_LOKASI = "Bandung";
$uid = $_SESSION["loginname"];
$tanggalcetak = $G_LOKASI . ", " . $tglcetak;
$getuser = "(". $uid . ")";

$header=array('No.','Pembayaran','Besarnya');
$header2=array('No.','Jenis Biaya','Besarnya');
//Data loading
//$data=$pdf->LoadData('poa.txt');

$data=$pdf->LoadData($data);
$data2=$pdf->LoadData($data2);
$pdf->SetFont('Arial','',8);
$pdf->AddPage();

if($jmldata > 0) {
	$pdf->BasicTable($header,$data);
}

if($jmldata1 > 0) {
	$pdf->BasicTable2($header2,$data2);
}

/*$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
$pdf->AddPage();
$pdf->FancyTable($header,$data);*/
$pdf->Output();
?>
