<?php
@session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

include_once ("../app/include/sambung.php");
include_once ("../app/include/functions.php");
include_once ("../app/include/inword.php");

include_once ("../app/class/class.select.php");

?>

<script type="text/javascript">
	function excel_export()
	{
		document.location.href = 'import_siswa_csv.php';
	}
</script>

<!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal" role="form" action="" method="post" name="download" id="download" enctype="multipart/form-data" >
	<div class="form-group">
		<div class="col-sm-3">			
			<a href="JavaScript:excel_export()" style="font-size: 14px">
				Download Format Data Siswa
			</a>
		</div>
	</div>
</form>

<hr>

<!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal" role="form" action="" method="post" name="daftarnilai_input" id="daftarnilai_input" enctype="multipart/form-data" >
	<div class="form-group">
		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Upload File</label>
		<div class="col-sm-3">
			<input type="file" name="file" id="file" accept=".csv">
		</div>
	</div>
	<br>
	<div class="form-group">
		<div class="col-sm-3">
			<input type="submit" name="submit" class='btn btn-primary' value="Upload" >
		</div>
	</div>
</form>

<?php
if ($_POST["submit"]) {

	if ($_POST["submit"] == "Upload") {

		$select 	= new select;

		$dbpdo = DB::create();

		$fileName 	= $_FILES["file"]["tmp_name"];

		if ($_FILES["file"]["size"] > 0) {

			//$file = fopen($fileName, "r");

			//cek delimiter (, or ;)
			$filecek = fopen($fileName, "r");
			$cekcolumn1 = fgetcsv($filecek, 10000, ";");
			$datacol = $cekcolumn1[0];
			//----------------------

			if (preg_match("/,/",$datacol) == 0) {
				$file = fopen($fileName, "r");
				$column = fgetcsv($file, 10000, ";");
			}
			//echo $datacol;
			if (preg_match("/,/",$datacol) == 1) {
				$file = fopen($fileName, "r");
				$column = fgetcsv($file, 10000, ",");
			}

			$jmlnilai = 0;
			$x = 0;
			$insert = 0;
			$update = 0;

			if (preg_match("/,/",$datacol) == 0) {
				while (($column = fgetcsv($file, 20000, ";")) !== FALSE) {

					if ($x > 0) {

						$nis					=	$column[1];
						$nisn				=	$column[2];
						$nik					=	$column[3];
						$nama				=	petikreplace($column[4]);
						$panggilan		=	petikreplace($column[5]);
						$kelamin			=	$column[6];
						$tmplahir			=	$column[7];
						$tgllahir			=	$column[8];
						$agama			=	$column[9];
						$warga				=	$column[10];
						$anakke			=	$column[11];
						$jsaudara			=	$column[12];
						$alamatsiswa	=	petikreplace($column[13]);
						$rt_siswa			=	$column[14];
						$rw_siswa		=	$column[15];
						$telponsiswa	=	$column[16];
						$hpsiswa			=	$column[17];
						$no_akte_lahir	=	$column[18];
						$nik_ayah		=	$column[19];
						$namaayah		=	petikreplace($column[20]);
						$nik_ibu			=	$column[21];
						$namaibu			=	petikreplace($column[22]);
						$idangkatan		=	$column[23];
						$tahunmasuk	=	$column[24];
						$idangkatan1	=	$column[25];
						$idkelas			=	$column[26];

						$alumni		= 0;
						$aktif			=	1;
						$uid				=	'import';
						$dlu				=	date("Y-m-d H:i:s");

						if ($nis != "") {

							$sqlstr = "select replid from siswa where nis='$nis'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							$rowsdata = $sql->rowCount();

							if ($rowsdata == 0) {

								$asalsekolah_id			=	0;
								$tglijazah						=	'0000-00-00';
								$noijazah						=	'';
								$tglskhun						=	'0000-00-00';
								$skhun							=	'';
								$noujian						=	'';
								$nisnasal						=	'';
								$tglmasuk						=	'0000-00-00';
								$idjurusan						=	0;
								$idminat							=	0;
								$idminat1						=	0;
								$suku							=	'';
								$status							=	'';
								$kondisi						=	'';
								$jtiri								=	0;
								$jangkat						=	0;
								$yatim							=	0;
								$bahasa						=	'';
								$berat							=	0;
								$tinggi							=	0;
								$darah							=	0;
								$file_darah					=	'';
								$kelainan						=	'';
								$foto							=	'';
								$foto_file						=	'';
								$desa_kode					=	'';
								$kecamatan_kode		=	'';
								$kota_kode					=	'';
								$provinsi_kode			=	'';
								$dusun							=	'';
								$desa							=	'';
								$kecamatan					=	'';
								$kodepossiswa			=	'';
								$emailsiswa					=	'';
								$kps								=	0;
								$nokps							=	'';
								$kip								=	0;
								$nokip							=	'';
								$namakip						=	'';
								$nokks							=	'';
								$kesehatan					=	'';
								$asalsekolah				=	'';
								$kota_asalsekolah		=	'';
								$ketsekolah					=	'';
								$jenistinggal				=	'';
								$transportasi_kode		=	'';
								$transportasi_lain  		=	'';
								$tmplahirayah				=	'';
								$tgllahirayah				=	'0000-00-00';
								$wnayah						=	'';
								$tempat_bekerja_ayah=	'';
								$tmplahiribu					=	'';
								$tgllahiribu					=	'0000-00-00';
								$wnibu							=	'';
								$almayah						=	0;
								$almibu						=	0;
								$tempat_bekerja_ibu	=	'';
								$pendidikanayah			=	'';
								$pendidikanibu			=	'';
								$pekerjaanayah			=	'';
								$pekerjaanayah_lain	=	'';
								$pekerjaanibu				=	'';
								$pekerjaanibu_lain		=	'';
								$nik_wali						=	'';
								$wali							=	'';
								$tmplahirwali				=	'';
								$tgllahirwali					=	'0000-00-00';
								$pendidikanwali			=	0;
								$pekerjaanwali			=	0;
								$pekerjaanwali_lain		=	'';
								$penghasilanwali_kode=	0;
								$penghasilanwali			=	0;
								$tempat_bekerja_wali	=	'';
								$alamatwali					=	'';
								$hpwali						=	'';
								$hubungansiswa			=	'';
								$penghasilanayah_kode	=	0;
								$penghasilanayah		=	0;
								$penghasilanibu_kode=	0;
								$penghasilanibu			=	0;
								$alamatortu					=	'';
								$telponortu					=	'';
								$hportu						=	'';
								$emailayah					=	'';
								$alamatsurat				=	'';
								$keterangan				=	'';
								$frompsb						=	0;
								$ketpsb						=	'';
								$statusmutasi				=	0;
								$pinsiswa						=	'';
								$pinortu						=	'';
								$hpibu							=	'';
								$pinortuibu					=	'';
								$emailibu						=	'';
								$jaraksekolah				=	0;
								$kesekolah					=	0;
								$rombel_id					=	0;
								$nama_bank				=	'';
								$no_rekening_bank		=	'';
								$nama_pemilik_bank	=	'';
								$pip								=	0;
								$alasan_pip					=	'';
								$info1							=	'';
								$info2							=	'';
								$info3  							=	'';
								$token							=	0;
								$issync						=	0;

								$sqlstr = "insert into siswa (nis, nisn, nik, nama, panggilan, asalsekolah_id, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, aktif, tahunmasuk, idangkatan, idangkatan1, idkelas, tglmasuk, idjurusan, idminat, idminat1, suku, agama, status, kondisi, kelamin, tmplahir, tgllahir, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, berat, tinggi, darah, file_darah, kelainan, foto, foto_file, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, telponsiswa, hpsiswa, emailsiswa, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, kesehatan, asalsekolah, kota_asalsekolah, ketsekolah, jenistinggal, transportasi_kode, transportasi_lain, nik_ayah, namaayah, tmplahirayah, tgllahirayah, wnayah, tempat_bekerja_ayah, nik_ibu, namaibu, tmplahiribu, tgllahiribu, wnibu, almayah, almibu, tempat_bekerja_ibu, pendidikanayah, pendidikanibu, pekerjaanayah, pekerjaanayah_lain, pekerjaanibu, pekerjaanibu_lain, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, pekerjaanwali_lain, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, alamatortu, telponortu, hportu, emailayah, alamatsurat, keterangan, frompsb, ketpsb, statusmutasi, alumni, pinsiswa, pinortu, hpibu, pinortuibu, emailibu, jaraksekolah, kesekolah, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, info1, info2, info3, uid, ts, token, issync) values ('$nis', '$nisn', '$nik', '$nama', '$panggilan', '$asalsekolah_id', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$aktif', '$tahunmasuk', '$idangkatan', '$idangkatan1', '$idkelas', '$tglmasuk', '$idjurusan', '$idminat', '$idminat1', '$suku', '$agama', '$status', '$kondisi', '$kelamin', '$tmplahir', '$tgllahir', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$berat', '$tinggi', '$darah', '$file_darah', '$kelainan', '$foto', '$foto_file', '$desa_kode', '$kecamatan_kode', '$kota_kode', '$provinsi_kode', '$alamatsiswa', '$rt_siswa', '$rw_siswa', '$dusun', '$desa', '$kecamatan', '$kodepossiswa', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$kps', '$nokps', '$kip', '$nokip', '$namakip', '$nokks', '$no_akte_lahir', '$kesehatan', '$asalsekolah', '$kota_asalsekolah', '$ketsekolah', '$jenistinggal', '$transportasi_kode', '$transportasi_lain', '$nik_ayah', '$namaayah', '$tmplahirayah', '$tgllahirayah', '$wnayah', '$tempat_bekerja_ayah', '$nik_ibu', '$namaibu', '$tmplahiribu', '$tgllahiribu', '$wnibu', '$almayah', '$almibu', '$tempat_bekerja_ibu', '$pendidikanayah', '$pendidikanibu', '$pekerjaanayah', '$pekerjaanayah_lain', '$pekerjaanibu', '$pekerjaanibu_lain', '$nik_wali', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$pekerjaanwali_lain', '$penghasilanwali_kode', '$penghasilanwali', '$tempat_bekerja_wali', '$alamatwali', '$hpwali', '$hubungansiswa', '$penghasilanayah_kode', '$penghasilanayah', '$penghasilanibu_kode', '$penghasilanibu', '$alamatortu', '$telponortu', '$hportu', '$emailayah', '$alamatsurat', '$keterangan', '$frompsb', '$ketpsb', '$statusmutasi', '$alumni', '$pinsiswa', '$pinortu', '$hpibu', '$pinortuibu', '$emailibu', '$jaraksekolah', '$kesekolah', '$rombel_id', '$nama_bank', '$no_rekening_bank', '$nama_pemilik_bank', '$pip', '$alasan_pip', '$info1', '$info2', '$info3', '$uid', '$dlu', '$token', '$issync')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();

								$insert++;
							} else {

								$sqlstr = "update siswa set nisn='$nisn', nik='$nik', nama='$nama', panggilan='$panggilan', kelamin='$kelamin', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', warga='$warga', anakke='$anakke', jsaudara='$jsaudara', alamatsiswa='$alamatsiswa', rt_siswa='$rt_siswa', rw_siswa='$rw_siswa', telponsiswa='$telponsiswa', hpsiswa='$hpsiswa', no_akte_lahir='$no_akte_lahir', nik_ayah='$nik_ayah', namaayah='$namaayah', nik_ibu='$nik_ibu', namaibu='$namaibu', idangkatan='$idangkatan', tahunmasuk='$tahunmasuk', alumni='$alumni', aktif='$aktif', uid='$uid', ts='$dlu' where nis='$nis'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();

								$update++;
							}

						}

					}

					$x++;

				}
			}

			//===========================KOMA=============================
			if (preg_match("/,/",$datacol) == 1) {
				while (($column = fgetcsv($file, 20000, ",")) !== FALSE) {
					if ($x > 0) {

						$nis					=	$column[1];
						$nisn				=	$column[2];
						$nik					=	$column[3];
						$nama				=	petikreplace($column[4]);
						$panggilan		=	petikreplace($column[5]);
						$kelamin			=	$column[6];
						$tmplahir			=	$column[7];
						$tgllahir			=	$column[8];
						$agama			=	$column[9];
						$warga				=	$column[10];
						$anakke			=	$column[11];
						$jsaudara			=	$column[12];
						$alamatsiswa	=	petikreplace($column[13]);
						$rt_siswa			=	$column[14];
						$rw_siswa		=	$column[15];
						$telponsiswa	=	$column[16];
						$hpsiswa			=	$column[17];
						$no_akte_lahir	=	$column[18];
						$nik_ayah		=	$column[19];
						$namaayah		=	petikreplace($column[20]);
						$nik_ibu			=	$column[21];
						$namaibu			=	petikreplace($column[22]);
						$idangkatan		=	$column[23];
						$tahunmasuk	=	$column[24];
						$idangkatan1	=	$column[25];
						$idkelas			=	$column[26];

						$alumni		= 0;
						$aktif			=	1;
						$uid				=	'import';
						$dlu				=	date("Y-m-d H:i:s");

						if ($nis != "") {

							$sqlstr = "select replid from siswa where nis='$nis'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							$rowsdata = $sql->rowCount();

							if ($rowsdata == 0) {

								$asalsekolah_id			=	0;
								$tglijazah						=	'0000-00-00';
								$noijazah						=	'';
								$tglskhun						=	'0000-00-00';
								$skhun							=	'';
								$noujian						=	'';
								$nisnasal						=	'';
								$tglmasuk						=	'0000-00-00';
								$idjurusan						=	0;
								$idminat							=	0;
								$idminat1						=	0;
								$suku							=	'';
								$status							=	'';
								$kondisi						=	'';
								$jtiri								=	0;
								$jangkat						=	0;
								$yatim							=	0; 
								$bahasa						=	'';
								$berat							=	0;
								$tinggi							=	0;
								$darah							=	0;
								$file_darah					=	'';
								$kelainan						=	'';
								$foto							=	'';
								$foto_file						=	'';
								$desa_kode					=	'';
								$kecamatan_kode		=	'';
								$kota_kode					=	'';
								$provinsi_kode			=	''; 
								$dusun							=	'';
								$desa							=	'';
								$kecamatan					=	'';
								$kodepossiswa			=	'';
								$emailsiswa					=	'';
								$kps								=	0;
								$nokps							=	'';
								$kip								=	0;
								$nokip							=	'';
								$namakip						=	'';
								$nokks							=	'';
								$kesehatan					=	'';
								$asalsekolah				=	'';
								$kota_asalsekolah		=	'';
								$ketsekolah					=	'';
								$jenistinggal				=	'';
								$transportasi_kode		=	'';
								$transportasi_lain  		=	'';
								$tmplahirayah				=	'';
								$tgllahirayah				=	'0000-00-00';
								$wnayah						=	'';
								$tempat_bekerja_ayah=	'';
								$tmplahiribu					=	'';
								$tgllahiribu					=	'0000-00-00';
								$wnibu							=	'';
								$almayah						=	0;
								$almibu						=	0;
								$tempat_bekerja_ibu	=	'';
								$pendidikanayah			=	'';
								$pendidikanibu			=	'';
								$pekerjaanayah			=	'';
								$pekerjaanayah_lain	=	'';
								$pekerjaanibu				=	'';
								$pekerjaanibu_lain		=	'';
								$nik_wali						=	'';
								$wali							=	'';
								$tmplahirwali				=	'';
								$tgllahirwali					=	'0000-00-00';
								$pendidikanwali			=	0;
								$pekerjaanwali			=	0;
								$pekerjaanwali_lain		=	'';
								$penghasilanwali_kode=	0;
								$penghasilanwali			=	0;
								$tempat_bekerja_wali	=	'';
								$alamatwali					=	'';
								$hpwali						=	'';
								$hubungansiswa			=	'';
								$penghasilanayah_kode	=	0;
								$penghasilanayah		=	0;
								$penghasilanibu_kode=	0;
								$penghasilanibu			=	0;
								$alamatortu					=	'';
								$telponortu					=	'';
								$hportu						=	'';
								$emailayah					=	'';
								$alamatsurat				=	'';
								$keterangan				=	'';
								$frompsb						=	0;
								$ketpsb						=	'';
								$statusmutasi				=	0;
								$pinsiswa						=	'';
								$pinortu						=	'';
								$hpibu							=	'';
								$pinortuibu					=	'';
								$emailibu						=	'';
								$jaraksekolah				=	0;
								$kesekolah					=	0;
								$rombel_id					=	0;
								$nama_bank				=	'';
								$no_rekening_bank		=	'';
								$nama_pemilik_bank	=	'';
								$pip								=	0;
								$alasan_pip					=	'';
								$info1							=	'';
								$info2							=	'';
								$info3  							=	'';
								$token							=	0;
								$issync						=	0;
								
								$sqlstr = "insert into siswa (nis, nisn, nik, nama, panggilan, asalsekolah_id, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, aktif, tahunmasuk, idangkatan, idangkatan1, idkelas, tglmasuk, idjurusan, idminat, idminat1, suku, agama, status, kondisi, kelamin, tmplahir, tgllahir, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, berat, tinggi, darah, file_darah, kelainan, foto, foto_file, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, telponsiswa, hpsiswa, emailsiswa, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, kesehatan, asalsekolah, kota_asalsekolah, ketsekolah, jenistinggal, transportasi_kode, transportasi_lain, nik_ayah, namaayah, tmplahirayah, tgllahirayah, wnayah, tempat_bekerja_ayah, nik_ibu, namaibu, tmplahiribu, tgllahiribu, wnibu, almayah, almibu, tempat_bekerja_ibu, pendidikanayah, pendidikanibu, pekerjaanayah, pekerjaanayah_lain, pekerjaanibu, pekerjaanibu_lain, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, pekerjaanwali_lain, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, alamatortu, telponortu, hportu, emailayah, alamatsurat, keterangan, frompsb, ketpsb, statusmutasi, alumni, pinsiswa, pinortu, hpibu, pinortuibu, emailibu, jaraksekolah, kesekolah, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, info1, info2, info3, uid, ts, token, issync) values ('$nis', '$nisn', '$nik', '$nama', '$panggilan', '$asalsekolah_id', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$aktif', '$tahunmasuk', '$idangkatan', '$idangkatan1', '$idkelas', '$tglmasuk', '$idjurusan', '$idminat', '$idminat1', '$suku', '$agama', '$status', '$kondisi', '$kelamin', '$tmplahir', '$tgllahir', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$berat', '$tinggi', '$darah', '$file_darah', '$kelainan', '$foto', '$foto_file', '$desa_kode', '$kecamatan_kode', '$kota_kode', '$provinsi_kode', '$alamatsiswa', '$rt_siswa', '$rw_siswa', '$dusun', '$desa', '$kecamatan', '$kodepossiswa', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$kps', '$nokps', '$kip', '$nokip', '$namakip', '$nokks', '$no_akte_lahir', '$kesehatan', '$asalsekolah', '$kota_asalsekolah', '$ketsekolah', '$jenistinggal', '$transportasi_kode', '$transportasi_lain', '$nik_ayah', '$namaayah', '$tmplahirayah', '$tgllahirayah', '$wnayah', '$tempat_bekerja_ayah', '$nik_ibu', '$namaibu', '$tmplahiribu', '$tgllahiribu', '$wnibu', '$almayah', '$almibu', '$tempat_bekerja_ibu', '$pendidikanayah', '$pendidikanibu', '$pekerjaanayah', '$pekerjaanayah_lain', '$pekerjaanibu', '$pekerjaanibu_lain', '$nik_wali', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$pekerjaanwali_lain', '$penghasilanwali_kode', '$penghasilanwali', '$tempat_bekerja_wali', '$alamatwali', '$hpwali', '$hubungansiswa', '$penghasilanayah_kode', '$penghasilanayah', '$penghasilanibu_kode', '$penghasilanibu', '$alamatortu', '$telponortu', '$hportu', '$emailayah', '$alamatsurat', '$keterangan', '$frompsb', '$ketpsb', '$statusmutasi', '$alumni', '$pinsiswa', '$pinortu', '$hpibu', '$pinortuibu', '$emailibu', '$jaraksekolah', '$kesekolah', '$rombel_id', '$nama_bank', '$no_rekening_bank', '$nama_pemilik_bank', '$pip', '$alasan_pip', '$info1', '$info2', '$info3', '$uid', '$dlu', '$token', '$issync')";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();

								$insert++;
							} else {
								
								$sqlstr = "update siswa set nisn='$nisn', nik='$nik', nama='$nama', panggilan='$panggilan', kelamin='$kelamin', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', warga='$warga', anakke='$anakke', jsaudara='$jsaudara', alamatsiswa='$alamatsiswa', rt_siswa='$rt_siswa', rw_siswa='$rw_siswa', telponsiswa='$telponsiswa', hpsiswa='$hpsiswa', no_akte_lahir='$no_akte_lahir', nik_ayah='$nik_ayah', namaayah='$namaayah', nik_ibu='$nik_ibu', namaibu='$namaibu', idangkatan='$idangkatan', tahunmasuk='$tahunmasuk', alumni='$alumni', aktif='$aktif', uid='$uid', ts='$dlu' where nis='$nis'";
								$sql=$dbpdo->prepare($sqlstr);
								$sql->execute();
								
								$update++;
							}

						}

					}

					$x++;
				}
			}
		}

	}
?>

<table align="center" style="font-size: 36px; color: #07581c">
	<tr>
		<td><?php echo "Jumlah Tambah Data : " . $insert; ?></td>
	</tr>
	<tr>
		<td><?php echo "Jumlah Update Data : " . $update; ?></td>
	</tr>
</table>

<?php
}
?>


