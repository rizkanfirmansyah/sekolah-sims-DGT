<!--<script src="js/pindah.js"></script>-->

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='departemen') {
			alert('Departemen tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Nama tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='rekdebet') {
			alert('Rek. Kas tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='rekkredit') {
			alert('Rek. Beban tidak boleh kosong!');				
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
							<h3>Jenis Pengeluaran</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="datapengeluaran2" id="datapengeluaran2" class="form-horizontal" onSubmit="return cekinput('departemen,nama,rekdebet,rekkredit');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_datapengeluaran.php"); 
										
										$act = "checked";
										if ($ref != "") {
											$sql=$select->list_datapengeluaran($ref);			
											$datapengeluaran_data=$sql->fetch(PDO::FETCH_OBJ);
											
											if ($datapengeluaran_data->aktif == 1) {
												$act = "checked";
											} else {
												$act = "";
											}											
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >
										<input type="hidden" id="oldnama" name="oldnama" value="<?php echo $datapengeluaran_data->nama ?>" >
										<input type="hidden" id="olddepartemen" name="olddepartemen" value="<?php echo $datapengeluaran_data->departemen ?>" >
										
										<tr>
											<td>Departemen *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="departemen" id="departemen" style="width:auto; height:27px; " />
													<?php select_departemen($datapengeluaran_data->departemen); ?>
												</select>
											</td>
										</tr>
																				
										<tr>
											<td>Nama *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="nama" id="nama" style="width:250px; height:16px; " value="<?php echo $datapengeluaran_data->nama ?>"></td>
										</tr>
										
										<tr>
											<td>Rek. Kas *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="rekdebet" id="rekdebet" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_rekakun('HARTA', $datapengeluaran_data->rekdebet); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Rek. Beban *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="rekkredit" id="rekkredit" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_rekakun('BIAYA', $datapengeluaran_data->rekkredit); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Keterangan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="keterangan" id="keterangan" class='span12 input-square' rows="3"><?php echo $datapengeluaran_data->keterangan ?></textarea></td>
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
												<?php if (allowupd('frmdatapengeluaran')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmdatapengeluaran')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmdatapengeluaran')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('datapengeluaran_view') ?>'" />
												
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