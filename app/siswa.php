<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Nama Siswa tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='kelamin') {
			alert('Jenis Kelamin tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nis') {
			alert('NIS tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='idtingkat') {
			alert('Tingkat tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='idkelas') {
			alert('Kelas tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='departemen') {
			alert('Unit tidak boleh kosong!');				
		  }
		  
		  /*if (document.getElementById(arrf[i]).name=='Ktg') {
			alert('Kategori tidak boleh kosong!');				
		  }*/
		  
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

<?php

$ref = $segmen3; //$_GET['search'];				

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>DAFTAR SISWA</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="siswa" id="siswa" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('nis,nama,idtingkat,idkelas,kelamin,departemen');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
										
										$ref2 = notran(date('y-m-d'), 'frmsiswa', '', '', ''); //---get no ref
										
										include("app/exec/insert_siswa.php"); 
										
										$warga = "checked";
										$warga1 = "";
										$yatim = "";
										$yatim1 = "";
										$yatim2 = "";
										$yatim3 = "checked";
										$kesekolah = "";
										$kesekolah1 = "";
										
										$wnayah = "checked";
										$wnayah1 = "";
										$wnibu = "checked";
										$wnibu1 = "";
										
										if ($ref != "") {
											$sql=$select->list_siswa('', $ref);			
											$siswa=$sql->fetch(PDO::FETCH_OBJ);
											
											$replid 		= $siswa->replid;
											$tgllahir		= date("d-m-Y", strtotime($siswa->tgllahir));
											$tglijazah		= date("d-m-Y", strtotime($siswa->tglijazah));
											$tglskhun		= date("d-m-Y", strtotime($siswa->tglskhun));
											$tgllahirayah	= date("d-m-Y", strtotime($siswa->tgllahirayah));
											$tgllahiribu	= date("d-m-Y", strtotime($siswa->tgllahiribu));
											$tgllahirwali	= date("d-m-Y", strtotime($siswa->tgllahirwali));
											
											if($tgllahir=='01-01-1970') { $tgllahir = ''; }
											if($tglijazah=='01-01-1970') { $tglijazah = ''; }
											if($tglskhun=='01-01-1970') { $tglskhun = ''; }
											if($tgllahirayah=='01-01-1970') { $tgllahirayah = ''; }
											if($tgllahiribu=='01-01-1970') { $tgllahiribu = ''; }
											if($tgllahirwali=='01-01-1970') { $tgllahirwali = ''; }
											
											if($siswa->warga == 1) { $warga = "checked"; }
											if($siswa->warga == 2) { $warga1 = "checked"; }
											
											if($siswa->yatim == 1) { $yatim = "checked"; }
											if($siswa->yatim == 2) { $yatim1 = "checked"; }
											if($siswa->yatim == 3) { $yatim2 = "checked"; }
											if($siswa->yatim == 4) { $yatim3 = "checked"; }
											
											if($siswa->kesekolah == 1) { $kesekolah = "checked"; }
											if($siswa->kesekolah == 2) { $kesekolah1 = "checked"; }
											
											if($siswa->kps == 1) { $kps = "checked"; }
											if($siswa->kip == 1) { $kip = "checked"; }
											if($siswa->pip == 1) { $pip = "checked"; }
											
											if($siswa->wnayah == 1) { $wnayah = "checked"; }
											if($siswa->wnayah == 2) { $wnayah1 = "checked"; }
											
											if($siswa->wnibu == 1) { $wnibu = "checked"; }
											if($siswa->wnibu == 2) { $wnibu1 = "checked"; }
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="replid" name="replid" value="<?php echo $siswa->replid ?>" >
										<input type="hidden" id="old_nis" name="old_nis" value="<?php echo $siswa->nis ?>" >
										<tr>
											<td>Unit *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" onClick="loadHTMLPost2('app/siswa_ajax.php','tingkat_id','gettingkat','departemen')" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_departemen($siswa->departemen); ?>
												</select>
											</td>											
										</tr>
										
										<tr>
											<td>Tahun Ajaran</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idangkatan" id="idangkatan" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_thnajaran($siswa->idangkatan); ?>
												</select>
											</td>											
										</tr>
										
										<tr>
											<td>Angkatan</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idangkatan1" id="idangkatan1" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_angkatan($siswa->idangkatan1); ?>
												</select>
											</td>											
										</tr>
										
										<tr>
											<td>Photo</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="file" id="foto_file" name="foto_file" >
												<input type="hidden" id="foto_file2" name="foto_file2" value="<?php echo $siswa->foto_file; ?>" >
											</td>
											
											<td colspan="4">&nbsp;&nbsp;</td>
																			
										</tr>
										
										<?php if($siswa->foto_file != "") { ?>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;&nbsp;</td>
												<td>
													<img src="app/file_foto_siswa/<?php echo $siswa->foto_file; ?>" height="150" width="130" >
												</td>
												
												<td colspan="4">&nbsp;&nbsp;</td>
																				
											</tr>
										<?php } ?>
										
										<tr>
											<td colspan="3" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;A. Keterangan Pribadi</h4>
											</td>
										</tr>
										
										<tr>
											<td>NIS *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nis" id="nis" style="width:100px; height:16px;" value="<?php echo $siswa->nis; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>NISN</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nisn" id="nisn" style="width:100px; height:16px;" value="<?php echo $siswa->nisn; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Nama *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nama" id="nama" style="width:250px; height:16px;" value="<?php echo $siswa->nama; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Nama Panggilan</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="panggilan" id="panggilan" style="width:250px; height:16px;" value="<?php echo $siswa->panggilan; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Level *)</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7" id="tingkat_id">
												<select name="idtingkat" id="idtingkat" style="width:auto; height:27px; " onClick="loadHTMLPost2('app/siswa_ajax.php','idkelas','getkelas','idtingkat')" />
													<option value=""></option>
													<?php select_tingkat($siswa->idtingkat); ?>
												</select>
												&nbsp;&nbsp; Kelas *)
												
													<select name="idkelas" id="idkelas" style="width:auto; height:27px; " />
														<option value=""></option>
														<?php select_kelas($siswa->idtingkat, $siswa->idkelas); ?>
													</select>
												
											</td>		
										</tr>
										
										<tr>
											<td>Jenis Kelamin *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="kelamin" id="kelamin" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_kelamin($siswa->kelamin); ?>
												</select>
											</td>		
										</tr>
										<tr>
											<td>Tempat Lahir</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tmplahir" id="tmplahir" style="width:150px; height:16px; " value="<?php echo $siswa->tmplahir ?>"></td>
										</tr>
										
										<tr>
											<td>NIK</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nik" id="nik" style="width:150px; height:16px; " value="<?php echo $siswa->nik ?>"></td>
										</tr>
										
										<tr>
											<td>Tanggal Lahir</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tgllahir" class='datepick' id="tgllahir" style="width:70px; height:16px; " value="<?php echo $tgllahir ?>"></td>										
											
										</tr>
										
										<tr>
											<td>Agama</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="agama" id="agama" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_agama($siswa->agama); ?>
												</select>
											</td>											
										</tr>
										
										<tr>
											<td>Kewarganegaraan</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="radio" id="warga" name="warga" value="1" <?php echo $warga ?> >WNI&nbsp;&nbsp;
												<input type="radio" id="warga1" name="warga" value="2" <?php echo $warga1 ?> >WNA
													
											</td>										
											
										</tr>
										
										<tr>
											<td>Anak ke-</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="anakke" id="anakke" style="height:16px; width:80px " onkeyup="formatangka('anakke')" value="<?php echo $siswa->anakke; ?>" >&nbsp;&nbsp;Dari&nbsp;&nbsp;<input type="text" name="jsaudara" id="jsaudara" style="height:16px; width: 80px" onkeyup="formatangka('jsaudara')" value="<?php echo $siswa->jsaudara; ?>" ></td>
											
										</tr>
										
										<!--
										<tr>
											<td>Jumlah Saudara Kandung</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="jsaudara" id="jsaudara" style="height:16px; width: 80px" onkeyup="formatangka('jsaudara')" value="<?php echo $siswa->jsaudara; ?>" ></td>
											
										</tr>-->
										
										<tr>
											<td>Jumlah Saudara Tiri</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="jtiri" id="jtiri" style="height:16px; width: 80px" onkeyup="formatangka('jtiri')" value="<?php echo $siswa->jtiri; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Jumlah Saudara Angkat</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="jangkat" id="jangkat" style="height:16px; width: 80px" onkeyup="formatangka('jangkat')" value="<?php echo $siswa->jangkat; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Status keberadaan orang tua</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="radio" id="yatim3" name="yatim" value="4" <?php echo $yatim3 ?> >Orangtua Lengkap&nbsp;&nbsp;
												<input type="radio" id="yatim" name="yatim" value="1" <?php echo $yatim ?> >Yatim&nbsp;&nbsp;
												<input type="radio" id="yatim1" name="yatim" value="2" <?php echo $yatim1 ?> >Piatu&nbsp;&nbsp;
												<input type="radio" id="yatim2" name="yatim" value="3" <?php echo $yatim2 ?> >Yatim Piatu
													
											</td>										
											
										</tr>
										
										<tr>
											<td>Bahasa Sehari-hari di rumah</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="bahasa" id="bahasa" style="height:16px;" value="<?php echo $siswa->bahasa; ?>" ></td>
											
										</tr>
                                        
                                        <tr>
											<td>No Registrasi Akta Lahir</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="no_akte_lahir" id="no_akte_lahir" style="width:200px; height:16px;" value="<?php echo $siswa->no_akte_lahir; ?>" >
											</td>												
										</tr>
										
										
										<!----Keterangan tempat tinggal------>
										<tr>
											<td colspan="3" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;B. Keterangan Tempat Tinggal</h4>
											</td>
										</tr>
                                        
                                        <tr>
											<td>Provinsi</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="provinsi_kode" id="provinsi_kode" style="width:auto; height:27px; " onChange="loadHTMLPost2('app/siswa_alamat_ajax.php','kota','getkota','provinsi_kode')" />
                                                	<option value=""></option>
													<?php select_provinsi($siswa->provinsi_kode); ?>
												</select>
                                             </td>
										</tr>
                                        
                                        <tr>
											<td>Kabupaten/Kota</td>
											<td>&nbsp;&nbsp;</td>
											<td id="kota">
                                                <select name="kota_kode" id="kota_kode" style="width:auto; height:27px; " />												<option value=""></option>
													<?php select_kota($siswa->provinsi_kode, $siswa->kota_kode); ?>
												</select>
                                             </td>
										</tr>
                                        
                                        <tr>
											<td>Kecamatan</td>
											<td>&nbsp;&nbsp;</td>
											<td id="kecamatan">
                                                <select name="kecamatan_kode" id="kecamatan_kode" style="width:auto; height:27px; " onChange="loadHTMLPost2('app/siswa_alamat_ajax.php','kecamatan','getkecamatan','kecamatan_kode')" />										<option value=""></option>
													<?php select_kecamatan($siswa->kota_kode, $siswa->kecamatan_kode); ?>
												</select>
                                             </td>
										</tr>
                                        
                                        <tr>
											<td>Desa/Kelurahan</td>
											<td>&nbsp;&nbsp;</td>
											<td id="kelurahan">
                                                <select name="desa_kode" id="desa_kode" style="width:auto; height:27px; " />												        <option value=""></option>
													<?php select_desa($siswa->kecamatan_kode, $siswa->desa_kode); ?>
												</select>
                                             </td>
										</tr>
										
										<tr>
											<td>Alamat Lengkap Siswa</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="alamatsiswa" id="alamatsiswa" style="width:300px; height:16px;" value="<?php echo $siswa->alamatsiswa; ?>" >
												 /
												RT : <input type="text" name="rt_siswa" id="rt_siswa" style="height:16px; width: 30px" value="<?php echo $siswa->rt_siswa; ?>" >
												RW : <input type="text" name="rw_siswa" id="rw_siswa" style="height:16px; width: 30px" value="<?php echo $siswa->rw_siswa; ?>" >
											</td>
											
										</tr>
										
										<tr>
											<td>Kode Pos Siswa</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="kodepossiswa" id="kodepossiswa" style="width:100px; height:16px;" value="<?php echo $siswa->kodepossiswa; ?>" >
											</td>
											
										</tr>
										
                                        <!--
										<tr>
											<td>Dusun</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="dusun" id="dusun" style="width:150px; height:16px;" value="<?php echo $siswa->dusun; ?>" >
												 
												Desa : <input type="text" name="desa" id="desa" style="height:16px; width: 150px" value="<?php echo $siswa->desa; ?>" >
												Kecamatan : <input type="text" name="kecamatan" id="kecamatan" style="height:16px; width: 150px" value="<?php echo $siswa->kecamatan; ?>" >
											</td>
											
										</tr>-->
										
										<tr>
											<td>Jenis Tinggal</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="jenistinggal" id="jenistinggal" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_jenistinggal($siswa->jenistinggal); ?>
												</select>
											</td>											
										</tr>
										
										<tr>
											<td>Alamat Lengkap Orang Tua</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="alamatortu" id="alamatortu" style="width:300px; height:16px;" value="<?php echo $siswa->alamatortu; ?>" >												
											</td>
											
										</tr>
										
										<tr>
											<td>No. Telp. Rumah/HP Siswa</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3"><input type="text" name="telponsiswa" id="telponsiswa" style="height:16px;" value="<?php echo $siswa->telponsiswa; ?>" >/
												<input type="text" name="hpsiswa" id="hpsiswa" style="height:16px;" value="<?php echo $siswa->hpsiswa; ?>" >
											</td>
											
										</tr>
										
										<tr>
											<td>E-mail Siswa</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="emailsiswa" id="emailsiswa" style="height:16px;" value="<?php echo $siswa->emailsiswa; ?>" >
											</td>
											
										</tr>
										
										<tr>
											<td>Apakah Sebagai Penerima KPS</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="checkbox" name="kps" id="kps" style="height:16px; " value="1" <?php echo $kps ?> >&nbsp;&nbsp;NO KPS &nbsp;<input type="text" name="nokps" id="nokps" style="width:200px; height:16px;" value="<?php echo $siswa->nokps; ?>" ><i style="font-size: 8px">*) KPS= Kartu Perlindungan Sosial</i>
											</td>												
										</tr>
										
										<tr>
											<td>Apakah Penerima KIP</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="checkbox" name="kip" id="kip" style="height:16px;" value="1" <?php echo $kip; ?> >&nbsp;&nbsp;No KIP&nbsp;<input type="text" name="nokip" id="nokip" style="width:200px; height:16px;" value="<?php echo $siswa->nokip; ?>" >
											&nbsp;&nbsp;Nama KIP&nbsp;<input type="text" name="namakip" id="namakip" style="width:200px; height:16px;" value="<?php echo $siswa->namakip; ?>" >
											</td>												
										</tr>
										
										<tr>
											<td>No KKS</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nokks" id="nokks" style="width:200px; height:16px;" value="<?php echo $siswa->nokks; ?>" >
											</td>												
										</tr>
										
										<tr>
											<td>No. Telp./HP Ayah</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3"><input type="text" name="telponortu" id="telponortu" style="height:16px;" value="<?php echo $siswa->telponortu; ?>" >/
												<input type="text" name="hportu" id="hportu" style="height:16px;" value="<?php echo $siswa->hportu; ?>" >
											</td>
											
										</tr>
										
										<tr>
											<td>No. Telp./HP Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="hpibu" id="hpibu" style="height:16px;" value="<?php echo $siswa->hpibu; ?>" >
											</td>
											
										</tr>
																				
										<tr>
											<td>Alat Transportasi ke Sekolah</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<select name="transportasi_kode" id="transportasi_kode" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_transportasi($siswa->transportasi_kode); ?>
												</select>
												(Lainnya sebutkan)
												<input type="text" name="transportasi_lain" id="transportasi_lain" style="width:250px; height:16px;" value="<?php echo $siswa->transportasi_lain; ?>" >
													
											</td>
											
										</tr>
										
										<tr>
											<td>Jarak dari rumah ke Sekolah</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="jaraksekolah" id="jaraksekolah" style="height:16px; " onkeyup="formatangka('jaraksekolah')" value="<?php echo $siswa->jaraksekolah ?>">
											</td>									
										</tr>
										
										<!--
										<tr>
											<td>Ke sekolah dengan</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="radio" id="kesekolah" name="kesekolah" value="1" <?php echo $kesekolah ?> >Kendaraan&nbsp;&nbsp;
												<input type="radio" id="kesekolah1" name="kesekolah" value="2" <?php echo $kesekolah1 ?> >Jalan kaki
													
											</td>										
											
										</tr>
										-->
										
										
										<!----Keterangan kesehatan------>
										<tr>
											<td colspan="3" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;C. Keterangan Kesehatan</h4>
											</td>
										</tr>
										
										<tr>
											<td>Berat Badan</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="berat" id="berat" style="height:16px;" onkeyup="formatangka('berat')" value="<?php echo $siswa->berat ?>">&nbsp;kg												
											</td>												
										</tr>
										
										<tr>
											<td>Tinggi Badan</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tinggi" id="tinggi" style="height:16px;" onkeyup="formatangka('tinggi')" value="<?php echo $siswa->tinggi ?>">&nbsp;cm												
											</td>
																						
										</tr>
										
										<tr>
											<td>Penyakit yang pernah diderita</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="kesehatan" id="kesehatan" style="width:250px; height:16px; " value="<?php echo $siswa->kesehatan ?>">										
											</td>
																						
										</tr>
										
										<tr>
											<td>Golongan Darah</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3">
												<select name="darah" id="darah" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_goldarah($siswa->darah); ?>
												</select>
												&nbsp;&nbsp;
												File Fotokopi <input type="file" id="file_darah" name="file_darah" >
												<input type="hidden" id="file_darah2" name="file_darah2" value="<?php echo $siswa->file_darah; ?>" >
												
												<?php if($siswa->file_darah != '') { ?>
													&nbsp;&nbsp;
													<a class="label label-success" href="app/siswa_download_darah.php?replid=<?php echo $siswa->replid ?>" target="_blank" style="background-color: #0b28f4" >Download File</a>
												<?php } ?>
											</td>											
										</tr>
										
										<tr>
											<td>Kelainan Jasmani/Lainnya</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="kelainan" id="kelainan" style="width:250px; height:16px; " value="<?php echo $siswa->kelainan ?>">										
											</td>
																						
										</tr>
										
										<!----Keterangan Pendidikan sebelumnya------>
										<tr>
											<td colspan="3" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;D. Keterangan Pendidikan Sebelumnya</h4>
											</td>
										</tr>
										
										<tr>
											<td>Asal Sekolah</td>
											<td>&nbsp;&nbsp;</td>
											<?php /*
											<td>
												<select name="asalsekolah_id" id="asalsekolah_id" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_asalsekolah($siswa->asalsekolah_id); ?>
												</select>
											</td>	
											*/ ?>	
											<td><input type="text" name="asalsekolah_id" id="asalsekolah_id" style="height:16px; " value="<?php echo $siswa->asalsekolah_id ?>">										
										</tr>
										
										<tr>
											<td>Tanggal dan No Ijazah</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3"><input type="text" name="tglijazah" id="tglijazah" class='datepick' style="width:100px; height:16px; " value="<?php echo $tglijazah ?>"> dan <input type="text" name="noijazah" id="noijazah" style="height:16px; " value="<?php echo $siswa->noijazah ?>">										
											</td>
										</tr>
										
										<tr>
											<td>Tanggal dan No SKHUN</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3"><input type="text" name="tglskhun" id="tglskhun" class='datepick' style="width:100px; height:16px; " value="<?php echo $tglskhun ?>"> dan <input type="text" name="skhun" id="skhun" style="height:16px; " value="<?php echo $siswa->skhun ?>">										
											</td>
										</tr>
										
										<tr>
											<td>No Ujian Nasional</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="noujian" id="noujian" style="height:16px; " value="<?php echo $siswa->noujian ?>">										
											</td>
										</tr>
										
										<tr>
											<td>NISN Asal Sekolah</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nisnasal" id="nisnasal" style="height:16px; " value="<?php echo $siswa->nisnasal ?>"></td>
										</tr>
                                        
                                        
										
										<!----Keterangan Orang Tua------>
										<tr>
											<td colspan="3" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;E. Keterangan Orang Tua</h4>
											</td>
										</tr>
										
										<tr>
											<td>NIK Ayah</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nik_ayah" id="nik_ayah" style="height:16px; " value="<?php echo $siswa->nik_ayah ?>"></td>									
										</tr>
										
										<tr>
											<td>Nama Ayah</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="namaayah" id="namaayah" style="height:16px; " value="<?php echo $siswa->namaayah ?>"></td>											
										</tr>
										
										<tr>
											<td>NIK Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nik_ibu" id="nik_ibu" style="height:16px; " value="<?php echo $siswa->nik_ibu ?>"></td>									
										</tr>
										
										<tr>
											<td>Nama Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="namaibu" id="namaibu" style="height:16px; " value="<?php echo $siswa->namaibu ?>"></td>									
										</tr>
										
										<tr>
											<td>Tempat dan Tanggal Lahir Ayah</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3"><input type="text" name="tmplahirayah" id="tmplahirayah" style="height:16px; " value="<?php echo $siswa->tmplahirayah ?>"> dan <input type="text" name="tgllahirayah" id="tgllahirayah" class='datepick' style="width:100px; height:16px; " value="<?php echo $tgllahirayah ?>"> 						
											</td>
										</tr>
										
										<tr>
											<td>Tempat dan Tanggal Lahir Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3"><input type="text" name="tmplahiribu" id="tmplahiribu" style="height:16px; " value="<?php echo $siswa->tmplahiribu ?>"> dan <input type="text" name="tgllahiribu" id="tgllahiribu" class='datepick' style="width:100px; height:16px; " value="<?php echo $tgllahiribu ?>"> 						
											</td>
										</tr>
										
										<tr>
											<td>Pekerjaan Ayah</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3">
												<select name="pekerjaanayah" id="pekerjaanayah" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_jenispekerjaan_ayah($siswa->pekerjaanayah); ?>
												</select>
												&nbsp;
												Lainnya (sebutkan)
												<input type="text" name="pekerjaanayah_lain" id="pekerjaanayah_lain" style="height:16px; " value="<?php echo $siswa->pekerjaanayah_lain ?>">
											</td>											
										</tr>
                                        
                                        <tr>
											<td>Tempat Bekerja Ayah</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="tempat_bekerja_ayah" id="tempat_bekerja_ayah" style="height:16px; " value="<?php echo $siswa->tempat_bekerja_ayah ?>">
											</td>											
										</tr>
										
										<tr>
											<td>Pekerjaan Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3">
												<select name="pekerjaanibu" id="pekerjaanibu" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_jenispekerjaan($siswa->pekerjaanibu); ?>
												</select>
												&nbsp;
												Lainnya (sebutkan)
												<input type="text" name="pekerjaanibu_lain" id="pekerjaanibu_lain" style="height:16px; " value="<?php echo $siswa->pekerjaanibu_lain ?>">
											</td>										
										</tr>
                                        
                                        <tr>
											<td>Tempat Bekerja Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="tempat_bekerja_ibu" id="tempat_bekerja_ibu" style="height:16px; " value="<?php echo $siswa->tempat_bekerja_ibu ?>">
											</td>											
										</tr>
										
										<tr>
											<td>Penghasilan Ayah Bulanan</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<select name="penghasilanayah_kode" id="penghasilanayah_kode" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_penghasilan($siswa->penghasilanayah_kode); ?>
												</select>
												Lainnya (sebutkan)
												<input type="text" name="penghasilanayah" id="penghasilanayah" style="height:16px;" onkeyup="formatangka('penghasilanayah')" value="<?php echo number_format($siswa->penghasilanayah,0,".",",") ?>">
													
											</td>
																							
										</tr>
										
										
										<tr>
											<td>Penghasilan Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="penghasilanibu_kode" id="penghasilanibu_kode" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_penghasilan($siswa->penghasilanibu_kode); ?>
												</select>
												Lainnya (sebutkan)
												<input type="text" name="penghasilanibu" id="penghasilanibu" style="height:16px; " onkeyup="formatangka('penghasilanibu')" value="<?php echo number_format($siswa->penghasilanibu,0,".",",") ?>">
													
											</td>								
										</tr>
										
										<!----Pendidikan Formal Tertinggi------>
										<tr>
											<td colspan="3" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;F. Pendidikan Formal Tertinggi</h4>
											</td>
										</tr>
										
										<tr>
											<td>Ayah</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="pendidikanayah" id="pendidikanayah" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_pendidikan($siswa->pendidikanayah); ?>
												</select>
											</td>											
										</tr>
										
										<tr>
											<td>Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="pendidikanibu" id="pendidikanibu" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_pendidikan($siswa->pendidikanibu); ?>
												</select>
											</td>										
										</tr>
										
										<!----Kewarganegaraan------>
										<tr>
											<td colspan="3" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;G. Kewarganegaraan</h4>
											</td>
										</tr>
										
										<tr>
											<td>Ayah</td>
											<td>&nbsp;&nbsp;</td>
											<!--<td><input type="text" name="wnayah" id="wnayah" style="height:16px; " value="<?php echo $siswa->wnayah ?>"></td>	-->	
											
											<td>
												<input type="radio" id="wnayah" name="wnayah" value="1" <?php echo $wnayah ?> >WNI&nbsp;&nbsp;
												<input type="radio" id="wnayah1" name="wnayah" value="2" <?php echo $wnayah1 ?> >WNA
													
											</td>								
										</tr>
										
										<tr>
											<td>Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<!--<td><input type="text" name="wnibu" id="wnibu" style="height:16px; " value="<?php echo $siswa->wnibu ?>"></td>-->	
											<td>
												<input type="radio" id="wnibu" name="wnibu" value="1" <?php echo $wnibu ?> >WNI&nbsp;&nbsp;
												<input type="radio" id="wnibu1" name="wnibu" value="2" <?php echo $wnibu1 ?> >WNA
													
											</td>								
										</tr>
										
										
										<!----Keterangan Wali------>
										<tr>
											<td colspan="3" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;H. Keterangan Wali</h4>
											</td>
										</tr>
										
										<tr>
											<td>NIK Wali</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nik_wali" id="nik_wali" style="height:16px; " value="<?php echo $siswa->nik_wali ?>"></td>									
										</tr>
										
										<tr>
											<td>Nama Wali</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="wali" id="wali" style="height:16px; " value="<?php echo $siswa->wali ?>"></td>									
										</tr>
										
										<tr>
											<td>Tempat dan Tanggal Lahir Wali</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3"><input type="text" name="tmplahirwali" id="tmplahirwali" style="height:16px; " value="<?php echo $siswa->tmplahirwali ?>"> dan <input type="text" name="tgllahirwali" id="tgllahirwali" class='datepick' style="width:100px; height:16px; " value="<?php echo $tgllahirwali ?>"> 						
											</td>
										</tr>
										
										<tr>
											<td>Pendidikan Tertinggi</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="pendidikanwali" id="pendidikanwali" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_pendidikan($siswa->pendidikanwali); ?>
												</select>
											</td>											
										</tr>
										
										<tr>
											<td>Pekerjaan</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3">
												<select name="pekerjaanwali" id="pekerjaanwali" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_jenispekerjaan($siswa->pekerjaanwali); ?>
												</select>
												&nbsp;
												Lainnya (sebutkan)
												<input type="text" name="pekerjaanwali_lain" id="pekerjaanwali_lain" style="height:16px; " value="<?php echo $siswa->pekerjaanwali_lain ?>">
											</td>											
										</tr>
                                        
                                        <tr>
											<td>Tempat Bekerja Wali</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="tempat_bekerja_wali" id="tempat_bekerja_wali" style="height:16px; " value="<?php echo $siswa->tempat_bekerja_wali ?>">
											</td>											
										</tr>
										
										<tr>
											<td>Penghasilan Wali Bulanan</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="penghasilanwali_kode" id="penghasilanwali_kode" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_penghasilan($siswa->penghasilanwali_kode); ?>
												</select>
												Lainnya (sebutkan)
												<input type="text" name="penghasilanwali" id="penghasilanwali" style="height:16px; " onkeyup="formatangka('penghasilanwali')" value="<?php echo number_format($siswa->penghasilanwali,0,".",",") ?>">
											</td>							
										</tr>
										
										<tr>
											<td>Alamat</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="alamatwali" id="alamatwali" style="height:16px;" value="<?php echo $siswa->alamatwali; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>No Telp/HP</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="hpwali" id="hpwali" style="height:16px;" value="<?php echo $siswa->hpwali; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Hubungan dengan peserta didik</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="hubungansiswa" id="hubungansiswa" style="height:16px;" value="<?php echo $siswa->hubungansiswa; ?>" ></td>
											
										</tr>
										
										
										<!----Lain-lain------>
										<tr>
											<td colspan="3" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;I. LAIN-LAIN</h4>
											</td>
										</tr>
										
										<!--
										<tr>
											<td>Rombel</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="rombel_id" id="rombel_id" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_rombel($siswa->rombel_id); ?>
												</select>
											</td>											
										</tr>-->
										
										<tr>
											<td>Nama Bank</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nama_bank" id="nama_bank" style="width:200px; height:16px;" value="<?php echo $siswa->nama_bank; ?>" >
											</td>												
										</tr>
										
										<tr>
											<td>No. Rekening</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="no_rekening_bank" id="no_rekening_bank" style="width:200px; height:16px;" value="<?php echo $siswa->no_rekening_bank; ?>" >
											</td>												
										</tr>
										
										<tr>
											<td>Rekening Atas Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nama_pemilik_bank" id="nama_pemilik_bank" style="width:200px; height:16px;" value="<?php echo $siswa->nama_pemilik_bank; ?>" >
											</td>												
										</tr>
										
										<tr>
											<td>Virtual Accont</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="virtualaccount" id="virtualaccount" style="width:200px; height:16px;" value="<?php echo $siswa->virtualaccount; ?>" >
											</td>												
										</tr>
										
										<tr>
											<td>Layak PIP (usulan dari sekolah)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="checkbox" name="pip" id="pip" style="height:16px; " value="1" <?php echo $pip ?> >&nbsp;&nbsp;Alasan PIP &nbsp;<input type="text" name="alasan_pip" id="alasan_pip" style="width:200px; height:16px;" value="<?php echo $siswa->alasan_pip; ?>" ><i style="font-size: 8px">*) PIP= Program Indonesia Pintar</i>
											</td>												
										</tr>
										
										<tr>											
											<td colspan="5">
												&nbsp;
											</td>
													
										</tr>
										
										<tr>
											<td colspan="5" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;Catatan Prestasi</h4>
											</td>
										</tr>
										
										<?php 
											if($ref == "") {
												include("siswa_prestasi.php");
											} else {
												include("siswa_prestasi_update.php");
											}
										?>
										
										<tr>											
											<td colspan="5">
												&nbsp;
											</td>
													
										</tr>
										
										<tr>
											<td colspan="2" align="left">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>&nbsp;Beasiswa</h4>
											</td>
										</tr>
										<?php 
											if($ref == "") {
												include("siswa_beasiswa.php");
											} else {
												include("siswa_beasiswa_update.php");
											} 
										?>
										
										<tr>											
											<td colspan="5">
												&nbsp;
											</td>
													
										</tr>
										
									</table>
									
									
									
									<table>
										<tr>											
											<td colspan="7">
												<?php if (allowupd('frmsiswa')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" onClick="return confirm('Data akan diupdate, apakah data sudah lengkap?')" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmsiswa')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" onClick="return confirm('Data akan disimpan, apakah data sudah lengkap?')" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmsiswa')==1) { ?>	
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('siswa_view') ?> '" />
											
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