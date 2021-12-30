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
$nip		= $_REQUEST['nip'];
$subdit		= $_REQUEST['subdit'];	

?>

<head>
<title>Pelaksanaan Pelayanan Luar Kantor</title>
</head>

<table width="100%" border="0" cellspacing="0" style="font-weight: bold; font-family: sans-serif">
	<tr>
		<td colspan="7" align="center">Pelaksanaan Pelayanan Tera dan Tera Ulang di Luar Kantor</td>
	</tr>
	<tr>
		<td colspan="7" align="center">&nbsp;</td>
	</tr>
</table>

<table width="100%" border="1" cellspacing="0" style="font-family: sans-serif; font-size: 11px">

	<tr style="font-weight: bold; background-color: #204b77; color: #fff">
		<td align="center" width="3%">No.</td>
		<td align="center" width="8%">No. DL</td>		
		<td align="center" width="10%">Nama Pegawai</td>
		<td align="center" width="15%">Jabatan</td>
		<td align="center" width="20%">Untuk</td>
		<td align="center" width="8%">Tanggal Berangkat</td>						
		<td align="center" width="8%">Tanggal Selesai</td>
	</tr>
	
	<?php		
		$i = 0;
		
		$sqlno=$select_print->dinasluarpeg_nodl_rpt($fromdate, $todate, $nip, $subdit);	
		while ($datano = odbc_fetch_object($sqlno)) {
			
			$DLNo = $datano->DLNo;
			$todate2 = $datano->ToDte;
			
			$sql=$select_print->dinasluarpeg_rpt($DLNo, $fromdate, $todate, $todate2, $nip, $subdit);	
			$rows = odbc_num_rows($sql);
			
			$c = 0;
			
			$sql=$select_print->dinasluarpeg_rpt($DLNo, $fromdate, $todate, $todate2, $nip, $subdit);
			while ($data = odbc_fetch_object($sql)) {
				
				$c++;
				
				$FrmDte = date("d-m-Y", strtotime($data->FrmDte));
				$ToDte = date("d-m-Y", strtotime($data->ToDte));
				
	?>
				<?php if($c == 1) { 
					$rows = $rows +1; 
					$i++;
				?>
					<tr style="color: #000">
						<td rowspan="<?php echo $rows ?>" align="center"><?php echo $i ?>.</td>
						<td rowspan="<?php echo $rows ?>" align="left"><?php echo $DLNo ?></td>
					</tr>
	<?php		
				}
	?>
					<tr style="color: #000">
						<td align="left"><?php echo $data->NamaKaryawan ?></td>
						<td align="left"><?php echo $data->Jabatan ?></td>
						<td align="left"><?php echo $data->ForTo ?></td>
						<td align="left"><?php echo $FrmDte ?></td>
						<td align="left"><?php echo $ToDte ?></td>						
					</tr>
	<?php
				
			}
		}		
	?>
	
</table>


