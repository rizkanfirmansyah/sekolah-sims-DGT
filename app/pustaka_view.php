<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('pustaka_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR PUSTAKA</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
						
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_pustaka($_REQUEST['id']);
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
													<th style="font-weight:bold ">Judul &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Keyword &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Penulis &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Penerbit &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Harga &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Alokasi Jml Buku &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_pustaka();			
													
													while ($pustaka_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$harga = number_format($pustaka_view->harga,0,".",",");
														$jumlah = $select->list_pustaka_alokasi($pustaka_view->replid);
																												
												?>
													
													<tr>														
														<td><?php echo $pustaka_view->judul ?></td>
														<td><?php echo $pustaka_view->keyword ?></td>
														<td><?php echo $pustaka_view->namapenulis ?></td>
														<td><?php echo $pustaka_view->namapenerbit ?></td>
														<td style="text-align: right"><?php echo $harga ?>&nbsp;</td>
														<td style="text-align: center"><?php echo $jumlah ?></td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('pustaka') ?>&search=<?php echo $pustaka_view->replid ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmpustaka')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $pustaka_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
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