<div class="box">
		<div class="box-head tabs">
			<h3>TINGKAT AWAL</h3>	
			
									
		</div>
		
		<div class="box-content box-nomargin">
			
			<div class="tab-content">
					<div class="tab-pane active" id="basic">
					
					<form action="" method="post" name="kenaikan_view" id="kenaikan_view" class="form-horizontal" onSubmit="return cekinput('idangkatan,idtingkat');" >
						<div style="overflow:auto; ">
						
							<input type="hidden" name="idangkatan" id="idangkatan"  value="<?php echo $idangkatan ?>">
							<input type="hidden" name="idtingkat" id="idtingkat"  value="<?php echo $idtingkat ?>">
							<input type="hidden" name="idkelas" id="idkelas"  value="<?php echo $idkelas ?>">
							<input type="hidden" name="nis" id="nis"  value="<?php echo $nis ?>">
							<input type="hidden" name="nama" id="nama"  value="<?php echo $nama ?>">
							<input type="hidden" name="idangkatan2" id="idangkatan2"  value="<?php echo $idangkatan2 ?>">
							<input type="hidden" name="idtingkat2" id="idtingkat2"  value="<?php echo $idtingkat2 ?>">
							<input type="hidden" name="idkelas2" id="idkelas2"  value="<?php echo $idkelas2 ?>">
							
							<?php
								if($post == "Proses Naik") {																							include("app/exec/insert_kenaikan.php");
								}
							?>
							
							<?php			
								$sql=$select_view->list_kenaikan($idangkatan, $idtingkat, $idkelas, $nis, $nama, $all);			
								$rows_data = $sql->rowCount();
							?>
							<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $rows_data ?>" >
							
							<table class='table table-striped dataTable dataTable-noheader dataTable-nofooter table-bordered' style="font-size:11px; ">
							
								<thead>
									<tr>
										<th style="font-weight:bold ">No. &nbsp;&nbsp;</th>
										<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
										<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
										<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
										<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
										<th style="font-weight:bold; width:100px; text-align: center;" class='table-checkbox'>
											<input type="checkbox" class='sel_all'>
										</th>										
									</tr>
								</thead>
								
								<tbody>
										
									<?php
										$i = 0;
										while ($kenaikan_view=$sql->fetch(PDO::FETCH_OBJ)) {
											
											$kelas = $kenaikan_view->tingkat . " - " . $kenaikan_view->kelas;
											
									?>
											
										<tr>
											<td style="text-align: center"><?php echo $i + 1 ?></td>
											<td><input type="text" name="nis_<?php echo $i ?>" id="nis_<?php echo $i ?>" readonly="" value="<?php echo $kenaikan_view->nis ?>"></td>
											<td><?php echo $kenaikan_view->nama ?></td>
											<td><?php echo $kelas ?></td>
											<td>
												<input type="text" name="keterangan_<?php echo $i ?>" id="keterangan_<?php echo $i ?>" style="width:150px; height:10px; font-size:12px " value="">	
											</td>
											
											<td style="text-align: center;">
												
												<input type="checkbox" class='selectable-checkbox' id="naik_<?php echo $i ?>" name="naik_<?php echo $i ?>" value="1" >
												
											</td>
											
										</tr>
																							
									<?php
										
										$i++;
									
									}
									?>
									
								</tbody>
								
							</table>	
						
							<table>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr> 
									<td style="padding-left: 15px">
										<input type="submit" name="submit" class="btn btn-primary" value="Proses Naik" onClick="return confirm('Apakah anda yakin akan menaikkan ke level lebih tinggi?')" >
										<!--document.location.reload(true);-->
										<!-- onClick="return confirm('Apakah anda yakin akan menaikkan ke tingkat lebih tinggi?')"-->
									</td>
								</tr>
							</table>
						
						</div>
						
						
						</form>
						
						<br>
					</div>
					
			</div>
		</div>
		
</div>