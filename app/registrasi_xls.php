<?php
session_start();

if (($_SESSION["logged"] == 0)) {
	echo 'Access denied';
	exit;
}

$namafile = "Daftar_Calon_Siswa.xls";

header("Content-Type: application/xls");
header("Content-Disposition: attachment;filename=".$namafile." ");

include("include/sambung.php");
//include("include/functions.php");
//include("include/function_excel.php");

include 'class/class.select.php';
include 'class/class.select.print.php';

$select = new select;
$select_print = new select_print;

#-------------FILTER
$tahunmasuk	= $_REQUEST['tahunmasuk'];
$idtingkat	= $_REQUEST['idtingkat'];
$tanggal	= $_REQUEST['tanggal'];
$idjurusan	= $_REQUEST['idjurusan'];
$nama		= $_REQUEST['nama'];
$all		= $_REQUEST['all'];

$filter = "";

if($tahunmasuk != "") {
	if($filter == "") {
		$filter = " Tahun Masuk : " . $tahunmasuk;
	} else {
		$filter = $filter . ", Tahun Masuk : " . $tahunmasuk;
	}
}

if($idtingkat != "") {
	if($filter == "") {
		$filter = " Tingkat : " . $idtingkat;
	} else {
		$filter = $filter . ", Tingkat : " . $idtingkat;
	}
}

if($tanggal != "") {
	$tanggal2 = date("d-m-Y", strtotime($tanggal));
	if($filter == "") {
		$filter = " Tanggal Pendaftaran : " . $tanggal2;
	} else {
		$filter = $filter . ", Tanggal Pendaftaran : " . $tanggal2;
	}
}

if($idjurusan != "") {
	if($filter == "") {
		$filter = " Program : " . $idjurusan;
	} else {
		$filter = $filter . ", Program : " . $idjurusan;
	}
}

if($nama != "") {
	if($filter == "") {
		$filter = " Nama : " . $nama;
	} else {
		$filter = $filter . ", Nama : " . $nama;
	}
}


if($all == 1) {
	$filter = "Semua Data";
}

$judul = "DAFTAR CALON SISWA";
echo '
<?xml version="1.0" encoding="iso-8859-1"?>
<?mso-application progid="Excel.Sheet"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:x="urn:schemas-microsoft-com:office:excel"
 xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
 xmlns:html="http://www.w3.org/TR/REC-html40">
 

 <Styles>
  <Style ss:ID="judul">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="filter">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Left" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="kanan">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
	<Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  <Style ss:ID="kepala">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#CFF4D2" ss:Pattern="Solid"/>
  </Style>
  <Style ss:ID="badan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
  </Style>  
  
  <Style ss:ID="badankanan">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Alignment ss:Horizontal="Right" ss:Vertical="Bottom"/>
  </Style>
  
  <Style ss:ID="badancenter">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
  </Style>
  
  <Style ss:ID="kepalasubdetail">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="1"/>
   <Interior ss:Color="#b7e207" ss:Pattern="Solid"/>
  </Style>
  
  <Style ss:ID="subdetail">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>
   </Borders>
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#000000"
    ss:Bold="0"/>
   <Interior ss:Color="#f8ef56" ss:Pattern="Solid"/>
  </Style>
  
  <Style ss:ID="subdetailcenter">
   <Borders>
    <Border ss:Position="Bottom" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Left" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Right" ss:LineStyle="Continuous" ss:Weight="1"/>
    <Border ss:Position="Top" ss:LineStyle="Continuous" ss:Weight="1"/>    
   </Borders>
   <Alignment ss:Horizontal="Center" ss:Vertical="Bottom"/>
   <Interior ss:Color="#f8ef56" ss:Pattern="Solid"/>
  </Style>
  
 </Styles>
 <Worksheet ss:Name="Data">

  <Table>
   <Column ss:Index="1" ss:Width="50"/>
   <Column ss:Index="2" ss:Width="150"/>
   <Column ss:Index="3" ss:Width="100"/>
   <Column ss:Index="4" ss:Width="100"/>
   <Column ss:Index="5" ss:Width="100"/>
   
   <Row>
    <Cell ss:MergeAcross="79" ss:StyleID="judul"><Data ss:Type="String">' . $judul . '</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>
   <Row>
    <Cell ss:MergeAcross="20" ss:StyleID="filter"><Data ss:Type="String">' . $filter . '</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';
	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No.</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Pendaftaran</Data></Cell>';	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Lengkap</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Panggilan</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jenis Kelamin</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NISN</Data></Cell>';
	//echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NOMOR SERI IJAZAH</Data></Cell>';				
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tahun</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NOMOR SERI SKHUN</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tahun</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No Ujian Nasional</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Induk Kependudukan (NIK)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tempat Lahir</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tanggal Lahir</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Agama</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Berkebutuhan Khusus</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Alamat Tempat Tinggal</Data></Cell>';
	//echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Dusun</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">RT</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">RW</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kelurahan/Desa</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kode Pos</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kecamatan</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kabupaten/Kota</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Provinsi</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Alat Transportasi ke Sekolah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">(Lainnya sebutkan)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jenis Tinggal</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Bersama Saudara (sebutkan hubungan keluarga)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No Telepon Rumah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No HP</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Email Pribadi</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Apakah Sebagai Penerima KPS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No KPS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No KIP</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No KKS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Cita-Cita</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Lainnya (sebutkan)</Data></Cell>';
		
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Ayah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tahun Lahir Ayah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Almarhum</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Alamat Lengkap Orang Tua</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kode Pos Ayah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. HP Ayah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Berkebutuhan Khusus (Ayah)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Penjelasan</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Pekerjaan Ayah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Lain-Lain (sebutkan)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Pendidikan Ayah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Penghasilan Ayah Bulanan</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Lainnya (sebutkan)</Data></Cell>';
	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Ibu</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tahun Lahir Ibu</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Almarhum</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Alamat Ibu</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Kode Pos Ibu</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. HP Ibu</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Berkebutuhan Khusus (Ibu)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Keterangan Berkebutuhan Khusus (Ibu)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Pekerjaan Ibu</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Lain-Lain (sebutkan) - Ibu</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Pendidikan Ibu</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Penghasilan Ibu Bulanan</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Lainnya (sebutkan)</Data></Cell>';
				
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Wali</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tahun Lahir Wali</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Pekerjaan Wali</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Lain-Lain (sebutkan)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Pendidikan Wali</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Penghasilan Wali</Data></Cell>';
	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tinggi Badan (cm)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Berat Badan (kg)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Golongan Darah</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama File (Gol. Darah)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jarak Tempat Tinggal ke Sekolah (meter)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">lebih dari 1 km, sebutkan (km)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Waktu Tempuh Berangkat ke Sekolah (menit)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">lebih dari 60 menit, sebutkan (menit)</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jumlah Saudara Kandung</Data></Cell>';
	
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tingkat</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Program</Data></Cell>';
	/*echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Mata Pelajaran Lintas minat 1</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Mata Pelajaran Lintas minat 2</Data></Cell>';*/
	
	echo '</Row>';
	
	$i = 0;
	$sql=$select_print->list_registrasi("", "", $tahunmasuk, $idtingkat, $tanggal, $idjurusan, $nama, $all);
	while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
		
		if($data->kelamin == 'L') { $kelamin = "Laki-laki"; }
		if($data->kelamin == 'P') { $kelamin = "Perempuan"; }
		
		if($data->tgllahir == '1970-01-01') {
			$tgllahir = "";
		} else {
			$tgllahir = date("d-m-Y", strtotime($data->tgllahir));
		}
		
		$kps = "";
		if($data->kps == 1) {
			$kps = "Ya";
		}
		
		$transport = array('A'=>"JALAN KAKI",'B'=>"SEPEDA",'C'=>"MOTOR",'D'=>"MOBIL PRIBADI",
				'E'=>"ANTAR JEMPUT SEKOLAH",'F'=>"ANGKUTAN UMUM",'G'=>"LAINNYA");
		$transportasi = $transport[$data->transportasi_kode];
		
		$idjenis_tinggalar = array('A'=>"Bersama Orang tua",'B'=>"Bersama Nenek/Kakek",'C'=>"Bersama Saudara",'D'=>"Kost");
		$idjenis_tinggal = $idjenis_tinggalar[$data->idjenis_tinggal];				
		
		$citacitaar = array('A'=>"PNS",'B'=>"TNI/POLRI",'C'=>"GURU/DOSEN",'D'=>"DOKTER",
				'E'=>"POLITIKUS",'F'=>"WIRASWASTA",'G'=>"SENI/LUKIS/ARTIS/SEJENISNYA",'H'=>"LAINNYA");
		$citacita = $citacitaar[$data->citacita];

		$idjurusanar = array('1'=>"IPA",'2'=>"IPS");
		$idjurusan2 = $idjurusanar[$data->idjurusan];
		
		$butuhkhususayah = "";
		if($data->butuhkhususayah == 1) {
			$butuhkhususayah = "Ya";
		}
							
		$sql2=$select_print->list_pekerjaan($data->pekerjaanayah);
		$row = $sql2->fetch(PDO::FETCH_OBJ);
		$pekerjaanayah = $row->pekerjaan;
		
		$sql2=$select_print->list_pendidikan($data->pendidikanayah);
		$row = $sql2->fetch(PDO::FETCH_OBJ);
		$pendidikanayah = $row->pendidikan;
		
		$penghasilanayah_kodear = array('1'=>"KURANG DARI Rp. 500 RIBU",'2'=>"Rp. 500 RIBU - Rp. 1 JUTA",'3'=>"Rp. 1 JUTA - Rp. 3 JUTA",'4'=>"Rp. 3 JUTA - Rp. 5 JUTA",'5'=>"LEBIH DARI Rp. 5 JUTA");
		$penghasilanayah_kode = $penghasilanayah_kodear[$data->penghasilanayah_kode];
		
		$almibu = "";
		if($data->almibu == 1) {
			$almibu = "Ya";
		}
		
		$butuhkhususibu = "";
		if($data->butuhkhususibu == 1 ) {
			$butuhkhususibu = "Ya";
		}
		
		$sql2=$select_print->list_pekerjaan($data->pekerjaanibu);
		$row = $sql2->fetch(PDO::FETCH_OBJ);
		$pekerjaanibu = $row->pekerjaan;
										
		$sql2=$select_print->list_pendidikan($data->pendidikanibu);
		$row = $sql2->fetch(PDO::FETCH_OBJ);
		$pendidikanibu = $row->pendidikan;
		
		$penghasilanibu_kodear = array('1'=>"KURANG DARI Rp. 500 RIBU",'2'=>"Rp. 500 RIBU - Rp. 1 JUTA",'3'=>"Rp. 1 JUTA - Rp. 3 JUTA",'4'=>"Rp. 3 JUTA - Rp. 5 JUTA",'5'=>"LEBIH DARI Rp. 5 JUTA");
		$penghasilanibu_kode = $penghasilanibu_kodear[$data->penghasilanibu_kode];
		
		$sql2=$select_print->list_pekerjaan($data->pekerjaanwali);
		$row = $sql2->fetch(PDO::FETCH_OBJ);
		$pekerjaanwali = $row->pekerjaan;
		
		$sql2=$select_print->list_pendidikan($data->pendidikanwali);
		$row = $sql2->fetch(PDO::FETCH_OBJ);
		$pendidikanwali = $row->pendidikan;
		
		
		$idminat = "";
		if($data->idjurusan == '1') {
			$sql2=$select_print->list_minatips($data->idminat);
			$row = $sql2->fetch(PDO::FETCH_OBJ);
			$idminat = $row->dcr;	
		}
		if($data->idjurusan == '2') {
			$sql2=$select_print->list_minatipa($data->idminat);
			$row = $sql2->fetch(PDO::FETCH_OBJ);
			$idminat = $row->dcr;	
		}
		
		$idminat1 = "";
		if($data->idjurusan == '1') {
			$sql2=$select_print->list_minatips($data->idminat1);
			$row = $sql2->fetch(PDO::FETCH_OBJ);
			$idminat1 = $row->dcr; 	
		}
		if($data->idjurusan == '2') {
			$sql2=$select_print->list_minatipa($data->idminat1);
			$row = $sql2->fetch(PDO::FETCH_OBJ);
			$idminat1 = $row->dcr;
		}
		
		$i++;
							
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$i."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nopendaftaran."</Data></Cell>";		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nama."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->panggilan."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$kelamin."</Data></Cell>";				
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nisn."</Data></Cell>";
		//echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nis."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->noijazah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tahunijazah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->skhun."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tahunskhun."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->noujian."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nik."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tmplahir."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$tgllahir."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->agama."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->kebutuhan_khusus."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->alamatsiswa."</Data></Cell>";
		//echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->dusun."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->rt."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->rw."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->kelurahan."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->kodepossiswa."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->kecamatan."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->kabupaten."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->provinsi."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$transportasi."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->transportasi."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$idjenis_tinggal."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->jenis_tinggal."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->telponsiswa."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->hpsiswa."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->emailsiswa."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$kps."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nokps."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nokip."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nokks."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$citacita."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->citacita_lain."</Data></Cell>";
				
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->namaayah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tahunayah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->almayah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->alamatortu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->kodeposortu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->hportu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$butuhkhususayah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->butuhkhususketayah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pekerjaanayah."</Data></Cell>";		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->pekerjaanayah_lain."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pendidikanayah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$penghasilanayah_kode."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->penghasilanayah."</Data></Cell>";
		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->namaibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tahunibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$almibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->alamatibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->kodeposibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->hpibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$butuhkhususibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->butuhkhususketibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pekerjaanibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->pekerjaanibu_lain."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pendidikanibu."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$penghasilanibu_kode."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->penghasilanibu."</Data></Cell>";
		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->wali."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tahunwali."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pekerjaanwali."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->pekerjaanwali_lain."</Data></Cell>";		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$pendidikanwali."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->penghasilanwali."</Data></Cell>";
		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tinggi."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->berat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->darah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->file_darah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->jaraksekolah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->jarak_km."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->waktutempuh."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->waktutempuh_menit."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->jsaudara."</Data></Cell>";
		
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tingkat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$idjurusan2."</Data></Cell>";
		/*echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$idminat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$idminat1."</Data></Cell>";*/
		
		
		echo "</Row>\n";
			
		
	}
	
	/*echo '
	<Row>
	<Cell ss:MergeAcross="4" ss:StyleID="kanan"><Data ss:Type="String">' . 'TOTAL :' . '</Data></Cell>			
	<Cell ss:StyleID="judul"><Data ss:Type="String">' . $alat . '</Data></Cell>
	<Cell ss:StyleID="kanan"><Data ss:Type="String">' . number_format($total, 0, ",", ",") . '</Data></Cell>
	</Row>';*/
echo '
  </Table>

 </Worksheet>';
 

//===============Prestasi=============sheet 2
 echo '
 <Worksheet ss:Name="CATATAN PRESTASI">

  <Table>
   <Column ss:Index="1" ss:Width="100"/>
   <Column ss:Index="2" ss:Width="100"/>
   <Column ss:Index="3" ss:Width="100"/>
   <Column ss:Index="4" ss:Width="100"/>
   <Column ss:Index="5" ss:Width="100"/>
   <Column ss:Index="6" ss:Width="100"/>
   
   <Row>
    <Cell ss:MergeAcross="13" ss:StyleID="judul"><Data ss:Type="String">Catatan Prestasi</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';
	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Pendaftaran</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tingkat</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Program</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Lengkap</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Panggilan</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jenis Kelamin</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NISN</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NOMOR SERI IJAZAH SMP</Data></Cell>';				
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tahun</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NOMOR SERI SKHUN</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tahun</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No Ujian Nasional SMP/MTs</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Induk Kependudukan (NIK)</Data></Cell>';
	echo '</Row>';
	
	$sql=$select_print->list_registrasi("", "", $tahunmasuk, $idtingkat, $tanggal, $idjurusan, $nama, $all);
	while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
		
		if($data->kelamin == 'L') { $kelamin = "Laki-laki"; }
		if($data->kelamin == 'P') { $kelamin = "Perempuan"; }
		
		$idjurusanar = array('1'=>"IPA",'2'=>"IPS");
		$idjurusan2 = $idjurusanar[$data->idjurusan];
		
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nopendaftaran."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tingkat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$idjurusan2."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nama."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->panggilan."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$kelamin."</Data></Cell>";				
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nisn."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nis."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->noijazah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tahunijazah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->skhun."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tahunskhun."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->noujian."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nik."</Data></Cell>";
		echo "</Row>\n";
		
			/*---------Prestasi----------*/
			$sql2=$select_print->list_registrasi_prestasi($data->replid);
			$rowscount = $sql2->rowCount();
			if($rowscount > 0) {
				echo '<Row>';
				echo '<Cell ss:StyleID="badan"><Data ss:Type="String"></Data></Cell>';
				echo '<Cell ss:StyleID="kepalasubdetail"><Data ss:Type="String">Jenis Prestasi</Data></Cell>';
				echo '<Cell ss:StyleID="kepalasubdetail"><Data ss:Type="String">Tingkat</Data></Cell>';
				echo '<Cell ss:StyleID="kepalasubdetail"><Data ss:Type="String">Nama Prestasi</Data></Cell>';
				echo '<Cell ss:StyleID="kepalasubdetail"><Data ss:Type="String">Tahun</Data></Cell>';	
				echo '<Cell ss:StyleID="kepalasubdetail"><Data ss:Type="String">Penyelenggara</Data></Cell>';
				echo '</Row>';
				
				while ($data2 = $sql2->fetch(PDO::FETCH_OBJ)) {
					
					echo "<Row>";
					echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\"></Data></Cell>";
					echo "<Cell ss:StyleID=\"subdetail\"><Data ss:Type=\"String\">".$data2->jenisprestasi."</Data></Cell>";
					echo "<Cell ss:StyleID=\"subdetail\"><Data ss:Type=\"String\">".$data2->tingkat."</Data></Cell>";
					echo "<Cell ss:StyleID=\"subdetail\"><Data ss:Type=\"String\">".$data2->nama."</Data></Cell>";
					echo "<Cell ss:StyleID=\"subdetail\"><Data ss:Type=\"String\">".$data2->tahun."</Data></Cell>";
					echo "<Cell ss:StyleID=\"subdetail\"><Data ss:Type=\"String\">".$data2->penyelenggara."</Data></Cell>";	
					echo "</Row>\n";
				
				}
			}
			
			
	}
	
 echo '
  </Table>
 </Worksheet>';
 
 
 //===============Beasiswa=============sheet 3
 echo '
 <Worksheet ss:Name="BEASISWA">

  <Table>
   <Column ss:Index="1" ss:Width="100"/>
   <Column ss:Index="2" ss:Width="100"/>
   <Column ss:Index="3" ss:Width="100"/>
   <Column ss:Index="4" ss:Width="100"/>
   <Column ss:Index="5" ss:Width="100"/>
   <Column ss:Index="6" ss:Width="100"/>
   
   <Row>
    <Cell ss:MergeAcross="13" ss:StyleID="judul"><Data ss:Type="String">Beasiswa</Data></Cell>
    <Cell ss:StyleID="judul"><Data ss:Type="String"></Data></Cell>
   </Row>';
	
	echo '<Row>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Pendaftaran</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tingkat</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Program</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Lengkap</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Nama Panggilan</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Jenis Kelamin</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NISN</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NIS</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NOMOR SERI IJAZAH SMP</Data></Cell>';				
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tahun</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">NOMOR SERI SKHUN</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">Tahun</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No Ujian Nasional SMP/MTs</Data></Cell>';
	echo '<Cell ss:StyleID="kepala"><Data ss:Type="String">No. Induk Kependudukan (NIK)</Data></Cell>';
	echo '</Row>';
	
	$sql=$select_print->list_registrasi("", "", $tahunmasuk, $idtingkat, $tanggal, $idjurusan, $nama, $all);
	while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
		
		if($data->kelamin == 'L') { $kelamin = "Laki-laki"; }
		if($data->kelamin == 'P') { $kelamin = "Perempuan"; }
		
		$idjurusanar = array('1'=>"IPA",'2'=>"IPS");
		$idjurusan2 = $idjurusanar[$data->idjurusan];
		
		echo "<Row>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nopendaftaran."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tingkat."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$idjurusan2."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nama."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->panggilan."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$kelamin."</Data></Cell>";				
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nisn."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nis."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->noijazah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tahunijazah."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->skhun."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->tahunskhun."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->noujian."</Data></Cell>";
		echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\">".$data->nik."</Data></Cell>";
		echo "</Row>\n";
		
			/*---------Beasiswa----------*/
			$sql2=$select_print->list_registrasi_beasiswa($data->replid);
			$rowscount = $sql2->rowCount();
			if($rowscount > 0) {
				echo '<Row>';
				echo '<Cell ss:StyleID="badan"><Data ss:Type="String"></Data></Cell>';
				echo '<Cell ss:StyleID="kepalasubdetail"><Data ss:Type="String">Jenis Beasiswa</Data></Cell>';
				echo '<Cell ss:StyleID="kepalasubdetail"><Data ss:Type="String">Penyelenggara/Sumber</Data></Cell>';
				echo '<Cell ss:StyleID="kepalasubdetail"><Data ss:Type="String">Tahun Mulai</Data></Cell>';
				echo '<Cell ss:StyleID="kepalasubdetail"><Data ss:Type="String">Tahun Selesai</Data></Cell>';
				echo '</Row>';
				
				while ($data2 = $sql2->fetch(PDO::FETCH_OBJ)) {
					
					echo "<Row>";
					echo "<Cell ss:StyleID=\"badan\"><Data ss:Type=\"String\"></Data></Cell>";
					echo "<Cell ss:StyleID=\"subdetail\"><Data ss:Type=\"String\">".$data2->jenis."</Data></Cell>";
					echo "<Cell ss:StyleID=\"subdetail\"><Data ss:Type=\"String\">".$data2->penyelenggara."</Data></Cell>";
					echo "<Cell ss:StyleID=\"subdetail\"><Data ss:Type=\"String\">".$data2->tahunmulai."</Data></Cell>";
					echo "<Cell ss:StyleID=\"subdetail\"><Data ss:Type=\"String\">".$data2->tahunselesai."</Data></Cell>";	
					echo "</Row>\n";
				
				}
			}
			
			
	}
	
 echo '
  </Table>
 </Worksheet>';
 
 
echo '	
</Workbook>';
?>

