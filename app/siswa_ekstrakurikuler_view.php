<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('siswa_ekstrakurikuler_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
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
			$("#siswa_ekstrakurikuler").attr('action', '')
				.attr('target', '_self');
			$("#siswa_ekstrakurikuler").submit();
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

$departemen2= $_REQUEST['departemen2'];
$idtingkat2	= $_REQUEST['idtingkat2'];
$idkelas2	= $_REQUEST['idkelas2'];
$nis2		= $_REQUEST['nis2'];
$nama2		= $_REQUEST['nama2'];
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
							<form action="" method="post" name="siswa_ekstrakurikuler_view" id="siswa_ekstrakurikuler_view" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php select_departemen($departemen2); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>NIS</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="nis" id="nis" style="width:150px; height:10px; font-size:12px " value="<?php echo $nis2 ?>">
											</td>
											
										</tr>
										
										<tr>
											<td>Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="nama" id="nama" style="width:150px; height:10px; font-size:12px " value="<?php echo $nama2 ?>">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Semua</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="all" name="all" value="1" <?php echo $all2 ?> />
											</td>											
										</tr>
										
										<tr>
											<td colspan="7">
												<input type="submit" name="submit" class='btn btn-primary' value="Find" onclick="submitForm('find')" >
											</td>											
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
									$delete2->delete_siswa_ekstrakurikuler($_REQUEST['id']);
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
													<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tingkat&nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select_view->list_siswa_ekstrakurikuler($bagian, $nip, $nama, $all);			
													
													while ($siswa_ekstrakurikuler_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														if($siswa_ekstrakurikuler_view->kelamin == "P") {
															$kelamin = "Perempuan";
														} else {
															$kelamin = "Laki-laki";
														}	
												?>
													
													<tr>
														<td><?php echo $siswa_ekstrakurikuler_view->departemen ?></td>
														<td><?php echo $siswa_ekstrakurikuler_view->nis ?></td>
														<td><?php echo $siswa_ekstrakurikuler_view->nama ?></td>
														<td><?php echo $siswa_ekstrakurikuler_view->tingkat ?></td>
														<td><?php echo $siswa_ekstrakurikuler_view->kelas ?></td>
														
														<td>
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('siswa_ekstrakurikuler') ?>&search=<?php echo $siswa_ekstrakurikuler_view->replid ?>&a=a" style="background-color: #46e916" >add</a>
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('siswa_ekstrakurikuler') ?>&search=<?php echo $siswa_ekstrakurikuler_view->replid ?>&a=e" style="background-color: #134ed5" >edit</a>
															
															
															<?php /* if (allowdel('frmsiswa_ekstrakurikuler')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $siswa_ekstrakurikuler_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
																</a>
															<?php } */ ?>
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