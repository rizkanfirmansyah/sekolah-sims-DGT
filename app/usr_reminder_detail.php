<table border="1" style="border: 1px solid #ccc">
	<tr>
		<td colspan="2" align="center">
			<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>Dasboard Data</h4>
		</td>
	</tr>
	
	<tr style="font-weight: bold">
		<td align="center">Nama Reminder</td>
		<td align="center">Pilih</td>
	</tr>
	
	<?php 
		
		$sql=$select->list_usr_reminder();
		$rows = $sql->rowCount();
								
		while ($row_reminder = $sql->fetch(PDO::FETCH_OBJ)) { 	
		
		$no++;
		
		if($row_reminder->rmd_old==1) {
			$background = "background-color:#f8da07;";
		} else {
			$background = "background-color:#fff;";
		}
	?>
	
		<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $rows; ?>" >
		
		<input type="hidden" id="reminder_id_<?php echo $no; ?>" name="reminder_id_<?php echo $no; ?>" value="<?php echo $row_reminder->reminder_id; ?>">
		<input type="hidden" id="old_reminder_id_<?php echo $no; ?>" name="old_reminder_id_<?php echo $no; ?>" value="<?php echo $row_reminder->reminder_id; ?>">
		<input type="hidden" id="rmd_old_<?php echo $no; ?>" name="rmd_old_<?php echo $no; ?>" value="<?php echo $row_reminder->rmd_old; ?>">
								
		<tr style="<?php echo $background ?>;"> 
			<td width="250">&nbsp;<?php echo $row_reminder->nama; ?></td>
			<td align="center"><input type="checkbox" style="width:100px; height:16px;" id="mview_<?php echo $no; ?>" name="mview_<?php echo $no; ?>" value="1" <?php if($row_reminder->rmd_old==1) echo "checked"; ?> ></td>
			
		</tr>
		
				
	<?php } ?>
</table>
