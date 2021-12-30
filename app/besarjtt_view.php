<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='idpenerimaan') {
			alert('Jenis Penerimaan harus dipilih');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='idkategori') {
			alert('Kategori harus dipilih!');				
		  }
		  
		  
		  return false
		} 
										
	  }		 
	}	
	
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('besarjtt_view') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<script>
    function submitForm(tipe)
    {
		/*if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#delord_view").attr('action', 'app/delord_print.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
		if(tipe == 'find') {
			$("#besarjtt_view").attr('action', '')
				.attr('target', '_self');
			$("#besarjtt_view").submit();
		}
		
		/*if(tipe == 'excel') {
			$("#delord_view").attr('action', 'app/delord_xls.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
  		return false;	 
    }
		
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId, getId2){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		str2 = getId2 + '=' + document.getElementById(getId2).value;
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
		var str = str + '&button=' + button;
		var str2 = str2 + '&button=' + button;
		var str = str + '&' + str2;
		
		
		if (window.XMLHttpRequest){
			request = new XMLHttpRequest();
			request.onreadystatechange = processStateChange;
			request.open("POST", URL, true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
			request.send(str);		
					
		} else if (window.ActiveXObject) {
			request = new ActiveXObject("Microsoft.XMLHTTP");
			if (request) {
				request.onreadystatechange = processStateChange;
				request.open("POST", URL, true);
				request.send();				
			}
		}
				
	}
	 
</script>

<?php

$idangkatan	= $_REQUEST['idangkatan'];
$idtingkat2	= $_REQUEST['idtingkat2'];
$idkelas2	= $_REQUEST['idkelas2'];
$nama2		= $_REQUEST['nama2'];
$departemen	= $_REQUEST['departemen'];
$idkategori	= $_REQUEST['idkategori'];
$idpenerimaan	= $_REQUEST['idpenerimaan'];
$all		= $_REQUEST['all'];
		
?>


<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Filter</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="besarjtt_view" id="besarjtt_view" class="form-horizontal" > <!--</form>onSubmit="return cekinput('idkategori,idpenerimaan');" >-->
								<div>
									
									<table border="0">
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" style="width:auto; height:27px; " onchange="loadHTMLPost2('app/besarjtt_ajax.php','idtingkat2_id','getlevel','departemen', 'departemen')"/>
													<option value=""></option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Tahun Ajaran</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idangkatan" id="idangkatan" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<?php select_thnajaran($idangkatan); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Level</td>
											<td>&nbsp;&nbsp;</td>
											<td id="idtingkat2_id">
												<select name="idtingkat2" id="idtingkat2" style="width:auto;  height:20px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/besarjtt_ajax.php','idkelas2','gettingkat','idtingkat2', 'idangkatan')" />
													<option value=""></option>
													<?php select_tingkat($idtingkat2); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Kelas</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idkelas2" id="idkelas2" style="width:auto; height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php select_kelas($idtingkat2, $idkelas2); ?>
												</select>
											</td>
											
										</tr>
										
										<!--
										<tr>
											<td>Semua</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="all" name="all" value="1" />
											</td>											
										</tr>-->
										
										<tr>
											<td>Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="nama2" id="nama2" style="width:150px; height:10px; font-size:12px " value="">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Kategori</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idkategori" id="idkategori" style="width:auto; height:27px; " onClick="loadHTMLPost2('app/besarjtt_ajax.php','idpenerimaan','getkategori','idkategori', 'departemen')" />
													<option value=""></option>
													<?php select_kategoripenerimaan($idkategori); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Jenis Penerimaan</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idpenerimaan" id="idpenerimaan" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php select_datapenerimaan($idkategori, $departemen, $idpenerimaan); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td colspan="7">
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
							<h3>DAFTAR SETUP PEMBAYARAN</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
							
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_besarjtt($_REQUEST['id']);
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
										<!--<table class='table table-striped dataTable table-bordered' style="font-size:11px; width:4000px ">-->
										
										<table class='table table-striped dataTable table-bordered' style="font-size:11px; ">
											<thead>
												<tr>
													<th style="font-weight:bold ">NIS &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama Lengkap &nbsp;&nbsp;</th>														<th style="font-weight:bold ">Level &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jumlah Bayar &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Besar Cicilan &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Potongan/Beasiswa &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$sql=$select_view->list_siswabesarjtt('', '', $idtingkat2, $idkelas2, $nama2, $all, $idkategori, $idpenerimaan, $idangkatan, $departemen);			
													
													while ($besarjtt_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$tanggal = date("d-m-Y", strtotime($besarjtt_view->tanggal));	
														
														if($besarjtt_view->kelamin == "P") {
															$kelamin = "Perempuan";
														} else {
															$kelamin = "Laki-laki";
														}	
														
														//-------
														$nis			=	$besarjtt_view->nis;
														$idpenerimaan	=	$besarjtt_view->idpenerimaan;
														$idangkatan		=	$besarjtt_view->idangkatan;
														$besar = 0;
														$cicilan = 0;
														$replidjtt = '0';
														$potongan = 0;
													
													$sqlbesarjtt=$select_view->list_besarjtt($nis, $idpenerimaan, $departemen);														while($besarjtt=$sqlbesarjtt->fetch(PDO::FETCH_OBJ)) {
															$replidjtt	=	$besarjtt->replid;
															$besar		=	number_format($besarjtt->besar,0,".",",");
															$cicilan	=	number_format($besarjtt->cicilan,0,".",",");
															$potongan	=	number_format($besarjtt->potongan,0,".",",");	
														}
														
														if($replidjtt == '0') {
															$replidjtt = 'NIS|'.$nis.'|'.$idkategori.'|'.$departemen.'|'.$idpenerimaan.'|'.$idangkatan;
														}
														
														
												?>
													
													<tr>
														<td><?php echo $besarjtt_view->nis ?></td>
														<td><?php echo $besarjtt_view->nama ?></td>
														<td><?php echo $besarjtt_view->tingkat ?></td>
														<td><?php echo $besarjtt_view->kelas ?></td>
														<td align="right"><?php echo $besar ?></td>
														<td align="right"><?php echo $cicilan ?></td>
														<td align="right"><?php echo $potongan ?></td>
														<td>
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('besarjtt') ?>&search=<?php echo $replidjtt ?>" style="background-color: #46e916" >edit</a>
															
															
															<?php if (allowdel('frmbesarjtt')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus(<?php echo $replidjtt ?>)" style="background-color: #ff0000">hapus</i> 
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