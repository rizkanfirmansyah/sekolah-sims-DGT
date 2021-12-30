<?php
session_start();
if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");

include '../app/class/class.select.view.php';

$select_view=new select_view;
?>

<script type="text/javascript" src="js/buttonajax.js"></script>

<script>
	
		 
	function cari_siswa(nama) {
		nama = "";
		newWindow('finance/carisiswa_terima.php', 'CariRekening','550','438','resizable=1,scrollbars=1,status=0,toolbar=0')
	}
	
	function accept_siswa(nis, nama) {
		document.getElementById('tnis').value = nis;
		document.getElementById('tnama').value = nama;
		
		getpenerimaan_get(nis);
	}
</script>

<?php

require_once('finance/include/theme.php');

$idpelajaran 	= 	$_REQUEST['idpelajaran'];
$departemen 	= 	$_REQUEST['departemen'];
$idtingkat	 	= 	$_REQUEST['idtingkat'];
$idkelas	 	= 	$_REQUEST['idkelas'];
$nama		 	= 	$_REQUEST['nama'];
$idkompetensi 	= 	$_REQUEST['idkompetensi'];
$idjeniskompetensi 	= 	$_REQUEST['idjeniskompetensi'];
$iddasarpenilaian	=	$_REQUEST['iddasarpenilaian'];
$idsemester		=	$_REQUEST['idsemester'];
$all		 	= 	$_REQUEST['all'];

$dbpdo = DB::create();

$sqlstr = "select a.nama from pelajaran a where a.replid = '$idpelajaran'";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$data=$sql->fetch(PDO::FETCH_OBJ);
$pelajaran=$data->nama; 

$sqlstr1 = "select a.tingkat from tingkat a where a.replid = '$idtingkat'";
$sql=$dbpdo->prepare($sqlstr1);
$sql->execute();
$data=$sql->fetch(PDO::FETCH_OBJ);
$tingkat = $data->tingkat;


$sqlstr = "select a.kelas from kelas a where a.replid = '$idkelas'";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$data=$sql->fetch(PDO::FETCH_OBJ);
$kelas = $data->kelas;

$kelas = $tingkat . " - " . $kelas;

$sqlstr = "select a.kode from kompetensi a where a.replid = '$idkompetensi'";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$data=$sql->fetch(PDO::FETCH_OBJ);
$kompetensi = $data->kode;

$sqlstr = "select a.jeniskompetensi from jeniskompetensi a where a.replid = '$idjeniskompetensi'";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$data=$sql->fetch(PDO::FETCH_OBJ);
$jeniskompetensi = $data->jeniskompetensi;

$sqlstr = "select a.keterangan from dasarpenilaian a where a.replid = '$iddasarpenilaian'";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$data=$sql->fetch(PDO::FETCH_OBJ);
$aspekpenilaian = $data->keterangan;

$sqlstr = "select a.replid, a.tahunajaran from tahunajaran a where a.aktif=1 and a.departemen='$departemen' limit 1";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$data=$sql->fetch(PDO::FETCH_OBJ);
$tahunajaran = $data->tahunajaran;
$idtahunajaran = $data->replid;

//===========save start
if ( (int)$_REQUEST['issubmit'] == 1 ) 
{
	
	$dbpdo = DB::create();
	
	try {
		$jmldata = $_POST['jmldata'];
		
		$idpelajaran 	= 	$_REQUEST['idpelajaran'];
		$departemen 	= 	$_REQUEST['departemen'];
		$idtingkat	 	= 	$_REQUEST['idtingkat'];
		$idkelas	 	= 	$_REQUEST['idkelas'];
		$nama		 	= 	$_REQUEST['nama'];
		$idkompetensi 	= 	$_REQUEST['idkompetensi'];
		$idjeniskompetensi 	= 	$_REQUEST['idjeniskompetensi'];
		$iddasarpenilaian	=	$_REQUEST['iddasarpenilaian'];
		$idtahunajaran	=	$_POST['idtahunajaran'];
		$idsemester		=	$_POST['idsemester'];
		$all		 	= 	$_REQUEST['all'];
		
		$x = 0;
		for ($x=0; $x<$jmldata; $x++) {
			
			$nis		=	$_POST[nis.$x];
			
			if($nis != "") {
				$n1			=	$_POST[n1.$x];
				$n2			=	$_POST[n2.$x];
				$n3			=	$_POST[n3.$x];
				$n4			=	$_POST[n4.$x];
				$uts		=	$_POST[uts.$x];
				$jumlah		=	$_POST[jumlah.$x];
				$rata		=	$_POST[rata.$x];
				$persen		=	$_POST[persen.$x];
				$uas		=	$_POST[uas.$x];
				$persen1	=	$_POST[persen1.$x];
				$na			=	$_POST[na.$x];
				$a			=	$_POST[a.$x];
				$line		=	$x;
				
				$sqlstr = "select replid from daftarnilai where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows=$sql->rowCount();
				
				if ( $rows == 0) {
					
					$sqlstr = "insert into daftarnilai (departemen, idtingkat, idkelas, idtahunajaran, idsemester, nis, idkompetensi, idjeniskompetensi, iddasarpenilaian, idpelajaran, n1, n2, n3, n4, uts, jumlah, rata, persen, uas, persen1, na, a, line) values ('$departemen', '$idtingkat', '$idkelas', '$idtahunajaran', '$idsemester', '$nis', '$idkompetensi', '$idjeniskompetensi', '$iddasarpenilaian', '$idpelajaran', '$n1', '$n2', '$n3', '$n4', '$uts', '$jumlah', '$rata', '$persen', '$uas', '$persen1', '$na', '$a', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				} else {
					
					$sqlstr = "update daftarnilai set n1='$n1', n2='$n2', n3='$n3', n4='$n4', uts='$uts', jumlah='$jumlah', rata='$rata', persen='$persen', uas='$uas', persen1='$persen1', na='$na', a='$a' where departemen='$departemen' and idtingkat='$idtingkat' and idkelas='$idkelas' and idtahunajaran='$idtahunajaran' and idsemester='$idsemester' and nis='$nis' and idkompetensi='$idkompetensi' and idjeniskompetensi='$idjeniskompetensi' and iddasarpenilaian='$iddasarpenilaian' and idpelajaran='$idpelajaran' ";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
				}
				
			}
			
		}
		
	}
	
	catch(PDOException $e){
		$errmsg = $e->getMessage();
		echo $e->getMessage();		
	}
	
	if( strlen($errmsg) == 0 ) {
		echo '
		<script language="javascript">
			alert("Simpan data nilai sukses");		
		</script>
		';
	}
	
	/*------------------------------------------------------------------------------------*/
	
}
	
?>		
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html>
<head>

<link rel="stylesheet" type="text/css" href="finance/style/style.css">
<link rel="stylesheet" type="text/css" href="finance/style/calendar-green.css">
<link rel="stylesheet" type="text/css" href="finance/style/tooltips.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIAS - DAFTAR NILAI</title>
<script src="finance/script/SpryValidationTextField.js" type="text/javascript"></script>
<link href="finance/script/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="finance/script/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="finance/script/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="finance/script/tooltips.js" language="javascript"></script>
<script language="javascript" src="finance/script/tables.js"></script>
<script language="javascript" src="finance/script/tools.js"></script>
<script language="javascript" src="finance/script/rupiah.js"></script>
<script language="javascript" src="finance/script/validasi.js"></script>
<script type="text/javascript" src="finance/script/calendar.js"></script>
<script type="text/javascript" src="finance/script/lang/calendar-en.js"></script>
<script type="text/javascript" src="finance/script/calendar-setup.js"></script>

<script type="text/javascript" src="finance/jsdynamic/jquery.min.js"></script>
<!--<script type="text/javascript" src="../../js/buttonajax.js"></script>-->
<script language="javascript">
function ValidateSubmit() 
{
	
	document.getElementById('issubmit').value = 1;
	document.main.submit();	
	
}

function ValidateSubmit1() 
{
	
	document.getElementById('issubmit').value = 2;
	document.main.submit();
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

<script>

function viewnilai(idpelajaran, departemen, idtingkat, idkelas, nama, idkompetensi, idjeniskompetensi, iddasarpenilaian, idsemester, nis) 
{	
	newWindow('daftarnilai_hasil.php?idpelajaran='+idpelajaran+'&departemen='+departemen+'&idtingkat='+idtingkat+'&idkelas='+idkelas+'&nama='+nama+'&idkompetensi='+idkompetensi+'&idjeniskompetensi='+idjeniskompetensi+'&iddasarpenilaian='+iddasarpenilaian+'&idsemester='+idsemester+'&nis='+nis,'Daftar Nilai','800','500','resizable=1,scrollbars=1,status=0,toolbar=0');
}

</script>

<!-----------------script multi penerimaan--------------->
<script>
	function number_format(number, decimals, dec_point, thousands_sep) {
		number = (number + '')
		.replace(/[^0-9+\-Ee.]/g, '');
	  
	  var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function(n, prec) {
		  var k = Math.pow(10, prec);
		  return '' + (Math.round(n * k) / k)
			.toFixed(prec);
		};
	  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
	  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
		.split('.');
	  if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	  }
	  if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1)
		  .join('0');
	  }
	  return s.join(dec);
	}
	
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
		 
		 c = c.replace(",","");
		 
		 document.getElementById(field).value = c;	
		 
	}
	
	function detailvalue(id){		
		
		var jumlah = 0;
		var rata = 0;
		var persen = 0;
		var persen1 = 0;
		var a = 0;
		
		var n1 = 0;	
		n1=document.getElementById('n1'+id).value; 
		n1 = n1.replace(/[^\d-.]/g,"");
		if(n1 == "") {n1 = 0};
		
		var n2 = 0;	
		n2=document.getElementById('n2'+id).value; 
		n2 = n2.replace(/[^\d-.]/g,"");
		if(n2 == "") {n2 = 0};
		
		var n3 = 0;	
		n3=document.getElementById('n3'+id).value; 
		n3 = n3.replace(/[^\d-.]/g,"");
		if(n3 == "") {n3 = 0};
	
		var n4 = 0;	
		n4=document.getElementById('n4'+id).value; 
		n4 = n4.replace(/[^\d-.]/g,"");
		if(n4 == "") {n4 = 0};
		
		var uts = 0;	
		uts=document.getElementById('uts'+id).value; 
		uts = uts.replace(/[^\d-.]/g,"");
		if(uts == "") {uts = 0};
		
		jumlah = parseFloat(n1) + parseFloat(n2) + parseFloat(n3) + parseFloat(n4) + parseFloat(uts);
		jumlah2 = number_format(jumlah,1,".",",");
		
		$('#jumlah_'+id).html('<input type="text" id="jumlah'+id+'" name="jumlah'+id+'" value="'+ jumlah2 +'" readonly style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;" >');
		
		rata = (jumlah/5);
		rata2 = number_format(rata,1,".",",");
		$('#rata_'+id).html('<input type="text" id="rata'+id+'" name="rata'+id+'" value="'+ rata2 +'" readonly style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;" >');
		
		persen = (rata * 0.75);
		persen2 = number_format(persen,1,".",",");
		$('#persen_'+id).html('<input type="text" id="persen'+id+'" name="persen'+id+'" value="'+ persen2 +'" readonly style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;" >');
		
		
		var uas = 0;	
		uas=document.getElementById('uas'+id).value; 
		uas = uas.replace(/[^\d-.]/g,"");
		if(uas == "") {uas = 0};
		
		persen1 = (uas * 0.25);
		persen3 = number_format(persen1,1,".",",");
		$('#persen1_'+id).html('<input type="text" id="persen1'+id+'" name="persen1'+id+'" value="'+ persen3 +'" readonly style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;" >');
		
		na = parseFloat(persen) + parseFloat(persen1);
		na2 = number_format(na,1,".",",");		
		$('#na_'+id).html('<input type="text" id="na'+id+'" name="na'+id+'" value="'+ na2 +'" readonly style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;" >');
		
		//------------hitung A / E		
		//=IF(N6>=89.5,"4",IF(N6>=78.5,"3",IF(N6>=67.5,"2")))
		
		idjeniskompetensi = document.getElementById('idjeniskompetensi').value;
		if ( idjeniskompetensi == 1) {
			if (na >= 89.5) {
				a = 4;
			}
			if (na >= 78.5 && na < 89.5) {
				a = 3;
			}
			if (na >= 67.5 && na < 78.5) {
				a = 2;
			}
		} else if ( idjeniskompetensi == 2) {
			if (na >= 3.5) {
				a = 4;
			}
			if (na >= 2.5 && na < 3.5 ) {
				a = 3;
			}
			if (na >= 2 && na < 2.5) {
				a = 2;
			}
		}		
		
		$('#a_'+id).html('<input type="text" id="a'+id+'" name="a'+id+'" value="'+ a +'" readonly style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;" >');
		//--------------------/\
		
				
	}
	 
</script>

</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style='background-color:#dfdec9' background="" >

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr height="58">
	<td width="28" background="<?php echo GetThemeDir() ?>bgpop_01.jpg">&nbsp;</td>
    <td width="*" background="<?php echo GetThemeDir() ?>bgpop_02a.jpg">
	<div align="center" style="color:#FFFFFF; font-size:16px; font-weight:bold">
    .: Daftar Nilai :.
    </div>
	</td>
    <td width="28" background="<?php echo GetThemeDir() ?>bgpop_03.jpg">&nbsp;</td>
</tr>


<tr height="150">
	<td width="28" background="<?php echo GetThemeDir() ?>bgpop_04a.jpg">&nbsp;</td>
    <td width="0" style="background-color:#FFFFFF">
    
    <form name="main" method="post" action="" >
	    
	    <input type="hidden" name="issubmit" id="issubmit" value="0" />
	    <input type="hidden" name="iddasarpenilaian" id="iddasarpenilaian" value="<?php echo $iddasarpenilaian ?>" />
		<input type="hidden" name="idtahunajaran" id="idtahunajaran" value="<?php echo $idtahunajaran ?>" />
		<input type="hidden" name="departemen" id="departemen" value="<?php echo $departemen ?>" />
		<input type="hidden" name="idsemester" id="idsemester" value="<?php echo $idsemester ?>" />
		<input type="hidden" name="idkompetensi" id="idkompetensi" value="<?php echo $idkompetensi ?>" />
		<input type="hidden" name="idjeniskompetensi" id="idjeniskompetensi" value="<?php echo $idjeniskompetensi ?>" />
		<input type="hidden" name="idpelajaran" id="idpelajaran" value="<?php echo $idpelajaran ?>" />
		
		
	    <!---------tambah nilai----------->
		<table border="1" align="left" cellspacing="0" cellpadding="5" style="border: 1px solid #ccc" >
			
			<tr style="font-weight: bold; text-align: left;">
				<td>Unit</td>
				<td colspan="1">&nbsp;<?php echo $departemen ?></td>
				
				<td colspan="2">Tahun Ajaran</td>
				<td colspan="12">&nbsp;<?php echo $tahunajaran ?></td>
			</tr>
			
			<tr style="font-weight: bold; text-align: left;">
				<td>Mata Pelajaran</td>
				<td colspan="1">&nbsp;<?php echo $pelajaran ?></td>
				
				<td colspan="2">Kompetensi</td>
				<td colspan="12">&nbsp;<?php echo $kompetensi ?></td>
			</tr>
			
			<tr style="font-weight: bold; text-align: left;">
				<td>Kelas</td>
				<td colspan="1">&nbsp;<?php echo $kelas ?></td>
				
				<td colspan="2">Aspek Penilaian</td>
				<td colspan="12">&nbsp;<?php echo $aspekpenilaian ?></td>
			</tr>
			
			<tr style="font-weight: bold; text-align: center;">
				<td rowspan="2">NIS</td>
				<td rowspan="2">Nama</td>
				<td colspan="14"><?php echo $jeniskompetensi ?></td>
			</tr>
			
			<tr style="font-weight: bold; text-align: center;">
				<?php if($idjeniskompetensi == 1) { ?>
					<td>N1</td>
					<td>N2</td>
					<td>N3</td>
					<td>N4</td>
					<td>UTS</td>
					<td>Jumlah</td>
					<td>Rata-rata</td>
					<td>x 75%</td>
					<td>UAS</td>
					<td>x 25%</td>
					<td>NA</td>
					<td>&nbsp;</td>
					<td>A</td>
					<td>View</td>
				<?php } ?>
				
				<?php if($idjeniskompetensi == 2) { ?>
					<td>T.1</td>
					<td>T.2</td>
					<td>T.3</td>
					<td>T.4</td>
					<td>UTS</td>
					<td>Jumlah</td>
					<td>Rata-rata</td>
					<td>x 75%</td>
					<td>UAS</td>
					<td>x 25%</td>
					<td>NA</td>
					<td>&nbsp;</td>
					<td>E</td>
					<td>View</td>
				<?php } ?>
			</tr>
			
			<?php
				$i = 0;
				$sql=$select_view->list_siswa('', '', $idtingkat, $idkelas, $nama, $all);			
				while ($siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
					
					$nis		=	$siswa_view->nis;
					
					$strget = $select_view->list_daftarnilai($departemen, $idtingkat, $idkelas, $idtahunajaran, $idsemester, $nis, $idkompetensi, $idjeniskompetensi, $iddasarpenilaian, $idpelajaran);
					$siswa_get=$strget->fetch(PDO::FETCH_OBJ);
			?>
				
				<input type="hidden" name="nis<?php echo $i ?>" id="nis<?php echo $i ?>" value="<?php echo $siswa_view->nis ?>" >
				
				<tr>
					<td><?php echo $siswa_view->nis ?></td>
					
					<td><?php echo $siswa_view->nama ?></td>
					
					<td><input type="text" style="width:50px; height: 25px; text-align: center;"  name="n1<?php echo $i ?>" id="n1<?php echo $i ?>" onkeyup="formatangka('n1<?php echo $i ?>'),detailvalue('<?php echo $i ?>')" value="<?php echo $siswa_get->n1 ?>"/></td>
					
					<td><input type="text" style="width:50px; height: 25px; text-align: center;"  name="n2<?php echo $i ?>" id="n2<?php echo $i ?>" onkeyup="formatangka('n2<?php echo $i ?>'),detailvalue('<?php echo $i ?>')" value="<?php echo $siswa_get->n2 ?>"/></td>
					
					<td><input type="text" style="width:50px; height: 25px; text-align: center;"  name="n3<?php echo $i ?>" id="n3<?php echo $i ?>" onkeyup="formatangka('n3<?php echo $i ?>'),detailvalue('<?php echo $i ?>')" value="<?php echo $siswa_get->n3 ?>"/></td>
					
					<td><input type="text" style="width:50px; height: 25px; text-align: center;"  name="n4<?php echo $i ?>" id="n4<?php echo $i ?>" onkeyup="formatangka('n4<?php echo $i ?>'),detailvalue('<?php echo $i ?>')" value="<?php echo $siswa_get->n4 ?>"/></td>
					
					<td><input type="text" style="width:50px; height: 25px; text-align: center;"  name="uts<?php echo $i ?>" id="uts<?php echo $i ?>" onkeyup="formatangka('uts<?php echo $i ?>'),detailvalue('<?php echo $i ?>')" value="<?php echo $siswa_get->uts ?>"/></td>
					
					<td id="jumlah_<?php echo $i ?>" ><input type="text" style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;"  name="jumlah<?php echo $i ?>" id="jumlah<?php echo $i ?>" readonly value="<?php echo $siswa_get->jumlah ?>" /></td>
					
					<td id="rata_<?php echo $i ?>" ><input type="text" style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;"  name="rata<?php echo $i ?>" id="rata<?php echo $i ?>" readonly value="<?php echo $siswa_get->rata ?>"/></td>
					
					<td id="persen_<?php echo $i ?>" ><input type="text" style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;"  name="persen<?php echo $i ?>" id="persen<?php echo $i ?>" readonly value="<?php echo $siswa_get->persen ?>"/></td>
					
					<td><input type="text" style="width:50px; height: 25px; text-align: center;"  name="uas<?php echo $i ?>" id="uas<?php echo $i ?>" onkeyup="formatangka('uas<?php echo $i ?>'),detailvalue('<?php echo $i ?>')" value="<?php echo $siswa_get->uas ?>"/></td>
					
					<td id="persen1_<?php echo $i ?>" ><input type="text" style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;"  name="persen1<?php echo $i ?>" id="persen1<?php echo $i ?>" readonly value="<?php echo $siswa_get->persen1 ?>"/></td>
					
					<td id="na_<?php echo $i ?>" ><input type="text" style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;"  name="na<?php echo $i ?>" id="na<?php echo $i ?>" readonly value="<?php echo $siswa_get->na ?>"/></td>
					
					<td>&nbsp;</td>
					
					<td id="a_<?php echo $i ?>" ><input type="text" style="width:50px; height: 25px; background-color: #bbfaab; text-align: center;"  name="a<?php echo $i ?>" id="a<?php echo $i ?>" readonly value="<?php echo $siswa_get->a ?>"/></td>
					
					<td>
						<a href="#" class="label label-success" onClick="JavaScript:viewnilai('<?php echo $idpelajaran ?>','<?php echo $departemen ?>','<?php echo $idtingkat ?>','<?php echo $idkelas ?>','<?php echo $nama ?>','<?php echo $idkompetensi ?>','<?php echo $idjeniskompetensi ?>','<?php echo $iddasarpenilaian ?>','<?php echo $idsemester ?>','<?php echo $siswa_view->nis ?>')" ><span class="hidden-tablet"> tampilkan nilai</span></a>
					</td>
				</tr>
			<?php
					$i++;
				}
			?>
				
				<input type="hidden" name="jmldata" id="jmldata" value="<?php echo $i ?>" >
				
			<tr>
				<td colspan="16">
					<input type="button" name="Simpan" id="Simpan" class="but" value="Simpan" onclick="ValidateSubmit();" />&nbsp;&nbsp;<input type="button" name="tutup" id="tutup" class="but" value="Tutup" onclick="window.close()" />
					
				</td>
				
			</tr>
		</table>
		<!--------------end ----------->

		
	    
	    </form>
   
<!-- END OF CONTENT //--->
    </td>
    
    <td width="28" background="<?php echo GetThemeDir() ?>bgpop_06a.jpg">&nbsp;</td>
</tr>
<tr height="28">
	<td width="28" background="<?php echo GetThemeDir() ?>bgpop_07.jpg">&nbsp;</td>
    <td width="*" background="<?php echo GetThemeDir() ?>bgpop_08a.jpg">&nbsp;</td>
    <td width="28" background="<?php echo GetThemeDir() ?>bgpop_09.jpg">&nbsp;</td>
</tr>
</table>


</body>
</html>