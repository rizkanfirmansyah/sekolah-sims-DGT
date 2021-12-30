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
	  
	  //proses();
	   
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
			proses();
			$("#penempatan").attr('action', '')
				.attr('target', '_self');
			$("#penempatan").submit();
			
		}
		
		
		if(tipe == 'proses') {
			if (confirm("Apakah anda yakin akan menaikan ke tingkat lebih tinggi?")){
				proses();
				$("#penempatan_view").attr('action', '')
				   .attr('target', '_self');
				$("#penempatan_view").submit();
				
				document.location.reload(true);
				
				return false;
			} else {
				return true;
			}
		}
			 
    }
    
    function proses() {
    	
    	//---------filter calon siswa
		var idproses = "";
		idproses = document.getElementById('idproses').value;
		
		var idkelompok = "";
		idkelompok = document.getElementById('idkelompok').value;
		
		
		//---------tujuan kelas
		var idangkatan1 = "";
		idangkatan1 = document.getElementById('idangkatan1').value;
		
		var idangkatan = "";
		idangkatan = document.getElementById('idangkatan').value;
		
		var idtingkat = "";
		idtingkat = document.getElementById('idtingkat').value;
		
		var idkelas = "";
		idkelas = document.getElementById('idkelas').value;
		//-----------------------
				
		
		if(idproses == "") {
			alert("Gelombang tidak boleh kosong!!!");
			
			return false
		}
		
		if(idkelompok == "") {
			alert("Kelompok tidak boleh kosong!!!");
			
			return false
		}
		
		if(idangkatan1 == "") {
			alert("Angkatan tujuan tidak boleh kosong!!!");
			
			return false
		}
		
		if(idangkatan == "") {
			alert("Tahun Ajaran tujuan tidak boleh kosong!!!");
			
			return false
		}
		
		if(idtingkat == "") {
			alert("Tingkat tujuan tidak boleh kosong!!!");
			
			return false
		}
		
		if(idkelas == "") {
			alert("Kelas tujuan tidak boleh kosong!!!");
			
			return false
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

$idproses		= $_REQUEST['idproses'];
$idkelompok		= $_REQUEST['idkelompok'];
$nopendaftaran	= $_REQUEST['nopendaftaran'];
$nama			= $_REQUEST['nama'];

$idangkatan1	= $_REQUEST['idangkatan1'];
$idangkatan		= $_REQUEST['idangkatan'];
$idtingkat		= $_REQUEST['idtingkat'];
$idkelas		= $_REQUEST['idkelas'];

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
							<form action="" method="post" name="penempatan" id="penempatan" class="form-horizontal" onsubmit="return proses()" >
								<div>
									
									<table border="0" width="100%">
										<tr>
											<td>
												<table border="0" width="100%">
													<tr align="left" style="font-weight: bold; color: #ff0000; font-size: 14px">
														<td colspan="7">Calon Siswa</td>
													</tr>
													<tr>
														<td>Gelombang *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idproses" id="idproses" style="width:auto; height:27px;" onClick="loadHTMLPost2('app/penempatan_ajax.php','idkelompok','getkelompok','idproses')" />
																<option value=""></option>
																<?php select_prosespsb($idproses); ?>
															</select>
														</td>
														
														<td>&nbsp;&nbsp;</td>
														
														<td>Kelompok *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idkelompok" id="idkelompok" style="width:auto;  height:27px; font-size:12px; padding:0px; " />
																<option value=""></option>
																<?php select_kelompokpsb($idproses,$idkelompok); ?>
															</select>
														</td>
														
													</tr>
													<tr>
														<td>No Pendaftaran</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<input type="text" name="nopendaftaran" id="nopendaftaran" style="width:150px; height:20px; font-size:12px " value="<?php echo $nopendaftaran ?>">
														</td>
														
														<td>&nbsp;&nbsp;</td>
														<td>Nama</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<input type="text" name="nama" id="nama" style="width:150px; height:20px; font-size:12px " value="<?php echo $nama ?>">	
														</td>
														
														
													</tr>
													
												</table>
											</td>
											
																				
										</tr>
										
										
										<tr>
											<td colspan="7">
												<hr>
											</td>
										</tr>
										
										<!----kelas tujuan----->	
										<tr>
											<td>
												<table border="0" width="100%">
													<tr align="left" style="font-weight: bold; color: #2914eb; font-size: 14px">
														<td colspan="7">Penempatan Tujuan</td>
													</tr>
													<tr>
														<td>Angkatan *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idangkatan1" id="idangkatan1" style="width:auto; height:27px; " />
																<option value=""></option>
																<?php select_angkatan($idangkatan1); ?>
															</select>
														</td>
														
														<td>&nbsp;&nbsp;</td>
														
														<td>Tahun Ajaran *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idangkatan" id="idangkatan" style="width:auto; height:27px; " />
																<option value=""></option>
																<?php select_thnajaran($idangkatan); ?>
															</select>
														</td>
														
													</tr>
													
													<tr>
														<td>Level *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idtingkat" id="idtingkat" style="width:auto;  height:20px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/penempatan_ajax.php','idkelas','getkelas','idtingkat')" />
																<option value=""></option>
																<?php select_tingkat($idtingkat); ?>
															</select>
														</td>
														
														<td>&nbsp;&nbsp;</td>
														<td>Kelas *)</td>
														<td>&nbsp;&nbsp;</td>
														<td>
															<select name="idkelas" id="idkelas" style="width:auto; height:27px; " />
																<option value=""></option>
																<?php select_kelas($idtingkat, $idkelas); ?>
															</select>
														</td>
														
													</tr>
													<tr>
														<td colspan="7">&nbsp;&nbsp;</td>
													</tr>
													
																										
													
												</table>
											</td>
											
										</tr>
										
										<tr>
											<td>
												<!--<input type="submit" name="submit" class='btn btn-primary' value="Find" onclick="submitForm('find')" >-->
												<input type="submit" name="submit" class="btn btn-primary" value="Find" >
											</td>										
										</tr>
										
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					
				<!---get data calon siswa----->
				<?php 
					if($post == "Find") {	
									
						include_once("penempatan_awal.php");
					} 
				?>										
				
				
				
				<!---get data kelas tujuan----->
				<?php 
					if($post == "Proses") {	
						include_once("penempatan_awal.php");
									
						include_once("penempatan_tujuan.php");
					} 
				?>										
				<!----end get-------------------->
				
				
			</div>

		</div>
	</div>
</div>