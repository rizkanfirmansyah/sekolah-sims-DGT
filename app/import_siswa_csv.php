<?php

$namafile = "DATA SISWA.csv";

header("Content-Type: application/csv");
header("Content-Disposition: attachment;filename=".$namafile." ");

include_once ("include/queryfunctions.php");
include_once ("include/functions.php");

$dbpdo = DB::create();

$fp = fopen('php://output', 'w');
$fp1 = fopen('php://output', 'w');

$header = array(
		'0' => 'NO.',
		'1' => 'NIS',
		'2' => 'NISN',
		'3' => 'NIK SISWA',
		'4' => 'NAMA LENGKAP',
		'5' => 'PANGGILAN',
		'6' => 'JENIS KELAMIN',
		'7' => 'TEMPAT LAHIR',
		'8' => 'TGL LAHIR',
		'9' => 'AGAMA',
		'10' => 'KEWARGANEGARAAN',
		'11' => 'ANAKE KE',
		'12' => 'JUMLAH SAUDARA',
		'13' => 'ALAMAT SISWA',
		'14' => 'RT',
		'15' => 'RW',
		'16' => 'NO TELEPON',
		'17' => 'NO HP',
		'18' => 'NO AKTE KELAHIRAN',
		'19' => 'NIK AYAH',
		'20' => 'NAMA AYAH',
		'21' => 'NIK IBU',
		'22' => 'NAMA IBU',
		'23' => 'ID TAHUN AJARAN',
		'24' => 'TAHUN MASUK',
		'25' => 'ID ANGKATAN',
		'26' => 'ID KELAS',
		'27' => 'ID LEVEL'
	);
fputcsv($fp, $header, ';');

$i = 0;
$sqlstr = "select a.nis, a.nisn, a.nik, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.panggilan, a.idkelas, a.tglmasuk, a.tahunmasuk, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.desa_kode, a.kecamatan_kode, a.kota_kode, a.provinsi_kode, a.alamatsiswa, a.rt_siswa, a.rw_siswa, a.dusun, a.desa, a.kecamatan, a.kodepossiswa, a.jenistinggal, a.alamatortu, a.telponsiswa, a.hpsiswa, a.emailsiswa, a.telponortu, a.hportu, a.hpibu, a.transportasi_kode, a.kps, a.nokps, a.kip, a.nokip, a.namakip, a.nokks, a.no_akte_lahir, a.transportasi_lain, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.kota_asalsekolah, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.nik_ayah, a.namaayah, a.nik_ibu, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tempat_bekerja_ayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah_kode, a.penghasilanayah, a.penghasilanibu_kode, a.penghasilanibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.nik_wali, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali_kode, a.penghasilanwali, a.tempat_bekerja_wali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.tempat_bekerja_ibu, a.pekerjaanwali_lain, a.rombel_id, a.nama_bank, a.no_rekening_bank, a.nama_pemilik_bank, a.pip, a.alasan_pip, a.idminat, a.uid, a.aktif, a.ts, a.almayah, a.almibu, a.alumni, b.idtingkat from siswa a left join kelas b on a.idkelas=b.replid order by a.nis limit 5";
$sql=$dbpdo->prepare($sqlstr);
$sql->execute();
while ($row_siswa=$sql->fetch(PDO::FETCH_OBJ)) {

	$i++;

	$detail = array(
		'0' => $i,
		'1' => $row_siswa->nis,
		'2' => $row_siswa->nisn,
		'3' => $row_siswa->nik,
		'4' => $row_siswa->nama,
		'5' => $row_siswa->panggilan,
		'6' => $row_siswa->kelamin,
		'7' => $row_siswa->tmplahir,
		'8' => $row_siswa->tgllahir,
		'9' => $row_siswa->agama,
		'10' => $row_siswa->warga,
		'11' => $row_siswa->anakke,
		'12' => $row_siswa->jsaudara,
		'13' => $row_siswa->alamatsiswa,
		'14' => $row_siswa->rt_siswa,
		'15' => $row_siswa->rw_siswa,
		'16' => $row_siswa->telponsiswa,
		'17' => $row_siswa->hpsiswa,
		'18' => $row_siswa->no_akte_lahir,
		'19' => $row_siswa->nik_ayah,
		'20' => $row_siswa->namaayah,
		'21' => $row_siswa->nik_ibu,
		'22' => $row_siswa->namaibu,
		'23' => $row_siswa->idangkatan,
		'24' => $row_siswa->tahunmasuk,
		'25' => $row_siswa->idangkatan1,
		'26' => $row_siswa->idkelas,
		'27' => $row_siswa->idtingkat
	);

	fputcsv($fp1, $detail, ';');

}

?>

