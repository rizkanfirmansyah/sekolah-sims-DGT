<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('konfigurasi_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR KONFIGURASI</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
						
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_konfigurasi($_REQUEST['id']);
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
										
										<table class='table table-striped dataTable table-bordered' style="font-size:11px; ">
											<thead>
												<tr>													
													<th style="font-weight:bold ">Max. Pinjam Siswa &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Max. Pinjam Pegawai &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Max. Pinjam Luar Sekolah &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Denda (per hari) &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Date Last Update &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_konfigurasi();			
													
													while ($konfigurasi_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$siswa = number_format($konfigurasi_view->siswa,0,".",",");
														$pegawai = number_format($konfigurasi_view->pegawai,0,".",",");
														$other = number_format($konfigurasi_view->other,0,".",",");
														$denda = number_format($konfigurasi_view->denda,0,".",",");
																												
												?>
													
													<tr>														
														<td style="text-align: right"><?php echo $siswa ?></td>
														<td style="text-align: right"><?php echo $pegawai ?></td>
														<td style="text-align: right"><?php echo $other ?></td>
														<td style="text-align: right"><?php echo $denda ?></td>
														<td style="text-align: right"><?php echo $konfigurasi_view->ts ?>&nbsp;</td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('konfigurasi') ?>&search=<?php echo $konfigurasi_view->replid ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmkonfigurasi')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $konfigurasi_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
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