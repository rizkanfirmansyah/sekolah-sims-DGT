<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");
require_once('../app/finance/library/jurnal.php');

// koneksi ke mysql
@mysql_connect("localhost", "root", "");
@mysql_select_db("sekolahtunas");


##PROSES LUNAS
$i=0;
$sqlstr = "select a.replid, a.nis, b.nama, a.besar, a.lunas, d.departemen, e.nama nama_penerimaan from besarjtt a left join siswa b on a.nis=b.nis left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join datapenerimaan e on a.idpenerimaan=e.replid where ifnull(a.lunas,0)=0 and ifnull(a.besar,0)>0 and e.nama like '%Maret 2018' order by a.replid";
//$sqlstr = "select a.replid, a.nis, b.nama, a.besar, a.lunas, d.departemen from besarjtt a left join siswa b on a.nis=b.nis left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid order by a.replid";
$sql = mysql_query($sqlstr);
while($data = mysql_fetch_object($sql)) {
	
	$i++;
	
	##get tahun buku
	/*$departemen = $data->departemen;
	$sqltb = "select replid from tahunbuku where departemen='$departemen' order by tanggalmulai desc limit 1";
	$query = mysql_query($sqltb);
	$datatb = mysql_fetch_object($query);
	$idtahunbuku = $datatb->replid;*/

	
	$ref			=	notran(date('y-m-d'), 'frmrcp', '', '', '');
	$nis			=	$data->nis;
	$idbesarjtt		=	$data->replid;
	$idjurnal		=	0;
	$tanggal		=	date("Y-m-d");
	$jumlah			=	numberreplace($data->besar);
	$keterangan		=	"Lunas Sistem";
	$petugas		=	"sistem";
	$alasan			=	"";
	$idjenis_bayar	=	"1";
	$ts				=	date("Y-m-d H:i:s");
	$token			=	0;
	$issync			=	0;
	$nama_penerimaan=	$data->nama_penerimaan;
	
	
	//Ambil nama penerimaan
	/*$sqlstr = "SELECT nama, rekkas, rekpendapatan, rekpiutang FROM datapenerimaan WHERE replid = '$idpenerimaan'";
	$sql=$dbpdo->prepare($sqlstr);
	$sql->execute();

	$row = $sql->fetch(PDO::FETCH_OBJ); //FetchSingleRow($sql);			
	$namapenerimaan = $row->nama; //[0];
	$rekkas = $row->rekkas; //[1];
	$rekpendapatan = $row->rekpendapatan; //[2];
	$rekpiutang = $row->rekpiutang; //[3];
	
	
	##set jurnal
	$success = SimpanJurnal($idtahunbuku, $tcicilan, $ketjurnal, $nokas, "", $petugas, "penerimaanjtt", $idjurnal);
	
	//Simpan ke jurnaldetail
	if ($success) {
		$success = SimpanDetailJurnal($idjurnal, "D", $rekkas, $jcicilan);
	}
		
	if ($success) {
		$success = SimpanDetailJurnal($idjurnal, "K", $rekpiutang, $jcicilan);
	}*/
	
	if($nama_penerimaan != 'Kegiatan Sem 2 Thn 2017-2018') {
		
		$sqlins = "insert into penerimaanjtt (idbesarjtt, idjurnal, tanggal, jumlah, keterangan, petugas, alasan, idjenis_bayar, ts, token, issync, ref) values ('$idbesarjtt', '$idjurnal', '$tanggal', '$jumlah', '$keterangan', '$petugas', '$alasan', '$idjenis_bayar', '$ts', '$token', '$issync', '$ref')";
		$hasil = mysql_query($sqlins);
		
		$sqlstr3 = "SELECT last_insert_id() idpenerimaan";
		$success=mysql_query($sqlstr3);
		$datap = mysql_fetch_object($success);
		$idpenerimaan = $datap->idpenerimaan;
		
		$sqlstr2 = "update besarjtt set lunas=1 where nis='$nis'"; // and idpenerimaan='$idpenerimaan'";
		echo $sqlstr2;
		$sql2=mysql_query($sqlstr2);
		
		echo "No=" . $i . "##Ref=" . $ref . "##NIS=" . $data->nis . "#Nama=" . $data->nama . " ##Lunas=" . $data->lunas . "<br>";
		
		notran(date('y-m-d'), 'frmrcp', '1', '', '');
	}
	
	if ($hasil) {
		$sukses++;
	}  else {
		$gagal++;

	}
	  
}



// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang terupdate diimport : ".$gagal."</p>";
 
?>