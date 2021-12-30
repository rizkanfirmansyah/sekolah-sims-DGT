<?php if ( allow("frmregistrasi")==1 || allow("frmregistrasiview")==1 || allow("frmproses")==1 || allow("frmkelompok")==1 ) { ?>
	<li <?php echo $psb ?> >
		<a href="#" class='light toggle-collapsed'>
			<div class="ico"><i class="icon-th-large icon-white"></i></div>
			PSB
			<img src="img/toggle-subnav-down.png" alt="">
		</a>
		<ul <?php echo $psb_nav ?> >
			<?php if ( allow("frmregistrasi")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('registrasi') ?>"><span class="hidden-tablet"> Pendaftaran</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmregistrasiview")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('registrasi_view') ?>"><span class="hidden-tablet"> List Data Pendaftaran</span></a></li>
			<?php } ?>
		
			<?php if ( allow("frmproses")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('prosespenerimaansiswa') ?>"><span class="hidden-tablet"> Proses PSB</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmkelompok")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('kelompokcalonsiswa') ?>"><span class="hidden-tablet"> Kelompok Calon Siswa</span></a></li>
			<?php } ?>
		</ul>
	</li>
<?php } ?>

<?php if ( allow("frmsiswa")==1 || allow("frmsiswa_list")==1 || allow("frmkelas")==1 || allow("frmtingkat")==1 || allow("frmtahunajaran")==1 || allow("frmagama")==1 || allow("kenaikan")==1 || allow("penempatan")==1 || allow("barcode")==1 || allow("frmdepartemen")==1 || allow("frmangkatan")==1 || allow("kelulusan")==1 || allow("alumni_list")==1 || allow("pindah_kelas")==1 ) { ?>
	<li <?php echo $kesiswaan ?> >
		<a href="#" class='light toggle-collapsed'>
			<div class="ico"><i class="icon-th-large icon-white"></i></div>
			Kesiswaan
			<img src="img/toggle-subnav-down.png" alt="">
		</a>
		<ul <?php echo $kesiswaan_nav ?> >
			
			<?php if ( allow("penempatan")==1 ) { ?>
				<li class="<?php echo $penempatan_active ?>"><a href="<?php echo $nama_folder . obraxabrix('penempatan') ?>"><span class="hidden-tablet"> Penempatan Siswa</span></a></li>
			<?php } ?>
			
			<?php if ( allow("pindah_kelas")==1 ) { ?>
				<li class="<?php echo $pindah_kelas_active ?>"><a href="<?php echo $nama_folder . obraxabrix('pindah_kelas') ?>"><span class="hidden-tablet"> Pindah Kelas</span></a></li>
			<?php } ?>
			
			<?php if ( allow("kenaikan")==1 ) { ?>
				<li class="<?php echo $kenaikan_active ?>"><a href="<?php echo $nama_folder . obraxabrix('kenaikan') ?>"><span class="hidden-tablet"> Kenaikan Kelas</span></a></li>
			<?php } ?>
			
			<?php if ( allow("kelulusan")==1 ) { ?>
				<li class="<?php echo $kelulusan_active ?>"><a href="<?php echo $nama_folder . obraxabrix('kelulusan') ?>"><span class="hidden-tablet"> Kelulusan</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmsiswa")==1 ) { ?>
				<li class="<?php echo $siswa_active ?>"><a href="<?php echo $nama_folder . obraxabrix('siswa') ?>"><span class="hidden-tablet"> Siswa</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmsiswa_list")==1 ) { ?>
				<li class="<?php echo $alumni_list_active ?>"><a href="<?php echo $nama_folder . obraxabrix('siswa_list') ?>"><span class="hidden-tablet"> Daftar Siswa</span></a></li>
			<?php } ?>
			
			<?php if ( allow("alumni_list")==1 ) { ?>
				<li class="<?php echo $alumni_list_active ?>"><a href="<?php echo $nama_folder . obraxabrix('alumni_list') ?>"><span class="hidden-tablet"> Daftar Alumni</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmkelas")==1 ) { ?>							
				<li class="<?php echo $kelas_active ?>"><a href="<?php echo $nama_folder . obraxabrix('kelas_view') ?>"><span class="hidden-tablet"> Kelas</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmtingkat")==1 ) { ?>
				<li class="<?php echo $tingkat_active ?>"><a href="<?php echo $nama_folder . obraxabrix('tingkat_view') ?>"><span class="hidden-tablet"> Level</span></a></li>					
			<?php } ?>
			
			<?php if ( allow("frmdepartemen")==1 ) { ?>
				<li class="<?php echo $departemen_active ?>"><a href="<?php echo $nama_folder . obraxabrix('departemen_view') ?>"><span class="hidden-tablet"> Unit</span></a></li>					
			<?php } ?>
			
			<?php if ( allow("frmtahunajaran")==1 ) { ?>
				<li class="<?php echo $tahunajaran_active ?>"><a href="<?php echo $nama_folder . obraxabrix('tahunajaran') ?>"><span class="hidden-tablet"> Tahun Ajaran</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmangkatan")==1 ) { ?>
				<li class="<?php echo $angkatan_active ?>"><a href="<?php echo $nama_folder . obraxabrix('angkatan_view') ?>"><span class="hidden-tablet"> Angkatan</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmagama")==1 ) { ?>
				<li class="<?php echo $agama_active ?>"><a href="<?php echo $nama_folder . obraxabrix('agama') ?>"><span class="hidden-tablet"> Agama</span></a></li>
			<?php } ?>
            
            <?php if ( allow("barcode")==1 ) { ?>
				<li class="<?php echo $barcode_active ?>"><a href="<?php echo $nama_folder . obraxabrix('barcode') ?>"><span class="hidden-tablet"> Barcode Siswa</span></a></li>
			<?php } ?>
            
		</ul>
	</li>
<?php } ?>


<?php if ( allow("frmpelajaran")==1 || allow("frmsiswa_ekstrakurikuler")==1 || allow("frmsemester")==1 || allow("frmrpp")==1 || allow("frmkompetensi")==1 || allow("frmdasarpenilaian")==1 || allow("frmjeniskompetensi")==1 || allow("frmdaftarnilai")==1 ) { ?>
	<li <?php echo $kurikulum ?> >
		<a href="#" class='light toggle-collapsed'>
			<div class="ico"><i class="icon-th-large icon-white"></i></div>
			Kurikulum
			<img src="img/toggle-subnav-down.png" alt="">
		</a>
		<ul <?php echo $kurikulum_nav ?> >
			
			<?php if ( allow("frmdaftarnilai")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('daftarnilai_view') ?>"><span class="hidden-tablet"> Daftar Nilai</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmrpp")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('rpp_view') ?>"><span class="hidden-tablet"> RPP</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmdasarpenilaian")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('dasarpenilaian_view') ?>"><span class="hidden-tablet"> Aspek Penilaian</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmjeniskompetensi")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('jeniskompetensi_view') ?>"><span class="hidden-tablet"> Jenis Kompetensi</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmkompetensi")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('kompetensi_view') ?>"><span class="hidden-tablet"> Kompetensi</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmsiswa_ekstrakurikuler")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('siswa_ekstrakurikuler_view') ?>"><span class="hidden-tablet"> Siswa Ekstrakurikuler</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpelajaran")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pelajaran_view') ?>"><span class="hidden-tablet"> Mata Pelajaran</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmsemester")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('semester_view') ?>"><span class="hidden-tablet"> Semester</span></a></li>
			<?php } ?>
			
			
		</ul>
	</li>
<?php } ?>



<?php if ( allow("frmtahunbuku")==1 || allow("frmrekakun")==1 || allow("frmdatapenerimaan")==1 || allow("frmdatapengeluaran")==1 || allow("frmbesarjtt")==1 || allow("frmpenerimaanjtt")==1 || allow("rpt_penerimaan")==1 || allow("rpt_lunas")==1  ) { ?>
	<li <?php echo $keuangan ?> >
		<a href="#" class='light toggle-collapsed'>
			<div class="ico"><i class="icon-th-large icon-white"></i></div>
			Keuangan
			<img src="img/toggle-subnav-down.png" alt="">
		</a>
		<ul <?php echo $keuangan_nav ?> >
			<?php if ( allow("frmpenerimaanjtt")==1 ) { ?>
				<li><a href="#" onClick="JavaScript:tambahpenerimaan()" ><span class="hidden-tablet"> Transaksi Penerimaan</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmbesarjtt")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('besarjtt_view') ?>"><span class="hidden-tablet"> Setup Pembayaran</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmdatapengeluaran")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('datapengeluaran') ?>"><span class="hidden-tablet"> Jenis Pengeluaran</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmdatapenerimaan")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('datapenerimaan') ?>"><span class="hidden-tablet"> Jenis Penerimaan</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmtahunbuku")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('tahunbuku') ?>"><span class="hidden-tablet"> Tahun Buku</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmtrekakun")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('rekakun') ?>"><span class="hidden-tablet"> Rekening Perkiraan</span></a></li>
			<?php } ?>
			
			<?php if ( allow("rpt_penerimaan")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('rpt_penerimaan') ?>"><span class="hidden-tablet"> Laporan Penerimaan</span></a></li>
			<?php } ?>
			
			<?php if ( allow("rpt_lunas")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('rpt_lunas') ?>"><span class="hidden-tablet"> Laporan Pelunasan</span></a></li>
			<?php } ?>
			
			
		</ul>
	</li>
<?php } ?>

<?php if ( allow("frmperpustakaan")==1 || allow("frmformat")==1 || allow("frmrak")==1 || allow("frmkatalog")==1 || allow("frmpenerbit")==1 || allow("frmpenulis")==1 || allow("frmpustaka")==1 || allow("frmpinjam")==1 || allow("frmkembali")==1 || allow("rpt_pinjam_telat")==1 || allow("frmkonfigurasi")==1 || allow("frmsupplier")==1 || allow("frmanggota")==1 || allow("frmdaftarpustaka")==1 ) { ?>
	<li <?php echo $perpustakaan ?> >
		<a href="#" class='light toggle-collapsed'>
			<div class="ico"><i class="icon-list icon-white"></i></div>
			Perpustakaan
			<img src="img/toggle-subnav-down.png" alt="">
		</a>
		<ul <?php echo $perpustakaan_nav ?> >
			<?php if ( allow("frmkembali")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('kembali') ?>"><span class="hidden-tablet"> Pengembalian Buku</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpinjam")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pinjam') ?>"><span class="hidden-tablet"> Peminjaman Buku</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmanggota")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('anggota') ?>"><span class="hidden-tablet"> Anggota</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmdaftarpustaka")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('daftarpustaka') ?>"><span class="hidden-tablet"> Daftar Pustaka</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpustaka")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pustaka') ?>"><span class="hidden-tablet"> Pustaka</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmsupplier")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('supplier') ?>"><span class="hidden-tablet"> Toko/Supplier</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpenulis")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('penulis') ?>"><span class="hidden-tablet"> Penulis</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpenerbit")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('penerbit') ?>"><span class="hidden-tablet"> Penerbit</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmkatalog")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('katalog') ?>"><span class="hidden-tablet"> Katalog</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmrak")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('rak') ?>"><span class="hidden-tablet"> Nama Rak</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmformat")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('format') ?>"><span class="hidden-tablet"> Format</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmkonfigurasi")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('konfigurasi') ?>"><span class="hidden-tablet"> Konfigurasi</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmperpustakaan")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('perpustakaan') ?>"><span class="hidden-tablet"> Nama Perpustakaan</span></a></li>
			<?php } ?>
			
			<?php if ( allow("rpt_pinjam_telat")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('rpt_pinjam_telat') ?>"><span class="hidden-tablet"> Lap. Peminjaman Yang Terlambat</span></a></li>
			<?php } ?>
			
		</ul>
	</li>
<?php } ?>


<?php if ( allow("frmpegawai")==1 || allow("frmstatusguru")==1 || allow("pegawai_jabatan")==1 || allow("frmjabatan")==1 || allow("frmpangkat")==1 || allow("frmpegawai_pangkat")==1 || allow("frmjenis_sertifikasi")==1 || allow("frmstatus_pegawai")==1 || allow("frmkenaikan_gaji")==1 || allow("frmpegawai_pendidikan")==1 || allow("frmpegawai_keluarga")==1 || allow("frmpegawai_prestasi")==1 || allow("frmpegawai_skmengajar")==1 ) { ?>
	<li <?php echo $kepegawaian ?> >
		<a href="#" class='light toggle-collapsed'>
			<div class="ico"><i class="icon-list icon-white"></i></div>
			Kepegawaian
			<img src="img/toggle-subnav-down.png" alt="">
		</a>
		<ul <?php echo $kepegawaian_nav ?> >
			<?php if ( allow("frmkenaikan_gaji")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('kenaikan_gaji_view') ?>"><span class="hidden-tablet"> Kenaikan Gaji Berkala (KGB)</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpegawai_skmengajar")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_skmengajar_view') ?>"><span class="hidden-tablet"> Pegawai SK Mengajar</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpegawai_penghargaan")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_penghargaan_view') ?>"><span class="hidden-tablet"> Pegawai Penghargaan Yayasan</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpegawai_prestasi")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_prestasi_view') ?>"><span class="hidden-tablet"> Pegawai Prestasi</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpegawai_keluarga")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_keluarga_view') ?>"><span class="hidden-tablet"> Pegawai Keluarga</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpegawai_pendidikan")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_pendidikan_view') ?>"><span class="hidden-tablet"> Pegawai Pendidikan</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpegawai_pangkat")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_pangkat_view') ?>"><span class="hidden-tablet"> Pegawai Pangkat</span></a></li>
			<?php } ?>
			
			<?php if ( allow("pegawai_jabatan")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pegawai_jabatan_view') ?>"><span class="hidden-tablet"> Pegawai Jabatan</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpegawai")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pegawai') ?>"><span class="hidden-tablet"> Pegawai</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmstatus_pegawai")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('status_pegawai') ?>"><span class="hidden-tablet"> Status Pegawai</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmjenis_sertifikasi")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('jenis_sertifikasi') ?>"><span class="hidden-tablet"> Jenis Sertifikasi</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpangkat")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pangkat') ?>"><span class="hidden-tablet"> Pangkat</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmjabatan")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('jabatan') ?>"><span class="hidden-tablet"> Jabatan</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmstatusguru")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('statusguru') ?>"><span class="hidden-tablet"> Status Guru</span></a></li>
			<?php } ?>
		</ul>
	</li>
<?php } ?>



<?php if ( allow("presensi_harian_siswa")==1 || allow("rpt_presensi_harian_siswa")==1 || allow("presensi_absen_siswa")==1 ) { ?>
	<li <?php echo $presensi ?> >
		<a href="#" class='light toggle-collapsed'>
			<div class="ico"><i class="icon-list icon-white"></i></div>
			Presensi
			<img src="img/toggle-subnav-down.png" alt="">
		</a>
		<ul <?php echo $presensi_nav ?> >
			<?php if ( allow("presensi_harian_siswa")==1 ) { ?>
				<li class="<?php echo $presensi_harian_siswa_active ?>"><a href="#" onClick="JavaScript:presensi_harian_siswa()" ><span class="hidden-tablet"> Presensi Harian Siswa</span></a></li>
			<?php } ?>			
			
			<?php if ( allow("presensi_absen_siswa")==1 ) { ?>
				<li class="<?php echo $presensi_absen_siswa_active ?>"><a href="#" onClick="JavaScript:presensi_absen_siswa()" ><span class="hidden-tablet"> Presensi Absen Siswa</span></a></li>
			<?php } ?>
			
			<?php if ( allow("rpt_presensi_harian_siswa")==1 ) { ?>
				<li class="<?php echo $rpt_presensi_harian_siswa_active ?>"><a href="<?php echo $nama_folder . obraxabrix('rpt_presensi_harian_siswa') ?>"><span class="hidden-tablet"> Lap. Presensi Harian Siswa</span></a></li>
			<?php } ?>
						
		</ul>
	</li>
<?php } ?>



<?php if ( allow("frmjenis_pelanggaran")==1 || allow("frmjenis_prestasi")==1 || allow("frmpelanggaran_siswa")==1 || allow("frmkonseling_siswa")==1 || allow("frmjenis_izin")==1 || allow("frmizin_siswa")==1 || allow("rpt_izin_siswa")==1 || allow("rpt_konseling_siswa")==1 || allow("frmaspek_perkembangan")==1 || allow("frmassesmen_observasi")==1 || allow("frmaspek_psikologi")==1 || allow("frmaspek_psikologi_detail")==1 || allow("frmevaluasi_psikologi")==1 || allow("rpt_evaluasi_psikologi_level")==1 ) { ?>
	<li <?php echo $konseling ?> >
		<a href="#" class='light toggle-collapsed'>
			<div class="ico"><i class="icon-list icon-white"></i></div>
			BK (Bimb. Konseling)
			<img src="img/toggle-subnav-down.png" alt="">
		</a>
		<ul <?php echo $konseling_nav ?> >
			
			<?php if ( allow("frmassesmen_observasi")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('assesmen_observasi_view') ?>"><span class="hidden-tablet"> Assesmen dan Observasi</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmkonseling_siswa")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('konseling_siswa') ?>"><span class="hidden-tablet"> Konseling Siswa</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmpelanggaran_siswa")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('pelanggaran_siswa') ?>"><span class="hidden-tablet"> Pelanggaran Siswa</span></a></li>
			<?php } ?>
			
            <?php /* if ( allow("frmizin_siswa")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('izin_siswa') ?>"><span class="hidden-tablet"> Izin Siswa</span></a></li>
			<?php }*/ ?>
            
            <?php if ( allow("frmevaluasi_psikologi")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('evaluasi_psikologi') ?>"><span class="hidden-tablet"> Evaluasi Psikologi</span></a></li>
			<?php } ?>
			
            <?php if ( allow("frmaspek_psikologi_detail")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('aspek_psikologi_detail') ?>"><span class="hidden-tablet"> Aspek Psikologi Detail</span></a></li>
			<?php } ?>
			
            <?php if ( allow("frmaspek_psikologi")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('aspek_psikologi') ?>"><span class="hidden-tablet"> Jenis Aspek Psikologi</span></a></li>
			<?php } ?>
			
            <?php if ( allow("frmaspek_perkembangan")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('aspek_perkembangan') ?>"><span class="hidden-tablet"> Aspek Perkembangan</span></a></li>
			<?php } ?>
			
            <?php /*if ( allow("frmjenis_izin")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('jenis_izin') ?>"><span class="hidden-tablet"> Jenis Izin Siswa</span></a></li>
			<?php } */ ?>
            
			<?php if ( allow("frmjenis_pelanggaran")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('jenis_pelanggaran') ?>"><span class="hidden-tablet"> Jenis Pelanggaran</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmjenis_prestasi")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('jenis_prestasi') ?>"><span class="hidden-tablet"> Jenis Prestasi</span></a></li>
			<?php } ?>
            
            <?php if ( allow("rpt_konseling_siswa")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('rpt_konseling_siswa') ?>"><span class="hidden-tablet"> Lap. Konseling Siswa</span></a></li>
			<?php } ?>
            
            <?php if ( allow("rpt_izin_siswa")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('rpt_izin_siswa') ?>"><span class="hidden-tablet"> Lap. Izin Siswa</span></a></li>
			<?php } ?>
			
			<?php if ( allow("rpt_evaluasi_psikologi_level")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('rpt_evaluasi_psikologi_level') ?>"><span class="hidden-tablet"> Laporan Evaluasi Psikologi per Level</span></a></li>
			<?php } ?>
            
			
		</ul>
	</li>
<?php } ?>


<li <?php echo $report ?> >
	<a href="#" class='light toggle-collapsed'>
		<div class="ico"><i class="icon-book icon-white"></i></div>
		Report
		<img src="img/toggle-subnav-down.png" alt="">
	</a>
	
</li>

<?php if ( allow("frmusr")==1 || allow("backup")==1 ) { ?>
	<li <?php echo $utility ?> >
		<a href="#" class='light toggle-collapsed'>
			<div class="ico"><i class="icon-list icon-white"></i></div>
			Utility
			<img src="img/toggle-subnav-down.png" alt="">
		</a>
		<ul <?php echo $utility_nav ?> >
			
			<?php if ( allow("frmusr")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('usr') ?>"><span class="hidden-tablet"> User</span></a></li>
			<?php } ?>
			
			<?php if ( allow("backup")==1 ) { ?>
				<li><a href="app/backup.php" target="_blank"><span class="hidden-tablet"> Backup Database</span></a></li>
			<?php } ?>
			
		</ul>
	</li>
<?php } ?>