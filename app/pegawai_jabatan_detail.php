<?php
$sqldtl=$select->list_get_pegawai_jabatan_detail($idpegawai);
$rows_detail = $sqldtl->rowCount();	

if($rows_detail > 0) {
?>

	<table border="0" style="border: 1px solid #ccc">	
		<tr style="font-weight: bold">
			<td>No</td>
			<td>Jabatan</td>
			<td>Tanggal Efektif</td>
			<td>Keterangan</td>
			<?php if (allowdel('frmpegawai_jabatan')==1) { ?>
				<td>Hapus</td>		
			<?php } ?>
		</tr>
		
		<?php 
			
				$i = 0;		
				while($pegawai_jabatan_det=$sqldtl->fetch(PDO::FETCH_OBJ)) {
				
				$j++;
		?>
		
				<input type="hidden" readonly="" style="width:150px; background-color: #fff"  name="replid_<?php echo $i ?>" id="replid_<?php echo $i ?>" value="<?php echo $pegawai_jabatan_det->replid ?>"/>
						
				<tr>
					<td align="center"><?php echo $j ?></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="jabatan_<?php echo $i ?>" id="jabatan_<?php echo $i ?>" value="<?php echo $pegawai_jabatan_det->jabatan ?>"/></td>
					<td><input type="text" readonly="" style="width:300px; background-color: #fff"  name="tanggal_efektif_<?php echo $i ?>" id="tanggal_efektif_<?php echo $i ?>" value="<?php echo $pegawai_jabatan_det->tanggal_efektif ?>"/></td>
					<td><?php echo $pegawai_jabatan_det->keterangan ?></td>
					<?php if (allowdel('frmpegawai_jabatan')==1) { ?>
						<td>
							<a href="JavaScript:hapus('<?php echo $pegawai_jabatan_det->replid ?>','<?php echo $pegawai_jabatan_det->idpegawai ?>')"><img src="img/icons/fugue/cross.png" ></a>
						</td>
					<?php } ?>
				</tr>
			
					
		<?php 
					$i++;
				
				} 
			
		?>
				<tr>
					<td colspan="5">&nbsp;</td>
				</tr>
				
	</table>

<?php

}

?>