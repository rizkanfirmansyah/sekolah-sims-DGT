<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('datapenerimaan_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					
					<div class="box">
						<div class="box-head">
							<h3>Filter</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="datapenerimaan_view2" id="datapenerimaan_view2" class="form-horizontal" > <!--</form>onSubmit="return cekinput('idkategori,idpenerimaan');" >-->
								<div>
									
									<table border="0">
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
											<td>&nbsp;&nbsp;</td>
											<td colspan="3">
												<input type="submit" name="submit" class='btn btn-primary' value="Find" onclick="submitForm('find')" >
											</td>
										</tr>
										
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					
					<div class="box">
						<div class="box-head tabs">
							<h3>DAFTAR JENIS PENERIMAAN</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
						
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_datapenerimaan($_REQUEST['id']);
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
													<th style="font-weight:bold ">No &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Unit &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kategori &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kode Rekening &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Urutan &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Harus Lunas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select->list_datapenerimaan("", "", $_POST['departemen'], "");			
													
													while ($datapenerimaan_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$kas = $datapenerimaan_view->rekkas . ' ' . $datapenerimaan_view->namakas;
														$pendapatan = $datapenerimaan_view->rekpendapatan . ' ' . $datapenerimaan_view->namapendapatan;
														$piutang = $datapenerimaan_view->rekpiutang . ' ' . $datapenerimaan_view->namapiutang;
														$namaakun = $kas . "<br>" . $pendapatan . "<br>" . $piutang;
														
												?>
													
													<tr>
														<td><?php echo $i ?></td>
														<td><?php echo $datapenerimaan_view->departemen ?></td>
														<td><?php echo $datapenerimaan_view->kategori ?></td>
														<td><?php echo $datapenerimaan_view->nama ?></td>
														<td><?php echo $namaakun ?></td>
														<td><?php echo $datapenerimaan_view->nourut ?></td>
														<td style="text-align: center">
															<?php if ($datapenerimaan_view->full == 1) { ?>
																<img src="img/icons/essen/16/check.png" />
															<?php } else { ?>
																<img src="img/icons/essen/16/busy.png" />
															<?php } ?>
														</td>
														<td><?php echo $datapenerimaan_view->keterangan ?></td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('datapenerimaan') ?>&search=<?php echo $datapenerimaan_view->replid ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmdatapenerimaan')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $datapenerimaan_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
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