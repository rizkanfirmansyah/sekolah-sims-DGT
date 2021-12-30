<!--<script src="js/pindah.js"></script>-->

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Toko/Supplier tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='alamat') {
			alert('Alamat tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='telepon') {
			alert('Telepon tidak boleh kosong!');				
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
							<h3>Toko/Supplier</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="supplier2" id="supplier2" class="form-horizontal" onSubmit="return cekinput('nama,alamat,telepon');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_supplier.php"); 
										
										$act = "checked";
										if ($ref != "") {
											$sql=$select->list_supplier($ref);			
											$supplier_data=$sql->fetch(PDO::FETCH_OBJ);
											
											if ($supplier_data->aktif == 1) {
												$act = "checked";
											} else {
												$act = "";
											}
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="replid" name="replid" value="<?php echo $ref ?>" >
										
										<?php if($ref != "") { ?>
											<tr>
												<td>Kode</td>
												<td>&nbsp;&nbsp;</td>
												<td>:</td>
												<td><input type="text" name="kode" id="kode" readonly="" style="width:250px; height:16px; " value="<?php echo $supplier_data->kode ?>"></td>
											</tr>
										<?php } ?>
										
										<tr>
											<td>Nama Toko/Supplier *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="nama" id="nama" style="width:250px; height:16px; " value="<?php echo $supplier_data->nama ?>"></td>
										</tr>
										
										<tr>
											<td>Alamat *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="alamat" id="alamat" style="width:250px; height:16px; " value="<?php echo $supplier_data->alamat ?>"></td>
										</tr>
										
										<tr>
											<td>Telepon *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="telepon" id="telepon" style="width:250px; height:16px; " value="<?php echo $supplier_data->telepon ?>"></td>
										</tr>
										
										<tr>
											<td>HP</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="hp" id="hp" style="width:250px; height:16px; " value="<?php echo $supplier_data->hp ?>"></td>
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
												<?php if (allowupd('frmsupplier')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmsupplier')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmsupplier')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('supplier_view') ?>'" />
												
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