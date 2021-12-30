<?php
$sql=$select_view->list_pinjam('', '', '', '', '1');
$rowspinjam = $sql->rowCount();

$sql=$select_view->list_pinjam_telat('', '', '', '', '1');
$rowstelat = $sql->rowCount();

?>

<div class="topbar clearfix">
	<div class="container-fluid">
		<a href="main.php" class='company'>Sistem Informasi Manajemen Sekolah</a>
		<!--<form action="#">
			<input type="text" value="Search here...">
		</form> -->
		<ul class='mini'>
			
			<?php if($rowstelat > 0) { ?>
				<li class='dropdown pendingContainer'>
					<a href="<?php echo $nama_folder . obraxabrix('rpt_pinjam_telat') ?>" >
						<img src="img/icons/fugue/document-task.png" alt="">
						Peminjaman Terlambat
						<span class="label label-important"><?php echo $rowstelat ?></span>
					</a>
					
					
				</li>
			<?php } ?>
			
			<?php if ($rowspinjam > 0) { ?>
				<li class='dropdown messageContainer'>
					<a href="<?php echo $nama_folder . obraxabrix('rpt_pinjam') ?>" >
						Peminjaman
						<span class="label label-info"><?php echo $rowspinjam ?></span>					
					</a>
				</li>
			<?php } ?>
			
			<li>
				<a href="<?php echo $nama_folder . obraxabrix('chgpwd') ?>">
					<img src="img/icons/fugue/gear.png" alt="">
					Ganti Password
				</a>
			</li>
			<li>
				<a href="logout.php">
					<img src="img/icons/fugue/control-power.png" alt="">
					Logout
				</a>
			</li>
		</ul>
	</div>
</div>