<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";
include("function.php");

// koneksi ke mysql
@mysql_connect("localhost", "root", "");
@mysql_select_db("sekolahtunas3");

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
	$nama = petikreplace($data->val($i, 3));
	
	$uid = "admin";
	$dlu = date("Y-m-d H:i:s");
	
	if (!empty($nama))	 {
      
      $y++;
      
      $sqlcek = "select nis from siswa where trim(nama)='$nama' limit 1";
      $hasilcek = mysql_query($sqlcek);
      $datacek = mysql_fetch_object($hasilcek);
      $nis = $datacek->nis;
      
      echo $y . " : " . $nis . "=" . $nama . "<br>";
      //echo $nis."<br>";
      
      $sqlcek = "select replid from datapenerimaan where trim(nama)='$nama_penerimaan' and departemen='$departemen' limit 1";
      $hasilcek = mysql_query($sqlcek);
      $datacek = mysql_fetch_object($hasilcek);
      $idpenerimaan = $datacek->replid;
      
      $tahunbuku = "6"; //SD
      
      /*if($nis != "" && $idpenerimaan != "") {
          	$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
			$sqlcek=mysql_query($strcek);
			$datacheck = mysql_num_rows($sqlcek);
			if($datacheck == 0) {
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$ts', '$potongan')";
				$sql=mysql_query($sqlstr);
			}
			
			
      } */
	  	  
	  
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