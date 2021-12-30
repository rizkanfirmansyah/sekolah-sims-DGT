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
<title>Kinerja Laboratorium</title>
</head>


<table border="1">
	<tr>
		<td rowspan="4">ssssssssss</td>		
	</tr>	
	<tr>
		<td>xxxxxxxx</td>
	</tr>
	<tr>
		<td>xxxxxxxx</td>
	</tr>
	<tr>
		<td>xxxxxxxx</td>
	</tr>
	<tr>
		<td rowspan="4">111111111</td>		
	</tr>
	<tr>
		<td>xxxxxxxx</td>
	</tr>
	<tr>
		<td>xxxxxxxx</td>
	</tr>
	<tr>
		<td>xxxxxxxx</td>
	</tr>
</table>

<table width="100%" border="0" cellspacing="0" style="font-weight: bold; font-family: sans-serif">
	<tr>
		<td colspan="2" align="center">Pelaksanaan Pelayanan Tera dan Tera Ulang di Luar Kantor</td>
	</tr>
	<tr>
		<td colspan="2" align="center">&nbsp;</td>
	</tr>
</table>

<table width="100%" border="1" cellspacing="0" style="font-family: sans-serif; font-size: 11px">

	<tr style="font-weight: bold; background-color: #204b77; color: #fff">
		<td align="center" width="5%">No.</td>
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
			
			$i++;
			
			$DLNo = $datano->DLNo;
			
			$sql=$select_print->dinasluarpeg_rpt($DLNo, $fromdate, $todate, $nip, $subdit);	
			$rows = odbc_num_rows($sql);
			
			$sql=$select_print->dinasluarpeg_rpt($DLNo, $fromdate, $todate, $nip, $subdit);	
			while ($data = odbc_fetch_object($sql)) {
				
				$FrmDte = date("d-m-Y", strtotime($data->FrmDte));
				$ToDte = date("d-m-Y", strtotime($data->ToDte));
				
	?>
				<tr style="color: #000">
					<?php if($i == 1) { ?>
						<td rowspan="<?php echo $i ?>" align="left"><?php echo $i ?></td>
						<td rowspan="<?php echo $i ?>" align="left"><?php echo $DLNo ?></td>
					<?php } else { ?>
						<td align="left"><?php echo $i ?></td>
						<td align="left"><?php echo $DLNo ?></td>
					<?php	
					}
					?>
					
							
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


