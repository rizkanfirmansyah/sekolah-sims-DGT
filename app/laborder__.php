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
		
		/*if(tipe == 'excel') {
			$("#delord_view").attr('action', 'app/delord_xls.php')
			   .attr('target', '_BLANK');
			$("#delord_view").submit();
		}*/
		
  		return false;	 
    }
		
</script>

<?php

$slipno		= $_POST['slipno'];
$fromdate	= $_POST['fromdate'];
$todate		= $_POST['todate'];
$periodid	= $_POST['periodid'];
$tpe		= $_POST['tpe'];
$labid		= $_POST['labid'];
$sts		= $_POST['sts'];
$clientid	= $_POST['clientid'];

?>

<script>
	var ord_slipno = ''; 
	var ord_orderid = '';
	var ord_finish = '';
	var ord_finish1 = '';
	var ord_finish2 = '';
	var ord_konsep = '';
	var ord_sertifikat = '';
	var ord_tu = '';
	var ord_batal = '';
	var ord_autoid = '';
	var ord_suborderid = '';
	var ord_periodid = '';
	
	var ord_tglfinish = ''; //
	var ord_tglkonsep = ''; //
	var ord_tglsertifikat = ''; //
	var ord_tgltu = ''; //
	var ord_catatan_lab = ''; //
	var ord_catatan_batal = ''; //
	var ord_kalibrator = ''; //
	var ord_seri = ''; //
	var ord_uid = ''; //		
	var ord_tglfinish2 = ''; //
	var ord_finish1_nip = ''; //
	var ord_finish2_nip = ''; //
	var ord_finish3_nip = ''; //
	var ord_konsep_nip = ''; //
	var ord_sertifikat_nip = ''; //
	var ord_tu_nip = ''; //
	var ord_kategori = ''; //
	var ord_no_sertifikat = ''; //
	var ord_ket_alat = ''; //
	var ord_no_kertas = ''; //
	var ord_Lokasi = ''; //
	var ord_tgl_catatan_lab = ''; //
	var ord_ProCde = ''; //
	var ord_no_kertas2 = ''; //
	var ord_NoSertifikat = ''; //
	
	
	function checklist(lne) {
		ord_slipno = ord_slipno + '|' + document.getElementById('slipno_' + lne).value;
		$('#ord_slipno2').html('<input type="hidden" size="100" id="ord_slipno" name="ord_slipno" value="'+ ord_slipno +'" >');
		
		ord_finish = ord_finish + '|' + document.getElementById('finish_' + lne).checked;
		$('#ord_finish2').html('<input type="hidden" size="100" id="ord_finish" name="ord_finish" value="'+ ord_finish +'" >');
		
		ord_finish1 = ord_finish1 + '|' + document.getElementById('finish1_' + lne).checked;
		$('#ord_finish12').html('<input type="hidden" size="100" id="ord_finish1" name="ord_finish1" value="'+ ord_finish1 +'" >');	
		
		ord_finish2 = ord_finish2 + '|' + document.getElementById('finish2_' + lne).checked;
		$('#ord_finish22').html('<input type="hidden" size="100" id="ord_finish2" name="ord_finish2" value="'+ ord_finish2 +'" >');
		
		ord_konsep = ord_konsep + '|' + document.getElementById('konsep_' + lne).checked;
		$('#ord_konsep2').html('<input type="text" size="100" id="ord_konsep" name="ord_konsep" value="'+ ord_konsep +'" >');
		
		ord_sertifikat = ord_sertifikat + '|' + document.getElementById('sertifikat_' + lne).checked;
		$('#ord_sertifikat2').html('<input type="text" size="100" id="ord_sertifikat" name="ord_sertifikat" value="'+ ord_sertifikat +'" >');		
		ord_tu = ord_tu + '|' + document.getElementById('tu_' + lne).checked;
		$('#ord_tu2').html('<input type="hidden" size="100" id="ord_tu" name="ord_tu" value="'+ ord_tu +'" >');
		
		ord_batal = ord_batal + '|' + document.getElementById('batal_' + lne).checked;
		$('#ord_batal2').html('<input type="text" size="100" id="ord_batal" name="ord_batal" value="'+ ord_batal +'" >');
		
		ord_orderid = ord_orderid + '|' + document.getElementById('orderid_' + lne).value;
		$('#ord_orderid2').html('<input type="hidden" size="100" id="ord_orderid" name="ord_orderid" value="'+ ord_orderid +'" >');
		
		ord_autoid = ord_autoid + '|' + document.getElementById('autoid_' + lne).value;
		$('#ord_autoid2').html('<input type="hidden" size="100" id="ord_autoid" name="ord_autoid" value="'+ ord_autoid +'" >');
		
		ord_suborderid = ord_suborderid + '|' + document.getElementById('suborderid_' + lne).value;
		$('#ord_suborderid2').html('<input type="hidden" size="100" id="ord_suborderid" name="ord_suborderid" value="'+ ord_suborderid +'" >');		
		ord_periodid = ord_periodid + '|' + document.getElementById('periodid_' + lne).value;
		$('#ord_periodid2').html('<input type="hidden" size="100" id="ord_periodid" name="ord_periodid" value="'+ ord_periodid +'" >');
		
		//---------------------
		ord_tglfinish = ord_tglfinish + '|' + document.getElementById('tglfinish_' + lne).value;
		$('#ord_tglfinish2').html('<input type="text" size="100" id="ord_tglfinish" name="ord_tglfinish" value="'+ ord_tglfinish +'" >');
		
		ord_kategori = ord_kategori + '|' + document.getElementById('kategori_' + lne).value;
		$('#ord_kategori2').html('<input type="text" size="100" id="ord_kategori" name="ord_kategori" value="'+ ord_kategori +'" >');
		
		ord_catatan_lab = ord_catatan_lab + '|' + document.getElementById('catatan_lab_' + lne).value;
		$('#ord_catatan_lab2').html('<input type="text" size="100" id="ord_catatan_lab" name="ord_catatan_lab" value="'+ ord_catatan_lab +'" >');
		ord_ket_alat = ord_ket_alat + '|' + document.getElementById('ket_alat_' + lne).value;
		$('#ord_ket_alat2').html('<input type="text" size="100" id="ord_ket_alat" name="ord_ket_alat" value="'+ ord_ket_alat +'" >');
		
		ord_tglsertifikat = ord_tglsertifikat + '|' + document.getElementById('tglsertifikat_' + lne).value;
		$('#ord_tglsertifikat2').html('<input type="text" size="100" id="ord_tglsertifikat" name="ord_tglsertifikat" value="'+ ord_tglsertifikat +'" >');
		
		ord_catatan_batal = ord_catatan_batal + '|' + document.getElementById('catatan_batal_' + lne).value;
		$('#ord_catatan_batal2').html('<input type="text" size="100" id="ord_catatan_batal" name="ord_catatan_batal" value="'+ ord_catatan_batal +'" >');	
		
		ord_no_sertifikat = ord_no_sertifikat + '|' + document.getElementById('no_sertifikat_' + lne).value;
		$('#ord_no_sertifikat2').html('<input type="text" size="100" id="ord_no_sertifikat" name="ord_no_sertifikat" value="'+ ord_no_sertifikat +'" >');
		
		ord_no_kertas = ord_no_kertas + '|' + document.getElementById('no_kertas_' + lne).value;
		$('#ord_no_kertas2').html('<input type="text" size="100" id="ord_no_kertas" name="ord_no_kertas" value="'+ ord_no_kertas +'" >');

		ord_no_kertas2 = ord_no_kertas2 + '|' + document.getElementById('no_kertas2_' + lne).value;
		$('#ord_no_kertas22').html('<input type="text" size="100" id="ord_no_kertas2" name="ord_no_kertas2" value="'+ ord_no_kertas2 +'" >');
		ord_Lokasi = ord_Lokasi + '|' + document.getElementById('Lokasi_' + lne).value;
		$('#ord_Lokasi2').html('<input type="text" size="100" id="ord_Lokasi" name="ord_Lokasi" value="'+ ord_Lokasi +'" >');		
		
		
		
		
		
		ord_tglkonsep = ord_tglkonsep + '|' + document.getElementById('tglkonsep_' + lne).value;
		$('#ord_tglkonsep2').html('<input type="text" size="100" id="ord_tglkonsep" name="ord_tglkonsep" value="'+ ord_tglkonsep +'" >');
		
		ord_tgltu = ord_tgltu + '|' + document.getElementById('tgltu_' + lne).value;
		$('#ord_tgltu2').html('<input type="text" size="100" id="ord_tgltu" name="ord_tgltu" value="'+ ord_tgltu +'" >');
		
		ord_kalibrator = ord_kalibrator + '|' + document.getElementById('kalibrator_' + lne).value;
		$('#ord_kalibrator2').html('<input type="text" size="100" id="ord_kalibrator" name="ord_kalibrator" value="'+ ord_kalibrator +'" >');
		ord_seri = ord_seri + '|' + document.getElementById('seri_' + lne).value;
		$('#ord_seri2').html('<input type="text" size="100" id="ord_seri" name="ord_seri" value="'+ ord_seri +'" >');
		
		ord_uid = ord_uid + '|' + document.getElementById('uid_' + lne).value;
		$('#ord_uid2').html('<input type="text" size="100" id="ord_uid" name="ord_uid" value="'+ ord_uid +'" >');
		
		ord_tglfinish2 = ord_tglfinish2 + '|' + document.getElementById('tglfinish2_' + lne).value;
		$('#ord_tglfinish22').html('<input type="text" size="100" id="ord_tglfinish2" name="ord_tglfinish2" value="'+ ord_tglfinish2 +'" >');
		ord_finish1_nip = ord_finish1_nip + '|' + document.getElementById('finish1_nip_' + lne).value;
		$('#ord_finish1_nip2').html('<input type="text" size="100" id="ord_finish1_nip" name="ord_finish1_nip" value="'+ ord_finish1_nip +'" >');
		ord_finish2_nip = ord_finish2_nip + '|' + document.getElementById('finish2_nip_' + lne).value;
		$('#ord_finish2_nip2').html('<input type="text" size="100" id="ord_finish2_nip" name="ord_finish2_nip" value="'+ ord_finish2_nip +'" >');
		
		ord_finish3_nip = ord_finish3_nip + '|' + document.getElementById('finish3_nip_' + lne).value;
		$('#ord_finish3_nip2').html('<input type="text" size="100" id="ord_finish3_nip" name="ord_finish3_nip" value="'+ ord_finish3_nip +'" >');
		ord_konsep_nip = ord_konsep_nip + '|' + document.getElementById('konsep_nip_' + lne).value;
		$('#ord_konsep_nip2').html('<input type="text" size="100" id="ord_konsep_nip" name="ord_konsep_nip" value="'+ ord_konsep_nip +'" >');
		ord_sertifikat_nip = ord_sertifikat_nip + '|' + document.getElementById('sertifikat_nip_' + lne).value;
		$('#ord_sertifikat_nip2').html('<input type="text" size="100" id="ord_sertifikat_nip" name="ord_sertifikat_nip" value="'+ ord_sertifikat_nip +'" >');
		
		ord_tu_nip = ord_tu_nip + '|' + document.getElementById('tu_nip_' + lne).value;
		$('#ord_tu_nip2').html('<input type="text" size="100" id="ord_tu_nip" name="ord_tu_nip" value="'+ ord_tu_nip +'" >');
				
		ord_tgl_catatan_lab = ord_tgl_catatan_lab + '|' + document.getElementById('tgl_catatan_lab_' + lne).value;
		$('#ord_tgl_catatan_lab2').html('<input type="text" size="100" id="ord_tgl_catatan_lab" name="ord_tgl_catatan_lab" value="'+ ord_tgl_catatan_lab +'" >');
		
		ord_ProCde = ord_ProCde + '|' + document.getElementById('ProCde_' + lne).value;
		$('#ord_ProCde2').html('<input type="text" size="100" id="ord_ProCde" name="ord_ProCde" value="'+ ord_ProCde +'" >');
		
		ord_NoSertifikat = ord_NoSertifikat + '|' + document.getElementById('NoSertifikat_' + lne).value;
		$('#ord_NoSertifikat2').html('<input type="text" size="100" id="ord_NoSertifikat" name="ord_NoSertifikat" value="'+ ord_NoSertifikat +'" >');
		
	}
</script>

<div class="container-fluid">
		<div class="content">
			
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Filter</h3>
						</div>
						<div class="box-content">
							<form action="" method="post" name="laborder" id="laborder" class="form-horizontal">
								<div>
									<?php
										$nowdate		= date("d-m-Y");
										$nowyear		= date("Y");
										$nowmonthyear	= date("m-Y");
										$nowfirst		= date("d-m-Y", strtotime("01-".$nowmonthyear) );
									?>
									<table>
										<tr>
											<td>Tahun</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="periodid" id="periodid" style="width:auto; height:27px; " />
													<?php period_combo_select($nowyear); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Tipe</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="tpe" id="tpe" style="width:auto; height:27px; " />
													<?php type_combo_select(0); ?>
												</select>
											</td>
										</tr>
										<tr>
											<td>No Order</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="slipno" id="slipno" style="width:auto; height:16px; "></td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Laboratorium</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="labid" id="labid" style="width:auto; height:27px; " />
													<option value=""></option>
													<?php lab_combo_select(""); ?>
												</select>
											</td>											
										</tr>
										<tr>
											<td>Status</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<select name="sts" id="sts" style="width:auto; height:27px; " />
													<?php status_combo_select('All'); ?>
												</select>
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>Tanggal Order</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="fromdate" class='datepick' id="fromdate" style="width:70px; height:16px; " value="">&nbsp;s/d&nbsp;<input type="text" name="todate" class='datepick' id="todate" style="width:70px; height:16px; " value="">
											</td>
										</tr>
										<tr>
											<td>Pelanggan</td>
											<td>&nbsp;&nbsp;</td>
											<td><input type="text" name="clientid" id="clientid" style="width:auto; height:16px; "></td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td></td>
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
							<h3>Status Order Lab.</h3>							
						</div>
												
						<?php
							include("app/exec/insert_laborder.php"); 
							
							$sql=$select->list_laborder($slipno, $fromdate, $todate, $periodid, $tpe, $labid, $sts, $clientid);					
							
						?>
						<div class="box-content box-nomargin">
							<div class="tab-content">
									<div class="tab-pane active" id="basic">
										<div style="overflow:auto; ">
										<!--<table class='table table-striped dataTable table-bordered' style="font-size:11px; width:4000px ">-->
										<form action="" method="post" name="laborder" id="laborder" class="form-horizontal">
										<table class='table dataTable table-bordered' style="font-size:11px; width:5000px; padding:0px;">
											<thead>
												<tr>
													<th style="font-weight:bold ">No Order &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tgl Order &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tgl Selesai &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama Perusahaan (Pelanggan) &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Nama Barang &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Objek Kalibrasi &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">No Seri &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Penera-1 &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Penera-2 &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Penera-3 &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tgl Pengujian &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Kategori &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Catatan Lab. &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tgl. Cat. Lab. &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Ket. Lab. &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Konsep &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tgl. Konsep &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Sertifikat (Ka. Seksi) &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tgl. Sertifikat &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">TU (Ka. Balai) &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Tgl. TU &nbsp;&nbsp;</th>
													<!--<th style="font-weight:bold ">Penera &nbsp;&nbsp;</th>-->
													<th style="font-weight:bold ">Batal &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Catatan Batal &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">No. Sertifikat &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">No. Kertas &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">No. Kertas-2 &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Lokasi &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">Provinsi &nbsp;&nbsp;</th>
													<th style="font-weight:bold ">&nbsp;&nbsp;</th>
												</tr>
											</thead>
											
											<tbody>
											
												<?php			
													while ($data_master = odbc_fetch_object($sql)) {
														
														$i++;
														
														//----------------set css autocomplete
														echo '
															<style>
															#result_'.$i.' {
																height:20px;
																font-size:12px;
																font-family:Arial, Helvetica, sans-serif;
																color:#333;
																padding:5px;
																margin-bottom:10px;
																background-color:#FFFF99;					
															}
															#country_'.$i.'{
																padding:3px;
																border:1px #CCC solid;
																font-size:12px;
															}
															.suggestionsBox_'.$i.' {
																position: absolute; 
																left:auto;
																top:auto;
																margin: 0px 0px 0px 0px;
																width: 300px;
																padding:0px;
																background-color:#409D47;
																border-top: 3px solid #999999;
																color: #fff;										
															}
															.suggestionList_'.$i.' {
																margin: 0px;
																padding: 0px;
															}
															.suggestionList_'.$i.' ul li {
																list-style:none;
																margin: 0px;
																padding: 6px;
																border-bottom:1px dotted #666;
																cursor: pointer;
															}
															.suggestionList_'.$i.' ul li:hover {
																background-color: #FC3;
																color:#000;
															}
															ul {
																font-family:Arial, Helvetica, sans-serif;
																font-size:11px;
																color:#FFF;
																padding:0;
																margin:0;
															}
															
															.load_'.$i.'{
															background-image:url(auto/loader.gif);
															background-position:right;
															background-repeat:no-repeat;
															}
															
															#suggest_'.$i.' {
																position:relative;
															}
														</style> ';
														
													echo "
														<script>
															function suggest_".$i."(inputString, queryPHP){
															if(inputString.length == 0) {
																$('#suggestions_".$i."').fadeOut();
															} else {
															$('#country_".$i."').addClass('load_".$i."');".'
																$.post(queryPHP, {queryString: ""+inputString+""}, function(data){
																	if(data.length >0) { '."
																		$('#suggestions_".$i."').fadeIn();
																		$('#suggestionsList_".$i."').html(data);
																		$('#country_".$i."').removeClass('load');
																	}
																});
															}
														}
														
														function fill_".$i."(thisValue) {
															$('#ProNme_".$i."').val(thisValue); ".'
															setTimeout("'."$('#suggestions_".$i."').fadeOut()".';", 100);
														}
														
														function fill2_'.$i.'(thisValue) { '."	
															$('#ProCde_".$i."').val(thisValue); ".'
															setTimeout("'."$('#suggestions_".$i."').fadeOut()".';", 100);
														}
														
														</script>
													';
																												
														$order_date			= date("d-m-Y", strtotime($data_master->order_date));
														$tglselesai			= date("d-m-Y", strtotime($data_master->tglselesai));
														
														$tglfinish = "";
														if (date("d-m-Y", strtotime($data_master->tglfinish))!='01-01-1970') {
															$tglfinish		= date("d-m-Y H:i:s", strtotime($data_master->tglfinish));
														}
														
														$tgl_catatan_lab 	= "";
														$tgl_catatan_lab2 	= "";
														if (date("d-m-Y", strtotime($data_master->tgl_catatan_lab))!='01-01-1970') {
															$tgl_catatan_lab	= date("d-m-Y H:i:s", strtotime($data_master->tgl_catatan_lab));
															$tgl_catatan_lab2	= date("d-m-Y",strtotime( '+30 day',strtotime($tgl_catatan_lab)));
														} 
														 
														$tglkonsep = "";
														if (date("d-m-Y", strtotime($data_master->tglkonsep))!='01-01-1970') {
															$tglkonsep		= date("d-m-Y H:i:s", strtotime($data_master->tglkonsep));
														}
														
														$tglsertifikat = "";
														if (date("d-m-Y", strtotime($data_master->tglsertifikat))!='01-01-1970') {
															$tglsertifikat		= date("d-m-Y H:i:s", strtotime($data_master->tglsertifikat));
														}
														
														$tgltu = "";
														if (date("d-m-Y", strtotime($data_master->tgltu))!='01-01-1970') {
															$tgltu		= date("d-m-Y H:i:s", strtotime($data_master->tgltu));
														}
														
														##------------------------------------set color-----------\/
														$bgcolorfinish_bawah_25	= "";
														$bgcolorfinish = "";
														$bgcolorfinish_atas_26_bawah_27	= "";
														$bgcolorfinish_atas_28_bawah_29	= "";
														$bgcolorfinish_bawah_27	= "";
														$bgcolorfinish_atas_30_bawah_31	= "";
														
														if ($data_master->finish==0 && $data_master->finish1==0 && $data_master->finish2==0 && $data_master->konsep==0 && $data_master->sertifikat==0 && $data_master->tu==0 && $data_master->catatan_lab == "" && $data_master->batal == 0) {
															if ($data_master->finish==0 && $data_master->finish1==0 && $data_master->finish2==0 && $data_master->konsep==0 && $data_master->sertifikat==0 && $data_master->tu==0 && $data_master->catatan_lab == "" && $data_master->batal == 0
																&& (date("Y-m-d", strtotime($tglselesai)) < date("Y-m-d", strtotime($nowdate))) ) {
																//If Col <= 25 Then		
																$bgcolorfinish_bawah_25 = "background-color:#FF0000; color:#ffffff"; //RED: lewat tanggal selesai		
																//
															} else {		
																$bgcolorfinish = "background-color:#ffffff; color:#000000"; //white
															}	
															
														} else if ( ($data_master->finish==1 || $data_master->finish1==1 || $data_master->finish2==1) && $data_master->konsep==0 && $data_master->sertifikat==0 && $data_master->tu==0 && $data_master->catatan_lab == "" && $data_master->batal == 0 ) {
															if ( ($data_master->finish==1 || $data_master->finish1==1 || $data_master->finish2==1) && $data_master->konsep==0 && $data_master->sertifikat==0 && $data_master->tu==0 && $data_master->catatan_lab == "" && $data_master->batal == 0  && (date("Y-m-d", strtotime($tglselesai)) < date("Y-m-d", strtotime($nowdate))) ) {
																//If Col >= 26 And Col <= 27 Then		
																	$bgcolorfinish_atas_26_bawah_27 = "background-color:#FF0000; color:#ffffff"; //red---------lewat tgl selesai			
																//ElseIf Col <= 25 Then
																	$bgcolorfinish_bawah_25 = "background-color:#00FF00; color:#000000"; //green
															} else {
																//If Col <= 25 Then
																	$bgcolorfinish_bawah_25 = "background-color:#00FF00; color:#000000"; //green			
																//End If
															}
														
															
														} else if ( ($data_master->finish==1 || $data_master->finish1==1 || $data_master->finish2==1) && $data_master->konsep==1 && $data_master->sertifikat==0 && $data_master->tu==0 && $data_master->catatan_lab == "" && $data_master->batal == 0 ) {
															if ( ($data_master->finish==1 || $data_master->finish1==1 || $data_master->finish2==1) && $data_master->konsep==1 && $data_master->sertifikat==0 && $data_master->tu==0 && $data_master->catatan_lab == "" && $data_master->batal == 0 && (date("Y-m-d", strtotime($tglselesai)) < date("Y-m-d", strtotime($nowdate))) ) {
																  //If Col >= 28 And Col <= 29 Then
																	$bgcolorfinish_atas_28_bawah_29 = "background-color:#FF0000; color:#ffffff"; //red---------lewat tgl selesai
																	
																  //ElseIf Col <= 27 Then
																	$bgcolorfinish_bawah_27 = "background-color:#00FF00; color:#000000"; //green		  
																} else {
																  //If Col <= 27 Then
																	$bgcolorfinish_bawah_27 = "background-color:#00FF00; color:#000000"; //green
																  //End If
																}
														
														} else if ( ($data_master->finish==1 || $data_master->finish1==1 || $data_master->finish2==1) && $data_master->konsep==1 && $data_master->sertifikat==1 && $data_master->tu==0 && $data_master->catatan_lab == "" && $data_master->batal == 0 ) {
															  if ( ($data_master->finish==1 || $data_master->finish1==1 || $data_master->finish2==1) && $data_master->konsep==1 && $data_master->sertifikat==1 && $data_master->tu==0 && $data_master->catatan_lab == "" && $data_master->batal == 0  && (date("Y-m-d", strtotime($tglselesai)) < date("Y-m-d", strtotime($nowdate))) ) {
																//If Col >= 30 And Col <= 31 Then
																  $bgcolorfinish_atas_30_bawah_31 = "background-color:#FF0000; color:#ffffff"; //red---------lewat tgl selesai
																//ElseIf Col <= 29 Then
																  $bgcolorfinish_atas_28_bawah_29 = "background-color:#00FF00; color:#000000"; //green
																//End If
															  } else {
																//If Col <= 29 Then
																  $bgcolorfinish_atas_28_bawah_29 = "background-color:#00FF00; color:#000000"; //green
																//End If
															  }
														
														} else if ( ($data_master->finish==1 || $data_master->finish1==1 || $data_master->finish2==1) && $data_master->konsep==1 && $data_master->sertifikat==1 && $data_master->tu==1 && $data_master->catatan_lab == "" && $data_master->batal == 0 ) {
															   $bgcolorfinish = "background-color:#00FF00; color:#000000"; //green
															   
														} else if ( $data_master->batal == 1) {
															$bgcolorfinish = "background-color:#000000; color:#FFFFFF"; //black
															
															//----------cek catatan lab yg belum expired date (setelah plus 30 hari)
														} else if ( ($data_master->catatan_lab != "" && date("d-m-Y", strtotime($data_master->tgl_catatan_lab)) != '01-01-1970' && date("Y-m-d", strtotime($tgl_catatan_lab2)) >= date("Y-m-d", strtotime($nowdate)) ) or ($data_master->catatan_lab != "" && date("d-m-Y", strtotime($data_master->tgl_catatan_lab)) == '01-01-1970' ) ) {
															$bgcolorfinish = "background-color:#FFFF00; color:#000000"; //yellow
																
														//----------cek catatan lab yg sudah expired date (setelah plus 30 hari)
														} else if ( $data_master->catatan_lab != "" && date("d-m-Y", strtotime($data_master->tgl_catatan_lab)) != '01-01-1970' && date("Y-m-d", strtotime($tgl_catatan_lab2)) < date("Y-m-d", strtotime($nowdate)) ) {
															$bgcolorfinish = "background-color:#0000FF; color:#ffffff"; //blue
														} 
														
														//If Col = 33 Then ForeColor = vbBlack 
														##---------------------------------------------------/\
														
																												
												?>
													
													<tr>
														<input type="hidden" name="slipno_<?php echo $i; ?>" id="slipno_<?php echo $i; ?>" value="<?php echo $data_master->slipno ?>">
														<input type="hidden" name="orderid_<?php echo $i; ?>" id="orderid_<?php echo $i; ?>" value="<?php echo $data_master->orderid ?>">
														<input type="hidden" name="autoid_<?php echo $i; ?>" id="autoid_<?php echo $i; ?>" value="<?php echo $data_master->autoid ?>">
														<input type="hidden" name="suborderid_<?php echo $i; ?>" id="suborderid_<?php echo $i; ?>" value="<?php echo $data_master->suborderid ?>">
														<input type="hidden" name="periodid_<?php echo $i; ?>" id="periodid_<?php echo $i; ?>" value="<?php echo $data_master->periodid ?>">
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>"><?php echo $data_master->slipno ?></td>
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>"><?php echo $order_date ?></td>
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>"><?php echo $tglselesai ?></td>
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>"><?php echo $data_master->clientname ?></td>
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>"><?php echo $data_master->nama_barang ?></td>
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>"><?php echo $data_master->objek_kalibrasi ?></td>
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>"><?php echo $data_master->noseri ?></td>
														<td style="text-align:center;<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27; ?>" ><input type="checkbox" name="finish_<?php echo $i; ?>" id="finish_<?php echo $i; ?>" value="1" <?php if($data_master->finish==1) echo "checked" ?> onClick="checklist(<?php echo $i ?>)" /></td>
														<td style="text-align:center; <?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27; ?>" ><input type="checkbox" name="finish1_<?php echo $i ?>" id="finish1_<?php echo $i ?>" value="1" <?php if($data_master->finish1==1) echo "checked" ?>  onClick="checklist(<?php echo $i ?>)" /></td>
														<td style="text-align:center; <?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27; ?>" ><input type="checkbox" name="finish2_<?php echo $i ?>" id="finish2_<?php echo $i ?>" value="1" <?php if($data_master->finish2==1) echo "checked" ?> onClick="checklist(<?php echo $i ?>)" /></td>
														
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>"><input type="text" name="tglfinish_<?php echo $i ?>" id="tglfinish_<?php echo $i ?>" class='datepick' style="width:100px; height:10px; font-size:10px " value="<?php echo $tglfinish ?>" onBlur="checklist(<?php echo $i ?>)"></td>
														
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>">
														<select name="kategori_<?php echo $i ?>" id="kategori_<?php echo $i ?>" style="width:auto;height:20px; font-size:10px; padding:0px;" onBlur="checklist(<?php echo $i ?>)" />
															<option value=""></option>
															<?php kategori_combo_select($data_master->kategori); ?>
														</select>
														</td>
														
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>"><input type="text" name="catatan_lab_<?php echo $i ?>" id="catatan_lab_<?php echo $i ?>" value="<?php echo $data_master->catatan_lab ?>" style="height:15px; font-size:12px " onBlur="checklist(<?php echo $i ?>)" /></td>
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>"><?php echo $tgl_catatan_lab ?></td>
														
														<td style="<?php echo $bgcolorfinish_bawah_25 . $bgcolorfinish . $bgcolorfinish_bawah_27 ?>"><input type="text" name="ket_alat_<?php echo $i ?>" id="ket_alat_<?php echo $i ?>" value="<?php echo $data_master->ket_alat ?>" style="height:15px; font-size:12px " onBlur="checklist(<?php echo $i ?>)" /></td>
														
														<td style="text-align:center; <?php echo $bgcolorfinish . $bgcolorfinish_atas_26_bawah_27 . $bgcolorfinish_bawah_27; ?>" ><input type="checkbox" name="konsep_<?php echo $i ?>" id="konsep_<?php echo $i ?>" value="1" <?php if($data_master->konsep==1) echo "checked" ?> onClick="checklist(<?php echo $i ?>)" /></td>
														<td style="<?php echo $bgcolorfinish . $bgcolorfinish_atas_26_bawah_27 . $bgcolorfinish_bawah_27 ?>"><?php echo $tglkonsep ?></td>
														
														<td style="text-align:center; <?php echo $bgcolorfinish . $bgcolorfinish_atas_28_bawah_29 ; ?>" ><input type="checkbox" name="sertifikat_<?php echo $i ?>" id="sertifikat_<?php echo $i ?>" value="1" <?php if($data_master->sertifikat==1) echo "checked" ?>  onClick="checklist(<?php echo $i ?>)" /></td>
														
														<td style="<?php echo $bgcolorfinish . $bgcolorfinish_atas_28_bawah_29 ?>"><input type="text" name="tglsertifikat_<?php echo $i ?>" id="tglsertifikat_<?php echo $i ?>" class='datepick' style="width:100px; height:10px; font-size:10px " value="<?php echo $tglsertifikat ?>" onBlur="checklist(<?php echo $i ?>)"></td>
														
														<td style="text-align:center; <?php echo $bgcolorfinish . $bgcolorfinish_atas_28_bawah_29 ; ?>" ><input type="checkbox" name="tu_<?php echo $i ?>" id="tu_<?php echo $i ?>" value="1" <?php if($data_master->tu==1) echo "checked" ?> onClick="checklist(<?php echo $i ?>)" /></td>
														<td style="<?php echo $bgcolorfinish . $bgcolorfinish_atas_30_bawah_31 ?>"><?php echo $tgltu ?></td>
														<?php /*<td style="<?php echo $bgcolorfinish . $bgcolorfinish_atas_30_bawah_31 ?>"><?php echo $data_master->kalibrator ?></td> */ ?>
														<td style="text-align:center; <?php echo $bgcolorfinish ?>" ><input type="checkbox" name="batal_<?php echo $i ?>" id="batal_<?php echo $i ?>" value="1" <?php if($data_master->batal==1) echo "checked" ?> onClick="checklist(<?php echo $i ?>)" /></td>
														<td style="<?php echo $bgcolorfinish ?>"><input type="text" name="catatan_batal_<?php echo $i ?>" id="catatan_batal_<?php echo $i ?>" value="<?php echo $data_master->catatan_batal ?>" style="height:15px; font-size:12px " onBlur="checklist(<?php echo $i ?>)" /></td>
														<td><input type="text" name="no_sertifikat_<?php echo $i ?>" id="no_sertifikat_<?php echo $i ?>" value="<?php echo $data_master->no_sertifikat ?>" style="width:auto; height:15px; font-size:12px " onBlur="checklist(<?php echo $i ?>)" /></td>
														<td><input type="text" name="no_kertas_<?php echo $i ?>" id="no_kertas_<?php echo $i ?>" value="<?php echo $data_master->no_kertas ?>" style="width:70px; height:15px; font-size:12px " onBlur="checklist(<?php echo $i ?>)" /></td>
														<td><input type="text" name="no_kertas2_<?php echo $i ?>" id="no_kertas2_<?php echo $i ?>" value="<?php echo $data_master->no_kertas2 ?>" style="width:70px; height:15px; font-size:12px " onBlur="checklist(<?php echo $i ?>)" /></td>
														<td><input type="text" name="Lokasi_<?php echo $i ?>" id="Lokasi_<?php echo $i ?>" value="<?php echo $data_master->Lokasi ?>" style="height:15px; font-size:12px " onBlur="checklist(<?php echo $i ?>)" /></td>
														<td>
															<?php //echo $data_master->ProCde ?>
															<div id="suggest_<?php echo $i ?>" align="left" style="position:relative" >
																<input type="text" size="15" onKeyUp="suggest_<?php echo $i ?>(this.value, 'auto/laborder/auto_prv.php?no=<?php echo $i ?>');" name="ProCde_<?php echo $i; ?>"  onBlur="fill2_<?php echo $i; ?>();" id="ProCde_<?php echo $i; ?>" value="<?php echo $data_master->ProCde ?>" />
															   <div class="suggestionsBox_<?php echo $i; ?>" id="suggestions_<?php echo $i; ?>" style="display:none;"><img src="auto/arrow.png" style="position: relative; top: -12px; left: 0px;" alt="upArrow" />
																	<div class="suggestionList_<?php echo $i; ?>" id="suggestionsList_<?php echo $i; ?>" > &nbsp; </div>							
															   </div>
															   
															   <input type="text" size="25" style="background-color:#E2F6C5;" readonly="" name="ProNme_<?php echo $i; ?>" id="ProNme_<?php echo $i; ?>"  onBlur="fill_<?php echo $i; ?>();" value="<?php echo $data_master->ProNme ?>" />
															</div>
														</td>
														<td>&nbsp;</td>
													</tr>
													
													<div id="ord_slipno2"></div>
													<div id="ord_finish2"></div>
													<div id="ord_finish12"></div>
													<div id="ord_finish22"></div>
													<div id="ord_konsep2"></div>
													<div id="ord_sertifikat2"></div>
													<div id="ord_tu2"></div>
													<div id="ord_batal2"></div>
													<div id="ord_orderid2"></div>
													<div id="ord_autoid2"></div>
													<div id="ord_suborderid2"></div>
													<div id="ord_periodid2"></div>
													
													<div id="ord_tglfinish2"></div> <!---->
													<div id="ord_kategori2"></div> <!------->
													<div id="ord_tglkonsep2"></div>
													<div id="ord_tglsertifikat2"></div>
													<div id="ord_tgltu2"></div>
													<div id="ord_catatan_lab2"></div>
													<div id="ord_catatan_batal2"></div>
													<div id="ord_kalibrator2"></div>
													<div id="ord_seri2"></div>
													<div id="ord_uid2"></div>		
													<div id="ord_tglfinish22"></div>
													<div id="ord_finish1_nip2"></div>
													<div id="ord_finish2_nip2"></div>
													<div id="ord_finish3_nip2"></div>
													<div id="ord_konsep_nip2"></div>
													<div id="ord_sertifikat_nip2"></div>
													<div id="ord_tu_nip2"></div>													
													<div id="ord_no_sertifikat2"></div>
													<div id="ord_ket_alat2"></div>
													<div id="ord_no_kertas2"></div>
													<div id="ord_Lokasi2"></div>
													<div id="ord_tgl_catatan_lab2"></div>
													<div id="ord_ProCde2"></div>
													<div id="ord_no_kertas22"></div>
													<div id="ord_NoSertifikat2"></div>
													
																										
												<?php
												}
												?>
												
											</tbody>
											
										</table>
										
										<table>
											<thead>
												<tr>
													<td>&nbsp;</td>
													<td>
														<input type="submit" name="submit" class='btn btn-primary' value="Save" />
													</td>
												</tr>
											</thead>
										</table>
										</form>
										</div>
									</div>
							</div>
						</div>
						
				</div>
			</div>

		</div>
	</div>
</div>