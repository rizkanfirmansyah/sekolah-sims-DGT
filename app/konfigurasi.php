<!--<script src="js/pindah.js"></script>-->

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='judul') {
			alert('Judul tidak boleh kosong!');				
		  }
		  
		  return false
		} 
										
	  }		 
	}	
</script>

<script>
	function formatangka(field) {
		 //a = rci.amt.value;	 
		 a = document.getElementById(field).value;
		 //alert(a);
		 b = a.replace(/[^\d-.]/g,""); //b = a.replace(/[^\d]/g,"");
		 c = "";
		 panjang = b.length;
		 j = 0;
		 for (i = panjang; i > 0; i--)
		 {
			 j = j + 1;
			 if (((j % 3) == 1) && (j != 1))
			 {
			 	c = b.substr(i-1,1) + "," + c;
			 } else {
			 	c = b.substr(i-1,1) + c;
			 }
		 }
		 //rci.amt.value = c;
		 c = c.replace(",.",".");
		 c = c.replace(".,",".");
		 document.getElementById(field).value = c;		
		 
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
							<h3>KONFIGURASI</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="konfigurasi" id="konfigurasi" class="form-horizontal" enctype="multipart/form-data" >
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_konfigurasi.php"); 
										
										if ($ref != "") {
											$sql=$select->list_konfigurasi($ref);			
											$konfigurasi_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$siswa = number_format($konfigurasi_data->siswa,0,".",",");
											$pegawai = number_format($konfigurasi_data->pegawai,0,".",",");
											$other = number_format($konfigurasi_data->other,0,".",",");
											$denda = number_format($konfigurasi_data->denda,0,".",",");
											
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="id" name="id" value="<?php echo $ref ?>" >
																				
										<tr>
											<td>Max. Pinjam Siswa</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="siswa" id="siswa" onkeyup="formatangka('siswa')" style="width:120px; height:16px; text-align: right; " value="<?php echo $siswa ?>"></td>
										</tr>
										
										<tr>
											<td>Max. Pinjam Pegawai</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="pegawai" id="pegawai" onkeyup="formatangka('pegawai')" style="width:120px; height:16px; text-align: right; " value="<?php echo $pegawai ?>"></td>
										</tr>
										
										<tr>
											<td>Max. Pinjam Luar Sekolah</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="other" id="other" onkeyup="formatangka('other')" style="width:120px; height:16px; text-align: right; " value="<?php echo $other ?>"></td>
										</tr>
										
										<tr>
											<td>Denda (per hari)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="denda" id="denda" onkeyup="formatangka('denda')" style="width:120px; height:16px; text-align: right; " value="<?php echo $denda ?>"></td>
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
												<?php if (allowupd('frmkonfigurasi')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmkonfigurasi')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowdel('frmkonfigurasi')==1) { ?>		
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('konfigurasi_view') ?>'" />
												
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