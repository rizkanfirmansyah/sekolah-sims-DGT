<!--<script src="js/pindah.js"></script>-->

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='kodepustaka') {
			alert('Data belum lengkap!');				
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

$post = $_POST[submit];

if($post == "Cari") {
	$kodepustaka = $_POST['kodepustaka'];	
	$ref = "";
} else {
	$ref = $_GET['search'];	
	$kodepustaka = "";
}

?>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>PENGEMBALIAN BUKU</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="kembali" id="kembali" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('kodepustaka');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
																				
										include("app/exec/insert_kembali.php"); 
										
										if ($ref != "") {
											$sql=$select->list_kembali($ref, $kodepustaka);			
											$kembali_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$ref2		=	$kembali_data->replid;
											$kodepustaka	=	$kembali_data->kodepustaka;
											$judul		=	$kembali_data->judul;
											$idanggota	=	$kembali_data->idanggota . " | " . $kembali_data->nama;
											$tglpinjam	=	date("d-m-Y", strtotime($kembali_data->tglpinjam));
											$tglkembali	=	date("d-m-Y", strtotime($kembali_data->tglkembali));
											
											$terlambat	=	$kembali_data->terlambat;
											if($terlambat <= 0) {
												$terlambat = 0;
											}
											$denda		=	$select->get_denda() * $terlambat;
											$denda	 	= 	number_format($denda,0,".",",");
											
											$keterangan	=	$kembali_data->keterangan;
											
											if($tglpinjam == '01-01-1970') {
												$tglpinjam = "";
											}
											
											if($tglkembali == '01-01-1970') {
												$tglkembali = "";
											}
											
																						
										} 
										
										if ($post == "Cari") {
											$sql=$select->list_kembali($ref, $kodepustaka);			
											$kembali_data=$sql->fetch(PDO::FETCH_OBJ);
											
											$kodepustaka	=	$kembali_data->kodepustaka;
											$ref2		=	$kembali_data->replid;
											$judul		=	$kembali_data->judul;
											$idanggota	=	$kembali_data->idanggota . " | " . $kembali_data->nama;
											$tglpinjam	=	date("d-m-Y", strtotime($kembali_data->tglpinjam));
											$tglkembali	=	date("d-m-Y", strtotime($kembali_data->tglkembali));
											
											$terlambat	=	$kembali_data->terlambat;
											if($terlambat <= 0) {
												$terlambat = 0;
											}
											$denda		=	$select->get_denda() * $terlambat;
											$denda	 	= 	number_format($denda,0,".",",");
											
											$keterangan	=	$kembali_data->keterangan;
											
											if($tglpinjam == '01-01-1970') {
												$tglpinjam = "";
											}
											
											if($tglkembali == '01-01-1970') {
												$tglkembali = "";
											}
										}	
										
									?>
									<table border="0">
										<input type="hidden" id="ref" name="ref" value="<?php echo $ref2 ?>" >
																				
										<tr>
											<td>Kode Pustaka</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td>
												<input type="text" name="kodepustaka" id="kodepustaka" value="<?php echo $kodepustaka ?>">	
												<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Cari" />												
											</td>
										</tr>
										
										<tr>
											<td>Judul Pustaka</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" readonly="" name="judul" id="judul" style="width: 400px" value="<?php echo $judul ?>"></td>
										</tr>
										
										<tr>
											<td>Anggota</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" readonly="" name="idanggota" id="idanggota" style="width: 400px" value="<?php echo $idanggota ?>"></td>
										</tr>
										
										<tr>
											<td>Tanggal Pinjam</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" readonly="" style="width:150px;"  name="tglpinjam" id="tglpinjam" value="<?php echo $tglpinjam ?>"/></td>
										</tr>
										
										<tr>
											<td>Tanggal Kembali</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" readonly="" style="width:150px;"  name="tglkembali" id="tglkembali" value="<?php echo $tglkembali ?>"/></td>
										</tr>
										
										<tr>
											<td>Terlambat (hari)</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" readonly="" style="width:150px;"  name="terlambat" id="terlambat" value="<?php echo $terlambat ?>"/></td>
										</tr>
										
										<tr>
											<td>Denda</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="denda" id="denda" onkeyup="formatangka('denda')" style="width:120px; height:16px; text-align: right; " value="<?php echo $denda ?>"></td>
										</tr>
										
										<tr>
											<td>Keterangan</td>
											<td>&nbsp;&nbsp;</td>
											<td>:</td>
											<td><input type="text" name="keterangan" id="keterangan" style="width:250px; height:16px; " value="<?php echo $keterangan ?>"></td>
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
												<?php if (allowadd('frmkembali')==1) { ?>
													<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Proses" />
												<?php } ?>
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('kembali_view') ?>'" />
												
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