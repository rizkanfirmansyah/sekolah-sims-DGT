<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Kinerja_Lab_DL.xls";

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=".$namafile." ");

include("include/sambung.php");
include("include/functions.php");
//include("include/function_excel.php");

include 'class/class.select.print.php';

$select_print = new select_print;

#-------------FILTER
$fromdate	= $_REQUEST['fromdate'];
$todate		= $_REQUEST['todate'];
$lab		= $_REQUEST['lab'];

$judul = "Pegawai Dinas Luar";
$capfilter = "";
$cntcol = 6;

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
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
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
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. DL</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Pegawai</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jabatan</Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Untuk</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tanggal Berangkat</Data></Cell>';				
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tanggal Selesai</Data></Cell>';
	echo '</Row>';
	
	$c = 0;
	$sql=$select_print->dinasluarpeg_rpt($DLNo, $fromdate, $todate, $todate2, $nip, $subdit);
	while ($data = odbc_fetch_object($sql)) {
		
		$c++;
		
		$FrmDte = date("d-m-Y", strtotime($data->FrmDte));
		$ToDte = date("d-m-Y", strtotime($data->ToDte));
	
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$c."</Data></Cell>";	
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".$data->DLNo."</Data></Cell>";	
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".$data->NamaKaryawan."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".$data->Jabatan."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".$data->ForTo."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".$FrmDte."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".$ToDte."</Data></Cell>";
		echo "</Row>\n";
		
	}
	
		
			
echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

