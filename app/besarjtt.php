<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='idpenerimaan') {
			alert('Jenis Penerimaan tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='departemen') {
			alert('Departemen tidak boleh kosong!');				
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
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId, getId2){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
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
							<h3>Setup Pembayaran</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="besarjtt2" id="besarjtt2" class="form-horizontal" onSubmit="return cekinput('idpenerimaan,departemen');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_besarjtt.php"); 
										
										$status = "BELUM LUNAS";
										$tgljurnal = date("d-m-Y");
										if ($ref != "") {
											
											$sql=$select->list_besarjtt($ref);			
											$besarjtt_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$tgljurnal = date("d-m-Y", strtotime($besarjtt_data->tgljurnal));
											if($tgljurnal == '01-01-1970') {
												$tgljurnal = date("d-m-Y");
											}
											
											if ($besarjtt_data->lunas == 1) {
												$status = "LUNAS";
											}
											
											$idangkatan		=	$besarjtt_data->idangkatan;
											$departemen		=	$besarjtt_data->departemen;
											$idkategori		=	$besarjtt_data->idkategori;
											$idpenerimaan	=	$besarjtt_data->idpenerimaan;
											$nis			=	$besarjtt_data->nis;
											$nama			=	$besarjtt_data->namasiswa;
											$kelas			=	$besarjtt_data->tingkat . '-' . $besarjtt_data->kelas;
											
											$nis2 = explode("|", $ref);
											if($nis2[0] == 'NIS') {
												$nis 			= $nis2[1];
												$idkategori 	= $nis2[2];
												$departemen 	= $nis2[3];
												$idpenerimaan 	= $nis2[4];
											}
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="id" name="id" value="<?php echo $besarjtt_data->replid ?>" >
										<input type="hidden" id="nis" name="nis" value="<?php echo $nis ?>" >
										<input type="hidden" id="idtingkat" name="idtingkat" value="<?php echo $besarjtt_data->idtingkat ?>" >
										<input type="hidden" id="idkelas" name="idkelas" value="<?php echo $besarjtt_data->idkelas ?>" >
										<input type="hidden" id="old_tahunbuku" name="old_tahunbuku" value="<?php echo $besarjtt_data->info2 ?>" >
										
										<tr>
											<td>NIS</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td style="color: #0e07f8; font-weight: bold;"><?php echo $nis ?></td>	
										</tr>
										
										<tr>
											<td>Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td style="color: #0e07f8; font-weight: bold;"><?php echo $nama ?></td>	
										</tr>
										
										<tr>
											<td>Level-Kelas</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td style="color: #0e07f8; font-weight: bold;"><?php echo $kelas ?></td>	
										</tr>
										
										<tr>
											<td>Tahun Ajaran</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idangkatan" id="idangkatan" style="width:auto;  height:27px; padding:0px; " />
													<?php select_thnajaran($idangkatan); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td colspan="4">&nbsp;&nbsp;</td>		
										</tr>
										
										<tr>
											<td style="color: #169216; font-weight: bold; font-size: 16px">Semua Siswa</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="checkbox" name="semua" id="semua" style="width:70px; height:16px; " value="1" ><i style="font-size: 11px; color: #ff0000">*) Jika dicentang, maka semua siswa dengan tingkat dan kelas tersebut akan diseting.</i></td>
										</tr>
										
										<tr>
											<td colspan="4">&nbsp;&nbsp;</td>		
										</tr>
																				
										<tr>
											<td>Departemen *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="departemen" id="departemen" style="width:auto; height:27px; " />
													<?php select_departemen($departemen); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Kategori *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idkategori" id="idkategori" style="width:auto; height:27px; " onClick="loadHTMLPost2('app/besarjtt_ajax.php','idpenerimaan','getkategori','idkategori','departemen')" />
													<option value=""></option>
													<?php select_kategoripenerimaan($idkategori); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Jenis Penerimaan *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="idpenerimaan" id="idpenerimaan" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_datapenerimaan($idkategori, $departemen, $idpenerimaan); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Jumlah Bayar</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="besar" id="besar" style="width:250px; height:16px; " onkeyup="formatangka('besar')" value="<?php echo number_format($besarjtt_data->besar,'0','.',',') ?>"></td>
										</tr>
										
										<tr>
											<td>Besar Cicilan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="cicilan" id="cicilan" style="width:250px; height:16px; " onkeyup="formatangka('cicilan')" value="<?php echo number_format($besarjtt_data->cicilan,'0','.',',') ?>"></td>
										</tr>
										
										<tr>
											<td>Potongan/Beasiswa</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="potongan" id="potongan" style="width:250px; height:16px; " onkeyup="formatangka('potongan')" value="<?php echo number_format($besarjtt_data->potongan,'0','.',',') ?>"></td>
										</tr>
										
										<tr>
											<td>Tanggal Jurnal</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="tgljurnal" id="tgljurnal" style="width:250px; height:16px; " readonly value="<?php echo $tgljurnal ?>"></td>
										</tr>
												
										<tr>
											<td>Keterangan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="keterangan" id="keterangan" class='span12 input-square' rows="3"><?php echo $besarjtt_data->keterangan ?></textarea></td>
										</tr>
																				
										<tr>
											<td>Status</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td style="color: #0e07f8; font-weight: bold;"><?php echo $status ?></td>	
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
												<?php if (allowupd('frmbesarjtt')==1) { ?>
													<?php if($ref!='' && $besarjtt_data->replid !='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } else { ?>
														<?php if (allowadd('frmbesarjtt')==1) { ?>
															<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
														<?php } ?>
													<?php } ?>
												<?php } ?>
												
												<!--<?php if (allowadd('frmbesarjtt')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>-->
												
												<?php if (allowdel('frmbesarjtt')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('besarjtt_view') ?>'" />
												
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