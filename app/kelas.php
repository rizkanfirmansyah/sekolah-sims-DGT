<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='kelas') {
			alert('Level tidak boleh kosong!');				
		  }
		  
		  
		  return false
		} 
										
	  }		 
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

$ref = $segmen3;

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Kelas</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="kelas2" id="kelas2" class="form-horizontal" onSubmit="return cekinput('kelas');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_kelas.php"); 
										
										$act = "checked";
										if ($ref != "") {
											$sql=$select->list_kelas($ref);			
											$kelas_data=$sql->fetch(PDO::FETCH_OBJ);
											
											if ($kelas_data->aktif == 1) {
												$act = "checked";
											} else {
												$act = "";
											}
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >
										
										<tr>
											<td>Unit *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="departemen" id="departemen" style="width:auto; height:27px; " onchange="loadHTMLPost2('app/kelas_ajax.php','idtingkat2','gettingkat','departemen')" />
													<option value=""></option>
													<?php select_departemen($kelas_data->departemen); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Level *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td id="idtingkat2">
												<select name="idtingkat" id="idtingkat" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_tingkat_unit($kelas_data->departemen, $kelas_data->idtingkat); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Tahun Ajaran *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idtahunajaran" id="idtahunajaran" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_thnajaran($kelas_data->idtahunajaran); ?>
												</select>
											</td>
										</tr>
												
										<tr>
											<td>Kelas *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="kelas" id="kelas" style="width:250px; height:16px; " value="<?php echo $kelas_data->kelas ?>"></td>
										</tr>
										
										<tr>
											<td>Kapasitas</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="kapasitas" id="kapasitas" style="width:250px; height:16px; " value="<?php echo $kelas_data->kapasitas ?>"></td>
										</tr>
										
										<tr>
											<td>Wali Kelas</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="nipwali" id="nipwali" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_pegawai($kelas_data->nipwali); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Aktif</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="checkbox" name="aktif" id="aktif" style="width:70px; height:16px; " value="1" <?php echo $act ?> ></td>	
										</tr>
										
										<tr>
											<td>Keterangan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="keterangan" id="keterangan" class='span12 input-square' rows="3"><?php echo $kelas_data->keterangan ?></textarea></td>
										</tr>
										
										<!--<tr>
											<td>Urutan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="urutan" id="urutan" style="width:250px; height:16px; " value="<?php echo $kelas_data->urutan ?>"></td>
										</tr>-->
										
										<tr>
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>									
										</tr>
										
									</table>
									
									
									<table>
										<tr>
											<td colspan="3">&nbsp;&nbsp;</td>								
										</tr>
										
										<tr>											
											<td colspan="3">
												<?php if (allowupd('frmkelas')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmkelas')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmkelas')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('kelas_view') ?>'" />
												
											</td>
													
										</tr>
									</table>
									
								</div>								
							
						</div>	
						
								
										
						
						
						</form>
						
						<!--------------end Detail------------------ -->
					</div>
					
			</div>

		</div>
	</div>
</div>