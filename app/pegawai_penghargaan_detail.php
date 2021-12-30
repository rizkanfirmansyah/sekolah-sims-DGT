<?php
$sqldtl=$select->list_get_pegawai_penghargaan_detail($idpegawai);
$rows_detail = $sqldtl->rowCount();	

if($rows_detail > 0) {
?>

	<table border="0" style="border: 1px solid #ccc">	
		<tr style="font-weight: bold">
			<td>No</td>
			<td>Nama Penghargaan</td>
			<td>Tahun</td>
			<td>Pemberi Penghargaan</td>
			<?php if (allowdel('frmpegawai_penghargaan')==1) { ?>
				<td>Hapus</td>		
			<?php } ?>
		</tr>
		
		<?php 
			
				$i = 0;		
				while($pegawai_penghargaan_det=$sqldtl->fetch(PDO::FETCH_OBJ)) {
				
				$j++;
		?>
		
				<input type="hidden" readonly="" style="width:150px; background-color: #fff"  name="replid_<?php echo $i ?>" id="replid_<?php echo $i ?>" value="<?php echo $pegawai_penghargaan_det->replid ?>"/>
						
				<tr>
					<td align="center"><?php echo $j ?></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="namapenghargaan_<?php echo $i ?>" id="namapenghargaan_<?php echo $i ?>" value="<?php echo $pegawai_penghargaan_det->namapenghargaan ?>"/></td>
					<td><input type="text" readonly="" style="width:70px; background-color: #fff"  name="tahun_<?php echo $i ?>" id="tahun_<?php echo $i ?>" value="<?php echo $pegawai_penghargaan_det->tahun ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="pemberipenghargaan_<?php echo $i ?>" id="pemberipenghargaan_<?php echo $i ?>" value="<?php echo $pegawai_penghargaan_det->pemberipenghargaan ?>"/></td>
					
					<?php if (allowdel('frmpegawai_penghargaan')==1) { ?>
						<td>
							<a href="JavaScript:hapus('<?php echo $pegawai_penghargaan_det->replid ?>','<?php echo $pegawai_penghargaan_det->idpegawai ?>')"><img src="img/icons/fugue/cross.png" ></a>
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