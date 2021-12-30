<?php

class select{	

	//---------get data user
	function list_usr($ref=''){	
		$dbpdo = DB::create();
		
	 	if ($ref == "") {
			$where = "";
			if (user_admin()==0) {
				$uid = $_SESSION["loginname"];
				$where = " where a.uid = '$uid' ";
			} 
			
			$sqlstr = "select a.id, a.usrid, a.pwd, a.adm, b.pwd pwdori, a.photo, a.departemen, a.act, a.uid, a.dlu from usr a left join usr_bup b on a.usrid=b.usrid " . $where . " order by a.usrid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		} else {
			$sqlstr = "select a.id, a.usrid, a.pwd, b.pwd pwdori, a.adm, a.photo, a.departemen, a.act, a.uid, a.dlu from usr a left join usr_bup b on a.usrid=b.usrid where a.id='$ref' order by a.usrid";
			$sql=$dbpdo->prepare($sqlstr);
			$sql->execute();
		
		}
		
		
		return $sql;
	}
	
	//-----------user detail akses(saat update)
	function list_usrdtl($id) {
		$dbpdo = DB::create();
		
		$sqlstr = "select usrid from usr where id=$id";
		$hasil_cek = $dbpdo->query($sqlstr);
		$data = $hasil_cek->fetch(PDO::FETCH_OBJ);
				
		$sqlstr = "select usrid from usr where usrid='$data->usrid' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------user form akses(saat add)
	function list_usrfrm() {
		$dbpdo = DB::create();
		
		$sqlstr = "select frmcde, frmnme from usr_frm order by frmnme";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------check user
	function list_usr_check($ref=''){	 
		$dbpdo = DB::create();
			
		$sqlstr = "select usrid from usr where usrid='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------check user update
	function list_usrupdate_check($ref='', $old_usrid=''){	 
		$dbpdo = DB::create();
			
		$sqlstr = "select usrid from usr where usrid='$ref' and usrid<>'$old_usrid'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//-----------user form akses(saat update)
	function list_usrrgh($id) {
		$dbpdo = DB::create();
		
		$sqlstr = "select usrid from usr where id=$id";
		$hasil_cek = $dbpdo->query($sqlstr);
		$data = $hasil_cek->fetch(PDO::FETCH_OBJ);
		
		$sqlstr = "select aa.* from (select a.id, a.frmcde, b.frmnme, 1 mslc, a.madd, a.medt, a.mdel, a.lvl, 1 old from usr_dtl a left join usr_frm b on a.frmcde=b.frmcde where a.usrid='$data->usrid' union all
		select 0 id, frmcde, frmnme, 0 mslc, 0 madd, 0 medt, 0 mdel, 0 lvl, 0 old from usr_frm where frmcde not in (select frmcde from usr_dtl where usrid='$data->usrid' )) aa order by aa.id desc, aa.frmnme ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data registrasi
	function list_registrasi($ref='', $replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.departemen, a.idproses, a.idkelompok, a.tanggal, a.nopendaftaran, a.idtingkat, a.idjurusan, a.idminat, a.idminat1, a.foto_file, a.nama, a.panggilan, a.kelamin, a.nisn, a.nis, a.noijazah, a.tahunijazah, a.skhun, a.tahunskhun, a.noujian, a.nik, a.tmplahir, a.tgllahir, a.agama, a.kebutuhan_khusus_chk, a.kebutuhan_khusus, a.tahunmasuk, a.alamatsiswa, a.dusun, a.rt, a.rw, a.kelurahan, a.kodepossiswa, a.kecamatan, a.kabupaten, a.provinsi, a.transportasi, a.transportasi_kode, a.citacita, a.citacita_lain, a.idjenis_tinggal, a.jenis_tinggal, a.telponsiswa, a.hpsiswa, a.emailsiswa, a.kps, a.nokps, a.nokip, a.nokks, a.namaayah, a.tahunayah, a.alamatortu, a.kodeposortu, a.hportu, a.butuhkhususayah, a.butuhkhususketayah, a.pekerjaanayah, a.pekerjaanayah_lain, a.pendidikanayah, a.penghasilanayah, a.penghasilanayah_kode, a.namaibu, a.tahunibu, a.butuhkhususibu, a.butuhkhususketibu, a.pekerjaanibu, a.pekerjaanibu_lain, a.pendidikanibu, a.penghasilanibu, a.penghasilanibu_kode, a.wali, a.tahunwali, a.pekerjaanwali, a.pekerjaanwali_lain, a.pendidikanwali, a.penghasilanwali, a.tinggi, a.berat, a.jaraksekolah, a.jarak_km, a.waktutempuh, a.waktutempuh_menit, a.jsaudara, a.uid, a.dlu, a.darah, a.file_darah, a.almayah, a.almibu, a.alamatibu, a.kodeposibu, a.hpibu from calonsiswa a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//---------get data registrasi prestasi
	function list_registrasi_prestasi($idcalonsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idcalonsiswa != "") {
			if ($where == "") {
				$where = " where a.idcalonsiswa = '$idcalonsiswa' ";
			} else {
				$where = $where . " and a.idcalonsiswa = '$idcalonsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idcalonsiswa, a.jenisprestasi, a.tingkat, a.nama, a.tahun, a.penyelenggara, a.line from calonsiswa_prestasi a " . $where . " order by a.line ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data registrasi beasiswa
	function list_registrasi_beasiswa($idcalonsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idcalonsiswa != "") {
			if ($where == "") {
				$where = " where a.idcalonsiswa = '$idcalonsiswa' ";
			} else {
				$where = $where . " and a.idcalonsiswa = '$idcalonsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idcalonsiswa, a.jenis, a.penyelenggara, a.tahunmulai, a.tahunselesai, a.line from calonsiswa_beasiswa a " . $where . " order by a.line ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------check nis siswa
	function list_nissiswa_check($ref='', $idkelas=''){	 
		$dbpdo = DB::create();
		
		if($idkelas == '') { $idkelas = 0; }	
		$sqlstr = "select nis from siswa where nis='$ref' and idkelas=$idkelas ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------check nis siswa update
	function list_nissiswaupdate_check($ref='', $old_nis='', $idkelas=''){	 
		$dbpdo = DB::create();
		
		if($idkelas == '') { $idkelas = 0; }	
		$sqlstr = "select nis from siswa where nis='$ref' and nis<>'$old_nis' and idkelas=$idkelas ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data siswa
	function list_siswa($ref='', $replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.nis = '$ref' ";
			} else {
				$where = $where . " and a.nis = '$ref' ";
			}
		}
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.nik, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.panggilan, a.idkelas, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.desa_kode, a.kecamatan_kode, a.kota_kode, a.provinsi_kode, a.alamatsiswa, a.rt_siswa, a.rw_siswa, a.dusun, a.desa, a.kecamatan, a.kodepossiswa, a.jenistinggal, a.alamatortu, a.telponsiswa, a.hpsiswa, a.emailsiswa, a.kps, a.nokps, a.kip, a.nokip, a.namakip, a.nokks, a.no_akte_lahir, a.telponortu, a.hportu, a.hpibu, a.transportasi_kode, a.transportasi_lain, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.nik_ayah, a.namaayah, a.nik_ibu, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tempat_bekerja_ayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah_kode, a.penghasilanayah, a.penghasilanibu_kode, a.penghasilanibu, a.tempat_bekerja_ibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.nik_wali, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali_kode, a.penghasilanwali, a.tempat_bekerja_wali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.rombel_id, a.nama_bank, a.no_rekening_bank, a.nama_pemilik_bank, a.pip, a.alasan_pip, f.virtualaccount, a.uid, a.ts, b.idtingkat, b.kelas, c.tingkat, c.departemen, d.pekerjaan pekerjaan_ayah, e.pekerjaan pekerjaan_ibu from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid left join jenispekerjaan d on a.pekerjaanayah=d.replid left join jenispekerjaan e on a.pekerjaanibu=e.replid left join siswa_virtualaccount f on a.nis=f.nis " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa prestasi
	function list_siswa_prestasi($idsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idsiswa, a.jenisprestasi, a.tingkat, a.nama, a.tahun, a.penyelenggara, a.line from siswa_prestasi a " . $where . " order by a.line ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data siswa beasiswa
	function list_siswa_beasiswa($idsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idsiswa, a.jenis, a.penyelenggara, a.tahunmulai, a.tahunselesai, a.line from siswa_beasiswa a " . $where . " order by a.line ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data prosespenerimaansiswa
	function list_prosespenerimaansiswa($replid=''){
		$dbpdo = DB::create();
		
		$where = " where a.departemen='SMA' ";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.proses, a.kodeawalan, a.departemen, a.aktif, a.keterangan, a.ts from prosespenerimaansiswa a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data kelompokcalonsiswa
	function list_kelompokcalonsiswa($replid=''){
		$dbpdo = DB::create();
		
		$where = " where b.departemen='SMA' ";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kelompok, a.idproses, a.kapasitas, a.keterangan, a.ts, b.proses nama_proses from kelompokcalonsiswa a left join prosespenerimaansiswa b on a.idproses=b.replid " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data departemen
	function list_departemen($replid=''){
		$dbpdo = DB::create();
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.departemen, a.nipkepsek, a.urutan, a.keterangan, a.aktif, a.info1, a.info2, a.info3, a.ts, b.nama kepalasekolah from departemen a left join pegawai b on a.nipkepsek=b.nip " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data tingkat
	function list_tingkat($replid=''){
		$dbpdo = DB::create();
		
		//$where = " where a.departemen='SMA' ";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.tingkat, a.departemen, a.aktif, a.keterangan, a.urutan, a.ts from tingkat a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data kelas
	function list_kelas($replid=''){
		$dbpdo = DB::create();
		
		//$where = " where b.departemen='SMA'";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idtahunajaran, a.idtingkat, a.kelas, a.kapasitas, a.nipwali, a.aktif, a.keterangan, a.ts, b.tingkat, b.departemen, c.tahunajaran, d.nama walikelas from kelas a left join tingkat b on a.idtingkat=b.replid left join tahunajaran c on a.idtahunajaran=c.replid left join pegawai d on a.nipwali=d.nip " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
    
    //---------get data tahunajaran
	function list_tahunajaran($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.tahunajaran, a.departemen, a.tglmulai, a.tglakhir, a.aktif, a.keterangan, a.ts from tahunajaran a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data agama
	function list_agama($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.agama, a.urutan, a.ts from agama a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	              
	
	//---------get data tahun buku
	function list_tahunbuku($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.tahunbuku, a.awalan, a.aktif, a.keterangan, a.departemen, a.tanggalmulai, a.ts from tahunbuku a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data rekakun
	function list_rekakun($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.kode = '$replid' ";
			} else {
				$where = $where . " and a.kode = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.kode, a.kategori, a.nama, a.keterangan, a.ts from rekakun a " . $where . " order by a.kode, a.kategori ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------check rekakun update
	function list_rekakun_check($ref='', $old_kode=''){	 
		$dbpdo = DB::create();
			
		$sqlstr = "select kode from rekakun where kode='$ref' and kode<>'$old_kode'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data datapenerimaan
	function list_datapenerimaan($replid='', $nama='', $departemen='', $idkategori=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama = '$nama' ";
			} else {
				$where = $where . " and a.nama = '$nama' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		if ($idkategori != "") {
			if ($where == "") {
				$where = " where a.idkategori = '$idkategori' ";
			} else {
				$where = $where . " and a.idkategori = '$idkategori' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idkategori, a.departemen, a.nama, a.rekkas, a.rekpendapatan, a.rekpiutang, a.keterangan, a.nourut, a.aktif, a.full, a.ts, b.nama namakas, c.nama namapendapatan, d.nama namapiutang, e.kategori from datapenerimaan a left join rekakun b on a.rekkas=b.kode left join rekakun c on a.rekpendapatan=c.kode left join rekakun d on a.rekpiutang=d.kode left join kategoripenerimaan e on a.idkategori=e.kode " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------check nama datapenerimaan update
	function list_datapenerimaan_check($nama='', $departemen='', $idkategori='', $oldnama='', $olddepartemen='', $oldidkategori=''){	 
		$dbpdo = DB::create();
		
		$sqlstr = "select nama from datapenerimaan 
			where nama='$nama' and departemen='$departemen' and idkategori='$idkategori' 
			and nama<>'$oldnama' and departemen<>'$olddepartemen' and idkategori<>'$oldidkategori' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data datapengeluaran
	function list_datapengeluaran($replid='', $nama='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama = '$nama' ";
			} else {
				$where = $where . " and a.nama = '$nama' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
				
		$sqlstr	="select a.replid, a.departemen, a.nama, a.rekdebet, a.rekkredit, a.keterangan, a.aktif, a.ts, b.nama namadebet, c.nama namakredit from datapengeluaran a left join rekakun b on a.rekdebet=b.kode left join rekakun c on a.rekkredit=c.kode " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------check nama datapengeluaran update
	function list_datapengeluaran_check($nama='', $departemen='', $oldnama='', $olddepartemen=''){	 
		$dbpdo = DB::create();
		
		$sqlstr = "select nama from datapengeluaran 
			where nama='$nama' and departemen='$departemen' 
			and nama<>'$oldnama' and departemen<>'$olddepartemen' ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data besarjtt
	function list_besarjtt($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$nis = explode("|", $replid);
											
		if ($nis[1] != "") {
			$where = " where c.nis = '$nis[1]' ";
		}
		
		if($nis[0] == 'NIS') {
			$sqlstr	=	"select '' replid, a.nis, a.idpenerimaan, 0 besar, 0 cicilan, a.lunas, a.keterangan, a.pengguna, a.info1, a.info2, a.info3, a.ts, a.potongan, c.idkelas, c.idangkatan, d.idtingkat, b.idkategori, c.nama namasiswa, d.kelas, e.tingkat from siswa c left join besarjtt a on a.nis=c.nis left join datapenerimaan b on a.idpenerimaan=b.replid left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid " . $where . " order by a.nis ";				
		} else {
			$sqlstr	=	"select a.replid, a.nis, a.idpenerimaan, a.besar, a.cicilan, a.lunas, a.keterangan, a.pengguna, a.info1, a.info2, a.info3, a.ts, a.potongan, b.idkategori, c.idkelas, c.idangkatan, d.idtingkat, c.nama namasiswa, d.kelas, e.tingkat, b.departemen from besarjtt a left join datapenerimaan b on a.idpenerimaan=b.replid left join siswa c on a.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid " . $where . " order by a.nis ";
		}
		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data penerimaanjtt
	function list_penerimaanjtt($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr = "select a.replid, a.idbesarjtt, a.tanggal, a.jumlah, c.nis, c.nama namasiswa, d.kelas, e.tingkat, a.keterangan, a.petugas, a.ref, a.idjurnal, a.idjenis_bayar, b.besar, b.idpenerimaan, e.departemen, f.idkategori, ifnull(b.besar,0) - ifnull(a.jumlah,0) sisa, b.info2 tahunbuku from penerimaanjtt a left join besarjtt b on a.idbesarjtt=b.replid left join siswa c on b.nis=c.nis left join kelas d on c.idkelas=d.replid left join tingkat e on d.idtingkat=e.replid left join datapenerimaan f on b.idpenerimaan=f.replid " .$where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data perpustakaan
	function list_perpustakaan($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, b.departemen, a.nama, a.keterangan, a.ts from perpustakaan a left join identitas b on a.nama=b.perpustakaan " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data format
	function list_format($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.keterangan, a.ts from format a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data rak
	function list_rak($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.rak, a.keterangan, a.ts from rak a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data katalog
	function list_katalog($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.rak, a.keterangan, a.ts, b.rak namarak from katalog a left join rak b on a.rak=b.replid " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data penerbit
	function list_penerbit($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.alamat, a.telpon, a.email, a.fax, a.website, a.kontak, a.keterangan, a.ts from penerbit a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data penulis
	function list_penulis($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.kontak, a.biografi, a.keterangan, a.gelardepan, a.gelarbelakang, a.ts from penulis a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data pustaka
	function list_pustaka($replid=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.judul, a.abstraksi, a.keyword, a.tahun, a.keteranganfisik, a.penulis, a.penerbit, a.format, a.katalog, a.photo, a.keterangan, a.harga, a.info1, a.info2, a.info3, a.departemen, a.tanggal_masuk, a.keterangan_pustaka, a.ts, b.nama namapenulis, c.nama namapenerbit from pustaka a left join penulis b on a.penulis=b.replid left join penerbit c on a.penerbit=c.replid " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data daftarpustaka
	function list_daftarpustaka($replid='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where b.departemen = '$departemen' ";
			} else {
				$where = $where . " and b.departemen = '$departemen' ";
			}
		}
		
		if($replid=='' && $departemen=='') {
			$where = " where a.replid = 0";
		}
		
		$sqlstr	=	"select a.replid, a.pustaka, a.perpustakaan, a.kodepustaka, a.status, a.ts, b.departemen, b.judul, c.nama namapenulis, d.nama namapenerbit from daftarpustaka a left join pustaka b on a.pustaka=b.replid left join penulis c on b.penulis=c.replid left join penerbit d on b.penerbit=d.replid " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get jumlah alokasi pustaka
	function list_pustaka_alokasi($pustaka_id='', $jml=0){
		$dbpdo = DB::create();
		
		$sqlstr	=	"select count(replid) jumlah from daftarpustaka where pustaka='$pustaka_id' and perpustakaan='1' ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$jml = $data->jumlah;
		
		return $jml;
	}
	
	//---------get kodepustaka
	function list_pustaka_kodepustaka($pustaka_id='', $kodepustaka=''){
		$dbpdo = DB::create();
		
		$sqlstr	=	"select replid, kodepustaka from daftarpustaka where pustaka='$pustaka_id' and perpustakaan='1' limit 1 ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$kodepustaka = $data->kodepustaka . "~" . $data->replid;
		
		return $kodepustaka;
	}
	
	//---------get data pustaka supplier
	function list_pustaka_supplier($pustaka_id=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($pustaka_id != "") {
			if ($where == "") {
				$where = " where a.pustaka_id = '$pustaka_id' ";
			} else {
				$where = $where . " and a.pustaka_id = '$pustaka_id' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.pustaka_id, a.supplier_id from pustaka_supplier a " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get pinjam pre save
	function list_pinjam_detail_presave($idanggota){
		$dbpdo = DB::create();
		
		$sqlstr	= "select a.replid, a.kodepustaka, a.tglpinjam, a.tglkembali, a.idanggota, a.keterangan, a.status, a.tglditerima, a.petugaspinjam, a.departemen, a.jenis_anggota, a.jenis_anggota, a.ts, c.judul from pinjam a left join daftarpustaka b on a.kodepustaka=b.kodepustaka left join pustaka c on b.pustaka=c.replid where a.idanggota='$idanggota' and a.status=0 order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get daftarpustaka
	function list_getpustaka($kodepustaka){
		$dbpdo = DB::create();
		
		$sqlstr	= "select a.kodepustaka, b.judul from daftarpustaka a left join pustaka b on a.pustaka=b.replid where a.kodepustaka='$kodepustaka' and a.status=1 and a.kodepustaka not in (select kodepustaka from pinjam where (status=0 or status=1)) limit 1";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get pinjam
	function list_pinjam($replid='', $idanggota='', $tglpinjam='', $tglkembali='', $all){
		$dbpdo = DB::create();
		
		$where = " where a.status=1 ";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($idanggota != "") {
			if ($where == "") {
				$where = " where a.idanggota = '$idanggota' ";
			} else {
				$where = $where . " and a.idanggota = '$idanggota' ";
			}
		}
		
		if ($tglpinjam != "") {
			$tglpinjam = date("Y-m-d", strtotime($tglpinjam));
			if ($where == "") {
				$where = " where a.tglpinjam = '$tglpinjam' ";
			} else {
				$where = $where . " and a.tglpinjam = '$tglpinjam' ";
			}
		}
		
		if ($tglkembali != "") {
			$tglkembali = date("Y-m-d", strtotime($tglkembali));
			if ($where == "") {
				$where = " where a.tglkembali = '$tglkembali' ";
			} else {
				$where = $where . " and a.tglkembali = '$tglkembali' ";
			}
		}
		
		if ($all != "") {
			$where = " where a.status=1 ";
		}
		
		if($replid=='' && $idanggota=='' && $tglpinjam=='' && $tglkembali=='' && $all=='') {
			$where = " where a.replid = 0 ";
		}
		
		
		$now	= date("Y-m-d");
		$sqlstr	= "select a.replid, a.kodepustaka, a.tglpinjam, a.tglkembali, a.idanggota, a.keterangan, a.status, a.tglditerima, a.petugaspinjam, a.departemen, a.jenis_anggota, a.ts, c.judul, d.nama, datediff('".$now."', a.tglkembali) terlambat from pinjam a left join daftarpustaka b on a.kodepustaka=b.kodepustaka left join pustaka c on b.pustaka=c.replid left join (select nis, nama from siswa union all select nip nis, nama from pegawai) d on a.idanggota=d.nis " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get kembali
	function list_kembali($replid, $kodepustaka){
		$dbpdo = DB::create();
		
		$where = " where a.status=1 ";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($kodepustaka != "") {
			if ($where == "") {
				$where = " where a.kodepustaka = '$kodepustaka' ";
			} else {
				$where = $where . " and a.kodepustaka = '$kodepustaka' ";
			}
		}
		
		if($replid == "" && $kodepustaka == "") {
			$where = " where a.status=5 ";
		}
		
		$now	= date("Y-m-d");
		$sqlstr	= "select a.replid, a.kodepustaka, a.tglpinjam, a.tglkembali, a.idanggota, a.keterangan, a.status, a.tglditerima, a.petugaspinjam, a.departemen, a.jenis_anggota, a.ts, c.judul, d.nama, datediff('".$now."', a.tglkembali) terlambat from pinjam a left join daftarpustaka b on a.kodepustaka=b.kodepustaka left join pustaka c on b.pustaka=c.replid left join (select nis, nama from siswa union all select nip nis, nama from pegawai) d on a.idanggota=d.nis " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	function get_denda() {
		$dbpdo = DB::create();
		
		$sqlstr = "select * from konfigurasi order by ts desc limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$denda = $data->denda;
		
		return $denda;
	}
	
	//---------get data konfigurasi
	function list_konfigurasi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.siswa, a.pegawai, a.other, a.denda, a.ts from konfigurasi a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data pegawai
	function list_pegawai($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where a.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.jenis_id, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.karpeg, a.no_sertifikasi, a.idjenis_sertifikasi, a.npwp, a.nuptk, a.tmt_cpns, a.unit_cpns, a.no_sk_masuk, a.idstatus_pegawai, a.nik, a.nama_ibu, a.nama_pasangan, a.tempat_lahir_pasangan, a.tanggal_lahir_pasangan, a.tanggal_nikah, a.tempat_nikah, a.pekerjaan_pasangan, a.instansi_pasangan, a.nip_pasangan, a.keluarga_tanggungan, a.usia, a.ajar_lain, a.jumlah_jam_ajar_lain, a.nama_bank, a.unit_bank, a.no_rek, a.nama_pemilik, a.desa, a.kecamatan, a.kode_pos, a.tanggal_pensiun, a.foto_file, a.bagian, a.keterangan, a.no_sk_tetap, a.tanggal_sk_tetap, a.ts from pegawai a " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data statusguru
	function list_statusguru($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.status, a.keterangan, a.ts from statusguru a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data jabatan
	function list_jabatan($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.aktif, a.uid, a.dlu from jabatan a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data jenis pelanggaran
	function list_jenis_pelanggaran($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.poin, a.aktif, a.uid, a.dlu from jenis_pelanggaran a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data jenis prestasi
	function list_jenis_prestasi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.poin, a.aktif, a.uid, a.dlu from jenis_prestasi a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pelanggaran_siswa
	function list_pelanggaran_siswa($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.ref, a.tanggal, a.idsiswa, a.idjenis_pelanggaran, a.kejadian, a.hukuman, a.photo, a.uid, a.dlu, b.nis, b.nama, b.idkelas, c.kelas, c.idtingkat, d.tingkat from pelanggaran_siswa a left join siswa b on a.idsiswa=b.replid left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid " . $where . " order by a.ref ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data konseling_siswa
	function list_konseling_siswa($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.ref, a.tanggal, a.idsiswa, a.idjenis_konseling, a.konseling, a.solusi, a.nip, a.data_file, a.uid, a.dlu, b.nis, b.nama, b.idkelas, c.kelas, c.idtingkat, d.tingkat, d.departemen from konseling_siswa a left join siswa b on a.idsiswa=b.replid left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid " . $where . " order by a.ref ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai jabatan
	function list_pegawai_jabatan($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai jabatan 
	function list_get_pegawai_jabatan($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.idjabatan, a.tanggal_efektif, a.keterangan, a.uid, a.dlu from pegawai_jabatan a " . $where . " order by a.tanggal_efektif desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai jabatan detail
	function list_get_pegawai_jabatan_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.idjabatan, a.tanggal_efektif, a.keterangan, a.uid, a.dlu, b.nama jabatan from pegawai_jabatan a left join jabatan b on a.idjabatan=b.replid " . $where . " order by a.tanggal_efektif desc ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
    
    //---------get data jenis izin
	function list_jenis_izin($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.keterangan, a.format_surat, a.aktif, a.uid, a.dlu from jenis_izin a " . $where . " order by a.replid ";		
        $sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
    
    //---------get data izin siswa
	function list_izin_siswa($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.tanggal, a.idsiswa, a.idjenis_izin, a.format_surat, a.keterangan, a.idpegawai, a.status, a.uid, a.dlu, b.nis, b.nama nama_siswa, b.idkelas, c.kelas, c.idtingkat, d.tingkat, e.nama nama_pegawai from izin_siswa a left join siswa b on a.idsiswa=b.replid left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join pegawai e on a.idpegawai=e.replid " . $where . " order by a.replid ";		
        $sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
    
	
	//---------get data pangkat
	function list_pangkat($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.aktif, a.uid, a.dlu from pangkat a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pangkat
	function list_pegawai_pangkat($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pangkat 
	function list_get_pegawai_pangkat($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.idpangkat, a.tanggal_efektif, a.ruang, a.sk, a.no_sk, a.gaji_pokok, a.tanggal_sk, a.idjabatan, a.keterangan, a.uid, a.dlu from pegawai_pangkat a " . $where . " order by a.tanggal_efektif desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pangkat detail
	function list_get_pegawai_pangkat_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.idpangkat, a.tanggal_efektif, a.ruang, a.sk, a.no_sk, a.gaji_pokok, a.tanggal_sk, a.idjabatan, a.keterangan, a.uid, a.dlu, b.nama pangkat, c.nama jabatan from pegawai_pangkat a left join pangkat b on a.idpangkat=b.replid left join jabatan c on a.idjabatan=c.replid " . $where . " order by a.tanggal_efektif desc ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data jenis sertifikasi
	function list_jenis_sertifikasi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.aktif, a.uid, a.dlu from jenis_sertifikasi a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data status pegawai
	function list_status_pegawai($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.nama, a.aktif, a.uid, a.dlu from status_pegawai a " . $where . " order by a.replid ";		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai kenaikan gaji berkala
	function list_kenaikan_gaji($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai kenaikan gaji berkala 
	function list_get_kenaikan_gaji($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.no_kgb, a.tmt, a.tanggal_kgb, a.gaji_pokok, a.keterangan, a.uid, a.dlu from kenaikan_gaji a " . $where . " order by a.tanggal_kgb desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai kenaikan gaji detail
	function list_get_kenaikan_gaji_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.no_kgb, a.gaji_pokok, a.tmt, a.tanggal_kgb, a.keterangan, a.uid, a.dlu from kenaikan_gaji a  " . $where . " order by a.tmt desc ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pendidikan
	function list_pegawai_pendidikan($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pendidikan get
	function list_get_pegawai_pendidikan($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.nama_sekolah, a.tahun, a.jenjang, a.lulusan, a.jurusan, a.keterangan, a.uid, a.dlu from pegawai_pendidikan a " . $where . " order by a.replid desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai pendidikan detail
	function list_get_pegawai_pendidikan_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.nama_sekolah, a.tahun, a.jenjang, a.lulusan, a.jurusan, a.keterangan, a.uid, a.dlu from pegawai_pendidikan a  " . $where . " order by a.replid desc ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//===============
	//---------get data pegawai keluarga
	function list_pegawai_keluarga($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai keluarga get
	function list_get_pegawai_keluarga($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.nama_anak, a.tempat_lahir, a.tanggal_lahir, a.pekerjaan, a.status, a.anak_ke, a.keterangan, a.uid, a.dlu from pegawai_keluarga a " . $where . " order by a.replid desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai keluarga detail
	function list_get_pegawai_keluarga_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.nama_anak, a.tempat_lahir, a.tanggal_lahir, a.pekerjaan, a.status, a.anak_ke, a.keterangan, a.uid, a.dlu from pegawai_keluarga a  " . $where . " order by a.anak_ke ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data supplier
	function list_supplier($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.alamat, a.telepon, a.hp, a.aktif, a.uid, a.dlu from supplier a  " . $where . " order by a.replid ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai prestasi
	function list_pegawai_prestasi($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama namapeg, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai prestasi get
	function list_get_pegawai_prestasi($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.jenisprestasi, a.tingkat, a.nama, a.tahun, a.penyelenggara, a.uid, a.dlu from pegawai_prestasi a " . $where . " order by a.replid desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai prestasi detail
	function list_get_pegawai_prestasi_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.jenisprestasi, a.tingkat, a.nama, a.tahun, a.penyelenggara, a.uid, a.dlu from pegawai_prestasi a  " . $where . " order by a.nama ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai penghargaan
	function list_pegawai_penghargaan($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama namapeg, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai penghargaan get
	function list_get_pegawai_penghargaan($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.namapenghargaan, a.tahun, a.pemberipenghargaan, a.uid, a.dlu from pegawai_penghargaan a " . $where . " order by a.replid desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai penghargaan detail
	function list_get_pegawai_penghargaan_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.namapenghargaan, a.tahun, a.pemberipenghargaan, a.uid, a.dlu from pegawai_penghargaan a  " . $where . " order by a.namapenghargaan ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai sk mengajar
	function list_pegawai_skmengajar($replid='', $bagian='', $nip='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($bagian != "") {
			if ($where == "") {
				$where = " where a.bagian = '$bagian' ";
			} else {
				$where = $where . " and a.bagian = '$bagian' ";
			}
		}
		
		if ($nip != "") {
			if ($where == "") {
				$where = " where a.nip = '$nip' ";
			} else {
				$where = $where . " and a.nip = '$nip' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nip, a.nama namapeg, a.panggilan, a.kelamin, a.gelar, a.tmplahir, a.tgllahir, a.agama, a.suku, a.nikah, a.noid, a.alamat, a.telpon, a.handphone, a.email, a.foto_file, a.bagian, a.keterangan, a.ts from pegawai a " . $where . " order by a.replid ";		
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai skmengajar get
	function list_get_pegawai_skmengajar($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.no_sk, a.tahun, a.fungsional, a.uid, a.dlu from pegawai_skmengajar a " . $where . " order by a.replid desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pegawai skmengajar detail
	function list_get_pegawai_skmengajar_detail($idpegawai=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idpegawai != "") {
			if ($where == "") {
				$where = " where a.idpegawai = '$idpegawai' ";
			} else {
				$where = $where . " and a.idpegawai = '$idpegawai' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idpegawai, a.no_sk, a.tahun, a.fungsional, a.uid, a.dlu from pegawai_skmengajar a  " . $where . " order by a.no_sk ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data pelajaran
	function list_pelajaran($replid=''){
		$dbpdo = DB::create();
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.departemen, a.sifat, a.aktif, a.keterangan, a.info3, a.ts from pelajaran a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa ekstrakurikuler
	function list_siswa_ekstrakurikuler($replid='', $unit='', $nis='', $nama='', $all=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($unit != "") {
			if ($where == "") {
				$where = " where c.departemen = '$unit' ";
			} else {
				$where = $where . " and c.departemen = '$unit' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}
		}
		
		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}
		
		if($all == 1) {
			$where = " where b.replid=0";
		}
		
		$sqlstr	=	"select a.replid, a.nis, a.nama, b.kelas, c.tingkat, c.departemen from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.replid ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa ekstrakurikuler get
	function list_get_siswa_ekstrakurikuler($idsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idsiswa, a.idpelajaran, a.tanggal, a.uid, a.dlu from siswa_ekstrakurikuler a " . $where . " order by a.replid desc limit 1 ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data siswa ekstrakurikuler detail
	function list_get_siswa_ekstrakurikuler_detail($idsiswa=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($idsiswa != "") {
			if ($where == "") {
				$where = " where a.idsiswa = '$idsiswa' ";
			} else {
				$where = $where . " and a.idsiswa = '$idsiswa' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idsiswa, a.idpelajaran, a.tanggal, a.uid, a.dlu, b.nama nama_ekskul from siswa_ekstrakurikuler a left join pelajaran b on a.idpelajaran=b.replid  " . $where . " order by a.idpelajaran ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data semester
	function list_semester($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.semester, a.departemen, a.aktif, a.ts from semester a " . $where . " order by a.departemen, a.semester ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data angkatan
	function list_angkatan($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.angkatan, a.departemen, a.aktif, a.ts from angkatan a " . $where . " order by a.departemen, a.angkatan ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data rpp
	function list_rpp($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.idtingkat, a.idsemester, a.idpelajaran, a.koderpp, a.rpp, a.deskripsi, a.aktif, a.ts, b.tingkat, b.departemen, c.nama pelajaran, d.semester from rpp a left join tingkat b on a.idtingkat=b.replid left join pelajaran c on a.idpelajaran=c.replid left join semester d on a.idsemester=d.replid " . $where . " order by b.departemen, c.nama ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data dasarpenilaian
	function list_dasarpenilaian($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.dasarpenilaian, a.keterangan, a.ts from dasarpenilaian a " . $where . " order by a.replid ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data kompetensi
	function list_kompetensi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.kompetensi, a.aktif, a.dlu from kompetensi a " . $where . " order by a.replid ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data jenis kompetensi
	function list_jeniskompetensi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.jeniskompetensi, a.aktif, a.dlu from jeniskompetensi a " . $where . " order by a.replid ";
				
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data daftar nilai (pelajaran)
	function list_daftarnilai_pelajaran($replid='', $departemen='', $all=0){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		if($all == 1) {
			$where = "";
		}
		
		if($replid == "" && $departemen == "" && $all == 0) {
			$where = " where a.departemen = 'xxx' ";
		}
		
		$sqlstr	=	"select a.replid, a.kode, a.nama, a.departemen, a.sifat, a.aktif, a.keterangan, a.info3, a.ts from pelajaran a " . $where . " order by a.replid ";	
			
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data aspek_perkembangan
	function list_aspek_perkembangan($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.aspek, a.aktif, a.uid, a.dlu from aspek_perkembangan a " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data aspek_psikologi
	function list_aspek_psikologi($ref='', $departemen=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.departemen, a.aspek, a.aktif, a.uid, a.dlu from aspek_psikologi a " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data aspek_psikologi_detail
	function list_aspek_psikologi_detail($ref='', $jenis_aspek_id=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
		
		if ($jenis_aspek_id != "") {
			if ($where == "") {
				$where = " where a.jenis_aspek_id = '$jenis_aspek_id' ";
			} else {
				$where = $where . " and a.jenis_aspek_id = '$jenis_aspek_id' ";
			}
		}
		
		$sqlstr	=	"select a.replid, a.departemen, a.jenis_aspek_id, a.aspek, a.aktif, a.uid, a.dlu, b.aspek jenis_aspek from aspek_psikologi_detail a left join aspek_psikologi b on a.jenis_aspek_id=b.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	//---------get data assesmen_observasi
	function list_assesmen_observasi($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
				
		$sqlstr	=	"select a.ref, a.tanggal, a.idsiswa, a.idpegawai, a.idpegawai1, a.data_file, b.nis, b.nama nama_siswa, b.panggilan, b.tmplahir, b.tgllahir, b.alamatsiswa, b.anakke, b.namaayah, b.pekerjaanayah, b.namaibu, b.pekerjaanibu, a.uid, a.dlu, c.nip, c.nama pegawai, d.nip nip1, d.nama pegawai1, f.departemen, e.idtingkat, b.idkelas, g.pekerjaan pekerjaan_ayah, h.pekerjaan pekerjaan_ibu, e.kelas, f.tingkat from assesmen_observasi a left join siswa b on a.idsiswa=b.replid left join pegawai c on a.idpegawai=c.replid left join pegawai d on a.idpegawai1=d.replid left join kelas e on b.idkelas=e.replid left join tingkat f on e.idtingkat=f.replid left join jenispekerjaan g on b.pekerjaanayah=g.replid left join jenispekerjaan h on b.pekerjaanibu=h.replid " . $where . " order by a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data list_assesmen_observasi_detail
	function list_assesmen_observasi_detail($ref='', $idaspek_perkembangan){
		$dbpdo = DB::create();
		
		$sqlstr	=	"select a.ref, a.idaspek_perkembangan, a.hasil, a.saran, a.line from assesmen_observasi_detail a where a.ref='$ref' and idaspek_perkembangan='$idaspek_perkembangan' order by a.line ";	
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data anggota
	function list_anggota($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.replid = '$ref' ";
			} else {
				$where = $where . " and a.replid = '$ref' ";
			}
		}
				
		$sqlstr	=	"select a.replid, a.noregistrasi, a.nama, a.alamat, a.kodepos, a.email, a.telpon, a.HP, a.pekerjaan, a.institusi, a.keterangan, a.tgldaftar, a.aktif, a.foto, a.ts from anggota a " . $where . " order by a.nama ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//-----------user reminder
	function list_usr_reminder() {
		$dbpdo = DB::create();
		
		$usrid = $_SESSION["loginname"];
		
		$sqlstr = "select aa.* from (select a.reminder_id, b.nama, 1 rmd_old from usr_reminder a left join usr_list_reminder b on a.reminder_id=b.replid where a.usrid='$usrid' union all
		select a.replid reminder_id, a.nama, 0 rmd_old from usr_list_reminder a where a.replid not in (select reminder_id from usr_reminder where usrid='$usrid' )) aa order by aa.rmd_old desc, aa.reminder_id ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data evaluasi_psikologi
	function list_evaluasi_psikologi($ref='', $departemen='', $nis='', $idsemester=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}
		}
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}
		}
				
		$sqlstr	=	"select a.ref, a.tanggal, a.departemen, a.idtingkat, a.idkelas, a.nis, a.idpegawai, a.idsemester, a.uid, a.dlu, b.nama nama_siswa, c.kelas, d.tingkat, e.semester nama_semester from evaluasi_psikologi a left join siswa b on a.nis=b.nis left join kelas c on b.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid left join semester e on a.idsemester=e.replid " . $where . " order by a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data evaluasi_psikologi_level
	/*function list_evaluasi_psikologi_level($ref=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
				
		$sqlstr	=	"select distinct a.level from evaluasi_psikologi_detail a " . $where . " order by a.level ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}*/
	
	
	//---------get data evaluasi_psikologi_IQ
	function list_evaluasi_psikologi_iq($ref='', $departemen='', $idtingkat='', $idkelas='', $nis='', $idsemester=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where b.departemen = '$departemen' ";
			} else {
				$where = $where . " and b.departemen = '$departemen' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where b.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and b.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " where b.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and b.idkelas = '$idkelas' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where b.nis = '$nis' ";
			} else {
				$where = $where . " and b.nis = '$nis' ";
			}
		}
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where b.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and b.idsemester = '$idsemester' ";
			}
		}
				
		$sqlstr	=	"select a.ref, a.iq, b.tanggal, a.jenis_aspek_id, a.aspek_psikologi_id from evaluasi_psikologi_detail a left join evaluasi_psikologi b on a.ref=b.ref " . $where . " order by a.ref ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data evaluasi_psikologi_nilai
	function list_evaluasi_psikologi_nilai($ref='', $jenis_aspek_id='', $aspek_psikologi_id='', $departemen='', $idtingkat='', $idkelas='',  $nis='', $idsemester=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($ref != "") {
			if ($where == "") {
				$where = " where a.ref = '$ref' ";
			} else {
				$where = $where . " and a.ref = '$ref' ";
			}
		}
		
		
		if ($jenis_aspek_id != "") {
			if ($where == "") {
				$where = " where a.jenis_aspek_id = '$jenis_aspek_id' ";
			} else {
				$where = $where . " and a.jenis_aspek_id = '$jenis_aspek_id' ";
			}
		}
		
		if ($aspek_psikologi_id != "") {
			if ($where == "") {
				$where = " where a.aspek_psikologi_id = '$aspek_psikologi_id' ";
			} else {
				$where = $where . " and a.aspek_psikologi_id = '$aspek_psikologi_id' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " where b.departemen = '$departemen' ";
			} else {
				$where = $where . " and b.departemen = '$departemen' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where b.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and b.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " where b.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and b.idkelas = '$idkelas' ";
			}
		}
		
		if ($nis != "") {
			if ($where == "") {
				$where = " where b.nis = '$nis' ";
			} else {
				$where = $where . " and b.nis = '$nis' ";
			}
		}
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where b.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and b.idsemester = '$idsemester' ";
			}
		}
				
		$sqlstr	=	"select a.nilai, a.line from evaluasi_psikologi_detail a left join evaluasi_psikologi b on a.ref=b.ref " . $where . " order by a.line ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	//---------get data evaluasi_psikologi_total_nilai
	function list_evaluasi_psikologi_totalnilai($jenis_aspek_id='', $aspek_psikologi_id='', $departemen='', $idtingkat='', $idkelas='',  $idsemester=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($jenis_aspek_id != "") {
			if ($where == "") {
				$where = " having a.jenis_aspek_id = '$jenis_aspek_id' ";
			} else {
				$where = $where . " and a.jenis_aspek_id = '$jenis_aspek_id' ";
			}
		}
		
		if ($aspek_psikologi_id != "") {
			if ($where == "") {
				$where = " having a.aspek_psikologi_id = '$aspek_psikologi_id' ";
			} else {
				$where = $where . " and a.aspek_psikologi_id = '$aspek_psikologi_id' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " having b.departemen = '$departemen' ";
			} else {
				$where = $where . " and b.departemen = '$departemen' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " having b.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and b.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " having b.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and b.idkelas = '$idkelas' ";
			}
		}
		
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where b.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and b.idsemester = '$idsemester' ";
			}
		}
				
		$sqlstr	=	"select sum(a.nilai) totalnilai, a.jenis_aspek_id, a.aspek_psikologi_id, b.departemen, b.idtingkat, b.idkelas, b.idsemester from evaluasi_psikologi_detail a left join evaluasi_psikologi b on a.ref=b.ref group by a.jenis_aspek_id, a.aspek_psikologi_id, b.departemen, b.idtingkat, b.idkelas, b.idsemester  " . $where ;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------get data evaluasi_psikologi_per siswa
	function list_evaluasi_psikologi_persiswa($nis='', $departemen='', $idtingkat='', $idkelas='',  $idsemester=''){
		$dbpdo = DB::create();
		
		$where = "";
		
		if ($nis != "") {
			if ($where == "") {
				$where = " having a.nis = '$nis' ";
			} else {
				$where = $where . " and a.nis = '$nis' ";
			}
		}
		
		if ($departemen != "") {
			if ($where == "") {
				$where = " having a.departemen = '$departemen' ";
			} else {
				$where = $where . " and a.departemen = '$departemen' ";
			}
		}
		
		if ($idtingkat != "") {
			if ($where == "") {
				$where = " having a.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$idtingkat' ";
			}
		}
		
		if ($idkelas != "") {
			if ($where == "") {
				$where = " having a.idkelas = '$idkelas' ";
			} else {
				$where = $where . " and a.idkelas = '$idkelas' ";
			}
		}
		
		
		if ($idsemester != "") {
			if ($where == "") {
				$where = " where a.idsemester = '$idsemester' ";
			} else {
				$where = $where . " and a.idsemester = '$idsemester' ";
			}
		}
				
		$sqlstr	=	"select a.nis, b.nama nama_siswa, a.departemen, c.kelas, d.tingkat from evaluasi_psikologi a left join siswa b on a.nis=b.nis left join kelas c on a.idkelas=c.replid left join tingkat d on a.idtingkat=d.replid " . $where ;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		return $sql;
	}
	
	
	
	//---------get data presensi ukbm
	function list_presensi_ukbm_view($id='', $all='', $tingkat='', $kelas='', $tanggal='', $idguru='')
	{
		$dbpdo = DB::create();

		$where = "";

		if ( $id != "") {
			if ($where == "") {
				$where = " where a.replid = '$id' ";
			} else {
				$where = $where . " and a.replid = '$id' ";
			}
		}

		if ( $tingkat != "") {
			if ($where == "") {
				$where = " where a.idtingkat = '$tingkat' ";
			} else {
				$where = $where . " and a.idtingkat = '$tingkat' ";
			}
		}

		if ( $kelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$kelas' ";
			} else {
				$where = $where . " and a.idkelas = '$kelas' ";
			}
		}

		if ( $tanggal != "") {

			$tanggal = date("Y-m-d", strtotime($tanggal));

			if ($where == "") {
				$where = " where date_format(a.tanggal,'%Y-%m-%d') = '$tanggal' ";
			} else {
				$where = $where . " and date_format(a.tanggal,'%Y-%m-%d') = '$tanggal' ";
			}
		}


		if ($all == 1) {
			$where = "";
		}

		$sqlstr="select distinct a.ref, a.tanggal, a.idpelajaran, a.idguru, a.idsemester, a.idukbm, b.kelas, c.tingkat, d.semester, e.nama nama_guru, f.nama pelajaran, '' kode, '' ukbm from presensi_ukbm a left join kelas b on a.idkelas=b.replid left join tingkat c on a.idtingkat=c.replid left join semester d on a.idsemester=d.replid left join pegawai e on a.idguru=e.replid left join pelajaran f on a.idpelajaran=f.replid " . $where . " order by a.tanggal";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();


		return $sql;
	}


	//---------get data siswa
	function list_presensi_ukbm_detail($ref='', $replid='', $idtingkat='', $kelas='')
	{
		$dbpdo = DB::create();

		$where = " where ifnull(a.alumni,0)=0 ";

		if ($ref != "") {
			if ($where == "") {
				$where = " where b.ref = '$ref' ";
			} else {
				$where = $where . " and b.ref = '$ref' ";
			}
		}

		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}

		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where c.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and c.idtingkat = '$idtingkat' ";
			}
		}

		if ($kelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$kelas' ";
			} else {
				$where = $where . " and a.idkelas = '$kelas' ";
			}
		}


		if ($ref=='' && $replid=='' && $idtingkat=='' && $kelas=='') {
			$where = " where a.replid = 0 ";
		}

		//$sqlstr	= "select a.replid, d.tanggal, a.nis, a.nama, a.idkelas, b.idtingkat, b.kelas, c.tingkat, d.ref, ifnull(d.hadir,0) hadir, ifnull(d.dispensasi,0) dispensasi, ifnull(d.sakit,0) sakit, ifnull(d.izin,0) izin, ifnull(d.alpa,0) alpa from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid left join presensi_ukbm d on a.replid=d.idsiswa and a.idkelas=d.idkelas and b.idtingkat=d.idtingkat " . $where . " order by a.replid ";
		$sqlstr = "select b.tanggal, a.replid, a.nis, a.nama, a.idkelas, b.idtingkat, c.kelas, b.ref, d.tingkat, ifnull(b.hadir,0) hadir, ifnull(b.dispensasi,0) dispensasi, ifnull(b.sakit,0) sakit, ifnull(b.izin,0) izin, ifnull(b.alpa,0) alpa from siswa a left join presensi_ukbm b on a.replid=b.idsiswa left join kelas c on a.idkelas=c.replid left join tingkat d on c.idtingkat=d.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		return $sql;
	}
	
	
	//---------get data presensi ukbm
	function list_presensi_ukbm($id='', $all='')
	{
		$dbpdo = DB::create();

		$where = "";

		if ( $id != "") {
			if ($where == "") {
				$where = " where a.ref = '$id' ";
			} else {
				$where = $where . " and a.ref = '$id' ";
			}
		}


		if ($all == 1) {
			$where = "";
		}

		$sqlstr="select a.replid, a.tanggal, a.idtingkat, a.idkelas, a.idsiswa, a.idpelajaran, a.idguru, a.idsemester, a.idukbm, a.hadir, a.dispensasi, a.sakit, a.izin, a.alpa, a.uid, a.dlu, a.ref from presensi_ukbm a " . $where . " order by a.ref";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();


		return $sql;
	}
	
	
	//---------get data siswa
	function list_presensi_ukbm_siswa($ref='', $replid='', $idtingkat='', $kelas='', $nama='', $all, $departemen='')
	{
		$dbpdo = DB::create();

		$where = " where ifnull(a.alumni,0)=0 ";

		if ($ref != "") {
			if ($where == "") {
				$where = " where a.nis = '$ref' ";
			} else {
				$where = $where . " and a.nis = '$ref' ";
			}
		}

		if ($replid != "") {
			if ($where == "") {
				$where = " where a.replid = '$replid' ";
			} else {
				$where = $where . " and a.replid = '$replid' ";
			}
		}

		if ($idtingkat != "") {
			if ($where == "") {
				$where = " where b.idtingkat = '$idtingkat' ";
			} else {
				$where = $where . " and b.idtingkat = '$idtingkat' ";
			}
		}

		if ($kelas != "") {
			if ($where == "") {
				$where = " where a.idkelas = '$kelas' ";
			} else {
				$where = $where . " and a.idkelas = '$kelas' ";
			}
		}

		if ($nama != "") {
			if ($where == "") {
				$where = " where a.nama like '%$nama%' ";
			} else {
				$where = $where . " and a.nama like '%$nama%' ";
			}
		}

		if ($departemen != "") {
			if ($where == "") {
				$where = " where c.departemen = '$departemen' ";
			} else {
				$where = $where . " and c.departemen = '$departemen' ";
			}
		}


		if ($all != "") {
			$where = " where ifnull(a.alumni,0)=0 ";
		}

		if ($ref=='' && $replid=='' && $idtingkat=='' && $kelas=='' && $nama=='' && $all=='' && $departemen=='') {
			$where = " where a.replid = 0 ";
		}

		$sqlstr	=	"select a.replid, a.nis, a.nisn, a.idangkatan, a.idangkatan1, a.foto_file, a.nama, a.idkelas, a.kelamin, a.tmplahir, a.tgllahir, a.agama, a.warga, a.anakke, a.jsaudara, a.jtiri, a.jangkat, a.yatim, a.bahasa, a.alamatsiswa, a.alamatortu, a.telponsiswa, a.hpsiswa, a.telponortu, a.hportu, a.hpibu, a.jaraksekolah, a.kesekolah, a.berat, a.tinggi, a.kesehatan, a.darah, a.file_darah, a.kelainan, a.asalsekolah_id, a.tglijazah, a.noijazah, a.tglskhun, a.skhun, a.noujian, a.nisnasal, a.namaayah, a.namaibu, a.tmplahirayah, a.tgllahirayah, a.tmplahiribu, a.tgllahiribu, a.pekerjaanayah, a.pekerjaanibu, a.penghasilanayah, a.penghasilanibu, a.pendidikanayah, a.pendidikanibu, a.wnayah, a.wnibu, a.wali, a.tmplahirwali, a.tgllahirwali, a.pendidikanwali, a.pekerjaanwali, a.penghasilanwali, a.alamatwali, a.hpwali, a.hubungansiswa, a.pekerjaanayah_lain, a.pekerjaanibu_lain, a.pekerjaanwali_lain, a.uid, a.ts, b.idtingkat, b.kelas, c.tingkat from siswa a left join kelas b on a.idkelas=b.replid left join tingkat c on b.idtingkat=c.replid " . $where . " order by a.replid ";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();

		return $sql;
	}
	
	
}
?>
			