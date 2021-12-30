<script type="text/javascript" src="js/buttonajax.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='idanggota') {
			alert('Anggota tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='tglpinjam') {
			alert('Tanggal Pinjam tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='tglkembali') {
			alert('Tanggal Kembali tidak boleh kosong!');				
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
	
    function submitForm(tipe)
    {
		/*if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#delord_view").attr('action', 'app/delord_print.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
		if(tipe == 'find') {
			$("#laborder").attr('action', '')
				.attr('target', '_self');
			$("#laborder").submit();
		}
		
		if(tipe == 'list') {
			$("#dinasluar").attr('action', "main.php?menu=app&act=dinasluar_view")
				.attr('target', '_self');
			$("#dinasluar").submit();
		}
		
		/*if(tipe == 'excel') {
			$("#delord_view").attr('action', 'app/delord_xls.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
  		return false;	 
    }
		
</script>
<!--<script type="text/javascript" src="jsdynamic/jquery.min.js"></script>-->

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		//str ='pchordnbr2='+ document.getElementById('pchordnbr2').value;
		var str = str + '&button=' + button;
		
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

<script type="text/javascript">

	function departemen_member() {
		var unt = document.getElementById('jenis_anggota').value;
		document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('pinjam') ?>&unt="+unt+"";
	}
	
	function hapus(id,dtl) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			var unt = document.getElementById('jenis_anggota').value;
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('pinjam') ?>&mxKz=xm8r389xemx23xb2378e23&ndf="+id+"&dtl="+dtl+"&unt="+unt+" ";
		}
	}
	
	function getpustaka() {
		var kodepustaka = document.getElementById('kodepustaka').value;
		
		document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('pinjam') ?>&kodepustaka="+kodepustaka+" ";
	}
	
	function focusNext(elemName, evt) 
	{
	    evt = (evt) ? evt : event;
	    var charCode = (evt.charCode) ? evt.charCode :
	        ((evt.which) ? evt.which : evt.keyCode);
	    if (charCode == 13) 
		 {
			document.getElementById(elemName).focus();
	      return false;
	    }
	    return true;
	}
</script>

<?php

/*
$slipno		= $_POST['slipno'];
$fromdate	= $_POST['fromdate'];
$todate		= $_POST['todate'];
$periodid	= $_POST['periodid'];
$tpe		= $_POST['tpe'];
$labid		= $_POST['labid'];
$sts		= $_POST['sts'];
$clientid	= $_POST['clientid'];
*/

$ref = $_GET['search'];
$iddetail = $_GET['dtl'];
$kodepustaka = $_GET["kodepustaka"];				

?>


<!-------autocomplete function-------------------------------->
<!--<script type="text/javascript" src="app/js_auto/auto_pinjam.js"></script>
<link type="text/css" href="app/js_auto/auto_pinjam.css" rel="stylesheet" />-->
<!-------end function----------------------------------------->

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>PEMINJAMAN BUKU</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="pinjam" id="pinjam" class="form-horizontal" enctype="multipart/form-data" onSubmit="return cekinput('idanggota,tglpinjam,tglkembali');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Simpan') { $ref = ''; }
										//-----------------------------------------------/\
										
										$ref2 = notran(date('y-m-d'), 'frmpinjam', '', '', ''); //---get no ref
										
										include("app/exec/insert_pinjam.php"); 
										
										$tglpinjam	= date("d-m-Y");
                                        $days       = date("Y-m-d");
										$tglkembali	= date("d-m-Y", strtotime($days . '+ 2 days'));
										
										$departemen = $_SESSION["unit"];
										
										if($_GET["unt"] != "") {
											$jenis_anggota = $_GET["unt"];
										} else {
											$jenis_anggota = $_SESSION["unit"];
										}
										
										
										if ($ref != "") {
											$sql=$select->list_pinjam($ref);			
											$pinjam=$sql->fetch(PDO::FETCH_OBJ);
											
											$ref2 	= $pinjam->replid;
											$departemen = $pinjam->departemen;
											$jenis_anggota = $pinjam->jenis_anggota;
											
											$tglpinjam = date("d-m-Y", strtotime($pinjam->tglpinjam));
											if($tglpinjam == "01-01-1970") {
												$tglpinjam = "";
											}
											
											$tglkembali = date("d-m-Y", strtotime($pinjam->tglkembali));
											if($tglkembali == "01-01-1970") {
												$tglkembali = "";
											}
											
											
										}	
										
										if ($iddetail != "") {
											
											$delete = $_REQUEST['mxKz'];
											if ($delete == "xm8r389xemx23xb2378e23") {
												//include 'class/class.delete.php';
												$delete2=new delete;
												$delete2->delete_pinjam_detail($_REQUEST['ndf']);
											}
											
											$sql=$select->list_pinjam_detail_presave($iddetail);
											$pinjam_detail=$sql->fetch(PDO::FETCH_OBJ);
											
											$idanggota	=	$pinjam_detail->idanggota;
											$keterangan	=	$pinjam_detail->keterangan;
											
										}
										
									?>
									<table border="0">
										<input type="hidden" id="replid" name="replid" value="<?php echo $ref2 ?>" >
										<input type="hidden" id="departemen" name="departemen" value="<?php echo $departemen ?>" >
										
										<tr>
											<td>Jenis Anggota</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="jenis_anggota" id="jenis_anggota" class='cho' style="width:min-width:10px; height:27px; " onchange="departemen_member()" >
													<option value="">...</option>
													<?php select_jenismember($jenis_anggota); ?>
												</select>
											</td>
																	
										</tr>
										
										<tr>
											<td>Anggota *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idanggota" id="idanggota" class='cho' style="width:auto; height:27px; " >
													<option value=""></option>
													<?php select_anggota_unit($jenis_anggota, $idanggota); ?>
												</select>
											</td>
																	
										</tr>
										
										<tr>
											<td>Keterangan</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="keterangan" id="keterangan" style="width:300px; height:16px; " value="<?php echo $keterangan ?>"></td>
																	
										</tr>
										
										<tr>
											<td colspan="7" align="center">
												<h4 style="color: #fff; font-weight: bold; background-color:#4b8ce4 "><span class="break"></span>DAFTAR PEMINJAMAN</h4>
											</td>
										</tr>
										
										<tr>
											<td colspan="7">
                                                
												<?php 
													if($ref == "") {
														include("pinjam_buku.php");
													} else {
														include("pinjam_buku_update.php");
													}
												?>
											</td>
										</tr>
										
										
										
										<tr>											
											<td colspan="7">
												&nbsp;
											</td>
													
										</tr>
										<tr>											
											<td colspan="7">
												&nbsp;
											</td>
													
										</tr>
										
									</table>
									
									
									
									<table>
										<tr>											
											<td colspan="7">
												<?php if (allowupd('frmpinjam')==1) { ?>
													<?php if($ref!='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" onClick="return confirm('Data akan diupdate, apakah data sudah lengkap?')" />
													<?php } ?>
												<?php } ?>
												
												<?php if (allowadd('frmpinjam')==1) { ?>
													<?php if($ref=='') { ?>
														<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Simpan" onClick="return confirm('Data akan disimpan, apakah data sudah lengkap?')" />
														
														&nbsp;
														<input type="submit" name="submit" id="submit" class="btn btn-danger" value="Batal" onClick="return confirm('Apakah Data akan dibatalkan?')" />
													<?php } ?>
												<?php } ?>
												
												<?php /*if (allowdel('frmpinjam')==1) { ?>	
													&nbsp;
													<input type="submit" name="submit" class="btn btn-danger" value="Hapus" onClick="return confirm('Apakah Anda yakin akan menghapus data?')" >
												<?php } */?>
												
												
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='<?php echo $nama_folder . obraxabrix('pinjam_view') ?>'" />
											
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