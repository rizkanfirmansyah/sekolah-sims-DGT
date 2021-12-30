<?php
 	//include("../koneksi.php");
	
	$dtefrom = $_GET["dtefrom"];
	$dteto = $_GET["dteto"];
	$nik = $_GET["nik"];
	$labid = $_GET["labid"];
	$dk = $_GET["dk"];
	$dl = $_GET["dl"];
	
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
	/*$sql_master = odbc_exec(condb,"select distinct a.EpyCde, c.NamaKaryawan, d.SubDitNme, c.Jabatan, c.Pangkat, c.Golongan
				from OutBldNIK a 
				left join OutBld b on a.OutBldCde=b.OutBldCde 
				left join Karyawan c on a.EpyCde=c.NIP
				left join KaryawanSubDit d on c.SubDitCde=d.SubDitCde
				where a.EpyCde='$nik' ");*/
	$sql_master = odbc_exec(condb,"select distinct c.NIP, c.NamaKaryawan, d.SubDitNme, c.Jabatan, c.Pangkat, c.Golongan
				from Karyawan c left join KaryawanSubDit d on c.SubDitCde=d.SubDitCde where c.NIP='$nik' ");
	$data_master = odbc_fetch_array($sql_master);
	
	if ($dl == 1) {	
		//--------detail				
		$sql = odbc_exec(condb,"select b.DLNo, b.SPTNo, b.Dte, b.FrmDte, b.ToDte, b.JobDcr, b.ForTo, d.ClientName, d.Kota, b.Ktg,
					a.EpyCde, c.NamaKaryawan 
					from OutBldNIK a 
					left join OutBld b on a.OutBldCde=b.OutBldCde 
					left join Karyawan c on a.EpyCde=c.NIP
					left join Client d on b.ClnCde=d.ClientID
					where isnull(b.Btl,0)=0 and a.EpyCde='$nik' 
					and convert(varchar(7),b.frmdte,20) >= '$dtefrom' 
					and convert(varchar(7),b.frmdte,20) <= '$dteto' order by b.FrmDte desc");
	}
?>	

<div class="container-fluid">
		<div class="content">
			<div class="row-fluid">
				<div class="span12">
					
					<div class="box" style="width: auto; height: 700px; border: 1px solid #000">
				
				
				
	<div align="right" style="margin-top:-10px; margin-right:50px;">
		<!--<a href="#" style="text-decoration:none;" onclick="history.go(-1)"><img src="../images/prev.png" border="0" /></a>	-->
			&nbsp;&nbsp;&nbsp;
		</div>
	<table style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px;">		
		<tr>
			<td>NIP</td>
			<td>:</td>
			<td>
				<?php echo $data_master['NIP'] ?>				
			</td>
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
		<?php 
			if ($dl == 1) {
		?>
		<br />
		<font face="Verdana, Arial, Helvetica, sans-serif" size="+1">Kinerja Dinas Luar</font>
		
		<table align="center" border="1" cellspacing="0" bordercolor="#0000cf">
			<tr bgcolor="#000033" style="color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px;">
				<td align="center" width="4%">No.</td>
				<td align="center" width="10%">NO DL</td>
				<td align="center" width="13%">Nomor</td>
				<td align="center" width="20%">Pelanggan</td>
				<td align="center" width="10%">Kota</td>
				<td align="center" width="10%">Tgl Berangkat</td>
				<td align="center" width="10%">Tgl Kembali</td>
				<td align="center" width="30%">Dasar Penugasan</td>
				<td align="center" width="30%">Keperluan</td>
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
					<td valign="top"><?php echo $data['DLNo'] ?></td>
					<td valign="top"><?php echo $data['SPTNo'] ?></td>
					<td valign="top"><?php echo $data['ClientName'] ?></td>
					<td valign="top"><?php echo $data['Kota'] ?></td>
					<td valign="top"><?php echo $dtefrom ?></td>
					<td valign="top"><?php echo $dteto ?></td>
					<td valign="top"><?php echo $data['JobDcr'] ?></td>
					<td valign="top"><?php echo $data['ForTo'] ?></td>
					<td valign="top"><?php echo $data['Ktg'] ?></td>
				</tr>
		<?php
				} 
		?>
	</table>
<?php
	}
?>


<?php
	//-------------Dalam Kantor---------\/		
	if ($dk == 1) {
		$dtefrom = date('Y-m', strtotime($_GET["dtefrom"]));	
		$dteto = date('Y-m', strtotime($_GET["dteto"]));
	
		$sqldk1 =odbc_exec(condb,"select count(a.finish1_nip) finish1, convert(varchar(7),b.Date,20) periode
			from SubOrderDetail a
			left join [Order] b on case when isnull(a.verifikasi,0)=0 then left(a.Identifikasi,11)
			when isnull(a.verifikasi,0)=1 then left(a.Identifikasi,12) end=b.SlipNo
				and a.periodid=b.periodid
			Where convert(varchar(7),b.Date,20) >= '$dtefrom' 
				and convert(varchar(7),b.Date,20) <= '$dteto' 
				and a.Finish1_nip='$nik'
				group by convert(varchar(7),b.Date,20) order by convert(varchar(7),b.Date,20) ");		
		//-----------------------------
				
		$sqldk2 =odbc_exec(condb,"select count(a.finish2_nip) finish2, convert(varchar(7),b.Date,20) periode
			from SubOrderDetail a
			left join [Order] b on case when isnull(a.verifikasi,0)=0 then left(a.Identifikasi,11)
			when isnull(a.verifikasi,0)=1 then left(a.Identifikasi,12) end=b.SlipNo
				and a.periodid=b.periodid
			Where convert(varchar(7),b.Date,20) >= '$dtefrom' 
				and convert(varchar(7),b.Date,20) <= '$dteto' 
				and a.Finish2_nip='$nik'
				group by convert(varchar(7),b.Date,20) order by convert(varchar(7),b.Date,20) ");
		//-----------------------------
		
		$sqldk3 =odbc_exec(condb,"select count(a.finish3_nip) finish3, convert(varchar(7),b.Date,20) periode
			from SubOrderDetail a
			left join [Order] b on case when isnull(a.verifikasi,0)=0 then left(a.Identifikasi,11)
			when isnull(a.verifikasi,0)=1 then left(a.Identifikasi,12) end=b.SlipNo
				and a.periodid=b.periodid
			Where convert(varchar(7),b.Date,20) >= '$dtefrom' 
				and convert(varchar(7),b.Date,20) <= '$dteto' 
				and a.Finish3_nip='$nik'
				group by convert(varchar(7),b.Date,20) order by convert(varchar(7),b.Date,20) ");		
	
?>	
	<br /><br />	
	<font face="Verdana, Arial, Helvetica, sans-serif" size="+1">Kinerja Dalam Kantor</font>
	<br><br>
	<table width="30%" align="left" border="1" cellspacing="0" bordercolor="#0000cf">
		<tr bgcolor="#000033" style="color:#FFFFFF; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px;">
			<td align="center" width="4%">No.</td>
			<td align="center" width="10%">Periode</td>
			<td align="center" width="13%">Jumlah Kinerja</td>
		</tr>
		
		<tr>
			<td colspan="3">
				<font face="Verdana, Arial, Helvetica, sans-serif" size="+1"><i>Penera-1</i></font>
			</td>
		</tr>
		<?php
			$i 		= 0;
			$total 	= 0;
			while ($data1 = odbc_fetch_array($sqldk1)) {
			$i++;
			
			$dtefrom = date('Y-m', strtotime($data1['periode']));	
			$dteto = date('Y-m', strtotime($data1['periode']));
			
		?>
		<tr>
			<td valign="top"><?php echo $i."."; ?></td>
			<td valign="top"><?php echo $data1['periode'] ?></td>
			<td valign="top" align="center">
				<!--<?php echo '<a href="kinerjadkgrafik_detail.php?dtefrom='.$dtefrom.'&dteto='.$dteto.'&nik='.$nik.'&penera=1 ">'; ?><?php echo $data1['finish1'] ?></a>-->
				
				<?php echo '<a href="main.php?menu=app&act=kinerjadkgrafik_detail&dtefrom='.$dtefrom.'&dteto='.$dteto.'&nik='.$nik.'&penera=1 ">'; ?><?php echo $data1['finish1'] ?></a>
				
				</td>
		</tr>
		<?php 
			$total = $total + $data1['finish1'];
			}
		?>
		
		<tr>
			<td colspan="3">
				<font face="Verdana, Arial, Helvetica, sans-serif" size="+1"><i>Penera-2</i></font>
			</td>
		</tr>
		<?php
			while ($data2 = odbc_fetch_array($sqldk2)) {
			$i++;
			
			$dtefrom = date('Y-m', strtotime($data2['periode']));	
			$dteto = date('Y-m', strtotime($data2['periode']));
		?>
		<tr>
			<td valign="top"><?php echo $i."."; ?></td>
			<td valign="top"><?php echo $data2['periode'] ?></td>
			<td valign="top" align="center">
				<!--<?php echo '<a href="kinerjadkgrafik_detail.php?dtefrom='.$dtefrom.'&dteto='.$dteto.'&nik='.$nik.'&penera=2 ">'; ?><?php echo $data2['finish2'] ?></a>-->
				
				<?php echo '<a href="main.php?menu=app&act=kinerjadkgrafik_detail&dtefrom='.$dtefrom.'&dteto='.$dteto.'&nik='.$nik.'&penera=2 ">'; ?><?php echo $data2['finish2'] ?></a>
				
				</td>
		</tr>
		<?php 
			$total = $total + $data2['finish2'];
			}
		?>
		
		<tr>
			<td colspan="3">
				<font face="Verdana, Arial, Helvetica, sans-serif" size="+1"><i>Penera-3</i></font>
			</td>
		</tr>
		<?php
			while ($data3 = odbc_fetch_array($sqldk3)) {
			$i++;
			
			$dtefrom = date('Y-m', strtotime($data3['periode']));	
			$dteto = date('Y-m', strtotime($data3['periode']));
		?>
		<tr>
			<td valign="top"><?php echo $i."."; ?></td>
			<td valign="top"><?php echo $data3['periode'] ?></td>
			<td valign="top" align="center">
				<!--<?php echo '<a href="kinerjadkgrafik_detail.php?dtefrom='.$dtefrom.'&dteto='.$dteto.'&nik='.$nik.'&penera=3 ">'; ?><?php echo $data3['finish3'] ?></a>-->
				
				<?php echo '<a href="main.php?menu=app&act=kinerjadkgrafik_detail&dtefrom='.$dtefrom.'&dteto='.$dteto.'&nik='.$nik.'&penera=3 ">'; ?><?php echo $data3['finish3'] ?></a>
				
				</td>
		</tr>
		<?php 
			$total = $total + $data3['finish3'];
			}
		?>
		
		<tr>
			<td align="right" colspan="2">Total&nbsp;</td>
			<td align="center"><?php echo $total; ?></td>
		</tr>
	</table>
	
<?php
	}
?>
				</div>
			
			</div>
		</div>
	</div>	
</div>