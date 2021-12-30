<?php
session_start();
						
error_reporting(E_ALL & ~E_NOTICE);

ob_start();
include_once ("app/include/queryfunctions.php");
include_once ("app/include/functions.php");
//include_once ("app/include/function_login.php");
//include_once ("app/include/login_check.inc.php");

//$conn=db_connect(HOST,USER,PASS,DB,PORT);
$dbpdo = DB::create();

include 'app/class/class.select.php';
include 'app/class/class.select.view.php';
$select=new select;
$select_view=new select_view;

$act	= $_GET['act'];
$menu	= $_GET['menu'];
$nama_folder = 'main.php?menu=app&act=';
$segmen3 = $_GET['search'];

//-----------------------------/\

if (($_SESSION["logged"] == 0)) {
	//echo 'Access denied';
	$msg = "<meta http-equiv=\"Refresh\" content=\"0;url=./login.php\">";
	echo $msg; 
	exit;
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sistem Informasi Manajemen Sekolah</title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/bootstrap-responsive.css">
<link rel="stylesheet" href="css/jquery.fancybox.css">
<link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="css/uniform.default.css">
<!--<link rel="stylesheet" href="css/green.css">-->
<!--<link rel="stylesheet" href="css/blue.css">-->
<link rel="stylesheet" href="css/bootstrap.datepicker.css">
<link rel="stylesheet" href="css/jquery.cleditor.css">
<link rel="stylesheet" href="css/jquery.plupload.queue.css">
<link rel="stylesheet" href="css/jquery.tagsinput.css">
<link rel="stylesheet" href="css/jquery.ui.plupload.css">
<link rel="stylesheet" href="css/chosen.css">

<!-------finance only------>
<script src="app/finance/script/tooltips.js" language="javascript"></script>
<script src="app/finance/script/tools.js" language="javascript"></script>
<!------------------------->

<script type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</script>

<script>
      $(document).ready(function(){
          function disableBack() {window.history.forward()}
          window.onload = disableBack();
  	  window.onpageshow = function(evt) {if(evt.persisted) disableBack()}
      });
</script>

<script>

function tambahpenerimaan() 
{	
	newWindow('app/penerimaanjtt_add.php','Penerimaan','1000','1000','resizable=1,scrollbars=1,status=0,toolbar=0');
}

function presensi_harian_siswa() 
{	
	newWindow('app/presensi_harian_siswa.php','Presensi Harian Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
}

function presensi_absen_siswa() 
{	
	newWindow('app/presensi_absen_siswa.php','Presensi Absen Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
}

function presensi_general()
{
	newWindow('app/presensi_general.php','Presensi Absen Guru','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
}

//import_siswa
function import_siswa()
{
	newWindow('app/import_siswa.php','Upload Siswa','1000','500','resizable=1,scrollbars=1,status=0,toolbar=0');
}

</script>

</head>
<body onload="noBack();" 
	onpageshow="if (event.persisted) noBack();">
<div class="style-toggler">
	<img src="img/icons/fugue/color.png" alt="" class='tip' title="Ganti Warna" data-placement="right">
</div>					
<div class="style-switcher">
	<h3>Ganti Warna</h3>
	<ul>
		<li>
			<a href="#" class='style'>Default</a>
		</li>
		<li>
			<a href="#" class='blue'>Blue</a>
		</li>
		<li>
			<a href="#" class='green'>Green</a>
		</li>
		<li>
			<a href="#" class='red'>Red</a>
		</li>
	</ul>
</div>

<?php

include("header.php");
include("menu.php");

?>

	
<?php
	
	if ($act == '') { include_once("dashboard.php"); }
	if ($act == obraxabrix('registrasi')) { include_once("app/registrasi.php"); }
	if ($act == obraxabrix('registrasi_view')) { include_once("app/registrasi_view.php"); }
	if ($act == obraxabrix('siswa')) { include_once("app/siswa.php"); }	
	if ($act == obraxabrix('siswa_view')) { include_once("app/siswa_view.php"); }
	if ($act == obraxabrix('siswa_list')) { include_once("app/siswa_list.php"); }
	if ($act == obraxabrix('alumni_list')) { include_once("app/alumni_list.php"); }
	if ($act == obraxabrix('usr')) { include_once("app/usr.php"); }
	if ($act == obraxabrix('usr_view')) { include_once("app/usr_view.php"); }
	if ($act == obraxabrix('chgpwd')) { include_once("app/gantipassword.php"); }
	if ($act == obraxabrix('prosespenerimaansiswa')) { include_once("app/prosespenerimaansiswa.php"); }
	if ($act == obraxabrix('prosespenerimaansiswa_view')) { include_once("app/prosespenerimaansiswa_view.php"); }
	if ($act == obraxabrix('kelompokcalonsiswa')) { include_once("app/kelompokcalonsiswa.php"); }
	if ($act == obraxabrix('kelompokcalonsiswa_view')) { include_once("app/kelompokcalonsiswa_view.php"); }	
	if ($act == obraxabrix('departemen')) { include_once("app/departemen.php"); }
	if ($act == obraxabrix('departemen_view')) { include_once("app/departemen_view.php"); }
	if ($act == obraxabrix('tingkat')) { include_once("app/tingkat.php"); }
	if ($act == obraxabrix('tingkat_view')) { include_once("app/tingkat_view.php"); }
	if ($act == obraxabrix('kelas')) { include_once("app/kelas.php"); }
	if ($act == obraxabrix('kelas_view')) { include_once("app/kelas_view.php"); }
	if ($act == obraxabrix('tahunajaran')) { include_once("app/tahunajaran.php"); }
	if ($act == obraxabrix('tahunajaran_view')) { include_once("app/tahunajaran_view.php"); }
	if ($act == obraxabrix('agama')) { include_once("app/agama.php"); }
	if ($act == obraxabrix('agama_view')) { include_once("app/agama_view.php"); }
	if ($act == obraxabrix('tahunbuku')) { include_once("app/tahunbuku.php"); }
	if ($act == obraxabrix('tahunbuku_view')) { include_once("app/tahunbuku_view.php"); }
	if ($act == obraxabrix('rekakun')) { include_once("app/rekakun.php"); }
	if ($act == obraxabrix('rekakun_view')) { include_once("app/rekakun_view.php"); }
	if ($act == obraxabrix('datapenerimaan')) { include_once("app/datapenerimaan.php"); }
	if ($act == obraxabrix('datapenerimaan_view')) { include_once("app/datapenerimaan_view.php"); }
	if ($act == obraxabrix('datapengeluaran')) { include_once("app/datapengeluaran.php"); }
	if ($act == obraxabrix('datapengeluaran_view')) { include_once("app/datapengeluaran_view.php"); }
	if ($act == obraxabrix('besarjtt')) { include_once("app/besarjtt.php"); }
	if ($act == obraxabrix('besarjtt_view')) { include_once("app/besarjtt_view.php"); }
	if ($act == obraxabrix('perpustakaan')) { include_once("app/perpustakaan.php"); }
	if ($act == obraxabrix('perpustakaan_view')) { include_once("app/perpustakaan_view.php"); }
	if ($act == obraxabrix('format')) { include_once("app/format.php"); }
	if ($act == obraxabrix('format_view')) { include_once("app/format_view.php"); }
	if ($act == obraxabrix('rak')) { include_once("app/rak.php"); }
	if ($act == obraxabrix('rak_view')) { include_once("app/rak_view.php"); }
	if ($act == obraxabrix('katalog')) { include_once("app/katalog.php"); }
	if ($act == obraxabrix('katalog_view')) { include_once("app/katalog_view.php"); }
	if ($act == obraxabrix('penerbit')) { include_once("app/penerbit.php"); }
	if ($act == obraxabrix('penerbit_view')) { include_once("app/penerbit_view.php"); }
	if ($act == obraxabrix('penulis')) { include_once("app/penulis.php"); }
	if ($act == obraxabrix('penulis_view')) { include_once("app/penulis_view.php"); }
	if ($act == obraxabrix('pustaka')) { include_once("app/pustaka.php"); }
	if ($act == obraxabrix('pustaka_view')) { include_once("app/pustaka_view.php"); }
	if ($act == obraxabrix('pinjam')) { include_once("app/pinjam.php"); }
	if ($act == obraxabrix('pinjam_view')) { include_once("app/pinjam_view.php"); }
	if ($act == obraxabrix('kembali')) { include_once("app/kembali.php"); }
	if ($act == obraxabrix('kembali_view')) { include_once("app/kembali_view.php"); }
	if ($act == obraxabrix('konfigurasi')) { include_once("app/konfigurasi.php"); }
	if ($act == obraxabrix('konfigurasi_view')) { include_once("app/konfigurasi_view.php"); }
	
	if ($act == obraxabrix('kenaikan')) { include_once("app/kenaikan.php"); }
	if ($act == obraxabrix('kenaikan_view')) { include_once("app/kenaikan_view.php"); }
	if ($act == obraxabrix('pindah_kelas')) { include_once("app/pindah_kelas.php"); }
	if ($act == obraxabrix('kelulusan')) { include_once("app/kelulusan.php"); }
	if ($act == obraxabrix('kelulusan_view')) { include_once("app/kelulusan_view.php"); }
	if ($act == obraxabrix('penempatan')) { include_once("app/penempatan.php"); }
	if ($act == obraxabrix('pegawai')) { include_once("app/pegawai.php"); }
	if ($act == obraxabrix('pegawai_view')) { include_once("app/pegawai_view.php"); }
	if ($act == obraxabrix('statusguru')) { include_once("app/statusguru.php"); }
	if ($act == obraxabrix('statusguru_view')) { include_once("app/statusguru_view.php"); }
	if ($act == obraxabrix('pegawai_jabatan')) { include_once("app/pegawai_jabatan.php"); }
	if ($act == obraxabrix('pegawai_jabatan_view')) { include_once("app/pegawai_jabatan_view.php"); }
	if ($act == obraxabrix('jabatan')) { include_once("app/jabatan.php"); }
	if ($act == obraxabrix('jabatan_view')) { include_once("app/jabatan_view.php"); }
	
	//-------BK
	if ($act == obraxabrix('jenis_pelanggaran')) { include_once("app/jenis_pelanggaran.php"); }
	if ($act == obraxabrix('jenis_pelanggaran_view')) { include_once("app/jenis_pelanggaran_view.php"); }
	if ($act == obraxabrix('jenis_prestasi')) { include_once("app/jenis_prestasi.php"); }
	if ($act == obraxabrix('jenis_prestasi_view')) { include_once("app/jenis_prestasi_view.php"); }
	if ($act == obraxabrix('pelanggaran_siswa')) { include_once("app/pelanggaran_siswa.php"); }
	if ($act == obraxabrix('pelanggaran_siswa_view')) { include_once("app/pelanggaran_siswa_view.php"); }
	if ($act == obraxabrix('konseling_siswa')) { include_once("app/konseling_siswa.php"); }
	if ($act == obraxabrix('konseling_siswa_view')) { include_once("app/konseling_siswa_view.php"); }
    if ($act == obraxabrix('jenis_izin')) { include_once("app/jenis_izin.php"); }
	if ($act == obraxabrix('jenis_izin_view')) { include_once("app/jenis_izin_view.php"); }
    if ($act == obraxabrix('izin_siswa')) { include_once("app/izin_siswa.php"); }
	if ($act == obraxabrix('izin_siswa_view')) { include_once("app/izin_siswa_view.php"); }
	if ($act == obraxabrix('aspek_perkembangan')) { include_once("app/aspek_perkembangan.php"); }
	if ($act == obraxabrix('aspek_perkembangan_view')) { include_once("app/aspek_perkembangan_view.php"); }
	if ($act == obraxabrix('assesmen_observasi')) { include_once("app/assesmen_observasi.php"); }
	if ($act == obraxabrix('assesmen_observasi_view')) { include_once("app/assesmen_observasi_view.php"); }
	if ($act == obraxabrix('aspek_psikologi')) { include_once("app/aspek_psikologi.php"); }
	if ($act == obraxabrix('aspek_psikologi_view')) { include_once("app/aspek_psikologi_view.php"); }
	if ($act == obraxabrix('aspek_psikologi_detail')) { include_once("app/aspek_psikologi_detail.php"); }
	if ($act == obraxabrix('aspek_psikologi_detail_view')) { include_once("app/aspek_psikologi_detail_view.php"); }
	if ($act == obraxabrix('evaluasi_psikologi')) { include_once("app/evaluasi_psikologi.php"); }
	if ($act == obraxabrix('evaluasi_psikologi_view')) { include_once("app/evaluasi_psikologi_view.php"); }
	if ($act == obraxabrix('rpt_evaluasi_psikologi_level')) { include_once("app/rpt_evaluasi_psikologi_level.php"); }
	if ($act == obraxabrix('presensi_harian_siswa')) { include_once("app/presensi_harian_siswa.php"); }
	 if ( $act == obraxabrix('presensi_ukbm') ) { include_once("app/presensi_ukbm.php"); }
	 if ( $act == obraxabrix('presensi_ukbm_view') ) { include_once("app/presensi_ukbm_view.php"); }
	 if ( $act == obraxabrix('presensi_ukbm_update') ) { include_once("app/presensi_ukbm_update.php"); }
	
    if ($act == obraxabrix('barcode')) { include_once("app/barcode.php"); }
    if ($act == obraxabrix('pangkat')) { include_once("app/pangkat.php"); }
	if ($act == obraxabrix('pangkat_view')) { include_once("app/pangkat_view.php"); }
	if ($act == obraxabrix('pegawai_pangkat')) { include_once("app/pegawai_pangkat.php"); }
	if ($act == obraxabrix('pegawai_pangkat_view')) { include_once("app/pegawai_pangkat_view.php"); }
	if ($act == obraxabrix('jenis_sertifikasi')) { include_once("app/jenis_sertifikasi.php"); }
	if ($act == obraxabrix('jenis_sertifikasi_view')) { include_once("app/jenis_sertifikasi_view.php"); }
	if ($act == obraxabrix('status_pegawai')) { include_once("app/status_pegawai.php"); }
	if ($act == obraxabrix('status_pegawai_view')) { include_once("app/status_pegawai_view.php"); }
	if ($act == obraxabrix('kenaikan_gaji')) { include_once("app/kenaikan_gaji.php"); }
	if ($act == obraxabrix('kenaikan_gaji_view')) { include_once("app/kenaikan_gaji_view.php"); }
	if ($act == obraxabrix('pegawai_pendidikan')) { include_once("app/pegawai_pendidikan.php"); }
	if ($act == obraxabrix('pegawai_pendidikan_view')) { include_once("app/pegawai_pendidikan_view.php"); }
	if ($act == obraxabrix('pegawai_keluarga')) { include_once("app/pegawai_keluarga.php"); }
	if ($act == obraxabrix('pegawai_keluarga_view')) { include_once("app/pegawai_keluarga_view.php"); }
	if ($act == obraxabrix('supplier')) { include_once("app/supplier.php"); }
	if ($act == obraxabrix('supplier_view')) { include_once("app/supplier_view.php"); }
	if ($act == obraxabrix('pegawai_prestasi')) { include_once("app/pegawai_prestasi.php"); }
	if ($act == obraxabrix('pegawai_prestasi_view')) { include_once("app/pegawai_prestasi_view.php"); }
	if ($act == obraxabrix('pegawai_penghargaan')) { include_once("app/pegawai_penghargaan.php"); }
	if ($act == obraxabrix('pegawai_penghargaan_view')) { include_once("app/pegawai_penghargaan_view.php"); }
	if ($act == obraxabrix('pegawai_skmengajar')) { include_once("app/pegawai_skmengajar.php"); }
	if ($act == obraxabrix('pegawai_skmengajar_view')) { include_once("app/pegawai_skmengajar_view.php"); }
	if ($act == obraxabrix('usr_reminder')) { include_once("app/usr_reminder.php"); }
	
	//kurikulum
	if ($act == obraxabrix('pelajaran')) { include_once("app/pelajaran.php"); }
	if ($act == obraxabrix('pelajaran_view')) { include_once("app/pelajaran_view.php"); }
	if ($act == obraxabrix('siswa_ekstrakurikuler')) { include_once("app/siswa_ekstrakurikuler.php"); }
	if ($act == obraxabrix('siswa_ekstrakurikuler_view')) { include_once("app/siswa_ekstrakurikuler_view.php"); }
	if ($act == obraxabrix('semester')) { include_once("app/semester.php"); }
	if ($act == obraxabrix('semester_view')) { include_once("app/semester_view.php"); }
	if ($act == obraxabrix('angkatan')) { include_once("app/angkatan.php"); }
	if ($act == obraxabrix('angkatan_view')) { include_once("app/angkatan_view.php"); }
	if ($act == obraxabrix('rpp')) { include_once("app/rpp.php"); }
	if ($act == obraxabrix('rpp_view')) { include_once("app/rpp_view.php"); }
	if ($act == obraxabrix('kompetensi')) { include_once("app/kompetensi.php"); }
	if ($act == obraxabrix('kompetensi_view')) { include_once("app/kompetensi_view.php"); }
	if ($act == obraxabrix('dasarpenilaian')) { include_once("app/dasarpenilaian.php"); }
	if ($act == obraxabrix('dasarpenilaian_view')) { include_once("app/dasarpenilaian_view.php"); }
	if ($act == obraxabrix('jeniskompetensi')) { include_once("app/jeniskompetensi.php"); }
	if ($act == obraxabrix('jeniskompetensi_view')) { include_once("app/jeniskompetensi_view.php"); }
	if ($act == obraxabrix('daftarnilai_view')) { include_once("app/daftarnilai_view.php"); }
	
	##perpustakaan
	if ($act == obraxabrix('anggota')) { include_once("app/anggota.php"); }
	if ($act == obraxabrix('anggota_view')) { include_once("app/anggota_view.php"); }
	if ($act == obraxabrix('daftarpustaka')) { include_once("app/daftarpustaka.php"); }
	if ($act == obraxabrix('daftarpustaka_view')) { include_once("app/daftarpustaka_view.php"); }
	
	##keuangan
	if ($act == obraxabrix('penerimaanjtt')) { include_once("app/penerimaanjtt_update.php"); }

	#grafik
	if ($act == obraxabrix('kinerjagrafik','kinerjagrafik')) { include_once("app/kinerjagrafik.php"); }
	
	if ($act == 'kinerjadkgrafik_detail') { include_once("app/kinerjadkgrafik_detail.php"); }
	
	#report
	if ($act == obraxabrix('rpt_penerimaan')) { include_once("app/rpt_penerimaan.php"); }
	if ($act == obraxabrix('rpt_pinjam_telat')) { include_once("app/rpt_pinjam_telat.php"); }
	if ($act == obraxabrix('rpt_izin_siswa')) { include_once("app/rpt_izin_siswa.php"); }    
	if ($act == obraxabrix('rpt_izin_siswa_surat')) { include_once("app/rpt_izin_siswa_surat.php"); }    
	if ($act == obraxabrix('rpt_konseling_siswa')) { include_once("app/rpt_konseling_siswa.php"); }
	if ($act == obraxabrix('rpt_lunas')) { include_once("app/rpt_lunas.php"); }
	if ($act == obraxabrix('rpt_presensi_harian_siswa')) { include_once("app/rpt_presensi_harian_siswa.php"); }
	
?>
					
</div>	

<script src="js/jquery.js"></script>
<script src="js/less.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.peity.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/jquery.flot.js"></script>
<script src="js/jquery.color.js"></script>
<script src="js/jquery.flot.resize.js"></script>
<script src="js/custom.js"></script>


<script src="js/jquery.uniform.min.js"></script>
<script src="js/bootstrap.timepicker.js"></script>
<script src="js/bootstrap.datepicker.js"></script>
<script src="js/chosen.jquery.min.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/plupload/plupload.full.js"></script>
<script src="js/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
<script src="js/jquery.cleditor.min.js"></script>
<script src="js/jquery.inputmask.min.js"></script>
<script src="js/jquery.tagsinput.min.js"></script>
<script src="js/jquery.mousewheel.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/jquery.dataTables.bootstrap.js"></script>
<script src="js/jquery.textareaCounter.plugin.js"></script>
<script src="js/ui.spinner.js"></script>

</body>
</html>