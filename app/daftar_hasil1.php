<!---------tambah nilai----------->
<table border="1" align="left" cellspacing="0" cellpadding="5" style="border: 1px solid #ccc" >
	
	<tr style="font-weight: bold; text-align: left;">
		<td>Unit</td>
		<td colspan="1">&nbsp;<?php echo $departemen ?></td>
		
		<td colspan="2">Tahun Ajaran</td>
		<td colspan="23">&nbsp;<?php echo $tahunajaran ?></td>
	</tr>
	
	<tr style="font-weight: bold; text-align: left;">
		<td>Mata Pelajaran</td>
		<td colspan="1">&nbsp;<?php echo $pelajaran ?></td>
		
		<td colspan="2">Kompetensi</td>
		<td colspan="23">&nbsp;<?php echo $kompetensi ?></td>
	</tr>
	
	<tr style="font-weight: bold; text-align: left;">
		<td>Kelas</td>
		<td colspan="1">&nbsp;<?php echo $kelas ?></td>
		
		<td colspan="2">Aspek Penilaian</td>
		<td colspan="23">&nbsp;<?php echo $aspekpenilaian1 ?></td>
	</tr>
	
	<tr style="font-weight: bold; text-align: center;">
		<td rowspan="2">NIS</td>
		<td rowspan="2">Nama</td>
		<td colspan="12"><?php echo $jeniskompetensi ?></td>
		<td>&nbsp;</td>
		<td colspan="12"><?php echo $jeniskompetensi1 ?></td>
	</tr>
	
	<tr style="font-weight: bold; text-align: center;">
		<td>N1</td>
		<td>N2</td>
		<td>N3</td>
		<td>N4</td>
		<td>UTS</td>
		<td>Jumlah</td>
		<td>Rata-rata</td>
		<td>x 75%</td>
		<td>UAS</td>
		<td>x 25%</td>
		<td>NA</td>
		<td>A</td>
		<td>&nbsp;</td>
		<td>T.1</td>
		<td>T.2</td>
		<td>T.3</td>
		<td>T.4</td>
		<td>UTS</td>
		<td>Jumlah</td>
		<td>Rata-rata</td>
		<td>x 75%</td>
		<td>UAS</td>
		<td>x 25%</td>
		<td>NA</td>
		<td>E</td>
	</tr>
	
	<?php
		$i = 0;
		$sql=$select_view->list_siswa($nis, '', $idtingkat, $idkelas, $nama, $all);			
		while ($siswa_view=$sql->fetch(PDO::FETCH_OBJ)) {
			
			$nis		=	$siswa_view->nis;
			
			$idjeniskompetensi 	= 1;			
			$iddasarpenilaian 	= 4;
			$strget = $select_view->list_daftarnilai($departemen, $idtingkat, $idkelas, $idtahunajaran, $idsemester, $nis, $idkompetensi, $idjeniskompetensi, $iddasarpenilaian, $idpelajaran);
			$siswa_get=$strget->fetch(PDO::FETCH_OBJ);
	?>
		
		<input type="hidden" name="nis<?php echo $i ?>" id="nis<?php echo $i ?>" value="<?php echo $siswa_view->nis ?>" >
		
		<tr align="center">
			<td><?php echo $siswa_view->nis ?></td>
			
			<td><?php echo $siswa_view->nama ?></td>
			
			<td><?php echo $siswa_get->n1 ?></td>
			
			<td><?php echo $siswa_get->n2 ?></td>
			
			<td><?php echo $siswa_get->n3 ?></td>
			
			<td><?php echo $siswa_get->n4 ?></td>
			
			<td><?php echo $siswa_get->uts ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;" ><?php echo $siswa_get->jumlah ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;" ><?php echo $siswa_get->rata ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;"><?php echo $siswa_get->persen ?></td>
			
			<td><?php echo $siswa_get->uas ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;" ><?php echo $siswa_get->persen1 ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;" ><?php echo $siswa_get->na ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;" ><?php echo $siswa_get->a ?></td>
			
			<td>&nbsp;</td>
			
			<?php
				$idjeniskompetensi = 2;
				
				$strget = $select_view->list_daftarnilai($departemen, $idtingkat, $idkelas, $idtahunajaran, $idsemester, $nis, $idkompetensi, $idjeniskompetensi, $iddasarpenilaian, $idpelajaran);
				$siswa_get_1=$strget->fetch(PDO::FETCH_OBJ);
			?>
			<td><?php echo $siswa_get_1->n1 ?></td>
			
			<td><?php echo $siswa_get_1->n2 ?></td>
			
			<td><?php echo $siswa_get_1->n3 ?></td>
			
			<td><?php echo $siswa_get_1->n4 ?></td>
			
			<td><?php echo $siswa_get_1->uts ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;" ><?php echo $siswa_get_1->jumlah ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;" ><?php echo $siswa_get_1->rata ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;" ><?php echo $siswa_get_1->persen ?></td>
			
			<td><?php echo $siswa_get_1->uas ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;" ><?php echo $siswa_get_1->persen1 ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;" ><?php echo $siswa_get_1->na ?></td>
			
			<td style="background-color: #bbfaab; text-align: center;" ><?php echo $siswa_get_1->a ?></td>
			
		</tr>
	<?php
			$i++;
		}
	?>
		
		<input type="hidden" name="jmldata" id="jmldata" value="<?php echo $i ?>" >
		
	<tr>
		<td colspan="29">
			&nbsp;&nbsp;<input type="button" name="tutup" id="tutup" class="but" value="Tutup" onclick="window.close()" />
			
		</td>
		
	</tr>
</table>
<!--------------end ----------->