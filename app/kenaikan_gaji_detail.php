<?php
$sqldtl=$select->list_get_kenaikan_gaji_detail($idpegawai);
$rows_detail = $sqldtl->rowCount();	

if($rows_detail > 0) {
?>

	<table border="0" style="border: 1px solid #ccc">	
		<tr style="font-weight: bold">
			<td>No</td>
			<td>No. KGB</td>			
			<td>Gaji Pokok</td>
			<td>TMT</td>
			<td>Tanggal KGB</td>
			<td>Keterangan</td>
			<?php if (allowdel('frmkenaikan_gaji')==1) { ?>
				<td>Hapus</td>		
			<?php } ?>
			
		</tr>
		
		<?php 
			
				$i = 0;		
				while($kenaikan_gaji_det=$sqldtl->fetch(PDO::FETCH_OBJ)) {
				
				$j++;
		?>
		
				<input type="hidden" readonly="" style="width:180px; background-color: #fff"  name="replid_<?php echo $i ?>" id="replid_<?php echo $i ?>" value="<?php echo $kenaikan_gaji_det->replid ?>"/>
						
				<tr>
					<td align="center"><?php echo $j ?></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="no_kgb_<?php echo $i ?>" id="no_kgb_<?php echo $i ?>" value="<?php echo $kenaikan_gaji_det->no_kgb ?>"/></td>
					
					<td><input type="text" readonly="" style="width:180px; background-color: #fff"  name="gaji_pokok_<?php echo $i ?>" id="gaji_pokok_<?php echo $i ?>" value="<?php echo $kenaikan_gaji_det->gaji_pokok ?>"/></td>
					
					<td><input type="text" readonly="" style="width:80px; background-color: #fff"  name="tmt_<?php echo $i ?>" id="tmt_<?php echo $i ?>" value="<?php echo $kenaikan_gaji_det->tmt ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="tanggal_kgb_<?php echo $i ?>" id="tanggal_kgb_<?php echo $i ?>" value="<?php echo $kenaikan_gaji_det->tanggal_kgb ?>"/></td>
					
					<td><input type="text" readonly="" style="width:80px; background-color: #fff"  name="keterangan_<?php echo $i ?>" id="keterangan_<?php echo $i ?>" value="<?php echo $kenaikan_gaji_det->keterangan ?>"/></td>
					
					<?php if (allowdel('frmkenaikan_gaji')==1) { ?>
						<td>
							<a href="JavaScript:hapus('<?php echo $kenaikan_gaji_det->replid ?>','<?php echo $kenaikan_gaji_det->idpegawai ?>')"><img src="img/icons/fugue/cross.png" ></a>
						</td>
					<?php } ?>
					
				</tr>
			
					
		<?php 
					$i++;
				
				} 
			
		?>
				<tr>
					<td colspan="8">&nbsp;</td>
				</tr>
				
	</table>

<?php

}

?>







