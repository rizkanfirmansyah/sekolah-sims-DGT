<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Lap_pelanggan.xls";

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=".$namafile." ");

include("include/sambung.php");
include("include/functions.php");
//include("include/function_excel.php");

include 'class/class.select.print.php';

$select_print = new select_print;

#-------------FILTER
$tahun		= $_REQUEST['tahun'];
$tahun2		= $_REQUEST['tahun2'];
$jmltera	= $_REQUEST['jmltera'];
$tipe		= $_REQUEST['tipe'];

$judul = "LAPORAN JUMLAH PELANGGAN PER PERIODE (Tera Ulang)";
$capfilter = "";
$cntcol = 7;

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
	<Interior ss:Color="#FEFE01" ss:Pattern="Solid"/>
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
  
  <Style ss:ID="badankanan">
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
   <Column ss:Index="1" ss:Width="200"/>
   <Column ss:Index="2" ss:Width="200"/>
   <Column ss:Index="3" ss:Width="100"/>
   <Column ss:Index="4" ss:Width="100"/>
   
   <Row>
    <Cell ss:MergeAcross="'.$cntcol.'" ss:StyleID="judul"><Data ss:Type="String">' . $judul . '</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';
		
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NAMA PELANGGAN</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">ALAMAT</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">KOTA</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">TELEPON</Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">FAX</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">EMAIL</Data></Cell>';				
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NAMA KONTAK</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH TERA (KALI)</Data></Cell>';
	echo '</Row>';
	
	$sqlthn=$select_print->clnprd_tahun_rpt($tahun, $tahun2, $jmltera, $tipe);	
	while ($datathn = odbc_fetch_object($sqlthn)) {

		echo '	
		<Row>
	    <Cell ss:MergeAcross="'.$cntcol.'" ss:StyleID="filter"><Data ss:Type="String">PERIODE : ' . $datathn->periodid . '</Data></Cell>
	    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
	   </Row>';
   		
		$sql=$select_print->clnprd_rpt($datathn->periodid, '', $jmltera, $tipe);	
		while ($data = odbc_fetch_object($sql)) {
			
			echo "<Row>";
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->clientname."</Data></Cell>";	
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->alamat."</Data></Cell>";	
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->kota."</Data></Cell>";
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->telp."</Data></Cell>";
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->fax."</Data></Cell>";
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->email."</Data></Cell>";
			echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->cp."</Data></Cell>";
			echo "<Cell ss:StyleID=\"badancenter\"><Data ss:Type=\"String\">".$data->jumlah."</Data></Cell>";
			echo "</Row>\n";
			
		}
		
	}
		
echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

