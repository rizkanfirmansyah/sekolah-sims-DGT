<table border="0">
	<tr style="font-weight: bold">
		<td>NIP</td>
		<td>Nama</td>
		<td>Pangkat</td>
		<td>Golongan</td>
		<td>Jabatan</td>
		<td>Sub Dit</td>
	</tr>
	
	<?php 
		
		for($i=0; $i<=9; $i++) { 	
		
	?>
	
	<!----- auto complete ---------->
	<?php
	
	echo "
	<script>

		function suggest_". $i . "(inputString,autosugest){
			if(inputString.length == 0) {
				$('#suggestions_". $i . "').fadeOut();
			} else {
			$('#country_". $i . "').addClass('load_". $i . "');
				$.post(autosugest, {queryString: ". '""+inputString+""}, function(data){
					if(data.length >0) {
						'. "$('#suggestions_". $i . "').fadeIn();
						$('#suggestionsList_". $i . "').html(data);
						$('#country_". $i . "').removeClass('load_". $i ."');
					}
				});
			}
		}
		
		function fill_". $i . "(thisValue) {
			$('#EpyDcr_". $i . "').val(thisValue);
			". 'setTimeout("'."$('#suggestions_". $i . "').fadeOut();". '", 100);
		}'. "

		function fill2_". $i . "(thisValue) {
			$('#EpyCde_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestions_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fill3_". $i . "(thisValue) {
			$('#Pangkat_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestions_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fill4_". $i . "(thisValue) {
			$('#Golongan_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestions_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fill5_". $i . "(thisValue) {
			$('#Jabatan_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestions_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fill6_". $i . "(thisValue) {
			$('#SubDit_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestions_". $i . "').fadeOut();". '", 100);
		}
	</script>
	';

	echo '
	<style type="text/css" >
	#result_'. $i . ' {
		height:20px;
		font-size:12px;
		font-family:Arial, Helvetica, sans-serif;
		color:#333;
		padding:5px;
		margin-bottom:10px;
		background-color:#FFFF99;
	}
	#country_'. $i . '{
		padding:3px;
		border:1px #CCC solid;
		font-size:12px;
	}

	.suggestionsBox_'. $i . ' {
		position: absolute;
		left: autopx;
		top:autopx;
		margin: 0px 0px 0px 0px;
		width: 300px;
		padding:0px;
		background-color:#999999;
		border-top: 3px solid #999999;
		color: #fff;
	}
	.suggestionList_'. $i . ' {
		margin: 0px;
		padding: 0px;
		text-align:left;
		background-color:#10468a;
	}
	.suggestionList_'. $i . ' ul li {
		list-style:none;
		margin: 0px;
		padding: 6px;
		border-bottom:1px dotted #666;
		cursor: pointer;
	}
	.suggestionList_'. $i . ' ul li:hover {
		background-color: #FC3;
		color:#000;
	}
	ul {
		font-family:Arial, Helvetica, sans-serif;
		font-size:11px;
		color:#FFF;
		padding:0;
		margin:0;
	}

	.load_'. $i . '{
	background-image:url(app/js_auto/loader.gif);
	background-position:right;
	background-repeat:no-repeat;
	}

	#suggest_'. $i . ' {
		position:none;
	} 
	</style>
	';

	?> 
	<!--------------------------------> 

		<input type="hidden" id="jmldata2" name="jmldata2" value="10" >
				
		<tr>
			<td>			
				<input type="text" onKeyUp="suggest_<?php echo $i ?>(this.value,'app/js_auto/auto_epy.php?no=<?php echo $i ?>');" name="EpyCde_<?php echo $i ?>" onchange="fill2_<?php echo $i ?>();"  id="EpyCde_<?php echo $i ?>" value="" style="width: 150px" />
				<div class="suggestionsBox_<?php echo $i ?>" id="suggestions_<?php echo $i ?>" style="display: none;">
					<img src="app/js_auto/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
					<div class="suggestionList_<?php echo $i ?>" id="suggestionsList_<?php echo $i ?>"> &nbsp; </div>
				</div>
			</td>
			
			<td><input type="text" style="width:200px; background-color: #eeffb5"  readonly name="EpyDcr_<?php echo $i ?>" onchange="fill_<?php echo $i ?>();" id="EpyDcr_<?php echo $i ?>" value=""/></td>
			<td><input type="text" style="width:150px; background-color: #eeffb5"  readonly name="Pangkat_<?php echo $i ?>" onchange="fill3_<?php echo $i ?>();" id="Pangkat_<?php echo $i ?>" value=""/></td>
			<td><input type="text" style="width:100px; background-color: #eeffb5"  readonly name="Golongan_<?php echo $i ?>" onchange="fill4_<?php echo $i ?>();" id="Golongan_<?php echo $i ?>" value=""/></td>
			<td><input type="text" style="width:150px; background-color: #eeffb5"  readonly name="Jabatan_<?php echo $i ?>" onchange="fill5_<?php echo $i ?>();" id="Jabatan_<?php echo $i ?>" value=""/></td>
			<td><input type="text" style="width:150px; background-color: #eeffb5"  readonly name="SubDit_<?php echo $i ?>" onchange="fill6_<?php echo $i ?>();" id="SubDit_<?php echo $i ?>" value=""/></td>
		</tr>
		
				
	<?php } ?>
</table>
