<table border="0" style="border: 0px solid #ccc">
	<tr>
		<td>
			<select name="pilihan" id="pilihan" onclick="loadHTMLPost2('app/pinjam_ajax.php','pustaka_id','getpilihan','pilihan')" style="width:auto; height:27px; " />
				<?php select_lookup($pilihan); ?>
			</select>		
		</td>
	</tr>
	
	<tr style="font-weight: bold">
		<td colspan="2">Nomor Pustaka</td>
		<td>Tanggal Pinjam</td>
		<td>Tanggal Kembali</td>
		<td></td>		
	</tr>
	
	<tr style="font-weight: bold">		
		<td colspan="2">
			<table>
				<tr id="pustaka_id">
					<td><input type="text" name="kodepustaka" id="kodepustaka" onKeyPress="return focusNext('submitdetail',event)" onblur="loadHTMLPost2('app/pinjam_ajax.php','pustaka_id','getpustaka','kodepustaka')" style="width:120px; height:16px; " value="<?php echo $kodepustaka2 ?>"></td>
					<td><input type="text" readonly="" name="judul" id="judul" style="width:300px; height:16px; " value="<?php echo $judul ?>"></td>
				</tr>
			</table>
		</td>
		
		<td><input type="text" name="tglpinjam" class='datepick' id="tglpinjam" style="width:100px; height:16px; " value="<?php echo $tglpinjam ?>"></td>
		<td><input type="text" name="tglkembali" class='datepick' id="tglkembali" style="width:100px; height:16px; " value="<?php echo $tglkembali ?>"></td>
		<td><input type="submit" name="submit" id="submitdetail" class='btn btn-primary' value="Simpan Detail" /></td>		
	</tr>
	<tr>
		<td colspan="5">&nbsp;</td>
	</tr>
</table>

<?php
$sqldtl=$select->list_pinjam_detail_presave($iddetail);
$rows_detail = $sqldtl->rowCount();	

if($rows_detail > 0) {
?>

	<table border="0" style="border: 1px solid #ccc">	
		<tr style="font-weight: bold">
			<td>No</td>
			<td>No. Pustaka</td>
			<td>Judul</td>
			<td>Tanggal Kembali</td>
			<td>Hapus</td>		
		</tr>
		
		<?php 
			
				$i = 0;		
				while($pinjam_detail=$sqldtl->fetch(PDO::FETCH_OBJ)) {
				
				$j++;
		?>
		
				<input type="hidden" id="jmldata" name="jmldata" value="<?php echo $rows_detail ?>" >
				<input type="hidden" readonly="" style="width:150px; background-color: #fff"  name="replid_<?php echo $i ?>" id="replid_<?php echo $i ?>" value="<?php echo $pinjam_detail->replid ?>"/>
						
				<tr>
					<td align="center"><?php echo $j ?></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="kodepustaka_<?php echo $i ?>" id="kodepustaka_<?php echo $i ?>" value="<?php echo $pinjam_detail->kodepustaka ?>"/></td>
					<td><input type="text" readonly="" style="width:300px; background-color: #fff"  name="judul_<?php echo $i ?>" id="judul_<?php echo $i ?>" value="<?php echo $pinjam_detail->judul ?>"/></td>
					<td><input type="text" readonly="" style="width:150px; background-color: #fff"  name="tglkembali_<?php echo $i ?>" id="tglkembali_<?php echo $i ?>" value="<?php echo date("d-m-Y", strtotime($pinjam_detail->tglkembali)) ?>"/></td>
					<td>
						<a href="JavaScript:hapus('<?php echo $pinjam_detail->replid ?>','<?php echo $pinjam_detail->idanggota ?>')"><img src="img/icons/fugue/cross.png" ></a>
					</td>
				</tr>
			
					
		<?php 
					$i++;
				
				} 
			
		?>
				<tr>
					<td colspan="5">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">Jumlah yang akan dipinjam :</td>
					<td colspan="3"><?php echo $rows_detail ?></td>
				</tr>
	</table>

<?php

}

?>
