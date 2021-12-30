<?php
$sqldtl=$select->list_get_siswa_ekstrakurikuler_detail($idpegawai);
$rows_detail = $sqldtl->rowCount();	

if($rows_detail > 0) {
?>

	<table border="0" style="border: 1px solid #ccc">	
		<tr style="font-weight: bold">
			<td>No</td>
			<td>Ekstrakurikuler</td>
			<td>Periode</td>
			<?php if (allowdel('frmsiswa_ekstrakurikuler')==1) { ?>
				<td>Hapus</td>		
			<?php } ?>
		</tr>
		
		<?php 
			
				$i = 0;		
				while($siswa_ekstrakurikuler_det=$sqldtl->fetch(PDO::FETCH_OBJ)) {
				
				$j++;
		?>
		
				<input type="hidden" readonly="" style="width:150px; background-color: #fff"  name="replid_<?php echo $i ?>" id="replid_<?php echo $i ?>" value="<?php echo $siswa_ekstrakurikuler_det->replid ?>"/>
						
				<tr>
					<td align="center"><?php echo $j ?></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="jabatan_<?php echo $i ?>" id="jabatan_<?php echo $i ?>" value="<?php echo $siswa_ekstrakurikuler_det->nama_ekskul ?>"/></td>
					<td><input type="text" readonly="" style="width:300px; background-color: #fff"  name="tanggal_<?php echo $i ?>" id="tanggal_<?php echo $i ?>" value="<?php echo $siswa_ekstrakurikuler_det->tanggal ?>"/></td>
					<?php if (allowdel('frmsiswa_ekstrakurikuler')==1) { ?>
						<td>
							<a href="JavaScript:hapus('<?php echo $siswa_ekstrakurikuler_det->replid ?>','<?php echo $siswa_ekstrakurikuler_det->idsiswa ?>')"><img src="img/icons/fugue/cross.png" ></a>
						</td>
					<?php } ?>
				</tr>
			
					
		<?php 
					$i++;
				
				} 
			
		?>
				<tr>
					<td colspan="4">&nbsp;</td>
				</tr>
				
	</table>

<?php

}

?>