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

$fromdate	= $_REQUEST['fromdate'];
$todate		= $_REQUEST['todate'];
$lab		= $_REQUEST['lab'];

?>

<head>
<title>Kinerja Laboratorium</title>
</head>


<table width="100%" border="0" cellspacing="0" style="font-weight: bold; font-family: sans-serif">
	<tr>
		<td colspan="18" align="center">Kinerja Laboratorium</td>
	</tr>
	<tr>
		<td colspan="18" align="center">&nbsp;</td>
	</tr>
</table>

<table width="100%" border="1" cellspacing="0" style="font-family: sans-serif; font-size: 11px">

	<tr style="font-weight: bold; background-color: #204b77; color: #fff">
		<td rowspan="2" align="center" width="20%">Nama Lab.</td>
		<td rowspan="2" align="center" width="10%">Order</td>		
		<td colspan="2" align="center" width="10%">Proses</td>
		<td colspan="2" align="center" width="10%">Batal</td>
		<td colspan="2" align="center" width="10%">Catatan Lab.</td>
		<td colspan="2" align="center" width="10%">Finish</td>						
		<td colspan="2" align="center" width="10%">Tertunda</td>		
	</tr>
	
	<tr style="font-weight: bold; background-color: #204b77; color: #fff">
		<td align="center" width="10%">Jumlah</td>
		<td align="center" width="10%">%</td>		
		
		<td align="center" width="10%">Jumlah</td>
		<td align="center" width="10%">%</td>	
		
		<td align="center" width="10%">Jumlah</td>
		<td align="center" width="10%">%</td>	
		
		<td align="center" width="10%">Jumlah</td>
		<td align="center" width="10%">%</td>	
		
		<td align="center" width="10%">Jumlah</td>
		<td align="center" width="10%">%</td>	
	</tr>
	
	<?php		
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
			
	?>
			<tr style="color: #000">
				<td align="left"><?php echo $data->NamaLab ?></td>
				<td align="right"><?php echo number_format($data->Total,2,".",",") ?>&nbsp;</td>				
				
				<td align="right"><?php echo number_format($data->proses,2,".",",") ?>&nbsp;</td>								
				<td align="right"><?php echo number_format($data->totalprosespersen,2,".",",") ?>&nbsp;</td>
								
				<td align="right"><?php echo number_format($data->totalbatal,2,".",",") ?>&nbsp;</td>
				<td align="right"><?php echo number_format($data->totalbatalpersen,2,".",",") ?>&nbsp;</td>
				
				<td align="right"><?php echo number_format($data->totalcatlab,2,".",",") ?>&nbsp;</td>
				<td align="right"><?php echo number_format($data->totalcatlabpersen,2,".",",") ?>&nbsp;</td>
				
				<td align="right"><?php echo number_format($data->totalfinish,2,".",",") ?>&nbsp;</td>
				<td align="right"><?php echo number_format($data->totalfinishpersen,2,".",",") ?>&nbsp;</td>
				
				<td align="right"><?php echo number_format($data->totaltunda,2,".",",") ?>&nbsp;</td>
				<td align="right"><?php echo number_format($data->totaltundapersen,2,".",",") ?>&nbsp;</td>
				
			</tr>				
	<?php
		}
		
		$totalprosespersen = ($proses/$Total) * 100;
		$totalbatalpersen = ($totalbatal/$Total) * 100;
		$totalcatlabpersen = ($totalcatlab/$Total) * 100;
		$totalfinishpersen = ($totalfinish/$Total) * 100;
		$totaltundapersen = ($totaltunda/$Total) * 100;
	?>
	
		<tr style="font-weight: bold; background-color: #7dfff5; color: #000">
			<td align="center" width="10%">TOTAL</td>
			<td align="right"><?php echo number_format($Total,2,".",",") ?>&nbsp;</td>				
				
			<td align="right"><?php echo number_format($proses,2,".",",") ?>&nbsp;</td>								
			<td align="right"><?php echo number_format($totalprosespersen,2,".",",") ?>&nbsp;</td>
							
			<td align="right"><?php echo number_format($totalbatal,2,".",",") ?>&nbsp;</td>
			<td align="right"><?php echo number_format($totalbatalpersen,2,".",",") ?>&nbsp;</td>
			
			<td align="right"><?php echo number_format($totalcatlab,2,".",",") ?>&nbsp;</td>
			<td align="right"><?php echo number_format($totalcatlabpersen,2,".",",") ?>&nbsp;</td>
			
			<td align="right"><?php echo number_format($totalfinish,2,".",",") ?>&nbsp;</td>
			<td align="right"><?php echo number_format($totalfinishpersen,2,".",",") ?>&nbsp;</td>
			
			<td align="right"><?php echo number_format($totaltunda,2,".",",") ?>&nbsp;</td>
			<td align="right"><?php echo number_format($totaltundapersen,2,".",",") ?>&nbsp;</td>	
		</tr>
		
</table>


