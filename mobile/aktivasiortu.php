<?php
//header('Content-type: application/json');

include_once ("../app/include/sambung.php");


function random($number) 
{
	if ($number)
	{
    	for($i=1;$i<=$number;$i++)
		{
       		$nr=rand(0,9);
       		$total=$total.$nr;
       	}
    	return $total;
	}
}

if(isset($_POST['txtUsername'])) {
    
    $username = $_POST['txtUsername'];

    $dbpdo = DB::create();
    $sqlstr = "select replid, hportu from siswa where hportu='$username' limit 1";
    $sql=$dbpdo->prepare($sqlstr);
    $sql->execute();
    $rows = $sql->rowCount();
    $datasiswa = $sql->fetch(PDO::FETCH_OBJ);

    if($rows > 0) {
        if(isset($_POST['mobile']) && $_POST['mobile'] == "android" ){
        
            ##update no pin ortu
            $pin        =    "123"; //random(9);
            $id         =    $datasiswa->replid;
            $sqlupd     =    "update siswa set pinortu='$pin' where replid='$id' ";
            $sql        =    $dbpdo->prepare($sqlupd);
            $sql->execute(); 
            //----------------/\
            
            echo "Sukses";
            exit;
        }
        echo "Login Sukses";
    } else {
        echo "Gagal";
    }

}

?>

<html>
    <head><title>Aktivasi</title></head>
      
    <body>
        <form action="<?php $_PHP_SELF; ?>" method="POST">
            NO HP ORTU : <input type="text" name="txtUsername" id="txtUsername" value=""/><br>
            <input type="submit" name="btnSubmit" value="Login"/>
        </form>
    </body>
</html>