<?php
session_start();
?>

<script src="js/pindah.js"></script>

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
			$("#antrian").attr('action', '')
				.attr('target', '_self');
			$("#antrian").submit();
		}
		
		/*if(tipe == 'excel') {
			$("#delord_view").attr('action', 'app/delord_xls.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
  		return false;	 
    }
		
</script>

<?php

$massal		= $_REQUEST['massal'];
$volume		= $_REQUEST['volume'];
$suhu		= $_REQUEST['suhu'];
$meterbbm	= $_REQUEST['meterbbm'];
$massa		= $_REQUEST['massa'];
$klh		= $_REQUEST['klh'];
$panjang	= $_REQUEST['panjang'];
$gt			= $_REQUEST['gt'];
$metergas 	= $_REQUEST['metergas'];
$labpanjang = $_REQUEST['labpanjang'];
$semua 		= $_REQUEST['semua'];
$meterair 	= $_REQUEST['meterair'];
$listrik 	= $_REQUEST['listrik'];

$massalx = "";
if($massal == 1) {
	$massalx = "checked";
}	

$volumex = "";
if($volume == 1) {
	$volumex = "checked";
}

$suhux = "";
if($suhu == 1) {
	$suhux = "checked";
}

$meterbbmx = "";
if($meterbbm == 1) {
	$meterbbmx = "checked";
}

$massax = "";
if($massa == 1) {
	$massax = "checked";
}

$klhx = "";
if($klh == 1) {
	$klhx = "checked";
}

$panjangx = "";
if($panjang == 1) {
	$panjangx = "checked";
}

$massalx = "";
if($massal == 1) {
	$massalx = "checked";
}

$gtx = "";
if($gt == 1) {
	$gtx = "checked";
}

$metergasx = "";
if($metergas == 1) {
	$metergasx = "checked";
}

$labpanjangx = "";
if($labpanjang == 1) {
	$labpanjangx = "checked";
}

$semuax = "";
if($semua == 1) {
	$semuax = "checked";
}

$meterairx = "";
if($meterair == 1) {
	$meterairx = "checked";
}	

$listrikx = "";
if($listrik == 1) {
	$listrikx = "checked";
}

$m_volume = $_REQUEST['m_volume']; 
	
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
							<form action="" method="post" name="antrian" id="antrian" class="form-horizontal">
								<div>
									
									<?php		
										$sql=$select->list_antrianperlab($massal, $volume, $suhu, $meterbbm, $massa, $klh, $panjang, $gt, $metergas, $labpanjang, $semua, $meterair, $listrik);	
										
										$total = 0; 
										while ($data_master2 = odbc_fetch_object($sql)) {
											
											if($data_master2->LABID == 1) {
												$m_volume = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}
											
											if($data_master2->LABID == 2) {
												$m_massa = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}
											
											if($data_master2->LABID == 3) {
												$m_gt = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}
											
											if($data_master2->LABID == 4) {
												$m_lab_panjang = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}

											if($data_master2->LABID == 5) {
												$m_listrik = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}

											if($data_master2->LABID == 6) {
												$m_suhu = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}
  
  											if($data_master2->LABID == 7) {
												$m_klh = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}
 
											if($data_master2->LABID == 8) {
												$m_timbangan_listrik = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}
      
      										if($data_master2->LABID == 11) {
												$m_meter_bbm = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}
											
											if($data_master2->LABID == 12) {
												$m_panjang = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}
											
											if($data_master2->LABID == 14) {
												$m_inst_gas = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}
      
      										if($data_master2->LABID == 15) {
												$m_inst_meter_air = "(". $data_master2->jumlahantri . ")";
												$total = $total + $data_master2->jumlahantri;
											}
      
											
										}
										
										$total = "Total : ". $total;
																							
									?>
									
									<table width="70%" border="0">
										<tr style="height: 25px">
											<td align="center" valign="middle">
												<input type="checkbox" id="massal" name="massal" value="1" <?php echo $massalx  ?> >
											</td>
											<td valign="bottom">INSTALASI MASSA TIMBANGAN & LISTRIK</td>
											<td align="center" valign="middle">
												<?php echo $m_timbangan_listrik; ?>
											</td>
											
											
											<td>&nbsp;&nbsp;</td>
											<td align="center" valign="middle">
												<input type="checkbox" id="volume" name="volume" value="1" <?php echo $volumex  ?> >
											</td>
											<td valign="bottom">LAB. VOLUME</td>
											<td align="center" valign="middle">
												<?php echo $m_volume; ?>
											</td>
										
											<td>&nbsp;</td>
											<td align="center" valign="middle">
												<input type="checkbox" id="suhu" name="suhu" value="1" <?php echo $suhux  ?> >
											</td>
											
											<td valign="bottom">LAB. SUHU</td>
											<td align="center" valign="middle">
												<?php echo $m_suhu; ?>
											</td>
										</tr>
										<tr style="height: 25px">
											<td align="center" valign="middle">
												<input type="checkbox" id="meterbbm" name="meterbbm" value="1" <?php echo $meterbbmx  ?> >
											</td>
											<td valign="bottom">INSTALASI METER BBM</td>
											<td align="center" valign="middle">
												<?php echo $m_meter_bbm; ?>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td align="center" valign="middle">
												<input type="checkbox" id="massa" name="massa" value="1" <?php echo $massax  ?> >
											</td>
											<td valign="bottom">LAB. MASSA</td>
											<td align="center" valign="middle">
												<?php echo $m_massa; ?>
											</td>
											
																						
											<td>&nbsp;</td>
											<td align="center" valign="middle">
												<input type="checkbox" id="klh" name="klh" value="1" <?php echo $klhx  ?> >
											</td>
											<td valign="bottom">LAB. KLH</td>
											<td align="center" valign="middle">
												<?php echo $m_klh; ?>
											</td>
												
										</tr>
										<tr style="height: 25px">
											<td align="center" valign="middle">
												<input type="checkbox" id="panjang" name="panjang" value="1" <?php echo $panjangx  ?> >
											</td>
											<td valign="bottom">INSTALASI PANJANG</td>
											<td align="center" valign="middle">
												<?php echo $m_panjang; ?>
											</td>
											
																						
											<td>&nbsp;&nbsp;</td>
											<td align="center" valign="middle">
												<input type="checkbox" id="gt" name="gt" value="1" <?php echo $gtx  ?> >
											</td>
											<td valign="bottom">LAB. G & T</td>
											<td align="center" valign="middle">
												<?php echo $m_gt; ?>
											</td>
										</tr>
										<tr style="height: 25px">
											<td align="center" valign="middle">
												<input type="checkbox" id="metergas" name="metergas" value="1" <?php echo $metergasx  ?> >
											</td>
											<td valign="bottom">INSTALASI METER GAS</td>
											<td align="center" valign="middle">
												<?php echo $m_inst_gas; ?>
											</td>
																	
											<td>&nbsp;&nbsp;</td>
											<td align="center" valign="middle">
												<input type="checkbox" id="labpanjang" name="labpanjang" value="1" <?php echo $labpanjangx  ?> >
											</td>
											<td valign="bottom">LAB. PANJANG</td>
											<td align="center" valign="middle">
												<?php echo $m_lab_panjang; ?>
											</td>
											
											
											<td>&nbsp;</td>
											<td align="center" valign="middle">
												<input type="checkbox" id="semua" name="semua" value="1" <?php echo $semuax  ?> >
											</td>
											<td valign="bottom">SEMUA</td>
											<td align="center" valign="middle">
												<?php echo $total; ?>
											</td>
										</tr>
										<tr style="height: 25px">
											<td align="center" valign="middle">
												<input type="checkbox" id="meterair" name="meterair" value="1" <?php echo $meterairx  ?> >
											</td>
											<td valign="bottom">INSTALASI METER AIR</td>
											<td align="center" valign="middle">
												<?php echo $m_inst_meter_air; ?>
											</td>
											
											
											<td>&nbsp;&nbsp;</td>
											<td align="center" valign="middle">
												<input type="checkbox" id="listrik" name="listrik" value="1" <?php echo $listrikx  ?> >
											</td>
											<td valign="bottom">LAB. LISTRIK</td>
											<td align="center" valign="middle">
												<?php echo $m_listrik; ?>
											</td>
											
																						
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td valign="bottom"><input type="submit" name="submit" class='btn btn-primary' value="Refresh" onclick="submitForm('find')" ></td>
											
										</tr>
									</table>
									
								</div>								
							
							</form>
							
						</div>	
					</div>
					
					<div class="box">
						<div class="box-head tabs">
							<h3>Status Antrian</h3>	
							
							<ul class='nav nav-tabs'>
								<li class='active'>
									<a href="#basic" data-toggle="tab">Antrian</a>
								</li>
							</ul>						
						</div>
							
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<div style="overflow: auto;">
										<!--<table class='table table-striped dataTable table-bordered' style="font-size:11px; width:4000px ">-->
										
										<table class='table dataTable table-bordered' style="font-size:11px;">
											<thead>
												<tr>
													<th style="font-weight:bold ">No Order &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama Lab. &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama Alat &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Objek Kalibrasi &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tanggal Selesai &nbsp;&nbsp;</th>													
												</tr>
											</thead>
											
											<tbody>
											
												<?php		
													$sql=$select->list_antrian($massal, $volume, $suhu, $meterbbm, $massa, $klh, $panjang, $gt, $metergas, $labpanjang, $semua, $meterair, $listrik);	
													
													while ($data_master = odbc_fetch_object($sql)) {
														
														
														$i++;
														
														$tglselesai	= date("d-m-Y", strtotime($data_master->TglSelesai));
																												
												?>
													
													<tr>
														
														<td><?php echo $data_master->SlipNo ?></td>
														<td><?php echo $data_master->NamaLab ?></td>
														<td><?php echo $data_master->Nama_Barang ?></td>
														<td><?php echo $data_master->Objek_Kalibrasi ?></td>
														<td><?php echo $tglselesai ?></td>
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