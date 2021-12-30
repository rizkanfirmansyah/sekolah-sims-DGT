<!--<script src="js/pindah.js"></script>-->

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='proses') {
			alert('Nama Proses tidak boleh kosong!');				
		  }
		  
		  
		  return false
		} 
										
	  }		 
	}	
</script>

<?php

$ref = $segmen3;

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Proses PSB</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="prosespenerimaansiswa" id="prosespenerimaansiswa" class="form-horizontal" onSubmit="return cekinput('proses');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_prosespenerimaansiswa.php"); 
										
										$act = "checked";
										
										if ($ref != "") {
											$sql=$select->list_prosespenerimaansiswa($ref);			
											$prosespenerimaansiswa_data=$sql->fetch(PDO::FETCH_OBJ);
											
											if ($prosespenerimaansiswa_data->aktif == 1) {
												$act = "checked";
											} else {
												$act = "";
											}
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >
										
										<tr>
											<td>Nama Proses *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="proses" id="proses" style="width:250px; height:16px; " value="<?php echo $prosespenerimaansiswa_data->proses ?>"></td>
										</tr>
										
										<tr>
											<td>Kode Awalan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="kodeawalan" id="kodeawalan" style="width:250px; height:16px; " value="<?php echo $prosespenerimaansiswa_data->kodeawalan ?>"></td>
										</tr>
										
										<tr>
											<td>Keterangan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="keterangan" id="keterangan" class='span12 input-square' rows="3"><?php echo $prosespenerimaansiswa_data->keterangan ?></textarea></td>
										</tr>
										
										<tr>
											<td>Aktif</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="checkbox" name="aktif" id="aktif" style="width:70px; height:16px; " value="1" <?php echo $act ?> ></td>	
										</tr>
										
										
										
										<tr>
											<td>&nbsp;&nbsp;</td>											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>									
										</tr>
										
									</table>
									
									
									<table>
										<tr>
											<td colspan="3">&nbsp;&nbsp;</td>								
										</tr>
										
										<tr>											
											<td colspan="3">
												<?php if (allowupd('frmproses')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmproses')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmproses')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('prosespenerimaansiswa_view') ?>'" />
												
											</td>
													
										</tr>
									</table>
									
								</div>								
							
						</div>	
						
								
										
						
						
						</form>
						
						<!--------------end Detail------------------ -->
					</div>
					
			</div>

		</div>
	</div>
</div>