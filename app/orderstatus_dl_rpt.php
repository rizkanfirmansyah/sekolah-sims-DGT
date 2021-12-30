<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include("../app/include/sambung.php");
include("../app/include/functions.php");

include 'class/class.select.print.php';

$select_print = new select_print;

$slipno		= $_REQUEST['slipno'];
$fromdate	= $_REQUEST['fromdate'];
$todate		= $_REQUEST['todate'];
$periodid	= $_REQUEST['periodid'];
$tpe		= $_REQUEST['tpe'];
$labid		= $_REQUEST['labid'];
$sts		= $_REQUEST['sts'];
$clientid	= $_REQUEST['clientid'];

?>

<head>
<title>Laporan Order Status DL</title>

</head>

<table width="100%" border="0" cellspacing="0" style="font-weight: bold; font-family: sans-serif">
	<tr>
		<td colspan="18" align="center">LAPORAN ORDER STATUS DINAS LUAR</td>
	</tr>
	<tr>
		<td colspan="18" align="center">&nbsp;</td>
	</tr>
</table>

<table width="100%" border="1" cellspacing="0" style="font-family: sans-serif; font-size: 11px">
	<tr style="font-weight: bold; background-color: #204b77; color: #fff">
		<td align="center">No Order</td>
		<td align="center">No DL</td>
		<td align="center">Tgl Order</td>
		<td align="center">Customer</td>
		<td align="center">Alamat</td>
		<td align="center">Contact Person</td>
		<td align="center">Provinsi</td>
		<td align="center">Nama Alat</td>
		<td align="center">Kategori</td>
		<td align="center">No. Sertifikat</td>
		<td align="center">No. Kertas</td>
		<td align="center">Tgl. Konsep</td>
		<td align="center">Tgl. Sertifikat</td>
		<td align="center">Tgl. TU</td>		
		<td align="center">Status</td>		
		<td align="center">Petugas</td>
		<td align="center">No Sertifikat-2</td>		
	</tr>	
	
	<?php
		$slipno		= $_REQUEST['slipno'];
		$fromdate	= $_REQUEST['fromdate'];
		$todate		= $_REQUEST['todate'];
		$periodid	= $_REQUEST['periodid'];
		$tpe		= $_REQUEST['tpe'];
		$labid		= $_REQUEST['labid'];
		$sts		= $_REQUEST['sts'];
		$clientid	= $_REQUEST['clientid'];

		$sql=$select_print->orderstatus_dl_rpt($slipno, $fromdate, $todate, $periodid, $tpe, $labid, $sts, $clientid);
		
		while ($data = odbc_fetch_object($sql)) {
			
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
			
	?>
			<tr style="color: #000">
				<td align="left"><?php echo $data->OutBldCde ?></td>
				<td align="left"><?php echo $data->DLNo ?></td>
				<td align="left"><?php echo $order_date ?></td>	
				<td align="left"><?php echo $data->ClientName ?></td>
				<td align="left"><?php echo $data->alamat ?></td>
				<td align="left"><?php echo $data->cp ?></td>
				<td align="left"><?php echo $data->ProNme ?></td>				
				<td align="left"><?php echo $data->ItmDcr ?></td>
				<td align="left"><?php echo $data->Ktg ?></td>
				<td align="left"><?php echo $data->nosertifikat ?></td>
				<td align="left"><?php echo $data->nokertas ?></td>
				<td align="left"><?php echo $tglkonsep ?></td>
				<td align="left"><?php echo $tglsertifikat ?></td>
				<td align="left"><?php echo $tgltu ?></td>
				<td align="left"><?php echo 'Status' ?></td>
				<td align="left"><?php echo $data->NamaKaryawan ?></td>
				<td align="left"><?php echo $data->serti ?></td>
			</tr>
			
	<?php
		}
	?>
</table>