<?php
$sqldtl=$select->list_get_pegawai_skmengajar_detail($idpegawai);
$rows_detail = $sqldtl->rowCount();	

if($rows_detail > 0) {
?>

	<table border="0" style="border: 1px solid #ccc">	
		<tr style="font-weight: bold">
			<td>No</td>
			<td>Nomor SK</td>
			<td>Tahun</td>
			<td>Fungsional</td>
			<?php if (allowdel('frmpegawai_skmengajar')==1) { ?>
				<td>Hapus</td>		
			<?php } ?>
		</tr>
		
		<?php 
			
				$i = 0;		
				while($pegawai_skmengajar_det=$sqldtl->fetch(PDO::FETCH_OBJ)) {
				
				$j++;
		?>
		
				<input type="hidden" readonly="" style="width:150px; background-color: #fff"  name="replid_<?php echo $i ?>" id="replid_<?php echo $i ?>" value="<?php echo $pegawai_skmengajar_det->replid ?>"/>
						
				<tr>
					<td align="center"><?php echo $j ?></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="no_sk_<?php echo $i ?>" id="no_sk_<?php echo $i ?>" value="<?php echo $pegawai_skmengajar_det->no_sk ?>"/></td>
					<td><input type="text" readonly="" style="width:70px; background-color: #fff"  name="tahun_<?php echo $i ?>" id="tahun_<?php echo $i ?>" value="<?php echo $pegawai_skmengajar_det->tahun ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="fungsional_<?php echo $i ?>" id="fungsional_<?php echo $i ?>" value="<?php echo $pegawai_skmengajar_det->fungsional ?>"/></td>
					
					<?php if (allowdel('frmpegawai_skmengajar')==1) { ?>
						<td>
							<a href="JavaScript:hapus('<?php echo $pegawai_skmengajar_det->replid ?>','<?php echo $pegawai_skmengajar_det->idpegawai ?>')"><img src="img/icons/fugue/cross.png" ></a>
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