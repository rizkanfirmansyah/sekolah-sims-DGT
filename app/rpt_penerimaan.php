<script type="text/javascript" src="js/buttonajax.js"></script>

<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			
			departemen = document.getElementById('departemen').value;
			daritgl = document.getElementById('daritgl').value;
			ketgl = document.getElementById('ketgl').value;
			idtingkat = document.getElementById('idtingkat').value;
			idkelas = document.getElementById('idkelas').value;
			nama = document.getElementById('nama').value;
			all = document.getElementById('all').checked;
			
			document.location.href = "main.php?menu=app&act=<?php echo obraxabrix('rpt_penerimaan') ?>&mxKz=xm8r389xemx23xb2378e23&departemen="+departemen+"&daritgl="+daritgl+"&ketgl="+ketgl+"&idtingkat="+idtingkat+"&idkelas="+idkelas+"&nama="+nama+"&id="+id+"&all="+all+" ";
		}
	}
	
	function getpenerimaan_update(tnis, tbayar, ref, idpenerimaan) {
		//document.location.href = "../app/penerimaanjtt_update.php?nis="+tnis+"&bayar="+tbayar+"&ref="+ref;
		
		newWindow('app/penerimaanjtt_update.php?nis='+tnis+'&bayar='+tbayar+'&ref='+ref +'&idpenerimaan='+idpenerimaan +' ','Update Nota','800','500','resizable=1,scrollbars=1,status=0,toolbar=0');
	}
</script>

<script>
    function submitForm(tipe)
    {
    	
		if(tipe == 'print') {
			//document.getElementById("delord_view").action = "app/delord_print.php";
			$("#rpt_penerimaan_view").attr('action', 'app/rpt_penerimaan_print.php')
			   .attr('target', '_BLANK');
			$("#rpt_penerimaan_view").submit();
			
		} 
		
		if(tipe == 'find') {
			$("#rpt_penerimaan_view").attr('action', '')
				.attr('target', '_self');
			$("#rpt_penerimaan_view").submit();
		}
		
		if(tipe == 'excel') {
			$("#rpt_penerimaan_view").attr('action', 'app/rpt_penerimaan_xls.php')
			   .attr('target', '_BLANK');
			$("#rpt_penerimaan_view").submit();
		}
		
  		return false;	 
    }
    
    function cetaknota(ref) 
	{	
		newWindow('app/kuitansijtt_multi.php?ref='+ ref +' ','Nota','800','500','resizable=1,scrollbars=1,status=0,toolbar=0');
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

include 'class/class.select.print.php';

$select_print = new select_print;

$find  		= $_POST['submit'];

if($find == "Preview") {
	$departemen	= $_POST['departemen'];	
	$daritgl	= $_POST['daritgl'];
	$ketgl		= $_POST['ketgl'];
	$idtingkat	= $_POST['idtingkat'];
	$idkelas	= $_POST['idkelas'];
	$nama		= $_POST['nama'];
	$all		= $_POST['all'];
} else {
	$departemen	= $_REQUEST['departemen'];	
	$daritgl	= $_REQUEST['daritgl'];
	$ketgl		= $_REQUEST['ketgl'];
	$idtingkat	= $_REQUEST['idtingkat'];
	$idkelas	= $_REQUEST['idkelas'];
	$nama		= $_REQUEST['nama'];
	$all		= $_REQUEST['all'];
}

if ($all == 1 && $all == true) {
	$all = "checked";
} else {
	$all = "";
}

if($daritgl == "") { $daritgl = date("d-m-Y"); }
if($ketgl == "") { $ketgl	 = date("d-m-Y"); }
	
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
							<form action="" method="post" name="rpt_penerimaan_view" id="rpt_penerimaan_view" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Unit</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="departemen" id="departemen" style="width:auto; height:27px; " onchange="loadHTMLPost2('app/rpt_penerimaan_ajax.php','idtingkat_id','getlevel','departemen')"/>
													<option value=""></option>
													<?php select_departemen($departemen); ?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Dari Tanggal</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="daritgl" class='datepick' id="daritgl" style="width:70px; height:16px; " value="<?php echo $daritgl ?>"></td>
											
											<td>&nbsp;&nbsp;</td>
											<td>s/d Tanggal</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="ketgl" class='datepick' id="ketgl" style="width:70px; height:16px; " value="<?php echo $ketgl ?>"></td>
											
										</tr>
										
										<tr>
											<td>Level</td>
											<td>&nbsp;&nbsp;</td>
											<td id="idtingkat_id">
												<select name="idtingkat" id="idtingkat" style="width:auto;  height:20px; font-size:12px; padding:0px; " onClick="loadHTMLPost2('app/rpt_penerimaan_ajax.php','idkelas','getkelas','idtingkat')" />
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
												<input type="text" name="nama" id="nama" style="width:150px; height:20px; font-size:12px " value="<?php echo $nama ?>">
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
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Ekspor Excel" onclick="submitForm('excel')" >
											</td>											
										</tr>
										
									</table>
									
								</div>								
							</form>
						</div>	
					</div>
					
					<div class="box">
						<div class="box-head tabs">
							<h3>LAPORAN PENERIMAAN</h3>	
							
													
						</div>
						
						<div class="box-content box-nomargin">
							
							<?php
								$delete = $_REQUEST['mxKz'];
								if ($delete == "xm8r389xemx23xb2378e23") {
									include 'class/class.delete.php';
									$delete2=new delete;
									$delete2->delete_rpt_penerimaan($_REQUEST['id']);
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
													<th style="font-weight:bold ">Level-Kelas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tanggal Bayar &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Pembayaran &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jml Tagihan &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Jml Bayar &nbsp;&nbsp;</th>
													<!--<th style="font-weight:bold ">Potongan/Beasiswa &nbsp;&nbsp;</th>-->
													<!--<th style="font-weight:bold ">Keterangan &nbsp;&nbsp;</th>-->
													<th style="font-weight:bold ">Petugas &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>
																							
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													$total = 0;
													
													$sql=$select_view->list_rpt_penerimaan($daritgl, $ketgl, $idtingkat, $idkelas, $nama, $departemen, $all);			
													
													while ($rpt_penerimaan_view=$sql->fetch(PDO::FETCH_OBJ)) {
														
														$i++;
														
														$tanggal = date("d-m-Y", strtotime($rpt_penerimaan_view->tanggal));	
														$kelas = $rpt_penerimaan_view->tingkat . '-' . $rpt_penerimaan_view->kelas;
														$besar = number_format($rpt_penerimaan_view->besar,0,".",",");
														$jumlah = number_format($rpt_penerimaan_view->jumlah,0,".",",");
														$potongan = number_format($rpt_penerimaan_view->potongan,0,".",",");
														
														$total = numberreplace($total) +  numberreplace($rpt_penerimaan_view->jumlah) - numberreplace($rpt_penerimaan_view->potongan);
														$total = number_format($total,0,".",",");
												?>
													
													
													
													<tr>
														<td><?php echo $rpt_penerimaan_view->nis ?></td>
														<td><?php echo $rpt_penerimaan_view->nama ?></td>
														<td><?php echo $kelas ?></td>
														<td><?php echo date("d-m-Y", strtotime($rpt_penerimaan_view->tanggal)) ?></td>
														<td><?php echo $rpt_penerimaan_view->namapenerimaan ?></td>
														<td align="right" style="font-weight: bold"><?php echo $besar ?></td>
														<td align="right" style="font-weight: bold"><?php echo $jumlah ?></td>
														<!--<td><?php echo $potongan ?></td>-->
														<!--<td><?php echo $rpt_penerimaan_view->keterangan ?></td>-->
														<td><?php echo $rpt_penerimaan_view->petugas ?></td>
														
														<td>
															
															<!--<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('rpt_penerimaan') ?>&search=<?php echo $rpt_penerimaan_view->replid ?>" style="background-color: #46e916" >edit</a>-->
															
															<!--<a class="label label-success" href="JavaScript:getpenerimaan_update('<?php echo $rpt_penerimaan_view->nis ?>','<?php echo $rpt_penerimaan_view->jumlah ?>','<?php echo $rpt_penerimaan_view->ref ?>','<?php echo $rpt_penerimaan_view->idpenerimaan ?>')" style="background-color: #0618f9">edit</i> 
															</a>-->
															
															<a class="label label-success" href="main.php?menu=app&act=<?php echo obraxabrix('penerimaanjtt') ?>&search=<?php echo $rpt_penerimaan_view->replid ?>" style="background-color: #0618f9" >edit</a>
															
															&nbsp;&nbsp;
															<a class="label label-success" href="JavaScript:cetaknota('<?php echo $rpt_penerimaan_view->ref ?>')" style="background-color: #46e916">cetak nota</i> 
															</a>
																
															
															
															<?php if (allowdel('rpt_penerimaan')==1) { ?>
																&nbsp;&nbsp;
																<a class="label label-success" href="JavaScript:hapus('<?php echo $rpt_penerimaan_view->replid ?>')" style="background-color: #ff0000">hapus</i> 
																</a>
															<?php } ?>
														</td>
														
													</tr>
																										
												<?php
												}
												?>
												
												
											</tbody>
											
										</table>	
										
										<table>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td style="font-weight: bold; font-size: 16px">Total</td>
												<td style="font-weight: bold; font-size: 16px">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $total; ?></td>
											</tr>
											
											<?php
												$sqljenis = $select_print->list_jenis_bayar();
												while ($rpt_jenis_view=$sqljenis->fetch(PDO::FETCH_OBJ)) {
													
													//if($rowrpt > 0) {
														$total_bayar = $select_print->list_rpt_penerimaanjtt_sum($rpt_jenis_view->replid, $daritgl, $ketgl, $idtingkat, $idkelas, $nama, $departemen, $all);
													//}
													$total_bayar = number_format($total_bayar,0,".",",");
											?>	
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td style="font-weight: bold; font-size: 12px"><?php echo $rpt_jenis_view->nama ?></td>
														<td style="font-weight: bold; font-size: 12px">&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $total_bayar; ?></td>
													</tr>
											
											<?php
												}
											?>
											
											
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