<table border="0" style="border: 1px solid #ccc">
	<tr style="font-weight: bold">
		<td>Jenis Prestasi</td>
		<td>Tingkat</td>
		<td>Nama Prestasi</td>
		<td>Tahun</td>
		<td>Penyelenggara</td>		
	</tr>
	
	<?php 
		
		for($i=0; $i<=5; $i++) { 	
		
	?>
	

		<input type="hidden" id="jmldata" name="jmldata" value="6" >
				
		<tr>
			<td><input type="text" style="width:200px;"  name="jenisprestasi_<?php echo $i ?>" id="jenisprestasi_<?php echo $i ?>" value=""/></td>
			<td><input type="text" style="width:100px;"  name="tingkat_<?php echo $i ?>" id="tingkat_<?php echo $i ?>" value=""/></td>
			<td><input type="text" style="width:200px;"  name="nama_<?php echo $i ?>" id="nama_<?php echo $i ?>" value=""/></td>
			<td>
				<select name="tahun_<?php echo $i ?>" id="tahun_<?php echo $i ?>" style="width:100px; height:27px; " />
					<option value=""></option>
					<?php tahun_select($registrasi_det2->tahun); ?>
				</select>
			</td>
			<td><input type="text" style="width:150px;"  name="penyelenggara_<?php echo $i ?>" id="penyelenggara_<?php echo $i ?>" value=""/></td>
		</tr>
		
				
	<?php } ?>
</table>
