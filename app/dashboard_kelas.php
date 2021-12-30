<?php

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");

$dbpdo = DB::create();

$data = '';
$i=0;
$sqlstr = "select distinct replid id, tingkat name from tingkat where aktif=1 order by urutan"; 
$sql1=$dbpdo->prepare($sqlstr);
$sql1->execute();
while ($row_tingkat=$sql1->fetch(PDO::FETCH_OBJ)) {
	$sqlstr2 = "select count(a.nis) count_siswa, b.idtingkat from siswa a inner join kelas b on a.idkelas=b.replid group by b.idtingkat having b.idtingkat='$row_tingkat->id'";
	$sql2=$dbpdo->prepare($sqlstr2);
	$sql2->execute();
	$row_jml=$sql2->fetch(PDO::FETCH_OBJ);
	if ($row_jml->count_siswa > 0) {
		$korte_count = $row_jml->count_siswa;
	} else {
		$korte_count = 0;
	}
?>
		Tingkat - <?php echo $row_tingkat->name ?>
		<div class="progress progress-large progress-blue">			
			<div class="bar" style='width:<?php echo $korte_count ?>%'><?php echo $korte_count ?></div>
		</div>
		
<?php
	
}
	
?>

<!--<div class="span6">
	<div class="progress progress-mini progress-inverse">
		<div class="bar" style='width:15%'>15%</div>
	</div>
	<div class="progress progress-darkgrey">
		<div class="bar" style='width:30%'>30%</div>
	</div>
	<div class="progress progress-large progress-blue">
		<div class="bar" style='width:45%'>45%</div>
	</div>
	<div class="progress progress-mega progress-lightgreen">
		<div class="bar" style='width:60%'>60%</div>
	</div>
</div>-->