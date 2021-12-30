<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Lap_PNBP.xls";

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=".$namafile." ");

include("include/sambung.php");
include("include/functions.php");
//include("include/function_excel.php");

include 'class/class.select.print.php';

$select_print = new select_print;

#-------------FILTER
$balai		= $_REQUEST['balai'];
$periodid	= $_REQUEST['periodid'];
$fromdate	= $_REQUEST['fromdate'];
$todate		= $_REQUEST['todate'];
$bulan		= $_REQUEST['bulan'];
$tahun		= $_REQUEST['tahun'];

$balai2 = $balai;
if($balai == "SEMUA") { $balai2 = "";}

$drtgl = date("d-m-Y", strtotime($fromdate));
$smptgl = date("d-m-Y", strtotime($todate));
	
$judul = "";
$capfilter = "";
$cntcol = 0;

if($periodid == "Harian") { 
	$judul = "LAPORAN PNBP HARIAN " . $balai2; 
	$capfilter = "Periode : " . $drtgl . " s/d " . $smptgl;
	$cntcol = 6;
}

if($periodid == "Bulanan") { 
	$judul = "LAPORAN PNBP PER BULAN " . $balai2; 
	$capfilter = "Periode : " . bulan_indonesia($bulan) . " " . $tahun;
	$cntcol = 2;
}

if($periodid == "Tahunan") { 
	$judul = "LAPORAN PNBP PER TAHUN " . $balai2; 
	$capfilter = "Periode : " . $tahun;
	$cntcol = 3;
}

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
   <Column ss:Index="1" ss:Width="100"/>
   <Column ss:Index="2" ss:Width="150"/>
   <Column ss:Index="3" ss:Width="250"/>
   <Column ss:Index="4" ss:Width="200"/>
   
   <Row>
    <Cell ss:MergeAcross="'.$cntcol.'" ss:StyleID="judul"><Data ss:Type="String">' . $judul . '</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="'.$cntcol.'" ss:StyleID="filter"><Data ss:Type="String">' . $capfilter . '</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';

	if($periodid == "Harian") {
		echo '<Row>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">TGL. ORDER</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NO. ORDER</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NAMA PELANGGAN</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">KOTA</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">TGL. BAYAR</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH ALAT</Data></Cell>';				
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH</Data></Cell>';
		echo '</Row>';
		
		$alat = 0;
		$total = 0;
			
		$sqlcount=$select_print->pnbp_count_rpt($balai, $periodid, $fromdate, $todate);
		while ($datacnt = odbc_fetch_object($sqlcount)) {
				
			$dtecnt = date("Y-m-d", strtotime($datacnt->dte));
				
			$subalat = 0;
			$subtotal = 0;
				
			$sql=$select_print->pnbp_rpt($balai, $periodid, $dtecnt, '', $bulan, $tahun);	
			while ($data = odbc_fetch_object($sql)) {
				
				$dte = date("d-m-Y", strtotime($data->dte));
				$tglbayar = date("d-m-Y", strtotime($data->tglbayar));
				
				$subalat = $subalat + $data->jmlalat;
				$subtotal = $subtotal + $data->terbayar;
				
				$alat = $alat + $data->jmlalat;
				$total = $total + $data->terbayar;
						
				echo "<Row>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$dte."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->slipno."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->clientname."</Data></Cell>";				
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->kota."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$tglbayar."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badancenter\"><Data ss:Type=\"String\">".$data->jmlalat."</Data></Cell>";				
				echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->terbayar, 0, ",", ",")."</Data></Cell>";
				echo "</Row>\n";
				
			}
			
			echo '
			<Row>
			<Cell ss:MergeAcross="4" ss:StyleID="kanan"><Data ss:Type="String">' . 'SUB TOTAL :' . '</Data></Cell>			
			<Cell ss:StyleID="judul"><Data ss:Type="String">' . $subalat . '</Data></Cell>
			<Cell ss:StyleID="kanan"><Data ss:Type="String">' . number_format($subtotal, 0, ",", ",") . '</Data></Cell>
			</Row>';			
			
		}
		
		echo '
		<Row>
		<Cell ss:MergeAcross="4" ss:StyleID="kanan"><Data ss:Type="String">' . 'TOTAL :' . '</Data></Cell>			
		<Cell ss:StyleID="judul"><Data ss:Type="String">' . $alat . '</Data></Cell>
		<Cell ss:StyleID="kanan"><Data ss:Type="String">' . number_format($total, 0, ",", ",") . '</Data></Cell>
		</Row>';
	}


	if($periodid == "Bulanan") {
		echo '<Row>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">TANGGAL</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH ALAT</Data></Cell>';				
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH</Data></Cell>';
		echo '</Row>';
		
		$alat = 0;
		$total = 0;
			
		$sqlcount=$select_print->pnbp_countbulan_rpt($balai, $periodid, '', '', $bulan, $tahun);
		while ($datacnt = odbc_fetch_object($sqlcount)) {
		
			$dtecnt = date("Y-m-d", strtotime($datacnt->dte));
			
			$subalat = 0;
			$subtotal = 0;
				
			$sql=$select_print->pnbp_bulanan_rpt($balai, $periodid, $bulan, $tahun);	
			while ($data = odbc_fetch_object($sql)) {
				
				$dte = date("d-m-Y", strtotime($data->dte));
				$tglbayar = date("d-m-Y", strtotime($data->tglbayar));
				
				$subalat = $subalat + $data->jmlalat;
				$subtotal = $subtotal + $data->terbayar;
				
				$alat = $alat + $data->jmlalat;
				$total = $total + $data->terbayar;
						
				echo "<Row>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$dte."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badancenter\"><Data ss:Type=\"String\">".$data->jmlalat."</Data></Cell>";				
				echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->terbayar, 0, ",", ",")."</Data></Cell>";
				echo "</Row>\n";
				
			}
			
		}
		
		echo '
		<Row>
		<Cell ss:StyleID="kanan"><Data ss:Type="String">' . 'TOTAL :' . '</Data></Cell>			
		<Cell ss:StyleID="judul"><Data ss:Type="String">' . $alat . '</Data></Cell>
		<Cell ss:StyleID="kanan"><Data ss:Type="String">' . number_format($total, 0, ",", ",") . '</Data></Cell>
		</Row>';
	}
	
	
	if($periodid == "Tahunan") {
		echo '<Row>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">TAHUN</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">BULAN</Data></Cell>';
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH ALAT</Data></Cell>';				
		echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">JUMLAH</Data></Cell>';
		echo '</Row>';
		
		$alat = 0;
		$total = 0;
			
		$sqlcount=$select_print->pnbp_counttahun_rpt($balai, $periodid, '', '', $bulan, $tahun);
		while ($datacnt = odbc_fetch_object($sqlcount)) {
		
			$subalat = 0;
			$subtotal = 0;
				
			$sql=$select_print->pnbp_tahunan_rpt($balai, $periodid, $bulan, $tahun);	
			while ($data = odbc_fetch_object($sql)) {
				
				$subalat = $subalat + $data->jmlalat;
				$subtotal = $subtotal + $data->terbayar;
				
				$alat = $alat + $data->jmlalat;
				$total = $total + $data->terbayar;
						
				echo "<Row>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$tahun."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".bulan_indonesia($data->month)."</Data></Cell>";
				echo "<Cell ss:StyleID=\"badancenter\"><Data ss:Type=\"String\">".$data->jmlalat."</Data></Cell>";				
				echo "<Cell ss:StyleID=\"badankanan\"><Data ss:Type=\"String\">".number_format($data->terbayar, 0, ",", ",")."</Data></Cell>";
				echo "</Row>\n";
				
			}
			
						
		}
		
		echo '
		<Row>
		<Cell ss:MergeAcross="1" ss:StyleID="kanan"><Data ss:Type="String">' . 'TOTAL :' . '</Data></Cell>			
		<Cell ss:StyleID="judul"><Data ss:Type="String">' . $alat . '</Data></Cell>
		<Cell ss:StyleID="kanan"><Data ss:Type="String">' . number_format($total, 0, ",", ",") . '</Data></Cell>
		</Row>';
	}
	
	
echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

