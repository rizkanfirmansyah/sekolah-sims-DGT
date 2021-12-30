<?php
session_start();
?>

<?php
	$delete = $_REQUEST['mxKz'];
	if ($delete == "xm8r389xemx23xb2378e23") {
		include 'class/class.delete.php';
		$delete2=new delete;
		$delete2->delete_dl($_REQUEST['id']);
?>
		<div class="alert alert-success">
			<strong>Delete DL successfully</strong>
		</div>
<?php
	}
?>

<script type="text/javascript">
	function hapus(id) {
		if (confirm('Apakah Anda yakin akan menghapus data ini?')) {
			document.location.href = "main.php?menu=app&act=<?php echo 'dinasluar_view' ?>&mxKz=xm8r389xemx23xb2378e23&id="+id+" ";
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
			$("#laborder_dl").attr('action', '')
				.attr('target', '_self');
			$("#laborder_dl").submit();
		}
		
		/*if(tipe == 'excel') {
			$("#delord_view").attr('action', 'app/delord_xls.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
  		return false;	 
    }
		
</script>

<?php

$slipno		= $_REQUEST['slipno'];
$fromdate	= $_REQUEST['fromdate'];
$todate		= $_REQUEST['todate'];
$periodid	= $_REQUEST['periodid'];
$tpe		= $_REQUEST['tpe'];
$labid		= $_REQUEST['labid'];
$sts		= $_REQUEST['sts'];
$clientid	= $_REQUEST['clientid'];

$nowdate		= date("d-m-Y");
$nowyear		= date("Y");
$nowmonthyear	= date("m-Y");
$nowfirst		= date("d-m-Y", strtotime("01-".$nowmonthyear) );

if($periodid == "") {
	$periodid = $nowyear;
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
							<form action="" method="post" name="laborder_dl2" id="laborder_dl2" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Tahun</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="periodid" id="periodid" style="width:auto; height:20px; font-size:12px; padding:0px; " />
													<?php period_combo_select($periodid); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Kategori</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="tpe" id="tpe" style="width:auto;  height:20px; font-size:12px; padding:0px; " />
													<option value="All">All Type</option>
													<?php categori_combo_select(""); ?>
												</select>
											</td>
											
										</tr>
										<tr>
											<td>DL No.</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="slipno" id="slipno" style="width:auto; height:10px; font-size: 12px" value="" ></td>
											
											<td>&nbsp;&nbsp;</td>
											<td>Pelanggan</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="clientid" id="clientid" style="width:auto; height:10px; font-size: 12px" value=""></td>
											
											
										</tr>
										<tr>
											<td>Tanggal Order</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="fromdate" class='datepick' id="fromdate" style="width:70px; height:10px; font-size:12px " value="">&nbsp;s/d&nbsp;<input type="text" name="todate" class='datepick' id="todate" style="width:70px; height:10px; font-size:12px " value="">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>&nbsp;&nbsp;</td>
											<td>
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
							<h3>Order Dinas Luar</h3>	
							
							<ul class='nav nav-tabs'>
								<li class='active'>
									<a href="#basic" data-toggle="tab">Lab. Order DL</a>
								</li>
							</ul>						
						</div>
												
						<?php
							include("app/exec/insert_laborder_dl.php"); 
							
							$sql=$select->list_laborder_dl_view($slipno, $fromdate, $todate, $periodid, $tpe, $clientid);														
						?>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<div style="overflow:auto; ">
										<!--<table class='table table-striped dataTable table-bordered' style="font-size:11px; width:4000px ">-->
										
										<table class='table table-striped dataTable table-bordered' style="font-size:11px; ">
											<thead>
												<tr>
													<th style="font-weight:bold ">No SPT &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">DL No &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tgl SPT &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tgl Selesai &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama Perusahaan (Pelanggan) &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													while ($data_master = odbc_fetch_object($sql)) {
														
														$i++;
														
														$order_date			= date("d-m-Y", strtotime($data_master->Dte));
														$tglselesai			= date("d-m-Y", strtotime($data_master->Tglselesai));													
												?>
													
													<tr>
														<input type="hidden" name="slipno_<?php echo $i; ?>" id="slipno_<?php echo $i; ?>" value="<?php echo $data_master->OutBldCde ?>">
														<input type="hidden" name="periodid_<?php echo $i; ?>" id="periodid_<?php echo $i; ?>" value="<?php echo $data_master->periodid ?>">
														<td><?php echo $data_master->OutBldCde ?></td>
														<td><?php echo $data_master->DLNo ?></td>
														<td><?php echo $order_date ?></td>
														<td><?php echo $tglselesai ?></td>
														<td><?php echo $data_master->ClientName ?></td>
														
														<td>
															<a class="label label-success" href="main.php?menu=app&act=<?php echo 'dinasluar' ?>&search=<?php echo $data_master->OutBldCde ?>" style="background-color: #46e916">edit
															</a>
															&nbsp;&nbsp;
															<a class="label label-success" href="JavaScript:hapus('<?php echo $data_master->OutBldCde ?>')" style="background-color: #ff0000">hapus</i> 
															</a>
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