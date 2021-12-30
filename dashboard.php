<?php 
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

 	//include("app/include/sambung.php");
 	//include("app/include/functions.php");
 		
?>


<script src="app/chart/js/amcharts.js" type="text/javascript"></script>
<div class="container-fluid">
		<div class="content">
			<div class="row-fluid">
				<div class="span12">
					
						<?php include_once("dashboard_logo.php") ?>
						
						
						<!-------------------------------------------->
						<div class="box">
							<div class="box-head">
								<h3>Jumlah Siswa per Tingkat</h3>
							</div>
							<div class="box-content box-nomargin">
								<div class="accordion" id="accordion2">
								
									<?php //if($rowstelat > 0) { ?>
							            <div class="accordion-group">
							              <div id="collapseOne" class="accordion-body collapse in">
							                <div class="accordion-inner">
							                  	<?php include("app/chart/chart_column.php") ?>
							                  	
												<?php //include("app/dashboard_kelas.php") ?>
							                </div>
							              </div>
							            </div>
						            <?php //} ?>
						            
						            		            
						            
						          </div>
							</div>
						</div>
						
						
						<div class="box">
							<div class="box-head">
								<h3>Presentase Siswa per Tingkat</h3>
							</div>
							<div class="box-content box-nomargin">
								<div class="accordion" id="accordion2">
								
									<?php //if($rowstelat > 0) { ?>
							            <div class="accordion-group">
							              <div id="collapseOne" class="accordion-body collapse in">
							                <div class="accordion-inner">
							                  	<?php include("app/chart/chart_pie.php") ?>
							                </div>
							              </div>
							            </div>
						            <?php //} ?>
						            
						            		            
						            
						          </div>
							</div>
						</div>
						
	 
	 		</div>
	 	</div>
	</div>
</div>
	
	
	 <!-- </body>
	</html> -->
