<?php
//header('Content-type: application/json');

include_once ("../app/include/sambung.php");


if(isset($_POST['txtUsername'])) {
    
    $username = $_POST['txtUsername'];

    $dbpdo = DB::create();
    $sqlstr = "select pinortu from siswa where pinortu='$username'";
    $sql=$dbpdo->prepare($sqlstr);
    $sql->execute();
    $rows = $sql->rowCount();

    if($rows > 0) {
        if(isset($_POST['mobile']) && $_POST['mobile'] == "android" ){
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
    <head><title>Login</title></head>
      
    <body>
        <form action="<?php $_PHP_SELF; ?>" method="POST">
            User Name : <input type="text" name="txtUsername" id="txtUsername" value=""/><br>
            Password : <input type="password" name="txtPassword" id="txtPassword" value=""/>
            <input type="submit" name="btnSubmit" value="Login"/>
        </form>
    </body>
</html>