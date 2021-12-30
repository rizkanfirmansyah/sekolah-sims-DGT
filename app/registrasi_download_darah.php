<?php
   	include("include/sambung.php");
	
	$dbpdo = DB::create();
	
    // membaca id file dari link
    $replid = $_REQUEST['replid']; //$segmen3; //
 	
    // membaca informasi file dari tabel berdasarkan id nya
    $query  = "select file_darah from calonsiswa where replid = '$replid'";
    $hasil  = $dbpdo->query($query);
    $data = $hasil->fetch(PDO::FETCH_OBJ);

	 // header yang menunjukkan jenis file yang akan didownload
	$exp = explode(".",$data->file_darah);
	$tipe = $exp[1]; 
    header("Content-type: $tipe");
 
    // header yang menunjukkan nama file yang akan didownload
    $file = $data->file_darah;
    header("Content-Disposition: attachment; filename=".$file);
 
    // header yang menunjukkan ukuran file yang akan didownload
    //$size = filesize($data->upload_file);
	header("Content-length:". "");
    
    //header("Content-Disposition: $file");
   	// proses membaca isi file yang akan didownload dari folder 'data'
   	$fp  = fopen("file_darah_calon/".$data->file_darah, 'r');
   	$content = fread($fp, filesize("file_darah_calon/".$data->file_darah));
   	fclose($fp);
 	
   	// menampilkan isi file yang akan didownload
   	echo $content;
 
   	exit;
	
?>