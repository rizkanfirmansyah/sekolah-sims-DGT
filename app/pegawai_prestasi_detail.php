<?php
$sqldtl=$select->list_get_pegawai_prestasi_detail($idpegawai);
$rows_detail = $sqldtl->rowCount();	

if($rows_detail > 0) {
?>

	<table border="0" style="border: 1px solid #ccc">	
		<tr style="font-weight: bold">
			<td>No</td>
			<td>Jenis Prestasi</td>
			<td>Tingkat</td>
			<td>Nama Prestasi</td>
			<td>Tahun</td>
			<td>Penyelenggara</td>
			<?php if (allowdel('frmpegawai_prestasi')==1) { ?>
				<td>Hapus</td>		
			<?php } ?>
		</tr>
		
		<?php 
			
				$i = 0;		
				while($pegawai_prestasi_det=$sqldtl->fetch(PDO::FETCH_OBJ)) {
				
				$j++;
		?>
		
				<input type="hidden" readonly="" style="width:150px; background-color: #fff"  name="replid_<?php echo $i ?>" id="replid_<?php echo $i ?>" value="<?php echo $pegawai_prestasi_det->replid ?>"/>
						
				<tr>
					<td align="center"><?php echo $j ?></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="jenisprestasi_<?php echo $i ?>" id="jenisprestasi_<?php echo $i ?>" value="<?php echo $pegawai_prestasi_det->jenisprestasi ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="tingkat_<?php echo $i ?>" id="tingkat_<?php echo $i ?>" value="<?php echo $pegawai_prestasi_det->tingkat ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="nama_<?php echo $i ?>" id="nama_<?php echo $i ?>" value="<?php echo $pegawai_prestasi_det->nama ?>"/></td>
					<td><input type="text" readonly="" style="width:70px; background-color: #fff"  name="tahun_<?php echo $i ?>" id="tahun_<?php echo $i ?>" value="<?php echo $pegawai_prestasi_det->tahun ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="penyelenggara_<?php echo $i ?>" id="penyelenggara_<?php echo $i ?>" value="<?php echo $pegawai_prestasi_det->penyelenggara ?>"/></td>
					
					<?php if (allowdel('frmpegawai_prestasi')==1) { ?>
						<td>
							<a href="JavaScript:hapus('<?php echo $pegawai_prestasi_det->replid ?>','<?php echo $pegawai_prestasi_det->idpegawai ?>')"><img src="img/icons/fugue/cross.png" ></a>
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