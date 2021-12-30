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

$tahun		= $_REQUEST['tahun'];
$tahun2		= $_REQUEST['tahun2'];
$jmltera	= $_REQUEST['jmltera'];
$tipe		= $_REQUEST['tipe'];

?>

<head>
<title>Laporan Jumlah Pelanggan per Periode (Tera Ulang)</title>
</head>


<table width="100%" border="0" cellspacing="0" style="font-weight: bold; font-family: sans-serif">
	<tr>
		<td colspan="18" align="center">LAPORAN JUMLAH PELANGGAN PER PERIODE (Tera Ulang)</td>
	</tr>
	<tr>
		<td colspan="18" align="center">&nbsp;</td>
	</tr>
</table>

<table width="100%" border="1" cellspacing="0" style="font-family: sans-serif; font-size: 11px">

	<tr style="font-weight: bold; background-color: #204b77; color: #fff">
		<td align="center" width="20%">Nama Pelanggan</td>
		<td align="center" width="30%">Alamat</td>		
		<td align="center" width="10%">Kota</td>
		<td align="center" width="10%">Telepon</td>
		<td align="center" width="10%">Fax</td>
		<td align="center" width="10%">E-mail</td>						
		<td align="center" width="10%">Nama Kontak</td>	
		<td align="center" width="10%">Jumlah Tera (Kali)</td>		
	</tr>	
	
	<?php
		
		$sqlthn=$select_print->clnprd_tahun_rpt($tahun, $tahun2, $jmltera, $tipe);	
		while ($datathn = odbc_fetch_object($sqlthn)) {
	?>
			<tr style="font-weight: bold; background-color: #deecf3">
				<td colspan="8" align="left">PERIODE : <?php echo $datathn->periodid ?></td>
			</tr>
	<?php		
			$sql=$select_print->clnprd_rpt($datathn->periodid, '', $jmltera, $tipe);	
			while ($data = odbc_fetch_object($sql)) {
			
		?>
				<tr style="color: #000">
					<td align="left"><?php echo $data->clientname ?></td>
					<td align="left"><?php echo $data->alamat ?></td>				
					<td align="left"><?php echo $data->kota ?></td>								
					<td align="left"><?php echo $data->telp ?></td>				
					<td align="left"><?php echo $data->fax ?></td>
					<td align="left"><?php echo $data->email ?></td>
					<td align="left"><?php echo $data->cp ?></td>
					<td align="left"><?php echo $data->jumlah ?></td>
				</tr>				
	<?php
			}
		}
	?>
		
</table>


