<?php

class update{
	
	//------update user
	function update_usr($ref,$photo){
		$dbpdo = DB::create();
		
		try {
			
			$usrid		=	$_POST["usrid"];
			$old_usrid	=	$_POST["old_usrid"];				
			$pass_ori	=	$_POST["pwd"];
			$pwd		=	obraxabrix($pass_ori, $usrid);
			$adm		=	(empty($_POST["adm"])) ? 0 : $_POST["adm"];
			$employee_id=	(empty($_POST["employee_id"])) ? 0 : $_POST["employee_id"];
			$lvl		=	$_POST["lvl"];
			//$image		=	$_POST["image"];
			$brncde		=	$_POST["brncde"];
			$image2		=	$_POST["image2"];
			$departemen	=	$_POST["departemen"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			$act		=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			
			//-----------upload file
		  	/*$photo2	= $_POST["photo2"];
			$uploaddir_photo = 'app/photo_usr/';
			$photo		= $_FILES['photo']['name']; 
			$tmpname_photo 	= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
					
				if($photo != $photo2) {
					
					if(!empty($photo2)) {
						unlink($uploaddir_photo . $photo2); //remove file 
					}
					
					$photo = $usrid . '_' . $photo;
				}
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	*/
			//----------------
			
			if ($_POST["pwd"]=='') {		
				
				$sqlstr = "update usr set usrid='$usrid',adm='$adm', departemen='$departemen', act='$act',uid='$uid',dlu='$dlu' where id='$ref' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			
			} else {
				
				$sqlstr = "update usr set usrid='$usrid',pwd='$pwd',adm='$adm', departemen='$departemen', act='$act',uid='$uid',dlu='$dlu' where id='$ref' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			//----------insert user detail
			$usr_jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=1; $i<=$usr_jmldata; $i++) {
				$usr_slc = (empty($_POST[usr_slc_.$i])) ? 0 : $_POST[usr_slc_.$i];
				$usr_old = (empty($_POST[usr_old_.$i])) ? 0 : $_POST[usr_old_.$i];
				
				$usr_frmcde = $_POST[usr_frmcde_.$i];
				$usr_add = (empty($_POST[usr_add_.$i])) ? 0 : $_POST[usr_add_.$i];
				$usr_edt = (empty($_POST[usr_edt_.$i])) ? 0 : $_POST[usr_edt_.$i];
				$usr_dlt = (empty($_POST[usr_dlt_.$i])) ? 0 : $_POST[usr_dlt_.$i];
				$usr_lvl = (empty($_POST[usr_lvl_.$i])) ? 0 : $_POST[usr_lvl_.$i];
				
				if ($usr_old==1) {
					if ($usr_slc==1) {
						$sqlstr = "update usr_dtl set usrid='$usrid', madd=$usr_add, medt=$usr_edt, mdel=$usr_dlt, lvl=$usr_lvl where usrid='$old_usrid' and frmcde='$usr_frmcde' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$sqlstr = "delete from usr_dtl where usrid='$old_usrid' and frmcde='$usr_frmcde' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}	
				} 
				
				
				if ($usr_old==0) {
				
					if ($usr_slc==1) {			
						$sqlstr = "insert into usr_dtl
						(usrid, frmcde, madd, medt, mdel, lvl)
							values
							(
								'".$usrid."',
								'".$usr_frmcde."',
								".$usr_add.",
								".$usr_edt.",
								".$usr_dlt.",
								'".$usr_lvl."'
							)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
					}
				}
				
			}
				
			//-------update user backup
			if ($_POST["pwd"]=='') {		
				$sqlstr = "update usr_bup set usrid='$usrid' where usrid='$old_usrid' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr = "update usr_bup set usrid='$usrid',pwd='$_POST[pwd]' where usrid='$old_usrid' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//------update registrasi
	function update_registrasi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
            $departemen         =   $_POST["departemen"];
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$idproses			=	$_POST["idproses"];
			$idkelompok			=	$_POST["idkelompok"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idtingkat			=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idjurusan			=	(empty($_POST["idjurusan"])) ? 0 : $_POST["idjurusan"];
			$nama				=	petikreplace($_POST["nama"]);
			$panggilan			=	$_POST["panggilan"];
			$kelamin			=	$_POST["kelamin"];
			$nisn				=	$_POST["nisn"];
			$nis				=	$_POST["nis"];
			$noijazah			=	$_POST["noijazah"];
			$tahunijazah		=	(empty($_POST["tahunijazah"])) ? 0 : $_POST["tahunijazah"];
			$skhun				=	$_POST["skhun"];
			$tahunskhun			=	(empty($_POST["tahunskhun"])) ? 0 : $_POST["tahunskhun"];
			$noujian			=	$_POST["noujian"];
			$nik				=	$_POST["nik"];
			$tmplahir			=	$_POST["tmplahir"];
			$tgllahir			=	date("Y-m-d", strtotime($_POST["tgllahir"]));
			$agama				=	$_POST["agama"];
			$kebutuhan_khusus	=	petikreplace($_POST["kebutuhan_khusus"]);
			$kebutuhan_khusus_chk = $_POST["kebutuhan_khusus_chk"];
			if($kebutuhan_khusus_chk == 2) {
				$kebutuhan_khusus = "";
			}
			$alamatsiswa		=	$_POST["alamatsiswa"];
			$dusun				=	$_POST["dusun"];
			$rt					=	$_POST["rt"];
			$rw					=	$_POST["rw"];
			$kelurahan			=	$_POST["kelurahan"];
			$kodepossiswa		=	$_POST["kodepossiswa"];
			$kecamatan			=	$_POST["kecamatan"];
			$kabupaten			=	$_POST["kabupaten"];
			$provinsi			=	$_POST["provinsi"];
			$transportasi		=	$_POST["transportasi"];
			$transportasi_kode	=	$_POST["transportasi_kode"];
			$citacita			=	$_POST["citacita"];
			$citacita_lain		=	$_POST["citacita_lain"];
			$jenis_tinggal		=	$_POST["jenis_tinggal"];
			$telponsiswa		=	$_POST["telponsiswa"];
			$hpsiswa			=	$_POST["hpsiswa"];
			$emailsiswa			=	$_POST["emailsiswa"];
			$kps				=	(empty($_POST["kps"])) ? 0 : $_POST["kps"];
			$nokps				=	$_POST["nokps"];
			$nokip				=	$_POST["nokip"];
			$nokks				=	$_POST["nokks"];
			$namaayah			=	$_POST["namaayah"];
			$alamatortu			=	petikreplace($_POST["alamatortu"]);
			$kodeposortu		=	$_POST["kodeposortu"];
			$hportu				=	$_POST["hportu"];
			$tahunayah			=	(empty($_POST["tahunayah"])) ? 0 : $_POST["tahunayah"];
			$butuhkhususayah	=	(empty($_POST["butuhkhususayah"])) ? 0 : $_POST["butuhkhususayah"]; 
			$butuhkhususketayah	=	$_POST["butuhkhususketayah"];
			$pekerjaanayah		=	$_POST["pekerjaanayah"];
			$pekerjaanayah_lain	=	$_POST["pekerjaanayah_lain"];
			$pendidikanayah		=	$_POST["pendidikanayah"];
			$penghasilanayah	=	numberreplace($_POST["penghasilanayah"]);
			$penghasilanayah_kode	=	(empty($_POST["penghasilanayah_kode"])) ? 0 : $_POST["penghasilanayah_kode"];
			$namaibu			=	$_POST["namaibu"];
			$tahunibu			=	(empty($_POST["tahunibu"])) ? 0 : $_POST["tahunibu"];
			$butuhkhususibu		=	(empty($_POST["butuhkhususibu"])) ? 0 : $_POST["butuhkhususibu"];
			$butuhkhususketibu	=	$_POST["butuhkhususketibu"];
			$alamatibu			=	petikreplace($_POST["alamatibu"]);
			$kodeposibu			=	$_POST["kodeposibu"];
			$hpibu				=	$_POST["hpibu"];
			
			$pekerjaanibu		=	$_POST["pekerjaanibu"];
			$pekerjaanibu_lain	=	$_POST["pekerjaanibu_lain"];
			$pendidikanibu		=	$_POST["pendidikanibu"];
			$penghasilanibu		=	numberreplace($_POST["penghasilanibu"]);
			$penghasilanibu_kode	=	(empty($_POST["penghasilanibu_kode"])) ? 0 : $_POST["penghasilanibu_kode"];
			$wali				=	$_POST["wali"];
			$tahunwali			=	(empty($_POST["tahunwali"])) ? 0 : $_POST["tahunwali"];
			$pekerjaanwali		=	(empty($_POST["pekerjaanwali"])) ? 0 : $_POST["pekerjaanwali"];
			$pekerjaanwali_lain	=	petikreplace($_POST["pekerjaanwali_lain"]);
			$pendidikanwali		=	(empty($_POST["pendidikanwali"])) ? 0 : $_POST["pendidikanwali"];
			$penghasilanwali	=	numberreplace($_POST["penghasilanwali"]);
			$tinggi				=	numberreplace($_POST["tinggi"]);
			$berat				=	numberreplace($_POST["berat"]);
			$jaraksekolah		=	$_POST["jaraksekolah"];
			$jarak_km			=	numberreplace($_POST["jarak_km"]);
			$waktutempuh		=	$_POST["waktutempuh"];
			$waktutempuh_menit	=	numberreplace($_POST["waktutempuh_menit"]);
			$jsaudara			=	(empty($_POST["jsaudara"])) ? 0 : $_POST["jsaudara"];
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			$almayah			=	(empty($_POST["almayah"])) ? 0 : $_POST["almayah"];
			$almibu				=	(empty($_POST["almibu"])) ? 0 : $_POST["almibu"];
			$idjenis_tinggal	=	$_POST['idjenis_tinggal'];
			$idminat			=	$_POST['idminat'];
			$idminat1			=	$_POST['idminat1'];
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto/';
			$foto_file2	= $_POST["foto_file2"];
			$foto_file 	= $_FILES['foto_file']['name']; 
			$tmpname  		= $_FILES['foto_file']['tmp_name'];
			$filesize 		= $_FILES['foto_file']['size'];
			$filetype 		= $_FILES['foto_file']['type'];
			
			if (empty($foto_file)) { 
				$foto_file = $foto_file2; 
			} 
			
			if($foto_file != "") {	
				
				if($foto_file != $foto_file2) {
				
					if(!empty($foto_file2)) {
						unlink($uploaddir . $foto_file2); //remove file 
					}
					
					$foto_file = $ref . '_' . $foto_file;
				}
							
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$darah			=	$_POST["darah"];
			//-----------upload file fotocopy golongan darah
			$uploaddir 		= 'app/file_darah_calon/';
			$file_darah2	= $_POST["file_darah2"];
			$file_darah 	= $_FILES['file_darah']['name']; 
			$tmpname  		= $_FILES['file_darah']['tmp_name'];
			$filesize 		= $_FILES['file_darah']['size'];
			$filetype 		= $_FILES['file_darah']['type'];
			
			if (empty($file_darah)) { 
				$file_darah = $file_darah2; 
			} 
			
			if($file_darah != "") {	
				
				if($file_darah != $file_darah2) {
				
					if(!empty($file_darah2)) {
						unlink($uploaddir . $file_darah2); //remove file 
					}
					
					$file_darah = $ref . '_' . $file_darah;
				}
							
				$uploadfile = $uploaddir . $file_darah;		
				if (move_uploaded_file($_FILES['file_darah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$sqlstr = "update calonsiswa set departemen='$departemen', idproses='$idproses', idkelompok='$idkelompok', tanggal='$tanggal', idtingkat='$idtingkat', idjurusan='$idjurusan', idminat='$idminat', idminat1='$idminat1', foto_file='$foto_file', nama='$nama', panggilan='$panggilan', kelamin='$kelamin', nisn='$nisn', nis='$nis', noijazah='$noijazah', tahunijazah='$tahunijazah', skhun='$skhun', tahunskhun='$tahunskhun', noujian='$noujian', nik='$nik', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', kebutuhan_khusus_chk='$kebutuhan_khusus_chk', kebutuhan_khusus='$kebutuhan_khusus', tahunmasuk='$tahunmasuk', alamatsiswa='$alamatsiswa', dusun='$dusun', rt='$rt', rw='$rw', kelurahan='$kelurahan', kodepossiswa='$kodepossiswa', kecamatan='$kecamatan', kabupaten='$kabupaten', provinsi='$provinsi', transportasi='$transportasi', transportasi_kode='$transportasi_kode', citacita='$citacita', citacita_lain='$citacita_lain', idjenis_tinggal='$idjenis_tinggal', jenis_tinggal='$jenis_tinggal', telponsiswa='$telponsiswa', hpsiswa='$hpsiswa', emailsiswa='$emailsiswa', kps='$kps', nokps='$nokps', nokip='$nokip', nokks='$nokks', namaayah='$namaayah', tahunayah='$tahunayah', alamatortu='$alamatortu', kodeposortu='$kodeposortu', hportu='$hportu', butuhkhususayah='$butuhkhususayah', butuhkhususketayah='$butuhkhususketayah', pekerjaanayah='$pekerjaanayah', pekerjaanayah_lain='$pekerjaanayah_lain', pendidikanayah='$pendidikanayah', penghasilanayah='$penghasilanayah', penghasilanayah_kode='$penghasilanayah_kode', namaibu='$namaibu', tahunibu='$tahunibu', butuhkhususibu='$butuhkhususibu', butuhkhususketibu='$butuhkhususketibu', pekerjaanibu='$pekerjaanibu', pekerjaanibu_lain='$pekerjaanibu_lain', pendidikanibu='$pendidikanibu', penghasilanibu='$penghasilanibu', penghasilanibu_kode='$penghasilanibu_kode', wali='$wali', tahunwali='$tahunwali', pekerjaanwali='$pekerjaanwali', pekerjaanwali_lain='$pekerjaanwali_lain', pendidikanwali='$pendidikanwali', penghasilanwali='$penghasilanwali', tinggi='$tinggi', berat='$berat', jaraksekolah='$jaraksekolah', jarak_km='$jarak_km', waktutempuh='$waktutempuh', waktutempuh_menit='$waktutempuh_menit', jsaudara='$jsaudara', uid='$uid', dlu='$dlu', darah='$darah', file_darah='$file_darah', almayah='$almayah', almibu='$almibu', alamatibu='$alamatibu', kodeposibu='$kodeposibu', hpibu='$hpibu' where replid='$ref' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			/*------------registrasi prestasi-------------*/
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($x=0; $x<=$jmldata; $x++) {
				$delete 		= (empty($_POST[delete_.$x])) ? 0 : $_POST[delete_.$x];
				$old_line		 	= 	(empty($_POST[old_line_.$x])) ? 0 : $_POST[old_line_.$x];
				
				$jenisprestasi_ 	=	$_POST[jenisprestasi_.$x];
				$tingkat_ 			=	$_POST[tingkat_.$x];
				$nama_			 	=	$_POST[nama_.$x];
				$tahun_			 	=	(empty($_POST[tahun_.$x])) ? 0 : $_POST[tahun_.$x];
				$penyelenggara_		=	$_POST[penyelenggara_.$x];
				
				if ( $jenisprestasi_ != "" ) {
					
					$sqlcek = "select idcalonsiswa from calonsiswa_prestasi where idcalonsiswa='$replid' and line='$old_line' ";										
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update calonsiswa_prestasi set jenisprestasi='$jenisprestasi_', tingkat='$tingkat_', nama='$nama_', tahun='$tahun_', penyelenggara='$penyelenggara_' where idcalonsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from calonsiswa_prestasi where idcalonsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('calonsiswa_prestasi', 'line', 'idcalonsiswa', $replid, '');
				
						$sqlstr = "insert into calonsiswa_prestasi (idcalonsiswa, jenisprestasi, tingkat, nama, tahun, penyelenggara, line) values ('$replid', '$jenisprestasi_', '$tingkat_', '$nama_', '$tahun_', '$penyelenggara_', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
			
			/*------------registrasi beasiswa-------------*/
			$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];
			
			for ($x=0; $x<=$jmldata2; $x++) {
				$delete2 			= 	(empty($_POST[delete2_.$x])) ? 0 : $_POST[delete2_.$x];
				$old_line2		 	= 	(empty($_POST[old_line2_.$x])) ? 0 : $_POST[old_line2_.$x];
				
				$jenis_ 			=	$_POST[jenis_.$x];
				$penyelenggara2_	=	$_POST[penyelenggara2_.$x];
				$tahunmulai_	 	=	(empty($_POST[tahunmulai_.$x])) ? 0 : $_POST[tahunmulai_.$x];
				$tahunselesai_	 	=	(empty($_POST[tahunselesai_.$x])) ? 0 : $_POST[tahunselesai_.$x];
				
				if ( $jenis_ != "" ) {
					
					$sqlcek = "select idcalonsiswa from calonsiswa_beasiswa where idcalonsiswa='$replid' and line='$old_line2' ";					
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete2 == 0) {
							$sqlstr="update calonsiswa_beasiswa set jenis='$jenis_', penyelenggara='$penyelenggara2_', tahunmulai='$tahunmulai_', tahunselesai='$tahunselesai_' where idcalonsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from calonsiswa_beasiswa where idcalonsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('calonsiswa_beasiswa', 'line', 'idcalonsiswa', $replid, '');
				
						$sqlstr = "insert into calonsiswa_beasiswa (idcalonsiswa, jenis, penyelenggara, tahunmulai, tahunselesai, line) values ('$replid', '$jenis_', '$penyelenggara2_', '$tahunmulai_', '$tahunselesai_', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update siswa
	function update_siswa($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			
			$idangkatan			=	(empty($_POST["idangkatan"])) ? 0 : $_POST["idangkatan"];
			$idangkatan1		=	(empty($_POST["idangkatan1"])) ? 0 : $_POST["idangkatan1"];
			
			/*--------Keterangan pribadi---------*/
			$nis				=	$_POST["nis"];
			$nisn				=	$_POST["nisn"];
			$nik				=	$_POST["nik"];
			$nama				=	petikreplace($_POST["nama"]);
			$panggilan			=	petikreplace($_POST['panggilan']);
			$idkelas			=	(empty($_POST["idkelas"])) ? 0 : $_POST["idkelas"];
			$kelamin			=	$_POST["kelamin"];
			$tmplahir			=	$_POST["tmplahir"];
			$tgllahir			=	date("Y-m-d", strtotime($_POST["tgllahir"]));
			$agama				=	$_POST["agama"];
			$warga				=	$_POST["warga"];
			$anakke				=	(empty($_POST["anakke"])) ? 0 : $_POST["anakke"];
			$jsaudara			=	(empty($_POST["jsaudara"])) ? 0 : $_POST["jsaudara"];
			$jtiri				=	(empty($_POST["jtiri"])) ? 0 : $_POST["jtiri"];
			$jangkat			=	(empty($_POST["jangkat"])) ? 0 : $_POST["jangkat"];
			$yatim				=	(empty($_POST["yatim"])) ? 0 : $_POST["yatim"];
			$bahasa				=	$_POST["bahasa"];
			
			/*--------Keterangan tempat tinggal---------*/
            $desa_kode          =	$_POST["desa_kode"];
            $kecamatan_kode     =	$_POST["kecamatan_kode"];
            $kota_kode          =	$_POST["kota_kode"];
            $provinsi_kode      =	$_POST["provinsi_kode"];
            
			$alamatsiswa		=	$_POST["alamatsiswa"];
			$rt_siswa			=	$_POST["rt_siswa"];
			$rw_siswa			=	$_POST["rw_siswa"];	
			$dusun				=	$_POST["dusun"];	
			$desa				=	$_POST["desa"];	
			$kecamatan			=	$_POST["kecamatan"];	
			$kodepossiswa		=	$_POST["kodepossiswa"];	
			$jenistinggal		=	$_POST["jenistinggal"];	
			$kps				=	(empty($_POST["kps"])) ? 0 : $_POST["kps"];
			$nokps				=	$_POST["nokps"];
			$kip				=	(empty($_POST["kip"])) ? 0 : $_POST["kip"];
			$nokip				=	$_POST["nokip"];
			$namakip			=	$_POST["namakip"];
			$nokks				=	$_POST["nokks"];
			$no_akte_lahir		=	$_POST["no_akte_lahir"];
			$alamatortu			=	$_POST["alamatortu"];
			$telponsiswa		=	$_POST["telponsiswa"];
			$hpsiswa			=	$_POST["hpsiswa"];
			$emailsiswa			=	$_POST["emailsiswa"];
			$telponortu			=	$_POST["telponortu"];
			$hportu				=	$_POST["hportu"];
			$hpibu				=	$_POST["hpibu"];
			$transportasi_kode	=	$_POST["transportasi_kode"];
			$transportasi_lain	=	$_POST["transportasi_lain"];
			$jaraksekolah		=	numberreplace($_POST["jaraksekolah"]);
			$kesekolah			=	(empty($_POST["kesekolah"])) ? 0 : $_POST["kesekolah"];
			
			/*--------Keterangan kesehatan---------*/
			$berat				=	numberreplace($_POST["berat"]);
			$tinggi				=	numberreplace($_POST["tinggi"]);
			$kesehatan			=	$_POST["kesehatan"]; //riwayat penyakit
			$darah				=	$_POST["darah"];
			
			//-----------upload file fotocopy golongan darah
			$uploaddir 		= 'app/file_darah/';
			$file_darah2	= $_POST["file_darah2"];
			$file_darah 	= $_FILES['file_darah']['name']; 
			$tmpname  		= $_FILES['file_darah']['tmp_name'];
			$filesize 		= $_FILES['file_darah']['size'];
			$filetype 		= $_FILES['file_darah']['type'];
			
			if (empty($file_darah)) { 
				$file_darah = $file_darah2; 
			} 
			
			if($file_darah != "") {	
				
				if($file_darah != $file_darah2) {
				
					if(!empty($file_darah2)) {
						unlink($uploaddir . $file_darah2); //remove file 
					}
					
					$file_darah = $nis . $idkelas . '_' . $file_darah;
				}
							
				$uploadfile = $uploaddir . $file_darah;		
				if (move_uploaded_file($_FILES['file_darah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------			
			$kelainan			=	$_POST["kelainan"];
			
			
			/*--------Keterangan pendidikan sebelumnya---------*/
			$asalsekolah_id		=	petikreplace($_POST["asalsekolah_id"]); //(empty($_POST["asalsekolah_id"])) ? 0 : $_POST["asalsekolah_id"];
			$tglijazah			=	date("Y-m-d", strtotime($_POST["tglijazah"]));
			$noijazah			=	$_POST["noijazah"];
			$tglskhun			=	date("Y-m-d", strtotime($_POST["tglskhun"]));
			$skhun				=	$_POST["skhun"];
			$noujian			=	$_POST["noujian"];
			$nisnasal			=	$_POST["nisnasal"];
			
			/*--------Keterangan orang tua---------*/
			$nik_ayah			=	$_POST["nik_ayah"];
			$namaayah			=	$_POST["namaayah"];
			$nik_ibu			=	$_POST["nik_ibu"];
			$namaibu			=	$_POST["namaibu"];
			$tmplahirayah		=	$_POST["tmplahirayah"];
			$tgllahirayah		=	date("Y-m-d", strtotime($_POST["tgllahirayah"]));
            $tempat_bekerja_ayah=   $_POST["tempat_bekerja_ayah"];
            
			$tmplahiribu		=	$_POST["tmplahiribu"];
			$tgllahiribu		=	date("Y-m-d", strtotime($_POST["tgllahiribu"]));
			$pekerjaanayah		=	$_POST["pekerjaanayah"];
			$pekerjaanayah_lain	=	$_POST["pekerjaanayah_lain"];
			$pekerjaanibu		=	$_POST["pekerjaanibu"];
			$pekerjaanibu_lain	=	$_POST["pekerjaanibu_lain"];
            $tempat_bekerja_ibu =   $_POST["tempat_bekerja_ibu"];
            
			$penghasilanayah_kode	=	(empty($_POST["penghasilanayah_kode"])) ? 0 : $_POST["penghasilanayah_kode"];
			$penghasilanayah	=	numberreplace($_POST["penghasilanayah"]);
			$penghasilanibu_kode	=	(empty($_POST["penghasilanibu_kode"])) ? 0 : $_POST["penghasilanibu_kode"];
			$penghasilanibu		=	numberreplace($_POST["penghasilanibu"]);
			
			/*--------pendidikan formal orang tua tertinggi---------*/
			$pendidikanayah		=	$_POST["pendidikanayah"];
			$pendidikanibu		=	$_POST["pendidikanibu"];
			$wnayah				=	$_POST["wnayah"];
			$wnibu				=	$_POST["wnibu"];
			
			/*--------Keterangan wali---------*/
			$nik_wali			=	$_POST["nik_wali"];
			$wali				=	$_POST["wali"];
			$tmplahirwali		=	$_POST["tmplahirwali"];
			$tgllahirwali		=	date("Y-m-d", strtotime($_POST["tgllahirwali"]));
			$pendidikanwali		=	(empty($_POST["pendidikanwali"])) ? 0 : $_POST["pendidikanwali"];
			$pekerjaanwali		=	(empty($_POST["pekerjaanwali"])) ? 0 : $_POST["pekerjaanwali"];
			$pekerjaanwali_lain	=	$_POST["pekerjaanwali_lain"];
			$penghasilanwali_kode	=	(empty($_POST["penghasilanwali_kode"])) ? 0 : $_POST["penghasilanwali_kode"];
			$penghasilanwali	=	numberreplace($_POST["penghasilanwali"]);
            $tempat_bekerja_wali=   $_POST["tempat_bekerja_wali"];
            
			$alamatwali			=	petikreplace($_POST["alamatwali"]);
			$hpwali				=	$_POST["hpwali"];
			$hubungansiswa		=	$_POST["hubungansiswa"];
			
			/*--------Lain-lain---------*/
			$rombel_id			=	$_POST["rombel_id"];
			$nama_bank			=	$_POST["nama_bank"];
			$no_rekening_bank	=	$_POST["no_rekening_bank"];
			$nama_pemilik_bank	=	$_POST["nama_pemilik_bank"];
			$pip				=	(empty($_POST["pip"])) ? 0 : $_POST["pip"];
			$alasan_pip			=	petikreplace($_POST["alasan_pip"]);
			$virtualaccount		=	$_POST['virtualaccount'];
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_siswa/';
			$foto_file2	= $_POST["foto_file2"];
			$foto_file 	= $_FILES['foto_file']['name']; 
			$tmpname  		= $_FILES['foto_file']['tmp_name'];
			$filesize 		= $_FILES['foto_file']['size'];
			$filetype 		= $_FILES['foto_file']['type'];
			
			if (empty($foto_file)) { 
				$foto_file = $foto_file2; 
			} 
			
			if($foto_file != "") {	
				
				if($foto_file != $foto_file2) {
				
					if(!empty($foto_file2)) {
						unlink($uploaddir . $foto_file2); //remove file 
					}
					
					$foto_file = $nis . '_' . $foto_file;
				}
							
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$sqlstr = "update siswa set nis='$nis', nisn='$nisn', nik='$nik', idangkatan='$idangkatan', idangkatan1='$idangkatan1', foto_file='$foto_file', nama='$nama', panggilan='$panggilan', idkelas='$idkelas', kelamin='$kelamin', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', warga='$warga', anakke='$anakke', jsaudara='$jsaudara', jtiri='$jtiri', jangkat='$jangkat', yatim='$yatim', bahasa='$bahasa', desa_kode='$desa_kode', kecamatan_kode='$kecamatan_kode', kota_kode='$kota_kode', provinsi_kode='$provinsi_kode', alamatsiswa='$alamatsiswa', rt_siswa='$rt_siswa', rw_siswa='$rw_siswa', dusun='$dusun', desa='$desa', kecamatan='$kecamatan', kodepossiswa='$kodepossiswa', alamatortu='$alamatortu', telponsiswa='$telponsiswa', hpsiswa='$hpsiswa', emailsiswa='$emailsiswa', jenistinggal='$jenistinggal', kps='$kps', nokps='$nokps', kip='$kip', nokip='$nokip', namakip='$namakip', nokks='$nokks', no_akte_lahir='$no_akte_lahir', telponortu='$telponortu', hportu='$hportu', hpibu='$hpibu', transportasi_kode='$transportasi_kode', transportasi_lain='$transportasi_lain', jaraksekolah='$jaraksekolah', kesekolah='$kesekolah', berat='$berat', tinggi='$tinggi', kesehatan='$kesehatan', darah='$darah', file_darah='$file_darah', kelainan='$kelainan', asalsekolah_id='$asalsekolah_id', tglijazah='$tglijazah', noijazah='$noijazah', tglskhun='$tglskhun', skhun='$skhun', noujian='$noujian', nisnasal='$nisnasal', nik_ayah='$nik_ayah', namaayah='$namaayah', nik_ibu='$nik_ibu', namaibu='$namaibu', tmplahirayah='$tmplahirayah', tgllahirayah='$tgllahirayah', tempat_bekerja_ayah='$tempat_bekerja_ayah', tmplahiribu='$tmplahiribu', tgllahiribu='$tgllahiribu', pekerjaanayah='$pekerjaanayah', pekerjaanibu='$pekerjaanibu', penghasilanayah_kode='$penghasilanayah_kode', penghasilanayah='$penghasilanayah', penghasilanibu_kode='$penghasilanibu_kode', penghasilanibu='$penghasilanibu', pendidikanayah='$pendidikanayah', pendidikanibu='$pendidikanibu', tempat_bekerja_ibu='$tempat_bekerja_ibu', wnayah='$wnayah', wnibu='$wnibu', nik_wali='$nik_wali', wali='$wali', tmplahirwali='$tmplahirwali', tgllahirwali='$tgllahirwali', pendidikanwali='$pendidikanwali', pekerjaanwali='$pekerjaanwali', penghasilanwali_kode='$penghasilanwali_kode', penghasilanwali='$penghasilanwali', tempat_bekerja_wali='$tempat_bekerja_wali', alamatwali='$alamatwali', hpwali='$hpwali', hubungansiswa='$hubungansiswa', pekerjaanayah_lain='$pekerjaanayah_lain', pekerjaanibu_lain='$pekerjaanibu_lain', pekerjaanwali_lain='$pekerjaanwali_lain', rombel_id='$rombel_id', nama_bank='$nama_bank', no_rekening_bank='$no_rekening_bank', nama_pemilik_bank='$nama_pemilik_bank', pip='$pip', alasan_pip='$alasan_pip', uid='$uid', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
		
			//virtual account
			$sqlstr = "select nis from siswa_virtualaccount where nis='$nis'";
			$results1 = $dbpdo->query($sqlstr);
			$rows = $results1->rowCount();
			if($rows == 0) {
				$sqlstr = "insert into siswa_virtualaccount(nis, virtualaccount) values ('$nis', '$virtualaccount')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr = "update siswa_virtualaccount set virtualaccount='$virtualaccount' where nis='$nis'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			/*------------siswa prestasi-------------*/
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($x=0; $x<=$jmldata; $x++) {
				$delete 			= (empty($_POST[delete_.$x])) ? 0 : $_POST[delete_.$x];
				$old_line		 	= 	(empty($_POST[old_line_.$x])) ? 0 : $_POST[old_line_.$x];
				
				$jenisprestasi_ 	=	$_POST[jenisprestasi_.$x];
				$tingkat_ 			=	$_POST[tingkat_.$x];
				$nama_			 	=	$_POST[nama_.$x];
				$tahun_			 	=	(empty($_POST[tahun_.$x])) ? 0 : $_POST[tahun_.$x];
				$penyelenggara_		=	$_POST[penyelenggara_.$x];
				
				if ( $jenisprestasi_ != "" ) {
					
					$sqlcek = "select idsiswa from siswa_prestasi where idsiswa='$replid' and line='$old_line' ";										
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update siswa_prestasi set jenisprestasi='$jenisprestasi_', tingkat='$tingkat_', nama='$nama_', tahun='$tahun_', penyelenggara='$penyelenggara_' where idsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from siswa_prestasi where idsiswa='$replid' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('siswa_prestasi', 'line', 'idsiswa', $replid, '');
				
						$sqlstr = "insert into siswa_prestasi (idsiswa, jenisprestasi, tingkat, nama, tahun, penyelenggara, line) values ('$replid', '$jenisprestasi_', '$tingkat_', '$nama_', '$tahun_', '$penyelenggara_', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
			
			/*------------siswa beasiswa-------------*/
			$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];
			
			for ($x=0; $x<=$jmldata2; $x++) {
				$delete2 			= 	(empty($_POST[delete2_.$x])) ? 0 : $_POST[delete2_.$x];
				$old_line2		 	= 	(empty($_POST[old_line2_.$x])) ? 0 : $_POST[old_line2_.$x];
				
				$jenis_ 			=	$_POST[jenis_.$x];
				$penyelenggara2_	=	$_POST[penyelenggara2_.$x];
				$tahunmulai_	 	=	(empty($_POST[tahunmulai_.$x])) ? 0 : $_POST[tahunmulai_.$x];
				$tahunselesai_	 	=	(empty($_POST[tahunselesai_.$x])) ? 0 : $_POST[tahunselesai_.$x];
				
				if ( $jenis_ != "" ) {
					
					$sqlcek = "select idsiswa from siswa_beasiswa where idsiswa='$replid' and line='$old_line2' ";					
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete2 == 0) {
							$sqlstr="update siswa_beasiswa set jenis='$jenis_', penyelenggara='$penyelenggara2_', tahunmulai='$tahunmulai_', tahunselesai='$tahunselesai_' where idsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from siswa_beasiswa where idsiswa='$replid' and line=$old_line2";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$line = maxline('siswa_beasiswa', 'line', 'idsiswa', $replid, '');
				
						$sqlstr = "insert into siswa_beasiswa (idsiswa, jenis, penyelenggara, tahunmulai, tahunselesai, line) values ('$replid', '$jenis_', '$penyelenggara2_', '$tahunmulai_', '$tahunselesai_', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update prosespenerimaansiswa
	function update_prosespenerimaansiswa($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$proses				=	$_POST["proses"];
			$kodeawalan			=	$_POST["kodeawalan"];
			$departemen			=	'SMA';
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update prosespenerimaansiswa set proses='$proses', keterangan='$keterangan', aktif='$aktif', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update kelompokcalonsiswa
	function update_kelompokcalonsiswa($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$idproses			=	$_POST["idproses"];
			$kapasitas			=	numberreplace($_POST["kapasitas"]);
			$kelompok			=	$_POST["kelompok"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update kelompokcalonsiswa set idproses='$idproses', kapasitas='$kapasitas', kelompok='$kelompok', keterangan='$keterangan', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update departemen
	function update_departemen($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$departemen			=	$_POST["departemen"];
			$nipkepsek			=	$_POST["nipkepsek"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update departemen set departemen='$departemen', nipkepsek='$nipkepsek', urutan='$urutan', keterangan='$keterangan', aktif='$aktif', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update tingkat
	function update_tingkat($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$tingkat			=	$_POST["tingkat"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update tingkat set tingkat='$tingkat', departemen='$departemen', aktif='$aktif', keterangan='$keterangan', urutan='$urutan', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update kelas
	function update_kelas($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$idtahunajaran		=	$_POST["idtahunajaran"];
			$idtingkat			=	$_POST["idtingkat"];
			$kelas				=	$_POST["kelas"];
			$kapasitas			=	$_POST["kapasitas"];
			$nipwali			=	$_POST["nipwali"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);;			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update kelas set idtahunajaran='$idtahunajaran', idtingkat='$idtingkat', kelas='$kelas', kapasitas='$kapasitas', nipwali='$nipwali', aktif='$aktif', keterangan='$keterangan', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update tahunajaran
	function update_tahunajaran($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$tahunajaran		=	$_POST["tahunajaran"];
			$tglmulai			=	date("Y-m-d", strtotime($_POST["tglmulai"]));
			$tglakhir			=	date("Y-m-d", strtotime($_POST["tglakhir"]));
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$departemen			=	$_POST['departemen'];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update tahunajaran set departemen='$departemen', tahunajaran='$tahunajaran', tglmulai='$tglmulai', tglakhir='$tglakhir', aktif='$aktif', keterangan='$keterangan', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update agama
	function update_agama($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$replid				=	(empty($_POST["replid"])) ? 0 : $_POST["replid"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$agama			=	$_POST["agama"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update agama set agama='$agama', urutan='$urutan', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update tahun buku
	function update_tahunbuku($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$tahunbuku			=	$_POST["tahunbuku"];
			$awalan				=	$_POST["awalan"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$departemen		=	$_POST["departemen"];
			$tanggalmulai		=	date("Y-m-d", strtotime($_POST['tanggalmulai']));
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update tahunbuku set tahunbuku='$tahunbuku', awalan='$awalan', aktif='$aktif', keterangan='$keterangan', departemen='$departemen', tanggalmulai='$tanggalmulai', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update rekakun
	function update_rekakun($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$kategori			=	$_POST["kategori"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update rekakun set kode='$kode', kategori='$kategori', nama='$nama', keterangan='$keterangan', ts='$ts' where kode='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update datapenerimaan
	function update_datapenerimaan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idkategori			=	$_POST["idkategori"];
			$departemen			=	$_POST["departemen"];
			$nama				=	$_POST["nama"];
			$rekkas				=	$_POST["rekkas"];
			$rekpendapatan		=	$_POST["rekpendapatan"];
			$rekpiutang			=	$_POST["rekpiutang"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$nourut				=	numberreplace($_POST["nourut"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$full				=	(empty($_POST["full"])) ? 0 : $_POST["full"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update datapenerimaan set idkategori='$idkategori', departemen='$departemen', nama='$nama', rekkas='$rekkas', rekpendapatan='$rekpendapatan', rekpiutang='$rekpiutang', keterangan='$keterangan', nourut='$nourut', aktif='$aktif', full='$full', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update datapengeluaran
	function update_datapengeluaran($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$nama				=	$_POST["nama"];
			$rekdebet			=	$_POST["rekdebet"];
			$rekkredit			=	$_POST["rekkredit"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update datapengeluaran set departemen='$departemen', nama='$nama', rekdebet='$rekdebet', rekkredit='$rekkredit', keterangan='$keterangan', aktif='$aktif', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update besarjtt
	function update_besarjtt($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$semua 				= 	$_POST['semua'];
			$departemen			=	$_POST['departemen'];
			$idtingkat			=	$_POST['idtingkat'];
			$idangkatan			=	$_POST['idangkatan'];
			$nis				=	$_POST["nis"];
			$idpenerimaan		=	$_POST["idpenerimaan"];
			$besar				=	numberreplace($_POST["besar"]);
			$cicilan			=	numberreplace($_POST["cicilan"]);
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$potongan			=	numberreplace($_POST["potongan"]);
			$ts					=	date("Y-m-d H:i:s");
			$uid				=	$_SESSION["loginname"];
			//$tahunbuku			=	$_SESSION["tahunbuku"];
			$old_tahunbuku		=	$_POST["old_tahunbuku"];
			
			$sqltb = "select replid from tahunbuku where departemen='$departemen' order by tanggalmulai desc limit 1";
			$query = $dbpdo->prepare($sqltb);
			$query->execute();
			$datatb = $query->fetch(PDO::FETCH_OBJ);
			$tahunbuku = $datatb->replid;
			
			if($semua == 1) {
				$sqlstr2 = "select a.replid, a.nis from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where c.departemen='$departemen' and b.idtingkat='$idtingkat' and a.idangkatan='$idangkatan' ";
				//and a.idkelas='$idkelas' 
				$sql2=$dbpdo->query($sqlstr2);
				while ($data_view=$sql2->fetch(PDO::FETCH_OBJ)) {
					$nis	=	$data_view->nis;
					
					$strcek = "select nis from besarjtt where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
					$sqlcek=$dbpdo->query($strcek);
					$datacheck = $sqlcek->rowCount();
					if($datacheck == 0) {
						$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$ts', '$potongan')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$sqlstr = "update besarjtt set idpenerimaan='$idpenerimaan', besar='$besar', cicilan='$cicilan', keterangan='$keterangan', pengguna='$uid', info2='$tahunbuku', ts='$ts', potongan='$potongan' where nis='$nis' and idpenerimaan='$idpenerimaan' and info2='$tahunbuku' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
				
			} else {
				
				$sqlstr = "update besarjtt set nis='$nis', idpenerimaan='$idpenerimaan', besar='$besar', cicilan='$cicilan', keterangan='$keterangan', pengguna='$uid', info2='$tahunbuku', ts='$ts', potongan='$potongan' where replid='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update penerimaanjtt
	function update_penerimaanjtt($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nis				=	$_POST["nis"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idpenerimaan		=	$_POST["idpenerimaan"];
			$tahunbuku			=	$_POST["tahunbuku"];
			$nama				=	petikreplace($_POST["nama"]);
			$besar				=	numberreplace($_POST["besar"]);
			$jumlah				=	numberreplace($_POST["jumlah"]);
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$idjurnal			=	$_POST["idjurnal"];
			$idjenis_bayar		=	$_POST["idjenis_bayar"];
			
			$ts					=	date("Y-m-d H:i:s");
			$uid				=	$_SESSION["loginname"];
							
			$sqlstr = "update penerimaanjtt set idjenis_bayar='$idjenis_bayar', jumlah='$jumlah', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//cek lunas
			$sqlstr = "select sum(b.besar) - sum(a.jumlah) sisa from penerimaanjtt a left join besarjtt b on a.idbesarjtt=b.replid group by b.nis, b.idpenerimaan having b.nis='$nis' and b.idpenerimaan='$idpenerimaan'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$sisa = $data->sisa;
			
			if($sisa <= 0) {
				$sqlstr = "update besarjtt set lunas=1 where nis='$nis' and idpenerimaan='$idpenerimaan'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			} else {
				$sqlstr = "update besarjtt set lunas=0 where nis='$nis' and idpenerimaan='$idpenerimaan'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			//jurnal
			$sqlstr = "update jurnal set tanggal='$tanggal', keterangan='$keterangan', petugas='$uid' where replid='$idjurnal'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
				
			//update ke jurnaldetail
			##DEBIT
			$cek = "select replid from jurnaldetail where idjurnal='$idjurnal' order by replid asc limit 1";
			$xcek=$dbpdo->prepare($cek);
			$xcek->execute();
			$datacek=$xcek->fetch(PDO::FETCH_OBJ);
			$replid=$datacek->replid;
			
			$sqlstr = "update jurnaldetail set debet=$jumlah where idjurnal='$idjurnal' and replid='$replid'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
			##KREDIT
			$cek = "select replid from jurnaldetail where idjurnal='$idjurnal' order by replid desc limit 1";
			$xcek=$dbpdo->prepare($cek);
			$xcek->execute();
			$datacek=$xcek->fetch(PDO::FETCH_OBJ);
			$replid=$datacek->replid;
			
			$sqlstr = "update jurnaldetail set kredit=$jumlah where idjurnal='$idjurnal' and replid='$replid'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
					
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update perpustakaan
	function update_perpustakaan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update perpustakaan set nama='$nama', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			//----update perpustakaan identitas
			$sqlstr = "update identitas set perpustakaan='$nama' where departemen='$departemen' ";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update format
	function update_format($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update format set kode='$kode', nama='$nama', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update rak
	function update_rak($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$rak				=	$_POST["rak"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update rak set rak='$rak', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update katalog
	function update_katalog($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	petikreplace($_POST["nama"]);
			$rak				=	(empty($_POST["rak"])) ? 0 : $_POST["rak"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update katalog set kode='$kode', nama='$nama', rak='$rak', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update penerbit
	function update_penerbit($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	petikreplace($_POST["nama"]);
			$alamat				=	petikreplace($_POST["alamat"]);
			$telpon				=	$_POST["telpon"];
			$email				=	$_POST["email"];
			$fax				=	$_POST["fax"];
			$website			=	$_POST["website"];
			$kontak				=	$_POST["kontak"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update penerbit set kode='$kode', nama='$nama', alamat='$alamat', telpon='$telpon', email='$email', fax='$fax', website='$website', kontak='$kontak', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update penulis
	function update_penulis($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$gelardepan			=	$_POST["gelardepan"];
			$nama				=	petikreplace($_POST["nama"]);
			$gelarbelakang		=	$_POST["gelarbelakang"];
			$kontak				=	$_POST["kontak"];
			$biografi			=	petikreplace($_POST["biografi"]);
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update penulis set kode='$kode', gelardepan='$gelardepan', nama='$nama', gelarbelakang='$gelarbelakang', kontak='$kontak', biografi='$biografi', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update pustaka
	function update_pustaka($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$judul				=	petikreplace($_POST["judul"]);
			$abstraksi			=	petikreplace($_POST["abstraksi"]);
			$keyword			=	petikreplace($_POST["keyword_"]);
			$tahun				=	numberreplace($_POST["tahun"]);
			$keteranganfisik	=	petikreplace($_POST["keteranganfisik"]);
			$penulis			=	(empty($_POST["penulis"])) ? 0 : $_POST["penulis"];
			$penerbit			=	(empty($_POST["penerbit"])) ? 0 : $_POST["penerbit"];
			$format				=	(empty($_POST["format"])) ? 0 : $_POST["format"];
			$katalog			=	(empty($_POST["katalog"])) ? 0 : $_POST["katalog"];
			$kodepustaka_crt	=	$_POST["kodepustaka"];
			$old_katalog		=	(empty($_POST["old_katalog"])) ? 0 : $_POST["old_katalog"];
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_pustaka/';
			$photo2	= $_POST["photo2"];
			$photo 	= $_FILES['photo']['name']; 
			$tmpname  		= $_FILES['photo']['tmp_name'];
			$filesize 		= $_FILES['photo']['size'];
			$filetype 		= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} 
			
			if($photo != "") {	
				
				if($photo != $photo2) {
				
					if(!empty($photo2)) {
						unlink($uploaddir . $photo2); //remove file 
					}
					
					$photo = $format . '_' . $photo;
				}
							
				$uploadfile = $uploaddir . $photo;		
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$harga				=	numberreplace($_POST["harga"]);
			$jumlah				=	numberreplace($_POST["jumlah"]);
			$jumlah2			=	numberreplace($_POST["jumlah2"]);
			$departemen			=	$_POST["departemen"];
			$tanggal_masuk		=	date("Y-m-d", strtotime($_POST["tanggal_masuk"]));
			$keterangan_pustaka	=	$_POST["keterangan_pustaka"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pustaka set judul='$judul', abstraksi='$abstraksi', keyword='$keyword', tahun='$tahun', keteranganfisik='$keteranganfisik', penulis='$penulis', penerbit='$penerbit', format='$format', katalog='$katalog', photo='$photo', keterangan='$keterangan', harga='$harga', departemen='$departemen', tanggal_masuk='$tanggal_masuk', keterangan_pustaka='$keterangan_pustaka', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			/*--------insert jumlah--------*/
			if($old_katalog == $katalog) {
				$sqlstr = "select count(replid) mcount from daftarpustaka where pustaka='$ref'";
				$sqlcek = $dbpdo->prepare($sqlstr);
				$sqlcek->execute();
				$rowdata = $sqlcek->fetch(PDO::FETCH_OBJ);
				$jum = $rowdata->mcount;
				
				$sqlstr = "delete from daftarpustaka where pustaka='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr 	= 	"select counter from katalog where replid='$old_katalog'";
				$sqlcek		=	$dbpdo->query($sqlstr);
				$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
				$counter 	= 	$data->counter;
				
				$newcounter = (int)$counter - (int)$jum;
								
				$sqlstr = "update katalog set counter=$newcounter where replid='$old_katalog'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr 	= 	"select counter from katalog where replid='$old_katalog'";
				$sqlcek		=	$dbpdo->query($sqlstr);
				$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
				$counter 	= 	$data->counter;
				
				$replid		=	1;
				for($n=1; $n<=$jumlah; $n++) {
					$counter++;
					$sqlstr = "update katalog set counter=$counter where replid='$katalog'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					if($kodepustaka_crt == "" && $jumlah > 1) {
						$kodepustaka = GenKodePustaka($katalog,$penulis,$judul,$format,$counter);	
					} else {
						$kodepustaka = $kodepustaka_crt;
					}
					
					$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka) values ('$ref', '$replid', '$kodepustaka')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
			} else {
				
				$sqlstr = "select count(replid) mcount from daftarpustaka where pustaka='$ref'";
				$sqlcek = $dbpdo->prepare($sqlstr);
				$sqlcek->execute();
				$rowdata = $sqlcek->fetch(PDO::FETCH_OBJ);
				$jum = $rowdata->mcount;
				
				$sqlstr = "delete from daftarpustaka where pustaka='$ref'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr 	= 	"select counter from katalog where replid='$old_katalog'";
				$sqlcek		=	$dbpdo->query($sqlstr);
				$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
				$counter 	= 	$data->counter;
				
				$newcounter = (int)$counter - (int)$jum;
								
				$sqlstr = "update katalog set counter=$newcounter where replid='$old_katalog'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$sqlstr 	= 	"select counter from katalog where replid='$katalog'"; //katalog yg baru
				$sqlcek		=	$dbpdo->query($sqlstr);
				$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
				$counter 	= 	$data->counter;
				
				$replid		=	1;
				for($n=1; $n<=$jumlah; $n++) {
					$counter++;
					$sqlstr = "update katalog set counter=$counter where replid='$katalog'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					if($kodepustaka_crt == "" && $jumlah > 1) {
						$kodepustaka = GenKodePustaka($katalog,$penulis,$judul,$format,$counter);	
					} else {
						$kodepustaka = $kodepustaka_crt;
					}
					$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka) values ('$ref', '$replid', '$kodepustaka')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
					
			}
			
			if($jumlah2 > 0) {
				$replid		=	1;
				for($n=1; $n<=$jumlah2; $n++) {
					$counter++;
					
					if($old_katalog == $katalog) {
						$sqlstr = "update katalog set counter=$counter where replid='$old_katalog'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$sqlstr = "update katalog set counter=$counter where replid='$katalog'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
					//$kodepustaka = GenKodePustaka($katalog,$penulis,$judul,$format,$counter);
					if($kodepustaka_crt == "" && $jumlah > 1) {
						$kodepustaka = GenKodePustaka($katalog,$penulis,$judul,$format,$counter);	
					} else {
						$kodepustaka = $kodepustaka_crt;
					}
					$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka) values ('$ref', '$replid', '$kodepustaka')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
			/*------------pustaka supplier-------------*/
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($x=0; $x<=$jmldata; $x++) {
				$delete 			= 	(empty($_POST[delete_.$x])) ? 0 : $_POST[delete_.$x];
				$old_supplier_id 	= 	(empty($_POST[old_supplier_id_.$x])) ? 0 : $_POST[old_supplier_id_.$x];
				
				$supplier_id	=	$_POST[supplier_id_.$x];
				
				if ( $supplier_id != "" ) {
					
					$sqlcek = "select pustaka_id from pustaka_supplier where pustaka_id='$ref' and supplier_id='$old_supplier_id' ";									
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						if($delete == 0) {
							$sqlstr="update pustaka_supplier set supplier_id='$supplier_id' where supplier_id='$ref' and supplier_id='$old_supplier_id'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();
							
						} else {
							$sqlstr="delete from pustaka_supplier where pustaka_id='$ref' and supplier_id='$old_supplier_id'";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}
						
						
					} else {
						
						$sqlstr = "insert into pustaka_supplier (pustaka_id, supplier_id) values ('$ref', '$supplier_id')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update daftarpustaka
	function update_daftarpustaka($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$pustaka			=	$_POST["pustaka"];
			$perpustakaan		=	1;
			$kodepustaka		=	$_POST["kodepustaka"];
			$status				=	(empty($_POST["status"])) ? 0 : $_POST["status"];
			$ts					=	date("Y-m-d H:i:s");
			
			
			$sqlstr = "update daftarpustaka set pustaka='$pustaka', kodepustaka='$kodepustaka', status='$status', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			$sql=$dbpdo->query("select katalog from pustaka where replid='$pustaka' ");
			$data=$sql->fetch(PDO::FETCH_OBJ);
			$foto_file = $data->photo;
			$katalog = $data->katalog;
			
			$sqlstr = "select count(replid) mcount from daftarpustaka where pustaka='$pustaka'";
			$sqlcek = $dbpdo->prepare($sqlstr);
			$sqlcek->execute();
			$rowdata = $sqlcek->fetch(PDO::FETCH_OBJ);
			$jum = $rowdata->mcount;
			
			$sqlstr = "update katalog set counter=$jum where replid='$katalog'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update konfigurasi
	function update_konfigurasi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$siswa				=	numberreplace($_POST["siswa"]);
			$pegawai			=	numberreplace($_POST["pegawai"]);
			$other				=	numberreplace($_POST["other"]);
			$denda				=	numberreplace($_POST["denda"]);
			
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update konfigurasi set siswa='$siswa', pegawai='$pegawai', other='$other', denda='$denda', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai
	function update_pegawai($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$bagian				=	$_POST["bagian"];
			$bagian				= 	str_replace("|"," ",$bagian);
			$nip				=	$_POST["nip"];
			$nama				=	petikreplace($_POST["nama"]);
			$panggilan			=	petikreplace($_POST["panggilan"]);
			$kelamin			=	$_POST["kelamin"];
			$gelar				=	$_POST["gelar"];
			$tmplahir			=	$_POST["tmplahir"];
			$tgllahir			=	date("Y-m-d", strtotime($_POST["tgllahir"]));
			$agama				=	$_POST["agama"];
			$suku				=	$_POST["suku"];
			$nikah				=	$_POST["nikah"];
            $jenis_id           =   $_POST["jenis_id"];
			$noid				=	$_POST["noid"];
			$alamat				=	petikreplace($_POST["alamat"]);
			$telpon				=	$_POST["telpon"];
			$handphone			=	$_POST["handphone"];
			$email				=	$_POST["email"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			
			$karpeg				=	$_POST["karpeg"];
			$no_sertifikasi		=	$_POST["no_sertifikasi"];
			$idjenis_sertifikasi=	(empty($_POST["idjenis_sertifikasi"])) ? 0 : $_POST["idjenis_sertifikasi"];
			$npwp				=	$_POST["npwp"];
			$nuptk				=	$_POST["nuptk"];
			$tmt_cpns			=	date("Y-m-d", strtotime($_POST["tmt_cpns"]));
			$unit_cpns			=	date("Y-m-d", strtotime($_POST["unit_cpns"]));
			$no_sk_masuk		=	$_POST["no_sk_masuk"];
			$idstatus_pegawai	=	(empty($_POST["idstatus_pegawai"])) ? 0 : $_POST["idstatus_pegawai"];
			$nik				=	$_POST["nik"];
			$nama_ibu			=	$_POST["nama_ibu"];
			$nama_pasangan		=	$_POST["nama_pasangan"];
			$tempat_lahir_pasangan	=	$_POST["tempat_lahir_pasangan"];
			$tanggal_lahir_pasangan	=	date("Y-m-d", strtotime($_POST["tanggal_lahir_pasangan"]));
			$tanggal_nikah		=	date("Y-m-d", strtotime($_POST["tanggal_nikah"]));
			$tempat_nikah		=	$_POST["tempat_nikah"];
			$pekerjaan_pasangan	=	$_POST["pekerjaan_pasangan"];
			$instansi_pasangan	=	$_POST["instansi_pasangan"];
			$nip_pasangan		=	$_POST["nip_pasangan"];
			$keluarga_tanggungan	=	(empty($_POST["keluarga_tanggungan"])) ? 0 : $_POST["keluarga_tanggungan"];
			$usia				=	petikreplace($_POST["usia"]);
			$ajar_lain			=	$_POST["ajar_lain"];
			$jumlah_jam_ajar_lain	=	(empty($_POST["jumlah_jam_ajar_lain"])) ? 0 : $_POST["jumlah_jam_ajar_lain"];
			$nama_bank			=	$_POST["nama_bank"];
			$unit_bank			=	petikreplace($_POST["unit_bank"]);
			$no_rek				=	$_POST["no_rek"];
			$nama_pemilik		=	petikreplace($_POST["nama_pemilik"]);
			$desa				=	$_POST["desa"];
			$kecamatan			=	$_POST["kecamatan"];
			$kode_pos			=	$_POST["kode_pos"];
			$tanggal_pensiun	=	date("Y-m-d", strtotime($_POST["instansi_pasangan"]));
			
			$no_sk_tetap		=	$_POST["no_sk_tetap"];
			$tanggal_sk_tetap	=	date("Y-m-d", strtotime($_POST["tanggal_sk_tetap"]));
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_pegawai/';
			$foto_file2	= $_POST["foto_file2"];
			$foto_file 	= $_FILES['foto_file']['name']; 
			$tmpname  		= $_FILES['foto_file']['tmp_name'];
			$filesize 		= $_FILES['foto_file']['size'];
			$filetype 		= $_FILES['foto_file']['type'];
			
			if (empty($foto_file)) { 
				$foto_file = $foto_file2; 
			} 
			
			if($foto_file != "") {	
				
				if($foto_file != $foto_file2) {
				
					if(!empty($foto_file2)) {
						unlink($uploaddir . $foto_file2); //remove file 
					}
					
					$foto_file = $nip . '_' . $foto_file;
				}
							
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai set bagian='$bagian', nip='$nip', nama='$nama', panggilan='$panggilan', kelamin='$kelamin', gelar='$gelar', tmplahir='$tmplahir', tgllahir='$tgllahir', agama='$agama', suku='$suku', nikah='$nikah', jenis_id='$jenis_id', noid='$noid', alamat='$alamat', telpon='$telpon', handphone='$handphone', email='$email', karpeg='$karpeg', no_sertifikasi='$no_sertifikasi', idjenis_sertifikasi='$idjenis_sertifikasi', npwp='$npwp',	nuptk='$nuptk', tmt_cpns='$tmt_cpns', unit_cpns='$unit_cpns', no_sk_masuk='$no_sk_masuk', idstatus_pegawai='$idstatus_pegawai', nik='$nik', nama_ibu='$nama_ibu', nama_pasangan='$nama_pasangan', tempat_lahir_pasangan='$tempat_lahir_pasangan', tanggal_lahir_pasangan='$tanggal_lahir_pasangan', tanggal_nikah='$tanggal_nikah', tempat_nikah='$tempat_nikah', pekerjaan_pasangan='$pekerjaan_pasangan', instansi_pasangan='$instansi_pasangan', nip_pasangan='$nip_pasangan', keluarga_tanggungan='$keluarga_tanggungan', usia='$usia', ajar_lain='$ajar_lain', jumlah_jam_ajar_lain='$jumlah_jam_ajar_lain', nama_bank='$nama_bank', unit_bank='$unit_bank', no_rek='$no_rek', nama_pemilik='$nama_pemilik', desa='$desa', kecamatan='$kecamatan', kode_pos='$kode_pos', tanggal_pensiun='$tanggal_pensiun', foto_file='$foto_file', keterangan='$keterangan', no_sk_tetap='$no_sk_tetap', tanggal_sk_tetap='$tanggal_sk_tetap', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
		
	}
	
	//------update statusguru
	function update_statusguru($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$status				=	numberreplace($_POST["status"]);
			$keterangan			=	numberreplace($_POST["keterangan"]);
			
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "update statusguru set status='$status', keterangan='$keterangan', ts='$ts' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update jabatan
	function update_jabatan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update jabatan set nama='$nama', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update jenis pelanggaran
	function update_jenis_pelanggaran($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$poin		=	numberreplace($_POST["poin"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update jenis_pelanggaran set nama='$nama', poin='$poin', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update jenis prestasi
	function update_jenis_prestasi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$poin		=	numberreplace($_POST["poin"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update jenis_prestasi set nama='$nama', poin='$poin', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pelanggaran_siswa
	function update_pelanggaran_siswa($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa			=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idjenis_pelanggaran=	(empty($_POST["idjenis_pelanggaran"])) ? 0 : $_POST["idjenis_pelanggaran"];
			$kejadian			=	petikreplace($_POST["kejadian"]);
			$hukuman			=	petikreplace($_POST["hukuman"]);
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_pelanggaran/';
			$photo2			= $_POST["photo2"];
			$photo 			= $_FILES['photo']['name']; 
			$tmpname  		= $_FILES['photo']['tmp_name'];
			$filesize 		= $_FILES['photo']['size'];
			$filetype 		= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} 
			
			if($photo != "") {	
				
				if($photo != $photo2) {
				
					if(!empty($photo2)) {
						unlink($uploaddir . $photo2); //remove file 
					}
					
					$photo = $ref . '_' . $photo;
				}
							
				$uploadfile = $uploaddir . $photo;		
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pelanggaran_siswa set tanggal='$tanggal', idsiswa='$idsiswa', idjenis_pelanggaran='$idjenis_pelanggaran', kejadian='$kejadian', hukuman='$hukuman', photo='$photo', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update konseling_siswa
	function update_konseling_siswa($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa			=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idjenis_konseling	=	(empty($_POST["idjenis_konseling"])) ? 0 : $_POST["idjenis_konseling"];
			$konseling			=	petikreplace($_POST["konseling"]);
			$solusi				=	petikreplace($_POST["solusi"]);
			$nip				=	$_POST["nip"];
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			//-----------upload file data
			$uploaddir 		= 'app/file_konseling/';
			$data_file2		= $_POST["data_file2"];
			$data_file 		= $_FILES['data_file']['name']; 
			$tmpname  		= $_FILES['data_file']['tmp_name'];
			$filesize 		= $_FILES['data_file']['size'];
			$filetype 		= $_FILES['data_file']['type'];
			
			if (empty($data_file)) { 
				$data_file = $data_file2; 
			} 
			
			if($data_file != "") {	
				
				if($data_file != $data_file2) {
				
					if(!empty($data_file2)) {
						unlink($uploaddir . $data_file2); //remove file 
					}
					
					$data_file = $ref . '_' . $nis . '_' . $data_file;
				}
							
				$uploadfile = $uploaddir . $data_file;		
				if (move_uploaded_file($_FILES['data_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$sqlstr = "update konseling_siswa set tanggal='$tanggal', idsiswa='$idsiswa', idjenis_konseling='$idjenis_konseling', konseling='$konseling', solusi='$solusi', nip='$nip', data_file='$data_file', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update pegawai_jabatan
	function update_pegawai_jabatan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$idjabatan			=	(empty($_POST["idjabatan"])) ? 0 : $_POST["idjabatan"];
			$tanggal_efektif	=	date("Y-m-d", strtotime($_POST["tanggal_efektif"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai_jabatan set idjabatan='$idjabatan', tanggal_efektif='$tanggal_efektif', keterangan='$keterangan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
    //------update jenis izin
	function update_jenis_izin($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		    =	$_POST["nama"];
			$keterangan	    =	petikreplace($_POST["keterangan"]);
            $format_surat	=	petikreplace($_POST["format_surat"]);
			$aktif		    =	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		    =	$_SESSION["loginname"];
			$dlu		    =	date("Y-m-d H:i:s");
			
			$sqlstr = "update jenis_izin set nama='$nama', keterangan='$keterangan', format_surat='$format_surat', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
    
	
    //------update izin siswa
	function update_izin_siswa($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa	    =	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
            $jam            =   $_POST["jam"];
            $menit          =   $_POST["menit"];
            $jam            =   $jam . ":" . $menit;
            echo $jam;
            $tanggal        =   date("Y-m-d H:i", strtotime($_POST["tanggal"] . " " . $jam ));
            $idjenis_izin   =	(empty($_POST["idjenis_izin"])) ? 0 : $_POST["idjenis_izin"];            
            //$format_surat	=	petikreplace($_POST["format_surat"]);
			$keterangan	    =	petikreplace($_POST["keterangan"]);
            $idpegawai	    =	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$status		    =	$_POST["status"];
			$uid		    =	$_SESSION["loginname"];
			$dlu		    =	date("Y-m-d H:i:s");
			
            //---get data siswa---
            $sqlsiswa     = "select a.nis, a.nama, b.kelas, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid where a.replid='$idsiswa'";
            $sqlsiswa     = $dbpdo->prepare($sqlsiswa);
            $sqlsiswa->execute();
            $datasiswa    = $sqlsiswa->fetch(PDO::FETCH_OBJ); 
            $nis          = $datasiswa->nis;
            $nama         = $datasiswa->nama;
            $kelas        = $datasiswa->kelas;
            $tingkat      = $datasiswa->tingkat;
            //--------end-----------
            
            //---get data pegawai---
            $sqlpeg       = "select a.nip, a.nama from pegawai a where a.replid='$idpegawai'";
            $sqlpeg       = $dbpdo->prepare($sqlpeg);
            $sqlpeg->execute();
            $datapeg      = $sqlpeg->fetch(PDO::FETCH_OBJ); 
            $nip          = $datapeg->nip;
            $namapegawai  = $datapeg->nama;
            //--------end-----------
            
            //$valuesurat    = 'NIS<span class="Apple-tab-span" style="white-space: pre;">	        </span>: ' . $nis . '</b></div><div><b>Nama<span class="Apple-tab-span" style="white-space:pre">	</span>: ' . $nama . '</b></div><div><b>Tingkat<span class="Apple-tab-span" style="white-space:pre">	</span>: '. $tingkat . '</b></div><div><b>Kelas<span class="Apple-tab-span" style="white-space: pre;">	</span>: ' . $kelas;
            
            //---get format surat---
            $sqljns     = "select format_surat from jenis_izin where replid='$idjenis_izin'";
            $sqljns     = $dbpdo->prepare($sqljns);
            $sqljns->execute();
            $datajns    = $sqljns->fetch(PDO::FETCH_OBJ); 
            //--------end-----------
            
            $format_surat = petikreplace(str_replace("@nis", $nis ,$datajns->format_surat));
            $format_surat = petikreplace(str_replace("@nama", $nama ,$format_surat));
            $format_surat = petikreplace(str_replace("@tingkat", $tingkat ,$format_surat));
            $format_surat = petikreplace(str_replace("@kelas", $kelas ,$format_surat));
            
            $format_surat = petikreplace(str_replace("@nip", $nip ,$format_surat));
            $format_surat = petikreplace(str_replace("@pegawai", $namapegawai ,$format_surat));
            
            
			$sqlstr = "update izin_siswa set tanggal='$tanggal', idsiswa='$idsiswa', idjenis_izin='$idjenis_izin', format_surat='$format_surat', keterangan='$keterangan', idpegawai='$idpegawai', status='$status', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
    
    
    //------update pangkat
	function update_pangkat($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pangkat set nama='$nama', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_pangkat
	function update_pegawai_pangkat($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$idpangkat			=	(empty($_POST["idpangkat"])) ? 0 : $_POST["idpangkat"];
			$tanggal_efektif	=	date("Y-m-d", strtotime($_POST["tanggal_efektif"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai_pangkat set idpangkat='$idpangkat', tanggal_efektif='$tanggal_efektif', keterangan='$keterangan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update jenis sertifikasi
	function update_jenis_sertifikasi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update jenis_sertifikasi set nama='$nama', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	//------update status_pegawai
	function update_status_pegawai($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update status_pegawai set nama='$nama', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_kenaikan gaji berkala
	function update_kenaikan_gaji($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$no_kgb				=	$_POST["no_kgb"];
			$gaji_pokok			=	numberreplace($_POST["gaji_pokok"]);			
			$tmt				=	date("Y-m-d", strtotime($_POST["tmt"]));
			$tanggal_kgb		=	date("Y-m-d", strtotime($_POST["tanggal_kgb"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update kenaikan_gaji set no_kgb='$no_kgb', tmt='$tmt', tanggal_kgb='$tanggal_kgb', gaji_pokok='$gaji_pokok', keterangan='$keterangan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_pendidikan
	function update_pegawai_pendidikan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$nama_sekolah		=	petikreplace($_POST["nama_sekolah"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$jenjang			=	$_POST["jenjang"];
			$lulusan			=	$_POST["lulusan"];
			$jurusan			=	$_POST["jurusan"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai_pendidikan set nama_sekolah='$nama_sekolah', tahun='$tahun', jenjang='$jenjang', lulusan='$lulusan', jurusan='$jurusan', keterangan='$keterangan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_keluarga
	function update_pegawai_keluarga($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$nama_anak			=	petikreplace($_POST["nama_anak"]);
			$tempat_lahir		=	petikreplace($_POST["tempat_lahir"]);
			$tanggal_lahir		=	date("Y-m-d", strtotime($_POST["tanggal_lahir"]));
			$pekerjaan			=	petikreplace($_POST["pekerjaan"]);
			$status				=	$_POST["status"];
			$anak_ke			=	(empty($_POST["anak_ke"])) ? 0 : $_POST["anak_ke"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai_keluarga set nama_anak='$nama_anak', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', pekerjaan='$pekerjaan', status='$status', anak_ke='$anak_ke', keterangan='$keterangan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update supplier
	function update_supplier($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$nama				=	petikreplace($_POST["nama"]);
			$alamat				=	petikreplace($_POST["alamat"]);
			$telepon			=	$_POST["telepon"];
			$hp					=	$_POST["hp"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update supplier set nama='$nama', alamat='$alamat', telepon='$telepon', hp='$hp', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_prestasi
	function update_pegawai_prestasi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$jenisprestasi		=	petikreplace($_POST["jenisprestasi"]);
			$tingkat			=	petikreplace($_POST["tingkat"]);
			$nama				=	petikreplace($_POST["nama"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$penyelenggara		=	petikreplace($_POST["penyelenggara"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai_prestasi set jenisprestasi='$jenisprestasi', tingkat='$tingkat', nama='$nama', tahun='$tahun', penyelenggara='$penyelenggara', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pegawai_penghargaan
	function update_pegawai_penghargaan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$namapenghargaan	=	petikreplace($_POST["namapenghargaan"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$pemberipenghargaan	=	petikreplace($_POST["pemberipenghargaan"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai_penghargaan set namapenghargaan='$namapenghargaan', tahun='$tahun', pemberipenghargaan='$pemberipenghargaan', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	
	//------update pegawai_skmengajar
	function update_pegawai_skmengajar($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$no_sk				=	petikreplace($_POST["no_sk"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$fungsional			=	petikreplace($_POST["fungsional"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pegawai_skmengajar set no_sk='$no_sk', tahun='$tahun', fungsional='$fungsional', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update pelajaran
	function update_pelajaran($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	$_POST["nama"];
			$departemen			=	$_POST["departemen"];
			$sifat				=	(empty($_POST["sifat"])) ? 0 : $_POST["sifat"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pelajaran set kode='$kode', nama='$nama', departemen='$departemen', sifat='$sifat', aktif='$aktif', keterangan='$keterangan', info3='$info3', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update siswa ekstrakurikuler
	function update_siswa_ekstrakurikuler($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa			=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update siswa_ekstrakurikuler set idpelajaran='$idpelajaran', tanggal='$tanggal', uid='$uid', dlu='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update semester
	function update_semester($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$semester			=	$_POST["semester"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update semester set semester='$semester', departemen='$departemen', aktif='$aktif', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update angkatan
	function update_angkatan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$angkatan			=	$_POST["angkatan"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update angkatan set angkatan='$angkatan', departemen='$departemen', aktif='$aktif', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update rpp
	function update_rpp($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$idtingkat			=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idsemester			=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$koderpp			=	$_POST["koderpp"];
			$rpp				=	petikreplace($_POST["rpp"]);
			$deskripsi			=	petikreplace($_POST["deskripsi"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update rpp set idtingkat='$idtingkat', idsemester='$idsemester', idpelajaran='$idpelajaran', koderpp='$koderpp', rpp='$rpp', deskripsi='$deskripsi', aktif='$aktif', ts='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update dasarpenilaian
	function update_dasarpenilaian($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$dasarpenilaian		=	$_POST["dasarpenilaian"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update dasarpenilaian set dasarpenilaian='$dasarpenilaian', keterangan='$keterangan', ts='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update kompetensi
	function update_kompetensi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$kompetensi			=	petikreplace($_POST["kompetensi"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update kompetensi set kode='$kode', kompetensi='$kompetensi', aktif='$aktif', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update jenis kompetensi
	function update_jeniskompetensi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$jeniskompetensi	=	petikreplace($_POST["jeniskompetensi"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "update jeniskompetensi set jeniskompetensi='$jeniskompetensi', aktif='$aktif', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update aspek_perkembangan
	function update_aspek_perkembangan($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update aspek_perkembangan set aspek='$aspek', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update aspek_psikologi
	function update_aspek_psikologi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$departemen	=	$_POST["departemen"];
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update aspek_psikologi set departemen='$departemen', aspek='$aspek', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update aspek_psikologi_detail
	function update_aspek_psikologi_detail($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$jenis_aspek_id = $_POST["jenis_aspek_id"];
			$departemen	=	$_POST["departemen"];
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update aspek_psikologi_detail set departemen='$departemen', jenis_aspek_id='$jenis_aspek_id', aspek='$aspek', aktif='$aktif', uid='$uid', dlu='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update assesmen_observasi
	function update_assesmen_observasi($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$tanggal	=	date("Y-m-d", strtotime($_POST['tanggal']));
			$idsiswa	=	$_POST["idsiswa"];
			$idpegawai	=	(empty($_POST['idpegawai'])) ? 0 : $_POST['idpegawai'];
			$idpegawai1	=	(empty($_POST['idpegawai1'])) ? 0 : $_POST['idpegawai1'];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			##get nis siswa
			$sqlstr = "select nis from siswa where replid='$idsiswa'";
			$sql = $dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$nis = $data->nis;
			
			
			//-----------upload file data
			$uploaddir 		= 'app/file_assesment/';
			$data_file2	= $_POST["data_file2"];
			$data_file 	= $_FILES['data_file']['name']; 
			$tmpname  		= $_FILES['data_file']['tmp_name'];
			$filesize 		= $_FILES['data_file']['size'];
			$filetype 		= $_FILES['data_file']['type'];
			
			if (empty($data_file)) { 
				$data_file = $data_file2; 
			} 
			
			if($data_file != "") {	
				
				if($data_file != $data_file2) {
				
					if(!empty($data_file2)) {
						unlink($uploaddir . $data_file2); //remove file 
					}
					
					$data_file = $ref . '_' . $nis . '_' . $data_file;
				}
							
				$uploadfile = $uploaddir . $data_file;		
				if (move_uploaded_file($_FILES['data_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$sqlstr = "update assesmen_observasi set tanggal='$tanggal', idsiswa='$idsiswa', idpegawai='$idpegawai', idpegawai1='$idpegawai1', data_file='$data_file', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();		
		
		
			/*------------siswa prestasi-------------*/
			/*$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($x=0; $x<=$jmldata; $x++) {
				//$delete 			= 	(empty($_POST[delete_.$x])) ? 0 : $_POST[delete_.$x];
				$old_line		 	= 	(empty($_POST[old_line_.$x])) ? 0 : $_POST[old_line_.$x];
				
				$idaspek_perkembangan	=	$_POST[idaspek_perkembangan_.$x];
				$hasil					=	petikreplace($_POST[hasil_.$x]);
				$saran					=	petikreplace($_POST[saran_.$x]);
				
				if ( $hasil != "" ) {
					
					$sqlcek = "select ref from assesmen_observasi_detail where ref='$ref' and line='$old_line' ";										
					$hasil_cek 	= $dbpdo->query($sqlcek);
					$num 		= $hasil_cek->rowCount();
					
					if($num > 0) {
						//if($delete == 0) {
							$sqlstr="update assesmen_observasi_detail set idaspek_perkembangan='$idaspek_perkembangan', hasil='$hasil', saran='$saran' where ref='$ref' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();*/
							
						/*} else {
							$sqlstr="delete from assesmen_observasi_detail where ref='$ref' and line=$old_line";
							$sql=$dbpdo->prepare($sqlstr);
							$sql->execute();							
						}*/
						
						/*
					} else {
						
						$line = maxline('assesmen_observasi_detail', 'line', 'ref', $ref, '');
				
						$sqlstr = "insert into assesmen_observasi_detail (ref, idaspek_perkembangan, hasil, saran, line) values ('$ref', '$idaspek_perkembangan', '$hasil', '$saran', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
											
					}
					
				}
			}*/
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update anggota
	function update_anggota($ref){
		
		$dbpdo = DB::create();
		
		try {
			
			$noregistrasi = $_POST["noregistrasi"];
			$nama		=	petikreplace($_POST["nama"]);
			$alamat		=	petikreplace($_POST["alamat"]);
			$kodepos	=	$_POST["kodepos"];
			$email		=	$_POST["email"];
			$telpon		=	$_POST["telpon"];
			$HP			=	$_POST["HP"];
			$pekerjaan	=	petikreplace($_POST["pekerjaan"]);
			$institusi	=	$_POST["institusi"];
			$keterangan	=	petikreplace($_POST["keterangan"]);
			$tgldaftar	=	date("Y-m-d", strtotime($_POST["tgldaftar"]));
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$telpon		=	$_POST["telpon"];
			$telpon		=	$_POST["telpon"];
			
			
			//-----------upload file photo
			$uploaddir 		= 'app/file_foto_anggota/';
			$foto2			= $_POST["foto2"];
			$foto 			= $_FILES['foto']['name']; 
			$tmpname  		= $_FILES['foto']['tmp_name'];
			$filesize 		= $_FILES['foto']['size'];
			$filetype 		= $_FILES['foto']['type'];
			
			if (empty($foto)) { 
				$foto = $foto2; 
			} 
			
			if($foto != "") {	
				
				if($foto != $foto2) {
				
					if(!empty($foto2)) {
						unlink($uploaddir . $foto2); //remove file 
					}
					
					$foto = $noregistrasi . '_' . $foto;
				}
							
				$uploadfile = $uploaddir . $foto;		
				if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------	
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "update anggota set nama='$nama', alamat='$alamat', kodepos='$kodepos', email='$email', telpon='$telpon', HP='$HP', pekerjaan='$pekerjaan', institusi='$institusi', keterangan='$keterangan', tgldaftar='$tgldaftar', aktif='$aktif', foto='$foto', ts='$dlu' where replid='$ref'";
			
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();	
			
			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
		//--------------------------/\
		
	}
	
	
	//------update user reminder
	function update_usr_reminder(){
		$dbpdo = DB::create();
		
		try {
			
			$usrid		=	$_SESSION["loginname"];
			
			
			//----------insert user detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=1; $i<=$jmldata; $i++) {
				$mview 			= (empty($_POST[mview_.$i])) ? 0 : $_POST[mview_.$i];
				$old_reminder_id= $_POST[old_reminder_id_.$i];
				$rmd_old 		= (empty($_POST[rmd_old_.$i])) ? 0 : $_POST[rmd_old_.$i];
				
				$reminder_id 	= $_POST[reminder_id_.$i];
				
				if ($rmd_old==1) {
					if ($mview==1) {
						$sqlstr = "update usr_reminder set reminder_id='$reminder_id' where usrid='$usrid' and reminder_id='$old_reminder_id' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$sqlstr = "delete from usr_reminder where usrid='$usrid' and reminder_id='$old_reminder_id' ";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}	
				} 
				
				
				if ($rmd_old==0) {
				
					if ($mview==1) {			
						$sqlstr = "insert into usr_reminder
						(usrid, reminder_id)
							values
							(
								'".$usrid."',
								'".$reminder_id."'
							)";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
						
					}
				}
				
			}
				
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	
	//------update evaluasi_psikologi
	function update_evaluasi_psikologi($ref){
		$dbpdo = DB::create();
		
		try {
			
			$old_ref	=	$_POST["old_ref"];
			if($old_ref != "") {
				$ref = $old_ref;
			}
			
			$tanggal	=	date("Y-m-d", strtotime($_POST['tanggal']));
			$departemen	=	$_POST["departemen"];
			$idtingkat	= 	$_POST["idtingkat"];
			$idkelas	= 	$_POST["idkelas"];
			$nis		=	$_POST["nis"];
			$idpegawai	=	(empty($_POST['idpegawai'])) ? 0 : $_POST['idpegawai'];
			$idsemester = 	$_POST["idsemester"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			
			$sqlstr = "update evaluasi_psikologi set tanggal='$tanggal', uid='$uid', dlu='$dlu' where ref='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
						
			/*--------update detail--------*/
			$iq	=	$_POST['iq'];
			$jmldata_jenis_aspek = $_POST['jmldata_jenis_aspek'];
			for($y=0; $y<$jmldata_jenis_aspek; $y++) {
				$jenis_aspek_id	=	$_POST[jenis_aspek_id_.$y];
				
				
				$jml_aspek_detail = $_POST[jml_aspek_detail_.$y];
				for($z=0; $z<$jml_aspek_detail; $z++) {
					
					$aspek_psikologi_id	= 	$_POST[aspek_psikologi_detail_id_.$y.$z];
					$nilai				=	$_POST[nilai_.$y.$z];
					$old_line			=	$_POST[old_line_.$y.$z];
					
					##cek detail
					$sqlstr = "select ref from evaluasi_psikologi_detail where ref='$ref' and jenis_aspek_id='$jenis_aspek_id' and aspek_psikologi_id='$aspek_psikologi_id'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$rowsdet = $sql->rowCount();
					
					if($rowsdet > 0) {
						$sqlstr = "update evaluasi_psikologi_detail set iq='$iq', nilai='$nilai' where ref='$ref' and jenis_aspek_id='$jenis_aspek_id' and aspek_psikologi_id='$aspek_psikologi_id'";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$line = maxline('evaluasi_psikologi_detail', 'line', 'ref', $ref, '');
					
						$sqlstr = "insert into evaluasi_psikologi_detail (ref, iq, nilai, jenis_aspek_id, aspek_psikologi_id, line) values ('$ref', '$iq', '$nilai', '$jenis_aspek_id', '$aspek_psikologi_id', '$line')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
					
					
				
				}
				
			}
				
				
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	
}

?>
