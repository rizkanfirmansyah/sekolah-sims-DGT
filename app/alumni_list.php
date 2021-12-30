<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('alumni_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
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

$departemen	= $_REQUEST['departemen'];
$idangkatan1= $_REQUEST['idangkatan1'];
$tahunmasuk	= $_REQUEST['tahunmasuk'];
$tgllulus	= $_REQUEST['tgllulus'];
$nama		= $_REQUEST['nama'];
$all		= $_REQUEST['all'];

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
							<form action="" method="post" name="alumni_view" id="alumni_view" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Unit Terakhir</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" style="width:auto;  height:27px; font-size:12px; padding:0px; " >
													<option value=""></option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Angkatan</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idangkatan1" id="idangkatan1" style="width:auto;  height:27px; font-size:12px; padding:0px; " >
													<option value=""></option>
													<?php select_angkatan_alumni($idangkatan1); ?>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td>Tahun Masuk</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="tahunmasuk" id="tahunmasuk" style="width:150px; height:20px; font-size:12px " value="<?php echo $tahunmasuk ?>">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Tanggal Lulus</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="tgllulus" class='datepick' id="tgllulus" style="height:20px;" autocomplete="off" value="<?php echo $tgllulus ?>">
												
											</td>
										</tr>
										
										<tr>	
											<td>Nama Alumni</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="nama" id="nama" style="width:150px; height:20px; font-size:12px " value="<?php echo $nama ?>">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Semua</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="all" name="all" value="1" <?php echo $all2 ?> />
											</td>											
										</tr>
										
										<tr>
											<td colspan="1">
												<input type="submit" name="submit" class='btn btn-primary' value="Find" onclick="submitForm('find')" >
											</td>
											
											<?php if ( allow("frmalumni")==1 ) { ?>
												<td colspan="6">
													<input type="button" name="submit" id="submit" class="btn btn-success" value="Tambah Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('alumni') ?> '" />
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
							<h3>DAFTAR ALUMNI</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
							
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_alumni($_REQUEST['id']);
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
													<th style="font-weight:bold ">Unit &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">NISN &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama Lengkap &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jenis Kelamin &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tahun Masuk &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Angkatan &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tanggal Lulus</th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select_view->list_alumni('', $departemen, $idangkatan1, $tahunmasuk, $tgllulus, $nama, $all);			
													
													while ($alumni_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$tanggal = date("d-m-Y", strtotime($alumni_view->tanggal));	
														
														if($alumni_view->kelamin == "P") {
															$kelamin = "Perempuan";
														} else {
															$kelamin = "Laki-laki";
														}	
														
														$bgcolor = "";
														if($alumni_view->kelas == "Umum") {
															$bgcolor = 'style="background-color: #3c0000; color: #fdf702"';
														}
												?>
													
													<tr>
														<td><?php echo $alumni_view->departemen ?></td>
														<td><?php echo $alumni_view->nis ?></td>
														<td><?php echo $alumni_view->nisn ?></td>
														<td><?php echo $alumni_view->nama ?></td>
														<td><?php echo $kelamin ?></td>
														<td><?php echo $alumni_view->tahunmasuk ?></td>
														<td><?php echo $alumni_view->angkatan ?></td>
														<td><?php echo $alumni_view->tgllulus ?></td>
														
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