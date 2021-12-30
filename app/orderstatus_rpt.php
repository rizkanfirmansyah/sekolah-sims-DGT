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
<title>Laporan Order Status</title>

</head>

<table width="100%" border="0" cellspacing="0" style="font-weight: bold; font-family: sans-serif">
	<tr>
		<td colspan="18" align="center">LAPORAN ORDER STATUS</td>
	</tr>
	<tr>
		<td colspan="18" align="center">&nbsp;</td>
	</tr>
</table>

<table width="100%" border="1" cellspacing="0" style="font-family: sans-serif; font-size: 11px">
	<tr style="font-weight: bold; background-color: #204b77; color: #fff">
		<td align="center" width="7%">No. Order</td>
		<td align="center" width="6%">Tgl. Order</td>
		<td align="center" width="30%">Customer</td>
		<td align="center" width="30%">Alamat</td>
		<td align="center" width="30%">Contact Person</td>		
		<td align="center" width="20%">Nama Alat</td>
		<td align="center" width="20%">Objek Kalibrasi</td>
		<td align="center" width="6%">Tgl. Selesai</td>
		<td align="center" width="6%">Tgl. Kalibrasi</td>
		<td align="center" width="6%">Tgl. Konsep</td>
		<td align="center" width="6%">Tgl. Sertifikat</td>
		<td align="center" width="6%">Tgl. TU</td>
		<td align="center" width="6%">Kategori</td>
		<td align="center" width="6%">No. Sertifikat</td>
		<td align="center" width="6%">No. Kertas</td>
		<td align="center" width="5%">Catatan Lab</td>
		<td align="center" width="5%">Batal</td>
		<td align="center" width="15%">Catatan Batal</td>
		<td align="center" width="15%">Provinsi</td>
		<td align="center" width="20%">NIP Penera-1</td>
		<td align="center" width="20%">Penera-1</td>
		<td align="center" width="20%">NIP Penera-2</td>
		<td align="center" width="20%">Penera-2</td>
		<td align="center" width="20%">NIP Penera-3</td>
		<td align="center" width="20%">Penera-3</td>
		<td align="center" width="20%">No. Serti</td>
		<td align="center" width="20%">Penyerah</td>
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
		
		$sql=$select_print->orderstatus_rpt($slipno, $fromdate, $todate, $periodid, $tpe, $labid, $sts, $clientid);
		
		while ($data = odbc_fetch_object($sql)) {
			
			$order_date = date("d-m-Y", strtotime($data->order_date));
			$tglselesai = date("d-m-Y", strtotime($data->tglselesai));
			$tglfinish = date("d-m-Y", strtotime($data->tglfinish));
			$tglkonsep = date("d-m-Y", strtotime($data->tglkonsep));
			$tglsertifikat = date("d-m-Y", strtotime($data->tglsertifikat));
			$tgltu = date("d-m-Y", strtotime($data->tgltu)); 
			
			if($tglselesai=='01-01-1970') { $tglselesai = ""; }
			if($tglfinish=='01-01-1970') { $tglfinish = ""; }
			if($tglkonsep=='01-01-1970') { $tglkonsep = ""; }
			if($tglsertifikat=='01-01-1970') { $tglsertifikat = ""; }
			if($tgltu=='01-01-1970') { $tgltu = ""; }
			
			$catatan_lab = "";
			if($data->tglcatatanlab == "1900-01-01 00:00:00.000") {
				$catatan_lab = "Pernah ada catatan Lab";
			}
	?>
			<tr style="color: #000">
				<td align="left"><?php echo $data->slipno ?></td>
				<td align="left"><?php echo $order_date ?></td>
				<td align="left"><?php echo $data->clientname ?></td>
				<td align="left"><?php echo $data->alamat ?></td>
				<td align="left"><?php echo $data->cp ?></td>		
				<td align="left"><?php echo $data->namabarang ?></td>
				<td align="left"><?php echo $data->objek_kalibrasi ?></td>
				<td align="left"><?php echo $tglselesai ?></td>
				<td align="left"><?php echo $tglfinish ?></td>
				<td align="left"><?php echo $tglkonsep ?></td>
				<td align="left"><?php echo $tglsertifikat ?></td>
				<td align="left"><?php echo $tgltu ?></td>
				<td align="left"><?php echo $data->kategori ?></td>
				<td align="left"><?php echo $data->nosertifikat ?></td>
				<td align="left"><?php echo $data->nokertas ?></td>
				
				<td align="left"><?php echo $catatan_lab ?></td>
				<td align="left"><?php echo $data->batal2 ?></td>
				<td align="left"><?php echo $data->catatan_batal ?></td>
				<td align="left"><?php echo $data->ProNme ?></td>
				<td align="left"><?php echo $data->finish1nip ?></td>
				<td align="left"><?php echo $data->Penera1 ?></td>
				<td align="left"><?php echo $data->finish2nip ?></td>
				<td align="left"><?php echo $data->Penera2 ?></td>
				<td align="left"><?php echo $data->finish3nip ?></td>
				<td align="left"><?php echo $data->Penera3 ?></td>
				<td align="left"><?php echo $data->serti ?></td>
				<td align="left"><?php echo $data->Penyerah ?></td>
			</tr>
			
	<?php
		}
	?>
</table>