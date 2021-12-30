<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";
include("function.php");

// koneksi ke mysql
@mysql_connect("localhost", "root", "");
@mysql_select_db("sekolahtunas");

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
	$nis 			= $data->val($i, 4);
	$virtualaccount = $data->val($i, 1);
	
	if (!empty($nis))	 {
      
      $sqlcek = "select nis, virtualaccount from siswa_virtualaccount where nis='$nis' and virtualaccount='$virtualaccount' limit 1";
      $hasilcek = mysql_query($sqlcek);
      $datacek = mysql_fetch_object($hasilcek);
      
      if(empty($datacek->nis)) {
          $query = "insert into siswa_virtualaccount (nis, virtualaccount) values ('$nis', '$virtualaccount')";	   
	      $hasil = mysql_query($query);
      } else {
          if($nis != "") {
              $query = "update siswa_virtualaccount set virtualaccount='$virtualaccount' where nis='$nis'";	   
	          $hasil = mysql_query($query);    
          }
          
      }
	  	  
	  
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