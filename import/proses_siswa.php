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
	$nis = $data->val($i, 2);
	
	$nama = petikreplace($data->val($i, 3));
	$panggilan = petikreplace($data->val($i, 4));
	$kelamin = $data->val($i, 5);	
	$tmplahir = petikreplace($data->val($i, 6));
	$tgllahir = date("Y-m-d", strtotime($data->val($i, 7)));
	$namaayah = petikreplace($data->val($i, 8));
	$namaibu = petikreplace($data->val($i, 9));
	$pekerjaanayah_lain = petikreplace($data->val($i, 10));
	$pekerjaanibu_lain = petikreplace($data->val($i, 11));
	$pendidikanayah = $data->val($i, 13);
	$pendidikanibu = $data->val($i, 15);
	$alamatsiswa = petikreplace($data->val($i, 16));
	$hpsiswa = $data->val($i, 17);
	
	/*asal sekolah*/
	$asalsekolah = petikreplace($data->val($i, 18));
	$qasalsekolah = mysql_query("select replid, sekolah from asalsekolah where sekolah='$asalsekolah'");
	$rowsasalsek = mysql_num_rows($qasalsekolah);
	$dataasalsek = mysql_fetch_object($qasalsekolah);
	if($rowsasalsek == 0) {
		$dlu = date("Y-m-d H:i:s");
		$qins = mysql_query("insert into asalsekolah(sekolah, ts) values('$asalsekolah', '$dlu')");
		
		$qlast = mysql_query("select last_insert_id() replid");
		$dataasalsek = mysql_fetch_object($qlast);
		$asalsekolah = $dataasalsek->replid;
	} else {
		$asalsekolah = $dataasalsek->replid;
	}
		
	$anakke = $data->val($i, 19);
	$jsaudara = $data->val($i, 20);
	$aktif = 1;
	
	/*get kelas*/
	$idkelas = $data->val($i, 21);
	/*$qkelas = mysql_query("select replid from kelas where kelas='$idkelas'");
	$datakelas = mysql_fetch_object($qkelas);
	$idkelas = $datakelas->replid;*/
	
	$tahunmasuk = $data->val($i, 22);
	$idangkatan = $data->val($i, 23);
	$idangkatan1 = $data->val($i, 24);
	$agama = $data->val($i, 25);
	
	$nisn = $data->val($i, 26);
	
	$uid = "admin";
	$dlu = date("Y-m-d H:i:s");
	
	if (!empty($nis))	 {
      
      $sqlcek = "select nis from siswa where nis='$nis' limit 1";
      $hasilcek = mysql_query($sqlcek);
      $datacek = mysql_fetch_object($hasilcek);
      
      if($datacek->nis == "" && empty($datacek->nis)) {
          $query = "insert into siswa (nis, nisn, nama, panggilan, kelamin, tmplahir, tgllahir, namaayah, namaibu, pekerjaanayah_lain, pekerjaanibu_lain, pendidikanayah, pendidikanibu, alamatsiswa, hpsiswa, asalsekolah_id, anakke, jsaudara, aktif, idkelas, tahunmasuk, idangkatan, idangkatan1, agama, uid, ts) values ('$nis', '$nisn', '$nama', '$panggilan', '$kelamin', '$tmplahir', '$tgllahir', '$namaayah', '$namaibu', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$pendidikanayah', '$pendidikanibu', '$alamatsiswa', '$hpsiswa', '$asalsekolah', '$anakke', '$jsaudara', '$aktif', '$idkelas', '$tahunmasuk', '$idangkatan', '$idangkatan1', '$agama', '$uid', '$dlu')";	   
          echo $query."<br>";
	      //$hasil = mysql_query($query);
      } /*else {
          if($nis != "") {
              $query = "update siswa set nisn='$nisn', nama='$nama', panggilan='$panggilan', kelamin='$kelamin', tmplahir='$tmplahir', tgllahir='$tgllahir', namaayah='$namaayah', namaibu='$namaibu', pekerjaanayah_lain='$pekerjaanayah_lain', pekerjaanibu_lain='$pekerjaanibu_lain', pendidikanayah='$pendidikanayah', pendidikanibu='$pendidikanibu', alamatsiswa='$alamatsiswa', hpsiswa='$hpsiswa', asalsekolah_id='$asalsekolah', anakke='$anakke', jsaudara='$jsaudara', idkelas='$idkelas', tahunmasuk='$tahunmasuk', idangkatan='$idangkatan', idangkatan1='$idangkatan1', agama='$agama' where nis='$nis'";	   
	          $hasil = mysql_query($query);    
          }
          
      }*/
	  	  
	  
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