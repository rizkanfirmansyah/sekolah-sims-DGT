<?php
include_once ("../app/include/sambung.php");

$pin = $_POST['pin'];

$dbpdo = DB::create();
$sqlstr = "select replid, pinortu, namaayah, namaibu, alamatsiswa, hpsiswa from siswa where pinortu='$pin' limit 1";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
$rows = $sql->rowCount();
$datasiswa = $sql->fetch(PDO::FETCH_OBJ);

echo  'Nama Ayah : ' . $datasiswa->namaayah . ', Nama Ibu : ' . $datasiswa->namaibu . ', Alamat : ' . $datasiswa->alamatsiswa . ', Telepon : ' . $datasiswa->hpsiswa;

?>