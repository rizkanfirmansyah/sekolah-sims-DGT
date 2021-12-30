<table border="0" style="border: 1px solid #ccc">
	<tr style="font-weight: bold">
		<td>Jenis Prestasi</td>
		<td>Tingkat</td>
		<td>Nama Prestasi</td>
		<td>Tahun</td>
		<td>Penyelenggara</td>		
		<td>Hapus</td>
	</tr>
	
	<?php 
		
		$sql=$select_view->list_registrasi_prestasi($replid);
		$rows = $sql->rowCount();
		$i = 0;
		
		while ($registrasi_det = $sql->fetch(PDO::FETCH_OBJ)) {	
		
	?>
	

		<input type="hidden" id="old_line_<?php echo $i ?>" name="old_line_<?php echo $i ?>" value="<?php echo $registrasi_det->line ?>" >
				
		<tr>
			<td><input type="text" style="width:200px;"  name="jenisprestasi_<?php echo $i ?>" id="jenisprestasi_<?php echo $i ?>" value="<?php echo $registrasi_det->jenisprestasi ?>"/></td>
			<td><input type="text" style="width:150px;"  name="tingkat_<?php echo $i ?>" id="tingkat_<?php echo $i ?>" value="<?php echo $registrasi_det->tingkat ?>"/></td>
			<td><input type="text" style="width:100px;"  name="nama_<?php echo $i ?>" id="nama_<?php echo $i ?>" value="<?php echo $registrasi_det->nama ?>"/></td>
			<td>
				<select name="tahun_<?php echo $i ?>" id="tahun_<?php echo $i ?>" style="width:100px; height:27px; " />
					<option value=""></option>
					<?php tahun_select($registrasi_det->tahun); ?>
				</select>
			</td>
			<td><input type="text" style="width:150px;"  name="penyelenggara_<?php echo $i ?>" id="penyelenggara_<?php echo $i ?>" value="<?php echo $registrasi_det->penyelenggara ?>"/></td>
			
			<td align="center">
				<input type="checkbox" id="delete_<?php echo $i; ?>" name="delete_<?php echo $i; ?>" class="form-control" value="1" >
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
				<td><input type="text" style="width:200px;"  name="jenisprestasi_<?php echo $i ?>" id="jenisprestasi_<?php echo $i ?>" value=""/></td>
				<td><input type="text" style="width:150px;"  name="tingkat_<?php echo $i ?>" id="tingkat_<?php echo $i ?>" value=""/></td>
				<td><input type="text" style="width:100px;"  name="nama_<?php echo $i ?>" id="nama_<?php echo $i ?>" value=""/></td>
				<td>
					<select name="tahun_<?php echo $i ?>" id="tahun_<?php echo $i ?>" style="width:100px; height:27px; " />
						<option value=""></option>
						<?php tahun_select(""); ?>
					</select>
				</td>
				<td><input type="text" style="width:150px;"  name="penyelenggara_<?php echo $i ?>" id="penyelenggara_<?php echo $i ?>" value=""/></td>
			</tr>
	
	<?php
			
		}
		
	?>
	
	<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $i ?>" >
	
</table>
