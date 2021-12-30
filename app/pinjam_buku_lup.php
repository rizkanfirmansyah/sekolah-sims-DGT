<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");
include '../app/class/class.select.view.php';

$select_view = new select_view;

//$dbpdo = DB::create();

$unit = $_SESSION["unit"];

?>

<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/bootstrap-responsive.css">
<link rel="stylesheet" href="../css/jquery.fancybox.css">
<link rel="stylesheet" href="../css/style.css">

<!--<link rel="stylesheet" href="../css/uniform.default.css">-->
<link rel="stylesheet" href="../css/green.css">
<link rel="stylesheet" href="../css/bootstrap.datepicker.css">
<link rel="stylesheet" href="../css/jquery.cleditor.css">
<link rel="stylesheet" href="../css/jquery.plupload.queue.css">
<link rel="stylesheet" href="../css/jquery.tagsinput.css">
<link rel="stylesheet" href="../css/jquery.ui.plupload.css">


<form name="frm" id="frm" method="post" action="pinjam_buku_lup.php">

    <script langauge="javascript">
    	function post_value(j){
        	var aa= document.getElementById('frm');
            
        	var zz= "kodepustaka" + j;
            opener.document.pinjam.kodepustaka.value = aa.elements[zz].value;
        	
        	var xx= "judul" + j;
        	opener.document.pinjam.judul.value = aa.elements[xx].value;
            
        	self.close();
    	}
    </script>

         <div class="container-fluid">
    		<div class="content">
    			
    			<div class="row-fluid">
    				<div class="span12">
    					
    					
    					<div class="box">
    						<div class="box-head tabs">
    							<h3>DAFTAR PUSTAKA</h3>	
    							
    													
    						</div>
    						
    						<div class="box-content box-nomargin">
    						
    							<div class="tab-content">
    									<div class="tab-pane active" id="basic">
    										<div style="overflow:auto; ">
    										
    										<table class='table table-striped dataTable table-bordered' style="font-size:11px; ">
    											<thead>
    												<tr>												
                                                        <th style="font-weight:bold ">Kode Pustaka &nbsp;&nbsp;</th>	
    													<th style="font-weight:bold ">Judul &nbsp;&nbsp;</th>
    													<th style="font-weight:bold ">Keyword &nbsp;&nbsp;</th>
    													<th style="font-weight:bold ">Penulis &nbsp;&nbsp;</th>
    													<th style="font-weight:bold ">Penerbit &nbsp;&nbsp;</th>
    													<th style="font-weight:bold ">Pilih</th>										
    												</tr>
    											</thead>
    											
    											<tbody>
    											
    												<?php			
    													$sql=$select_view->list_pustaka("", $unit);			
    													
    													while ($pustaka_view=$sql->fetch(PDO::FETCH_OBJ)) {
    														
    														$j++;
    														    																												
    												?>
    													
    													<tr>
                                                            <td>
                                                                <input type="hidden" id="kodepustaka<?php echo $j; ?>" name="kodepustaka<?php echo $j; ?>" value="<?php echo $pustaka_view->kodepustaka ?>" >
                                                                <?php echo $pustaka_view->kodepustaka ?>
                                                            </td>														
    														<td>
                                                                
                                                                <input type="hidden" id="judul<?php echo $j; ?>" name="judul<?php echo $j; ?>" value="<?php echo $pustaka_view->judul ?>" >
                                                                <?php echo $pustaka_view->judul ?>
                                                                    
                                                            </td>
    														<td><?php echo $pustaka_view->keyword ?></td>
    														<td><?php echo $pustaka_view->namapenulis ?></td>
    														<td><?php echo $pustaka_view->namapenerbit ?></td>
    														<td align="center">
    															
    															<input type="image" style="width: 16px"  src="../img/icons/essen/16/check.png" value="" onClick="post_value(<?php echo $j; ?>);">
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
</form>

<script src="../js/jquery.js"></script>
<script src="../js/less.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.peity.js"></script>
<script src="../js/jquery.fancybox.js"></script>
<script src="../js/jquery.flot.js"></script>
<script src="../js/jquery.color.js"></script>
<script src="../js/jquery.flot.resize.js"></script>
<script src="../js/custom.js"></script>

<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/jquery.dataTables.bootstrap.js"></script>
