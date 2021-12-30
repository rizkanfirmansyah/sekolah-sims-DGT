<script type="text/javascript" src="js/buttonajax.js"></script>

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

<script>

function tambahnilai(idpelajaran, departemen, idtingkat, idkelas, nama, idkompetensi, idjeniskompetensi, iddasarpenilaian, idsemester, all) 
{	
	newWindow('app/daftarnilai_add.php?idpelajaran='+idpelajaran+'&departemen='+departemen+'&idtingkat='+idtingkat+'&idkelas='+idkelas+'&nama='+nama+'&idkompetensi='+idkompetensi+'&idjeniskompetensi='+idjeniskompetensi+'&iddasarpenilaian='+iddasarpenilaian+'&idsemester='+idsemester+'&all='+all,'Daftar Nilai','800','500','resizable=1,scrollbars=1,status=0,toolbar=0');
}

function viewnilai(idpelajaran, departemen, idtingkat, idkelas, nama, idkompetensi, idjeniskompetensi, iddasarpenilaian, idsemester, all) 
{	
	newWindow('app/daftarnilai_hasil_multi.php?idpelajaran='+idpelajaran+'&departemen='+departemen+'&idtingkat='+idtingkat+'&idkelas='+idkelas+'&nama='+nama+'&idkompetensi='+idkompetensi+'&idjeniskompetensi='+idjeniskompetensi+'&iddasarpenilaian='+iddasarpenilaian+'&idsemester='+idsemester+'&all='+all,'Daftar Nilai','800','500','resizable=1,scrollbars=1,status=0,toolbar=0');
}

</script>

<?php

$departemen	= $_REQUEST['departemen'];
$idtingkat2	= $_REQUEST['idtingkat2'];
$idkelas2	= $_REQUEST['idkelas2'];
$nama2		= $_REQUEST['nama2'];
$idjeniskompetensi	= $_POST['idjeniskompetensi'];
$idkompetensi		= $_POST['idkompetensi'];
$iddasarpenilaian	= $_POST['iddasarpenilaian'];
$idsemester	= $_POST['idsemester'];
$all		= $_REQUEST['all'];

if($all == 1) {
	$all2 = "checked";
}
		
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
							<form action="" method="post" name="daftarnilai_view2" id="daftarnilai_view2" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" onchange="loadHTMLPost2('app/daftarnilai_ajax.php','idtingkat2','gettingkat','departemen')" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Tingkat</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idtingkat2" id="idtingkat2" style="width:auto;  height:27px; font-size:12px; padding:0px; " onchange="loadHTMLPost2('app/daftarnilai_ajax.php','idkelas2','getkelas2','idtingkat2')" />
													<option value=""></option>
													<?php select_tingkat_unit($departemen, $idtingkat2); ?>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td>Kelas</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idkelas2" id="idkelas2" style="width:auto; height:27px; font-size:12px; padding:0px; " onchange="loadHTMLPost2('app/daftarnilai_ajax.php','idsemester','getsemester','departemen')" />
													<option value=""></option>
													<?php //select_kelasfilter($idkelas2); ?>
													<?php select_kelas($idtingkat2, $idkelas2); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="nama2" id="nama2" style="width:150px; height:17px; font-size:12px " value="<?php echo $nama2 ?>">
											</td>
																						
										</tr>
										
										<tr>
											<td>Kompetensi *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idkompetensi" id="idkompetensi" style="width:auto; height:27px; font-size:12px; padding:0px; " />
													<?php select_kompetensi($idkompetensi); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Jenis Kompetensi *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idjeniskompetensi" id="idjeniskompetensi" style="width:auto; height:27px; font-size:12px; padding:0px; " />
													<?php select_jeniskompetensi($idjeniskompetensi); ?>
												</select>
											</td>
																						
										</tr>
										
										<tr>
											<td>Aspek Penilaian *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="iddasarpenilaian" id="iddasarpenilaian" style="width:auto; height:27px; font-size:12px; padding:0px; " />
													<?php select_aspekpenilaian($iddasarpenilaian); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Semester *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idsemester" id="idsemester" style="width:auto; height:27px; font-size:12px; padding:0px; " />
													<?php select_semester($departemen, $idsemester); ?>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td>Semua</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="all" name="all" value="1" <?php echo $all2 ?> />
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td colspan="1">
												<input type="submit" name="submit" class='btn btn-primary' value="Find" onclick="submitForm('find')" >
											</td>
											
											<?php if (allowadd('frmdaftarnilai')==1) { ?>
												<td colspan="6">
													<input type="button" name="submit" id="submit" class="btn btn-primary" value="Tampilkan Nilai" onclick="self.location='<?php echo $nama_folder . obraxabrix('daftarnilai') ?>'" />
														
												</td>
											<?php } ?>											
										</tr>
										
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR NILAI</h3>
													
						</div>
						
						<div class="box-content box-nomargin">
						
							<div class="tab-content">
									
									<div class="tab-pane active" id="basic">
										<div style="overflow:auto; ">
										
										<table class='table table-striped dataTable table-bordered' style="font-size:11px; ">											
											<thead>
												<tr>
													<th style="font-weight:bold ">Unit &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kode &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Mata Pelajaran &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Sifat/Tipe &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Aktif &nbsp;&nbsp;</th>
													
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_daftarnilai_pelajaran("", $departemen, $all);			
													
													while ($daftarnilai_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														if($daftarnilai_view->sifat == 1) {
															$sifat	=	"Wajib";
														}
														if($daftarnilai_view->sifat == 0) {
															$sifat	=	"Ekstra Kurikuler";
														}
												?>
													
													<tr>
														<td><?php echo $daftarnilai_view->departemen ?></td>
														<td><?php echo $daftarnilai_view->kode ?></td>
														<td><?php echo $daftarnilai_view->nama ?></td>
														<td><?php echo $sifat ?></td>
														<td><?php echo $daftarnilai_view->keterangan ?></td>
														<td style="text-align: center">
															<?php if ($daftarnilai_view->aktif == 1) { ?>
																<img src="img/icons/essen/16/check.png" />
															<?php } else { ?>
																<img src="img/icons/essen/16/busy.png" />
															<?php } ?>
														</td>
														<td>
															
															<?php if ($daftarnilai_view->aktif == 1) { ?>
																<!--<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('daftarnilai') ?>&search=<?php echo $daftarnilai_view->replid ?>" style="background-color: #46e916" >tambah nilai</a>-->
																<a href="#" class="label label-success" onClick="JavaScript:tambahnilai('<?php echo $daftarnilai_view->replid ?>','<?php echo $departemen ?>','<?php echo $idtingkat2 ?>','<?php echo $idkelas2 ?>','<?php echo $nama2 ?>','<?php echo $idkompetensi ?>','<?php echo $idjeniskompetensi ?>','<?php echo $iddasarpenilaian ?>','<?php echo $idsemester ?>','<?php echo $all ?>')" ><span class="hidden-tablet"> edit nilai</span></a>
																&nbsp;
																
																<a href="#" class="label label-success" onClick="JavaScript:viewnilai('<?php echo $daftarnilai_view->replid ?>','<?php echo $departemen ?>','<?php echo $idtingkat2 ?>','<?php echo $idkelas2 ?>','<?php echo $nama2 ?>','<?php echo $idkompetensi ?>','<?php echo $idjeniskompetensi ?>','<?php echo $iddasarpenilaian ?>','<?php echo $idsemester ?>','<?php echo $all ?>')" ><span class="hidden-tablet"> view nilai</span></a>
															<?php } ?>
															
															
														</td>
														
													</tr>
																										
												<?php
												}
												?>
												
												
											</tbody>
											
										</table>									
										
										
										</div>
										
										
										<br>
									</div>
							</div>
						</div>
						
				</div>
			</div>

		</div>
	</div>
</div>