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

$balai		= $_REQUEST['balai'];
$periodid	= $_REQUEST['periodid'];
$fromdate	= $_REQUEST['fromdate'];
$todate		= $_REQUEST['todate'];
$bulan		= $_REQUEST['bulan'];
$tahun		= $_REQUEST['tahun'];

?>

<head>
<title>Laporan PNBP</title>

</head>

<?php
	$balai		= $_REQUEST['balai'];
	$periodid	= $_REQUEST['periodid'];
	$fromdate	= $_REQUEST['fromdate'];
	$todate		= $_REQUEST['todate'];
	$bulan		= $_REQUEST['bulan'];
	$tahun		= $_REQUEST['tahun'];
	
	$drtgl = date("d-m-Y", strtotime($fromdate));
	$smptgl = date("d-m-Y", strtotime($todate));
	
	$balai2 = $balai;
	if($balai == "SEMUA") { $balai2 = "";}
	
?>

<?php if($periodid == "Harian") { ?>

	<table width="100%" border="0" cellspacing="0" style="font-weight: bold; font-family: sans-serif">
		<tr>
			<td colspan="18" align="center">LAPORAN PNBP HARIAN <?php echo $balai2 ?> </td>
		</tr>
		<tr>
			<td colspan="18" align="center">&nbsp;</td>
		</tr>
	</table>

	<table width="100%" border="1" cellspacing="0" style="font-family: sans-serif; font-size: 11px">

		<tr>
			<td colspan="7" align="left">Periode : <?php echo $drtgl . " s/d " . $smptgl ?></td>
		</tr>
		
		<tr style="font-weight: bold; background-color: #204b77; color: #fff">
			<td align="center" width="6%">TGL. ORDER</td>
			<td align="center" width="7%">NO. ORDER</td>		
			<td align="center" width="30%">NAMA PELANGGAN</td>		
			<td align="center" width="10%">JUMLAH ALAT</td>
			<td align="center" width="20%">KOTA</td>
			<td align="center" width="6%">TGL. BAYAR</td>
			<td align="center" width="6%">JUMLAH</td>		
		</tr>	
		
		<?php
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
			?>
					<tr style="color: #000">
						<td align="left"><?php echo $dte ?></td>
						<td align="left"><?php echo $data->slipno ?></td>				
						<td align="left"><?php echo $data->clientname ?></td>		
						<td align="center"><?php echo $data->jmlalat ?></td>
						<td align="left"><?php echo $data->kota ?></td>				
						<td align="left"><?php echo $tglbayar ?></td>
						<td align="right"><?php echo number_format($data->terbayar, 0, ",", ",") ?>&nbsp;</td>
					</tr>
					
		<?php
				}
		?>
				<tr style="font-weight: bold; background-color: #deecf3">
					<td colspan="3" align="right">SUB TOTAL ALAT :</td>
					<td align="center"><?php echo $subalat ?></td>
					
					<td colspan="2" align="right">SUB TOTAL :</td>
					<td align="right"><?php echo number_format($subtotal, 0, ",", ",") ?></td>
				</tr>
		<?php
			}
		?>
		
		<tr style="font-weight: bold; background-color: #deecf3">
			<td colspan="3" align="right">TOTAL ALAT :</td>
			<td align="center"><?php echo $alat ?></td>
			
			<td colspan="2" align="right">TOTAL :</td>
			<td align="right"><?php echo number_format($total, 0, ",", ",") ?></td>
		</tr>
	</table>
<?php } ?>

<?php if($periodid == "Bulanan") { ?>
	<table width="100%" border="0" cellspacing="0" style="font-weight: bold; font-family: sans-serif">
		<tr>
			<td colspan="3" align="center">LAPORAN PNBP PER BULAN <?php echo $balai2 ?></td>
		</tr>
		<tr>
			<td colspan="3" align="center">&nbsp;</td>
		</tr>
	</table>
	
	<table width="100%" border="1" cellspacing="0" style="font-family: sans-serif; font-size: 11px">

		<tr>
			<td colspan="3" align="left">Periode : <?php echo bulan_indonesia($bulan) . " " . $tahun ?></td>
		</tr>
		
		<tr style="font-weight: bold; background-color: #204b77; color: #fff">
			<td align="center" width="6%">TANGGAL</td>
			<td align="center" width="10%">JUMLAH ALAT</td>
			<td align="center" width="6%">JUMLAH</td>		
		</tr>	
		
		<?php
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
			?>
					<tr style="color: #000">
						<td align="left"><?php echo $dte ?></td>
						<td align="center"><?php echo $data->jmlalat ?></td>
						<td align="right"><?php echo number_format($data->terbayar, 0, ",", ",") ?>&nbsp;</td>
					</tr>
					
		<?php
				}
		?>
				<tr style="font-weight: bold; background-color: #deecf3">
					<td colspan="1" align="right">SUB TOTAL :</td>
					<td align="center"><?php echo $subalat ?></td>
					
					<td align="right"><?php echo number_format($subtotal, 0, ",", ",") ?></td>
				</tr>
		<?php
			}
		?>
		
		<tr style="font-weight: bold; background-color: #deecf3">
			<td colspan="1" align="right">TOTAL :</td>
			<td align="center"><?php echo $alat ?></td>
			
			<td align="right"><?php echo number_format($total, 0, ",", ",") ?></td>
		</tr>
	</table>
<?php } ?>

<?php if($periodid == "Tahunan") { ?>
	<table width="100%" border="0" cellspacing="0" style="font-weight: bold; font-family: sans-serif">
		<tr>
			<td colspan="3" align="center">LAPORAN PNBP PER TAHUN <?php echo $balai2 ?></td>
		</tr>
		<tr>
			<td colspan="3" align="center">&nbsp;</td>
		</tr>
	</table>
	
	<table width="100%" border="1" cellspacing="0" style="font-family: sans-serif; font-size: 11px">

		<tr>
			<td colspan="4" align="left">Periode : <?php echo $tahun ?></td>
		</tr>
		
		<tr style="font-weight: bold; background-color: #204b77; color: #fff">
			<td align="center" width="6%">TAHUN</td>
			<td align="center" width="6%">BULAN</td>
			<td align="center" width="10%">JUMLAH ALAT</td>
			<td align="center" width="6%">JUMLAH</td>		
		</tr>	
		
		<?php
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
			?>
					<tr style="color: #000">
						<td align="center"><?php echo $tahun ?></td>
						<td align="center"><?php echo bulan_indonesia($data->month) ?></td>						
						<td align="center"><?php echo $data->jmlalat ?></td>
						<td align="right"><?php echo number_format($data->terbayar, 0, ",", ",") ?>&nbsp;</td>
					</tr>
					
		<?php
				}
		?>
				<tr style="font-weight: bold; background-color: #deecf3">
					<td colspan="2" align="right">SUB TOTAL :</td>
					<td align="center"><?php echo $subalat ?></td>
					
					<td align="right"><?php echo number_format($subtotal, 0, ",", ",") ?></td>
				</tr>
		<?php
			}
		?>
		
		<tr style="font-weight: bold; background-color: #deecf3">
			<td colspan="2" align="right">TOTAL :</td>
			<td align="center"><?php echo $alat ?></td>
			
			<td align="right"><?php echo number_format($total, 0, ",", ",") ?></td>
		</tr>
	</table>
<?php } ?>