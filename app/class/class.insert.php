<?php

class insert{

	//------insert user
	function insert_usr($ref,$photo){
		$dbpdo = DB::create();
		
		try {
			
			$usrid		=	$_POST["usrid"];
			$old_usrid	=	$_POST["old_usrid"];				
			$pass_ori	=	$_POST["pwd"];
			$pwd		=	obraxabrix($pass_ori, $usrid);
			
			$adm		=	(empty($_POST["adm"])) ? 0 : $_POST["adm"];
			$departemen	=	$_POST["departemen"];
			//$employee_id=	(empty($_POST["employee_id"])) ? 0 : $_POST["employee_id"];
			
			//-----------upload file
		  	/*$photo2				= $_POST["photo2"];
			$uploaddir_photo 	= 'app/photo_usr/';
			$photo				= $_FILES['photo']['name']; 
			$tmpname_photo 		= $_FILES['photo']['tmp_name'];
			$filesize_photo 	= $_FILES['photo']['size'];
			$filetype_photo 	= $_FILES['photo']['type'];
			
			if (empty($photo)) { 
				$photo = $photo2; 
			} else {
				$photo = $photo;
			}
			
			if($photo != "") {
				$photo = $usrid . '_' . $photo;
				$uploaddir_photo = $uploaddir_photo . $photo;		
				// proses upload file ke folder 'data'
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaddir_photo)) {
					echo "";											
				} 	
			}	*/
			//----------------
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			$act		=	(empty($_POST["active"])) ? 0 : $_POST["active"];
			
			$sqlstr = "insert into usr(usrid,pwd,adm,departemen,act,uid,dlu) values('$usrid','$pwd','$adm','$departemen','$act','$uid','$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
					
			//----------insert user detail
			$usr_jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=1; $i<=$usr_jmldata; $i++) {
				$usr_slc = (empty($_POST[usr_slc_.$i])) ? 0 : $_POST[usr_slc_.$i];
				
				if ($usr_slc==1) { 				
					$usr_frmcde = $_POST[usr_frmcde_.$i];
					$usr_add = (empty($_POST[usr_add_.$i])) ? 0 : $_POST[usr_add_.$i];
					$usr_edt = (empty($_POST[usr_edt_.$i])) ? 0 : $_POST[usr_edt_.$i];
					$usr_dlt = (empty($_POST[usr_dlt_.$i])) ? 0 : $_POST[usr_dlt_.$i];
					$usr_lvl = (empty($_POST[usr_lvl_.$i])) ? 0 : $_POST[usr_lvl_.$i];
									
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
			
			//--------insert table user backup
			$sqlstr = "insert into usr_bup(usrid,pwd) values('$usrid','$_POST[pwd]')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert registrasi
	function insert_registrasi($ref){
		$dbpdo = DB::create();
		
		try {
			
            $departemen         =   $_POST["departemen"];
			$idproses			=	$_POST["idproses"];
			$idkelompok			=	$_POST["idkelompok"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$nopendaftaran		=	$_POST["nopendaftaran"];
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
			$tahunmasuk		=	date("Y");
			$almayah			=	(empty($_POST["almayah"])) ? 0 : $_POST["almayah"];
			$almibu				=	(empty($_POST["almibu"])) ? 0 : $_POST["almibu"];
			$idjenis_tinggal	=	$_POST["idjenis_tinggal"];
			$idminat			=	$_POST['idminat'];
			$idminat1			=	$_POST['idminat1'];
			
			$ref=notran($tanggal, 'frmregistrasi', '', '', $idkelompok);
			$nopendaftaran = $ref;
			
			//-----------upload file foto
			$uploaddir = 'app/file_foto/';
			$foto_file = $_FILES['foto_file']['name']; 
			$tmpname  = $_FILES['foto_file']['tmp_name'];
			$filesize = $_FILES['foto_file']['size'];
			$filetype = $_FILES['foto_file']['type'];

			
			if($foto_file != "") {			
				$foto_file = $nopendaftaran . $idkelas . '_' . $foto_file;					
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			//-----------upload file fotocopy golongan darah
			$darah			=	$_POST["darah"];
			$uploaddir = 'app/file_darah_calon/';
			$file_darah = $_FILES['file_darah']['name']; 
			$tmpname  = $_FILES['file_darah']['tmp_name'];
			$filesize = $_FILES['file_darah']['size'];
			$filetype = $_FILES['file_darah']['type'];

			
			if($file_darah != "") {			
				$file_darah = $nopendaftaran . '_' . $file_darah;					
				$uploadfile = $uploaddir . $file_darah;		
				if (move_uploaded_file($_FILES['file_darah']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			$sqlstr = "insert into calonsiswa (departemen, idproses, idkelompok, tanggal, nopendaftaran, idtingkat, idjurusan, idminat, idminat1, foto_file, darah, file_darah, nama, panggilan, kelamin, nisn, nis, noijazah, tahunijazah, skhun, noujian, nik, tmplahir, tgllahir, agama, kebutuhan_khusus_chk, kebutuhan_khusus, tahunmasuk, alamatsiswa, dusun, rt, rw, kelurahan, kodepossiswa, kecamatan, kabupaten, provinsi, transportasi, transportasi_kode, citacita, citacita_lain, idjenis_tinggal, jenis_tinggal, telponsiswa, hpsiswa, emailsiswa, kps, nokps, nokip, nokks, namaayah, tahunayah, alamatortu, kodeposortu, hportu, butuhkhususayah, butuhkhususketayah, pekerjaanayah, pekerjaanayah_lain, pendidikanayah, penghasilanayah, penghasilanayah_kode, namaibu, tahunibu, butuhkhususibu, butuhkhususketibu, pekerjaanibu, pekerjaanibu_lain, pendidikanibu, penghasilanibu, penghasilanibu_kode, wali, tahunwali, pekerjaanwali, pekerjaanwali_lain, pendidikanwali, penghasilanwali, tinggi, berat, jaraksekolah, jarak_km, waktutempuh, waktutempuh_menit, jsaudara, almayah, almibu, alamatibu, kodeposibu, hpibu, uid, dlu) values ('$departemen', '$idproses', '$idkelompok', '$tanggal', '$nopendaftaran', '$idtingkat', '$idjurusan', '$idminat', '$idminat1', '$foto_file', '$darah', '$file_darah', '$nama', '$panggilan', '$kelamin', '$nisn', '$nis', '$noijazah', '$tahunijazah', '$skhun', '$noujian', '$nik', '$tmplahir', '$tgllahir', '$agama', '$kebutuhan_khusus_chk', '$kebutuhan_khusus', '$tahunmasuk', '$alamatsiswa', '$dusun', '$rt', '$rw', '$kelurahan', '$kodepossiswa', '$kecamatan', '$kabupaten', '$provinsi', '$transportasi', '$transportasi_kode', '$citacita', '$citacita_lain', '$idjenis_tinggal', '$jenis_tinggal', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$kps', '$nokps', '$nokip', '$nokks', '$namaayah', '$tahunayah', '$alamatortu', '$kodeposortu', '$hportu', '$butuhkhususayah', '$butuhkhususketayah', '$pekerjaanayah', '$pekerjaanayah_lain', '$pendidikanayah', '$penghasilanayah', '$penghasilanayah_kode', '$namaibu', '$tahunibu', '$butuhkhususibu', '$butuhkhususketibu', '$pekerjaanibu', '$pekerjaanibu_lain', '$pendidikanibu', '$penghasilanibu', '$penghasilanibu_kode', '$wali', '$tahunwali', '$pekerjaanwali', '$pekerjaanwali_lain', '$pendidikanwali', '$penghasilanwali', '$tinggi', '$berat', '$jaraksekolah', '$jarak_km', '$waktutempuh', '$waktutempuh_menit', '$jsaudara', '$almayah', '$almibu', '$alamatibu', '$kodeposibu', '$hpibu', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			notran($tanggal, 'frmregistrasi', 1, '', $idkelompok) ;
			
			$sqlstr 		= 	"select last_insert_id() last_id";
			$results		=	$dbpdo->query($sqlstr);
			$data 			=  	$results->fetch(PDO::FETCH_OBJ);
			$idcalonsiswa	=	$data->last_id;
			
			//----------insert prestasi detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];		
			for ($x=0; $x<=$jmldata; $x++) {
				$jenisprestasi_ 	=	$_POST[jenisprestasi_.$x];
				$tingkat_ 			=	$_POST[tingkat_.$x];
				$nama_			 	=	$_POST[nama_.$x];
				$tahun_			 	=	(empty($_POST[tahun_.$x])) ? 0 : $_POST[tahun_.$x];
				$penyelenggara_		=	$_POST[penyelenggara_.$x];
				
				$line = maxline('calonsiswa_prestasi', 'line', 'idcalonsiswa', $idcalonsiswa, '');
				
				if ( !empty($jenisprestasi_) ) {
					$sqlstr = "insert into calonsiswa_prestasi (idcalonsiswa, jenisprestasi, tingkat, nama, tahun, penyelenggara, line) values ('$idcalonsiswa', '$jenisprestasi_', '$tingkat_', '$nama_', '$tahun_', '$penyelenggara_', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
			//----------insert beasiswa detail
			$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];		
			for ($x=0; $x<=$jmldata2; $x++) {
				$jenis_ 			=	$_POST[jenis_.$x];
				$penyelenggara2_	=	$_POST[penyelenggara_.$x];
				$tahunmulai_	 	=	(empty($_POST[tahunmulai_.$x])) ? 0 : $_POST[tahunmulai_.$x];
				$tahunselesai_	 	=	(empty($_POST[tahunselesai_.$x])) ? 0 : $_POST[tahunselesai_.$x];
				
				$line = maxline('calonsiswa_beasiswa', 'line', 'idcalonsiswa', $idcalonsiswa, '');
				
				if ( !empty($jenis_) ) {
					$sqlstr = "insert into calonsiswa_beasiswa (idcalonsiswa, jenis, penyelenggara, tahunmulai, tahunselesai, line) values ('$idcalonsiswa', '$jenis_', '$penyelenggara2_', '$tahunmulai_', '$tahunselesai_', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert siswa
	function insert_siswa($ref){
		$dbpdo = DB::create();
		
		try {
			
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
			$alamatortu			=	$_POST["alamatortu"];
			$kodepossiswa		=	$_POST["kodepossiswa"];
			$telponsiswa		=	$_POST["telponsiswa"];
			$hpsiswa			=	$_POST["hpsiswa"];
			$emailsiswa			=	$_POST["emailsiswa"];
			$jenistinggal		=	$_POST["jenistinggal"];
			$kps				=	(empty($_POST["kps"])) ? 0 : $_POST["kps"];
			$nokps				=	$_POST["nokps"];
			$kip				=	(empty($_POST["kip"])) ? 0 : $_POST["kip"];
			$nokip				=	$_POST["nokip"];
			$namakip			=	$_POST["namakip"];
			$nokks				=	$_POST["nokks"];
			$no_akte_lahir		=	$_POST["no_akte_lahir"];
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
			$uploaddir = 'app/file_darah/';
			$file_darah = $_FILES['file_darah']['name']; 
			$tmpname  = $_FILES['file_darah']['tmp_name'];
			$filesize = $_FILES['file_darah']['size'];
			$filetype = $_FILES['file_darah']['type'];

			
			if($file_darah != "") {			
				$file_darah = $nis . $idkelas . '_' . $file_darah;					
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
			
			/*--------Lain lain ------*/
			$rombel_id			=	(empty($_POST["rombel_id"])) ? 0 : $_POST["rombel_id"];
			$nama_bank			=	$_POST["nama_bank"];
			$no_rekening_bank	=	$_POST["no_rekening_bank"];
			$nama_pemilik_bank	=	$_POST["nama_pemilik_bank"];
			$pip				=	(empty($_POST["pip"])) ? 0 : $_POST["pip"];
			$alasan_pip			=	petikreplace($_POST["alasan_pip"]);
			$virtualaccount		=	$_POST['virtualaccount'];
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//-----------upload file foto
			$uploaddir = 'app/file_foto_siswa/';
			$foto_file = $_FILES['foto_file']['name']; 
			$tmpname  = $_FILES['foto_file']['tmp_name'];
			$filesize = $_FILES['foto_file']['size'];
			$filetype = $_FILES['foto_file']['type'];

			
			if($foto_file != "") {			
				$foto_file = $nis . '_' . $foto_file;					
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$sqlstr = "insert into siswa (nis, nisn, nik, idangkatan, idangkatan1, foto_file, nama, panggilan, idkelas, kelamin, tmplahir, tgllahir, agama, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, desa_kode, kecamatan_kode, kota_kode, provinsi_kode, alamatsiswa, rt_siswa, rw_siswa, dusun, desa, kecamatan, kodepossiswa, jenistinggal, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, transportasi_kode, kps, nokps, kip, nokip, namakip, nokks, no_akte_lahir, transportasi_lain, jaraksekolah, kesekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, nik_ayah, namaayah, nik_ibu, namaibu, tmplahirayah, tgllahirayah, tempat_bekerja_ayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah_kode, penghasilanayah, penghasilanibu_kode, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, nik_wali, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali_kode, penghasilanwali, tempat_bekerja_wali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, tempat_bekerja_ibu, pekerjaanwali_lain, rombel_id, nama_bank, no_rekening_bank, nama_pemilik_bank, pip, alasan_pip, uid, ts) values ('$nis', '$nisn', '$nik', '$idangkatan', '$idangkatan1', '$foto_file', '$nama', '$panggilan', '$idkelas', '$kelamin', '$tmplahir', '$tgllahir', '$agama', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$desa_kode', '$kecamatan_kode', '$kota_kode', '$provinsi_kode', '$alamatsiswa', '$rt_siswa', '$rw_siswa', '$dusun', '$desa', '$kecamatan', '$kodepossiswa', '$jenistinggal', '$alamatortu', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$telponortu', '$hportu', '$hpibu', '$transportasi_kode', '$kps', '$nokps', '$kip', '$nokip', '$namakip', '$nokks', '$no_akte_lahir', '$transportasi_lain', '$jaraksekolah', '$kesekolah', '$berat', '$tinggi', '$kesehatan', '$darah', '$file_darah', '$kelainan', '$asalsekolah_id', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$nik_ayah', '$namaayah', '$nik_ibu', '$namaibu', '$tmplahirayah', '$tgllahirayah', '$tempat_bekerja_ayah', '$tmplahiribu', '$tgllahiribu', '$pekerjaanayah', '$pekerjaanibu', '$penghasilanayah_kode', '$penghasilanayah', '$penghasilanibu_kode', '$penghasilanibu', '$pendidikanayah', '$pendidikanibu', '$wnayah', '$wnibu', '$nik_wali', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$penghasilanwali_kode', '$penghasilanwali', '$tempat_bekerja_wali', '$alamatwali', '$hpwali', '$hubungansiswa', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$tempat_bekerja_ibu', '$pekerjaanwali_lain', '$rombel_id', '$nama_bank', '$no_rekening_bank', '$nama_pemilik_bank', '$pip', '$alasan_pip', '$uid', '$dlu')";
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
			}
			
			//-------get last ID
			$sqlstr 		= 	"select last_insert_id() last_id";
			$results		=	$dbpdo->query($sqlstr);
			$data 			=  	$results->fetch(PDO::FETCH_OBJ);
			$idsiswa		=	$data->last_id;
			
			//----------insert prestasi detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];		
			for ($x=0; $x<=$jmldata; $x++) {
				$jenisprestasi_ 	=	$_POST[jenisprestasi_.$x];
				$tingkat_ 			=	$_POST[tingkat_.$x];
				$nama_			 	=	$_POST[nama_.$x];
				$tahun_			 	=	(empty($_POST[tahun_.$x])) ? 0 : $_POST[tahun_.$x];
				$penyelenggara_		=	$_POST[penyelenggara_.$x];
				
				$line = maxline('siswa_prestasi', 'line', 'idsiswa', $idsiswa, '');
				
				if ( !empty($jenisprestasi_) ) {
					$sqlstr = "insert into siswa_prestasi (idsiswa, jenisprestasi, tingkat, nama, tahun, penyelenggara, line) values ('$idsiswa', '$jenisprestasi_', '$tingkat_', '$nama_', '$tahun_', '$penyelenggara_', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
			//----------insert beasiswa detail
			$jmldata2 = (empty($_POST['jmldata2'])) ? 0 : $_POST['jmldata2'];		
			for ($x=0; $x<=$jmldata2; $x++) {
				$jenis_ 			=	$_POST[jenis_.$x];
				$penyelenggara2_	=	$_POST[penyelenggara_.$x];
				$tahunmulai_	 	=	(empty($_POST[tahunmulai_.$x])) ? 0 : $_POST[tahunmulai_.$x];
				$tahunselesai_	 	=	(empty($_POST[tahunselesai_.$x])) ? 0 : $_POST[tahunselesai_.$x];
				
				$line = maxline('siswa_beasiswa', 'line', 'idsiswa', $idsiswa, '');
				
				if ( !empty($jenis_) ) {
					$sqlstr = "insert into siswa_beasiswa (idsiswa, jenis, penyelenggara, tahunmulai, tahunselesai, line) values ('$idsiswa', '$jenis_', '$penyelenggara2_', '$tahunmulai_', '$tahunselesai_', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert prosespenerimaansiswa
	function insert_prosespenerimaansiswa(){
		$dbpdo = DB::create();
		
		try {
			
			$proses				=	$_POST["proses"];
			$kodeawalan			=	$_POST["kodeawalan"];
			$departemen			=	'SMA';
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into prosespenerimaansiswa (proses, kodeawalan, departemen, keterangan, aktif, ts) values ('$proses', '$kodeawalan', '$departemen', '$keterangan', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert kelompokcalonsiswa
	function insert_kelompokcalonsiswa(){
		$dbpdo = DB::create();
		
		try {
			
			$idproses			=	$_POST["idproses"];
			$kapasitas			=	numberreplace($_POST["kapasitas"]);
			$kelompok			=	$_POST["kelompok"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into kelompokcalonsiswa (idproses, kapasitas, kelompok, keterangan, ts) values ('$idproses', '$kapasitas', '$kelompok', '$keterangan', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert departemen
	function insert_departemen(){
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$nipkepsek			=	$_POST["nipkepsek"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into departemen (departemen, nipkepsek, urutan, keterangan, aktif, ts) values ('$departemen', '$nipkepsek', '$urutan', '$keterangan', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert tingkat
	function insert_tingkat(){
		$dbpdo = DB::create();
		
		try {
			
			$tingkat			=	$_POST["tingkat"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into tingkat (tingkat, departemen, aktif, keterangan, urutan, ts) values ('$tingkat', '$departemen', '$aktif', '$keterangan', '$urutan', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert kelas
	function insert_kelas(){
		$dbpdo = DB::create();
		
		try {
			
			$idtahunajaran		=	$_POST["idtahunajaran"];
			$idtingkat			=	$_POST["idtingkat"];
			$kelas				=	$_POST["kelas"];
			$kapasitas			=	$_POST["kapasitas"];
			$nipwali			=	$_POST["nipwali"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);;			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into kelas (idtahunajaran, idtingkat, kelas, kapasitas, nipwali, aktif, keterangan, ts) values ('$idtahunajaran', '$idtingkat', '$kelas', '$kapasitas', '$nipwali', '$aktif', '$keterangan', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert tahun ajaran
	function insert_tahunajaran(){
		$dbpdo = DB::create();
		
		try {
			
			$tahunajaran		=	$_POST["tahunajaran"];
			$tglmulai			=	date("Y-m-d", strtotime($_POST["tglmulai"]));
			$tglakhir			=	date("Y-m-d", strtotime($_POST["tglakhir"]));
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$departemen			=	$_POST['departemen'];			
			$dlu				=	date("Y-m-d H:i:s");
			
			/*non aktifkan tahunajaran yg sebelumnya*/
			/*$sqlstr = "update tahunajaran set aktif=0 where departemen='$departemen'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();*/
			
			$sqlstr = "insert into tahunajaran (tahunajaran, departemen, tglmulai, tglakhir, aktif, keterangan, ts) values ('$tahunajaran', '$departemen', '$tglmulai', '$tglakhir', '$aktif', '$keterangan', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert agama
	function insert_agama(){
		$dbpdo = DB::create();
		
		try {
			
			$agama				=	$_POST["agama"];
			$urutan				=	(empty($_POST["urutan"])) ? 0 : $_POST["urutan"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into agama (agama, urutan, ts) values ('$agama', '$urutan', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert tahun buku
	function insert_tahunbuku(){
		$dbpdo = DB::create();
		
		try {
			
			$tahunbuku			=	$_POST["tahunbuku"];
			$awalan				=	$_POST["awalan"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$departemen		=	$_POST["departemen"];
			$tanggalmulai		=	date("Y-m-d", strtotime($_POST['tanggalmulai']));
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into tahunbuku (tahunbuku, awalan, aktif, keterangan, departemen, tanggalmulai, ts) values ('$tahunbuku', '$awalan', '$aktif', '$keterangan', '$departemen', '$tanggalmulai', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert rekakun
	function insert_rekakun($kode){
		$dbpdo = DB::create();
		
		try {
			
			$kategori			=	$_POST["kategori"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into rekakun (kode, kategori, nama, keterangan, ts) values ('$kode', '$kategori', '$nama', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert datapenerimaan
	function insert_datapenerimaan(){
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
			
			$sqlstr = "insert into datapenerimaan (idkategori, departemen, nama, rekkas, rekpendapatan, rekpiutang, keterangan, nourut, aktif, full, ts) values ('$idkategori', '$departemen', '$nama', '$rekkas', '$rekpendapatan', '$rekpiutang', '$keterangan', '$nourut', '$aktif', '$full', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert datapengeluaran
	function insert_datapengeluaran(){
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$nama				=	$_POST["nama"];
			$rekdebet			=	$_POST["rekdebet"];
			$rekkredit			=	$_POST["rekkredit"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into datapengeluaran (departemen, nama, rekdebet, rekkredit, keterangan, aktif, ts) values ('$departemen', '$nama', '$rekdebet', '$rekkredit', '$keterangan', '$aktif', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert besarjtt
	function insert_besarjtt($semua=0){
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$idangkatan			=	$_POST["idangkatan"];
			$idpenerimaan		=	$_POST["idpenerimaan"];
			$idtingkat			=	$_POST["idtingkat"];
			$idkelas			=	$_POST["idkelas"];
			$besar				=	numberreplace($_POST["besar"]);
			$cicilan			=	numberreplace($_POST["cicilan"]);
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			$uid				=	$_SESSION["loginname"];
			//$tahunbuku			=	$_SESSION["tahunbuku"];
			$potongan			=	numberreplace($_POST["potongan"]);
			
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
					}
				}
				
			} else {
				$nis	=	$_POST["nis"];				
				
				$sqlstr = "insert into besarjtt (nis, idpenerimaan, besar, cicilan, keterangan, pengguna, info2, ts, potongan) values ('$nis', '$idpenerimaan', '$besar', '$cicilan', '$keterangan', '$uid', '$tahunbuku', '$ts', '$potongan')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert perpustakaan
	function insert_perpustakaan(){
		$dbpdo = DB::create();
		
		try {
			
			$departemen			=	$_POST["departemen"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into perpustakaan (nama, keterangan, ts) values ('$nama', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//----update perpustakaan identitas
			$strcek = "select perpustakaan from identitas where departemen='$departemen' ";
			$sqlcek=$dbpdo->query($strcek);
			$datacheck = $sqlcek->rowCount();
			if($datacheck > 0) {
				$sqlstr = "update identitas set perpustakaan='$nama' where departemen='$departemen' ";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert format
	function insert_format(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	$_POST["nama"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into format (kode, nama, keterangan, ts) values ('$kode', '$nama', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert rak
	function insert_rak(){
		$dbpdo = DB::create();
		
		try {
			
			$rak				=	$_POST["rak"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into rak (rak, keterangan, ts) values ('$rak', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert katalog
	function insert_katalog(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$nama				=	petikreplace($_POST["nama"]);
			$rak				=	(empty($_POST["rak"])) ? 0 : $_POST["rak"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into katalog (kode, nama, rak, keterangan, ts) values ('$kode', '$nama', '$rak', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert penerbit
	function insert_penerbit(){
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
			
			$sqlstr = "insert into penerbit (kode, nama, alamat, telpon, email, fax, website, kontak, keterangan, ts) values ('$kode', '$nama', '$alamat', '$telpon', '$email', '$fax', '$website', '$kontak', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert penulis
	function insert_penulis(){
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
			
			$sqlstr = "insert into penulis (kode, gelardepan, nama, gelarbelakang, kontak, biografi, keterangan, ts) values ('$kode', '$gelardepan', '$nama', '$gelarbelakang', '$kontak', '$biografi', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pustaka
	function insert_pustaka(){
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
			
			//-----------upload file foto
			$uploaddir = 'app/file_foto_pustaka/';
			$photo = $_FILES['photo']['name']; 
			$tmpname  = $_FILES['photo']['tmp_name'];
			$filesize = $_FILES['photo']['size'];
			$filetype = $_FILES['photo']['type'];

			
			if($photo != "") {			
				$photo = $format . '_' . $photo;					
				$uploadfile = $uploaddir . $photo;		
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$harga				=	numberreplace($_POST["harga"]);
			$jumlah				=	numberreplace($_POST["jumlah"]);
			$departemen			=	$_POST["departemen"];
			$tanggal_masuk		=	date("Y-m-d", strtotime($_POST["tanggal_masuk"]));
			$keterangan_pustaka	=	$_POST["keterangan_pustaka"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pustaka (judul, abstraksi, keyword, tahun, keteranganfisik, penulis, penerbit, format, katalog, photo, keterangan, harga, info1, info2, info3, departemen, tanggal_masuk, keterangan_pustaka, ts) values ('$judul', '$abstraksi', '$keyword', '$tahun', '$keteranganfisik', '$penulis', '$penerbit', '$format', '$katalog', '$photo', '$keterangan', '$harga', '', '', '', '$departemen', '$tanggal_masuk', '$keterangan_pustaka', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr 	= "select last_insert_id() lastid";
			$sqllast	= $dbpdo->query($sqlstr);
			$datalast	= $sqllast->fetch(PDO::FETCH_OBJ);
			$lastid		= $datalast->lastid;
			
			/*--------insert jumlah--------*/
			$sqlstr 	= 	"select counter from katalog where replid='$katalog'";
			$sqlcek		=	$dbpdo->query($sqlstr);
			$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
			$counter 	= 	$data->counter;
		
			$replid		=	1;
			
			if($kodepustaka_crt == "" && $jumlah > 1) {
				
				for($n=1; $n<=$jumlah; $n++) {
					$counter++;
					$sqlstr = "update katalog set counter=$counter where replid='$katalog'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$kodepustaka = GenKodePustaka($katalog,$penulis,$judul,$format,$counter);
					$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka) values ('$lastid', '$replid', '$kodepustaka')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
			} else {
				
				$sqlstr = "update katalog set counter=ifnull(counter,0) + $counter where replid='$katalog'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				
				$kodepustaka = $kodepustaka_crt; //GenKodePustaka($katalog,$penulis,$judul,$format,$counter);
				$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka) values ('$lastid', '$replid', '$kodepustaka')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
			
			//----------insert pustaka supplier
			$pustaka_id = $lastid;
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];		
			for ($x=0; $x<=$jmldata; $x++) {
				$supplier_id	=	$_POST[supplier_id_.$x];
				
				if ( !empty($supplier_id) ) {
					$sqlstr = "insert into pustaka_supplier (pustaka_id, supplier_id) values ('$pustaka_id', '$supplier_id')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert daftarpustaka
	function insert_daftarpustaka(){
		$dbpdo = DB::create();
		
		try {
			
			$pustaka			=	$_POST["pustaka"];
			$perpustakaan		=	1;
			$kodepustaka		=	$_POST["kodepustaka"];
			$status				=	(empty($_POST["status"])) ? 0 : $_POST["status"];
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into daftarpustaka (pustaka, perpustakaan, kodepustaka, status, ts) values ('$pustaka', '$perpustakaan', '$kodepustaka', '$status', '$ts')";
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
	}
	
	
	//-----insert pinjam
	function insert_pinjam(){
		$dbpdo = DB::create();
		
		try {
			
			$tglditerima	=	date("Y-m-d");
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];		
			for ($x=0; $x<=$jmldata; $x++) {
				
				$replid 	 = $_POST[replid_.$x];
				$kodepustaka = $_POST[kodepustaka_.$x];
				
				if ( !empty($kodepustaka) ) {
					$sqlstr = "update pinjam set status=1, tglditerima='$tglditerima', petugaspinjam='$uid', ts='$dlu' where replid='$replid'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					$sqlstr = "update daftarpustaka set status=0 where kodepustaka='$kodepustaka'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pinjam detail
	function insert_pinjam_detail($idanggota){
		$dbpdo = DB::create();
		
		try {
			
			$kodepustaka		=	$_POST["kodepustaka"];
			$tglpinjam			=	date("Y-m-d", strtotime($_POST["tglpinjam"]));
			$tglkembali			=	date("Y-m-d", strtotime($_POST["tglkembali"]));
			$keterangan			=	$_POST["keterangan"];
			$departemen			=	$_POST["departemen"];
			$jenis_anggota		=	$_POST["jenis_anggota"];
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pinjam (kodepustaka, tglpinjam, tglkembali, idanggota, keterangan, status, tglditerima, departemen, jenis_anggota, petugaspinjam, ts) values ('$kodepustaka', '$tglpinjam', '$tglkembali', '$idanggota', '$keterangan', 0, '0000-00-00', '$departemen', '$jenis_anggota', '$uid', '$dlu')";
            $sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert pinjam batal
	function insert_pinjam_batal(){
		$dbpdo = DB::create();
		
		try {
			
			$tglditerima	=	date("Y-m-d");
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];		
			for ($x=0; $x<=$jmldata; $x++) {
				
				$replid 	 = $_POST[replid_.$x];
				$kodepustaka = $_POST[kodepustaka_.$x];
				
				$sqlstr = "delete from pinjam where replid='$replid'";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
					
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert kembali
	function insert_kembali($ref){
		$dbpdo = DB::create();
		
		try {
			
			$kodepustaka	=	$_POST["kodepustaka"];
			$tglditerima	=	date("Y-m-d");
			$keterangan		=	$_POST["keterangan"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "update pinjam set status=2, tglditerima='$tglditerima', keterangan='$keterangan', petugaskembali='$uid', ts='$dlu' where replid='$ref'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$sqlstr = "update daftarpustaka set status=1 where kodepustaka='$kodepustaka'";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			$telat			=	$_POST["terlambat"];
			$denda			=	numberreplace($_POST["denda"]);
			$idpinjam		=	$ref;
			if($denda != 0){
				$sqlstr = "insert into denda(idpinjam, denda, telat, keterangan, ts) values('$idpinjam', '$denda', '$telat', '$keterangan', '$dlu')";
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
			}
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert konfigurasi
	function insert_konfigurasi(){
		$dbpdo = DB::create();
		
		try {
			
			$siswa				=	numberreplace($_POST["siswa"]);
			$pegawai			=	numberreplace($_POST["pegawai"]);
			$other				=	numberreplace($_POST["other"]);
			$denda				=	numberreplace($_POST["denda"]);
			
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into konfigurasi (siswa, pegawai, other, denda, ts) values ('$siswa', '$pegawai', '$other', '$denda', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert kenaikan kelas
	function insert_kenaikan($idkelas, $idkelas2){
		$dbpdo = DB::create();
		
		try {
			
			$idangkatan2 = $_POST["idangkatan2"];
			$mulai	=	date("Y-m-d");
			$ts		=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];	
			
			for ($x=0; $x<=$jmldata; $x++) {
				
				$naik 	 	= $_POST[naik_.$x];
				$nis 	 	= $_POST[nis_.$x];
				$keterangan = $_POST[keterangan_.$x];
				
				if($naik > 0 && $nis != "") {
					
					//get kelas awal
					if($idkelas == "") {
						$strsql = "select a.idkelas from siswa a where a.nis='$nis'";
						$sqlkelas=$dbpdo->prepare($strsql);
						$sqlkelas->execute();
						$data_kelas = $sqlkelas->fetch(PDO::FETCH_OBJ);
						$idkelas = $data_kelas->idkelas;
					}
					//-----------/\--------------
					
					
					//----update siswa kelas baru
					$sql_naik="update siswa set idkelas='$idkelas2', idangkatan='$idangkatan2' where nis='$nis'";
					$sql=$dbpdo->prepare($sql_naik);
					$sql->execute();
					
					//-----non aktifkan riwayata siswa sebelumnya
					$sqlstr="update riwayatkelassiswa set aktif=0 where nis='$nis' and idkelas='$idkelas'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//-----insert riwayat siswa
					$sqlcek = "select nis from riwayatkelassiswa where nis='$nis' and aktif=1";
					$sql=$dbpdo->prepare($sqlcek);
					$sql->execute();
					$rows = $sql->rowCount();
					
					if($rows == 0) {
						$sqlstr = "insert into riwayatkelassiswa (nis, idkelas, mulai, aktif, status, keterangan, ts) values ('$nis', '$idkelas2', '$mulai', 1, 1, '$keterangan', '$ts')";
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
	
	
	//-----insert penempatan kelas
	function insert_penempatan(){
		$dbpdo = DB::create();
		
		try {
			
			$idkelas		=	$_POST["idkelas"];			
			$idangkatan1	=	$_POST["idangkatan1"];
			$idangkatan		=	$_POST["idangkatan"];
			$ts				=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];	
			
			for ($x=0; $x<=$jmldata; $x++) {
				
				$nopendaftaran 	= $_POST[nopendaftaran_.$x];
				$proses  	= $_POST[proses_.$x];
				$nis 	 	= $_POST[nis_.$x];
				$keterangan = $_POST[keterangan_.$x];
				
				if($proses > 0 ) {
					
					$sqlstr	=	"select a.replid, a.idproses, a.idkelompok, a.tanggal, a.nopendaftaran, a.idtingkat, a.idjurusan, a.idminat, a.idminat1, a.foto_file, a.nama, a.panggilan, a.kelamin, a.nisn, a.nis, a.noijazah, a.tahunijazah, a.skhun, a.tahunskhun, a.noujian, a.nik, a.tmplahir, a.tgllahir, a.agama, a.kebutuhan_khusus, a.tahunmasuk, a.alamatsiswa, a.dusun, a.rt, a.rw, a.kelurahan, a.kodepossiswa, a.kecamatan, a.kabupaten, a.provinsi, a.transportasi, a.transportasi_kode, a.citacita, a.citacita_lain, a.idjenis_tinggal, a.jenis_tinggal, a.telponsiswa, a.hpsiswa, a.emailsiswa, a.kps, a.nokps, a.nokip, a.nokks, a.namaayah, a.tahunayah, a.alamatortu, a.kodeposortu, a.hportu, a.butuhkhususayah, a.butuhkhususketayah, a.pekerjaanayah, a.pekerjaanayah_lain, a.pendidikanayah, a.penghasilanayah, a.penghasilanayah_kode, a.namaibu, a.tahunibu, a.butuhkhususibu, a.butuhkhususketibu, a.pekerjaanibu, a.pekerjaanibu_lain, a.pendidikanibu, a.penghasilanibu, a.penghasilanibu_kode, a.wali, a.tahunwali, a.pekerjaanwali, a.pekerjaanwali_lain, a.pendidikanwali, a.penghasilanwali, a.tinggi, a.berat, a.jaraksekolah, a.jarak_km, a.waktutempuh, a.waktutempuh_menit, a.jsaudara, a.uid, a.dlu, a.darah, a.file_darah, a.almayah, a.almibu, a.alamatibu, a.kodeposibu, a.hpibu from calonsiswa a where a.nopendaftaran='$nopendaftaran' order by a.replid ";	
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					$datacalon = $sql->fetch(PDO::FETCH_OBJ);
					
					$replid			=   $datacalon->replid;
					$nisn			=	$datacalon->nisn;
					//$idangkatan		=	$datacalon->idproses;
					$foto_file		=   $datacalon->foto_file;
					$nama			=   $datacalon->nama;
					$panggilan		=	$datacalon->panggilan;
					$kelamin		=   $datacalon->kelamin;
					$tmplahir		=   $datacalon->tmplahir;
					$tgllahir		=   $datacalon->tgllahir;
					$agama			=   $datacalon->agama;
					$jsaudara		=   $datacalon->jsaudara;
					$alamatsiswa	=   $datacalon->alamatsiswa;
					$emailsiswa		=	$datacalon->emailsiswa;
					$alamatortu		=   $datacalon->alamatortu;
					$telponsiswa	=   $datacalon->telponsiswa;
					$hpsiswa		=   $datacalon->hpsiswa;
					$hportu			=   $datacalon->hportu;
					$hpibu			=   $datacalon->hpibu;
					$jaraksekolah	=   $datacalon->jaraksekolah;
					$berat			=   $datacalon->berat;
					$tinggi			=   $datacalon->tinggi;
					$darah			=   $datacalon->darah;
					$file_darah		=   $datacalon->file_darah;
					$noijazah		=   $datacalon->noijazah;
					$skhun			=   $datacalon->skhun;
					$noujian		=   $datacalon->noujian;
					$namaayah		=   $datacalon->namaayah;
					$namaibu		=   $datacalon->namaibu;
					$pekerjaanayah	=   $datacalon->pekerjaanayah;
					$pekerjaanibu	=   $datacalon->pekerjaanibu;
					$penghasilanayah=   $datacalon->penghasilanayah;
					$penghasilanibu	=   $datacalon->penghasilanibu;
					$pendidikanayah	=   $datacalon->pendidikanayah;
					$pendidikanibu	=   $datacalon->pendidikanibu;
					$wali			=   $datacalon->wali;
					$pendidikanwali	=   $datacalon->pendidikanwali;
					$pekerjaanwali	=   $datacalon->pekerjaanwali;
					$penghasilanwali=   $datacalon->penghasilanwali;
					$pekerjaanayah_lain	=   $datacalon->pekerjaanayah_lain;
					$pekerjaanibu_lain	=   $datacalon->pekerjaanibu_lain;
					$pekerjaanwali_lain	=	$datacalon->pekerjaanwali_lain;
					
					$warga			=	0;
					$aktif			=	1;
					$tahunmasuk		=	date("Y");
					$status			=	"Reguler";
					
					$sqlstr = "insert into siswa (nis, nisn, idangkatan, idangkatan1, foto_file, nama, panggilan, tahunmasuk, idkelas, kelamin, tmplahir, tgllahir, agama, status, warga, anakke, jsaudara, jtiri, jangkat, yatim, bahasa, alamatsiswa, alamatortu, telponsiswa, hpsiswa, emailsiswa, telponortu, hportu, hpibu, jaraksekolah, kesekolah, berat, tinggi, kesehatan, darah, file_darah, kelainan, asalsekolah_id, tglijazah, noijazah, tglskhun, skhun, noujian, nisnasal, namaayah, namaibu, tmplahirayah, tgllahirayah, tmplahiribu, tgllahiribu, pekerjaanayah, pekerjaanibu, penghasilanayah, penghasilanibu, pendidikanayah, pendidikanibu, wnayah, wnibu, wali, tmplahirwali, tgllahirwali, pendidikanwali, pekerjaanwali, penghasilanwali, alamatwali, hpwali, hubungansiswa, pekerjaanayah_lain, pekerjaanibu_lain, pekerjaanwali_lain, keterangan, aktif, uid, ts) values ('$nis', '$nisn', '$idangkatan', '$idangkatan1', '$foto_file', '$nama', '$panggilan', '$tahunmasuk', '$idkelas', '$kelamin', '$tmplahir', '$tgllahir', '$agama', '$status', '$warga', '$anakke', '$jsaudara', '$jtiri', '$jangkat', '$yatim', '$bahasa', '$alamatsiswa', '$alamatortu', '$telponsiswa', '$hpsiswa', '$emailsiswa', '$telponortu', '$hportu', '$hpibu', '$jaraksekolah', '$kesekolah', '$berat', '$tinggi', '$kesehatan', '$darah', '$file_darah', '$kelainan', '$asalsekolah_id', '$tglijazah', '$noijazah', '$tglskhun', '$skhun', '$noujian', '$nisnasal', '$namaayah', '$namaibu', '$tmplahirayah', '$tgllahirayah', '$tmplahiribu', '$tgllahiribu', '$pekerjaanayah', '$pekerjaanibu', '$penghasilanayah', '$penghasilanibu', '$pendidikanayah', '$pendidikanibu', '$wnayah', '$wnibu', '$wali', '$tmplahirwali', '$tgllahirwali', '$pendidikanwali', '$pekerjaanwali', '$penghasilanwali', '$alamatwali', '$hpwali', '$hubungansiswa', '$pekerjaanayah_lain', '$pekerjaanibu_lain', '$pekerjaanwali_lain', '$keterangan', '$aktif', '$uid', '$ts')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//-------get last ID
					$sqlstr 		= 	"select last_insert_id() last_id";
					$results		=	$dbpdo->query($sqlstr);
					$data 			=  	$results->fetch(PDO::FETCH_OBJ);
					$idsiswa		=	$data->last_id;
			
					$sqlstr = "update calonsiswa set replidsiswa = '$idsiswa' where replid = '$replid'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//------insert riwayatkelas
					$mulai	=	date("Y-m-d");
					$sqlstr = "insert into riwayatkelassiswa(nis, idkelas, mulai, aktif, status) values('$nis', '$idkelas', '$mulai', 1, 0)"; 
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
						
				}
					
			}
						
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pindah kelas
	function insert_pindah_kelas($idkelas, $idkelas2){
		$dbpdo = DB::create();
		
		try {
			
			$idangkatan2 = $_POST["idangkatan2"];
			$mulai	=	date("Y-m-d");
			$ts		=	date("Y-m-d H:i:s");
			
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];	
			
			for ($x=0; $x<=$jmldata; $x++) {
				
				$naik 	 	= $_POST[naik_.$x];
				$nis 	 	= $_POST[nis_.$x];
				$keterangan = $_POST[keterangan_.$x];
				
				if($naik > 0 && $nis != "") {
					
					//get kelas awal
					if($idkelas == "") {
						$strsql = "select a.idkelas from siswa a where a.nis='$nis'";
						$sqlkelas=$dbpdo->prepare($strsql);
						$sqlkelas->execute();
						$data_kelas = $sqlkelas->fetch(PDO::FETCH_OBJ);
						$idkelas = $data_kelas->idkelas;
					}
					//-----------/\--------------
					
					
					//----update siswa kelas baru
					$sql_naik="update siswa set idkelas='$idkelas2', idangkatan='$idangkatan2' where nis='$nis'";
					$sql=$dbpdo->prepare($sql_naik);
					$sql->execute();
					
					//-----non aktifkan riwayata siswa sebelumnya
					$sqlstr="update riwayatkelassiswa set aktif=0 where nis='$nis' and idkelas='$idkelas'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
					
					//-----insert riwayat siswa
					$sqlcek = "select nis from riwayatkelassiswa where nis='$nis' and aktif=1";
					$sql=$dbpdo->prepare($sqlcek);
					$sql->execute();
					$rows = $sql->rowCount();
					
					if($rows == 0) {
						$sqlstr = "insert into riwayatkelassiswa (nis, idkelas, mulai, aktif, status, keterangan, ts) values ('$nis', '$idkelas2', '$mulai', 1, 1, '$keterangan', '$ts')";
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
	
	
	//-----insert pegawai
	function insert_pegawai(){
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
			$tanggal_pensiun	=	date("Y-m-d", strtotime($_POST["tanggal_pensiun"]));
			
			$no_sk_tetap		=	$_POST["no_sk_tetap"];
			$tanggal_sk_tetap	=	date("Y-m-d", strtotime($_POST["tanggal_sk_tetap"]));

			//-----------upload file foto
			$uploaddir = 'app/file_foto_pegawai/';
			$foto_file = $_FILES['foto_file']['name']; 
			$tmpname  = $_FILES['foto_file']['tmp_name'];
			$filesize = $_FILES['foto_file']['size'];
			$filetype = $_FILES['foto_file']['type'];

			
			if($foto_file != "") {			
				$foto_file = $nip . '_' . $foto_file;					
				$uploadfile = $uploaddir . $foto_file;		
				if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai (bagian, nip, nama, panggilan, kelamin, gelar, tmplahir, tgllahir, agama, suku, nikah, jenis_id, noid, alamat, telpon, handphone, email, karpeg, no_sertifikasi, idjenis_sertifikasi, npwp, nuptk, tmt_cpns, unit_cpns, no_sk_masuk, idstatus_pegawai, nik, nama_ibu, nama_pasangan, tempat_lahir_pasangan, tanggal_lahir_pasangan, tanggal_nikah, tempat_nikah, pekerjaan_pasangan, instansi_pasangan, nip_pasangan, keluarga_tanggungan, usia, ajar_lain, jumlah_jam_ajar_lain, nama_bank, unit_bank, no_rek, nama_pemilik, desa, kecamatan, kode_pos, tanggal_pensiun, foto_file, keterangan, no_sk_tetap, tanggal_sk_tetap, ts) values ('$bagian', '$nip', '$nama', '$panggilan', '$kelamin', '$gelar', '$tmplahir', '$tgllahir', '$agama', '$suku', '$nikah', '$jenis_id', '$noid', '$alamat', '$telpon', '$handphone', '$email', '$karpeg', '$no_sertifikasi', '$idjenis_sertifikasi', '$npwp', '$nuptk', '$tmt_cpns', '$unit_cpns', '$no_sk_masuk', '$idstatus_pegawai', '$nik', '$nama_ibu', '$nama_pasangan', '$tempat_lahir_pasangan', '$tanggal_lahir_pasangan', '$tanggal_nikah', '$tempat_nikah', '$pekerjaan_pasangan', '$instansi_pasangan', '$nip_pasangan', '$keluarga_tanggungan', '$usia', '$ajar_lain', '$jumlah_jam_ajar_lain', '$nama_bank', '$unit_bank', '$no_rek', '$nama_pemilik', '$desa', '$kecamatan', '$kode_pos', '$tanggal_pensiun', '$foto_file', '$keterangan', '$no_sk_tetap', '$tanggal_sk_tetap', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			//-------get last ID
			$sqlstr 		= 	"select last_insert_id() last_id";
			$results		=	$dbpdo->query($sqlstr);
			$data 			=  	$results->fetch(PDO::FETCH_OBJ);
			$idsiswa		=	$data->last_id;
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert status guru
	function insert_statusguru(){
		$dbpdo = DB::create();
		
		try {
			
			$status				=	numberreplace($_POST["status"]);
			$keterangan			=	numberreplace($_POST["keterangan"]);
			
			$ts					=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into statusguru (status, keterangan, ts) values ('$status', '$keterangan', '$ts')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();			
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert jabatan
	function insert_jabatan(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jabatan (nama, aktif, uid, dlu) values ('$nama', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert jenis pelanggaran
	function insert_jenis_pelanggaran(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$poin		=	numberreplace($_POST["poin"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jenis_pelanggaran (nama, poin, aktif, uid, dlu) values ('$nama', '$poin', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert jenis prestasi
	function insert_jenis_prestasi(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$poin		=	numberreplace($_POST["poin"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jenis_prestasi (nama, poin, aktif, uid, dlu) values ('$nama', '$poin', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pelanggaran_siswa
	function insert_pelanggaran_siswa($ref){
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa			=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			$idjenis_pelanggaran=	(empty($_POST["idjenis_pelanggaran"])) ? 0 : $_POST["idjenis_pelanggaran"];
			$kejadian			=	petikreplace($_POST["kejadian"]);
			$hukuman			=	petikreplace($_POST["hukuman"]);
			
			//-----------upload file foto
			$uploaddir = 'app/file_foto_pelanggaran/';
			$photo = $_FILES['photo']['name']; 
			$tmpname  = $_FILES['photo']['tmp_name'];
			$filesize = $_FILES['photo']['size'];
			$filetype = $_FILES['photo']['type'];

			
			if($photo != "") {			
				$photo = $ref . '_' . $photo;					
				$uploadfile = $uploaddir . $photo;		
				if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pelanggaran_siswa (ref, tanggal, idsiswa, idjenis_pelanggaran, kejadian, hukuman, photo, uid, dlu) values ('$ref', '$tanggal', '$idsiswa', '$idjenis_pelanggaran', '$kejadian', '$hukuman', '$photo', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert konseling_siswa
	function insert_konseling_siswa($ref){
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
			
			##get nis siswa
			$sqlstr = "select nis from siswa where replid='$idsiswa'";
			$sql = $dbpdo->prepare($sqlstr);
			$sql->execute();
			$data = $sql->fetch(PDO::FETCH_OBJ);
			$nis = $data->nis;
			
			//-----------upload file data
			$uploaddir = 'app/file_konseling/';
			$data_file = $_FILES['data_file']['name']; 
			$tmpname  = $_FILES['data_file']['tmp_name'];
			$filesize = $_FILES['data_file']['size'];
			$filetype = $_FILES['data_file']['type'];

			
			if($data_file != "") {			
				$data_file = $ref . '_' . $nis . '_' . $data_file;					
				$uploadfile = $uploaddir . $data_file;		
				if (move_uploaded_file($_FILES['data_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$sqlstr = "insert into konseling_siswa (ref, tanggal, idsiswa, idjenis_konseling, konseling, solusi, nip, data_file, uid, dlu) values ('$ref', '$tanggal', '$idsiswa', '$idjenis_konseling', '$konseling', '$solusi', '$nip', '$data_file', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	//-----insert pegawai_jabatan
	function insert_pegawai_jabatan(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$idjabatan			=	(empty($_POST["idjabatan"])) ? 0 : $_POST["idjabatan"];
			$tanggal_efektif	=	date("Y-m-d", strtotime($_POST["tanggal_efektif"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai_jabatan (idpegawai, idjabatan, tanggal_efektif, keterangan, uid, dlu) values ('$idpegawai', '$idjabatan', '$tanggal_efektif', '$keterangan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert jenis izin
	function insert_jenis_izin(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		    =	$_POST["nama"];
			$keterangan	    =	petikreplace($_POST["keterangan"]);
            $format_surat	=	petikreplace($_POST["format_surat"]);
			$aktif		    =	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		    =	$_SESSION["loginname"];
			$dlu		    =	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jenis_izin (nama, keterangan, format_surat, aktif, uid, dlu) values ('$nama', '$keterangan', '$format_surat', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
    
    
    //-----insert izin siswa
	function insert_izin_siswa($replid){
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa	    =	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
            $jam            =   $_POST["jam"];
            $menit          =   $_POST["menit"];
            $jam            =   $jam . ":" . $menit;
            
            $tanggal        =   date("Y-m-d H:i", strtotime($_POST["tanggal"] . " " . $jam ));
            $idjenis_izin   =	(empty($_POST["idjenis_izin"])) ? 0 : $_POST["idjenis_izin"];            
            //$format_surat	=	petikreplace($_POST["format_surat"]);
			$keterangan	    =	petikreplace($_POST["keterangan"]);
            $idpegawai	    =	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$status		    =	$_POST["status"];
			$uid		    =	$_SESSION["loginname"];
			$dlu		    =	date("Y-m-d H:i:s");
			
            //---get siswa---
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
            
            //---get format surat---
            $sqljns     = "select format_surat from jenis_izin where replid='$idjenis_izin'";
            $sqljns     = $dbpdo->prepare($sqljns);
            $sqljns->execute();
            $datajns    = $sqljns->fetch(PDO::FETCH_OBJ); 
            
            $format_surat = petikreplace(str_replace("@nis", $nis ,$datajns->format_surat));
            $format_surat = petikreplace(str_replace("@nama", $nama ,$format_surat));
            $format_surat = petikreplace(str_replace("@tingkat", $tingkat ,$format_surat));
            $format_surat = petikreplace(str_replace("@kelas", $kelas ,$format_surat));
            
            $format_surat = petikreplace(str_replace("@nip", $nip ,$format_surat));
            $format_surat = petikreplace(str_replace("@pegawai", $namapegawai ,$format_surat));
            //--------end-----------
            
            
			$sqlstr = "insert into izin_siswa (idsiswa, tanggal, idjenis_izin, format_surat, keterangan, idpegawai, status, uid, dlu) values ('$idsiswa', '$tanggal', '$idjenis_izin', '$format_surat', '$keterangan', '$idpegawai', '$status', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
            
            //--get last_id
            $sqlstr 		= 	"select last_insert_id() last_id";
			$results		=	$dbpdo->query($sqlstr);
			$data 			=  	$results->fetch(PDO::FETCH_OBJ);
			$replid        	=	$data->last_id;
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		//return $sql;
        return $replid;
	}
    
	
	//-----insert pangkat
	function insert_pangkat(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pangkat (nama, aktif, uid, dlu) values ('$nama', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai_pangkat
	function insert_pegawai_pangkat(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$idpangkat			=	(empty($_POST["idpangkat"])) ? 0 : $_POST["idpangkat"];
			$tanggal_efektif	=	date("Y-m-d", strtotime($_POST["tanggal_efektif"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			$ruang				=	petikreplace($_POST["ruang"]);
			$sk					= 	$_POST["sk"];
			$no_sk				= 	$_POST["no_sk"];
			$gaji_pokok			= 	numberreplace($_POST["gaji_pokok"]);
			$tanggal_sk			=	date("Y-m-d", strtotime($_POST["tanggal_sk"]));
			$idjabatan			=	(empty($_POST["idjabatan"])) ? 0 : $_POST["idjabatan"];
			
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai_pangkat (idpegawai, idpangkat, tanggal_efektif, sk, no_sk, gaji_pokok, tanggal_sk, idjabatan, keterangan, ruang, uid, dlu) values ('$idpegawai', '$idpangkat', '$tanggal_efektif', '$sk', '$no_sk', '$gaji_pokok', '$tanggal_sk', '$idjabatan', '$keterangan', '$ruang', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert jenis sertifikasi
	function insert_jenis_sertifikasi(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jenis_sertifikasi (nama, aktif, uid, dlu) values ('$nama', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert status pegawai
	function insert_status_pegawai(){
		$dbpdo = DB::create();
		
		try {
			
			$nama		=	$_POST["nama"];
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into status_pegawai (nama, aktif, uid, dlu) values ('$nama', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert kenaikan gaji berkala
	function insert_kenaikan_gaji(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$no_kgb				=	$_POST["no_kgb"];
			$gaji_pokok			=	numberreplace($_POST["gaji_pokok"]);			
			$tmt				=	date("Y-m-d", strtotime($_POST["tmt"]));
			$tanggal_kgb		=	date("Y-m-d", strtotime($_POST["tanggal_kgb"]));
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into kenaikan_gaji (idpegawai, no_kgb, tmt, tanggal_kgb, gaji_pokok, keterangan, uid, dlu) values ('$idpegawai', '$no_kgb', '$tmt', '$tanggal_kgb', '$gaji_pokok', '$keterangan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai pendidikan
	function insert_pegawai_pendidikan(){
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
			
			$sqlstr = "insert into pegawai_pendidikan (idpegawai, nama_sekolah, tahun, jenjang, lulusan, jurusan, keterangan, uid, dlu) values ('$idpegawai', '$nama_sekolah', '$tahun', '$jenjang', '$lulusan', '$jurusan', '$keterangan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai keluarga
	function insert_pegawai_keluarga(){
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
			
			$sqlstr = "insert into pegawai_keluarga (idpegawai, nama_anak, tempat_lahir, tanggal_lahir, pekerjaan, status, anak_ke, keterangan, uid, dlu) values ('$idpegawai', '$nama_anak', '$tempat_lahir', '$tanggal_lahir', '$pekerjaan', '$status', '$anak_ke', '$keterangan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert supplier
	function insert_supplier(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	random(9);
			$nama				=	petikreplace($_POST["nama"]);
			$alamat				=	petikreplace($_POST["alamat"]);
			$telepon			=	$_POST["telepon"];
			$hp					=	$_POST["hp"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into supplier (kode, nama, alamat, telepon, hp, aktif, uid, dlu) values ('$kode', '$nama', '$alamat', '$telepon', '$hp', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai prestasi
	function insert_pegawai_prestasi(){
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
			
			$sqlstr = "insert into pegawai_prestasi (idpegawai, jenisprestasi, tingkat, nama, tahun, penyelenggara, uid, dlu) values ('$idpegawai', '$jenisprestasi', '$tingkat', '$nama', '$tahun', '$penyelenggara', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai penghargaan
	function insert_pegawai_penghargaan(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$namapenghargaan	=	petikreplace($_POST["namapenghargaan"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$pemberipenghargaan	=	petikreplace($_POST["pemberipenghargaan"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai_penghargaan (idpegawai, namapenghargaan, tahun, pemberipenghargaan, uid, dlu) values ('$idpegawai', '$namapenghargaan', '$tahun', '$pemberipenghargaan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pegawai skmengajar
	function insert_pegawai_skmengajar(){
		$dbpdo = DB::create();
		
		try {
			
			$idpegawai			=	(empty($_POST["idpegawai"])) ? 0 : $_POST["idpegawai"];
			$no_sk				=	petikreplace($_POST["no_sk"]);
			$tahun				=	(empty($_POST["tahun"])) ? 0 : $_POST["tahun"];
			$fungsional			=	petikreplace($_POST["fungsional"]);
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into pegawai_skmengajar (idpegawai, no_sk, tahun, fungsional, uid, dlu) values ('$idpegawai', '$no_sk', '$tahun', '$fungsional', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert pelajaran
	function insert_pelajaran(){
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
			
			$sqlstr = "insert into pelajaran (kode, nama, departemen, sifat, aktif, keterangan, info3, ts) values ('$kode', '$nama', '$departemen', '$sifat', '$aktif', '$keterangan', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert siswa ekskul
	function insert_siswa_ekstrakurikuler(){
		$dbpdo = DB::create();
		
		try {
			
			$idsiswa			=	(empty($_POST["idsiswa"])) ? 0 : $_POST["idsiswa"];
			$idpelajaran		=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$tanggal			=	date("Y-m-d", strtotime($_POST["tanggal"]));
			
			$uid				=	$_SESSION["loginname"];
			$dlu				=	date("Y-m-d H:i:s");
			
			//$line = maxline('siswa_ekstrakurikuler', 'line', 'idsiswa', $replid, '');
			
			$sqlstr = "insert into siswa_ekstrakurikuler (idsiswa, idpelajaran, tanggal, uid, dlu) values ('$idsiswa', '$idpelajaran', '$tanggal', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert semester
	function insert_semester(){
		$dbpdo = DB::create();
		
		try {
			
			$semester			=	$_POST["semester"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
						
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into semester (semester, departemen, aktif, ts) values ('$semester', '$departemen', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert angkatan
	function insert_angkatan(){
		$dbpdo = DB::create();
		
		try {
			
			$angkatan			=	$_POST["angkatan"];
			$departemen			=	$_POST["departemen"];
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
						
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into angkatan (angkatan, departemen, aktif, ts) values ('$angkatan', '$departemen', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert rpp
	function insert_rpp(){
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
			
			$sqlstr = "insert into rpp (idtingkat, idsemester, idpelajaran, koderpp, rpp, deskripsi, aktif, ts) values ('$idtingkat', '$idsemester', '$idpelajaran', '$koderpp', '$rpp', '$deskripsi', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert dasarpenilaian
	function insert_dasarpenilaian(){
		$dbpdo = DB::create();
		
		try {
			
			$dasarpenilaian		=	$_POST["dasarpenilaian"];
			$keterangan			=	petikreplace($_POST["keterangan"]);
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into dasarpenilaian (dasarpenilaian, keterangan, ts) values ('$dasarpenilaian', '$keterangan', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	
	//-----insert kompetensi
	function insert_kompetensi(){
		$dbpdo = DB::create();
		
		try {
			
			$kode				=	$_POST["kode"];
			$kompetensi			=	petikreplace($_POST["kompetensi"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into kompetensi (kode, kompetensi, aktif, dlu) values ('$kode', '$kompetensi', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert jeniskompetensi
	function insert_jeniskompetensi(){
		$dbpdo = DB::create();
		
		try {
			
			$jeniskompetensi	=	petikreplace($_POST["jeniskompetensi"]);
			$aktif				=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$dlu				=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into jeniskompetensi (jeniskompetensi, aktif, dlu) values ('$jeniskompetensi', '$aktif', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert aspek_perkembangan
	function insert_aspek_perkembangan(){
		$dbpdo = DB::create();
		
		try {
			
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into aspek_perkembangan (aspek, aktif, uid, dlu) values ('$aspek', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert aspek_psikologi
	function insert_aspek_psikologi(){
		$dbpdo = DB::create();
		
		try {
			
			$departemen	=	$_POST["departemen"];
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into aspek_psikologi (departemen, aspek, aktif, uid, dlu) values ('$departemen', '$aspek', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert aspek_psikologi_detail
	function insert_aspek_psikologi_detail(){
		$dbpdo = DB::create();
		
		try {
			
			$jenis_aspek_id = $_POST["jenis_aspek_id"];
			$departemen	=	$_POST["departemen"];
			$aspek		=	petikreplace($_POST["aspek"]);
			$aktif		=	(empty($_POST["aktif"])) ? 0 : $_POST["aktif"];
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into aspek_psikologi_detail (departemen, jenis_aspek_id, aspek, aktif, uid, dlu) values ('$departemen', '$jenis_aspek_id', '$aspek', '$aktif', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert assesmen_observasi
	function insert_assesmen_observasi($ref){
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
			$uploaddir = 'app/file_assesment/';
			$data_file = $_FILES['data_file']['name']; 
			$tmpname  = $_FILES['data_file']['tmp_name'];
			$filesize = $_FILES['data_file']['size'];
			$filetype = $_FILES['data_file']['type'];

			
			if($data_file != "") {			
				$data_file = $ref . '_' . $nis . '_' . $data_file;					
				$uploadfile = $uploaddir . $data_file;		
				if (move_uploaded_file($_FILES['data_file']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$sqlstr = "insert into assesmen_observasi (ref, tanggal, idsiswa, idpegawai, idpegawai1, data_file, uid, dlu) values ('$ref', '$tanggal', '$idsiswa', '$idpegawai', '$idpegawai1', '$data_file', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
						
			/*--------insert detail--------*/
			/*$jumlah		=	$_POST['jmldata'];
			
			for($x=0; $x<=$jumlah; $x++) {
				$idaspek_perkembangan	=	$_POST[idaspek_perkembangan_.$x];
				$hasil					=	petikreplace($_POST[hasil_.$x]);
				$saran					=	petikreplace($_POST[saran_.$x]);
				
				if($hasil != "") {
					$sqlstr = "insert into assesmen_observasi_detail (ref, idaspek_perkembangan, hasil, saran, line) values ('$ref', '$idaspek_perkembangan', '$hasil', '$saran', '$x')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				}
				
			}*/
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert anggota
	function insert_anggota($ref){
		$dbpdo = DB::create();
		
		try {
			
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
			
			
			//-----------upload file foto
			$uploaddir = 'app/file_foto_anggota/';
			$foto = $_FILES['foto']['name']; 
			$tmpname  = $_FILES['foto']['tmp_name'];
			$filesize = $_FILES['foto']['size'];
			$filetype = $_FILES['foto']['type'];

			
			if($foto != "") {			
				$foto = $ref . '_' . $foto;					
				$uploadfile = $uploaddir . $foto;		
				if (move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile)) {
					echo "";											
				} 
			}
			//----------------
			
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
			
			$sqlstr = "insert into anggota (noregistrasi, nama, alamat, kodepos, email, telpon, HP, pekerjaan, institusi, keterangan, tgldaftar, aktif, foto, ts) values ('$ref', '$nama', '$alamat', '$kodepos', '$email', '$telpon', '$HP', '$pekerjaan', '$institusi', '$keterangan', '$tgldaftar', '$aktif', '$foto', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
			
		
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//------insert user reminder
	function insert_usr_reminder(){
		$dbpdo = DB::create();
		
		try {
			
			$uid		=	$_SESSION["loginname"];
			
			//----------insert user detail
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];
			
			for ($i=1; $i<=$jmldata; $i++) {
				$mview = (empty($_POST[mview_.$i])) ? 0 : $_POST[mview_.$i];
				
				if ($mview==1) { 				
					$reminder_id = $_POST[reminder_id_.$i];
														
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
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	//-----insert evaluasi_psikologi
	function insert_evaluasi_psikologi($ref){
		$dbpdo = DB::create();
		
		try {
			
			$tanggal	=	date("Y-m-d", strtotime($_POST['tanggal']));
			$departemen	=	$_POST["departemen"];
			$idtingkat	= 	$_POST["idtingkat"];
			$idkelas	= 	$_POST["idkelas"];
			$nis		=	$_POST["nis"];
			$idpegawai	=	(empty($_POST['idpegawai'])) ? 0 : $_POST['idpegawai'];
			$idsemester = 	$_POST["idsemester"];
			$uid		=	$_SESSION["loginname"];
			$dlu		=	date("Y-m-d H:i:s");
						
			$sqlstr = "insert into evaluasi_psikologi (ref, tanggal, departemen, idtingkat, idkelas, nis, idpegawai, idsemester, uid, dlu) values ('$ref', '$tanggal', '$departemen', '$idtingkat', '$idkelas', '$nis', '$idpegawai', '$idsemester', '$uid', '$dlu')";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
						
			/*--------insert detail--------*/
			$iq	=	$_POST['iq'];
			$jmldata_jenis_aspek = $_POST['jmldata_jenis_aspek'];
			for($y=0; $y<$jmldata_jenis_aspek; $y++) {
				$jenis_aspek_id	=	$_POST[jenis_aspek_id_.$y];
				
				
				$jml_aspek_detail = $_POST[jml_aspek_detail_.$y];
				for($z=0; $z<$jml_aspek_detail; $z++) {
					
					$aspek_psikologi_id	= 	$_POST[aspek_psikologi_detail_id_.$y.$z];
					$nilai				=	$_POST[nilai_.$y.$z];
					
					$line = maxline('evaluasi_psikologi_detail', 'line', 'ref', $ref, '');
					
					$sqlstr = "insert into evaluasi_psikologi_detail (ref, iq, nilai, jenis_aspek_id, aspek_psikologi_id, line) values ('$ref', '$iq', '$nilai', '$jenis_aspek_id', '$aspek_psikologi_id', '$line')";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
				
				}
				
			}
				
					
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	
	//-----insert kelulusan
	function insert_kelulusan($idkelas, $idkelas2, $tgllulus){
		$dbpdo = DB::create();
		
		try {
			
			$tgllulus	=	date("Y-m-d", strtotime($tgllulus));
			$idtingkat	=	$_POST["idtingkat"];
			$mulai		=	date("Y-m-d");
			$ts			=	date("Y-m-d H:i:s");
			
			//get data 
			//$strsql = "select b.departemen from kelas a left join tingkat b on a.idtingkat=b.replid where a.replid='$idkelas'";
			$strsql = "select a.departemen from tingkat a where a.replid='$idtingkat'";
			$sql_kelas=$dbpdo->prepare($strsql);
			$sql_kelas->execute();
			$data_kelas = $sql_kelas->fetch(PDO::FETCH_OBJ);
			$departemen = $data_kelas->departemen;
			//----------/\----------------
			
					
			$jmldata = (empty($_POST['jmldata'])) ? 0 : $_POST['jmldata'];				
			for ($x=0; $x<=$jmldata; $x++) {
				
				$lulus 	 	= $_POST[lulus_.$x];
				$nis 	 	= $_POST[nis_.$x];
				$keterangan = $_POST[keterangan_.$x];
				
				if($lulus > 0 && $nis != "") {
					
					//----update siswa alumni
					$sql_lulus="update siswa set aktif=0, alumni=1 where nis='$nis'";
					$sql=$dbpdo->prepare($sql_lulus);
					$sql->execute();					
					
					//update riwayat kelas siswa
					$sql_lulus="update riwayatkelassiswa set aktif=0 where nis='$nis' and idkelas='$idkelas' and aktif = 1";
					$sql=$dbpdo->prepare($sql_lulus);
					$sql->execute();
					
					//update riwayat dept siswa
					$sql_lulus="update riwayatdeptsiswa set aktif=0 where nis='$nis' and departemen='$departemen' and aktif=1";
					$sql=$dbpdo->prepare($sql_lulus);
					$sql->execute();
										
					//insert alumni
					$sqlstr="insert into alumni set nis='$nis', tgllulus='$tgllulus', tktakhir='$idtingkat', klsakhir='$idkelas', departemen='$departemen', keterangan='$keterangan'";
					$sql=$dbpdo->prepare($sqlstr);
					$sql->execute();
										
						
				}
					
			}
						
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
		}
		
		return $sql;
	}
	
	
	
	//presensi ukbm
	function insert_presensi_ukbm($ref)
	{

		$dbpdo = DB::create();

		try {
			
			$tanggal		=   date("Y-m-d"); //, strtotime($_POST["tanggal"]));
			$tanggal		=   $tanggal . date("H:i:s");
			$tanggal		=   date("Y-m-d H:i:s", strtotime($tanggal));
			$idtingkat		=	(empty($_POST["idtingkat"])) ? 0 : $_POST["idtingkat"];
			$idkelas		=	(empty($_POST["idkelas"])) ? 0 : $_POST["idkelas"];
			$idsemester		=	(empty($_POST["idsemester"])) ? 0 : $_POST["idsemester"];
			$idpelajaran	=	(empty($_POST["idpelajaran"])) ? 0 : $_POST["idpelajaran"];
			$idguru			=	(empty($_POST["idguru"])) ? 0 : $_POST["idguru"];
			$idukbm			=	(empty($_POST["idukbm"])) ? 0 : $_POST["idukbm"];
			$uid			=	$_SESSION["loginname"];
			$dlu			=	date("Y-m-d H:i:s");

			$idsiswa_id		=	array();
			$idsiswa_id		=	explode("|", $_POST["idsiswa"]);
			
			$hadir_id		=	array();
			$hadir_id		=	explode("|", $_POST["hadir"]);

			$dispensasi_id	=	array();
			$dispensasi_id	=	explode("|", $_POST["dispensasi"]);

			$sakit_id		=	array();
			$sakit_id		=	explode("|", $_POST["sakit"]);

			$izin_id		=	array();
			$izin_id		=	explode("|", $_POST["izin"]);

			$alpa_id		=	array();
			$alpa_id		=	explode("|", $_POST["alpa"]);

			$jmldata		=	count($idsiswa_id); //(empty($_POST["jmldata"])) ? 0 : $_POST["jmldata"];
			$k=0;
			for ($k=0; $k<$jmldata; $k++) {
				$idsiswa		=	$idsiswa_id[$k]; //$_POST[idsiswa_.$k];
				$absen			=	0; //$_POST[absen_.$k];
				$hadir 			= 	0; //$hadir_id[$k];
				$dispensasi		=	$dispensasi_id[$k];
				$sakit			=	$sakit_id[$k];
				$izin			=	$izin_id[$k];
				$alpa			=	$alpa_id[$k];

	/*if($hadir == "hadir") {
	$hadir = 1;
	} else {
	$hadir = 0;
	}*/

				if ($dispensasi == "dispensasi") {
					$dispensasi = 1;
				} else {
					$dispensasi = 0;
				}

				if ($sakit == "sakit") {
					$sakit = 1;
				} else {
					$sakit = 0;
				}

				if ($izin == "izin") {
					$izin = 1;
				} else {
					$izin = 0;
				}

				if ($alpa == "alpa") {
					$alpa = 1;
				} else {
					$alpa = 0;
				}

				$tanggal2 = date("Y-m-d"); //, strtotime($_POST["tanggal"]));
				$sqlstr = "select replid from presensi_ukbm where idsiswa='$idsiswa' and date_format(tanggal,'%Y-%m-%d')='$tanggal2' and idguru='$idguru' and ref='$ref'"; //and idukbm='$idukbm' 
				$sql=$dbpdo->prepare($sqlstr);
				$sql->execute();
				$rows=$sql->rowCount();
				if ($idsiswa != "") {
					if ($rows == 0) {
						$sqlstr = "insert into presensi_ukbm (tanggal, idtingkat, idkelas, idsiswa, idpelajaran, idguru, idsemester, idukbm, hadir, dispensasi, sakit, izin, alpa, uid, dlu, ref) values ('$tanggal', '$idtingkat', '$idkelas', '$idsiswa', '$idpelajaran', '$idguru', '$idsemester', '$idukbm', '$hadir', '$dispensasi', '$sakit', '$izin', '$alpa', '$uid', '$dlu', '$ref')";
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					} else {
						$sqlstr = "update presensi_ukbm set hadir='$hadir', dispensasi='$dispensasi', sakit='$sakit', izin='$izin', alpa='$alpa' where idsiswa='$idsiswa' and idukbm='$idukbm' and idguru='$idguru' and ref='$ref'"; //and date_format(tanggal,'%Y-%m-%d')='$tanggal2' 
						$sql=$dbpdo->prepare($sqlstr);
						$sql->execute();
					}
				}
			}

		} catch (PDOException $e) {
			echo $e->getMessage();
		}

		return $sql;
		//--------------------------/\
	}
	
	
}

?>
