<table border="0" style="border: 1px solid #ccc">
	<tr style="font-weight: bold">
		<td>Jenis Beasiswa</td>
		<td>Penyelenggara/Sumber</td>
		<td>Tahun Mulai</td>
		<td>Tahun Selesai</td>		
	</tr>
	
	<?php 
		
		for($i=0; $i<=5; $i++) { 	
		
	?>
	

		<input type="hidden" id="jmldata2" name="jmldata2" value="6" >
				
		<tr>
			<td><input type="text" style="width:200px;"  name="jenis_<?php echo $i ?>" id="jenis_<?php echo $i ?>" value=""/></td>
			<td><input type="text" style="width:250px;"  name="penyelenggara_<?php echo $i ?>" id="penyelenggara_<?php echo $i ?>" value=""/></td>
			<td>
				<select name="tahunmulai_<?php echo $i ?>" id="tahunmulai_<?php echo $i ?>" style="width:100px; height:27px; " />
					<option value=""></option>
					<?php tahun_select($registrasi_det2->tahunmulai); ?>
				</select>
			</td>
			<td>
				<select name="tahunselesai_<?php echo $i ?>" id="tahunselesai_<?php echo $i ?>" style="width:100px; height:27px; " />
					<option value=""></option>
					<?php tahun_select($registrasi_det2->tahunselesai); ?>
				</select>
			</td>
			
		</tr>
		
				
	<?php } ?>
</table>
