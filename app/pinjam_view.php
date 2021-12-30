<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('pinjam') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
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
			$("#pinjam_view").attr('action', '')
				.attr('target', '_self');
			$("#pinjam_view").submit();
		}
		
		if(tipe == 'excel') {
			$("#pinjam_view").attr('action', 'app/pinjam_xls.php')
			   .attr('target', '_BLANK');
			$("#pinjam_view").submit();
		}
		
  		return false;	 
    }
		
</script>

<?php

$idanggota	= $_REQUEST['idanggota'];
$tglpinjam	= $_REQUEST['tglpinjam'];
$tglkembali	= $_REQUEST['tglkembali'];
$all		= $_REQUEST['all'];

$tglpinjam	= date("d-m-Y", strtotime($tglpinjam));	
$tglkembali	= date("d-m-Y", strtotime($tglkembali));

if($tglpinjam == '01-01-1970') {
	$tglpinjam = "";
}

if($tglpinjam == '') {
	$tglpinjam = date("d-m-Y");
}



if($tglkembali == '01-01-1970') {
	$tglkembali = "";
}

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
							<form action="" method="post" name="pinjam_view" id="pinjam_view" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Member</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idanggota" id="idanggota" class='cho' style="width:auto; height:27px; " >
													<option value="">...</option>
													<?php select_anggota($idanggota); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Tanggal Pinjam</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tglpinjam" id="tglpinjam" class='datepick' style="width:auto; height:20px; font-size: 12px" value="<?php echo $tglpinjam ?>" ></td>
											
										</tr>
										<tr>
											<td>Tanggal Kembali</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tglkembali" id="tglkembali" class='datepick' style="width:auto; height:20px; font-size: 12px" value="<?php echo $tglkembali ?>" ></td>
											
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
							<h3>DAFTAR PEMINJAMAN</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
							
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_pinjam_detail($_REQUEST['id']);
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
													<th style="font-weight:bold ">Anggota &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kode Pustaka &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Judul &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tanggal Pinjam &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jadwal Kembali &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Terlambat(hari) &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_pinjam($replid, $idanggota, $tglpinjam, $tglkembali, $all);			
													
													while ($pinjam_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$member	= $pinjam_view->idanggota . " | " . $pinjam_view->nama;
														
														$tglpinjam = date("d-m-Y", strtotime($pinjam_view->tglpinjam));
														$tglkembali = date("d-m-Y", strtotime($pinjam_view->tglkembali));	
														$now	= date("d-m-Y");
														$terlambat = "";
														$background = "";
														if($tglkembali < $now) {
															$terlambat	= $pinjam_view->terlambat;
															$background = 'style="background-color: #ff0000; color: #fff"';
														} 
														
												?>
													
													<tr>
														<td <?php echo $background ?>><?php echo $member ?></td>
														<td <?php echo $background ?>><?php echo $pinjam_view->kodepustaka ?></td>
														<td <?php echo $background ?>><?php echo $pinjam_view->judul ?></td>
														<td <?php echo $background ?>><?php echo $tglpinjam ?></td>
														<td <?php echo $background ?>><?php echo $tglkembali ?></td>
														<td <?php echo $background ?>><?php echo $pinjam_view->keterangan ?></td>
														<td style="text-align: center"><?php echo $terlambat ?></td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('kembali') ?>&search=<?php echo $pinjam_view->replid ?>" style="background-color: #46e916" >kembali</a>
															
															
															<?php if (allowdel('frmpinjam')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $pinjam_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
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