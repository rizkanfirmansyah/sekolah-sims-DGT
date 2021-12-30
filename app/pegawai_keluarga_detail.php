<?php
$sqldtl=$select->list_get_pegawai_keluarga_detail($idpegawai);
$rows_detail = $sqldtl->rowCount();	

if($rows_detail > 0) {
?>

	<table border="0" style="border: 1px solid #ccc">	
		<tr style="font-weight: bold">
			<td>No</td>
			<td>Anak Ke</td>
			<td>Nama Anak</td>
			<td>Tempat Lahir</td>
			<td>Tanggal Lahir</td>
			<td>Pekerjaan</td>
			<td>Status</td>
			<td>Keterangan</td>
			<?php if (allowdel('frmpegawai_keluarga')==1) { ?>
				<td>Hapus</td>		
			<?php } ?>
		</tr>
		
		<?php 
			
				$i = 0;		
				while($pegawai_keluarga_det=$sqldtl->fetch(PDO::FETCH_OBJ)) {
				
				$j++;
		?>
		
				<input type="hidden" readonly="" style="width:150px; background-color: #fff"  name="replid_<?php echo $i ?>" id="replid_<?php echo $i ?>" value="<?php echo $pegawai_keluarga_det->replid ?>"/>
						
				<tr>
					<td align="center"><?php echo $j ?></td>
					<td><input type="text" readonly="" style="width:30px; background-color: #fff"  name="anak_ke_<?php echo $i ?>" id="anak_ke_<?php echo $i ?>" value="<?php echo $pegawai_keluarga_det->anak_ke ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="nama_anak_<?php echo $i ?>" id="nama_anak_<?php echo $i ?>" value="<?php echo $pegawai_keluarga_det->nama_anak ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="tempat_lahir_<?php echo $i ?>" id="tempat_lahir_<?php echo $i ?>" value="<?php echo $pegawai_keluarga_det->tempat_lahir ?>"/></td>
					<td><input type="text" readonly="" style="width:70px; background-color: #fff"  name="tanggal_lahir_<?php echo $i ?>" id="tanggal_lahir_<?php echo $i ?>" value="<?php echo $pegawai_keluarga_det->tanggal_lahir ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="pekerjaan_<?php echo $i ?>" id="pekerjaan_<?php echo $i ?>" value="<?php echo $pegawai_keluarga_det->pekerjaan ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="status_<?php echo $i ?>" id="status_<?php echo $i ?>" value="<?php echo $pegawai_keluarga_det->status ?>"/></td>
					<td><?php echo $pegawai_keluarga_det->keterangan ?></td>
					<?php if (allowdel('frmpegawai_keluarga')==1) { ?>
						<td>
							<a href="JavaScript:hapus('<?php echo $pegawai_keluarga_det->replid ?>','<?php echo $pegawai_keluarga_det->idpegawai ?>')"><img src="img/icons/fugue/cross.png" ></a>
						</td>
					<?php } ?>
				</tr>
			
					
		<?php 
					$i++;
				
				} 
			
		?>
				<tr>
					<td colspan="9">&nbsp;</td>
				</tr>
				
	</table>

<?php

}

?>