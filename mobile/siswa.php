<?php
header('Content-type: application/json');

include_once ("../app/include/sambung.php");

$dbpdo = DB::create();

/*
$user = $_POST['id'];
$sqlusr = "select a.kode_desa from usr a where a.usrid='$user' ";
$resultusr = mysql_query($sqlusr);
$datausr = mysql_fetch_object($resultusr);
$kode_desa = $datausr->kode_desa;
*/

$sqlstr = "select nis, nama from siswa limit 5";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();


//$result = @mysql_query($sql) or die ("Query error: " . @mysql_error());
//fetch dalam bentuk array
$records = array();

$response = array();
$response["datasiswa"] = array();
while($row = $siswa_data=$sql->fetch(PDO::FETCH_OBJ) ) {
	//$records[] = $row;
    
    $pl = array();
    $pl["nis"] = $row->nis;
    $pl["nama"] = $row->nama;
    array_push($response["datasiswa"], $pl);
} 
//menuliskannya dalam bentuk json menggunakan fungsi json_encode
//echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';

//echo $_GET['jsoncallback'] . '' . json_encode($records) . '';

//$data = json_encode($records);
//echo $data;

echo json_encode($response);

?>