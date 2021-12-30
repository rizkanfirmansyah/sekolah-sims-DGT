<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='nip') {
			alert('NIP tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Nama Pegawai tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='bagian') {
			alert('Bagian tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='kelamin') {
			alert('Jenis Kelamin tidak boleh kosong!');				
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

$ref = $_GET['search'];				

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>PEGAWAI</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="pegawai" id="pegawai" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('bagian,nip,nama,kelamin');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
										
										$ref2 = notran(date('y-m-d'), 'frmpegawai', '', '', ''); //---get no ref
										
										include("app/exec/insert_pegawai.php"); 
										
										if ($ref != "") {
											$sql=$select->list_pegawai($ref);			
											$pegawai=$sql->fetch(PDO::FETCH_OBJ);
											
											$replid 		= $pegawai->replid;
											$tgllahir		= date("d-m-Y", strtotime($pegawai->tgllahir));
											
											if($tgllahir=='01-01-1970') { $tgllahir = ''; }
											
											if($pegawai->nikah == "sudah") { $nikah = "checked"; }
											if($pegawai->nikah == "belum") { $nikah1 = "checked"; }
											
											$bagian		= 	str_replace(" ","|",$pegawai->bagian);
											
											$idjenis_sertifikasi = $pegawai->idjenis_sertifikasi;
											
											$tmt_cpns		= date("d-m-Y", strtotime($pegawai->tmt_cpns));
											if($tmt_cpns=='01-01-1970') { $tmt_cpns = ''; }
											
											$unit_cpns		= date("d-m-Y", strtotime($pegawai->unit_cpns));	
											if($unit_cpns=='01-01-1970') { $unit_cpns = ''; }	
											
											$tanggal_lahir_pasangan = date("d-m-Y", strtotime($pegawai->tanggal_lahir_pasangan));
											if($tanggal_lahir_pasangan=='01-01-1970') { $tanggal_lahir_pasangan = ''; }
											$tanggal_nikah	= date("d-m-Y", strtotime($pegawai->tanggal_nikah));	
											if($tanggal_nikah=='01-01-1970') { $tanggal_nikah = ''; }								
											$tanggal_pensiun = date("d-m-Y", strtotime($pegawai->tanggal_pensiun));	
											if($tanggal_pensiun=='01-01-1970') { $tanggal_pensiun = ''; }
											
											$tgllahir_usia = date("Y-m-d", strtotime($tgllahir));
											$usia = datediff($tgllahir_usia, date("Y-m-d"));
											$usia = $usia["years"];
											
											$tanggal_sk_tetap = date("d-m-Y", strtotime($pegawai->tanggal_sk_tetap));
											if($tanggal_sk_tetap=='01-01-1970') { $tanggal_sk_tetap = ''; }
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="id" name="id" value="<?php echo $pegawai->replid ?>" >
										<input type="hidden" id="old_nip" name="old_nip" value="<?php echo $pegawai->nip ?>" >
										
										<tr>
											<td>Bagian *)</td>
											<td>:</td>
											<td>
												<select name="bagian" id="bagian" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_bagianpegawai($bagian); ?>
												</select>
											</td>		
											
											<td style="width: 40px;"></td>
											
											<td colspan="3" rowspan="6" align="center" valign="top" >Photo
												<input type="file" id="foto_file" name="foto_file" >
												<input type="hidden" id="foto_file2" name="foto_file2" value="<?php echo $pegawai->foto_file; ?>" ><br>
												<?php if($pegawai->foto_file != "") { ?>
													<img src="app/file_foto_pegawai/<?php echo $pegawai->foto_file; ?>" height="150" width="130" >
												<?php } ?>
												
											</td>
											
										</tr>
										
										<tr>
											<td>NIP *)</td>
											<td>:</td>
											<td id="nip_id"><input type="text" name="nip" id="nip" style="width:100px; height:16px;" value="<?php echo $pegawai->nip; ?>" onblur="loadHTMLPost3('app/pegawai_ajax.php','nip_id','ceknip','old_nip','nip')" ></td>
										</tr>
										
										<tr>
											<td>Nama *)</td>
											<td>:</td>
											<td><input type="text" name="nama" id="nama" style="width:250px; height:16px;" value="<?php echo $pegawai->nama; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Nama Panggilan</td>
											<td>:</td>
											<td><input type="text" name="panggilan" id="panggilan" style="width:250px; height:16px;" value="<?php echo $pegawai->panggilan; ?>" ></td>
											
											
										</tr>
										
										<tr>
											<td>Jenis Kelamin *)</td>
											<td>:</td>
											<td>
												<select name="kelamin" id="kelamin" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_kelamin($pegawai->kelamin); ?>
												</select>
											</td>	
										</tr>
										
										<tr>
											<td>Gelar</td>
											<td>:</td>
											<td><input type="text" name="gelar" id="gelar" style="width:250px; height:16px;" value="<?php echo $pegawai->gelar; ?>" ></td>
											
											
											
										</tr>
										
										<tr>
											<td>Tempat Lahir</td>
											<td>:</td>
											<td><input type="text" name="tmplahir" id="tmplahir" style="width:150px; height:16px; " value="<?php echo $pegawai->tmplahir ?>"></td>
											
											<td style="width: 40px"></td>
											
											<td>Karpeg</td>
											<td>:</td>
											<td><input type="text" name="karpeg" id="karpeg" style="width:250px; height:16px;" value="<?php echo $pegawai->karpeg; ?>" ></td>
											
											
										</tr>
										
										<tr>
											<td>Tanggal Lahir</td>
											<td>:</td>
											<td><input type="text" name="tgllahir" class='datepick' id="tgllahir" style="width:70px; height:16px; " value="<?php echo $tgllahir ?>"> &nbsp;&nbsp;Usia :&nbsp;<input type="text" name="usia" id="usia" readonly="" style="width:50px; height:16px;" value="<?php echo $usia; ?>" > </td>										
											
											<td style="width: 40px"></td>
											
											<td>No Peserta Sertifikasi</td>
											<td>:</td>
											<td><input type="text" name="no_sertifikasi" id="no_sertifikasi" style="width:250px; height:16px;" value="<?php echo $pegawai->no_sertifikasi; ?>" ></td>
											
											
										</tr>
                                        
                                        <tr>
                                            <td>NOMOR INDUK KEPENDUDUKAN</td>
											<td>:</td>
											<td><input type="text" name="nik" id="nik" style="width:150px; height:16px;" value="<?php echo $pegawai->nik; ?>" ></td>			
                                        </tr>
										
										<tr>
											<td>Agama</td>
											<td>:</td>
											<td>
												<select name="agama" id="agama" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_agama($pegawai->agama); ?>
												</select>
											</td>
											
																		
											<td style="width: 40px"></td>
											
											<td>Jenis Sertifikasi</td>
											<td>:</td>
											<td>
												<select name="idjenis_sertifikasi" id="idjenis_sertifikasi" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_jenis_sertifikasi($idjenis_sertifikasi); ?>
												</select>
											</td>
											
																		
										</tr>
										
										<tr>
											<td>Suku</td>
											<td>:</td>
											<td>
												<select name="suku" id="suku" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_suku($pegawai->suku); ?>
												</select>
											</td>
											
											<td style="width: 40px"></td>
											
											<td>NUPTK</td>
											<td>:</td>
											<td><input type="text" name="nuptk" id="nuptk" style="width:250px; height:16px;" value="<?php echo $pegawai->nuptk; ?>" ></td>		
																				
										</tr>
										
										<tr>
											<td>Menikah</td>
											<td>:</td>
											<td>
												<input type="radio" id="nikah" name="nikah" value="sudah" <?php echo $nikah ?> >Sudah&nbsp;&nbsp;
												<input type="radio" id="nikah1" name="nikah" value="belum" <?php echo $nikah1 ?> >Belum
													
											</td>	
											

											
										</tr>
										
                                        <tr>
											<td>Jenis Identitas</td>
											<td>:</td>
											<td>
												<select name="jenis_id" id="jenis_id" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_jenis_id($pegawai->jenis_id); ?>
												</select>
											</td>	
										</tr>
                                        
										<tr>
											<td>No. Identitas</td>
											<td>:</td>
											<td><input type="text" name="noid" id="noid" style="width:150px; height:16px; " value="<?php echo $pegawai->noid ?>"></td>
											
											<td></td>
											<td></td>
											<td></td>											
											<td></td>
											
										</tr>
								
										<tr>
											<td rowspan="2">Alamat</td>
											<td rowspan="2">:</td>
											<td rowspan="2"><textarea name="alamat" id="alamat" class='span12 input-square' rows="3"><?php echo $pegawai->alamat ?></textarea></td>
											
											
											<td style="width: 40px"></td>
											
											<td></td>
											<td></td>
											<td></td>
											
										</tr>
										
										<tr>
											<td></td>
											<td></td>
											<td></td>
											
											<td></td>
											<td></td>
											<td></td>											
											<td></td>
											
										</tr>
										
										<tr>
											<td>Bergabung di Tunas Unggul</td>
											<td>:</td>
											<td><input type="text" name="unit_cpns" class='datepick' id="unit_cpns" style="width:70px; height:16px;" value="<?php echo $unit_cpns; ?>" ></td>
											
											<td></td>
											<td></td>
											<td></td>											
											<td></td>
											
										</tr>
										
										<tr>
											<td>Nomor SK Masuk</td>
											<td>:</td>
											<td><input type="text" name="no_sk_masuk" id="no_sk_masuk" style="width:150px; height:16px;" value="<?php echo $pegawai->no_sk_masuk; ?>" ></td>
											
											<td></td>
											<td></td>
											<td></td>											
											<td></td>
										</tr>
										
										<tr>
											<td>Tanggal SK Masuk</td>
											<td>:</td>
											<td><input type="text" name="tmt_cpns" class='datepick' id="tmt_cpns" style="width:70px; height:16px; " value="<?php echo $tmt_cpns ?>"></td>
											
											<td></td>
											<td></td>
											<td></td>											
											<td></td>
											
										</tr>
										
										<tr>
											<td>Nomor SK Tetap</td>
											<td>:</td>
											<td><input type="text" name="no_sk_tetap" id="no_sk_tetap" style="width:150px; height:16px;" value="<?php echo $pegawai->no_sk_tetap; ?>" ></td>
											
											<td></td>
											<td></td>
											<td></td>											
											<td></td>
										</tr>
										
										<tr>
											<td>Tanggal SK Tetap</td>
											<td>:</td>
											<td><input type="text" name="tanggal_sk_tetap" class='datepick' id="tanggal_sk_tetap" style="width:70px; height:16px; " value="<?php echo $tanggal_sk_tetap ?>"></td>
											
											<td></td>
											<td></td>
											<td></td>											
											<td></td>
											
										</tr>
										
										<tr>
											<td>Status Pegawai</td>
											<td>:</td>
											<td>
												<select name="idstatus_pegawai" id="idstatus_pegawai" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_status_pegawai($pegawai->idstatus_pegawai); ?>
												</select>
											</td>
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
										</tr>
										
										<tr>											
											<td>Banyak jam di tempat lain</td>
											<td>:</td>
											<td><input type="text" name="jumlah_jam_ajar_lain" id="jumlah_jam_ajar_lain" style="width:150px; height:16px; " value="<?php echo $pegawai->jumlah_jam_ajar_lain ?>"></td>
																						
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
										</tr>
										
										<tr>
											<td>Desa</td>
											<td>:</td>
											<td><input type="text" name="desa" id="desa" style="width:250px; height:16px;" value="<?php echo $pegawai->desa; ?>" ></td>
											
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
										</tr>
										
										<tr>
											<td>Kecamatan</td>
											<td>:</td>
											<td><input type="text" name="kecamatan" id="kecamatan" style="width:250px; height:16px; " value="<?php echo $pegawai->kecamatan ?>"></td>
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
										</tr>
										
										<tr>
											<td>Kode Pos</td>
											<td>:</td>
											<td><input type="text" name="kode_pos" id="kode_pos" style="width:150px; height:16px;" value="<?php echo $pegawai->kode_pos; ?>" ></td>
											
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										
										<tr>
											<td>E-mail</td>
											<td>:</td>
											<td><input type="text" name="email" id="email" style="width:250px; height:16px; " value="<?php echo $pegawai->email ?>"></td>
											
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
										</tr>
										
										<tr>
											
											<td>Handphone</td>
											<td>:</td>
											<td><input type="text" name="handphone" id="handphone" style="width:150px; height:16px; " value="<?php echo $pegawai->handphone ?>"></td>
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
																						
										</tr>
										
										<tr>
											<td>Telepon</td>
											<td>:</td>
											<td><input type="text" name="telpon" id="telpon" style="width:150px; height:16px; " value="<?php echo $pegawai->telpon ?>"></td>
																		
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
										</tr>
										
										<tr>
											<td>Nama Ibu</td>
											<td>:</td>
											<td><input type="text" name="nama_ibu" id="nama_ibu" style="width:250px; height:16px;" value="<?php echo $pegawai->nama_ibu; ?>" ></td>	
															
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
										</tr>
										
										<tr>
											<td>Nomor Pokok Wajib Pajak</td>
											<td>:</td>
											<td><input type="text" name="npwp" id="npwp" style="width:250px; height:16px;" value="<?php echo $pegawai->npwp; ?>" ></td>
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										
										<tr>
											<td>Unit Bank</td>
											<td>:</td>
											<td><input type="text" name="unit_bank" id="unit_bank" style="width:150px; height:16px; " value="<?php echo $pegawai->unit_bank ?>"></td>
                                            
                                            <td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										
										<tr>
											<td>Nama Bank</td>
											<td>:</td>
											<td><input type="text" name="nama_bank" id="nama_bank" style="width:150px; height:16px;" value="<?php echo $pegawai->nama_bank; ?>" ></td>
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
										</tr>
										
										<tr>
											<td>Nama Pemilik</td>
											<td>:</td>
											<td><input type="text" name="nama_pemilik" id="nama_pemilik" style="width:250px; height:16px; " value="<?php echo $pegawai->nama_pemilik ?>"></td>
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										
										<tr>
											<td>No. Rekening</td>
											<td>:</td>
											<td><input type="text" name="no_rek" id="no_rek" style="width:150px; height:16px;" value="<?php echo $pegawai->no_rek; ?>" ></td>
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										
										<tr>
											<td>Tanggal Pensiun</td>
											<td>:</td>
											<td><input type="text" name="tanggal_pensiun" class='datepick' id="tanggal_pensiun" style="width:70px; height:16px; " value="<?php echo $tanggal_pensiun ?>"></td>
																						
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											
										</tr>
										
										
										<tr>
											<td rowspan="2">Keterangan</td>
											<td rowspan="2">:</td>
											<td rowspan="2"><textarea name="keterangan" id="keterangan" class='span12 input-square' rows="3"><?php echo $pegawai->keterangan ?></textarea></td>
											
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										
										<tr>											
											<td style="width: 40px"></td>
											
											<td colspan="3">
												&nbsp;
											</td>
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
												<?php if (allowupd('frmpegawai')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmpegawai')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmpegawai')==1) { ?>	
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('pegawai_view') ?> '" />
											
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