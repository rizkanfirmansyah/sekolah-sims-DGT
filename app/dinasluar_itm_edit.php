<?php

$functions = new functions;

?>

<script type="text/javascript" src="../js/buttonajax.js"></script>

<script type="text/javascript">
	<!--
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
		alert(str);
		var str = str + '&button=' + button;
				
		if (window.XMLHttpRequest){
			request = new XMLHttpRequest();
			request.onreadystatechange = processStateChange;
			request.open("POST", URL, true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
			request.send(str);		
					
		} else if (window.ActiveXObject) {
			request = new ActiveXObject("Microsoft.XMLHTTP");
			if (request) {
				request.onreadystatechange = processStateChange;
				request.open("POST", URL, true);
				request.send();				
			}
		}
				
	}
	
			
	//-->	 
</script>

<script>
	function formatangka(field) {
		 //a = rci.amt.value;
		 a = document.getElementById(field).value;
		 //alert(a);
		 b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
		 c = "";
		 panjang = b.length;
		 j = 0;
		 for (i = panjang; i > 0; i--)
		 {
			 j = j + 1;
			 if (((j % 3) == 1) && (j != 1))
			 {
			 	c = b.substr(i-1,1) + "," + c;
			 } else {
			 	c = b.substr(i-1,1) + c;
			 }
		 }
		 //rci.amt.value = c;
		 c = c.replace(",.",".");
		 c = c.replace(".,",".");
		 //for (var i = 0; i < Math.floor((c.length-(1+i))/3); i++)
			//c = c.substring(0,c.length-(4*i+3))+','+
			//c.substring(c.length-(4*i+3));
		 document.getElementById(field).value = c;		
		 
	}
	
	function formatangka2(field) {
		 //a = rci.amt.value;
		 a = document.getElementById(field).value;
		 //alert(a);
		 b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
		 c = "";
		 
		 //rci.amt.value = c;
		 c = b.replace(",.",".");
		 c = b.replace(".,",".");
		 //for (var i = 0; i < Math.floor((c.length-(1+i))/3); i++)
			//c = c.substring(0,c.length-(4*i+3))+','+
			//c.substring(c.length-(4*i+3));
		 
		 document.getElementById(field).value = c;		
		 
	}
	
	function number_format(number, decimals, dec_point, thousands_sep) {
		number = (number + '')
		.replace(/[^0-9+\-Ee.]/g, '');
	  
	  var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
		  var k = Math.pow(10, prec);
		  return '' + (Math.round(n * k) / k)
			.toFixed(prec);
		};
	  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
		.split('.');
	  if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  }
	  if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1)
		  .join('0');
	  }
	  return s.join(dec);
	}
	
	//-----------change nilai
	function detailvalue(id, jmldata){		
		var qty = 0;	
		qty=document.getElementById('Qty_'+id).value; 
		//qty = number_format(qty,0,".",",");
		qty = qty.replace(/[^\d-.]/g,"");
		if(qty == "") {qty = 0};
				
		var unit_cost = 0;
		unit_cost=document.getElementById('Harga_'+id).value; 
		//unit_cost = number_format(unit_cost,0,".",",");
		unit_cost = unit_cost.replace(/[^\d-.]/g,"");
		if(unit_cost == "") {unit_cost = 0};
		
		var amount = 0;
		amount = parseFloat(qty) * parseFloat(unit_cost); //document.getElementById('amount_'+id).value; 
		amount = number_format(amount,2,".",",");	
		
		$('#JumlahHarga'+id).html('<input type="text" style="width:100px; text-align:right; background-color: #eeffb5" readonly  name="JumlahHarga_'+id+'" id="JumlahHarga_'+id+'" onkeyup="formatangka(\'JumlahHarga_'+id+'\'), sub_total('+jmldata+')" onchange="fillx7_'+id+'();" value="'+amount+'"/>');
		
		sub_total(jmldata);
		
	 }
	 
	 function sub_total(jmldata){ 
		var i=0;
		var jumlah='0';
		
		for(i=0; i<=jmldata; i++){
			
			if ( document.getElementById('JumlahHarga_'+i).value != isNaN || document.getElementById('JumlahHarga_'+i).value != 0) {				
				
				pay = document.getElementById('JumlahHarga_'+i).value.replace(/[^\d-.]/g,"");
				
				pay = pay.replace(/[^\d-.]/g,"");
				jumlah = jumlah.replace(/[^\d-.]/g,"");
				if(pay=='') {pay=0}
				jumlah 	=  parseFloat(jumlah) + parseFloat(pay);
				jumlah = number_format(jumlah,2,".",",");
													
			} 
			
		}
		
		//$('#Total2').html('<input style="text-align:right; background-color:#E2F6C5;" size="15" type="text" readonly id="Total" name="Total" value="'+ jumlah +'" " >');
		
		$('#Total2').html('<input type="text" style="width:100px; text-align:right; background-color: #eeffb5" readonly  name="Total" id="Total"  value="'+ jumlah +'"/>');	
		//grandtotal();
									
		return false
	}
	 
</script>

<table border="0">
	<tr style="font-weight: bold">
		<td>No.</td>
		<td>Kode Alat</td>
		<td>Jenis Alat</td>
		<td>Nama Tangki</td>
		<td>Jumlah</td>
		<td>Kapas.</td>
		<td>Unit</td>
		<td>Harga</td>
		<td>Jumlah</td>
		<td>Hapus</td>
	</tr>
	
	<?php 
	
	/*$jmldata = 79;
	for($i=0; $i<=$jmldata; $i++) { 
	*/
	
	$i = 0;
	$sql2=$select->list_dl_itm($ref);	
	$jmldata = odbc_num_rows($sql2);
	while($row_itm=odbc_fetch_object($sql2)) {
	
	?>
	
	<!----- auto complete ---------->
	<?php

	
	echo "
	<script>

		function suggestx_". $i . "(inputString,autosugest){
			if(inputString.length == 0) {
				$('#suggestionsx_". $i . "').fadeOut();
			} else {
			$('#countryx_". $i . "').addClass('loadx_". $i . "');
				$.post(autosugest, {queryString: ". '""+inputString+""}, function(data){
					if(data.length >0) {
						'. "$('#suggestionsx_". $i . "').fadeIn();
						$('#suggestionsListx_". $i . "').html(data);
						$('#countryx_". $i . "').removeClass('loadx_". $i ."');
					}
				});
			}
		}
		
		function fillx_". $i . "(thisValue) {
			$('#ItmDcr_". $i . "').val(thisValue);
			". 'setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}'. "

		function fillx2_". $i . "(thisValue) {
			$('#ItmCde_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fillx3_". $i . "(thisValue) {
			$('#Qty_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fillx5_". $i . "(thisValue) {
			$('#UoMCde_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fillx6_". $i . "(thisValue) {
			$('#Harga_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fillx7_". $i . "(thisValue) {
			$('#JumlahHarga_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
			
			sub_total(79);
		}
		
		'. "
		
		function fillx8_". $i . "(thisValue) {
			var Qty = 0;
			Qty = document.getElementById('Qty_". $i . "').value;
			
			var Harga = 0;
			Harga = document.getElementById('Harga_". $i . "').value;
			
			if(Qty == '') { Qty = '0'; }
			if(Harga == '') { Harga = '0'; }
			
			Qty = Qty.replace(".'".,","");'."
			Harga = Harga.replace(".'".,","");'."
			
			var Jumlah = parseFloat(Qty) * parseFloat(Harga);
			Jumlah = " . 'number_format(Jumlah,0,".",",");'."
			
			$('#JumlahHarga_". $i . "').val(Jumlah); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fillx9_". $i . "(thisValue) {
			$('#IdLab_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
			
		}
		
		'. "
		function fillx10_". $i . "(thisValue) {
			$('#Type_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
			
		}
		
		
	</script>
	';

	

	echo '
	<style type="text/css" >
	#resultx_'. $i . ' {
		height:20px;
		font-size:12px;
		font-family:Arial, Helvetica, sans-serif;
		color:#333;
		padding:5px;
		margin-bottom:10px;
		background-color:#FFFF99;
	}
	#countryx_'. $i . '{
		padding:3px;
		border:1px #CCC solid;
		font-size:12px;
	}

	.suggestionsBoxx_'. $i . ' {
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
	.suggestionListx_'. $i . ' {
		margin: 0px;
		padding: 0px;
		text-align:left;
		background-color:#10468a;
	}
	.suggestionListx_'. $i . ' ul li {
		list-style:none;
		margin: 0px;
		padding: 6px;
		border-bottom:1px dotted #666;
		cursor: pointer;
	}
	.suggestionListx_'. $i . ' ul li:hover {
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

	.loadx_'. $i . '{
	background-image:url(app/js_auto/loader.gif);
	background-position:right;
	background-repeat:no-repeat;
	}

	#suggestx_'. $i . ' {
		position:none;
	} 
	</style>
	';

	?> 
	<!--------------------------------> 

		<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >
		
		<input type="hidden" id="old_ItmCde_<?php echo $i ?>" name="old_ItmCde_<?php echo $i ?>" value="<?php echo $row_itm->ItmCde; ?>" >
		<input type="hidden" id="old_Lne2_<?php echo $i ?>" name="old_Lne2_<?php echo $i ?>" value="<?php echo $row_itm->Lne; ?>" >

		<tr>
			<td><?php echo $i + 1 ?></td>
			
			<td>			
				<input type="text" onKeyUp="suggestx_<?php echo $i ?>(this.value,'app/js_auto/auto_itm.php?no=<?php echo $i ?>');" name="ItmCde_<?php echo $i ?>" onchange="fillx2_<?php echo $i ?>();" id="ItmCde_<?php echo $i ?>" value="<?php echo $row_itm->ItmCde ?>" style="width: 90px" />
				<div class="suggestionsBoxx_<?php echo $i ?>" id="suggestionsx_<?php echo $i ?>" style="display: none;">
					<img src="app/js_auto/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
					<div class="suggestionListx_<?php echo $i ?>" id="suggestionsListx_<?php echo $i ?>"> &nbsp; </div>
				</div>
				
				
			</td>
			
			<td id="vhcsub"><input type="text" style="width:200px; background-color: #eeffb5"  readonly name="ItmDcr_<?php echo $i ?>" onchange="fillx_<?php echo $i ?>();" id="ItmDcr_<?php echo $i ?>" value="<?php echo $row_itm->ItmDcr ?>"/></td>
			
			<input type="hidden" style="width:200px; background-color: #eeffb5"  readonly name="IdLab_<?php echo $i ?>" onchange="fillx9_<?php echo $i ?>();" id="IdLab_<?php echo $i ?>" value="<?php echo $row_itm->IDLab ?>"/>
			
			<input type="hidden" style="width:200px; background-color: #eeffb5"  readonly name="Type_<?php echo $i ?>" onchange="fillx10_<?php echo $i ?>();" id="Type_<?php echo $i ?>" value="<?php echo $row_itm->Tpe ?>"/>
			
			
			
			<td><input type="text" style="width:100px; " name="TankDcr_<?php echo $i ?>" id="TankDcr_<?php echo $i ?>" value="<?php echo $row_itm->NamaObjek ?>"/></td>
			
			<td><input type="text" style="width:100px; text-align:right"  name="Qty_<?php echo $i ?>"  id="Qty_<?php echo $i ?>" onkeyup="formatangka('Qty_<?php echo $i; ?>'), detailvalue('<?php echo $i ?>', '<?php echo $jmldata ?>'), sub_total('<?php echo $jmldata; ?>')" value="<?php echo $row_itm->Qty ?>"/></td>
			
			<td><input type="text" style="width:80px; text-align:right "  name="Kapasitas_<?php echo $i ?>" id="Kapasitas_<?php echo $i ?>" onkeyup="formatangka2('Kapasitas_<?php echo $i; ?>')" value="<?php echo $row_itm->Cap ?>"/></td>
			
			<td><input type="text" style="width:50px; "  name="UoMCde_<?php echo $i ?>" id="UoMCde_<?php echo $i ?>" value="<?php echo $row_itm->UoMCde ?>"/></td>
			
			<td><input type="text" style="width:100px; text-align:right"  name="Harga_<?php echo $i ?>" id="Harga_<?php echo $i ?>" onkeyup="formatangka('Harga_<?php echo $i; ?>'), detailvalue('<?php echo $i ?>', '<?php echo $jmldata ?>'), sub_total('<?php echo $jmldata; ?>')" onchange="fillx6_<?php echo $i ?>();"  value="<?php echo $row_itm->UntPrc ?>"/></td>
			
			<td id="JumlahHarga<?php echo $i ?>"><input type="text" style="width:100px; text-align:right; background-color: #eeffb5" readonly  name="JumlahHarga_<?php echo $i ?>" id="JumlahHarga_<?php echo $i ?>" onkeyup="formatangka('JumlahHarga_<?php echo $i; ?>')" onchange="fillx7_<?php echo $i ?>();" value="<?php echo $row_itm->AmtPrc ?>"/></td>
			<td align="center">
				<input type="checkbox" id="delete2_<?php echo $i; ?>" name="delete2_<?php echo $i; ?>" value="1" >
			</td>
			
		</tr>
		
		
	<?php 
			$i++;
		} 
	
	?>
	
	
	<!-----------kosong data--------------->
	<?php 
		
	$jmldata = 79 - $jmldata;
	for($i=$i; $i<=$jmldata; $i++) { 	
	
	?>
	
	<!----- auto complete ---------->
	<?php

	/*$hasil = 0;
	
	$hasil = $functions->Formula_Tera('BR-12-14-0001', 0, 0);
	echo $hasil; */
	/*$results = odbc_exec(condb, "EXEC Formula_Tera @Ref='$result2[ItmCde]', @Kapasitas=0, @Total_Tarif=$hasil");
	echo $results;
	if(is_array($results)){
		foreach($results as $data){
			echo $data;
		}	
	}*/
	
	/*
	$stmt=odbc_prepare(condb, "{CALL Formula_Tera(?,?,?)}"); 
	$parms=odbc_execute($stmt, array('BR-12-14-0001', 0, $hasil));
	print_r($parms); */
	
	/*$query_string = " CALL FindZipCodeWithinRadius(?,?)  ";

$sp = odbc_prepare($conn, $query_string);
$zipcodes = odbc_execute($sp,array(" 14602, 35"));

print_r($zipcodes);
	*/
	/*$hasil = 0;
	$res = odbc_exec(condb, "exec Formula_Tera 'BR-12-14-0001',0,$hasil");
	$xx[] = $res;
	echo $hasil;
	for($s=0; $s<10; $s++) {
		echo $xx[$s]."<br>";
	} */
	//$res = odbc_exec($con, "exec usp_GetRelatedToID '$id'");
	
	echo "
	<script>

		function suggestx_". $i . "(inputString,autosugest){
			if(inputString.length == 0) {
				$('#suggestionsx_". $i . "').fadeOut();
			} else {
			$('#countryx_". $i . "').addClass('loadx_". $i . "');
				$.post(autosugest, {queryString: ". '""+inputString+""}, function(data){
					if(data.length >0) {
						'. "$('#suggestionsx_". $i . "').fadeIn();
						$('#suggestionsListx_". $i . "').html(data);
						$('#countryx_". $i . "').removeClass('loadx_". $i ."');
					}
				});
			}
		}
		
		function fillx_". $i . "(thisValue) {
			$('#ItmDcr_". $i . "').val(thisValue);
			". 'setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}'. "

		function fillx2_". $i . "(thisValue) {
			$('#ItmCde_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fillx3_". $i . "(thisValue) {
			$('#Qty_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fillx5_". $i . "(thisValue) {
			$('#UoMCde_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fillx6_". $i . "(thisValue) {
			$('#Harga_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fillx7_". $i . "(thisValue) {
			$('#JumlahHarga_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
			
			sub_total(79);
		}
		
		'. "
		
		function fillx8_". $i . "(thisValue) {
			var Qty = 0;
			Qty = document.getElementById('Qty_". $i . "').value;
			
			var Harga = 0;
			Harga = document.getElementById('Harga_". $i . "').value;
			
			if(Qty == '') { Qty = '0'; }
			if(Harga == '') { Harga = '0'; }
			
			Qty = Qty.replace(".'".,","");'."
			Harga = Harga.replace(".'".,","");'."
			
			var Jumlah = parseFloat(Qty) * parseFloat(Harga);
			Jumlah = " . 'number_format(Jumlah,0,".",",");'."
			
			$('#JumlahHarga_". $i . "').val(Jumlah); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
		'. "
		function fillx9_". $i . "(thisValue) {
			$('#IdLab_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
			
		}
		
		'. "
		function fillx10_". $i . "(thisValue) {
			$('#Type_". $i . "').val(thisValue); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
			
		}
		
		
	</script>
	';

	/*
	'. "
		function fillx6_". $i . "(thisValue) {
			var Qty = 0;
			Qty = document.getElementById('Qty_". $i . "').value;
			
			var Harga = 0;
			Harga = document.getElementById('Harga_". $i . "').value;
			
			if(Qty == '') { Qty = '0'; }
			if(Harga == '') { Harga = '0'; }
			
			Qty = Qty.replace(".'".,","");'."
			Harga = Harga.replace(".'".,","");'."
			
			var Jumlah = parseFloat(Qty) * parseFloat(Harga);
			Jumlah = " . 'number_format(Jumlah,0,".",",");'."
			
			$('#JumlahHarga_". $i . "').val(Jumlah); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
	*/

	/*
		'. "
		function fillx4_". $i . "(thisValue) {
			var kap = document.getElementById('ItmCde_". $i . "').value;
			$('#Kapasitas_". $i . "').val(kap); " . '
			setTimeout("'."$('#suggestionsx_". $i . "').fadeOut();". '", 100);
		}
		
		
	*/


	echo '
	<style type="text/css" >
	#resultx_'. $i . ' {
		height:20px;
		font-size:12px;
		font-family:Arial, Helvetica, sans-serif;
		color:#333;
		padding:5px;
		margin-bottom:10px;
		background-color:#FFFF99;
	}
	#countryx_'. $i . '{
		padding:3px;
		border:1px #CCC solid;
		font-size:12px;
	}

	.suggestionsBoxx_'. $i . ' {
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
	.suggestionListx_'. $i . ' {
		margin: 0px;
		padding: 0px;
		text-align:left;
		background-color:#10468a;
	}
	.suggestionListx_'. $i . ' ul li {
		list-style:none;
		margin: 0px;
		padding: 6px;
		border-bottom:1px dotted #666;
		cursor: pointer;
	}
	.suggestionListx_'. $i . ' ul li:hover {
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

	.loadx_'. $i . '{
	background-image:url(app/js_auto/loader.gif);
	background-position:right;
	background-repeat:no-repeat;
	}

	#suggestx_'. $i . ' {
		position:none;
	} 
	</style>
	';

	?> 
	<!--------------------------------> 

		<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $jmldata; ?>" >

		<tr>
			<td><?php echo $i + 1 ?></td>
			
			<td>			
				<input type="text" onKeyUp="suggestx_<?php echo $i ?>(this.value,'app/js_auto/auto_itm.php?no=<?php echo $i ?>');" name="ItmCde_<?php echo $i ?>" onchange="fillx2_<?php echo $i ?>();" id="ItmCde_<?php echo $i ?>" value="" style="width: 90px" />
				<div class="suggestionsBoxx_<?php echo $i ?>" id="suggestionsx_<?php echo $i ?>" style="display: none;">
					<img src="app/js_auto/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
					<div class="suggestionListx_<?php echo $i ?>" id="suggestionsListx_<?php echo $i ?>"> &nbsp; </div>
				</div>
				
				
			</td>
			
			<td id="vhcsub"><input type="text" style="width:200px; background-color: #eeffb5"  readonly name="ItmDcr_<?php echo $i ?>" onchange="fillx_<?php echo $i ?>();" id="ItmDcr_<?php echo $i ?>" value=""/></td>
			
			
			
			<input type="hidden" style="width:200px; background-color: #eeffb5"  readonly name="IdLab_<?php echo $i ?>" onchange="fillx9_<?php echo $i ?>();" id="IdLab_<?php echo $i ?>" value=""/>
			
			<input type="hidden" style="width:200px; background-color: #eeffb5"  readonly name="Type_<?php echo $i ?>" onchange="fillx10_<?php echo $i ?>();" id="Type_<?php echo $i ?>" value=""/>
			
			
			
			<td><input type="text" style="width:100px; " name="TankDcr_<?php echo $i ?>" id="TankDcr_<?php echo $i ?>" value=""/></td>
			
			<td><input type="text" style="width:100px; text-align:right"  name="Qty_<?php echo $i ?>"  id="Qty_<?php echo $i ?>" onkeyup="formatangka('Qty_<?php echo $i; ?>'), detailvalue('<?php echo $i ?>', '<?php echo $jmldata ?>'), sub_total('<?php echo $jmldata; ?>')" value=""/></td>
			
			<td><input type="text" style="width:80px; text-align:right "  name="Kapasitas_<?php echo $i ?>" id="Kapasitas_<?php echo $i ?>" onkeyup="formatangka2('Kapasitas_<?php echo $i; ?>')" value=""/></td>
			
			<td><input type="text" style="width:50px; "  name="UoMCde_<?php echo $i ?>" id="UoMCde_<?php echo $i ?>" value=""/></td>
			
			<td><input type="text" style="width:100px; text-align:right"  name="Harga_<?php echo $i ?>" id="Harga_<?php echo $i ?>" onkeyup="formatangka('Harga_<?php echo $i; ?>'), detailvalue('<?php echo $i ?>', '<?php echo $jmldata ?>'), sub_total('<?php echo $jmldata; ?>')" onchange="fillx6_<?php echo $i ?>();"  value=""/></td>
			
			<td id="JumlahHarga<?php echo $i ?>"><input type="text" style="width:100px; text-align:right; background-color: #eeffb5" readonly  name="JumlahHarga_<?php echo $i ?>" id="JumlahHarga_<?php echo $i ?>" onkeyup="formatangka('JumlahHarga_<?php echo $i; ?>')" onchange="fillx7_<?php echo $i ?>();" value=""/></td>
			
		</tr>
		
		
	<?php } ?>
	
	
	<tr>
		<td align="right" colspan="8">Total :&nbsp;</td>
		<td id="Total2"><input type="text" style="width:100px; text-align:right; background-color: #eeffb5" readonly  name="Total" id="Total" onkeyup="formatangka('Total')" value="<?php echo $row_dl->Ttl ?>"/></td>
		
	</tr>
</table>
