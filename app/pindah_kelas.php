<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	//var x = "";
	function cekinput(fid) {  
		
	 /* var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='idangkatan') {
			alert('Angkatan tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='idtingkat') {
			alert('Tingkat tidak boleh kosong!');				
		  }
		  		  
		  return false
		} 
										
	  }	*/	
	  
	  //prosesnaik();
	   
	}	
</script>

<script>
    function submitForm(tipe)
    {
		/*if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#delord_view").attr('action', 'app/delord_print.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
		if(tipe == 'find') {
			prosesnaik();
			$("#pindah_kelas").attr('action', '')
				.attr('target', '_self');
			$("#pindah_kelas").submit();
			
		}
		
		
		if(tipe == 'prosesnaik') {
			if (confirm("Apakah anda yakin siswa pindah kelas?")){
				prosesnaik();
				$("#pindah_kelas_view").attr('action', '')
				   .attr('target', '_self');
				$("#pindah_kelas_view").submit();
				
				document.location.reload(true);
				
				return false;
			} else {
				return true;
			}
		}
			 
    }
    
    function prosesnaik() {
		var idangkatan = "";
		idangkatan = document.getElementById('idangkatan').value;
		
		var idtingkat = "";
		idtingkat = document.getElementById('idtingkat').value;
		
		var idkelas = "";
		idkelas = document.getElementById('idkelas').value;
		
		if(idkelas == "") {
			alert("Kelas Awal tidak boleh kosong!!!");
			
			return false
		}
		//-----------------------
				
		var idangkatan2 = "";
		idangkatan2 = document.getElementById('idangkatan2').value;
		
		var idtingkat2 = "";
		idtingkat2 = document.getElementById('idtingkat2').value;
		
		var idkelas2 = "";
		idkelas2 = document.getElementById('idkelas2').value;
		
		if(idangkatan == "") {
			alert("Tahun Ajaran Awal tidak boleh kosong!!!");
			
			return false
		}
		
		if(idtingkat == "") {
			alert("Tingkat Awal tidak boleh kosong!!!");
			
			return false
		}
		
		if(idangkatan != "" && idtingkat != "") {
			if(idangkatan2 == "") {
				alert("Tahun Ajaran Tujuan tidak boleh kosong!!!");
				
				return false
			}
			
			if(idtingkat2 == "") {
				alert("Tingkat Tujuan tidak boleh kosong!!!");
				
				return false
			}
			
			if(idkelas2 == "") {
				alert("Kelas Tujuan tidak boleh kosong!!!");
				
				return false
			}
			
			if(idkelas == idkelas2) {
				alert("Kelas tidak boleh sama !!!");
				
				return false
			}
			
			/*if(idtingkat == idtingkat2) {
				alert("Level Tujuan tidak boleh sama !!!");
				
				return false
			}*/
		}
		
		//return false
	} 
	
	function timedRefresh(timeoutPeriod) {
		setTimeout("location.reload(true);",timeoutPeriod);
	}
		
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
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
	 
</script>

<?php

$idangkatan	= $_REQUEST['idangkatan'];
$idtingkat	= $_REQUEST['idtingkat'];
$idkelas	= $_REQUEST['idkelas'];
$nis		= $_REQUEST['nis'];
$nama		= $_REQUEST['nama'];
$all		= $_REQUEST['all'];

$idangkatan2= $_REQUEST['idangkatan2'];
$idtingkat2	= $_REQUEST['idtingkat2'];
$idkelas2	= $_REQUEST['idkelas2'];

$all2 = "";
if($all == 1) {
	$all2 = "checked";
}

$post	= $_POST['submit'];
	
?>


<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Filter</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="pindah_kelas" id="pindah_kelas" class="form-horizontal" onsubmit="return prosesnaik()" >
								<div>
									
									<table border="0">
										<tr>
											<td>
												<table>
													<tr align="left" style="font-weight: bold; color: #ff0000; font-size: 14px">
														<td colspan="7">Level & Kelas Awal</td>
													</tr>
													<tr>
														<td>Tahun Ajaran *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idangkatan" id="idangkatan" style="width:auto; height:27px; " />
																<option value=""></option>
																<?php select_thnajaran_all($idangkatan); ?>
															</select>
														</td>
														
														<td>&nbsp;&nbsp;</td>
														
														<td>Level *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idtingkat" id="idtingkat" style="width:auto;  height:27px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/pindah_kelas_ajax.php','idkelas','getkelas','idtingkat')" />
																<option value=""></option>
																<?php select_tingkat($idtingkat); ?>
															</select>
														</td>
														
													</tr>
													<tr>
														<td>Kelas *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idkelas" id="idkelas" style="width:auto; height:27px; " />
																<option value=""></option>
																<?php select_kelas($idtingkat, $idkelas); ?>
															</select>
														</td>
														
														<td>&nbsp;&nbsp;</td>
														<td>NIS</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<input type="text" name="nis" id="nis" style="width:150px; height:20px; font-size:12px " value="<?php echo $nis ?>">
														</td>
														
														
													</tr>
													<tr>
														<td>Nama</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<input type="text" name="nama" id="nama" style="width:150px; height:17px; font-size:12px " value="<?php echo $nama ?>">	
														</td>
														
														<td colspan="4">&nbsp;&nbsp;</td>
																									
													</tr>
													
													<tr>
														<td>
															<!--<input type="submit" name="submit" class='btn btn-primary' value="Find" onclick="submitForm('find')" >-->
															<input type="submit" name="submit" class="btn btn-primary" value="Find" >
														</td>										
													</tr>
												</table>
											</td>
											
											<td width="50">&nbsp;</td>
											<!----kelas tujuan----->
											<td>
												<table>
													<tr align="left" style="font-weight: bold; color: #2914eb; font-size: 14px">
														<td colspan="7">Level & Kelas Tujuan</td>
													</tr>
													<tr>
														<td>Tahun Ajaran *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idangkatan2" id="idangkatan2" style="width:auto; height:27px; " />
																<option value=""></option>
																<?php select_thnajaran($idangkatan2); ?>
															</select>
														</td>
														
														<td>&nbsp;&nbsp;</td>
														
														<td>Level *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idtingkat2" id="idtingkat2" style="width:auto;  height:27px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/pindah_kelas_ajax.php','idkelas2','getkelas2','idtingkat2')" />
																<option value=""></option>
																<?php select_tingkat($idtingkat2); ?>
															</select>
														</td>
														
													</tr>
													<tr>
														<td>Kelas Tujuan *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idkelas2" id="idkelas2" style="width:auto; height:27px; " />
																<option value=""></option>
																<?php select_kelas($idtingkat2, $idkelas2); ?>
															</select>
														</td>
														
														<td colspan="4">&nbsp;&nbsp;</td>
														
													</tr>
													<tr>
														<td colspan="7">&nbsp;&nbsp;</td>
													</tr>
													<tr>
														<td colspan="7">&nbsp;&nbsp;</td>
													</tr>
																										
													
												</table>
											</td>
											
										</tr>
										
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					
				<!---get data tingkat awal----->
				<?php 
					if($post == "Find") {	
									
						include_once("pindah_kelas_awal.php");
					} 
				?>										
				
				
				
				<!---get data tingkat tujuan----->
				<?php 
					if($post == "Proses Pindah Kelas") {	
						include_once("pindah_kelas_awal.php");
									
						//include_once("pindah_kelas_tujuan.php");
					} 
				?>										
				<!----end get-------------------->
				
				
			</div>

		</div>
	</div>
</div>