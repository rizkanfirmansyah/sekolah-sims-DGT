<script src="js/pindah.js"></script>

<script language="javascript">
	function cekinput(fid) {  
	  var arrf = fid.split(',');
	  for(i=0; i < arrf.length; i++) {
		if(document.getElementById(arrf[i]).value=='') {       
		  
		  if (document.getElementById(arrf[i]).name=='DLNo') {
			alert('No DL tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='OutBldCde') {
			alert('No Order tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='SPTNo') {
			alert('Nomor tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='Dte') {
			alert('Tanggal tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='FrmDte') {
			alert('Tanggal Berangkat tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='ClnCde') {
			alert('Pelanggan tidak boleh kosong!');				
		  }
		  
		  if (document.getElementById(arrf[i]).name=='Ktg') {
			alert('Kategori tidak boleh kosong!');				
		  }
		  
		  return false
		} 
										
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
<script type="text/javascript" src="jsdynamic/jquery.min.js"></script>
<?php

$slipno		= $_POST['slipno'];
$fromdate	= $_POST['fromdate'];
$todate		= $_POST['todate'];
$periodid	= $_POST['periodid'];
$tpe		= $_POST['tpe'];
$labid		= $_POST['labid'];
$sts		= $_POST['sts'];
$clientid	= $_POST['clientid'];


$ref = $_GET['search'];
				

?>

<!-------autocomplete function-------------------------------->
<script type="text/javascript" src="app/js_auto/jquery.js"></script>

<script type="text/javascript" src="app/js_auto/auto_client.js"></script>
<link type="text/css" href="app/js_auto/auto_client.css" rel="stylesheet" />

<script type="text/javascript" src="app/js_auto/auto_kauttp.js"></script>
<link type="text/css" href="app/js_auto/auto_kauttp.css" rel="stylesheet" />

<!-------end function----------------------------------------->

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Dinas Luar</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="dinasluar" id="dinasluar" class="form-horizontal" onSubmit="return cekinput('DLNo,OutBldCde,SPTNo,Dte,FrmDte,ClnCde,Ktg');">
								<div>
									<?php
										
										//jika saat add data, maka data setelah save kosong
										if ($_POST['submit'] == 'Save') { $ref = ''; }
										//-----------------------------------------------/\
										
										$ref2 = notran(date('y-m-d'), 'frmOutBld', '', '', ''); //---get no ref
										
										include("app/exec/insert_dl.php"); 
										
										$Dte		= date("d-m-Y");
										$FrmDte		= date("d-m-Y");
										$ToDte		= date("d-m-Y");
										$tglselesai	= date("d-m-Y",strtotime('+7 days'));
										$nowyear	= date("Y");	

										$DLNo	=	GetDLNo('');
										$SPTNo	=	Nomor_SPT($Dte,"");
										
										$jabatan	=   explode("|",GetKaUTTP(""));
										$Jbt		=	$jabatan[2];
										$DirMet		=	"Direktur Metrologi";
										$KaUTTP		=	$jabatan[0];
										$KaUTTPName	=	$jabatan[1];
										
										$Btl	= "";
										if ($ref != "") {
											$sql=$select->list_dl($ref);			
											$row_dl=odbc_fetch_object($sql);
											
											$ref2 = $row_dl->OutBldCde;
											$Dte = date("d-m-Y", strtotime($row_dl->Dte));																$FrmDte = date("d-m-Y", strtotime($row_dl->FrmDte));
											$ToDte	= date("d-m-Y", strtotime($row_dl->ToDte));
											$tglselesai	= date("d-m-Y", strtotime($row_dl->tglselesai));
											$TglAlat = date("d-m-Y", strtotime($row_dl->TglAlat));
											if($TglAlat == "01-01-1970") {
												$TglAlat = "";
											}
											
											$DLNo = $row_dl->DLNo;
											$SPTNo = $row_dl->SPTNo;
											$Jbt = $row_dl->Jbt;
											$DirMet = $row_dl->DirMet;
											$KaUTTP		=	$row_dl->KaUTTP;
											$KaUTTPName	=	$row_dl->KaUTTPName;
											$Btl	=	$row_dl->Btl;
											$nowyear = date("Y", strtotime($row_dl->Dte));
											
											$Ktg = $row_dl->Ktg;
											if($Ktg == "Uji") { $Ktg = "2"; };
											if($Ktg == "Tera") { $Ktg = "0"; };
											if($Ktg == "Tera Ulang") { $Ktg = "1"; };
											if($Ktg == "Penelitian") { $Ktg = "3"; };
											if($Ktg == "Uji Ulang") { $Ktg = "4"; };
											if($Ktg == "Kalibrasi") { $Ktg = "5"; };
											if($Ktg == "Verifikasi") { $Ktg = "6"; };
																		
											if($Btl == 1) {
												$Btl = " checked";	
											}
											
										}	
										
									?>
									<table border="0">
										<tr>
											<td>Periode</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="periodid" id="periodid" style="width:auto; height:27px; " />
													<?php period_combo_select($nowyear); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>No DL *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="DLNo" id="DLNo" style="width:auto; height:16px;" value="<?php echo $DLNo ?>"></td>											
										</tr>
										<tr>
											<td>No Order *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="OutBldCde" id="OutBldCde" style="width:auto; height:16px;" readonly="" value="<?php echo $ref2; ?>" ></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>Nomor *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="SPTNo" id="SPTNo" style="width:auto; height:16px;" value="<?php echo $SPTNo; ?>"></td>
											
											
										</tr>
										<tr>
											<td>Tanggal *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="Dte" class='datepick' id="Dte" style="width:70px; height:16px; " value="<?php echo $Dte ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td rowspan="2">Untuk</td>
											<td rowspan="2">&nbsp;&nbsp;</td>
											<td rowspan="2">
												<textarea name="JobDcr" id="JobDcr" rows="auto"><?php echo $row_dl->JobDcr ?></textarea>
											</td>
										</tr>
										<tr>
											<td>Tanggal Berangkat *)</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="FrmDte" class='datepick' id="FrmDte" style="width:70px; height:16px; " value="<?php echo $FrmDte ?>"></td>
											
										</tr>
										<tr>
											<td>Tanggal Kembali</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="ToDte" class='datepick' id="ToDte" style="width:70px; height:16px; " value="<?php echo $ToDte ?>"></td>
											
											<td>&nbsp;&nbsp;</td>											
											<td rowspan="2">Dasar Penugasan</td>
											<td rowspan="2">&nbsp;&nbsp;</td>
											<td rowspan="2">
												<textarea name="ForTo" id="ForTo" rows="auto"><?php echo $row_dl->ForTo ?></textarea>
											</td>
											
										</tr>
										<tr>
											<td>Tanggal Selesai</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="tglselesai" class='datepick' id="tglselesai" style="width:70px; height:16px; " value="<?php echo $tglselesai ?>"></td>
											
										</tr>
										<tr>
											<td valign="top">Pelanggan *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input size="20" type="text" onKeyUp="suggest(this.value,'app/js_auto/auto_client.php');" onchange="fill2();" id="ClnCde" name="ClnCde" value="<?php echo $row_dl->ClnCde ?>">
												<br>
												<input size="20" type="text" style="background-color:#E2F6C5;" readonly="" id="ClientName" name="ClientName" onchange="fill();" value="<?php echo $row_dl->ClientName ?>">
												
												<div class="suggestionsBox" id="suggestions" style="display: none;">
													<img src="app/js_auto/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
													<div class="suggestionList" id="suggestionsList"> &nbsp; </div>
												</div>
																							
											</td>
											
											<td>&nbsp;&nbsp;</td>											
											<td>Jabatan</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="Jbt" id="Jbt" style="width:auto; height:16px; width: 300px" value="<?php echo $Jbt ?>"></td>											
										</tr>
										<tr>
											<td>Kategori *)</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="Ktg" id="Ktg" style="width:auto;height:20px; font-size:12px; padding:0px;" />
													<option value=""></option>
													<?php kategori_combo_select($Ktg); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Direktorat Metrologi</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="DirMet" id="DirMet" style="width:auto; height:16px; width: 300px" value="<?php echo $DirMet ?>"></td>											
											
										</tr>
										
										<tr>
											<td valign="top">Ka. UTTP</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input size="20" type="text" onKeyUp="suggest2(this.value,'app/js_auto/auto_kauttp.php');" onchange="fillka2();" id="KaUTTP" name="KaUTTP" value="<?php echo $KaUTTP ?>">
												<br>
												<input size="20" type="text" style="background-color:#E2F6C5;" readonly="" id="KaUTTPName" name="KaUTTPName" onchange="fillka();" value="<?php echo $KaUTTPName ?>">
												
												<div class="suggestionsBox2" id="suggestions2" style="display: none;">
													<img src="app/js_auto/arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
													<div class="suggestionList2" id="suggestionsList2"> &nbsp; </div>
												</div>		
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Tanggal Input Alat</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="TglAlat" class='datepick' id="TglAlat" style="width:70px; height:16px; " value="<?php echo $TglAlat ?>">&nbsp;&nbsp;&nbsp;&nbsp;
												Batal&nbsp;<input type="checkbox" name="Btl" id="Btl" value="1" <?php echo $Btl ?> />
												
											</td>
												
											
										</tr>
										
										<tr>											
											<td colspan="7">
												&nbsp;
											</td>
													
										</tr>
										
										<tr>											
											<td colspan="7">
												<?php if($ref!='') { ?>
													<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Update" />
												<?php } ?>
												
												<?php if($ref=='') { ?>
													<input type="submit" name="submit" id="submit" class='btn btn-primary' value="Save" />
												<?php } ?>
													
												&nbsp;
												<input type="submit" name="submit" id="submit" class="btn btn-danger" value="Hapus" />
												&nbsp;
												<input type="button" name="submit" id="submit" class="btn btn-success" value="List Data" onclick="self.location='main.php?menu=app&act=dinasluar_view'" />
												
											</td>
													
										</tr>
										
										
										
									</table>
									
								</div>								
							
						</div>	
						
						<!--------------Detail---------------------- -->
						<div class="box-content">
							<div class="box-head tabs">
								<h3></h3>
								<ul class="nav nav-tabs">
									<li class='active'>
										<a href="#0" data-toggle="tab">Petugas</a>
									</li>
									<li>
										<a href="#1" data-toggle="tab">Alat</a>
									</li>
									<li>
										<a href="#2" data-toggle="tab">Memo</a>
									</li>
								</ul>
							</div>
							
							<div class="box-content">
								<div class="tab-content">
									<div class="tab-pane active" id="0">
										<?php 
											if($ref == "") {
												include("dinasluar_peg.php"); 	
											} else {
												include("dinasluar_peg_edit.php"); 
											}
											
										?> 
									</div>
									<div class="tab-pane" id="1">
										<?php 
											if($ref == "") {
												include("dinasluar_itm.php"); 
											} else {
												include("dinasluar_itm_edit.php");
											}
										?> 
									</div>
									<div class="tab-pane" id="2">
										Header 1
										<textarea name="Surat1" id="Surat1" rows="10" cols="200"><?php echo $row_dl->Surat1 ?></textarea>
										&nbsp;&nbsp;&nbsp;
										Header 2
										<textarea name="Surat2" id="Surat2" rows="10" cols="200"><?php echo $row_dl->Surat2 ?></textarea>										
									</div>
								</div>
							</div>
							
						</div>
						
						</form>
						
						<!--------------end Detail------------------ -->
					</div>
					
			</div>

		</div>
	</div>
</div>