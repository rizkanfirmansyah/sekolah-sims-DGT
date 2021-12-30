<?php
include_once ("../app/include/sambung.php");

$pin = $_POST['pin'];

$dbpdo = DB::create();
$sqlstr = "select replid, kode, nama from pelajaran order by nama";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$rows = $sql->rowCount();


$pelajaran = "";
while ($datasiswa = $sql->fetch(PDO::FETCH_OBJ)) {
    
    if($pelajaran == "") {
        $pelajaran = $datasiswa->nama;    
    } else {
        $pelajaran = $pelajaran . "," . $datasiswa->nama;
    }
    
}

$bulan = "Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember";

echo  $pelajaran . "-" . $bulan;

?>