<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Order_Status_DL.xls";

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=".$namafile." ");

include("include/sambung.php");
include("include/functions.php");
include("include/function_excel.php");

include 'class/class.select.print.php';

$select_print = new select_print;

#-------------FILTER
$ref = $_REQUEST['slipno'];
$fromdate	= $_REQUEST['fromdate'];
$todate		= $_REQUEST['todate'];
$periodid	= $_REQUEST['periodid'];
$tpe		= $_REQUEST['tpe'];
$labid		= $_REQUEST['labid'];
$sts		= $_REQUEST['sts'];
$clientid	= $_REQUEST['clientid'];

$where = "";

if ($ref == "" && $fromdate == "" && $todate == "" && ($tpe == "All Type" || $tpe == "") && $labid == "" && ($sts == "All" || $sts == "") && $clientid == "") {	

	$where = "";
}

if ($periodid != "") {
	if ($where == "") {
		$where = "Periode : $periodid";
	} else {
		$where = $where . " ; Periode : $periodid";
	}
}
		
if ($ref != "") {
	if ($where == "") {
		$where = "No. Order : $ref";
	} else {
		$where = $where . " ; No. Order : $ref";
	}
}

if ($fromdate != "" && $todate == "") {
	$fromdate		= date("d-m-Y", strtotime($fromdate) );
	
	if ($where == "") {
		$where = "Tgl. Order : $fromdate";
	} else {
		$where = $where . " ; Tgl. Order : $fromdate";
	}
}

	
if ($fromdate != "" && $todate != "" && $fromdate != "1970-01-01" && $todate != "1970-01-01") {
	$todate			= date("d-m-Y", strtotime($todate) );
	$fromdate		= date("d-m-Y", strtotime($fromdate) );
	
	if ($where == "") {
		$where = "Dari Tgl. Order : $fromdate s/d $todate";
	} else {
		$where = $where . " ; Dari Tgl. Order : $fromdate s/d $todate";
	}
}


if ($tpe != "" ) {
	if ($tpe == "tulang") { $tpe = "Tera Ulang"; }
	if ($tpe == "julang") { $tpe = "Uji Ulang"; }
	
	if ($where == "") {
		$where = "Tipe : $tpe";
	} else {
		$where = $where . "; Tipe : $tpe";
	}
	
}

if ($labid != "") {
	$sql="Select idlab, namalab From lab Where idlab='$labid' ";
	$results = odbc_exec(condb,$sql);
	$row = odbc_fetch_object($results);
	if ($where == "") {
		$where = "Lab. : $row->namalab";
	} else {
		$where = $where . " ; Lab. : $row->namalab";
	}
}

	  
if ($sts != "") {
	if ($sts == "PROSES") {
		if ($where == "") {
			$where = "Status : PROSES";
		} else {
			$where = $where . "; Status : PROSES";
		}
	}
	
	if ($sts == "FINISH") {
		if ($where == "") {
			$where = "Status : FINISH";
		} else {
			$where = $where . "; Status : FINISH";
		}
	}
	
	if ($sts == "BATAL") {
		if ($where == "") {
			$where = "Status : BATAL";
		} else {
			$where = $where . "; Status : BATAL";
		}
	}
	
	if ($sts == "Cat.") {
		if ($where == "") {
			$where = "Status : Catatan Lab.";
		} else {
			$where = $where . "; Status : Catatan Lab.";
		}
	}
	
	if ($sts == "Lewat") {
		if ($where == "") {
			$where = "Status : Lewat Tanggal Selesai";
		} else {
			$where = $where . "; Status : Lewat Tanggal Selesai";
		}
	}
	
	if ($sts == "Catatan") {
		if ($where == "") {
			$where = "Status : Catatan Lab. lewat 30 hari";
		} else {
			$where = $where . "; Status : Catatan Lab. lewat 30 hari";
		}
	}
	
}

if ($clientid != "") {
	if ($where == "") {
		$where = "Customer : $clientid";
	} else {
		$where = $where . "; Customer : $clientid";
	}
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
 </Styles>
 <Worksheet ss:Name="DataDL">

  <Table>
   <Column ss:Index="1" ss:Width="100"/>
   <Column ss:Index="2" ss:Width="150"/>
   <Column ss:Index="3" ss:Width="250"/>
   <Column ss:Index="4" ss:Width="200"/>
   
   <Row>
    <Cell ss:MergeAcross="16" ss:StyleID="judul"><Data ss:Type="String">LAPORAN ORDER STATUS DINAS LUAR</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="14" ss:StyleID="filter"><Data ss:Type="String">' . $where . '</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';
	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Order</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. DL</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tgl. Order</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Customer</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Alamat</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Contact Person</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Provinsi</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Alat</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kategori</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Sertifikat</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Kertas</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tgl. Konsep</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tgl. Sertifikat</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tgl. TU</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Status</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Petugas</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Sertifikat2</Data></Cell>';	
	echo '</Row>';
	
	$sql=$select_print->orderstatus_dl_rpt($slipno, $fromdate, $todate, $periodid, $tpe, $labid, $sts, $clientid);
	
	while($data=odbc_fetch_object($sql)) {
		
		$order_date = date("d-m-Y", strtotime($data->Dte));
		$tglselesai = date("d-m-Y", strtotime($data->Tglselesai));
		$tgl_catatan_lab = date("d-m-Y", strtotime($data->tgl_catatan_lab));
		$tglfinish = date("d-m-Y", strtotime($data->tglfinish));
		$tglkonsep = date("d-m-Y", strtotime($data->tglkonsep));
		$tglsertifikat = date("d-m-Y", strtotime($data->tglsertifikat));
		$tgltu = date("d-m-Y", strtotime($data->tgltu)); 
		
		if($tglselesai=='01-01-1970') { $tglselesai = ""; }
		if($tglfinish=='01-01-1970') { $tglfinish = ""; }
		if($tglkonsep=='01-01-1970') { $tglkonsep = ""; }
		if($tglsertifikat=='01-01-1970') { $tglsertifikat = ""; }
		if($tgltu=='01-01-1970') { $tgltu = ""; }
		
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->OutBldCde."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->DLNo."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$order_date."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->ClientName."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->alamat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->cp."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->ProNme."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->ItmDcr."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->Ktg."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nosertifikat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nokertas."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$tglkonsep."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$tglsertifikat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$tgltu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".'Status'."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->NamaKaryawan."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->serti."</Data></Cell>";
		echo "</Row>\n";
		
	}

echo '
  </Table>

 </Worksheet>
</Workbook>';
?>

