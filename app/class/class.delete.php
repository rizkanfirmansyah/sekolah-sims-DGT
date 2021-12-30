<?php

class delete{
	
	//----hapus user
	function delete_usr($ref){
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select usrid from usr where id=$ref");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		
		$sql=$dbpdo->prepare("delete from usr_dtl where usrid='$data->usrid' ");
		$sql->execute();
		
		$sql=$dbpdo->prepare("delete from usr where id='$ref' ");
		$sql->execute();
	
		//----delete user backup
		$sql=$dbpdo->prepare("delete from usr_bup where usrid='$data->usrid' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus registrasi
	function delete_registrasi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select replid, foto_file, file_darah from calonsiswa where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$idcalonsiswa = $data->replid;
		$foto_file = $data->foto_file;
		$file_darah = $data->file_darah;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/file_foto/';
			unlink($uploaddir . $foto_file); //remove file 
		}
		
		if($file_darah != '') {
			$uploaddir 		= 'app/file_darah/';
			unlink($uploaddir . $file_darah_calon); //remove file 
		}
		
		$sql=$dbpdo->prepare("delete from calonsiswa_beasiswa where idcalonsiswa='$idcalonsiswa' ");
		$sql->execute();
	
		//----delete calon siswa
		$sql=$dbpdo->prepare("delete from calonsiswa_prestasi where idcalonsiswa='$idcalonsiswa' ");
		$sql->execute();
		
		$sql=$dbpdo->prepare("delete from calonsiswa where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus siswa
	function delete_siswa($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select file_darah, foto_file from siswa where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$file_darah = $data->file_darah;
		
		if($file_darah != '') {
			$uploaddir 		= 'app/file_darah/';
			unlink($uploaddir . $file_darah); //remove file 
		}
		
		$foto_file = $data->foto_file;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/file_foto_siswa/';
			unlink($uploaddir . $foto_file); //remove file 
		}
		
		//----delete siswa beasiswa
		$sql=$dbpdo->prepare("delete from siswa_beasiswa where idsiswa='$ref' ");
		$sql->execute();
	
		//----delete siswa prestasi
		$sql=$dbpdo->prepare("delete from siswa_prestasi where idsiswa='$ref' ");
		$sql->execute();
		
		//----delete siswa
		$sql=$dbpdo->prepare("delete from siswa where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus proses penerimaan siswa
	function delete_prosespenerimaansiswa($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from prosespenerimaansiswa where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus proses kelompok calon siswa
	function delete_kelompokcalonsiswa($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from kelompokcalonsiswa where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus departemen
	function delete_departemen($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from departemen where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus tingkat
	function delete_tingkat($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from tingkat where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus kelas
	function delete_kelas($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from kelas where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus tahun ajaran
	function delete_tahunajaran($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from tahunajaran where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus agama
	function delete_agama($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from agama where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus tahun buku
	function delete_tahunbuku($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from tahunbuku where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus rekakun
	function delete_rekakun($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from rekakun where kode='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus datapenerimaan
	function delete_datapenerimaan($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from datapenerimaan where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus datapengeluaran
	function delete_datapengeluaran($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from datapengeluaran where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus besarjtt
	function delete_besarjtt($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from besarjtt where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus perpustakaan
	function delete_perpustakaan($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from perpustakaan where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus format
	function delete_format($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from format where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus rak
	function delete_rak($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from rak where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus katalog
	function delete_katalog($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from katalog where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus penerbit
	function delete_penerbit($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from penerbit where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus penulis
	function delete_penulis($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from penulis where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus delete penerimaan
	function delete_rpt_penerimaan($ref){
		
		$dbpdo = DB::create();
		
		$sql = "select idbesarjtt, idjurnal, jumlah from penerimaanjtt where replid = '$ref'";
		$result = $dbpdo->query($sql);
		$data = $result->fetch(PDO::FETCH_OBJ);
		$idbesarjtt = $data->idbesarjtt;
		$jumlah = $data->jumlah;
		
		//---get data
		$sqlx = "select idpenerimaan, nis, info2 from besarjtt where  replid = '$idbesarjtt'";
		$resultx = $dbpdo->query($sqlx);
		$datax = $resultx->fetch(PDO::FETCH_OBJ);
		$idpenerimaan = $datax->idpenerimaan;
		$nis = $datax->nis;
		$idtahunbuku = $datax->info2;
		//---------end get data
		
		//---update keterangan lunas
		$sql = $dbpdo->prepare("update besarjtt set info3='', lunas=0 where replid = '$idbesarjtt'");
		$sql->execute();
		//---------end keterangan lunas
		
		//---delete jurnal
		$sql = $dbpdo->prepare("DELETE FROM jurnaldetail WHERE idjurnal = '$data->idjurnal'");
		$sql->execute();
		
		$sql = $dbpdo->prepare("DELETE FROM jurnal WHERE replid = '$data->idjurnal'");
		$sql->execute();
		//-------end jurnal
		
		$sql = $dbpdo->prepare("DELETE FROM penerimaanjtt WHERE replid = '$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pustaka
	function delete_pustaka($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select katalog, photo from pustaka where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->photo;
		$katalog = $data->katalog;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/file_foto_pustaka/';
			unlink($uploaddir . $foto_file); //remove file 
		}
		
		$sqlstr = "select count(replid) mcount from daftarpustaka where pustaka='$ref'";
		$sqlcek = $dbpdo->prepare($sqlstr);
		$sqlcek->execute();
		$rowdata = $sqlcek->fetch(PDO::FETCH_OBJ);
		$jum = $rowdata->mcount;
				
		$sqlstr 	= 	"select counter from katalog where replid='$katalog'";
		$sqlcek		=	$dbpdo->query($sqlstr);
		$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
		$counter 	= 	$data->counter;
		
		$newcounter = (int)$counter - (int)$jum;
		
		$sqlstr = "update katalog set counter=$newcounter where replid='$katalog'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		//--------start delete
		$sqlstr = "delete from daftarpustaka where pustaka='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		$sql=$dbpdo->prepare("delete from pustaka_suppler where pustaka_id='$ref' ");
		$sql->execute();
			
		$sql=$dbpdo->prepare("delete from pustaka where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus daftarpustaka
	function delete_daftarpustaka($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select pustaka from daftarpustaka where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->photo;
		$pustaka = $data->pustaka;
		
		$sql=$dbpdo->query("select katalog, photo from pustaka where replid='$pustaka' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->photo;
		$katalog = $data->katalog;
				
		$sqlstr = "select count(replid) mcount from daftarpustaka where pustaka='$ref'";
		$sqlcek = $dbpdo->prepare($sqlstr);
		$sqlcek->execute();
		$rowdata = $sqlcek->fetch(PDO::FETCH_OBJ);
		$jum = $rowdata->mcount;
				
		$sqlstr 	= 	"select counter from katalog where replid='$katalog'";
		$sqlcek		=	$dbpdo->query($sqlstr);
		$data		=	$sqlcek->fetch(PDO::FETCH_OBJ);
		$counter 	= 	$data->counter;
		
		$newcounter = (int)$counter - (int)$jum;
		
		$sqlstr = "update katalog set counter=$newcounter where replid='$katalog'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		
		//--------start delete
		$sqlstr = "delete from daftarpustaka where pustaka='$ref'";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
				
		return $sql;
	}
	
	
	//----hapus pinjam detal pra save
	function delete_pinjam_detail($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pinjam where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus konfigurasi
	function delete_konfigurasi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from konfigurasi where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai
	function delete_pegawai($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select foto_file from pegawai where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->foto_file;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/file_foto_pegawai/';
			unlink($uploaddir . $foto_file); //remove file 
		}
		
		$sql=$dbpdo->prepare("delete from pegawai where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus status guru
	function delete_statusguru($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from statusguru where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus jabatan
	function delete_jabatan($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jabatan where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus jenis_pelanggaran
	function delete_jenis_pelanggaran($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jenis_pelanggaran where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus jenis_prestasi
	function delete_jenis_prestasi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jenis_prestasi where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus pelanggaran_siswa
	function delete_pelanggaran_siswa($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select photo from pelanggaran_siswa where ref='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$foto_file = $data->photo;
		
		if($foto_file != '') {
			$uploaddir 		= 'app/file_foto_pelanggaran/';
			unlink($uploaddir . $foto_file); //remove file 
		}
		
		$sql=$dbpdo->prepare("delete from pelanggaran_siswa where ref='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus konseling_siswa
	function delete_konseling_siswa($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from konseling_siswa where ref='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai jabatan
	function delete_pegawai_jabatan($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_jabatan where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
    
    //----hapus jenis izin
	function delete_jenis_izin($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jenis_izin where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
    
    //----hapus izin_siswa
	function delete_izin_siswa($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from izin_siswa where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus jenis_sertifikasi
	function delete_jenis_sertifikasi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jenis_sertifikasi where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai pangkat
	function delete_pegawai_pangkat($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_pangkat where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus pegawai kenaikan gaji berkala (KGB)
	function delete_kenaikan_gaji($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from kenaikan_gaji where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus pegawai pendidikan
	function delete_pegawai_pendidikan($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_pendidikan where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus pegawai keluarga
	function delete_pegawai_keluarga($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_keluarga where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
		
	//----hapus supplier
	function delete_supplier($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from supplier where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai prestasi
	function delete_pegawai_prestasi($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_prestasi where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai penghargaan
	function delete_pegawai_penghargaan($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_penghargaan where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pegawai skmengajar
	function delete_pegawai_skmengajar($ref='', $idpegawai=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pegawai_skmengajar where replid='$ref' and idpegawai='$idpegawai' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus pelajaran
	function delete_pelajaran($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from pelajaran where replid='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus siswa ekskul
	function delete_siswa_ekstrakurikuler($ref='', $idsiswa=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from siswa_ekstrakurikuler where replid='$ref' and idsiswa='$idsiswa' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus semester
	function delete_semester($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from semester where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus angkatan
	function delete_angkatan($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from angkatan where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus rpp
	function delete_rpp($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from rpp where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus dasarpenilaian
	function delete_dasarpenilaian($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from dasarpenilaian where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus kompetensi
	function delete_kompetensi($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from kompetensi where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus jeniskompetensi
	function delete_jeniskompetensi($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from jeniskompetensi where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus aspek_perkembangan
	function delete_aspek_perkembangan($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from aspek_perkembangan where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus aspek_psikologi
	function delete_aspek_psikologi($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from aspek_psikologi where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus aspek_psikologi_detail
	function delete_aspek_psikologi_detail($ref=''){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from aspek_psikologi_detail where replid='$ref'");
		$sql->execute();
		
		return $sql;
	}
	
	//----hapus assesmen_observasi
	function delete_assesmen_observasi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from assesmen_observasi_detail where ref='$ref' ");
		$sql->execute();
		
		$sql=$dbpdo->prepare("delete from assesmen_observasi where ref='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//----hapus anggota
	function delete_anggota($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->query("select foto from anggota where replid='$ref' ");
		$data=$sql->fetch(PDO::FETCH_OBJ);
		$file_foto = $data->foto;
		
		if($file_foto != '') {
			$uploaddir 		= 'app/file_foto_anggota/';
			unlink($uploaddir . $file_foto); //remove file 
		}
		
		
		//----delete anggota
		$sql=$dbpdo->prepare("delete from anggota where replid='$ref' ");
		$sql->execute();
			
		return $sql;
	}
	
	
	//----hapus evaluasi_psikologi
	function delete_evaluasi_psikologi($ref){
		
		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from evaluasi_psikologi_detail where ref='$ref' ");
		$sql->execute();
		
		$sql=$dbpdo->prepare("delete from evaluasi_psikologi where ref='$ref' ");
		$sql->execute();
		
		return $sql;
	}
	
	
	//---hapus presensi ukbm
	function delete_presensi_ukbm($ref)
	{

		$dbpdo = DB::create();
		
		$sql=$dbpdo->prepare("delete from presensi_ukbm where ref='$ref' ");
		$sql->execute();

		return $sql;
	}
	
}

?>
