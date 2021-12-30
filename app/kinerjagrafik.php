<?php 
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

 	//include("../app/include/sambung.php");
 	//include("../app/include/functions.php");
 	
 	include("chart/FusionCharts_Gen.php");
	
	$dtefrom = $_REQUEST["dtefrom"];
	$dteto = $_REQUEST["dteto"];
	$labid = $_REQUEST["labid"];
	$labid = substr($labid,0,2);
	
	$dtefrom = date('Y-m', strtotime($dtefrom));	
	$dteto = date('Y-m', strtotime($dteto));
	
	$dk		= $_REQUEST["dk"];
	$dl		= $_REQUEST["dl"];
	
	$uttp	= $_REQUEST["uttp"];
	$snsu	= $_REQUEST["snsu"];
	$su		= $_REQUEST["su"];
	$oth	= $_REQUEST["oth"];
	$all	= $_REQUEST["all"];
	
	$tu		= $_REQUEST["tu"];
	$sarana	= $_REQUEST["sarana"];
	$penilaian	= $_REQUEST["penilaian"];
	$pengawasan	= $_REQUEST["pengawasan"];
	$evaluasi	= $_REQUEST["evaluasi"];
	$bsml1		= $_REQUEST["bsml1"];
	$bsml2		= $_REQUEST["bsml2"];
	$bsml3		= $_REQUEST["bsml3"];
	$bsml4		= $_REQUEST["bsml4"];
	$bsml5		= $_REQUEST["bsml5"];
	
	$adm	= $_SESSION["adm"]; //$_REQUEST["adm"];
	$usr	= $_SESSION["userid"]; //$_REQUEST["usr"];
	
	//---------------
	$periode = date("Y");
	
	if($dtefrom == "1970-01") {
		$month = "1";
		$year = date("Y");
		$monthyear = $year . "-" . $month;
		
		$dtefrom = date("Y-m", strtotime($monthyear));
		
		if($_SESSION["snsu2"] == 0) {
			$uttp = 1;
			$snsu = 0;
			$dk = 1;
		}
		
		if($_SESSION["snsu2"] == 1) {
			$uttp = 0;
			$snsu = 1;
			$dk = 1;
		}	
	}
	
	if($dteto == "1970-01") {
		$month2 = date("m");
		$year2 = date("Y");
		$monthyear2 = $year2 . "-" . $month2;
		
		$dteto = date("Y-m", strtotime($monthyear2));	
	}
	
	$dk_cek = "";
	if($dk == 1) {
		$dk_cek = "checked";
	}
	
	$dl_cek = "";
	if($dl == 1) {
		$dl_cek = "checked";
	}
	
	$uttp_cek = "";
	if($uttp == 1) {
		$uttp_cek = "checked";
	}
	
	$snsu_cek = "";
	if($snsu == 1) {
		$snsu_cek = "checked";
	}
	
	$su_cek = "";
	if($su == 1) {
		$su_cek = "checked";
	}
	
	$all_cek = "";
	if($all == 1) {
		$all_cek = "checked";
	}
	
	$tu_cek = "";
	if($tu == 1) {
		$tu_cek = "checked";
	}
	
	$sarana_cek = "";
	if($sarana == 1) {
		$sarana_cek = "checked";
	}
	
	$penilaian_cek = "";
	if($penilaian == 1) {
		$penilaian_cek = "checked";
	}
	
	$pengawasan_cek = "";
	if($pengawasan == 1) {
		$pengawasan_cek = "checked";
	}
	
	$evaluasi_cek = "";
	if($evaluasi == 1) {
		$evaluasi_cek = "checked";
	}
	
	$bsml1_cek = "";
	if($bsml1 == 1) {
		$bsml1_cek = "checked";
	}
	
	$bsml2_cek = "";
	if($bsml2 == 1) {
		$bsml2_cek = "checked";
	}
	
	$bsml3_cek = "";
	if($bsml3 == 1) {
		$bsml3_cek = "checked";
	}
	
	$bsml4_cek = "";
	if($bsml4 == 1) {
		$bsml4_cek = "checked";
	}
	
	$bsml5_cek = "";
	if($bsml5 == 1) {
		$bsml5_cek = "checked";
	}
	//---------------
	
	$subdit = "";
	
	if ($uttp == 1) {
		if ($subdit == '') { 
			$subdit = ' 1 '; 
		} else { 
			$subdit = $subdit . " ,1 ";
		}
		
	}
	if ($snsu == 1) {
		if ($subdit == '') { 
			$subdit = ' 2 '; 
		} else { 
			$subdit = $subdit . " ,2 ";
		} 
	}
	if ($su == 1) {
		if ($subdit == '') { 
			$subdit = ' 4 '; 
		} else { 
			$subdit = $subdit . " ,4 ";
		} 		
	}
	if ($pengawasan == 1) {
		if ($subdit == '') { 
			$subdit = ' 3 '; 
		} else { 
			$subdit = $subdit . " ,3 ";
		}
	}
	if ($penilaian == 1) {
		if ($subdit == '') { 
			$subdit = ' 5 '; 
		} else { 
			$subdit = $subdit . " ,5 ";
		}
	}
	if ($sarana == 1) {
		if ($subdit == '') { 
			$subdit = ' 6 '; 
		} else { 
			$subdit = $subdit . " ,6 ";
		}
	}
	if ($tu == 1) {
		if ($subdit == '') { 
			$subdit = ' 7 '; 
		} else { 
			$subdit = $subdit . " ,7 ";
		}
	}
	if ($evaluasi == 1) {
		if ($subdit == '') { 
			$subdit = ' 7 '; 
		} else { 
			$subdit = $subdit . " ,7 ";
		}
	}
	if ($bsml1 == 1) {
		if ($subdit == '') { 
			$subdit = ' 9 '; 
		} else { 
			$subdit = $subdit . " ,9 ";
		}
	}
	if ($bsml2 == 1) {
		if ($subdit == '') { 
			$subdit = ' 10 '; 
		} else { 
			$subdit = $subdit . " ,10 ";
		}
	}
	if ($bsml3 == 1) {
		if ($subdit == '') { 
			$subdit = ' 11 '; 
		} else { 
			$subdit = $subdit . " ,11 ";
		}
	}
	if ($bsml4 == 1) {
		if ($subdit == '') { 
			$subdit = ' 12 '; 
		} else { 
			$subdit = $subdit . " ,12 ";
		}
	}
	if ($bsml5 == 1) {
		if ($subdit == '') { 
			$subdit = ' 13 '; 
		} else { 
			$subdit = $subdit . " ,13 ";
		}
	}
	
	if ($oth == 1) {
		if ($subdit == '') { 
			$subdit = ' 3,5,6,7,8,9,10,11,12 '; 
		} else { 
			$subdit = $subdit . " ,3,5,6,7,8,9,10,11,12 ";
		} 
	}
	
	$subdit2 = ' and b. SubDitCde in ('.$subdit.')';
	$subdit = ' and c. SubDitCde in ('.$subdit.')';
	
	
	if ($all == 1) {
		$subdit = '';
		$subdit2 = ''; 
	} 
		
?>

	<!--<html>
	  <head>
		<title>First Chart Using FusionCharts PHP Class</title>-->
		<script language='javascript' src='chart/FusionCharts.js'></script>
	  <!--</head>
	  <body>-->


<div class="container-fluid">
		<div class="content">
			<div class="row-fluid">
				<div class="span12">
					
						<div class="box-content">
							<form action="" method="post" name="kinerjagrafik" id="kinerjagrafik" class="form-horizontal">
								<div>
									
									<table border="0">
										<tr>
											<td>Periode</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="text" name="dtefrom" class='datepick' id="dtefrom" style="width:70px; height:10px; font-size:12px " value="<?php echo $dtefrom ?>">&nbsp;s/d&nbsp;<input type="text" name="dteto" class='datepick' id="dteto" style="width:70px; height:10px; font-size:12px " value="<?php echo $dteto ?>">
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>SNSU</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="snsu" name="snsu" value="1" <?php echo $snsu_cek ?> >
											</td>
											<td>&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>Penilaian</td>
											<td>&nbsp;</td>
											<td>
												<input type="checkbox" id="penilaian" name="penilaian" value="1" <?php echo $penilaian_cek ?> >
											</td>
											
											<td>&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>BSML-2</td>
											<td>&nbsp;</td>
											<td>
												<input type="checkbox" id="bsml2" name="bsml2" value="1" <?php echo $bsml2_cek ?> >
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td></td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="submit" name="submit" class='btn btn-primary' value="Refresh" onclick="submitForm('find')" >
											</td>
											
										</tr>
										<tr>
											<td>Dalam Kantor</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="dk" name="dk" value="1" <?php echo $dk_cek ?> >
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>USU</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="su" name="su" value="1" <?php echo $su_cek ?> >
											</td>											
											
											<td>&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>Pengawasan</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="pengawasan" name="pengawasan" value="1" <?php echo $pengawasan_cek ?> >
											</td>
											
											<td>&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>BSML-3</td>
											<td>&nbsp;</td>
											<td>
												<input type="checkbox" id="bsml3" name="bsml3" value="1" <?php echo $bsml3_cek ?> >
											</td>
										</tr>
										<tr>
											<td>Dinas Luar</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="dl" name="dl" value="1" <?php echo $dl_cek ?> >
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>TU</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="tu" name="tu" value="1" <?php echo $tu_cek ?> >
											</td>
											
											<td>&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>Evaluasi</td>
											<td>&nbsp;</td>
											<td>
												<input type="checkbox" id="evaluasi" name="evaluasi" value="1" <?php echo $evaluasi_cek ?> >
											</td>
											
											<td>&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>BSML-4</td>
											<td>&nbsp;</td>
											<td>
												<input type="checkbox" id="bsml4" name="bsml4" value="1" <?php echo $bsml4_cek ?> >
											</td>
										</tr>
										<tr>
											<td>UTTP</td>
											<td>&nbsp;&nbsp;</td>
											<td>
												<input type="checkbox" id="uttp" name="uttp" value="1" <?php echo $uttp_cek ?> >
											</td>
											
											<td>&nbsp;&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>Sarana</td>
											<td>&nbsp;</td>
											<td>
												<input type="checkbox" id="sarana" name="sarana" value="1" <?php echo $sarana_cek ?> >
											</td>
											
											<td>&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>BSML-1</td>
											<td>&nbsp;</td>
											<td>
												<input type="checkbox" id="bsml1" name="bsml1" value="1" <?php echo $bsml1_cek ?> >
											</td>
											
											<td>&nbsp;</td>
											
											<td>&nbsp;</td>
											<td>Semua</td>
											<td>&nbsp;</td>
											<td>
												<input type="checkbox" id="all" name="all" value="1" <?php echo $all_cek ?> >
											</td>
										</tr>
									</table>
									
								</div>								
							</form>
						</div>	
					
					
				
				
	  <?php
	  # Include FusionCharts PHP Class
	  # Create object for Column 3D chart
	  
	  /*if ( $rjml["jml"] < 100 ) {
	  		$FC = new FusionCharts("bar2d","1000","800");
	  } else {*/
	  		$FC = new FusionCharts("bar2d","1080","800");
	  //}
	  # Setting Relative Path of chart swf file.
	  $FC->setSwfPath("chart/");
	
	  # Store chart attributes in a variable
	  # caption=Grafik Kinerja Pegawai; 
	  $strParam="xAxisName=Nama Penera ;yAxisName=Jumlah;decimalPrecision=0; formatNumberScale=0";
	
	  # Set chart attributes	  
	  $FC->setChartParams($strParam);
			if ( ($dk == 1 && $dl == 0) ) {
				if ($adm == 1) {
					
					$kategori = odbc_exec(condb,"select aa.* from (select distinct a.EpyCde, NamaKaryawan,
								case 
								when b.NIP='19580426 197903 1 002' then 1
								when b.NIP='19580520 198101 1 003' then 2
								when b.NIP='19581105 198410 1 00' then 3
								when b.NIP='19581205 198101 1 001' then 4
								when b.NIP='19590320 198403 1 001' then 5
								when b.NIP='19590930 198101 1 002' then 6
								when b.NIP='19611112 198302 1 001' then 7
								when b.NIP='19630818 198401 1 001' then 8
								when b.NIP='19650827 198411 1 001' then 9
								when b.NIP='19661129 199603 1 001' then 10
								when b.NIP='19670317 199603 1 00' then 11
								when b.NIP='19681227 198901 1 001' then 12
								when b.NIP='19690326 199303 1 003' then 13
								when b.NIP='19690519 199102 1 001' then 14
								when b.NIP='19700930 199103 1 004' then 15
								when b.NIP='19720518 199503 1 001' then 16
								when b.NIP='19730507 200312 2 001' then 17
								when b.NIP='19740129 200502 1 001' then 18
								when b.NIP='19750625 199403 2 001' then 19
								when b.NIP='19800521 200502 1 001' then 20
								when b.NIP='19810121 200312 1 003' then 21
								when rtrim(ltrim(left(b.golongan,7)))='IV/b' then 22
								when rtrim(ltrim(left(b.golongan,7)))='IV b' then 23
								when rtrim(ltrim(left(b.golongan,7)))='IV/A' then 24
								when rtrim(ltrim(left(b.golongan,7)))='IV a' then 25
								when rtrim(ltrim(left(b.golongan,7)))='IV/a' then 26
								when rtrim(ltrim(left(b.golongan,7)))='IIII/d' then 27
								when rtrim(ltrim(left(b.golongan,7)))='III/d' then 28
								when rtrim(ltrim(left(b.golongan,7)))='III d' then 29
								when rtrim(ltrim(left(b.golongan,7)))='(III/c)' then 30
								when rtrim(ltrim(left(b.golongan,7)))='III/c' then 31
								when rtrim(ltrim(left(b.golongan,7)))='III c' then 32
								when rtrim(ltrim(left(b.golongan,7)))='IIIB' then 33								
								when rtrim(ltrim(left(b.golongan,7)))='III/b' then 34
								when rtrim(ltrim(left(b.golongan,7)))='III b' then 35
								when rtrim(ltrim(left(b.golongan,7)))='III/a' then 36
								when rtrim(ltrim(left(b.golongan,7)))='III a' then 37
								when rtrim(ltrim(left(b.golongan,7)))='II/d' then 38
								when rtrim(ltrim(left(b.golongan,7)))='II/c' then 39
								when rtrim(ltrim(left(b.golongan,7)))='II c' then 40
								when rtrim(ltrim(left(b.golongan,7)))='II/a' then 41
								end struktur 
							from
								(select distinct Finish1_nip EpyCde from SubOrderDetail where periodid=$periode and isnull(Finish1_nip,'')<>''
									and isnull(Finish1_nip,'')<>'-'
								union all
								select distinct Finish2_nip EpyCde from SubOrderDetail where periodid=$periode and isnull(Finish2_nip,'')<>''
									and isnull(Finish2_nip,'')<>'-'
								union all
								select distinct Finish3_nip EpyCde from SubOrderDetail where periodid=$periode and isnull(Finish3_nip,'')<>''
									and isnull(Finish3_nip,'')<>'-') a
							left join Karyawan b on a.EpyCde=b.NIP
							where isnull(a.EpyCde,'')<>'sa' and isnull(b.NamaKaryawan,'')<>'' and b.NIP <> '555' and b.NIP <> '19590930 198101 1 002' and b.NIP<>'19650827 198411 1 001' " . $subdit2 . " ) aa Order by aa.struktur, aa.EpyCde ");
							
				} else {
					
					$pegawai = odbc_exec(condb,"select EpyCde from Usr where UID='$usr'");
					$data_peg = odbc_fetch_array($pegawai);
					$nik_peg = $data_peg['EpyCde'];
					
					$kategori = odbc_exec(condb,"select aa.* from (select distinct a.EpyCde, NamaKaryawan,
							rtrim(ltrim(left(b.golongan,7))) struktur 
							from
							(select distinct Finish1_nip EpyCde from SubOrderDetail where periodid=$periode and isnull(Finish1_nip,'')<>''
							and isnull(Finish1_nip,'')<>'-'
							union all
							select distinct Finish2_nip EpyCde from SubOrderDetail where periodid=$periode and isnull(Finish2_nip,'')<>''
							and isnull(Finish2_nip,'')<>'-'
							union all
							select distinct Finish3_nip EpyCde from SubOrderDetail where periodid=$periode and isnull(Finish3_nip,'')<>''
							and isnull(Finish3_nip,'')<>'-') a
							left join Karyawan b on a.EpyCde=b.NIP
							where isnull(a.EpyCde,'')='$nik_peg' and isnull(b.NamaKaryawan,'')<>'') aa Order by aa.struktur, aa.EpyCde");
				}	
																
				//and a.EpyCde<>'19720518 199503 1 001'  (pak indra)
				//and a.EpyCde<>'19590930 198101 1 002'  (pak bambang)
			} 
			
			if ( ($dk == 1 && $dl == 1) || ($dk == 0 && $dl == 1) ) {
				if ($adm == 1) {
				
					$kategori = odbc_exec(condb,"select aa.* from (select distinct c.NIP EpyCde, 
								c.NamaKaryawan,
								case 
								when c.NIP='19580426 197903 1 002' then 1
								when c.NIP='19580520 198101 1 003' then 2
								when c.NIP='19581105 198410 1 00' then 3
								when c.NIP='19581205 198101 1 001' then 4
								when c.NIP='19590320 198403 1 001' then 5
								when c.NIP='19590930 198101 1 002' then 6
								when c.NIP='19611112 198302 1 001' then 7
								when c.NIP='19630818 198401 1 001' then 8
								when c.NIP='19650827 198411 1 001' then 9
								when c.NIP='19661129 199603 1 001' then 10
								when c.NIP='19670317 199603 1 00' then 11
								when c.NIP='19681227 198901 1 001' then 12
								when c.NIP='19690326 199303 1 003' then 13
								when c.NIP='19690519 199102 1 001' then 14
								when c.NIP='19700930 199103 1 004' then 15
								when c.NIP='19720518 199503 1 001' then 16
								when c.NIP='19730507 200312 2 001' then 17
								when c.NIP='19740129 200502 1 001' then 18
								when c.NIP='19750625 199403 2 001' then 19
								when c.NIP='19800521 200502 1 001' then 20
								when c.NIP='19810121 200312 1 003' then 21
								when rtrim(ltrim(left(c.golongan,7)))='IV/b' then 22
								when rtrim(ltrim(left(c.golongan,7)))='IV b' then 23
								when rtrim(ltrim(left(c.golongan,7)))='IV/A' then 24
								when rtrim(ltrim(left(c.golongan,7)))='IV a' then 25
								when rtrim(ltrim(left(c.golongan,7)))='IV/a' then 26
								when rtrim(ltrim(left(c.golongan,7)))='IIII/d' then 27
								when rtrim(ltrim(left(c.golongan,7)))='III/d' then 28
								when rtrim(ltrim(left(c.golongan,7)))='III d' then 29
								when rtrim(ltrim(left(c.golongan,7)))='(III/c)' then 30
								when rtrim(ltrim(left(c.golongan,7)))='III/c' then 31
								when rtrim(ltrim(left(c.golongan,7)))='III c' then 32
								when rtrim(ltrim(left(c.golongan,7)))='IIIB' then 33								
								when rtrim(ltrim(left(c.golongan,7)))='III/b' then 34
								when rtrim(ltrim(left(c.golongan,7)))='III b' then 35
								when rtrim(ltrim(left(c.golongan,7)))='III/a' then 36
								when rtrim(ltrim(left(c.golongan,7)))='III a' then 37
								when rtrim(ltrim(left(c.golongan,7)))='II/d' then 38
								when rtrim(ltrim(left(c.golongan,7)))='II/c' then 39
								when rtrim(ltrim(left(c.golongan,7)))='II c' then 40
								when rtrim(ltrim(left(c.golongan,7)))='II/a' then 41
								end struktur
								from Karyawan c  
								Where isnull(c.NIP,'')<>''
									and isnull(c.NamaKaryawan,'') <> ''
									and isnull(c.userid,'')<>'' and isnull(c.golongan,'')<>'' and isnull(c.golongan,'')<>'-' and c.NIP <> '19590930 198101 1 002' and c.NIP<>'19650827 198411 1 001'
									" . $subdit . "
								) aa Order by aa.struktur, aa.EpyCde ");
				} else {
					$pegawai = odbc_exec(condb,"select EpyCde from Usr where UID='$usr'");
					$data_peg = odbc_fetch_array($pegawai);
					$nik_peg = $data_peg['EpyCde'];
					
					$kategori = odbc_exec(condb,"select aa.* from (select distinct c.NIP EpyCde, 
								c.NamaKaryawan,
								rtrim(ltrim(left(c.golongan,7))) struktur
								from Karyawan c  
								Where isnull(c.NIP,'')='$nik_peg' 
								) aa Order by aa.struktur, aa.EpyCde ");
				}
																
				//and a.EpyCde<>'19720518 199503 1 001'  (pak indra)
				//and a.EpyCde<>'19590930 198101 1 002'  (pak bambang)
			} 
			
			while ($r_kat = odbc_fetch_array($kategori)){
			
			$total = 0;
			$id_kat = $r_kat['EpyCde'];
			//$kat =  "<a href='kinerjagrafik_detail.php?dtefrom=$dtefrom&dteto=$dteto&nik=$id_kat&labid=$labid&dk=$dk&dl=$dl'>".$r_kat['NamaKaryawan']."</a>";
			
			$kat =  "<a href='main.php?menu=app&act=kinerjagrafik_detail&dtefrom=$dtefrom&dteto=$dteto&nik=$id_kat&labid=$labid&dk=$dk&dl=$dl'>".$r_kat['NamaKaryawan']."</a>";
			
			
			//$r_kat['NamaKaryawan']
			//$counter1 = 0;
		
			if ($dl == 1) {
				//------------Dinas Luar--------\/		
				$sql2 = odbc_exec(condb,"select isnull(count(a.EpyCde),0) kinerja  
							from OutBldNIK a  
							left join OutBld b on a.OutBldCde=b.OutBldCde  
							Where isnull(b.Btl,0)=0 
								and convert(varchar(7),b.frmdte,20) >= '$dtefrom' 
								and convert(varchar(7),b.frmdte,20) <= '$dteto'
								and a.EpyCde='$id_kat'
								group by a.EpyCde");
			
				//$counter1++;
				
				$r_kat2 = odbc_fetch_array($sql2);
				//$persentase = ($total!=0 || $review !=0)?($review / $total) *100:0;
				$total = $r_kat2['kinerja'];
				//------------------------------------/\
			}
			
			if ($dk == 1) {
				//-------------------Penguji-1----------\/
				$sql_finish1= odbc_exec(condb, "select count(a.finish1_nip) finish1
							from SubOrderDetail a
							left join [Order] b on case when isnull(a.verifikasi,0)=0 then left(a.Identifikasi,11)
								when isnull(a.verifikasi,0)=1 then left(a.Identifikasi,12) end=b.SlipNo
								and a.periodid=b.periodid
							Where convert(varchar(7),b.Date,20) >= '$dtefrom' 
								and convert(varchar(7),b.Date,20) <= '$dteto' 
								and a.Finish1_nip='$id_kat'");
				$data1 = odbc_fetch_array($sql_finish1);
				$total = $total + $data1['finish1'];
				//--------------------------------------/\
				
				//-------------------Penguji-2----------\/
				$sql_finish2= odbc_exec(condb, "select count(a.finish2_nip) finish2
							from SubOrderDetail a
							left join [Order] b on case when isnull(a.verifikasi,0)=0 then left(a.Identifikasi,11)
								when isnull(a.verifikasi,0)=1 then left(a.Identifikasi,12) end=b.SlipNo
								and a.periodid=b.periodid
							Where convert(varchar(7),b.Date,20) >= '$dtefrom' 
								and convert(varchar(7),b.Date,20) <= '$dteto' 
								and a.Finish2_nip='$id_kat'");
				$data2 = odbc_fetch_array($sql_finish2);
				$total = $total + $data2['finish2'];
				//--------------------------------------/\
				
				//-------------------Penguji-3----------\/
				$sql_finish3= odbc_exec(condb, "select count(a.finish3_nip) finish3
							from SubOrderDetail a
							left join [Order] b on case when isnull(a.verifikasi,0)=0 then left(a.Identifikasi,11)
								when isnull(a.verifikasi,0)=1 then left(a.Identifikasi,12) end=b.SlipNo
								and a.periodid=b.periodid
							Where convert(varchar(7),b.Date,20) >= '$dtefrom' 
								and convert(varchar(7),b.Date,20) <= '$dteto' 
								and a.Finish3_nip='$id_kat'");
				$data3 = odbc_fetch_array($sql_finish3);
				$total = $total + $data3['finish3'];
				//--------------------------------------/\
				
				/*
				//-------------------Konsep----------\/
				$sql_konsep= odbc_exec(condb, "select count(a.konsep_nip) konsep
							from SubOrderDetail a
							left join [Order] b on case when isnull(a.verifikasi,0)=0 then left(a.Identifikasi,11)
								when isnull(a.verifikasi,0)=1 then left(a.Identifikasi,12) end=b.SlipNo
								and a.periodid=b.periodid
							Where convert(varchar(7),b.Date,20) >= '$dtefrom' 
								and convert(varchar(7),b.Date,20) <= '$dteto' 
								and a.konsep_nip='$id_kat'");
				$datakonsep = odbc_fetch_array($sql_konsep);
				$total = $total + $datakonsep['konsep'];
				//--------------------------------------/\
				
				//-------------------sertifikat----------\/
				$sql_sertifikat= odbc_exec(condb, "select count(a.sertifikat_nip) sertifikat
							from SubOrderDetail a
							left join [Order] b on case when isnull(a.verifikasi,0)=0 then left(a.Identifikasi,11)
								when isnull(a.verifikasi,0)=1 then left(a.Identifikasi,12) end=b.SlipNo
								and a.periodid=b.periodid
							Where convert(varchar(7),b.Date,20) >= '$dtefrom' 
								and convert(varchar(7),b.Date,20) <= '$dteto' 
								and a.sertifikat_nip='$id_kat'");
				$datasertifikat = odbc_fetch_array($sql_sertifikat);
				$total = $total + $datasertifikat['sertifikat'];
				//--------------------------------------/\
				
				//-------------------tu----------\/
				$sql_tu= odbc_exec(condb, "select count(a.tu_nip) tu
							from SubOrderDetail a
							left join [Order] b on case when isnull(a.verifikasi,0)=0 then left(a.Identifikasi,11)
								when isnull(a.verifikasi,0)=1 then left(a.Identifikasi,12) end=b.SlipNo
								and a.periodid=b.periodid
							Where convert(varchar(7),b.Date,20) >= '$dtefrom' 
								and convert(varchar(7),b.Date,20) <= '$dteto' 
								and a.tu_nip='$id_kat'");
				$datatu = odbc_fetch_array($sql_tu);
				$total = $total + $datatu['tu'];
				//--------------------------------------/\
				*/
			}
			# add chart values and category names
			$FC->addChartData("$total","name=$kat");
				
		}
		# Render Chart
		$FC->renderChart();
				
	  ?>
	   <!--
	 <table style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
		<tr>
			<td bgcolor="#33CCFF">JUMLAH ORDER</td>
			<td>:</td>
			<td bgcolor="#FFFF00"><?ph echo $dataorder['jumlah_order']; ?></td>
		</tr>
		<tr>
			<td bgcolor="#33CCFF">JUMLAH FINISH</td>
			<td>:</td>
			<td bgcolor="#FFFF00"><?ph echo $datafinish['jumlah_finish']; ?></td>
		</tr>
	 </table>
	 --->
	 
	 		</div>
	 	</div>
	</div>
</div>
	
	
	 <!-- </body>
	</html> -->
