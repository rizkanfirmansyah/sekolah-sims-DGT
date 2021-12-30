<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			
			departemen = document.getElementById('departemen').value;
			daritgl = document.getElementById('daritgl').value;
			ketgl = document.getElementById('ketgl').value;
			idtingkat = document.getElementById('idtingkat').value;
			idkelas = document.getElementById('idkelas').value;
			nama = document.getElementById('nama').value;
			all = document.getElementById('all').checked;
			
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('rpt_presensi_harian_siswa') ?>&mxKz=xm8r389xemx23xb2378e23&departemen="+departemen+"&daritgl="+daritgl+"&ketgl="+ketgl+"&idtingkat="+idtingkat+"&idkelas="+idkelas+"&nama="+nama+"&id="+id+"&all="+all+" ";
		}
	}
	
	function getpenerimaan_update(tnis, tbayar, ref, idpenerimaan) {
		//document.location.href = "../app/penerimaanjtt_update.php?nis="+tnis+"&bayar="+tbayar+"&ref="+ref;
		
		newWindow('app/penerimaanjtt_update.php?nis='+tnis+'&bayar='+tbayar+'&ref='+ref +'&idpenerimaan='+idpenerimaan +' ','Update Nota','800','500','resizable=1,scrollbars=1,status=0,toolbar=0');
	}
</script>

<script>
    function submitForm(tipe)
    {
    	
		if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#rpt_presensi_harian_siswa_view").attr('action', 'app/rpt_presensi_harian_siswa_print.php')
			   .attr('target', '_BLANK');
			$("#rpt_presensi_harian_siswa_view").submit();
			
		} 
		
		if(tipe == 'find') {
			$("#rpt_presensi_harian_siswa_view").attr('action', '')
				.attr('target', '_self');
			$("#rpt_presensi_harian_siswa_view").submit();
		}
		
		if(tipe == 'excel') {
			$("#rpt_presensi_harian_siswa_view").attr('action', 'app/rpt_presensi_harian_siswa_xls.php')
			   .attr('target', '_BLANK');
			$("#rpt_presensi_harian_siswa_view").submit();
		}
		
  		return false;	 
    }
    
    function cetaknota(ref) 
	{	
		newWindow('app/kuitansijtt_multi.php?ref='+ ref +' ','Nota','800','500','resizable=1,scrollbars=1,status=0,toolbar=0');
	}
    //http://localhost/sekolahsma2/app/kuitansijtt_multi.php?ref=RCP-0716-00003
		
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		
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

include 'class/class.select.print.php';

$select_print = new select_print;

$find  		= $_POST['submit'];

if($find == "Preview") {
	$departemen	= $_POST['departemen'];	
	$daritgl	= $_POST['daritgl'];
	$ketgl		= $_POST['ketgl'];
	$idtingkat	= $_POST['idtingkat'];
	$idkelas	= $_POST['idkelas'];
	$nama		= $_POST['nama'];
	$all		= $_POST['all'];
} else {
	$departemen	= $_REQUEST['departemen'];	
	$daritgl	= $_REQUEST['daritgl'];
	$ketgl		= $_REQUEST['ketgl'];
	$idtingkat	= $_REQUEST['idtingkat'];
	$idkelas	= $_REQUEST['idkelas'];
	$nama		= $_REQUEST['nama'];
	$all		= $_REQUEST['all'];
}

if ($all == 1 && $all == true) {
	$all = "checked";
} else {
	$all = "";
}

if($daritgl == "") { $daritgl = date("d-m-Y"); }
if($ketgl == "") { $ketgl	 = date("d-m-Y"); }
	
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
							<form action="" method="post" name="rpt_presensi_harian_siswa_view" id="rpt_presensi_harian_siswa_view" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" style="width:auto; height:27px; " onchange="loadHTMLPost2('app/rpt_presensi_harian_siswa_ajax.php','idtingkat_id','getlevel','departemen')"/>
													<option value=""></option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Dari Tanggal</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="daritgl" class='datepick' id="daritgl" style="width:70px; height:16px; " value="<?php echo $daritgl ?>"></td>
											
											<td>&nbsp;&nbsp;</td>
											<td>s/d Tanggal</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="ketgl" class='datepick' id="ketgl" style="width:70px; height:16px; " value="<?php echo $ketgl ?>"></td>
											
										</tr>
										
										<tr>
											<td>Level</td>
											<td>&nbsp;&nbsp;</td>
											<td id="idtingkat_id">
												<select name="idtingkat" id="idtingkat" style="width:auto;  height:20px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/rpt_presensi_harian_siswa_ajax.php','idkelas','getkelas','idtingkat')" />
													<option value=""></option>
													<?php select_tingkat_unit($departemen, $idtingkat); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Kelas</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idkelas" id="idkelas" style="width:auto; height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php select_kelas($idtingkat, $idkelas); ?>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td>Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="nama" id="nama" style="width:150px; height:20px; font-size:12px " value="<?php echo $nama ?>">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td></td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<!--<input type="checkbox" id="all" name="all" value="1" <?php echo $all ?> />-->
											</td>											
										</tr>
										
										<tr>
											<td colspan="7">&nbsp;</td>
										</tr>
										
										<tr>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Preview" onclick="submitForm('find')" >
											</td>
											<!--<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Cetak" onclick="submitForm('print')" >
											</td>
											<td></td>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Ekspor Excel" onclick="submitForm('excel')" >
											</td>-->											
										</tr>
										
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					<div class="box">
						<div class="box-head tabs">
							<h3>LAPORAN PENERIMAAN</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
							
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_rpt_presensi_harian_siswa($_REQUEST['id']);
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
													<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Level-Kelas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tanggal &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Hadir &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Ijin &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Sakit &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Alpa &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Cuti &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
																							
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$total = 0;
													
													$sql=$select_view->rpt_presensi_harian_siswa($daritgl, $ketgl, $nis, $kelas, $idtingkat, $nama, $departemen);			
													
													while ($rpt_presensi_harian_siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$kelas = $rpt_presensi_harian_siswa_view->tingkat . ' - ' . $rpt_presensi_harian_siswa_view->kelas;
												?>
													
													
													
													<tr>
														<td><?php echo $rpt_presensi_harian_siswa_view->nis ?></td>
														<td><?php echo $rpt_presensi_harian_siswa_view->nama ?></td>
														<td><?php echo $kelas ?></td>
														<td><?php echo $rpt_presensi_harian_siswa_view->tanggal1 ?></td>
														<td><?php echo $rpt_presensi_harian_siswa_view->hadir ?></td>
														<td><?php echo $rpt_presensi_harian_siswa_view->ijin ?></td>
														<td><?php echo $rpt_presensi_harian_siswa_view->sakit ?></td>
														<td><?php echo $rpt_presensi_harian_siswa_view->alpa ?></td>
														<td><?php echo $rpt_presensi_harian_siswa_view->cuti ?></td>
														<td><?php echo $rpt_presensi_harian_siswa_view->keterangan ?></td>
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