<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	function hapus(id) {
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
		
		if(tipe == 'find') {
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

$idtingkat2	= $_REQUEST['idtingkat2'];
$idkelas2	= $_REQUEST['idkelas2'];
$nama2		= $_REQUEST['nama2'];
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
											<td>Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="nama2" id="nama2" style="width:150px; height:10px; font-size:12px " value="">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Semua</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="all" name="all" value="1" />
											</td>											
										</tr>
										
										<tr>
											<td colspan="1">
												<input type="submit" name="submit" class='btn btn-primary' value="Find" onclick="submitForm('find')" >
											</td>
											
											<?php if ( allow("frmsiswa")==1 ) { ?>
												<td colspan="6">
													<input type="button" name="submit" id="submit" class="btn btn-success" value="Tambah Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('siswa') ?> '" />
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

							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<div style="overflow:auto; ">
										<!--<table class='table table-striped dataTable table-bordered' style="font-size:11px; width:4000px ">-->
										
										<table class='table table-striped dataTable table-bordered' style="font-size:11px; ">
											<thead>
												<tr>
													<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">NISN &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama Lengkap &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jenis Kelamin &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Level &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select_view->list_siswa('', '', $idtingkat2, $idkelas2, $nama2, $all);			
													
													while ($siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$tanggal = date("d-m-Y", strtotime($siswa_view->tanggal));	
														
														if($siswa_view->kelamin == "P") {
															$kelamin = "Perempuan";
														} else {
															$kelamin = "Laki-laki";
														}	
														
														$bgcolor = "";
														if($siswa_view->kelas == "Umum") {
															$bgcolor = 'style="background-color: #3c0000; color: #fdf702"';
														}
												?>
													
													<tr>
														<td><?php echo $siswa_view->nis ?></td>
														<td><?php echo $siswa_view->nisn ?></td>
														<td><?php echo $siswa_view->nama ?></td>
														<td><?php echo $kelamin ?></td>
														<td><?php echo $siswa_view->tingkat ?></td>
														<td <?php echo $bgcolor ?>><?php echo $siswa_view->kelas ?></td>
														
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('siswa') ?>&search=<?php echo $siswa_view->replid ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmsiswa')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $siswa_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
																</a>
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