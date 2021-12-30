<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Kinerja_Lab.xls";

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

$judul = "Kinerja Laboratorium";
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
	echo '<Cell ss:Merge="1" ss:StyleID="kepala"><Data ss:Type="String">NAMA LAB.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">ORDER</Data></Cell>';
	echo '<Cell ss:MergeAcross="1" ss:StyleID="kepala"><Data ss:Type="String">PROSES</Data></Cell>';
	echo '<Cell ss:MergeAcross="1" ss:StyleID="kepala"><Data ss:Type="String">BATAL</Data></Cell>';	
	echo '<Cell ss:MergeAcross="1" ss:StyleID="kepala"><Data ss:Type="String">CATATAN LAB.</Data></Cell>';
	echo '<Cell ss:MergeAcross="1" ss:StyleID="kepala"><Data ss:Type="String">FINISH</Data></Cell>';				
	echo '<Cell ss:MergeAcross="1" ss:StyleID="kepala"><Data ss:Type="String">TERTUNDA</Data></Cell>';
	echo '</Row>';
	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String"></Data></Cell>';
	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">%</Data></Cell>';	
	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">%</Data></Cell>';	
	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">%</Data></Cell>';	
	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">%</Data></Cell>';	
	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">%</Data></Cell>';	
	echo '</Row>';
	
	$Total = 0;
	$proses = 0;
	$totalbatal = 0;
	$totalcatlab = 0;
	$totalfinish = 0;
	$totaltunda = 0;
	
	$totalprosespersen = 0;
	$totalbatalpersen = 0;
	$totalcatlabpersen = 0;
	$totalfinishpersen = 0;
	$totaltundapersen = 0;
	
	$sqlexec=$select_print->kinerjalab_exec_rpt($fromdate, $todate, $lab);
	
	$sql=$select_print->kinerjalab_rpt($fromdate, $todate, $lab);	
	while ($data = odbc_fetch_object($sql)) {
	
		$Total = $Total + $data->Total;
		$proses = $proses + $data->proses;
		$totalbatal = $totalbatal + $data->totalbatal;
		$totalcatlab = $totalcatlab + $data->totalcatlab;
		$totalfinish = $totalfinish + $data->totalfinish;
		$totaltunda = $totaltunda + $data->totaltunda;
						
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->NamaLab."</Data></Cell>";	
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->Total,2,".",",")."</Data></Cell>";	
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->proses,2,".",",")."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->totalprosespersen,2,".",",")."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->totalbatal,2,".",",")."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->totalbatalpersen,2,".",",")."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->totalcatlab,2,".",",")."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->totalcatlabpersen,2,".",",")."</Data></Cell>";
		
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->totalfinish,2,".",",")."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->totalfinishpersen,2,".",",")."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->totaltunda,2,".",",")."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->totaltundapersen,2,".",",")."</Data></Cell>";
		echo "</Row>\n";
		
	}
	
	$totalprosespersen = ($proses/$Total) * 100;
	$totalbatalpersen = ($totalbatal/$Total) * 100;
	$totalcatlabpersen = ($totalcatlab/$Total) * 100;
	$totalfinishpersen = ($totalfinish/$Total) * 100;
	$totaltundapersen = ($totaltunda/$Total) * 100;
	
			
	echo "<Row>";
	echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">TOTAL</Data></Cell>";	
	echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($Total,2,".",",")."</Data></Cell>";	
	echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($proses,2,".",",")."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($totalprosespersen,2,".",",")."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($totalbatal,2,".",",")."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($totalbatalpersen,2,".",",")."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($totalcatlab,2,".",",")."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($totalcatlabpersen,2,".",",")."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($totalfinish,2,".",",")."</Data></Cell>";
	
	echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($totalfinishpersen,2,".",",")."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($totaltunda,2,".",",")."</Data></Cell>";
	echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($totaltundapersen,2,".",",")."</Data></Cell>";
	echo "</Row>\n";
		
			
echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

