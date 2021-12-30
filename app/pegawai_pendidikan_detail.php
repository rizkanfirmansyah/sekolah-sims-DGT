<?php
$sqldtl=$select->list_get_pegawai_pendidikan_detail($idpegawai);
$rows_detail = $sqldtl->rowCount();	

if($rows_detail > 0) {
?>

	<table border="0" style="border: 1px solid #ccc">	
		<tr style="font-weight: bold">
			<td>No</td>
			<td>Nama Sekolah</td>
			<td>Tahun Lulus</td>
			<td>Jenjang</td>
			<td>Lulusan</td>
			<td>Jurusan</td>
			<td>Keterangan</td>
			<?php if (allowdel('frmpegawai_pendidikan')==1) { ?>
				<td>Hapus</td>		
			<?php } ?>
		</tr>
		
		<?php 
			
				$i = 0;		
				while($pegawai_pendidikan_det=$sqldtl->fetch(PDO::FETCH_OBJ)) {
				
				$j++;
		?>
		
				<input type="hidden" readonly="" style="width:150px; background-color: #fff"  name="replid_<?php echo $i ?>" id="replid_<?php echo $i ?>" value="<?php echo $pegawai_pendidikan_det->replid ?>"/>
						
				<tr>
					<td align="center"><?php echo $j ?></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="nama_sekolah_<?php echo $i ?>" id="nama_sekolah_<?php echo $i ?>" value="<?php echo $pegawai_pendidikan_det->nama_sekolah ?>"/></td>
					<td><input type="text" readonly="" style="width:50px; background-color: #fff"  name="tahun_<?php echo $i ?>" id="tahun_<?php echo $i ?>" value="<?php echo $pegawai_pendidikan_det->tahun ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="jenjang_<?php echo $i ?>" id="jenjang_<?php echo $i ?>" value="<?php echo $pegawai_pendidikan_det->jenjang ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="lulusan_<?php echo $i ?>" id="lulusan_<?php echo $i ?>" value="<?php echo $pegawai_pendidikan_det->lulusan ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="jurusan_<?php echo $i ?>" id="jurusan_<?php echo $i ?>" value="<?php echo $pegawai_pendidikan_det->jurusan ?>"/></td>
					<td><?php echo $pegawai_pendidikan_det->keterangan ?></td>
					<?php if (allowdel('frmpegawai_pendidikan')==1) { ?>
						<td>
							<a href="JavaScript:hapus('<?php echo $pegawai_pendidikan_det->replid ?>','<?php echo $pegawai_pendidikan_det->idpegawai ?>')"><img src="img/icons/fugue/cross.png" ></a>
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