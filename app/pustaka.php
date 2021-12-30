<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='judul') {
			alert('Judul tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='keyword_') {
			alert('Keyword tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='katalog') {
			alert('Katalog tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='format') {
			alert('Format tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='penulis') {
			alert('Penulis tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='penerbit') {
			alert('Penerbit tidak boleh kosong!');				
		  }
		  
		  return false
		} 
										
	  }		
	  
	  jumlah = document.getElementById('jumlah').value;
	  if(jumlah > 1) {
	  	if (confirm('Alokasi jumlah buku yang lebih dari 1 (satu), Kode Pustaka otomatis tergenerate')) {
	  		return true;
		} else {
			return false;
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
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost3(URL, destination, button, getId, getId2){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		
		var str = str + '&button=' + button;
		/*var str2 = str2 + '&button=' + button;
		var str3 = str3 + '&button=' + button;
		var str4 = str4 + '&button=' + button;*/
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
							<h3>Pustaka</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="pustaka2" id="pustaka2" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('judul,penulis,penerbit,katalog,format,keyword_');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_pustaka.php"); 
										
										$departemen = $_SESSION["unit"];
										$jumlah = 1;
										
										if ($ref != "") {
											$sql=$select->list_pustaka($ref);			
											$pustaka_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$departemen = $pustaka_data->departemen;
											$tanggal_masuk = date("d-m-Y", strtotime($pustaka_data->tanggal_masuk));
											if($tanggal_masuk == "01-01-1970") {
												$tanggal_masuk = "";
											}
											
											$harga = number_format($pustaka_data->harga,0,".",",");
											
											$jumlah = $select->list_pustaka_alokasi($pustaka_data->replid);
											
											if($jumlah == 1) {
												$kodepustaka = $select->list_pustaka_kodepustaka($pustaka_data->replid);
												$exp = explode("~", $kodepustaka);
												$kodepustaka = $exp[0];
												$iddaftarpustaka = $exp[1];
												
											}
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >
										<input type="hidden" id="iddaftarpustaka" name="iddaftarpustaka" value="<?php echo $iddaftarpustaka ?>" >
										<input type="hidden" id="old_katalog" name="old_katalog" value="<?php echo $pustaka_data->katalog ?>" >
										
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="departemen" id="departemen" class='cho' style="width:min-width:10px; height:27px; " onchange="departemen_member()" >
													<option value="">...</option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
																	
										</tr>
										
										<tr>
											<td>Kode Pustaka</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td id="kodepustaka_id"><input type="text" name="kodepustaka" id="kodepustaka" style="width:250px; height:16px; " onblur="loadHTMLPost3('app/pustaka_ajax.php','kodepustaka_id','cekkodepustaka','iddaftarpustaka','kodepustaka')" value="<?php echo $kodepustaka ?>"></td>
										</tr>
										
										<tr>
											<td>Judul *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="judul" id="judul" class='span12 input-square' rows="3"><?php echo $pustaka_data->judul ?></textarea></td>
										</tr>
										
										<tr>
											<td>Harga Satuan (<i>Rp.</i>)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="harga" id="harga" onkeyup="formatangka('harga')" style="width:120px; height:16px; text-align: right; " value="<?php echo $harga ?>"></td>
										</tr>
										
										<tr>
											<td>Katalog</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="katalog" id="katalog" class='cho' style="width:auto; height:27px; " />
													<option value="">...</option>
													<?php select_katalog($pustaka_data->katalog); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Penulis *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="penulis" id="penulis" class='cho' style="width:auto; height:27px; " />
													<option value="">...</option>
													<?php select_penulis($pustaka_data->penulis); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Penerbit *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="penerbit" id="penerbit" class='cho' style="width:auto; height:27px; " />
													<option value="">...</option>
													<?php select_penerbit($pustaka_data->penerbit); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Tahun Terbit</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="tahun" id="tahun" onkeyup="formatangka('tahun')" style="width:80px; height:16px; " value="<?php echo $pustaka_data->tahun ?>"></td>
										</tr>
										
										<tr>
											<td>Format *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="format" id="format" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_format($pustaka_data->format); ?>
												</select>	
											</td>
										</tr>
										
										<tr>
											<td>Keyword *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="keyword_" id="keyword_" style="width:250px; height:16px; " value="<?php echo $pustaka_data->keyword ?>"></td>
										</tr>
										
										<tr>
											<td>Keterangan Fisik</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="keteranganfisik" id="keteranganfisik" class='span12 input-square' rows="3"><?php echo $pustaka_data->keteranganfisik ?></textarea></td>
										</tr>
										
										<tr>
											<td>Gambar Cover</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<input type="file" id="photo" name="photo" >
												
												<?php if ($pustaka_data->photo != "") { ?>
													<img src="app/file_foto_pustaka/<?php echo $pustaka_data->photo ?>" width="200" height="200" />
												<?php } ?>
												<input type="hidden" id="photo2" name="photo2" value="<?php echo $pustaka_data->photo; ?>" >
											</td>
										</tr>
										
										<tr>
											<td>Abstraksi</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="abstraksi" id="abstraksi" class='span12 input-square' rows="3"><?php echo $pustaka_data->abstraksi ?></textarea></td>
										</tr>
										
										<tr>
											<td>Keterangan Tambahan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="keterangan" id="keterangan" class='span12 input-square' rows="3"><?php echo $pustaka_data->keterangan ?></textarea></td>
										</tr>
										
										<tr>
											<td>Alokasi Jumlah Buku</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="jumlah" id="jumlah" onkeyup="formatangka('harga')" style="width:50px; height:16px; " value="<?php echo $jumlah ?>"></td>
										</tr>
										
										<?php if($ref!='') { ?>
											<tr>
												<td>Tambah Jumlah Buku</td>
												<td>&nbsp;&nbsp;</td>
												<td>:</td>
												<td><input type="text" name="jumlah2" id="jumlah2" onkeyup="formatangka('harga')" style="width:50px; height:16px; " value=""></td>
											</tr>
										<?php } ?>
										
										<tr>
											<td>Tanggal Masuk</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="tanggal_masuk" class='datepick' id="tanggal_masuk" style="width:100px; height:16px; " value="<?php echo $tanggal_masuk ?>"></td>
										</tr>
										
										<tr>
											<td>Keterangan Pustaka</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="keterangan_pustaka" id="keterangan_pustaka" class='cho' style="width:auto; height:27px; " />
													<option value="">...</option>
													<?php select_ket_pustaka($pustaka_data->keterangan_pustaka); ?>
												</select>
											</td>
										</tr>
										
										
										<tr>											
											<td colspan="5">
												&nbsp;
											</td>
													
										</tr>
										
										<tr>
											<td colspan="2" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;Toko/Supplier</h4>
											</td>
										</tr>
										<?php 
											if($ref == "") {
												include("pustaka_supplier.php");
											} else {
												include("pustaka_supplier_update.php");
											} 
										?>
										
										<tr>
											<td>&nbsp;&nbsp;</td>											
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
												<?php if (allowupd('frmpustaka')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmpustaka')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmpustaka')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('pustaka_view') ?>'" />
												
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