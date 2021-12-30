<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('rpt_lunas') ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
		}
	}
</script>

<script>
    function submitForm(tipe)
    {
    	
		if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#rpt_lunas_view").attr('action', 'app/rpt_lunas_print.php')
			   .attr('target', '_BLANK');
			$("#rpt_lunas_view").submit();
			
		} 
		
		if(tipe == 'find') {
			$("#rpt_lunas_view").attr('action', '')
				.attr('target', '_self');
			$("#rpt_lunas_view").submit();
		}
		
		if(tipe == 'excel') {
			$("#rpt_lunas_view").attr('action', 'app/rpt_lunas_xls.php')
			   .attr('target', '_BLANK');
			$("#rpt_lunas_view").submit();
		}
		
  		return false;	 
    }
    
    function cetaklunas(nis) 
	{	
		newWindow('app/rpt_lunas_single_print.php?nis='+ nis +' ','Invoice Tagihan','800','500','resizable=1,scrollbars=1,status=0,toolbar=0');
	}
    //http://localhost/sekolahsma2/app/kuitansijtt_multi.php?ref=RCP-0716-00003
		
</script>

<script type="text/javascript">
	var request;
	var dest;
	
	function loadHTMLPost2(URL, destination, button, getId){
		dest = destination;	
		str = getId + '=' + document.getElementById(getId).value;		
		
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

<?php

$find  		= $_POST['submit'];
if($find == '') {
	
	$daritgl = date("d-m-Y");
	$ketgl	 = date("d-m-Y");
	
} else {
	
	$departemen = $_REQUEST['departemen'];	
	$daritgl	= $_REQUEST['daritgl'];
	$ketgl		= $_REQUEST['ketgl'];
	$idtingkat	= $_REQUEST['idtingkat'];
	$idkelas	= $_REQUEST['idkelas'];
	$nama		= $_REQUEST['nama'];
	$all		= $_REQUEST['all'];
	
	if ($all == 1) {
		$all = "checked";
	} else {
		$all = "";
	}
}
		
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
							<form action="" method="post" name="rpt_lunas_view" id="rpt_lunas_view" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" style="width:auto; height:27px; " onchange="loadHTMLPost2('app/rpt_lunas_ajax.php','idtingkat','getlevel','departemen')"/>
													<option value=""></option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
										</tr>
										
										<?php /*
										<tr>
											<td>Dari Tanggal</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="daritgl" class='datepick' id="daritgl" style="width:70px; height:16px; " value="<?php echo $daritgl ?>"></td>
											
											<td>&nbsp;&nbsp;</td>
											<td>s/d Tanggal</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="ketgl" class='datepick' id="ketgl" style="width:70px; height:16px; " value="<?php echo $ketgl ?>"></td>
											
										</tr>*/ ?>
										
										<tr>
											<td>Level</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idtingkat" id="idtingkat" style="width:auto;  height:20px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/rpt_lunas_ajax.php','idkelas','getkelas','idtingkat')" />
													<option value=""></option>
													<?php select_tingkat_unit($departemen, $idtingkat); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Kelas</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="idkelas" id="idkelas" style="width:auto; height:20px; font-size:12px; padding:0px; " />
													<option value=""></option>
													<?php select_kelas($idtingkat, $idkelas); ?>
												</select>
											</td>
											
										</tr>
										
										<tr>
											<td>Nama</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="nama" id="nama" style="width:150px; height:10px; font-size:12px " value="<?php echo $nama ?>">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Semua</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="all" name="all" value="1" <?php echo $all ?> />
											</td>											
										</tr>
										
										<tr>
											<td colspan="7">&nbsp;</td>
										</tr>
										
										<tr>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Preview" onclick="submitForm('find')" >
											</td>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Cetak" onclick="submitForm('print')" >
											</td>
											<td></td>
											<!--<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Ekspor Excel" onclick="submitForm('excel')" >
											</td>	-->										
										</tr>
										
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					<div class="box">
						<div class="box-head tabs">
							<h3>LAPORAN PELUNASAN</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
							
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_rpt_lunas($_REQUEST['id']);
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
													<th style="font-weight:bold ">Nama &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kelas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jumlah Bayar &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Terbayar&nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Potongan/Beasiswa &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Sisa Bayar &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Ket. &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>
																							
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$total_bayar = 0;
													$total = 0;
													$total_sisa = 0;
													
													//$sql=$select_view->list_rpt_lunas($daritgl, $ketgl, $idtingkat, $idkelas, $nama, $departemen, $all);
													$sql=$select_view->list_rpt_lunas("", "", $idtingkat, $idkelas, $nama, $departemen, $all);			
													
													while ($rpt_lunas_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$tanggal = date("d-m-Y", strtotime($rpt_lunas_view->tanggal));	
														$kelas = $rpt_lunas_view->tingkat . '-' . $rpt_lunas_view->kelas;
														$besar = number_format($rpt_lunas_view->besar,0,".",",");
														$total_bayar = $total_bayar + $rpt_lunas_view->besar;
														
														$jumlah = number_format($rpt_lunas_view->jumlah,0,".",",");
														$potongan = number_format($rpt_lunas_view->potongan,0,".",",");
														$sisa = $rpt_lunas_view->besar - $rpt_lunas_view->jumlah;
														if($sisa == 0) {
															$ket = "Lunas";
														} else {
															$ket = "Belum Lunas";
														}
														$total_sisa = $total_sisa + $sisa;
														$sisa = number_format($sisa,0,".",",");
														$total = numberreplace($total) +  numberreplace($rpt_lunas_view->jumlah) - numberreplace($rpt_lunas_view->potongan);
														
												?>
													
													<tr>
														<td><?php echo $rpt_lunas_view->nis ?></td>
														<td><?php echo $rpt_lunas_view->nama ?></td>
														<td><?php echo $kelas ?></td>
														<td style="font-weight: bold; text-align: right;"><?php echo $besar ?></td>
														<td style="font-weight: bold; text-align: right;"><?php echo $jumlah ?></td>
														<td style="font-weight: bold; text-align: right;"><?php echo $potongan ?></td>
														<td style="font-weight: bold; text-align: right;"><?php echo $sisa ?></td>
														<td><?php echo $ket ?></td>
														
														<td>
															
															<!--<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('rpt_lunas') ?>&search=<?php echo $rpt_lunas_view->replid ?>" style="background-color: #46e916" >edit</a>-->
															
															
															<a class="label label-success" href="JavaScript:cetaklunas('<?php echo $rpt_lunas_view->nis ?>')" style="background-color: #46e916">detail</i> 
															</a>
																
															<!--
															
															<?php if (allowdel('rpt_lunas')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $rpt_lunas_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
																</a>
															<?php } ?>-->
														</td>
														
													</tr>
																										
												<?php
												}
												?>
												
												
											</tbody>
											
										</table>	
										
										<table>
											<tr>
												<td style="font-weight: bold; font-size: 16px">Total Bayar</td>
												<td style="font-weight: bold; font-size: 16px">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $total_bayar = number_format($total_bayar,0,".",",");; ?></td>
												<td>&nbsp;</td>
												<td style="font-weight: bold; font-size: 16px">Total Terbayar</td>
												<td style="font-weight: bold; font-size: 16px">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $total = number_format($total,0,".",",");; ?></td>
												<td>&nbsp;</td>
												<td style="font-weight: bold; font-size: 16px">Total Sisa Bayar</td>
												<td style="font-weight: bold; font-size: 16px">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $total_sisa = number_format($total_sisa,0,".",",");; ?></td>
											</tr>
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