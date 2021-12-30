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
			$("#rpt_pinjam").attr('action', '')
				.attr('target', '_self');
			$("#rpt_pinjam").submit();
		}
		
		if(tipe == 'excel') {
			$("#rpt_pinjam").attr('action', 'app/rpt_pinjam_xls.php')
			   .attr('target', '_BLANK');
			$("#rpt_pinjam").submit();
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
						<div class="box-head tabs">
							<h3>DAFTAR PEMINJAMAN</h3>	
							
													
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
													
													$color_late = "";
													
													$sql=$select_view->list_pinjam($replid, $idanggota, $tglpinjam, $tglkembali, 1);			
													
													while ($rpt_pinjam=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$member	= $rpt_pinjam->idanggota . " | " . $rpt_pinjam->nama;
														
														$tglpinjam = date("d-m-Y", strtotime($rpt_pinjam->tglpinjam));
														$tglkembali = date("d-m-Y", strtotime($rpt_pinjam->tglkembali));	
														$terlambat	= $rpt_pinjam->terlambat;
														if($terlambat < 0) {
															$terlambat = 0;
															
															$color_late = "";
														} else {
															$color_late = "color: red";
														}
														
														
												?>
													
													<tr>
														<td><?php echo $member ?></td>
														<td><?php echo $rpt_pinjam->kodepustaka ?></td>
														<td><?php echo $rpt_pinjam->judul ?></td>
														<td><?php echo $tglpinjam ?></td>
														<td><?php echo $tglkembali ?></td>
														<td><?php echo $rpt_pinjam->keterangan ?></td>
														<td style="text-align: center; <?php echo $color_late ?> "><?php echo $terlambat ?></td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('kembali') ?>&search=<?php echo $rpt_pinjam->replid ?>" style="background-color: #46e916" >kembali</a>
															
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