<?php
$sqldtl=$select->list_get_pegawai_pangkat_detail($idpegawai);
$rows_detail = $sqldtl->rowCount();	

if($rows_detail > 0) {
?>

	<table border="0" style="border: 1px solid #ccc">	
		<tr style="font-weight: bold">
			<td>No</td>
			<td>Ruang</td>			
			<td>Pangkat</td>
			<td>Jabatan</td>
			<td>TMT</td>
			<td>SK</td>
			<td>No SK</td>
			<td>Tgl SK Akhir</td>

		</tr>
		
		<?php 
			
				$i = 0;		
				while($pegawai_pangkat_det=$sqldtl->fetch(PDO::FETCH_OBJ)) {
				
				$j++;
		?>
		
				<input type="hidden" readonly="" style="width:180px; background-color: #fff"  name="replid_<?php echo $i ?>" id="replid_<?php echo $i ?>" value="<?php echo $pegawai_pangkat_det->replid ?>"/>
						
				<tr>
					<td align="center"><?php echo $j ?></td>
					<td><input type="text" readonly="" style="width:50px; background-color: #fff"  name="ruang_<?php echo $i ?>" id="ruang_<?php echo $i ?>" value="<?php echo $pegawai_pangkat_det->ruang ?>"/></td>
					
					<td><input type="text" readonly="" style="width:180px; background-color: #fff"  name="pangkat_<?php echo $i ?>" id="pangkat_<?php echo $i ?>" value="<?php echo $pegawai_pangkat_det->pangkat ?>"/></td>
					
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="jabatan_<?php echo $i ?>" id="jabatan_<?php echo $i ?>" value="<?php echo $pegawai_pangkat_det->jabatan ?>"/></td>
					
					<td><input type="text" readonly="" style="width:80px; background-color: #fff"  name="tanggal_efektif_<?php echo $i ?>" id="tanggal_efektif_<?php echo $i ?>" value="<?php echo $pegawai_pangkat_det->tanggal_efektif ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="sk_<?php echo $i ?>" id="sk_<?php echo $i ?>" value="<?php echo $pegawai_pangkat_det->sk ?>"/></td>
					
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="no_sk_<?php echo $i ?>" id="no_sk_<?php echo $i ?>" value="<?php echo $pegawai_pangkat_det->no_sk ?>"/></td>
					
					<td><input type="text" readonly="" style="width:80px; background-color: #fff"  name="tanggal_sk_<?php echo $i ?>" id="tanggal_sk_<?php echo $i ?>" value="<?php echo $pegawai_pangkat_det->tanggal_sk ?>"/></td>
					
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


<!---------------------next column---------------------------------->
<?php
$sqldtl=$select->list_get_pegawai_pangkat_detail($idpegawai);
$rows_detail = $sqldtl->rowCount();	

if($rows_detail > 0) {
	
?>

	<table border="1" style="border: 1px solid #ccc">	
		<tr style="font-weight: bold">
			<td>No</td>
			<td>Gaji Pokok</td>
			<td>Keterangan</td>
			<?php if (allowdel('frmpegawai_pangkat')==1) { ?>
				<td>Hapus</td>		
			<?php } ?>
		</tr>
		
		<?php 
			
				$i = 0;	
				$j = 0;	
				while($pegawai_pangkat_det=$sqldtl->fetch(PDO::FETCH_OBJ)) {
				
				$j++;
		?>
		
					<td align="center"><?php echo $j ?></td>
					<td><input type="text" readonly="" style="width:100px; background-color: #fff"  name="gaji_pokok_<?php echo $i ?>" id="gaji_pokok_<?php echo $i ?>" value="<?php echo $pegawai_pangkat_det->gaji_pokok ?>"/></td>
					<td><?php echo $pegawai_pangkat_det->keterangan ?></td>
					<?php if (allowdel('frmpegawai_pangkat')==1) { ?>
						<td>
							<a href="JavaScript:hapus('<?php echo $pegawai_pangkat_det->replid ?>','<?php echo $pegawai_pangkat_det->idpegawai ?>')"><img src="img/icons/fugue/cross.png" ></a>
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










