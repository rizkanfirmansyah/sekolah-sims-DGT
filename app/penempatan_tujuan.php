<div class="box">
		<div class="box-head tabs">
			<h3>TINGKAT TUJUAN</h3>	
			
									
		</div>
		
		<div class="box-content box-nomargin">
			
			<?php
				//$insert->insert_penempatan($idkelas, $idkelas2);
			?>
							
			<div class="tab-content">
					<div class="tab-pane active" id="basic">
						<div style="overflow:auto; ">
						
						<table class='table table-striped dataTable dataTable-noheader dataTable-nofooter table-bordered' style="font-size:11px; ">
						
							<thead>
								<tr>
									<th style="font-weight:bold ">No. &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
									<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>										
								</tr>
							</thead>
							
							<tbody>
							
								<?php			
									$sql=$select_view->list_penempatan_tujuan($idangkatan1, $idangkatan, $idtingkat, $idkelas);			
									$i = 0;
									while ($penempatan_view=$sql->fetch(PDO::FETCH_OBJ)) {
										
										$i++;
										
										$kelas = $penempatan_view->tingkat . " - " . $penempatan_view->kelas;
										
								?>
									
									<tr>
										<td style="text-align: center"><?php echo $i ?></td>
										<td><?php echo $penempatan_view->nis ?></td>
										<td><?php echo $penempatan_view->nama ?></td>
										<td><?php echo $kelas ?></td>
										<td><?php echo $penempatan_view->keterangan ?></td>
										
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