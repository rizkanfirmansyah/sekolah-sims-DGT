<?php
// menggunakan class phpExcelReader
include "excel_reader2.php";
include("function.php");

// koneksi ke mysql
@mysql_connect("localhost", "root", "");
@mysql_select_db("samson");


function random($number) 
{
	if ($number)
	{
    	for($i=1;$i<=$number;$i++)
		{
       		$nr=rand(0,9);
       		$total=$total.$nr;
       	}
    	return $total;
	}
}


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
	$code = $data->val($i, 1);
	$name = petikreplace($data->val($i, 2));
	$uom = $data->val($i, 4);
	$active = "1";
	
	$uid = "admin";
	$dlu = date("Y-m-d H:i:s");
	$syscode = random(9);
    
	if (!empty($code))	 {
	  $query = "insert into item (code, old_code, name, item_group_id, item_subgroup_id, item_type_code, item_category_id, brand_id, size_id, uom_code_stock, uom_code_sales, uom_code_purchase, minimum_stock, maximum_stock, photo, active, uid, dlu, syscode) values ('$code', '$code', '$name', '$item_group_id', '$item_subgroup_id', '$item_type_code', '$item_category_id', '$brand_id', '$size_id', '$uom', '$uom', '$uom', '$minimum_stock', '$maximum_stock', '$photo', '$active', '$uid', '$dlu', '$syscode')";	   
	  $hasil = mysql_query($query);	  
	  
	} 
	
  if ($hasil) {
  		$sukses++;
  }  else {
  	$gagal++;
  	
  	echo $code . "---" . $name."<br>";
  }
  
}
 
// tampilan status sukses dan gagal
echo "<h3>Proses import data selesai.</h3>";
echo "<p>Jumlah data yang sukses diimport : ".$sukses."<br>";
echo "Jumlah data yang terupdate diimport : ".$gagal."</p>";
 
?>