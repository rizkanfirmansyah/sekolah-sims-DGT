<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='idpelajaran') {
			alert('Ektrakurikuler tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='tanggal') {
			alert('Periode tidak boleh kosong!');				
		  }
		  
		  return false
		} 
										
	  }		 
	}	
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
		 document.getElementById(field).value = c;		
		 
	}
	
    function submitForm(tipe)
    {
		/*if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#delord_view").attr('action', 'app/delord_print.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
		if(tipe == 'find') {
			$("#laborder").attr('action', '')
				.attr('target', '_self');
			$("#laborder").submit();
		}
		
		if(tipe == 'list') {
			$("#dinasluar").attr('action', "main.php?menu=app&act=dinasluar_view")
				.attr('target', '_self');
			$("#dinasluar").submit();
		}
		
		/*if(tipe == 'excel') {
			$("#delord_view").attr('action', 'app/delord_xls.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
  		return false;	 
    }
		
</script>

<script type="text/javascript">
	function hapus(id, idpeg) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('siswa_ekstrakurikuler') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+"&c="+idpeg+" ";
		}
	}
</script>

<!--<script type="text/javascript" src="jsdynamic/jquery.min.js"></script>-->

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

<script type="text/javascript">
	<!--
	var request;
	var dest;
	
	function loadHTMLPost3(URL, destination, button, getId, getId2){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		
		var str = str + '&button=' + button;
		var str2 = str2 + '&button=' + button;
		var str = str + '&' + str2;
				
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

<?php

$ref 	= $_GET['search'];	
$push	= $_GET['a'];			

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>EKSTRAKURIKULER</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="siswa_ekstrakurikuler" id="siswa_ekstrakurikuler" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('idpelajaran,tanggal');">
								<div>
									<?php
										$delete = $_REQUEST['mxKz'];
										if ($delete == "xm8r389xemx23xb2378e23") {
											include 'class/class.delete.php';
											$delete2=new delete;
											$delete2->delete_siswa_ekstrakurikuler($_REQUEST['id'], $_REQUEST['c']);
											$idsiswa = $_REQUEST['c'];
									?>
											<div class="alert alert-success">
												<strong>Delete Data successfully</strong>
											</div>
									<?php
										}
									?>
									
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
										
										include("app/exec/insert_siswa_ekstrakurikuler.php"); 
										
										$tanggal_efektif = date("d-m-Y");
										$rowsjbt = 0;
										$replidjbt = 0;
										if ($ref != "") {
											$sql=$select->list_siswa_ekstrakurikuler($ref);			
											$siswa_ekstrakurikuler=$sql->fetch(PDO::FETCH_OBJ);
											
											$idsiswa 	= $siswa_ekstrakurikuler->replid;
											$bagian		= 	str_replace(" ","|",$siswa_ekstrakurikuler->bagian);
											
											//------pegawai jabatan checked
											if($push == 'e') {
												$sql2=$select->list_get_siswa_ekstrakurikuler($idsiswa);
												$siswa_ekstrakurikuler2=$sql2->fetch(PDO::FETCH_OBJ);
											}
											
											$replidjbt 		= $siswa_ekstrakurikuler2->replid; 
											$tanggal= date("d-m-Y", strtotime($siswa_ekstrakurikuler2->tanggal));											
											if($tanggal=='01-01-1970') { $tanggal = date("d-m-Y"); }
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="id" name="id" value="<?php echo $siswa_ekstrakurikuler->replid ?>" >
										<input type="hidden" id="idsiswa" name="idsiswa" value="<?php echo $idsiswa ?>" >
										<input type="hidden" id="departemen" name="departemen" value="<?php echo $siswa_ekstrakurikuler->departemen ?>" >
										
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen2" id="departemen2" disabled="" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_departemen($siswa_ekstrakurikuler->departemen); ?>
												</select>
											</td>		
										</tr>
										
										<tr>
											<td>NIS</td>
											<td>&nbsp;&nbsp;</td>
											<td id="nip_id"><input type="text" name="nis" id="nis" readonly="" style="width:100px; height:16px;" value="<?php echo $siswa_ekstrakurikuler->nis; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nama" id="nama" readonly="" style="width:250px; height:16px;" value="<?php echo $siswa_ekstrakurikuler->nama; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Level</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="tingkat" id="tingkat" readonly="" style="width:250px; height:16px;" value="<?php echo $siswa_ekstrakurikuler->tingkat; ?>" >
											</td>		
										</tr>
										
										<tr>
											<td>Kelas</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="kelas" id="kelas" readonly="" style="width:250px; height:16px;" value="<?php echo $siswa_ekstrakurikuler->kelas; ?>" >
											</td>		
										</tr>
										
										<tr>
											<td>Ekstrakurikuler *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idpelajaran" id="idpelajaran" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_ekstrakurikuler($siswa_ekstrakurikuler->idpelajaran); ?>
												</select>
											</td>		
										</tr>
										
										<tr>
											<td>Periode *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tanggal" id="tanggal" class="datepick" style="width:100px; height:16px;" value="<?php echo $tanggal; ?>" ></td>
											
										</tr>
										
										<tr>											
											<td colspan="3">
												&nbsp;
											</td>
													
										</tr>
										
									</table>
									
									
									
									<table>
										<tr>											
											<td colspan="3">
												<?php if (allowupd('frmsiswa_ekstrakurikuler')==1) { ?>
													<?php if($push == 'e') { ?>
													
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmsiswa_ekstrakurikuler')==1) { ?>
													<?php if($push == 'a') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php /* if (allowdel('frmsiswa_ekstrakurikuler')==1) { ?>	
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } */ ?>
												
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('siswa_ekstrakurikuler_view') ?> '" />
											
											</td>
													
										</tr>
										
										<tr>
											<td colspan="3">&nbsp;</td>
										</tr>
									</table>
									
									
									<?php
										include("siswa_ekstrakurikuler_detail.php")
									?>
									
								</div>								
							
						</div>	
						
						</form>
						
						<!--------------end Detail------------------ -->
					</div>
					
			</div>

		</div>
	</div>
</div>