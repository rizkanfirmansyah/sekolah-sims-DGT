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

<?php if ( allow("frmsiswa")==1 || allow("frmkelas")==1 || allow("frmtingkat")==1 || allow("frmtahunajaran")==1 || allow("frmagama")==1 ) { ?>
	<li <?php echo $kesiswaan ?> >
		<a href="#" class='light toggle-collapsed'>
			<div class="ico"><i class="icon-th-large icon-white"></i></div>
			Kesiswaan
			<img src="img/toggle-subnav-down.png" alt="">
		</a>
		<ul <?php echo $kesiswaan_nav ?> >
		
			<?php if ( allow("frmsiswa")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('siswa') ?>"><span class="hidden-tablet"> Siswa</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmkelas")==1 ) { ?>							
				<li><a href="<?php echo $nama_folder . obraxabrix('kelas') ?>"><span class="hidden-tablet"> Kelas</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmtingkat")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('tingkat') ?>"><span class="hidden-tablet"> Tingkat</span></a></li>					
			<?php } ?>
			
			<?php if ( allow("frmtahunajaran")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('tahunajaran') ?>"><span class="hidden-tablet"> Tahun Ajaran</span></a></li>
			<?php } ?>
			
			<?php if ( allow("frmagama")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('agama') ?>"><span class="hidden-tablet"> Agama</span></a></li>
			<?php } ?>
		</ul>
	</li>
<?php } ?>


<?php if ( allow("frmtahunbuku")==1 ) { ?>
	<li <?php echo $keuangan ?> >
		<a href="#" class='light toggle-collapsed'>
			<div class="ico"><i class="icon-th-large icon-white"></i></div>
			Keuangan
			<img src="img/toggle-subnav-down.png" alt="">
		</a>
		<ul <?php echo $keuangan_nav ?> >
		
			<?php if ( allow("frmtahunbuku")==1 ) { ?>
				<li><a href="<?php echo $nama_folder . obraxabrix('tahunbuku') ?>"><span class="hidden-tablet"> Tahun Buku</span></a></li>
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

<?php if ( allow("frmusr")==1 ) { ?>
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
		</ul>
	</li>
<?php } ?>