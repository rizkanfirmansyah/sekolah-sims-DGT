<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Lap_penerimaan.xls";

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=".$namafile." ");

include("include/sambung.php");
include("include/functions.php");
//include("include/function_excel.php");

include 'class/class.select.print.php';

$select_print = new select_print;

#-------------FILTER
$departemen	= $_REQUEST['departemen'];
$daritgl	= $_REQUEST['daritgl'];
$ketgl		= $_REQUEST['ketgl'];
$idtingkat	= $_REQUEST['idtingkat'];
$idkelas	= $_REQUEST['idkelas'];
$nama		= $_REQUEST['nama'];
$all		= $_REQUEST['all'];

$drtgl = date("d-m-Y", strtotime($daritgl));
$smptgl = date("d-m-Y", strtotime($ketgl));

$string = "";

if($departemen != "") {
	if($string == "") { 
		$string = " Unit : " . $departemen ; 
	} else {
		$string = $string . " ,Unit : " . $departemen ;
	}
}
	
if($drtgl != "") {
	if($string == "") { 
		$string = " Dari Tanggal : " . $drtgl ; 
	} else {
		$string = $string . ", Dari Tanggal : " . $drtgl ;
	}
}

if($smptgl != "") {
	if($string == "") { 
		$string = " s/d Tanggal : " . $smptgl ; 
	} else {
		$string = $string . " s/d Tanggal : " . $smptgl ;
	}
}

if($nama != "") {
	if($string == "") { 
		$string = " Nama : " . $nama ; 
	} else {
		$string = $string . " ,Nama : " . $nama ;
	}
}

if($all == 1) { $string = "Semua";}

$judul = 'LAPORAN PENERIMAAN';

echo '
<?xml version="1.0" encoding="iso-8859-1"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 

 <Styles>
  <Style ss:ID="judul">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="filter">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="kanan">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="kepala">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CFF4D2" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="badan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>  
  
  <Style ss:ID="detailkanan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  
  <Style ss:ID="badancenter">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
  </Style>
  
 </Styles>
 <Worksheet ss:Name="Data">

  <Table>
   <Column ss:Index="1" ss:Width="100"/>
   <Column ss:Index="2" ss:Width="150"/>
   <Column ss:Index="3" ss:Width="250"/>
   <Column ss:Index="4" ss:Width="200"/>
   
   <Row>
    <Cell ss:StyleID="judul"><Data ss:Type="String">' . $judul . '</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>
   <Row>
    <Cell ss:StyleID="filter"><Data ss:Type="String">' . $string . '</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';


	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kelas</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Pembayaran</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jumlah Tagihan</Data></Cell>';
	
	$sqljenis = $select_print->list_jenis_bayar();
	while ($rpt_jenis_view=$sqljenis->fetch(PDO::FETCH_OBJ)) {
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">'.$rpt_jenis_view->nama.'</Data></Cell>';
	}
		
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Sisa Bayar</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Keterangan</Data></Cell>';
	echo '</Row>';
	
	$alat = 0;
	$amount = 0;
	$total = 0;
	$total_tagihan = 0;
	$total_sisa = 0;
		
	$sql=$select_print->list_rpt_penerimaan($daritgl, $ketgl, $idtingkat, $idkelas, $nama, $all, $departemen);
	$rowrpt=$sql->rowCount();
	while ($rpt_penerimaan_view=$sql->fetch(PDO::FETCH_OBJ)) {
		
		$kelas = $rpt_penerimaan_view->tingkat . '-' . $rpt_penerimaan_view->kelas;
		$besar = $rpt_penerimaan_view->besar;
		$jumlah = number_format($rpt_penerimaan_view->jumlah,0,".",",");
		$potongan = number_format($rpt_penerimaan_view->potongan,0,".",",");
		
		//$sisa = $rpt_penerimaan_view->besar - $rpt_penerimaan_view->jumlah;
		//$sisa = number_format($sisa,0,".",",");
		
		$total = numberreplace($total) +  numberreplace($rpt_penerimaan_view->jumlah) - numberreplace($rpt_penerimaan_view->potongan);
		//$total = number_format($total,0,".",",");
	
		$amount = $rpt_penerimaan_view->jumlah - $rpt_penerimaan_view->potongan;
		//$amount = number_format($amount,0,".",",");
		
		$sisa = $rpt_penerimaan_view->besar - $rpt_penerimaan_view->jumlah;
		//$sisa = number_format($sisa,0,".",",");
		
		$total_tagihan = $total_tagihan + $rpt_penerimaan_view->besar;
		$total_sisa = $total_sisa + ($rpt_penerimaan_view->besar - $rpt_penerimaan_view->jumlah);
					
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$rpt_penerimaan_view->nis."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$rpt_penerimaan_view->nama."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$kelas."</Data></Cell>";				
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$rpt_penerimaan_view->namapenerimaan."</Data></Cell>";
		echo "<Cell ss:StyleID=\"detailkanan\"><Data ss:Type=\"Number\">".$besar."</Data></Cell>";
		
		$sqljenis2 = $select_print->list_jenis_bayar();
		while ($rpt_jenis_view=$sqljenis2->fetch(PDO::FETCH_OBJ)) {
			
			$besar_bayar = $select_print->list_rpt_penerimaanjtt($rpt_penerimaan_view->replid, $rpt_jenis_view->replid);
			//$besar_bayar = number_format($besar_bayar,0,".",",");
	
			echo "<Cell ss:StyleID=\"detailkanan\"><Data ss:Type=\"Number\">".$besar_bayar."</Data></Cell>";
							
		}
						
		/*echo "<Cell ss:StyleID=\"detailkanan\"><Data ss:Type=\"Number\">".$jumlah."</Data></Cell>";*/
		/*echo "<Cell ss:StyleID=\"detailkanan\"><Data ss:Type=\"Number\">".$potongan."</Data></Cell>";*/
				
		echo "<Cell ss:StyleID=\"detailkanan\"><Data ss:Type=\"Number\">".$sisa."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$rpt_penerimaan_view->keterangan."</Data></Cell>";
		echo "</Row>\n";
		
	}
	
		echo '
		<Row>
		<Cell ss:MergeAcross="3" ss:StyleID="kanan"><Data ss:Type="String">' . 'TOTAL :' . '</Data></Cell>';			echo '<Cell ss:StyleID="kanan"><Data ss:Type="String">' . $total_tagihan . '</Data></Cell>';
		
		$sqljenis3 = $select_print->list_jenis_bayar();
		while ($rpt_jenis_view=$sqljenis3->fetch(PDO::FETCH_OBJ)) {
			
			if($rowrpt > 0) {
				$total_bayar = $select_print->list_rpt_penerimaanjtt_sum($rpt_jenis_view->replid, $daritgl, $ketgl, $idtingkat, $idkelas, $nama, $departemen, $all);
			}
			
			echo '<Cell ss:StyleID="kanan"><Data ss:Type="String">' . $total_bayar . '</Data></Cell>';
		}
		
		echo '<Cell ss:StyleID="kanan"><Data ss:Type="String">' . $total_sisa . '</Data></Cell>';
		echo '<Cell ss:StyleID="kanan"><Data ss:Type="String"></Data></Cell>
		</Row>';			
		
	
echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

