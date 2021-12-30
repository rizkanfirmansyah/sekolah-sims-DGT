<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";
include("function.php");

// koneksi ke mysql
@mysql_connect("localhost", "root", "");
@mysql_select_db("sekolahtunas_asli");

function petikreplace($string="") {

	$string = str_replace("'","''",$string);
	
	return $string;	
}

// membaca file excel yang diupload
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
	$nis = $data->val($i, 2);
	$nama = petikreplace($data->val($i, 3));
	$nis_lama = $data->val($i, 4);
	
	$kelamin = $data->val($i, 6);
	$idkelas = $data->val($i, 7);
	
	$uid = "admin";
	$dlu = date("Y-m-d H:i:s");
	
	if (!empty($nis))	 {
      
      $sqlcek = "select nis from siswa where nis='$nis_lama' limit 1";
      $hasilcek = mysql_query($sqlcek);
      $datacek = mysql_fetch_object($hasilcek);
      
      //jika nis lama ada
      if($datacek->nis != "" && !empty($datacek->nis)) {
      	 
      	  $query = "update siswa set nis='$nis', nama='$nama', uid='$uid', ts='$dlu' where nis='$nis_lama'";	   
	      $hasil = mysql_query($query);    
	      
      } else {
          $query = "insert into siswa (nis, nama, kelamin, idkelas, agama, uid, ts) values ('$nis', '$nama', '$kelamin', '$idkelas', 'Islam', '$uid', '$dlu')";	   
	      $hasil = mysql_query($query);
          
      }
	  //echo $query."<br>"; 	  
	  
	} 
	
  if ($hasil) {
  		$sukses++;
  }  else {
  	$gagal++;
  	
      echo $code . "---" . $nis."<br>";
  	    echo $code . "---" . $nama."<br>";
          echo $code . "---" . $idkelas."<br>";
  }
  
}
 
// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang terupdate diimport : ".$gagal."</p>";
 
?>