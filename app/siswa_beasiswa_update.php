<table border="0" style="border: 1px solid #ccc">
	<tr style="font-weight: bold">
		<td>Jenis Beasiswa</td>
		<td>Penyelenggara/Sumber</td>
		<td>Tahun Mulai</td>
		<td>Tahun Selesai</td>
		<td>Hapus</td>		
	</tr>
	
	<?php 
		
		$sql=$select_view->list_siswa_beasiswa($replid);
		$rows = $sql->rowCount();
		$i = 0;
		
		while ($siswabeasiswa_det = $sql->fetch(PDO::FETCH_OBJ)) {	
		
	?>
	
		<input type="hidden" id="old_line2_<?php echo $i ?>" name="old_line2_<?php echo $i ?>" value="<?php echo $siswabeasiswa_det->line ?>" >
				
		<tr>
			<td><input type="text" style="width:200px;"  name="jenis_<?php echo $i ?>" id="jenis_<?php echo $i ?>" value="<?php echo $siswabeasiswa_det->jenis ?>"/></td>
			<td><input type="text" style="width:150px;"  name="penyelenggara2_<?php echo $i ?>" id="penyelenggara2_<?php echo $i ?>" value="<?php echo $siswabeasiswa_det->penyelenggara ?>"/></td>
			<td>
				<select name="tahunmulai_<?php echo $i ?>" id="tahunmulai_<?php echo $i ?>" style="width:100px; height:27px; " />
					<option value=""></option>
					<?php tahun_select($siswabeasiswa_det->tahunmulai); ?>
				</select>
			</td>
			<td>
				<select name="tahunselesai_<?php echo $i ?>" id="tahunselesai_<?php echo $i ?>" style="width:100px; height:27px; " />
					<option value=""></option>
					<?php tahun_select($siswabeasiswa_det->tahunselesai); ?>
				</select>
			</td>
			
			<td align="center">
				<input type="checkbox" id="delete2_<?php echo $i; ?>" name="delete2_<?php echo $i; ?>" class="form-control" value="1" >
			</td>
			
		</tr>
		
				
	<?php 
			$i++;
		} 
	?>
	
	<?php
		$rows2 = 5 - $rows;
		$x = $i;
		$rows = $rows2 + $rows;
		for($i=$x; $i<=$rows; $i++) {
			
			
	?>
			
			<tr>
				<td><input type="text" style="width:200px;"  name="jenis_<?php echo $i ?>" id="jenis_<?php echo $i ?>" value=""/></td>
				<td><input type="text" style="width:150px;"  name="penyelenggara2_<?php echo $i ?>" id="penyelenggara2_<?php echo $i ?>" value=""/></td>
				<td>
					<select name="tahunmulai_<?php echo $i ?>" id="tahunmulai_<?php echo $i ?>" style="width:100px; height:27px; " />
						<option value=""></option>
						<?php tahun_select(""); ?>
					</select>
				</td>
				<td>
					<select name="tahunselesai_<?php echo $i ?>" id="tahunselesai_<?php echo $i ?>" style="width:100px; height:27px; " />
						<option value=""></option>
						<?php tahun_select(""); ?>
					</select>
				</td>
				
			</tr>
	
	<?php
			
		}
		
	?>
	
	<input type="hidden" id="jmldata2" name="jmldata2" value="<?php echo $i ?>" >
	
</table>
