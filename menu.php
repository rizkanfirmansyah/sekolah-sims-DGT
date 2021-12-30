<?php
$dashboard = '';

$psb = '';
$psb_nav = "class='collapsed-nav closed'";

$kesiswaan = '';
$kesiswaan_nav = "class='collapsed-nav closed'";

$kurikulum = '';
$kurikulum_nav = "class='collapsed-nav closed'";

$keuangan = '';
$keuangan_nav = "class='collapsed-nav closed'";

$perpustakaan = '';
$perpustakaan_nav = "class='collapsed-nav closed'";

$kepegawaian = '';
$kepegawaian_nav = "class='collapsed-nav closed'";

$konseling = '';
$konseling_nav = "class='collapsed-nav closed'";

$report = '';

$utility = '';
$utility_nav = "class='collapsed-nav closed'";

$reminder = '';
$reminder_nav = "class='collapsed-nav closed'";

$presensi = '';
$presensi_nav = "class='collapsed-nav closed'";


##set active menu
if ( $act == obraxabrix('siswa') || $act == obraxabrix('siswa_view')) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$siswa_active = "active";
}
if ( $act == obraxabrix('siswa_list') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$siswa_list_active = "active";
}
if ( $act == obraxabrix('tingkat') || $act == obraxabrix('tingkat_view') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$tingkat_active = "active";
}
if ( $act == obraxabrix('kelas') || $act == obraxabrix('kelas_view') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$kelas_active = "active";
}
if ( $act == obraxabrix('tahunajaran') || $act == obraxabrix('tahunajaran_view') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$tahunajaran_active = "active";
}
if ( $act == obraxabrix('agama') || $act == obraxabrix('agama_view') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$agama_active = "active";
}
if ( $act == obraxabrix('kenaikan') || $act == obraxabrix('kenaikan_view') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$kenaikan_active = "active";
}
if ( $act == obraxabrix('penempatan') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$penempatan_active = "active";
}
if ( $act == obraxabrix('barcode') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$barcode_active = "active";
}
if ( $act == obraxabrix('departemen') || $act == obraxabrix('departemen_view') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$departemen_active = "active";
}
if ( $act == obraxabrix('angkatan') || $act == obraxabrix('angkatan_view') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$angkatan_active = "active";
}
if ( $act == obraxabrix('kelulusan') || $act == obraxabrix('kelulusan_view') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$kelulusan_active = "active";
}
if ( $act == obraxabrix('alumni_list') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$alumni_list_active = "active";
}
if ( $act == obraxabrix('pindah_kelas') ) {  
	$kesiswaan = "class='active open'";
	$kesiswaan_nav = "class='collapsed-nav'";
	$pindah_kelas_active = "active";
}



##Presensi
if ( $act == obraxabrix('presensi_harian_siswa') ) { 
	$presensi = "class='active open'";
	$presensi_nav = "class='collapsed-nav'";
	$presensi_harian_siswa_active = "active";
}
if ( $act == obraxabrix('rpt_presensi_harian_siswa') ) { 
	$presensi = "class='active open'";
	$presensi_nav = "class='collapsed-nav'";
	$rpt_presensi_harian_siswa_active = "active";
}
if ( $act == obraxabrix('presensi_absen_siswa') ) { 
	$presensi = "class='active open'";
	$presensi_nav = "class='collapsed-nav'";
	$presensi_absen_siswa_active = "active";
}

if ( $act == obraxabrix('presensi_ukbm') || $act == obraxabrix('presensi_ukbm_view') || $act == obraxabrix('presensi_ukbm_update')  ) {
	$presensi = "class='active open'";
	$presensi_nav = "class='collapsed-nav'";
	$presensi_ukbm_active = "active";
}


if ($act == '' || $act == 'main.php') { 
	$dashboard = "class='active open'"; 
}

//$act == obraxabrix('siswa') || $act == obraxabrix('siswa_view') || $act == obraxabrix('siswa_list') || $act == obraxabrix('tingkat') || $act == obraxabrix('tingkat_view') || $act == obraxabrix('kelas') || $act == obraxabrix('kelas_view') || $act == obraxabrix('tahunajaran') || $act == obraxabrix('tahunajaran_view') || $act == obraxabrix('agama') || $act == obraxabrix('agama_view') || $act == obraxabrix('kenaikan') || $act == obraxabrix('kenaikan_view') || $act == obraxabrix('penempatan') || $act == obraxabrix('barcode') || $act == obraxabrix('angkatan') || $act == obraxabrix('angkatan_view') || $act == obraxabrix('kelulusan') || $act == obraxabrix('kelulusan_view') || $act == obraxabrix('alumni_list')


if ($act == obraxabrix('registrasi') || $act == obraxabrix('registrasi_view') || $act == obraxabrix('prosespenerimaansiswa') || $act == obraxabrix('prosespenerimaansiswa_view') || $act == obraxabrix('kelompokcalonsiswa') || $act == obraxabrix('kelompokcalonsiswa_view') ) { 
	$psb = "class='active open'";
	$psb_nav = "class='collapsed-nav'";
}


if ($act == obraxabrix('pelajaran') || $act == obraxabrix('pelajaran_view') || $act == obraxabrix('ekstrakurikuler') || $act == obraxabrix('ekstrakurikuler_view') || $act == obraxabrix('semester') || $act == obraxabrix('semester_view') || $act == obraxabrix('rpp') || $act == obraxabrix('rpp_view') || $act == obraxabrix('kompetensi') || $act == obraxabrix('kompetensi_view') || $act == obraxabrix('dasarpenilaian') || $act == obraxabrix('dasarpenilaian_view') || $act == obraxabrix('jeniskompetensi') || $act == obraxabrix('jeniskompetensi_view') || $act == obraxabrix('daftarnilai_view') ) { 
	$kurikulum = "class='active open'";
	$kurikulum_nav = "class='collapsed-nav'";
}

if ($act == obraxabrix('tahunbuku') || $act == obraxabrix('tahunbuku_view') || $act == obraxabrix('rekakun') || $act == obraxabrix('rekakun_view') || $act == obraxabrix('datapenerimaan') || $act == obraxabrix('datapenerimaan_view') || $act == obraxabrix('datapengeluaran') || $act == obraxabrix('datapengeluaran_view') || $act == obraxabrix('besarjtt') || $act == obraxabrix('besarjtt_view') || $act == obraxabrix('penerimaanjtt') || $act == obraxabrix('penerimaanjtt_view') || $act == obraxabrix('rpt_penerimaan') || $act == obraxabrix('rpt_lunas') ) { 
	$keuangan = "class='active open'";
	$keuangan_nav = "class='collapsed-nav'";
}

if ( $act == obraxabrix('perpustakaan') || $act == obraxabrix('perpustakaan_view') || $act == obraxabrix('format') || $act == obraxabrix('format_view') || $act == obraxabrix('rak') || $act == obraxabrix('rak_view') || $act == obraxabrix('katalog') || $act == obraxabrix('katalog_view') || $act == obraxabrix('penerbit') || $act == obraxabrix('penerbit_view') || $act == obraxabrix('penulis') || $act == obraxabrix('penulis_view') || $act == obraxabrix('pustaka') || $act == obraxabrix('pustaka_view') || $act == obraxabrix('pinjam') || $act == obraxabrix('pinjam_view') || $act == obraxabrix('kembali') || $act == obraxabrix('kembali_view') || $act == obraxabrix('rpt_pinjam_telat') || $act == obraxabrix('konfigurasi') || $act == obraxabrix('konfigurasi_view') || $act == obraxabrix('supplier') || $act == obraxabrix('supplier_view') || $act == obraxabrix('anggota') || $act == obraxabrix('anggota_view') || $act == obraxabrix('daftarpustaka') || $act == obraxabrix('daftarpustaka_view') ) { 
	$perpustakaan = "class='active open'";
	$perpustakaan_nav = "class='collapsed-nav'";
}

if ( $act == obraxabrix('pegawai') || $act == obraxabrix('pegawai_view') || $act == obraxabrix('statusguru') || $act == obraxabrix('statusguru_view') || $act == obraxabrix('pegawai_jabatan') || $act == obraxabrix('pegawai_jabatan_view') || $act == obraxabrix('jabatan') || $act == obraxabrix('jabatan_view') || $act == obraxabrix('pangkat') || $act == obraxabrix('pangkat_view') || $act == obraxabrix('pegawai_pangkat') || $act == obraxabrix('pegawai_pangkat_view') || $act == obraxabrix('jenis_sertifikasi') || $act == obraxabrix('jenis_sertifikasi_view') || $act == obraxabrix('status_pegawai') || $act == obraxabrix('status_pegawai_view') || $act == obraxabrix('kenaikan_gaji') || $act == obraxabrix('kenaikan_gaji_view') || $act == obraxabrix('pegawai_pendidikan') || $act == obraxabrix('pegawai_pendidikan_view') || $act == obraxabrix('pegawai_keluarga') || $act == obraxabrix('pegawai_keluarga_view') || $act == obraxabrix('pegawai_prestasi') || $act == obraxabrix('pegawai_prestasi_view') || $act == obraxabrix('pegawai_penghargaan') || $act == obraxabrix('pegawai_penghargaan_view') || $act == obraxabrix('pegawai_skmengajar') || $act == obraxabrix('pegawai_skmengajar_view') ) { 
	$kepegawaian = "class='active open'";
	$kepegawaian_nav = "class='collapsed-nav'";
}

if ($act == obraxabrix('jenis_pelanggaran') || $act == obraxabrix('jenis_pelanggaran_view') || $act == obraxabrix('jenis_prestasi') || $act == obraxabrix('jenis_prestasi_view') || $act == obraxabrix('pelanggaran_siswa') || $act == obraxabrix('pelanggaran_siswa_view') || $act == obraxabrix('konseling_siswa') || $act == obraxabrix('konseling_siswa_view') || $act == obraxabrix('jenis_izin') || $act == obraxabrix('jenis_izin_view') || $act == obraxabrix('izin_siswa') || $act == obraxabrix('izin_siswa_view') || $act == obraxabrix('rpt_izin_siswa') || $act == obraxabrix('rpt_izin_siswa_surat') || $act == obraxabrix('rpt_konseling_siswa') || $act == obraxabrix('aspek_perkembangan') || $act == obraxabrix('aspek_perkembangan_view') || $act == obraxabrix('assesmen_observasi') || $act == obraxabrix('assesmen_observasi_view') || $act == obraxabrix('aspek_psikologi') || $act == obraxabrix('aspek_psikologi_view') || $act == obraxabrix('aspek_psikologi_detail') || $act == obraxabrix('aspek_psikologi_detail_view') || $act == obraxabrix('evaluasi_psikologi') || $act == obraxabrix('evaluasi_psikologi_view') || $act == obraxabrix('rpt_evaluasi_psikologi_level')  ) { 
	$konseling = "class='active open'";
	$konseling_nav = "class='collapsed-nav'";
}






if ($act == obraxabrix('usr') || $act == obraxabrix('usr_view') || $act == obraxabrix('chgpwd')) { 
	$utility = "class='active open'";
	$utility_nav = "class='collapsed-nav'";
}

if ( $act == obraxabrix('reminder') ) { 
	$reminder = "class='active open'";
	$reminder_nav = "class='collapsed-nav'";
}

?>

<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="main.php"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="main.php">
					<?php echo $_SESSION["loginname"]; ?>
				</a>
			</li>
		</ul>

	</div>
</div>
<div class="main">
	<div class="navi">
		<ul class='main-nav'>
			<li <?php echo $dashboard ?> >
				<a href="main.php" class='light'>
					<div class="ico"><i class="icon-home icon-white"></i></div>
					Dashboard
					
				</a>
			</li>
			
			<?php if ($_SESSION["adm"] == 1) { ?>
				<li <?php echo $psb ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico"><i class="icon-th-large icon-white"></i></div>
						PSB
						<img src="img/toggle-subnav-down.png" alt="">
					</a>
					<ul <?php echo $psb_nav ?> >
						<li><a href="<?php echo $nama_folder . obraxabrix('registrasi') ?>"><span class="hidden-tablet"> Pendaftaran</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('registrasi_view') ?>"><span class="hidden-tablet"> List Data Pendaftaran</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('prosespenerimaansiswa') ?>"><span class="hidden-tablet"> Proses PSB</span></a></li>
						<li><a href="<?php echo $nama_folder . obraxabrix('kelompokcalonsiswa') ?>"><span class="hidden-tablet"> Kelompok Calon Siswa</span></a></li>
					</ul>
				</li>
				
				<li <?php echo $kesiswaan ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico"><i class="icon-th-large icon-white"></i></div>
						Kesiswaan
						<img src="img/toggle-subnav-down.png" alt="">
					</a>
					<ul <?php echo $kesiswaan_nav ?> >
						<li class="<?php echo $penempatan_active ?>"><a href="<?php echo $nama_folder . obraxabrix('penempatan') ?>"><span class="hidden-tablet"> Penempatan Siswa</span></a></li>
						<li class="<?php echo $pindah_kelas_active ?>"><a href="<?php echo $nama_folder . obraxabrix('pindah_kelas') ?>"><span class="hidden-tablet"> Pindah Kelas</span></a></li>
						<li class="<?php echo $kenaikan_active ?>"><a href="<?php echo $nama_folder . obraxabrix('kenaikan') ?>"><span class="hidden-tablet"> Kenaikan Kelas</span></a></li>
						<li class="<?php echo $kelulusan_active ?>"><a href="<?php echo $nama_folder . obraxabrix('kelulusan') ?>"><span class="hidden-tablet"> Kelulusan</span></a></li>
						<li class="<?php echo $siswa_active ?>"><a href="<?php echo $nama_folder . obraxabrix('siswa') ?>"><span class="hidden-tablet"> Siswa</span></a></li>
						<li class="<?php echo $siswa_list_active ?>"><a href="<?php echo $nama_folder . obraxabrix('siswa_list') ?>"><span class="hidden-tablet"> Daftar Siswa</span></a></li>
						<li class="<?php echo $alumni_list_active ?>"><a href="<?php echo $nama_folder . obraxabrix('alumni_list') ?>"><span class="hidden-tablet"> Daftar Alumni</span></a></li>
						<li class="<?php echo $kelas_active ?>"><a href="<?php echo $nama_folder . obraxabrix('kelas_view') ?>"><span class="hidden-tablet"> Kelas</span></a></li>
						<li class="<?php echo $tingkat_active ?>"><a href="<?php echo $nama_folder . obraxabrix('tingkat_view') ?>"><span class="hidden-tablet"> Level</span></a></li>					
						<li class="<?php echo $departemen_active ?>"><a href="<?php echo $nama_folder . obraxabrix('departemen_view') ?>"><span class="hidden-tablet"> Unit</span></a></li>
						<li class="<?php echo $tahunajaran_active ?>"><a href="<?php echo $nama_folder . obraxabrix('tahunajaran') ?>"><span class="hidden-tablet"> Tahun Ajaran</span></a></li>
						<li class="<?php echo $angkatan_active ?>"><a href="<?php echo $nama_folder . obraxabrix('angkatan_view') ?>"><span class="hidden-tablet"> Angkatan</span></a></li>
						<li class="<?php echo $agama_active ?>"><a href="<?php echo $nama_folder . obraxabrix('agama') ?>"><span class="hidden-tablet"> Agama</span></a></li>
                        <li class="<?php echo $barcode_active ?>"><a href="<?php echo $nama_folder . obraxabrix('barcode') ?>"><span class="hidden-tablet"> Barcode Siswa</span></a></li>
					</ul>
				</li>
				
				
				<li <?php echo $kurikulum ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico"><i class="icon-th-large icon-white"></i></div>
						Kurikulum
						<img src="img/toggle-subnav-down.png" alt="">
					</a>
					<ul <?php echo $kurikulum_nav ?> >
						
						<li><a href="<?php echo $nama_folder . obraxabrix('daftarnilai_view') ?>"><span class="hidden-tablet"> Daftar Nilai</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('rpp_view') ?>"><span class="hidden-tablet"> RPP</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('dasarpenilaian_view') ?>"><span class="hidden-tablet"> Aspek Penilaian</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('jeniskompetensi_view') ?>"><span class="hidden-tablet"> Jenis Kompetensi</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('kompetensi_view') ?>"><span class="hidden-tablet"> Kompetensi</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('siswa_ekstrakurikuler_view') ?>"><span class="hidden-tablet"> Siswa Ekstrakurikuler</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pelajaran_view') ?>"><span class="hidden-tablet"> Mata Pelajaran</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('semester_view') ?>"><span class="hidden-tablet"> Semester</span></a></li>
												
					</ul>
				</li>
				
				
				<li <?php echo $keuangan ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico"><i class="icon-th-large icon-white"></i></div>
						Keuangan
						<img src="img/toggle-subnav-down.png" alt="">
					</a>
					<ul <?php echo $keuangan_nav ?> >
						<li><a href="#" onClick="JavaScript:tambahpenerimaan()" ><span class="hidden-tablet"> Transaksi Penerimaan</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('besarjtt_view') ?>"><span class="hidden-tablet"> Setup Pembayaran</span></a></li>
						<li><a href="<?php echo $nama_folder . obraxabrix('datapengeluaran') ?>"><span class="hidden-tablet"> Jenis Pengeluaran</span></a></li>
						<li><a href="<?php echo $nama_folder . obraxabrix('datapenerimaan') ?>"><span class="hidden-tablet"> Jenis Penerimaan</span></a></li>
						<li><a href="<?php echo $nama_folder . obraxabrix('tahunbuku') ?>"><span class="hidden-tablet"> Tahun Buku</span></a></li>
						<li><a href="<?php echo $nama_folder . obraxabrix('rekakun') ?>"><span class="hidden-tablet"> Rekening Perkiraan</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('rpt_penerimaan') ?>"><span class="hidden-tablet"> Laporan Penerimaan</span></a></li>
						<li><a href="<?php echo $nama_folder . obraxabrix('rpt_lunas') ?>"><span class="hidden-tablet"> Laporan Pelunasan</span></a></li>
						
					</ul>
				</li>
				
				<li <?php echo $perpustakaan ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico"><i class="icon-list icon-white"></i></div>
						Perpustakaan
						<img src="img/toggle-subnav-down.png" alt="">
					</a>
					<ul <?php echo $perpustakaan_nav ?> >
						
						<li><a href="<?php echo $nama_folder . obraxabrix('kembali') ?>"><span class="hidden-tablet"> Pengembalian Buku</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pinjam') ?>"><span class="hidden-tablet"> Peminjaman Buku</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('daftarpustaka') ?>"><span class="hidden-tablet"> Daftar Pustaka</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pustaka') ?>"><span class="hidden-tablet"> Pustaka</span></a></li>
						<li><a href="<?php echo $nama_folder . obraxabrix('anggota') ?>"><span class="hidden-tablet"> Anggota</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('supplier') ?>"><span class="hidden-tablet"> Toko/Supplier</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('penulis') ?>"><span class="hidden-tablet"> Penulis</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('penerbit') ?>"><span class="hidden-tablet"> Penerbit</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('katalog') ?>"><span class="hidden-tablet"> Katalog</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('rak') ?>"><span class="hidden-tablet"> Nama Rak</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('format') ?>"><span class="hidden-tablet"> Format</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('konfigurasi') ?>"><span class="hidden-tablet"> Konfigurasi</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('perpustakaan') ?>"><span class="hidden-tablet"> Nama Perpustakaan</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('rpt_pinjam_telat') ?>"><span class="hidden-tablet"> Lap. Peminjaman Yang Terlambat</span></a></li>
						
					</ul>
				</li>
				
				<li <?php echo $kepegawaian ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico"><i class="icon-th-large icon-white"></i></div>
						Kepegawaian
						<img src="img/toggle-subnav-down.png" alt="">
					</a>
					<ul <?php echo $kepegawaian_nav ?> >
						<li><a href="<?php echo $nama_folder . obraxabrix('kenaikan_gaji_view') ?>"><span class="hidden-tablet"> Kenaikan Gaji Berkala (KGB)</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_skmengajar_view') ?>"><span class="hidden-tablet"> Pegawai SK Mengajar</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_penghargaan_view') ?>"><span class="hidden-tablet"> Pegawai Penghargaan Yayasan</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_prestasi_view') ?>"><span class="hidden-tablet"> Pegawai Prestasi</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_keluarga_view') ?>"><span class="hidden-tablet"> Pegawai Keluarga</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_pendidikan_view') ?>"><span class="hidden-tablet"> Pegawai Pendidikan</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_pangkat_view') ?>"><span class="hidden-tablet"> Pegawai Pangkat</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_jabatan_view') ?>"><span class="hidden-tablet"> Pegawai Jabatan</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pegawai') ?>"><span class="hidden-tablet"> Pegawai</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('status_pegawai') ?>"><span class="hidden-tablet"> Status Pegawai</span></a></li>
					
						<li><a href="<?php echo $nama_folder . obraxabrix('jenis_sertifikasi') ?>"><span class="hidden-tablet"> Jenis Sertifikasi</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('pangkat') ?>"><span class="hidden-tablet"> Pangkat</span></a></li>	
						<li><a href="<?php echo $nama_folder . obraxabrix('jabatan') ?>"><span class="hidden-tablet"> Jabatan</span></a></li>
						<li><a href="<?php echo $nama_folder . obraxabrix('statusguru') ?>"><span class="hidden-tablet"> Status Guru</span></a></li>
						
					</ul>
				</li>
				
				
				<li <?php echo $presensi ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico"><i class="icon-list icon-white"></i></div>
						Presensi
						<img src="img/toggle-subnav-down.png" alt="">
					</a>
					<ul <?php echo $presensi_nav ?> >
						<li class="<?php echo $presensi_harian_siswa_active ?>"><a href="#" onClick="JavaScript:presensi_harian_siswa()" ><span class="hidden-tablet"> Presensi Harian Siswa</span></a></li>
						
						<li class="<?php echo $presensi_absen_siswa_active ?>"><a href="#" onClick="JavaScript:presensi_absen_siswa()" ><span class="hidden-tablet"> Presensi Absen Siswa</span></a></li>
						
						<li class="<?php echo $presensi_ukbm_active ?>"><a href="<?php echo $nama_folder . obraxabrix('presensi_ukbm') ?>"><span class="hidden-tablet"> Presensi Mapel</span></a></li>
						
						<li class="<?php echo $presensi_harian_siswa_active ?>"><a href="#" onClick="JavaScript:presensi_general()" ><span class="hidden-tablet"> Presensi Harian Guru</span></a></li>
						
						<li class="<?php echo $rpt_presensi_harian_siswa_active ?>"><a href="<?php echo $nama_folder . obraxabrix('rpt_presensi_harian_siswa') ?>"><span class="hidden-tablet"> Lap. Presensi Harian Siswa</span></a></li>						
						
					</ul>
				</li>
				
				
				<li <?php echo $konseling ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico"><i class="icon-th-large icon-white"></i></div>
						BK (Bimb. Konseling)
						<img src="img/toggle-subnav-down.png" alt="">
					</a>
					<ul <?php echo $konseling_nav ?> >
						<li><a href="<?php echo $nama_folder . obraxabrix('assesmen_observasi_view') ?>"><span class="hidden-tablet"> Assesmen dan Observasi</span></a></li>
						
						<li><a href="<?php echo $nama_folder . obraxabrix('konseling_siswa') ?>"><span class="hidden-tablet"> Konseling Siswa</span></a></li>
						<li><a href="<?php echo $nama_folder . obraxabrix('pelanggaran_siswa') ?>"><span class="hidden-tablet"> Pelanggaran Siswa</span></a></li>
                        <!--<li><a href="<?php echo $nama_folder . obraxabrix('izin_siswa') ?>"><span class="hidden-tablet"> Izin Siswa</span></a></li>-->
                        <li><a href="<?php echo $nama_folder . obraxabrix('evaluasi_psikologi') ?>"><span class="hidden-tablet"> Evaluasi Psikologi</span></a></li>
                        <li><a href="<?php echo $nama_folder . obraxabrix('aspek_psikologi_detail') ?>"><span class="hidden-tablet"> Aspek Psikologi Detail</span></a></li>
                        <li><a href="<?php echo $nama_folder . obraxabrix('aspek_psikologi') ?>"><span class="hidden-tablet"> Jenis Aspek Psikologi</span></a></li>
                        <li><a href="<?php echo $nama_folder . obraxabrix('aspek_perkembangan') ?>"><span class="hidden-tablet"> Aspek Perkembangan</span></a></li>
                                                
                        <!--<li><a href="<?php echo $nama_folder . obraxabrix('jenis_izin') ?>"><span class="hidden-tablet"> Jenis Izin Siswa</span></a></li>-->
						<li><a href="<?php echo $nama_folder . obraxabrix('jenis_pelanggaran') ?>"><span class="hidden-tablet"> Jenis Pelanggaran</span></a></li>
						<li><a href="<?php echo $nama_folder . obraxabrix('jenis_prestasi') ?>"><span class="hidden-tablet"> Jenis Prestasi</span></a></li>		
                        <li><a href="<?php echo $nama_folder . obraxabrix('rpt_konseling_siswa') ?>"><span class="hidden-tablet"> Lap. Konseling Siswa</span></a></li>				
						<li><a href="<?php echo $nama_folder . obraxabrix('rpt_izin_siswa') ?>"><span class="hidden-tablet"> Lap. Izin Siswa</span></a></li>
						<li><a href="<?php echo $nama_folder . obraxabrix('rpt_evaluasi_psikologi_level') ?>"><span class="hidden-tablet"> Laporan Evaluasi Psikologi per Level</span></a></li>
						
					</ul>
				</li>
				
				<li <?php echo $report ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico"><i class="icon-book icon-white"></i></div>
						Report
						<img src="img/toggle-subnav-down.png" alt="">
					</a>
					
				</li>
				
				<li <?php echo $utility ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico"><i class="icon-list icon-white"></i></div>
						Utility
						<img src="img/toggle-subnav-down.png" alt="">
					</a>
					<ul <?php echo $utility_nav ?> >
						<li><a href="<?php echo $nama_folder . obraxabrix('usr') ?>"><span class="hidden-tablet"> User</span></a></li>
						
						<li><a href="app/backup.php" target="_blank"><span class="hidden-tablet"> Backup Database</span></a></li>
						
					</ul>
				</li>
				
				<li <?php echo $reminder ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico">
							<i class="icon-list icon-white"></i></div>
						Data Dashboard
						<img src="img/toggle-subnav-down.png" alt="">
					</a>
					<ul <?php echo $reminder_nav ?> >
						<li>
							<a href="<?php echo $nama_folder . obraxabrix('usr_reminder') ?>">
								<span class="hidden-tablet"> Reminder</span></a></li>

					</ul>
				</li>
				
				<li <?php echo $utility ?> >
					<a href="#" class='light toggle-collapsed'>
						<div class="ico"><i class="icon-book icon-white"></i></div>
							Upload/Download Data
							<img src="img/toggle-subnav-down.png" alt="">
					</a>
					<ul <?php echo $utility_nav ?> >
						<li class="<?php echo $import_siswa ?>">
							<a href="#" onClick="JavaScript:import_siswa()" >
								<span class="hidden-tablet">Download/Upload Siswa</span></a>
						</li>

					</ul>
				</li>
			
			
			<!----non admnistrator-------\/----->	
			<?php } else { 
			
				include_once("menu_user.php");
				
			} ?>
			
			
		</ul>
	</div>