<?php
 	//include("../koneksi.php");
	
	$dtefrom = $_GET["dtefrom"];
	$dteto = $_GET["dteto"];
	$nik = $_GET["nik"];
	$labid = $_GET["labid"];
	$penera = $_GET["penera"];
	
	$dtefrom = date('Y-m', strtotime($dtefrom));	
	$dteto = date('Y-m', strtotime($dteto));
	
	//--------set bulan
	$dtefrom2 = date('Y-m', strtotime($dtefrom));	
	$dteto2 = date('Y-m', strtotime($dteto));
	
	if ($dtefrom2 == $dteto2) {
		$bulan = date('m-Y', strtotime($dtefrom2));
	} else {
		$bulan = date('m-Y', strtotime($dtefrom2)) . " s/d " . date('m-Y', strtotime($dteto));
	}
	
	//-------------Dinas Luar---------\/
	$sql_master = odbc_exec(condb,"select distinct c.NIP, c.NamaKaryawan, d.SubDitNme, c.Jabatan, c.Pangkat, c.Golongan
				from Karyawan c left join KaryawanSubDit d on c.SubDitCde=d.SubDitCde where c.NIP='$nik' ");
	$data_master = odbc_fetch_array($sql_master);
	
	//--------detail			
	if ($penera==1) { $where = " and a.Finish1_nip='$nik' "; }
	if ($penera==2) { $where = " and a.Finish2_nip='$nik' "; }
	if ($penera==3) { $where = " and a.Finish3_nip='$nik' "; }
	
	$sql = odbc_exec(condb,"select b.slipno, b.date, b.tglselesai, e.clientname, c.barang + ' (' + c.identifikasi + ') ' nama_barang,
				d.namabarang + ' (' + a.identifikasi + ') ' objek_kalibrasi, a.kategori
				from SubOrderDetail a
				left join [Order] b on case when isnull(a.verifikasi,0)=0 then left(a.Identifikasi,11)
				when isnull(a.verifikasi,0)=1 then left(a.Identifikasi,12) end=b.SlipNo
					and a.periodid=b.periodid and isnull(a.verifikasi,0)=isnull(b.verifikasi,0)
				left join SubOrder c on a.PeriodId=c.PeriodId and a.SubOrderId=c.SubOrderId and a.OrderId=c.OrderId
					and isnull(a.verifikasi,0)=isnull(c.verifikasi,0)
				left join barang_range d on a.idbarang=d.ref
				left join client e on b.clientid=e.clientid
				Where convert(varchar(7),b.Date,20) >= '$dtefrom' 
					and convert(varchar(7),b.Date,20) <= '$dteto' 
					". $where . "
					order by b.SlipNo Desc");			

?>	

<div class="container-fluid">
		<div class="content">
			<div class="row-fluid">
				<div class="span12">
					
					<div class="box" style="width: auto; height: 700px; border: 1px solid #000">
					
					
	<div align="right" style="margin-top:-10px; margin-right:50px;">
		<!--<a href="#" style="text-decoration:none;" onclick="history.go(-1)"><img src="../images/prev.png" border="0" /></a>-->
		&nbsp;&nbsp;&nbsp;
	
	</div>
	<table style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px;">		
		<tr>
			<td>NIP</td>
			<td>:</td>
			<td><?php echo $data_master['NIP'] ?></td>
		</tr>
		<tr>
			<td>Nama Pegawai</td>
			<td>:</td>
			<td><?php echo $data_master['NamaKaryawan'] ?></td>
		</tr>
		<tr>
			<td>Pangkat/Gol Ruang</td>
			<td>:</td>
			<td><?php echo $data_master['Pangkat']; ?> / <?php echo $data_master['Golongan'];  ?></td>
		</tr>
		<tr>
			<td>Subdit/Jabatan</td>
			<td>:</td>
			<td><?php echo $data_master['SubDitNme'].' / '. $data_master['Jabatan']; ?></td>
		</tr>
		<tr>
			<td>Periode</td>
			<td>:</td>
			<td><?php echo $bulan ?></td>
		</tr>
	</table>
		<br />
		<font face="Verdana, Arial, Helvetica, sans-serif" size="+1">Kinerja Detail</font>
		<table align="center" border="1" cellspacing="0" bordercolor="#0000cf">
			<tr bgcolor="#000033" style="color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px;">
				<td align="center" width="4%">No.</td>
				<td align="center" width="10%">No. Order</td>
				<td align="center" width="13%">Tgl Order</td>
				<td align="center" width="10%">Tgl Selesai</td>
				<td align="center" width="20%">Pelanggan</td>
				<td align="center" width="10%">Nama Alat</td>
				<td align="center" width="10%">Objek Kalibrasi</td>
				<td align="center" width="20%">Kategori</td>
			</tr>
		<?php
				while ($data = odbc_fetch_array($sql)){
				$i++;
				
				$dtefrom = date('d-m-Y', strtotime($data['FrmDte']));	
				$dteto = date('d-m-Y', strtotime($data['ToDte']));
				
		?>	
			<tr bgcolor="#ffffff" style="color:#000033; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
				<td valign="top"><?php echo $i."."; ?></td>
				<td valign="top"><?php echo $data['slipno'] ?></td>
				<td valign="top"><?php echo $data['date'] ?></td>
				<td valign="top"><?php echo $data['tglselesai'] ?></td>
				<td valign="top"><?php echo $data['clientname'] ?></td>
				<td valign="top"><?php echo $data['nama_barang'] ?></td>
				<td valign="top"><?php echo $data['objek_kalibrasi'] ?></td>
				<td valign="top"><?php echo $data['kategori'] ?></td>
			</tr>
		<?php
			}
		?>
	</table>

				</div>
			</div>
		</div>
	</div>	
</div>