<table border="1" style="border: 1px solid #ccc">
	<tr>
		<td colspan="10" align="center">
			<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>Menu</h4>
		</td>
	</tr>
										
	<tr style="font-weight: bold">
		<td align="center">Menu</td>
		<td align="center">Pilih</td>
		<td align="center">Input</td>
		<td align="center">Edit</td>
		<td align="center">Hapus</td>		
		<td align="center">Level</td>
	</tr>
	
	<?php 
		
		$sql=$select->list_usrfrm();
		$rows = $sql->rowCount();
							
		while ($row_usrfrm = $sql->fetch(PDO::FETCH_OBJ)) { 	
		
		$no++;
	?>
	
		<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $rows; ?>" >
		
		<input type="hidden" id="usr_frmcde_<?php echo $no; ?>" name="usr_frmcde_<?php echo $no; ?>" value="<?php echo $row_usrfrm->frmcde; ?>">
								
		<tr style="background-color:ffffff;"> 
			<td width="250">&nbsp;<?php echo $row_usrfrm->frmnme; ?></td>
			<td align="center"><input type="checkbox" style="width:100px; height:16px;" id="usr_slc_<?php echo $no; ?>" name="usr_slc_<?php echo $no; ?>" value="1" ></td>
			
			<td align="center"><input type="checkbox" style="width:100px; height:16px;" id="usr_add_<?php echo $no; ?>" name="usr_add_<?php echo $no; ?>" value="1" ></td>
			<td align="center"><input type="checkbox" style="width:100px; height:16px;" id="usr_edt_<?php echo $no; ?>" name="usr_edt_<?php echo $no; ?>" value="1" ></td>
			<td align="center"><input type="checkbox" style="width:100px; height:16px;" id="usr_dlt_<?php echo $no; ?>" name="usr_dlt_<?php echo $no; ?>" value="1" ></td>
			<td align="center">
				<select id="usr_lvl_<?php echo $no; ?>" name="usr_lvl_<?php echo $no; ?>" class='cho' style="height: 30px">
					<?php select_level($row_usrfrm->lvl) ?>
				</select>
			</td>
		</tr>
		
				
	<?php } ?>
</table>
