<div class="box">
		<div class="box-head tabs">
			<h3>CALON SISWA</h3>	
			
									
		</div>
		
		<div class="box-content box-nomargin">
			
			<div class="tab-content">
					<div class="tab-pane active" id="basic">
					
					<form action="" method="post" name="penempatan_view" id="penempatan_view" class="form-horizontal" >
						<div style="overflow:auto; ">
						
							<input type="hidden" name="idangkatan1" id="idangkatan1"  value="<?php echo $idangkatan1 ?>">
							<input type="hidden" name="idangkatan" id="idangkatan"  value="<?php echo $idangkatan ?>">
							<input type="hidden" name="idtingkat" id="idtingkat"  value="<?php echo $idtingkat ?>">
							<input type="hidden" name="idkelas" id="idkelas"  value="<?php echo $idkelas ?>">
													
							<input type="hidden" name="idproses" id="idproses"  value="<?php echo $idproses ?>">
							<input type="hidden" name="idkelompok" id="idkelompok"  value="<?php echo $idkelompok ?>">
							<input type="hidden" name="nopendaftaran" id="nopendaftaran"  value="<?php echo $nopendaftaran ?>">
							<input type="hidden" name="nama" id="nama"  value="<?php echo $nama ?>">
							
							<?php
								if($post == "Proses") {																									include("app/exec/insert_penempatan.php");
								}
							?>
							
							<?php			
								$sql=$select_view->list_penempatan($idproses, $idkelompok, $nopendaftaran, $nama);			
								$rows_data = $sql->rowCount();
							?>
							<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $rows_data ?>" >
							
							<table class='table table-striped dataTable dataTable-noheader dataTable-nofooter table-bordered' style="font-size:11px; ">
							
								<thead>
									<tr>
										<th style="font-weight:bold ">No. &nbsp;&nbsp;</th>
										<th style="font-weight:bold ">No. Pendaftaran &nbsp;&nbsp;</th>
										<th style="font-weight:bold ">NISN &nbsp;&nbsp;</th>
										<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
										<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
										<th style="font-weight:bold ">Keterangan</th>
										<th style="font-weight:bold; width:100px; text-align: center;" class='table-checkbox'>
											<input type="checkbox" class='sel_all'>
										</th>										
									</tr>
								</thead>
								
								<tbody>
										
									<?php
										$i = 0;
										while ($penempatan_view=$sql->fetch(PDO::FETCH_OBJ)) {
											
											
									?>
										
										<input type="hidden" id="replid_<?php echo $i ?>" name="replid_<?php echo $i ?>" value="<?php echo $penempatan_view->replid ?>">
											
										<tr>
											<td style="text-align: center"><?php echo $i + 1 ?></td>
											<td style="font-size: 0px"><input type="text" name="nopendaftaran_<?php echo $i ?>" id="nopendaftaran_<?php echo $i ?>" readonly="" style="width: 110px" value="<?php echo $penempatan_view->nopendaftaran ?>">
												<?php echo $penempatan_view->nopendaftaran ?>
											</td>
											<td><?php echo $penempatan_view->nisn ?></td>
											<td><?php echo $penempatan_view->nama ?></td>
											<td><input type="text" name="nis_<?php echo $i ?>" id="nis_<?php echo $i ?>" style="width: 120px" value=""></td>
											<td><input type="text" name="keterangan_<?php echo $i ?>" id="keterangan_<?php echo $i ?>" style="width: 130px" value=""></td>
											
											<td style="text-align: center;">
												
												<input type="checkbox" class='selectable-checkbox' id="proses_<?php echo $i ?>" name="proses_<?php echo $i ?>" value="1" >
												
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
										<input type="submit" name="submit" class="btn btn-primary" value="Proses" onClick="return confirm('Apakah anda yakin menempatann siswa ke kelas ini?')" >
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