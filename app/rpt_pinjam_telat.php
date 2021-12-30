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
			$("#rpt_pinjam_telat").attr('action', '')
				.attr('target', '_self');
			$("#rpt_pinjam_telat").submit();
		}
		
		if(tipe == 'excel') {
			$("#rpt_pinjam_telat").attr('action', 'app/rpt_pinjam_telat_xls.php')
			   .attr('target', '_BLANK');
			$("#rpt_pinjam_telat").submit();
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
							<form action="" method="post" name="rpt_pinjam_telat" id="rpt_pinjam_telat" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Member</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idanggota" id="idanggota" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_anggota($idanggota); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Tanggal Pinjam</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tglpinjam" id="tglpinjam" class='datepick' style="width:auto; height:10px; font-size: 12px" value="<?php echo $tglpinjam ?>" ></td>
											
										</tr>
										<tr>
											<td>Tanggal Kembali</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tglkembali" id="tglkembali" class='datepick' style="width:auto; height:10px; font-size: 12px" value="<?php echo $tglkembali ?>" ></td>
											
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
							<h3>DAFTAR PEMINJAMAN YANG TERLAMBAT</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
							
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
													$sql=$select_view->list_pinjam_telat($replid, $idanggota, $tglpinjam, $tglkembali, $all);			
													
													while ($rpt_pinjam_telat=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$member	= $rpt_pinjam_telat->idanggota . " | " . $rpt_pinjam_telat->nama;
														
														$tglpinjam = date("d-m-Y", strtotime($rpt_pinjam_telat->tglpinjam));
														$tglkembali = date("d-m-Y", strtotime($rpt_pinjam_telat->tglkembali));	
														$terlambat	= $rpt_pinjam_telat->terlambat;
														
														
												?>
													
													<tr>
														<td><?php echo $member ?></td>
														<td><?php echo $rpt_pinjam_telat->kodepustaka ?></td>
														<td><?php echo $rpt_pinjam_telat->judul ?></td>
														<td><?php echo $tglpinjam ?></td>
														<td><?php echo $tglkembali ?></td>
														<td><?php echo $rpt_pinjam_telat->keterangan ?></td>
														<td style="text-align: center"><?php echo $terlambat ?></td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('kembali') ?>&search=<?php echo $rpt_pinjam_telat->replid ?>" style="background-color: #46e916" >kembali</a>
															
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