<!--<script src="js/pindah.js"></script>-->

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='kategori') {
			alert('Kategori tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='kode') {
			alert('Kode tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='nama') {
			alert('Nama tidak boleh kosong!');				
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
							<h3>Rekening Perkiraan</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="rekakun2" id="rekakun2" class="form-horizontal" onSubmit="return cekinput('kategori,kode,nama');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_rekakun.php"); 
										
										$act = "checked";
										if ($ref != "") {
											$sql=$select->list_rekakun($ref);			
											$rekakun_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$tanggalmulai	=	date("d-m-Y", strtotime($rekakun_data->tanggalmulai));
											
											if ($rekakun_data->aktif == 1) {
												$act = "checked";
											} else {
												$act = "";
											}
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >
												
										<tr>
											<td>Kategori *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<select name="kategori" id="kategori" style="width:auto; height:27px; " />
													<?php select_kategoriakun($rekakun_data->kategori); ?>
												</select>
											</td>
										</tr>
												
										<tr>
											<td>Kode *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="kode" id="kode" style="width:250px; height:16px; " value="<?php echo $rekakun_data->kode ?>"></td>
										</tr>
										
										<tr>
											<td>Nama *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="nama" id="nama" style="width:250px; height:16px; " value="<?php echo $rekakun_data->nama ?>"></td>
										</tr>
										
										<tr>
											<td>Keterangan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><textarea name="keterangan" id="keterangan" class='span12 input-square' rows="3"><?php echo $rekakun_data->keterangan ?></textarea></td>
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
												<?php if (allowupd('frmrekakun')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmrekakun')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmrekakun')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('rekakun_view') ?>'" />
												
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