<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('jabatan_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR JABATAN</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
						
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_jabatan($_REQUEST['id']);
							?>
									<div class="alert alert-success">
										<strong>Delete Data successfully</strong>
									</div>
							<?php
								}
							?>


							<div class="tab-content">
							
									<?php if (allowadd('frmjabatan')==1) { ?>
										<div style="margin-left: 5px; margin-top: 5px; margin-bottom: 5px">
											<input type="button" name="submit" id="submit" class="btn btn-primary" value="Tambah Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('jabatan') ?>'" />
												
										</div>
									<?php } ?>
									
									<div class="tab-pane active" id="basic">
										<div style="overflow:auto; ">
										
										<table class='table table-striped dataTable table-bordered' style="font-size:11px; ">
											<thead>
												<tr>
													<th style="font-weight:bold ">Jabatan &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Aktif &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">User ID &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Date Last Update &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_jabatan();			
													
													while ($jabatan_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
												?>
													
													<tr>
														<td><?php echo $jabatan_view->nama ?></td>
														<td style="text-align: center">
															<?php if ($jabatan_view->aktif == 1) { ?>
																<img src="img/icons/essen/16/check.png" />
															<?php } else { ?>
																<img src="img/icons/essen/16/busy.png" />
															<?php } ?>
														</td>
														<td><?php echo $jabatan_view->uid ?></td>
														<td><?php echo $jabatan_view->dlu ?></td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('jabatan') ?>&search=<?php echo $jabatan_view->replid ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmjabatan')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $jabatan_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
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