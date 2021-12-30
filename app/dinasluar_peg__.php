<table class="employmentHistoryForm" border="1">
	<tr>
		<td></td>
		<td>NIP</td>
		<td>Nama</td>
		<td>Pangkat</td>
		<td>Golongan</td>
		<td>Jabatan</td>
		<td>Sub Dit</td>
		<td></td>
	</tr>
	<tr class = "row">
		<td><input type="text" name="EpyCde" id="EpyCde" style="width:100px; height:12px;" value=""></td>
		<td><input type="text" name="EpyDcr" id="EpyDcr" style="width:150px; height:12px;" value=""></td>
		<td><input type="text" name="Pangkat" id="Pangkat" style="width:150px; height:12px;" value=""></td>
		<td><input type="text" name="Golongan" id="Golongan" style="width:150px; height:12px;" value=""></td>
		<td><input type="text" name="Jabatan" id="Jabatan" style="width:150px; height:12px;" value=""></td>
		<td><input type="text" name="SubDit" id="SubDit" style="width:150px; height:12px;" value=""></td>
		<td><input type="button" class="deleteThisRow" style="background-color:#FF0000 " value="Delete"/></td>
	</tr>
</table>
<input type="button" id="btnAddMore"  value="add more"/>

<script type="text/javascript">
	$(document).ready(function(){
	 //This line clones the row inside the '.row' class and transforms it to plain html.
	 var clonedRow = $('.row').clone().html();
	 
	 //This line wraps the clonedRow and wraps it <tr> tags since cloning ignores those tags
	 var appendRow = '<tr class = "row">' + clonedRow + '</tr>';  
		  
	 $('#btnAddMore').click(function(){
	  //this line get's the last row and appends the appendRow when it finds the correct row.
			$('.employmentHistoryForm tr:last').after(appendRow);
		});
	 
	 //when you click on the button called "delete", the function inside will be triggered.
	 $('.deleteThisRow').live('click',function(){
		 var rowLength = $('.row').length;
			 //this line makes sure that we don't ever run out of rows.
		  if(rowLength > 1){
	   deleteRow(this);
	  }else{
	   $('.employmentHistoryForm tr:last').after(appendRow);
	   deleteRow(this);
	  }
	 });
	   
	 function deleteRow(currentNode){
	  $(currentNode).parent().parent().remove();
	 }
	 });
</script>