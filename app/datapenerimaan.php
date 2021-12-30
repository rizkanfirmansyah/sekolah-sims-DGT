<!--<script src="js/pindah.js"></script>-->
<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='idkategori') {
			alert('Kategori tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='departemen') {
			alert('Departemen tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Nama tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='rekkas') {
			alert('Rek. Kas tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='rekpendapatan') {
			alert('Rek. Pendapatan tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='rekpiutang') {
			alert('Rek. Piutang tidak boleh kosong!');				
		  }
		  
		  
		  return false
		} 
										
	  }		 
	}	
	
	
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
</script>

<script type="text/javascript">
	<!--
	var request;
	var dest;
	
	function loadHTMLPost3(URL, destination, button, getId, getId2, getId3, getId4){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		str3 = getId3 + '=' + document.getElementById(getId3).value;
		str4 = getId4 + '=' + document.getElementById(getId4).value;
		
		var str = str + '&button=' + button;
		/*var str2 = str2 + '&button=' + button;
		var str3 = str3 + '&button=' + button;
		var str4 = str4 + '&button=' + button;*/
		var str = str + '&' + str2 + '&' + str3 + '&' + str4;
			
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

$ref = $segmen3;

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Jenis Penerimaan</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="datapenerimaan2" id="datapenerimaan2" class="form-horizontal" onSubmit="return cekinput('idkategori,departemen,nama,rekkas,rekpendapatan,rekpiutang');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_datapenerimaan.php"); 
										
										$act = "checked";
										$full = "";
										if ($ref != "") {
											$sql=$select->list_datapenerimaan($ref);			
											$datapenerimaan_data=$sql->fetch(PDO::FETCH_OBJ);
											
											if ($datapenerimaan_data->aktif == 1) {
												$act = "checked";
											} else {
												$act = "";
											}
											
											if ($datapenerimaan_data->full == 1) {
												$full = "checked";
											}
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >
										<input type="hidden" id="oldnama" name="oldnama" value="<?php echo $datapenerimaan_data->nama ?>" >
										<input type="hidden" id="olddepartemen" name="olddepartemen" value="<?php echo $datapenerimaan_data->departemen ?>" >
										<input type="hidden" id="oldidkategori" name="oldidkategori" value="<?php echo $datapenerimaan_data->idkategori ?>" >
										
										<tr>
											<td>Unit *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td id="departemen_id">
												<select name="departemen" id="departemen" style="width:auto; height:27px; " onchange="loadHTMLPost3('app/datapenerimaan_ajax.php','departemen_id','cekdepartemen', 'id', 'departemen','idkategori', 'nama')" >
													<option value=""></option>
													<?php select_departemen($datapenerimaan_data->departemen); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Kategori *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td id="idkategori_id">
												<select name="idkategori" id="idkategori" style="width:auto; height:27px; " onchange="loadHTMLPost3('app/datapenerimaan_ajax.php','idkategori_id','cekidkategori', 'id', 'departemen','idkategori', 'nama')" >
													<option value=""></option>
													<?php select_kategoripenerimaan($datapenerimaan_data->idkategori); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Nama *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td id="nama_id"><input type="text" name="nama" id="nama" style="width:250px; height:16px; " value="<?php echo $datapenerimaan_data->nama ?>" onblur="loadHTMLPost3('app/datapenerimaan_ajax.php','nama_id','ceknama', 'id', 'departemen','idkategori', 'nama')" ></td>
										</tr>
										
										<tr>
											<td>Rek. Kas *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="rekkas" id="rekkas" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_rekakun('HARTA', $datapenerimaan_data->rekkas); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Rek. Pendapatan *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="rekpendapatan" id="rekpendapatan" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_rekakun('PENDAPATAN', $datapenerimaan_data->rekpendapatan); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Rek. Piutang *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="rekpiutang" id="rekpiutang" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_rekakun('PIUTANG', $datapenerimaan_data->rekpiutang); ?>
												</select>
											</td>
										</tr>
												
										<tr>
											<td>Keterangan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="keterangan" id="keterangan" class='span12 input-square' rows="3"><?php echo $datapenerimaan_data->keterangan ?></textarea></td>
										</tr>
										
										<tr>
											<td>Urutan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="nourut" id="nourut" style="width:250px; height:16px; " onkeyup="formatangka('nourut')" value="<?php echo $datapenerimaan_data->nourut ?>"></td>
										</tr>
										
										<tr>
											<td>Harus Lunas</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="checkbox" name="full" id="full" style="width:70px; height:16px; " value="1" <?php echo $full ?> ></td>	
										</tr>
										
										<tr>
											<td>Aktif</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="checkbox" name="aktif" id="aktif" style="width:70px; height:16px; " value="1" <?php echo $act ?> ></td>	
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
												<?php if (allowupd('frmdatapenerimaan')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmdatapenerimaan')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmdatapenerimaan')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('datapenerimaan_view') ?>'" />
												
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