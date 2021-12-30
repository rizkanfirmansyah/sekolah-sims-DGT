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

?>

<head>
<title>Laporan Penerimaan</title>

</head>

<?php
	
	$departemen	= $_REQUEST['departemen'];	
	$daritgl	= $_REQUEST['daritgl'];
	$ketgl		= $_REQUEST['ketgl'];
	$idtingkat	= $_REQUEST['idtingkat'];
	$idkelas	= $_REQUEST['idkelas'];
	$nama		= $_REQUEST['nama'];
	$all		= $_REQUEST['all'];

	
	if ($all == 1 && $all == true) {
		$all = "checked";
	} else {
		$all = "";
	}

	if($daritgl == "") { $daritgl = date("d-m-Y"); }
	if($ketgl == "") { $ketgl	 = date("d-m-Y"); }
	
	$string = "";
	
	if($departemen != "") {
		if($string == "") { 
			$string = " Unit : " . $departemen ; 
		} else {
			$string = $string . " ,Unit : " . $departemen ;
		}
	}
		
	if($daritgl != "") {
		if($string == "") { 
			$string = " Dari Tanggal : " . $daritgl ; 
		} else {
			$string = $string . ", Dari Tanggal : " . $daritgl ;
		}
	}
	
	if($ketgl != "") {
		if($string == "") { 
			$string = " s/d Tanggal : " . $ketgl ; 
		} else {
			$string = $string . " s/d Tanggal : " . $ketgl ;
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
	
	
?>


<table width="100%" border="0" cellspacing="0">
	<tr>
		<td colspan="18" align="center" style="font-weight: bold; font-family: sans-serif">LAPORAN PENERIMAAN<?php echo $balai2 ?></td>
	</tr>
	<tr>
		<td colspan="18" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="8" align="left" style="font-family: sans-serif; font-size: 11px;"><?php echo $string ?></td>
	</tr>
</table>

<table width="100%" border="1" cellspacing="0" style="font-family: sans-serif; font-size: 11px; border: 1px solid #ccc">

	<tr style="font-weight: bold; background-color: #deecf3">
		<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
		<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
		<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
		<th style="font-weight:bold ">Pembayaran &nbsp;&nbsp;</th>
		<th style="font-weight:bold ">Jumlah Tagihan &nbsp;&nbsp;</th>
		
		<?php
			$sqljenis = $select_print->list_jenis_bayar();
			while ($rpt_jenis_view=$sqljenis->fetch(PDO::FETCH_OBJ)) {
		?>
				<th style="font-weight:bold "><?php echo $rpt_jenis_view->nama ?></th>
		<?php
			}
		?>
		
		<!--<th style="font-weight:bold ">Jumlah Bayar &nbsp;&nbsp;</th>-->
		<!--<th style="font-weight:bold ">Potongan/Beasiswa &nbsp;&nbsp;</th>-->
		<th style="font-weight:bold ">Sisa Bayar&nbsp;&nbsp;</th>
		<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>	
	</tr>	
	
	<?php
		$amount = 0;
		$total = 0;
		$total_tagihan = 0;
		$total_sisa = 0;
			
		$sql=$select_print->list_rpt_penerimaan($daritgl, $ketgl, $idtingkat, $idkelas, $nama, $all, $departemen);
		$rowrpt=$sql->rowCount();
		while ($rpt_penerimaan_view=$sql->fetch(PDO::FETCH_OBJ)) {
			
			$kelas = $rpt_penerimaan_view->tingkat . '-' . $rpt_penerimaan_view->kelas;
			$besar = number_format($rpt_penerimaan_view->besar,0,".",",");
			$jumlah = number_format($rpt_penerimaan_view->jumlah,0,".",",");
			$potongan = number_format($rpt_penerimaan_view->potongan,0,".",",");
			
			/*$total = numberreplace($total) +  numberreplace($rpt_penerimaan_view->jumlah) - numberreplace($rpt_penerimaan_view->potongan);
			$total = number_format($total,0,".",",");*/
		
			$amount = $rpt_penerimaan_view->jumlah - $rpt_penerimaan_view->potongan;
			$amount = number_format($amount,0,".",",");
			
			$total_tagihan = $total_tagihan + $rpt_penerimaan_view->besar;
			
			$total_sisa = $total_sisa + ($rpt_penerimaan_view->besar - $rpt_penerimaan_view->jumlah);
			
			$sisa = $rpt_penerimaan_view->besar - $rpt_penerimaan_view->jumlah;
			$sisa = number_format($sisa,0,".",",");
		?>
				<tr style="color: #000">
					<td><?php echo $rpt_penerimaan_view->nis ?></td>
					<td><?php echo $rpt_penerimaan_view->nama ?></td>
					<td><?php echo $kelas ?></td>
					<td><?php echo $rpt_penerimaan_view->namapenerimaan ?></td>
					<td align="right" style="font-weight: bold"><?php echo $besar ?>&nbsp;</td>
					
					<?php
						$sqljenis = $select_print->list_jenis_bayar();
						while ($rpt_jenis_view=$sqljenis->fetch(PDO::FETCH_OBJ)) {
							
							$besar_bayar = 0;
							$besar_bayar = $select_print->list_rpt_penerimaanjtt($rpt_penerimaan_view->replid, $rpt_jenis_view->replid);
							$besar_bayar = number_format($besar_bayar,0,".",",");
					?>
							<td align="right" style="font-weight: bold"><?php echo $besar_bayar ?></td>
					<?php
												
						}
					?>
					
					<!--<td align="right" style="font-weight: bold"><?php echo $jumlah ?>&nbsp;</td>-->
					<!--<td align="right" style="font-weight: bold"><?php echo $potongan ?>&nbsp;</td>-->
					<td align="right" style="font-weight: bold"><?php echo $sisa ?>&nbsp;</td>
					<td><?php echo $rpt_penerimaan_view->keterangan ?></td>
				</tr>
				
	<?php
			}
	?>
		<tr style="font-weight: bold; background-color: #deecf3">
			<td colspan="4" align="right">TOTAL &nbsp;</td>
			<td align="right" style="font-weight: bold"><?php echo number_format($total_tagihan,0,".",",") ?>&nbsp;</td>
			<?php
				$sqljenis = $select_print->list_jenis_bayar();
				while ($rpt_jenis_view=$sqljenis->fetch(PDO::FETCH_OBJ)) {
					
					if($rowrpt > 0) {
						$total_bayar = $select_print->list_rpt_penerimaanjtt_sum($rpt_jenis_view->replid, $daritgl, $ketgl, $idtingkat, $idkelas, $nama, $departemen, $all);
					}
					$total_bayar = number_format($total_bayar,0,".",",");
			?>
					<td align="right" style="font-weight: bold"><?php echo $total_bayar ?></td>
			<?php
										
				}
			?>
			<td align="right" style="font-weight: bold"><?php echo number_format($total_sisa,0,".",",") ?></td>
			<td align="right" style="font-weight: bold">&nbsp;</td>
		</tr>
		
</table>

<!--<script language="javascript">
	window.print();
</script>-->