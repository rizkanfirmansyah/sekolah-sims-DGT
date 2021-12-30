<html>
<head>
</head>
<body background="../../images/Page-BgTexture.jpg" >
<font face="Verdana, Arial, Helvetica, sans-serif" size="+1">
<h1 align="center">Import Data</h1>

<form method="post" enctype="multipart/form-data" action="proses_siswa.php">
Import data Siswa: <input name="userfile" type="file">
<input name="upload" type="submit" value="Import">
</form>

<!--
<form method="post" enctype="multipart/form-data" action="proses_keuangan__.php">
Import data Get NIK: <input name="userfile" type="file">
<input name="upload" type="submit" value="Import">
</form>-->

<!--<form method="post" enctype="multipart/form-data" action="proses_update_siswa.php">
Update Data Siswa: <input name="userfile" type="file">
<input name="upload" type="submit" value="Import">
</form>-->

<form method="post" name="keuangan" id="keuangan" action="proses_keuangan.php" enctype="multipart/form-data" >
Import data Pembayaran: <input name="userfile" type="file">
<input name="upload" type="submit" value="Import">
</form>

<form method="post" enctype="multipart/form-data" action="proses_lunas.php">
LUNAS: <input name="userfile" type="file">
<input name="upload" type="submit" value="Import">
</form>

<form method="post" enctype="multipart/form-data" action="proses_siswa_virtual_account.php">
Update Data Siswa Virtual Account: <input name="userfile" type="file">
<input name="upload" type="submit" value="Import">
</form>

</font>

</body>
</html>