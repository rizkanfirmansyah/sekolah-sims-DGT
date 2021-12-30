<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='departemen') {
			alert('Unit tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='idtingkat') {
			alert('Level tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='idsemester') {
			alert('Semester tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='idpelajaran') {
			alert('Pelajaran tidak boleh kosong!');				
		  }
		  if (document.getElementById(arrf[i]).name=='koderpp') {
			alert('Kode tidak boleh kosong!');				
		  }
          if (document.getElementById(arrf[i]).name=='rpp') {
			alert('Materi tidak boleh kosong!');				
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

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost3(URL, destination, button, getId, getId2){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		str2 = getId2 + '=' + document.getElementById(getId2).value;	
		
		var str = str + '&button=' + button;
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
							<h3>RPP (Rencana Pelaksanaan Pembelajaran)</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="rpp" id="rpp" class="form-horizontal" onSubmit="return cekinput('departemen,idtingkat,idsemester,idpelajaran,koderpp,rpp');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_rpp.php"); 
										
										$aktif	=	"checked";
										
										if ($ref != "") {
											$sql=$select->list_rpp($ref);			
											$rpp_data=$sql->fetch(PDO::FETCH_OBJ);
											
											if($rpp_data->aktif == 1) {
												$aktif	=	"checked";
											} else {
												$aktif	=	"";
											}
                                            
                                          
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="replid" name="replid" value="<?php echo $ref ?>" >
										<tr>
											<td>Unit *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="departemen" id="departemen" style="width:auto;  height:20px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/rpp_ajax.php','idtingkat','gettingkat','departemen')" />
													<option value=""></option>
													<?php select_departemen($rpp_data->departemen); ?>
												</select>
											</td>	
										</tr>
										
										<tr>
											<td>Level *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<!--<select name="idtingkat" id="idtingkat" style="width:auto;  height:20px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/rpp_ajax.php','idkelas','getkelas','idtingkat')" />-->
												<select name="idtingkat" id="idtingkat" style="width:auto;  height:20px; font-size:12px; padding:0px; " onchange="loadHTMLPost3('app/rpp_ajax.php','idsemester','getsemester','idtingkat','departemen')" />
													<option value=""></option>
													<?php select_tingkat_unit($rpp_data->departemen, $rpp_data->idtingkat); ?>
												</select>
											</td>	
										</tr>	
										
										<tr>
											<td>Semester *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idsemester" id="idsemester" style="width:auto; height:20px; font-size:12px; padding:0px; " onchange="loadHTMLPost3('app/rpp_ajax.php','idpelajaran','getpelajaran','idtingkat','departemen')" />
													<option value=""></option>
													<?php select_semester($rpp_data->departemen, $rpp_data->idsemester); ?>
												</select>
											</td>
										</tr>	
																		
										<tr>
											<td>Pelajaran *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idpelajaran" id="idpelajaran" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_pelajaran($rpp_data->departemen, $rpp_data->idpelajaran); ?>
												</select>
											</td>
										</tr>
										
                                        <tr>
											<td>Kode RPP *)</td>
											<td>&nbsp;&nbsp;</td>
                                            <td>:</td>
											<td><input type="text" name="koderpp" id="koderpp" style="width:70px; height:16px; " value="<?php echo $rpp_data->koderpp ?>"></td>
											
										</tr>
                                        
                                        <tr>
											<td>Materi *)</td>
											<td>&nbsp;&nbsp;</td>
                                            <td>:</td>
											<td><input type="text" name="rpp" id="rpp" style="width:200px; height:16px; " value="<?php echo $rpp_data->rpp ?>"></td>
											
										</tr>
										
										<tr>
											<td>Deskripsi</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td id="deskripsi_id">
                                                <div class="box">
                                                    <div class="box-content box-nomargin">
                            							<textarea name="deskripsi" id="deskripsi" readonly="true" class='span12 cleditor'><?php echo $rpp_data->deskripsi ?></textarea>
                            						</div>
                                                </div>
                                            </td>
										</tr>
                                        
                                        <tr>
											<td>Aktif</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
                                                <input type="checkbox" name="aktif" id="aktif" value="1" style="height: 20px" <?php echo $aktif ?> />
                                            </td>	
										</tr>
										
                                        
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
												<?php if (allowupd('frmrpp')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmrpp')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmrpp')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('rpp_view') ?>'" />
												
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