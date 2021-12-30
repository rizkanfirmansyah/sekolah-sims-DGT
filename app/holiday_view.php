<?php
session_start();
?>

<?php
	$delete = $_REQUEST['mxKz'];
	if ($delete == "xm8r389xemx23xb2378e23") {
		include 'class/class.delete.php';
		$delete2=new delete;
		$delete2->delete_holiday($_REQUEST['id']);
?>
		<div class="alert alert-success">
			<strong>Delete Hari Libur successfully</strong>
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
			$("#holiday").attr('action', '')
				.attr('target', '_self');
			$("#holiday").submit();
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

$Yar		= date("Y");
				
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
							<form action="" method="post" name="holiday" id="holiday" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Tahun</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="Yar" id="Yar" style="width:auto; height:20px; font-size:12px; padding:0px; " />
													<?php period_combo_select($periodid); ?>
												</select>
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
									<a href="#basic" data-toggle="tab">Hari Libur Nasional</a>
								</li>
							</ul>						
						</div>
												
						<?php
							include("app/exec/insert_holiday.php"); 
							
							$sql=$select->list_holiday_view($Yar);														
						?>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<div style="overflow:auto; ">
										<!--<table class='table table-striped dataTable table-bordered' style="font-size:11px; width:4000px ">-->
										
										<table class='table table-striped dataTable table-bordered' style="font-size:11px; ">
											<thead>
												<tr>
													<th style="font-weight:bold ">Tahun &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tanggal &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama Hari Libur &nbsp;&nbsp;</th>
													<th style="font-weight:bold "></th>										
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													while ($data_master = odbc_fetch_object($sql)) {
														
														$i++;
														
														$order_date		= date("d-m-Y", strtotime($data_master->HldDte));
														$yar			= date("d-m-Y", strtotime($data_master->Yar));													
												?>
													
													<tr>
														<td><?php echo $data_master->Yar ?></td>
														<td><?php echo $data_master->HldDte ?></td>
														<td><?php echo $data_master->HldDcr ?></td>
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