<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('registrasi_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
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
			$("#registrasi_view").attr('action', '')
				.attr('target', '_self');
			$("#registrasi_view").submit();
		}
		
		if(tipe == 'excel') {
			$("#registrasi_view").attr('action', 'app/registrasi_xls.php')
			   .attr('target', '_BLANK');
			$("#registrasi_view").submit();
		}
		
  		return false;	 
    }
		
</script>

<?php

$tahunmasuk	= $_REQUEST['tahunmasuk'];
$idtingkat	= $_REQUEST['idtingkat'];
$tanggal	= $_REQUEST['tanggal'];
$idjurusan	= $_REQUEST['idjurusan'];
$nama		= $_REQUEST['nama'];
$all		= $_REQUEST['all'];

//$tanggal	= date("d-m-Y", strtotime($tanggal));
$tanggal2	= date("d-m-Y", strtotime($tanggal));	

$all2 = "";
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
							<form action="" method="post" name="registrasi_view" id="registrasi_view" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Tahun Masuk</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="tahunmasuk" id="tahunmasuk" style="width:auto; height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php tahun_select($tahunmasuk); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Tingkat</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idtingkat" id="idtingkat" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php select_tingkat($idtingkat); ?>
												</select>
											</td>
											
										</tr>
										<tr>
											<td>Tanggal Daftar</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tanggal" id="tanggal" class='datepick' style="width:auto; height:10px; font-size: 12px" value="<?php echo $tanggal ?>" ></td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Program</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idjurusan" id="idjurusan" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php select_program($idjurusan); ?>
												</select>	
											</td>
											
											
										</tr>
										<tr>
											<td>Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="nama" id="nama" style="width:150px; height:10px; font-size:12px " value="<?php echo $nama ?>">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Semua</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="all" name="all" value="1" <?php echo $all2 ?> />
											</td>											
										</tr>
										
										<tr>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Find" onclick="submitForm('find')" >
											</td>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Ekspor Excel" onclick="submitForm('excel')" >
											</td>											
										</tr>
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR PESERTA DIDIK</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
							
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_registrasi($_REQUEST['id']);
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
													<th style="font-weight:bold ">Tanggal &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">No REG &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tingkat &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Program &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama Lengkap &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jenis Kelamin &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select_view->list_registrasi("", "", $tahunmasuk, $idtingkat, $tanggal, $idjurusan, $nama, $all);			
													
													while ($registrasi_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$tanggal = date("d-m-Y", strtotime($registrasi_view->tanggal));	
														
														if($registrasi_view->kelamin == "P") {
															$kelamin = "Perempuan";
														} else {
															$kelamin = "Laki-laki";
														}	
														
														if ($registrasi_view->idjurusan == 1) {
															$jurusan = 'IPA';
														}
														if ($registrasi_view->idjurusan == 2) {
															$jurusan = 'IPS';
														}
												?>
													
													<tr>
														<td><?php echo $tanggal ?></td>
														<td><?php echo $registrasi_view->nopendaftaran ?></td>
														<td><?php echo $registrasi_view->tingkat ?></td>
														<td><?php echo $jurusan ?></td>
														<td><?php echo $registrasi_view->nama ?></td>
														<td><?php echo $kelamin ?></td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('registrasi') ?>&search=<?php echo $registrasi_view->replid ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmregistrasi')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $registrasi_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
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