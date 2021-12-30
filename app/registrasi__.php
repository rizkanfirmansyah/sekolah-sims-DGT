<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='tanggal') {
			alert('Tanggal tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nopendaftaran') {
			alert('No Pendaftaran tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Nama Lengkap tidak boleh kosong!');				
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

<?php

/*
$slipno		= $_POST['slipno'];
$fromdate	= $_POST['fromdate'];
$todate		= $_POST['todate'];
$periodid	= $_POST['periodid'];
$tpe		= $_POST['tpe'];
$labid		= $_POST['labid'];
$sts		= $_POST['sts'];
$clientid	= $_POST['clientid'];
*/

$ref = $_GET['search'];
				

?>

<!-------autocomplete function-------------------------------->
<!--
<script type="text/javascript" src="app/js_auto/jquery.js"></script>

<script type="text/javascript" src="app/js_auto/auto_client.js"></script>
<link type="text/css" href="app/js_auto/auto_client.css" rel="stylesheet" />

<script type="text/javascript" src="app/js_auto/auto_kauttp.js"></script>
<link type="text/css" href="app/js_auto/auto_kauttp.css" rel="stylesheet" />
-->
<!-------end function----------------------------------------->

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>PENDAFTARAN PESERTA DIDIK</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="registrasi" id="registrasi" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('tanggal,nopendaftaran,nama,kelamin');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
										
										$ref2 = notran(date('y-m-d'), 'frmregistrasi', '', '', ''); //---get no ref
										
										include("app/exec/insert_registrasi.php"); 
										
										$tanggal	= date("d-m-Y");
										$almayah = "";
										$almibu = "";
										$tgllahir = "";
										
										if ($ref != "") {
											$sql=$select->list_registrasi($ref);			
											$registrasi=$sql->fetch(PDO::FETCH_OBJ);
											
											$ref2 	= $registrasi->nopendaftaran;
											$replid = $registrasi->replid;
											
											if($registrasi->almayah == 1) {
												$almayah = "checked";
											}
											if($registrasi->almibu == 1) {
												$almibu = "checked";
											}
											
											$tgllahir = date("d-m-Y", strtotime($registrasi->tgllahir));
											if($tgllahir == "01-01-1970") {
												$tgllahir = "";
											}
											
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="replid" name="replid" value="<?php echo $registrasi->replid ?>" >
										
                                        <tr>
											<td>Unit *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" onClick="loadHTMLPost2('app/siswa_ajax.php','tingkat_id','gettingkat','departemen')" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_departemen($registrasi->departemen); ?>
												</select>
											</td>											
										</tr>
                                        
										<tr>
											<td>Gelombang</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idproses" id="idproses" style="width:auto; height:27px; " onClick="loadHTMLPost2('app/registrasi_ajax.php','idkelompok','getkelompok','idproses')" />
													<option value=""></option>
													<?php select_prosespsb($registrasi->idproses); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>Kelompok</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idkelompok" id="idkelompok" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_kelompokpsb($registrasi->idproses,$registrasi->idkelompok); ?>
												</select>
											</td>
																			
										</tr>
										
										<tr>
											<td>Tanggal *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tanggal" class='datepick' id="tanggal" style="width:70px; height:16px; " value="<?php echo $tanggal ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>REG No *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nopendaftaran" id="nopendaftaran" style="width:auto; height:16px;" readonly value="<?php echo $ref2; ?>" ></td>
										</tr>
									
										
										
										<tr>
											<td>Photo</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="file" id="foto_file" name="foto_file" >
												<input type="hidden" id="foto_file2" name="foto_file2" value="<?php echo $registrasi->foto_file; ?>" >
											</td>
											
											<td colspan="4">&nbsp;&nbsp;</td>
																			
										</tr>
										
										<?php if($registrasi->foto_file != "") { ?>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;&nbsp;</td>
												<td>
													<img src="app/file_foto/<?php echo $registrasi->foto_file; ?>" height="150" width="130" >
												</td>
												
												<td colspan="4">&nbsp;&nbsp;</td>
																				
											</tr>
										<?php } ?>
										
										<tr>
											<td colspan="7" align="center">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>IDENTITAS PESERTA DIDIK (WAJIB DIISI)</h4>
											</td>
										</tr>
										
										<tr>
											<td>Nama Lengkap *)</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="5"><input type="text" name="nama" id="nama" style="width:500px; height:16px;" value="<?php echo $registrasi->nama; ?>" ></td>
											
										</tr>
										<tr>
											<td>Nama Panggilan</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="5"><input type="text" name="panggilan" id="panggilan" style="width:500px; height:16px;" value="<?php echo $registrasi->panggilan; ?>" ></td>
											
										</tr>
										<tr>
											<td>Jenis Kelamin *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="kelamin" id="kelamin" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_kelamin($registrasi->kelamin); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
																			
										</tr>
										<tr>
											<td>NISN</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nisn" id="nisn" style="width:150px; height:16px; " value="<?php echo $registrasi->nisn ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>NIS</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nis" id="nis" style="width:150px; height:16px; " value="<?php echo $registrasi->nis ?>"></td>
										</tr>
										<tr>
											<td>NOMOR SERI IJAZAH SMP</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<input type="text" name="noijazah" id="noijazah" style="width:200px; height:16px; " value="<?php echo $registrasi->noijazah ?>">
												Tahun
												<select name="tahunijazah" id="tahunijazah" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php tahun_select($registrasi->tahunijazah); ?>
												</select>
														
											</td>
																						
										</tr>
										<tr>
											<td>NOMOR SERI SKHUN</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<input type="text" name="skhun" id="skhun" style="width:200px; height:16px; " value="<?php echo $registrasi->skhun ?>">
												Tahun
												<select name="tahunskhun" id="tahunskhun" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php tahun_select($registrasi->tahunskhun); ?>
												</select>	
											</td>
											
											
										</tr>
										<tr>
											<td>No Ujian Nasional SMP/MTs</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="noujian" id="noujian" style="width:200px; height:16px; " value="<?php echo $registrasi->noujian ?>"></td>
											
											<td colspan="4"><i style="font-size: 9px">*) Diisikan hanya untuk siswa tingkat 10s.d 12</i></td>											
											
										</tr>
										<tr>
											<td>No. Induk Kependudukan (NIK)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nik" id="nik" style="width:200px; height:16px; " value="<?php echo $registrasi->nik ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											
										</tr>
										<tr>
											<td>Tempat Lahir</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tmplahir" id="tmplahir" style="width:150px; height:16px; " value="<?php echo $registrasi->tmplahir ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
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
													<?php select_agama($registrasi->agama); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>												
										</tr>
										
										<tr>
											<td>Berkebutuhan Khusus</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="kebutuhan_khusus" id="kebutuhan_khusus" style="width:200px; height:16px; " value="<?php echo $registrasi->kebutuhan_khusus ?>"></td>
											
											<td colspan="4">&nbsp;</td>												
										</tr>
				
										<tr>
											<td>Alamat Tempat Tinggal</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="5"><input type="text" name="alamatsiswa" id="alamatsiswa" style="width:500px; height:16px;" value="<?php echo $registrasi->alamatsiswa; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Dusun</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="dusun" id="dusun" style="width:150px; height:16px; " value="<?php echo $registrasi->dusun ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>RT &nbsp;<input type="text" name="rt" id="rt" style="width:30px; height:16px;" value="<?php echo $registrasi->rt; ?>" >
												RW &nbsp;<input type="text" name="rw" id="rw" style="width:30px; height:16px;" value="<?php echo $registrasi->rw; ?>" >
											</td>												
										</tr>
										
										<tr>
											<td>Kelurahan/Desa</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="kelurahan" id="kelurahan" style="width:150px; height:16px; " value="<?php echo $registrasi->kelurahan ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>Kode Pos</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="kodepossiswa" id="kodepossiswa" style="width:100px; height:16px;" value="<?php echo $registrasi->kodepossiswa; ?>" >
											</td>												
										</tr>
										
										<tr>
											<td>Kecamatan</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="5"><input type="text" name="kecamatan" id="kecamatan" style="width:500px; height:16px;" value="<?php echo $registrasi->kecamatan; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Kabupaten/Kota</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="5"><input type="text" name="kabupaten" id="kabupaten" style="width:500px; height:16px;" value="<?php echo $registrasi->kabupaten; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Provinsi</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="5"><input type="text" name="provinsi" id="provinsi" style="width:500px; height:16px;" value="<?php echo $registrasi->provinsi; ?>" ></td>
											
										</tr>
										
										
										<tr>
											<td>Alat Transportasi ke Sekolah</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<select name="transportasi_kode" id="transportasi_kode" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_transportasi($registrasi->transportasi_kode); ?>
												</select>
												(Lainnya sebutkan)
												<input type="text" name="transportasi" id="transportasi" style="width:250px; height:16px;" value="<?php echo $registrasi->transportasi; ?>" >
													
											</td>
											
										</tr>
										
										<tr>
											<td>Jenis Tinggal</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<select name="idjenis_tinggal" id="idjenis_tinggal" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_jenistinggal($registrasi->idjenis_tinggal); ?>
												</select>
												&nbsp;
												Bersama Saudara (sebutkan hubungan keluarga)
												<input type="text" name="jenis_tinggal" id="jenis_tinggal" style="width:150px; height:16px; " value="<?php echo $registrasi->jenis_tinggal ?>">
											</td>
																							
										</tr>
										
										<tr>
											<td>No Telepon Rumah</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="telponsiswa" id="telponsiswa" style="width:200px; height:16px; " value="<?php echo $registrasi->telponsiswa ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>No HP</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="hpsiswa" id="hpsiswa" style="width:200px; height:16px;" value="<?php echo $registrasi->hpsiswa; ?>" >
											</td>												
										</tr>
										
										<tr>
											<td>Email Pribadi</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="5"><input type="text" name="emailsiswa" id="emailsiswa" style="width:500px; height:16px;" value="<?php echo $registrasi->emailsiswa; ?>" ></td>
											
										</tr>
										
										<tr>
											<td>Apakah Sebagai Penerima KPS</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="checkbox" name="kps" id="kps" style="height:16px; " value="1" <?php echo $kps ?> ></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>No KPS</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nokps" id="nokps" style="width:200px; height:16px;" value="<?php echo $registrasi->nokps; ?>" ><i style="font-size: 8px">*) KPS= Kartu Perlindungan Sosial</i>
											</td>												
										</tr>
										
										<tr>
											<td>No KIP</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nokip" id="nokip" style="width:200px; height:16px;" value="<?php echo $registrasi->nokip; ?>" ></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>No KKS</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="nokks" id="nokks" style="width:200px; height:16px;" value="<?php echo $registrasi->nokks; ?>" >
											</td>												
										</tr>
										
										<tr>
											<td>Cita-Cita</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<select name="citacita" id="citacita" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_citacita($registrasi->citacita); ?>
												</select>
												Lainnya (sebutkan)
												<input type="text" name="citacita_lain" id="citacita_lain" style="width:250px; height:16px; " value="<?php echo $registrasi->citacita_lain ?>">
													
											</td>
																						
										</tr>
										
										<tr>
											<td colspan="7" align="center">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>DATA AYAH KANDUNG (WAJIB DIISI)</h4>
											</td>
										</tr>
										
										<tr>
											<td>Nama Ayah</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="namaayah" id="namaayah" style="width:200px; height:16px; " value="<?php echo $registrasi->namaayah ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>Tahun Lahir</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="tahunayah" id="tahunayah" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php tahun_select($registrasi->tahunayah); ?>
												</select>
											</td>												
										</tr>
										
										<tr>
											<td>Almarhum</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="checkbox" name="almayah" id="almayah" style="height:16px; " value="1" <?php echo $almayah ?> ></td>
											
											<td colspan="4">&nbsp;&nbsp;</td>								
										</tr>
										
										<tr>
											<td>Alamat Lengkap Orang Tua</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7"><input type="text" name="alamatortu" id="alamatortu" style="width:300px; height:16px;" value="<?php echo $registrasi->alamatortu; ?>" >
												Kode Pos <input type="text" name="kodeposortu" id="kodeposortu" style="width:50px; height:16px;" value="<?php echo $registrasi->kodeposortu; ?>" >
												No. HP. <input type="text" name="hportu" id="hportu" style="width:150px; height:16px;" value="<?php echo $registrasi->hportu; ?>" >
												
											</td>
											
										</tr>
										
										<tr>
											<td>Berkebutuhan Khusus</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="4"><input type="checkbox" name="butuhkhususayah" id="butuhkhususayah" style="height:16px; " value="1" <?php echo $butuhkhususayah ?> >&nbsp;
												<input type="text" name="butuhkhususketayah" id="butuhkhususketayah" style="width:200px; height:16px;" value="<?php echo $registrasi->butuhkhususketayah; ?>" >
											</td>												
										</tr>
										
										<tr>
											<td>Pekerjaan Ayah</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<select name="pekerjaanayah" id="pekerjaanayah" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_jenispekerjaan_ayah($registrasi->pekerjaanayah); ?>
												</select>
												Lain-Lain (sebutkan)
												<input type="text" name="pekerjaanayah_lain" id="pekerjaanayah_lain" style="width:250px; height:16px;" value="<?php echo $registrasi->pekerjaanayah_lain; ?>" >
												
											</td>											
										</tr>
										
										<tr>
											<td>Pendidikan Ayah</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="pendidikanayah" id="pendidikanayah" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_pendidikan($registrasi->pendidikanayah); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>											
										</tr>
										
										<tr>
											<td>Penghasilan Ayah Bulanan</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<select name="penghasilanayah_kode" id="penghasilanayah_kode" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_penghasilan($registrasi->penghasilanayah_kode); ?>
												</select>
												Lainnya (sebutkan)
												<input type="text" name="penghasilanayah" id="penghasilanayah" style="width:150px; height:16px; " onkeyup="formatangka('penghasilanayah')" value="<?php echo $registrasi->penghasilanayah ?>">
													
											</td>
																							
										</tr>
										
										<tr>
											<td colspan="7" align="center">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>DATA IBU KANDUNG (WAJIB DIISI)</h4>
											</td>
										</tr>
										
										<!---------IBU--------->
										<tr>
											<td>Nama Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="namaibu" id="namaibu" style="width:200px; height:16px; " value="<?php echo $registrasi->namaibu ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>Tahun Lahir</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="tahunibu" id="tahunibu" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php tahun_select($registrasi->tahunibu); ?>
												</select>
											</td>												
										</tr>
										
										<tr>
											<td>Almarhum</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="checkbox" name="almibu" id="almibu" style="height:16px; " value="1" <?php echo $almibu ?> ></td>
											
											<td colspan="4">&nbsp;&nbsp;</td>								
										</tr>
										
										<tr>
											<td>Alamat</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7"><input type="text" name="alamatibu" id="alamatibu" style="width:300px; height:16px;" value="<?php echo $registrasi->alamatibu; ?>" >
												Kode Pos <input type="text" name="kodeposibu" id="kodeposibu" style="width:50px; height:16px;" value="<?php echo $registrasi->kodeposibu; ?>" >
												No. HP. <input type="text" name="hpibu" id="hpibu" style="width:150px; height:16px;" value="<?php echo $registrasi->hpibu; ?>" >
												
											</td>
											
										</tr>
										
										<tr>
											<td>Berkebutuhan Khusus</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="4"><input type="checkbox" name="butuhkhususibu" id="butuhkhususibu" style="height:16px; " value="1" <?php echo $butuhkhususibu ?> >&nbsp;
												<input type="text" name="butuhkhususketibu" id="butuhkhususketibu" style="width:200px; height:16px;" value="<?php echo $registrasi->butuhkhususketibu; ?>" >
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>												
										</tr>
										
										<tr>
											<td>Pekerjaan Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<select name="pekerjaanibu" id="pekerjaanibu" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_jenispekerjaan($registrasi->pekerjaanibu); ?>
												</select>
												Lain-Lain (sebutkan)
												<input type="text" name="pekerjaanibu_lain" id="pekerjaanibu_lain" style="width:250px; height:16px;" value="<?php echo $registrasi->pekerjaanibu_lain; ?>" >
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>											
										</tr>
										
										<tr>
											<td>Pendidikan Ibu</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="pendidikanibu" id="pendidikanibu" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_pendidikan($registrasi->pendidikanibu); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>											
										</tr>
										
										<tr>
											<td>Penghasilan Ibu Bulanan</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<select name="penghasilanibu_kode" id="penghasilanibu_kode" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_penghasilan($registrasi->penghasilanibu_kode); ?>
												</select>
												Lainnya (sebutkan)
												<input type="text" name="penghasilanibu" id="penghasilanibu" style="width:150px; height:16px; " onkeyup="formatangka('penghasilanibu')" value="<?php echo $registrasi->penghasilanibu ?>">
													
											</td>
																						
										</tr>
										
										<tr>
											<td colspan="7" align="center">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>DATA WALI</h4>
											</td>
										</tr>
										
										<!---------WALI--------->
										<tr>
											<td>Nama Wali</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="wali" id="wali" style="width:200px; height:16px; " value="<?php echo $registrasi->wali ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>Tahun Lahir</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="tahunwali" id="tahunwali" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php tahun_select($registrasi->tahunwali); ?>
												</select>
											</td>												
										</tr>
										
										<tr>
											<td>Pekerjaan Wali</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="7">
												<select name="pekerjaanwali" id="pekerjaanwali" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_jenispekerjaan($registrasi->pekerjaanwali); ?>
												</select>
												Lain-Lain (sebutkan)
												<input type="text" name="pekerjaanwali_lain" id="pekerjaanwali_lain" style="width:250px; height:16px;" value="<?php echo $registrasi->pekerjaanwali_lain; ?>" >
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>											
										</tr>
										
										<tr>
											<td>Pendidikan Wali</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="pendidikanwali" id="pendidikanwali" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_pendidikan($registrasi->pendidikanwali); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>											
										</tr>
										
										<tr>
											<td>Penghasilan Wali</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="penghasilanwali" id="penghasilanwali" style="width:150px; height:16px; " onkeyup="formatangka('penghasilanwali')" value="<?php echo $registrasi->penghasilanwali ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>												
										</tr>
										
										<tr>
											<td colspan="7" align="center">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>DATA PERIODIK (WAJIB DIISI)</h4>
											</td>
										</tr>
										
										<tr>
											<td>Tinggi Badan</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tinggi" id="tinggi" style="width:150px; height:16px; " onkeyup="formatangka('tinggi')" value="<?php echo $registrasi->tinggi ?>">&nbsp;cm												
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>Berat Badan</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="berat" id="berat" style="width:150px; height:16px; " onkeyup="formatangka('berat')" value="<?php echo $registrasi->berat ?>">&nbsp;kg												
											</td>												
										</tr>
										
										<tr>
											<td>Golongan Darah</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3">
												<select name="darah" id="darah" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_goldarah($registrasi->darah); ?>
												</select>
												&nbsp;&nbsp;
												File Fotokopi <input type="file" id="file_darah" name="file_darah" >
												<input type="hidden" id="file_darah2" name="file_darah2" value="<?php echo $registrasi->file_darah; ?>" >
												
												<?php if($registrasi->file_darah != '') { ?>
													&nbsp;&nbsp;
													<a class="label label-success" href="app/registrasi_download_darah.php?replid=<?php echo $registrasi->replid ?>" target="_blank" style="background-color: #0b28f4" >Download File</a>
												<?php } ?>
											</td>											
										</tr>
										
										<tr>
											<td>Jarak Tempat Tinggal ke Sekolah</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="jaraksekolah" id="jaraksekolah" style="width:150px; height:16px; " value="<?php echo $registrasi->jaraksekolah ?>"> &nbsp;<i>meter</i>
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td colspan="2">2) lebih dari 1 km, sebutkan :</td>
											<td><input type="text" name="jarak_km" id="jarak_km" style="width:100px; height:16px; " onkeyup="formatangka('jarak_km')" value="<?php echo $registrasi->jarak_km ?>">&nbsp;Km		
											</td>										
										</tr>
										
										<tr>
											<td>Waktu Tempuh Berangkat ke Sekolah</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="waktutempuh" id="waktutempuh" style="width:150px; height:16px; " value="<?php echo $registrasi->waktutempuh ?>">&nbsp;<i>menit</i>
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td colspan="2">2) lebih dari 60 menit, sebutkan :</td>
											<td><input type="text" name="waktutempuh_menit" id="waktutempuh_menit" style="width:100px; height:16px; " onkeyup="formatangka('waktutempuh_menit')" value="<?php echo $registrasi->waktutempuh_menit ?>">&nbsp;Menit		
											</td>										
										</tr>
										
										<tr>
											<td>Jumlah Saudara Kandung</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="jsaudara" id="jsaudara" style="width:100px; height:16px; " onkeyup="formatangka('jsaudara')" value="<?php echo $registrasi->jsaudara ?>">
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>										
										</tr>
										
										<tr>
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>										
										</tr>
										
										<tr>
											<td colspan="7" align="center">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>CATATAN PRESTASI</h4>
											</td>
										</tr>
										
										<tr>
											<td colspan="7">
												<?php 
													if($ref == "") {
														include("registrasi_prestasi.php");
													} else {
														include("registrasi_prestasi_update.php");
													}
												?>
											</td>
										</tr>
										
										<tr>
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>										
										</tr>
										
										<tr>
											<td colspan="7" align="center">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4; text-align: center;"><span class="break"></span>BEASISWA</h4>
											</td>
										</tr>
										
										<tr>
											<td colspan="7">
												<?php 
													if($ref == "") {
														include("registrasi_beasiswa.php");
													} else {
														include("registrasi_beasiswa_update.php");
													} 
												?>
											</td>
										</tr>
										
										<tr>
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>										
										</tr>
										
										<tr>
											<td colspan="7" align="center">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4; text-align: center;"><span class="break"></span>Pilihan Jurusan dan MAPEL LINTAS MINAT</h4>
											</td>
										</tr>
										
										<tr>
											<td>Tingkat</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idtingkat" id="idtingkat" style="width:auto; height:27px; " onClick="loadHTMLPost2('app/registrasi_ajax.php','program','getjurusan','idtingkat')"  >
													<option value=""></option>
													<?php select_tingkat($registrasi->idtingkat); ?>
												</select>
											</td>
											
											<td colspan="4">&nbsp;&nbsp;</td>
																			
										</tr>
										
										<tr id="program">
											<td>Program</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idjurusan" id="idjurusan" style="width:auto; height:27px; " >
													<option value=""></option>
													<?php select_program($registrasi->idjurusan); ?>
												</select>
											</td>
											
											<td colspan="4">&nbsp;&nbsp;</td>
																			
										</tr>
										
										<?php /*
										<tr id="minat">
											
											<?php if($ref=='') { ?>
												<input type="hidden" name="idminat" id="idminat" >
												<input type="hidden" name="idminat1" id="idminat1" >
											<?php }  else { ?>
												
												<td>Mata Pelajaran Lintas minat 1</td>
												<td>&nbsp;&nbsp;</td>
												<td>
													<select name="idminat" id="idminat" style="width:auto; height:27px; " />
														<option value=""></option>
														<?php 
															if($registrasi->idjurusan == '1') {
																select_minatips($registrasi->idminat); 	
															}
															if($registrasi->idjurusan == '2') {
																select_minatipa($registrasi->idminat); 	
															}
														?>
													</select>
												</td>
												
												<td>Mata Pelajaran Lintas minat 2</td>
												<td>&nbsp;&nbsp;</td>
												<td>
													<select name="idminat1" id="idminat1" style="width:auto; height:27px; " />
														<option value=""></option>
														<?php 
															if($registrasi->idjurusan == '1') {
																select_minatips($registrasi->idminat1); 	
															}
															if($registrasi->idjurusan == '2') {
																select_minatipa($registrasi->idminat1); 	
															}
														?>
													</select>
												</td>				
											
											<?php } ?>				
										</tr> */ ?>
										
										<tr>											
											<td colspan="7">
												&nbsp;
											</td>
													
										</tr>
										<tr>											
											<td colspan="7">
												&nbsp;
											</td>
													
										</tr>
										
									</table>
									
									
									
									<table>
										<tr>											
											<td colspan="7">
												<?php if (allowupd('frmregistrasi')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" onClick="return confirm('Data akan diupdate, apakah data sudah lengkap?')" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmregistrasi')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" onClick="return confirm('Data akan disimpan, apakah data sudah lengkap?')" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmregistrasi')==1) { ?>	
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('registrasi_view') ?>'" />
											
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