<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

//include '../app/class/class.select.php';
//$select=new select;

$pilih = $_POST["button"];
switch ($pilih){
	case "getkelompok":
		$idproses = $_POST["idproses"];	
			
?>		
		<option value=""></option>
		<?php select_kelompokpsb($idproses,""); ?>
		
<?php
		
		break;
	
	case "getjurusan":
		$idtingkat = $_POST["idtingkat"];	
				
		if($idtingkat == 26 || $idtingkat == 27 || $idtingkat == 28) {
?>		
			<td>Program</td>
			<td>&nbsp;&nbsp;</td>
			<td>
				<select name="idjurusan" id="idjurusan" style="width:auto; height:27px; " >
					<option value=""></option>
					<?php select_program($registrasi->idjurusan); ?>
				</select>
			</td>
			
			<td colspan="4">&nbsp;&nbsp;</td>
		
<?php
		} else {
?>
			
			<td>Program</td>
			<td>&nbsp;&nbsp;</td>
			<td>
				<select name="idjurusan" id="idjurusan" disabled="" style="width:auto; height:27px; " >
					<option value=""></option>
					<?php select_program($registrasi->idjurusan); ?>
				</select>
			</td>
			
			<td colspan="4">&nbsp;&nbsp;</td>

<?php
		}			
		
		break;	
		
	case "getminat":
		$idjurusan = $_POST["idjurusan"];	
			
?>		
		
			<td>Mata Pelajaran Lintas minat 1</td>
			<td>&nbsp;&nbsp;</td>
			<td>
				<select name="idminat" id="idminat" style="width:auto; height:27px; " />
					<option value=""></option>
					<?php 
						if($idjurusan == '1') {
							select_minatips($registrasi->idminat); 	
						}
						if($idjurusan == '2') {
							select_minatipa($registrasi->idminat); 	
						}
					?>
				</select>
			</td>
			
			<td>Mata Pelajaran Lintas minat 2</td>
			<td>&nbsp;&nbsp;</td>
			<td>
				<select name="idminat1" id="idminat1" style="width:auto; height:27px; " />
					<option value=""></option>
					<?php 
						if($idjurusan == '1') {
							select_minatips($registrasi->idminat1); 	
						}
						if($idjurusan == '2') {
							select_minatipa($registrasi->idminat1); 	
						}
					?>
				</select>
			</td>
		
<?php
		
		break;
		
		
	case "getdepartemen":
		$departemen = $_POST["departemen"];	
		
		if($departemen == "SMP" || $departemen == "SMA" ) {	
			$readonly = "";
			$disabled = "";
		} else {
			$readonly = "readonly";
			$disabled = "disabled";
		}
?>		
		
			<table width="100%" border="0">
				<tr>
					<td width="19%">NOMOR SERI IJAZAH</td>
					<td>&nbsp;&nbsp;</td>
					<td colspan="7">
						<input type="text" name="noijazah" id="noijazah" <?php echo $readonly; ?> style="width:200px; height:16px; " value="<?php echo $registrasi->noijazah ?>">
						Tahun
						<select name="tahunijazah" id="tahunijazah" <?php echo $disabled; ?> style="width:auto; height:27px; " />
							<option value=""></option>
							<?php tahun_select($registrasi->tahunijazah); ?>
						</select>
								
					</td>
																
				</tr>
				<tr>
					<td>NOMOR SERI SKHUN</td>
					<td>&nbsp;&nbsp;</td>
					<td colspan="7">
						<input type="text" name="skhun" id="skhun" <?php echo $readonly; ?> style="width:200px; height:16px; " value="<?php echo $registrasi->skhun ?>">
						Tahun
						<select name="tahunskhun" id="tahunskhun" <?php echo $disabled; ?> style="width:auto; height:27px; " />
							<option value=""></option>
							<?php tahun_select($registrasi->tahunskhun); ?>
						</select>	
					</td>
					
					
				</tr>
				<tr>
					<td>No Ujian Nasional</td>
					<td>&nbsp;&nbsp;</td>
					<td><input type="text" name="noujian" id="noujian" <?php echo $readonly; ?> style="width:200px; height:16px; " value="<?php echo $registrasi->noujian ?>"></td>
					
					<td colspan="4"><i style="font-size: 9px">*) Diisikan hanya untuk siswa tingkat 10s.d 12</i></td>											
					
				</tr>
			</table>
<?php
		
		
		break;
		
			
	default:
	
}
?>