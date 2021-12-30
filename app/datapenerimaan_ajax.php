<?php
include_once ("../app/include/queryfunctions.php");
include_once ("../app/include/functions.php");

$dbpdo = DB::create();

$pilih = $_POST["button"];

switch ($pilih){
	case "cekdepartemen":
		$id			= $_POST["id"];
		$departemen	= $_POST["departemen"];
		$idkategori	= $_POST["idkategori"];
		$nama		= $_POST["nama"];	
		
		$sqlstr = "select nama from datapenerimaan where replid<>'$id' and idkategori='$idkategori' and departemen='$departemen' and nama='$nama' limit 1";
		//echo $sqlstr;
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$n_nama = $data->nama;
			
		
		if($n_nama != '') {
?>		
			<select name="departemen" id="departemen" style="width:auto; height:27px; " onchange="loadHTMLPost3('app/datapenerimaan_ajax.php','departemen_id','cekdepartemen', 'id', 'departemen','idkategori', 'nama')" >
				<option value=""></option>
				<?php select_departemen(""); ?>
			</select>
			<font color="#FF0000" size="-1">Data sudah ada !</font>	
<?php	
		} else {
?>
			<select name="departemen" id="departemen" style="width:auto; height:27px; " onchange="loadHTMLPost3('app/datapenerimaan_ajax.php','departemen_id','cekdepartemen', 'id', 'departemen','idkategori', 'nama')" >
				<option value=""></option>
				<?php select_departemen($departemen); ?>
			</select>
<?php
		}
		
		break;	
		
	
	case "cekidkategori":
		$id			= $_POST["id"];
		$departemen	= $_POST["departemen"];
		$idkategori	= $_POST["idkategori"];
		$nama		= $_POST["nama"];	
		
		$dbpdo = DB::create();
		
		$sqlstr = "select nama from datapenerimaan where replid<>'$id' and idkategori='$idkategori' and departemen='$departemen' and nama='$nama' limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$n_nama = $data->nama;
			
		
		if($n_nama != '') {
?>		
			<select name="idkategori" id="idkategori" style="width:auto; height:27px; " onchange="loadHTMLPost3('app/datapenerimaan_ajax.php','idkategori_id','cekidkategori', 'id', 'departemen','idkategori', 'nama')" >
				<option value=""></option>
				<?php select_kategoripenerimaan(""); ?>
			</select>
			<font color="#FF0000" size="-1">Data sudah ada !</font>	
<?php	
		} else {
?>
			<select name="idkategori" id="idkategori" style="width:auto; height:27px; " onchange="loadHTMLPost3('app/datapenerimaan_ajax.php','idkategori_id','cekidkategori', 'id', 'departemen','idkategori', 'nama')" >
				<option value=""></option>
				<?php select_kategoripenerimaan($idkategori); ?>
			</select>
<?php
		}
		
		break;
		
	
	case "ceknama":
		$id			= $_POST["id"];
		$departemen	= $_POST["departemen"];
		$idkategori	= $_POST["idkategori"];
		$nama		= $_POST["nama"];	
		
		$dbpdo = DB::create();
		
		$sqlstr = "select nama from datapenerimaan where replid<>'$id' and idkategori='$idkategori' and departemen='$departemen' and nama='$nama' limit 1";
		$sql=$dbpdo->prepare($sqlstr);
		$sql->execute();
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$n_nama = $data->nama;
			
		
		if($n_nama != '') {
?>		
			<input type="text" name="nama" id="nama" style="width:250px; height:16px; " value="" onblur="loadHTMLPost3('app/datapenerimaan_ajax.php','nama_id','ceknama', 'id', 'departemen','idkategori', 'nama')" >
			<font color="#FF0000" size="-1">Data sudah ada !</font>	
<?php	
		} else {
?>
			<input type="text" name="nama" id="nama" style="width:250px; height:16px; " value="<?php echo $nama ?>" onblur="loadHTMLPost3('app/datapenerimaan_ajax.php','nama_id','ceknama', 'id', 'departemen','idkategori', 'nama')" >
<?php
		}
		
		break;
			
		
	
	default:
}
?>