<?php
// menggunakan class phpExcelReader
include("excel_reader2.php");
//include("function.php");

//offline
define("HOST", "localhost");
define("PORT", 3306);
define("USER", "root");
define("PASS", "");
define("DB", "sekolahtunas");

//online
/*define("HOST", "localhost");
define("PORT", 3306);
define("USER", "u5820577_sias");
define("PASS", "1qaz2wsx");
define("DB", "u5820577_sias");*/


$host=HOST; 
$userdb=USER;
$passdb=PASS;
$mydb=DB;
$condb=@mysql_connect($host,$userdb,$passdb);
@mysql_select_db($mydb,$condb);


function petikreplace($string="") {

	$string = str_replace("'","''",$string);
	
	return $string;	
}

function numberreplace($string="0") {

	$string = str_replace(",","",(empty($string)) ? 0 : $string);
	
	return $string;	
}

// membaca file excel yang diupload
//$data = new Spreadsheet_Excel_Reader($file_data);
$data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);

// membaca jumlah baris dari data excel
$baris = $data->rowcount($sheet_index=0);

// nilai awal counter untuk jumlah data yang sukses dan yang gagal diimport
$sukses = 0;
$gagal = 0;
 
// import data excel mulai baris ke-2 (karena baris pertama adalah nama kolom)
$x = 4;
for ($i=2; $i<=$baris; $i++)
{    
	$x++;
	$nis = petikreplace($data->val($i, 2));
		
	$uid = "admin";
	$dlu = date("Y-m-d H:i:s");
	
	if (!empty($nis))	 {
      
      $y++;
      
      $sqlcek = "select c.departemen from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where nis='$nis' limit 1";
      $hasilcek = mysql_query($sqlcek);
      $datacek = mysql_fetch_object($hasilcek);
      $departemen = $datacek->departemen;
      
      $sqltb = "select replid from tahunbuku where departemen='$departemen' order by tanggalmulai desc limit 1";
      $query = mysql_query($sqltb);
      $datatb = mysql_fetch_object($query);
      $tahunbuku = $datatb->replid;
      
      
      
      //SPP
	  $nama_penerimaan = $data->val(1, 4); //SPP
	  $besar = numberreplace($data->val($i, 4));
	  $cicilan = 0;
	  $keterangan = "";
	  $potongan = 0;
		
      $sqlcek2 = "select replid from datapenerimaan where trim(nama)='$nama_penerimaan' and departemen='$departemen' limit 1";
      $hasilcek2 = mysql_query($sqlcek2);
      $datacek2 = mysql_fetch_object($hasilcek2);
      $idpenerimaan = $datacek2->replid;
            
      if( ($nis != "") && ($idpenerimaan != "") ) {
	      	$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
	      	//where a.info2='5' and a.nis = '171801005' and a.idpenerimaan = '27'
	      	//echo $strcek."<br>";
			$sqlcek=mysql_query($strcek);
			$datacheck = mysql_num_rows($sqlcek);
			
			if($datacheck == 0 && $besar > 0) {
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$dlu', '$potongan')";
				$hasil=mysql_query($sqlstr);
			} else {
				$sqlstr = "update besarjtt set besar='$besar' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku'";
				$hasil=mysql_query($sqlstr);
			}
			
      } 
      
      
      
      //Makan
	  $nama_penerimaan = $data->val(1, 5); //Makan
	  $besar = numberreplace($data->val($i, 5));
	  $cicilan = 0;
	  $keterangan = "";
	  $potongan = 0;
		
      $sqlcek2 = "select replid from datapenerimaan where trim(nama)='$nama_penerimaan' and departemen='$departemen' limit 1";
      $hasilcek2 = mysql_query($sqlcek2);
      $datacek2 = mysql_fetch_object($hasilcek2);
      $idpenerimaan = $datacek2->replid;
            
      if( ($nis != "") && ($idpenerimaan != "") ) {
	      	$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
	      	//where a.info2='5' and a.nis = '171801005' and a.idpenerimaan = '27'
	      	//echo $nis . ' : ' . $besar."<br>";
			$sqlcek=mysql_query($strcek);
			$datacheck = mysql_num_rows($sqlcek);
			if($datacheck == 0 && $besar > 0) {
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$dlu', '$potongan')";
				$hasil=mysql_query($sqlstr);
			} else {
				$sqlstr = "update besarjtt set besar='$besar' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku'";
				$hasil=mysql_query($sqlstr);
			}
			
      } 
      
      
      //Snack
	  $nama_penerimaan = $data->val(1, 6); //Snack
	  $besar = numberreplace($data->val($i, 6));
	  $cicilan = 0;
	  $keterangan = "";
	  $potongan = 0;
		
      $sqlcek2 = "select replid from datapenerimaan where trim(nama)='$nama_penerimaan' and departemen='$departemen' limit 1";
      $hasilcek2 = mysql_query($sqlcek2);
      $datacek2 = mysql_fetch_object($hasilcek2);
      $idpenerimaan = $datacek2->replid;
            
      if( ($nis != "") && ($idpenerimaan != "") ) {
	      	$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
	      	//where a.info2='5' and a.nis = '171801005' and a.idpenerimaan = '27'
	      	//echo $nis . ' : ' . $besar."<br>";
			$sqlcek=mysql_query($strcek);
			$datacheck = mysql_num_rows($sqlcek);
			if($datacheck == 0 && $besar > 0) {
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$dlu', '$potongan')";
				$hasil=mysql_query($sqlstr);
			} else {
				$sqlstr = "update besarjtt set besar='$besar' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku'";
				$hasil=mysql_query($sqlstr);
			}
			
      } 
      
      //Lain-lain (7)
      
      
      //Jemputan
	  $nama_penerimaan = $data->val(1, 8); //Jemputan
	  $besar = numberreplace($data->val($i, 8));
	  $cicilan = 0;
	  $keterangan = "";
	  $potongan = 0;
		
      $sqlcek2 = "select replid from datapenerimaan where trim(nama)='$nama_penerimaan' and departemen='$departemen' limit 1";
      $hasilcek2 = mysql_query($sqlcek2);
      $datacek2 = mysql_fetch_object($hasilcek2);
      $idpenerimaan = $datacek2->replid;
            
      if( ($nis != "") && ($idpenerimaan != "") ) {
	      	$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
	      	//where a.info2='5' and a.nis = '171801005' and a.idpenerimaan = '27'
	      	//echo $nis . ' : ' . $besar."<br>";
			$sqlcek=mysql_query($strcek);
			$datacheck = mysql_num_rows($sqlcek);
			if($datacheck == 0 && $besar > 0) {
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$dlu', '$potongan')";
				$hasil=mysql_query($sqlstr);
			} else {
				$sqlstr = "update besarjtt set besar='$besar' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku'";
				$hasil=mysql_query($sqlstr);
			}
			
      } 
      
      
      //Program
	  $nama_penerimaan = $data->val(1, 9); //Program
	  $besar = numberreplace($data->val($i, 9));
	  $cicilan = 0;
	  $keterangan = "";
	  $potongan = 0;
		
      $sqlcek2 = "select replid from datapenerimaan where trim(nama)='$nama_penerimaan' and departemen='$departemen' limit 1";
      $hasilcek2 = mysql_query($sqlcek2);
      $datacek2 = mysql_fetch_object($hasilcek2);
      $idpenerimaan = $datacek2->replid;
            
      if( ($nis != "") && ($idpenerimaan != "") ) {
	      	$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
	      	//where a.info2='5' and a.nis = '171801005' and a.idpenerimaan = '27'
	      	//echo $nis . ' : ' . $besar."<br>";
			$sqlcek=mysql_query($strcek);
			$datacheck = mysql_num_rows($sqlcek);
			if($datacheck == 0 && $besar > 0) {
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$dlu', '$potongan')";
				$hasil=mysql_query($sqlstr);
			} else {
				$sqlstr = "update besarjtt set besar='$besar' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku'";
				$hasil=mysql_query($sqlstr);
			}
			
      } 
      
      
      //Uang Masuk
	  $nama_penerimaan = $data->val(1, 10); //Uang Masuk
	  $besar = numberreplace($data->val($i, 10));
	  $cicilan = 0;
	  $keterangan = "";
	  $potongan = 0;
		
      $sqlcek2 = "select replid from datapenerimaan where trim(nama)='$nama_penerimaan' and departemen='$departemen' limit 1";
      $hasilcek2 = mysql_query($sqlcek2);
      $datacek2 = mysql_fetch_object($hasilcek2);
      $idpenerimaan = $datacek2->replid;
            
      if( ($nis != "") && ($idpenerimaan != "") ) {
	      	$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
	      	//where a.info2='5' and a.nis = '171801005' and a.idpenerimaan = '27'
	      	//echo $nis . ' : ' . $besar."<br>";
			$sqlcek=mysql_query($strcek);
			$datacheck = mysql_num_rows($sqlcek);
			if($datacheck == 0 && $besar > 0) {
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$dlu', '$potongan')";
				$hasil=mysql_query($sqlstr);
			} else {
				$sqlstr = "update besarjtt set besar='$besar' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku'";
				$hasil=mysql_query($sqlstr);
			}
			
      } 
      
      
      
      //Ekskul
	  $nama_penerimaan = $data->val(1, 11); //Ekskul
	  $besar = numberreplace($data->val($i, 11));
	  $cicilan = 0;
	  $keterangan = "";
	  $potongan = 0;
		
      $sqlcek2 = "select replid from datapenerimaan where trim(nama)='$nama_penerimaan' and departemen='$departemen' limit 1";
      $hasilcek2 = mysql_query($sqlcek2);
      $datacek2 = mysql_fetch_object($hasilcek2);
      $idpenerimaan = $datacek2->replid;
            
      if( ($nis != "") && ($idpenerimaan != "") ) {
	      	$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
	      	//where a.info2='5' and a.nis = '171801005' and a.idpenerimaan = '27'
	      	//echo $nis . ' : ' . $besar."<br>";
			$sqlcek=mysql_query($strcek);
			$datacheck = mysql_num_rows($sqlcek);
			if($datacheck == 0 && $besar > 0) {
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$dlu', '$potongan')";
				$hasil=mysql_query($sqlstr);
			} else {
				$sqlstr = "update besarjtt set besar='$besar' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku'";
				$hasil=mysql_query($sqlstr);
			}
			
      } 
      
      
      //Kegiatan
	  $nama_penerimaan = $data->val(1, 12); //Kegiatan
	  $besar = numberreplace($data->val($i, 12));
	  $cicilan = 0;
	  $keterangan = "";
	  $potongan = 0;
		
      $sqlcek2 = "select replid from datapenerimaan where trim(nama)='$nama_penerimaan' and departemen='$departemen' limit 1";
      $hasilcek2 = mysql_query($sqlcek2);
      $datacek2 = mysql_fetch_object($hasilcek2);
      $idpenerimaan = $datacek2->replid;
            
      if( ($nis != "") && ($idpenerimaan != "") ) {
	      	$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
	      	//where a.info2='5' and a.nis = '171801005' and a.idpenerimaan = '27'
	      	//echo $nis . ' : ' . $besar."<br>";
			$sqlcek=mysql_query($strcek);
			$datacheck = mysql_num_rows($sqlcek);
			if($datacheck == 0 && $besar > 0) {
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$dlu', '$potongan')";
				$hasil=mysql_query($sqlstr);
			} else {
				$sqlstr = "update besarjtt set besar='$besar' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku'";
				$hasil=mysql_query($sqlstr);
			}
			
      } 
      
      
      //Seragam
	  $nama_penerimaan = $data->val(1, 13); //Seragam
	  $besar = numberreplace($data->val($i, 13));
	  $cicilan = 0;
	  $keterangan = "";
	  $potongan = 0;
		
      $sqlcek2 = "select replid from datapenerimaan where trim(nama)='$nama_penerimaan' and departemen='$departemen' limit 1";
      $hasilcek2 = mysql_query($sqlcek2);
      $datacek2 = mysql_fetch_object($hasilcek2);
      $idpenerimaan = $datacek2->replid;
            
      if( ($nis != "") && ($idpenerimaan != "") ) {
	      	$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
	      	//where a.info2='5' and a.nis = '171801005' and a.idpenerimaan = '27'
	      	//echo $nis . ' : ' . $besar."<br>";
			$sqlcek=mysql_query($strcek);
			$datacheck = mysql_num_rows($sqlcek);
			if($datacheck == 0 && $besar > 0) {
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$dlu', '$potongan')";
				$hasil=mysql_query($sqlstr);
			} else {
				$sqlstr = "update besarjtt set besar='$besar' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku'";
				$hasil=mysql_query($sqlstr);
			}
			
      } 
      
      
      
      //Kegiatan Semester 2 2017-2018
	  $nama_penerimaan = $data->val(1, 14); //Kegiatan Semester 2 Thn 2017-2018
	  $besar = numberreplace($data->val($i, 14));
	  $cicilan = 0;
	  $keterangan = "";
	  $potongan = 0;
		
      $sqlcek2 = "select replid from datapenerimaan where trim(nama)='$nama_penerimaan' and departemen='$departemen' limit 1";
      $hasilcek2 = mysql_query($sqlcek2);
      $datacek2 = mysql_fetch_object($hasilcek2);
      $idpenerimaan = $datacek2->replid;
            
      if( ($nis != "") && ($idpenerimaan != "") ) {
	      	$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
	      	//where a.info2='5' and a.nis = '171801005' and a.idpenerimaan = '27'
	      	//echo $nis . ' : ' . $besar."<br>";
			$sqlcek=mysql_query($strcek);
			$datacheck = mysql_num_rows($sqlcek);
			if($datacheck == 0 && $besar > 0) {
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$dlu', '$potongan')";
				$hasil=mysql_query($sqlstr);
			} else {
				$sqlstr = "update besarjtt set besar='$besar' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku'";
				$hasil=mysql_query($sqlstr);
			}
			
      } 
      
      
      
	  	  
	  
	} 
	
  if ($hasil) {
  		$sukses++;
  }  else {
  	$gagal++;
  	
  }
  
}
 
// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang terupdate diimport : ".$gagal."</p>";
 
?>