<script type="text/javascript" src="js/buttonajax.js"> </script>

<script type="text/javascript">
	function hapus(id)
	{
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('siswa_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
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

		if (tipe == 'find') {
			$("#laborder_dl").attr('action', '')
			.attr('target', '_self');
			$("#laborder_dl").submit();
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
	var request;
	var dest;

	function loadHTMLPost2(URL, destination, button, getId)
	{
		dest = destination;
		str = getId + '=' + document.getElementById(getId).value;
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
		var str = str + '&button=' + button;

		if (window.XMLHttpRequest) {
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

<script>
	var idsiswa = '';
	var idsiswa3 = '';

	var hadir = '';
	var hadir3 = '';

	var dispensasi = '';
	var dispensasi3 = '';

	var sakit = '';
	var sakit3 = '';

	var izin = '';
	var izin3 = '';

	var alpa = '';
	var apla3 = '';

	function checklist(lne)
	{

		idsiswa = idsiswa + '|' + document.getElementById('idsiswa_'  + lne).value;
		$('#idsiswa_id').html('<input type="hidden" size="100" id="idsiswa" name="idsiswa" value="'+ idsiswa +'" >');

		var hadira = document.getElementById('absena_' + lne).checked;
		var dispensasia = document.getElementById('absenb_' + lne).checked;
		var sakita = document.getElementById('absenc_' + lne).checked;
		var izina = document.getElementById('absend_' + lne).checked;
		var alpaa = document.getElementById('absene_' + lne).checked;

		if (hadira || dispensasia || sakita || izina || alpaa) {

			if (hadira) {
				hadir = hadir + '|' + document.getElementById('absena_' + lne).value;
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');

				dispensasi = dispensasi + '|';
				$('#dispensasi_id').html('<input type="hidden" size="100" id="dispensasi" name="dispensasi" value="'+ dispensasi +'" >');
				sakit = sakit + '|';
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');

				izin = izin + '|';
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');

				alpa = alpa + '|';
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');
			} else {
				hadir = hadir;
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');
			}

			if (dispensasia) {
				dispensasi = dispensasi + '|' + document.getElementById('absenb_' + lne).value;
				$('#dispensasi_id').html('<input type="hidden" size="100" id="dispensasi" name="dispensasi" value="'+ dispensasi +'" >');

				hadir = hadir + '|';
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');

				sakit = sakit + '|';
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');

				izin = izin + '|';
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');

				alpa = alpa + '|';
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');
			} else {
				dispensasi = dispensasi;
				$('#dispensasi_id').html('<input type="hidden" size="100" id="dispensasi" name="dispensasi" value="'+ dispensasi +'" >');
			}

			if (sakita) {
				sakit = sakit + '|' + document.getElementById('absenc_' + lne).value;
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');

				hadir = hadir + '|';
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');

				dispensasi = dispensasi + '|';
				$('#dispensasi_id').html('<input type="hidden" size="100" id="dispensasi" name="dispensasi" value="'+ dispensasi +'" >');
				izin = izin + '|';
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');

				alpa = alpa + '|';
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');
			} else {
				sakit = sakit;
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');
			}


			if (izina) {
				izin = izin + '|' + document.getElementById('absend_' + lne).value;
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');

				hadir = hadir + '|';
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');

				dispensasi = dispensasi + '|';
				$('#dispensasi_id').html('<input type="hidden" size="100" id="dispensasi" name="dispensasi" value="'+ dispensasi +'" >');
				sakit = sakit + '|';
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');

				alpa = alpa + '|';
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');
			} else {
				izin = izin;
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');
			}


			if (alpaa) {
				alpa = alpa + '|' + document.getElementById('absene_' + lne).value;
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');

				hadir = hadir + '|';
				$('#hadir_id').html('<input type="hidden" size="100" id="hadir" name="hadir" value="'+ hadir +'" >');

				dispensasi = dispensasi + '|';
				$('#dispensasi_id').html('<input type="hidden" size="100" id="dispensasi" name="dispensasi" value="'+ dispensasi +'" >');
				sakit = sakit + '|';
				$('#sakit_id').html('<input type="hidden" size="100" id="sakit" name="sakit" value="'+ sakit +'" >');

				izin = izin + '|';
				$('#izin_id').html('<input type="hidden" size="100" id="izin" name="izin" value="'+ izin +'" >');
			} else {
				alpa = alpa;
				$('#alpa_id').html('<input type="hidden" size="100" id="alpa" name="alpa" value="'+ alpa +'" >');
			}

		}
	}
</script>

<style>
	.hide {
		opacity: 0;
	}
</style>  

<?php

$idtingkat2	= $_REQUEST['idtingkat2'];
$idkelas2	= $_REQUEST['idkelas2'];
$nama2		= $_REQUEST['nama2'];
$idguru		=	$_REQUEST['idguru'];
$idpelajaran	=	$_REQUEST['idpelajaran'];
$idsemester	=	$_REQUEST['idsemester'];
$all		= $_REQUEST['all'];

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
						<form action="" method="post" name="siswa_view" id="siswa_view" class="form-horizontal">
							<div>

								<table border="0">
									<tr>
										<td>Level</td>
										<td>&nbsp;&nbsp;</td>
										<td>
											<select name="idtingkat2" id="idtingkat2" style="width:auto;  height:20px; font-size:12px; padding:0px; " onchange="loadHTMLPost2('app/siswa_ajax.php','idkelas2','getkelas2','idtingkat2')" />
											<option value=""></option>
											<?php select_tingkat($idtingkat2); ?>
											</select>
										</td>

										<td>&nbsp;&nbsp;</td>
										<td>Kelas</td>
										<td>&nbsp;&nbsp;</td>
										<td>
											<select name="idkelas2" id="idkelas2" style="width:auto; height:20px; font-size:12px; padding:0px; " />
											<option value=""></option>
											<?php select_kelas($idtingkat2, $idkelas2); ?>
											</select>
										</td>

									</tr>
									
									<tr>
										<td>Guru</td>
										<td>&nbsp;&nbsp;</td>
										<td>
											<select name="idguru" id="idguru" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
												<option value=""></option>
												<?php select_guru($idguru); ?>
											</select>
										</td>

										<td>&nbsp;&nbsp;</td>
										<td>Mata Pelajaran</td>
										<td>&nbsp;&nbsp;</td>
										<td>
											<select name="idpelajaran" id="idpelajaran" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
												<option value=""></option>
												<?php select_pelajaran('SD', $idpelajaran); ?>
											</select>
										</td>
									</tr>
									
									<tr>
										<td>Semester</td>
										<td>&nbsp;&nbsp;</td>
										<td>
											<select name="idsemester" id="idsemester" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
												<option value=""></option>
												<?php select_semester('SD', $idsemester); ?>
											</select>
										</td>

										<td>&nbsp;&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;&nbsp;</td>
										<td>
											
										</td>
									</tr>
									
									

									<tr>
										<td colspan="2">
											<input type="submit" name="submit" class='btn btn-primary' value="Find" onclick="submitForm('find')" >
										</td>
									</tr>

								</table>

							</div>
						</form>
					</div>
				</div>
				
				
				
				<?php 
				//jika saat add data, maka data setelah save kosong
					if ($_POST['submit'] == 'Submit') { $ref = ''; }
					//-----------------------------------------------/\

					$ref2 = notran(date('y-m-d'), 'frmpresensi_ukbm', '', '', '');

					include("app/exec/insert_presensi_ukbm.php");
				?>

				<div class="box">
					<div class="box-head tabs">
						<h3>DAFTAR SISWA</h3>


					</div>

					<div class="box-content box-nomargin">

						<?php
						$delete = $_REQUEST['mxKz'];
						if ($delete == "xm8r389xemx23xb2378e23") {
							include 'class/class.delete.php';
							$delete2=new delete;
							$delete2->delete_siswa($_REQUEST['id']);
						?>
						<div class="alert alert-success">
							<strong>Delete Data successfully</strong>
						</div>
						<?php
					}
						?>

				<form class="form-horizontal" role="form" action="" method="post" name="soal_siswa" id="soal_siswa" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('ref,tanggal,idtingkat,idkelas,idsemester');" >
						
						<input type="hidden" id="ref" name="ref" readonly="" style="font-size: 12px" class="form-control" value="<?php echo $ref2 ?>"> 
						
						<div class="tab-content">
							<div class="tab-pane active" id="basic">
								<div style="overflow:auto; ">
									<!--<table class='table table-striped dataTable table-bordered' style="font-size:11px; width:4000px ">-->
									
									
									
									
									<input type="hidden" id="idtingkat" name="idtingkat" value="<?php echo $idtingkat2 ?>" />
									<input type="hidden" id="idguru" name="idguru" value="<?php echo $idguru ?>" />
									<input type="hidden" id="idpelajaran" name="idpelajaran" value="<?php echo $idpelajaran ?>" />
									<input type="hidden" id="idkelas" name="idkelas" value="<?php echo $idkelas2 ?>" />
									<input type="hidden" id="idsemester" name="idsemester" value="<?php echo $idsemester ?>" />

									<table class='table table-striped dataTable table-bordered' style="font-size:11px; ">
										<thead>
											<tr>
												<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
												<th style="font-weight:bold ">NISN &nbsp;&nbsp;</th>
												<th style="font-weight:bold ">Nama Siswa &nbsp;&nbsp;</th>
												<td align="center">Hadir</td>
												<td align="center">Dispensasi</td>
												<td align="center">Sakit</td>
												<td align="center">Izin</td>
												<td align="center">Alpa</td>
											</tr>
										</thead>

										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>

										<tbody>

											<?php
											if ($ref == "") {
												$hadir = "checked";
											}
											
											$no = 0;
											
											$sql=$select_view->list_siswa('', '', $idtingkat2, $idkelas2, $nama2, $all);

											while ($siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {

												$i++;

												$tanggal = date("d-m-Y", strtotime($siswa_view->tanggal));

												if ($siswa_view->kelamin == "P") {
													$kelamin = "Perempuan";
												} else {
													$kelamin = "Laki-laki";
												}
												
												if ($absen == "hadir") {
													$hadir = "checked";
												}

												if ($absen == "dispensasi") {
													$dispensasi = "checked";
												}

												if ($absen == "sakit") {
													$sakit = "checked";
												}

												if ($absen == "izin") {
													$izin = "checked";
												}

												if ($absen == "alpa") {
													$alpa = "checked";
												} 	
																								
											?>
											
											<div class="hide">
												<input type="text" id="idsiswa_<?php echo $no ?>" name="idsiswa_<?php echo $no ?>" value="<?php echo $siswa_view->replid; ?>" >
											</div>

											<tr>
												<td><?php echo $siswa_view->nis ?></td>
												<td><?php echo $siswa_view->nisn ?></td>
												<td><?php echo $siswa_view->nama ?></td>
												<td align="center">
													<input type="radio" id="absena_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="hadir" <?php echo $hadir ?> />
													<span class="lbl"></span>
												</td>
												<td align="center">
													<input type="radio" id="absenb_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="dispensasi" <?php echo $dispensasi ?> />
													<span class="lbl"></span>
												</td>
												<td align="center">
													<input type="radio" id="absenc_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="sakit" <?php echo $sakit ?> />
													<span class="lbl"></span>
												</td>
												<td align="center">
													<input type="radio" id="absend_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="izin" <?php echo $izin ?> />
													<span class="lbl"></span>
												</td>
												<td align="center">
													<input type="radio" id="absene_<?php echo $no ?>" name="absen_<?php echo $no ?>" class="ace" onclick="checklist(<?php echo $no ?>)" value="alpa" <?php echo $alpa ?> />
													<span class="lbl"></span>
												</td>
												</td>

											</tr>

											<?php
													$no++;
												}
											?>


										</tbody>

									</table>
									
									<div class="hide">
										<input type="text" id="jmldata" name="jmldata" value="<?php echo $no; ?>" >
									</div>

								</div>
								
								<div class="space-4"></div>

								<div class="clearfix form-actions">
									<div class="col-md-offset-3 col-md-9">

										<?php
								if (allowadd('frmpresensi_ukbm')==1) { ?>
										<?php
									if ($ref=='') { ?>
										<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Submit" onClick="return confirm('Apakah sudah yakin data sudah benar?')" />
										<?php } ?>
										<?php } ?>

										<?php
								if (allowupd('frmpresensi_ukbm')==1) { ?>
										<?php
									if ($ref!='') { ?>
										<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" onClick="return confirm('Apakah sudah yakin data sudah benar?')" />
										<?php } ?>
										<?php } ?>

										<?php
								if (allowdel('frmpresensi_ukbm')==1) { ?>
										&nbsp;
										<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
										<?php } ?>

										&nbsp;
										<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('presensi_ukbm_view') ?>'" />


									</div>
								</div>
								
								
								<div id="siswa_id"></div>


								<div id="hadir_id"></div>
								<div id="idsiswa_id"></div>
								<div id="dispensasi_id"></div>
								<div id="sakit_id"></div>
								<div id="izin_id"></div>
								<div id="alpa_id"></div>
								
								</form>

								<br>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>