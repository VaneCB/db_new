<?php
require  "conexion.php";
$carga=fn($clase)=>require("$clase.php");
spl_autoload_register($carga);

session_start();

if (isset($_POST['submit'])){
    $db = new DB();
    $user = $_POST['name'];
    $pass = $_POST['pass'];
    if ($db->valida_usuario($user,$pass)){
        $_SESSION['user']=$user;
        header("location:sitio.php");
        exit;
    }else {
        $msj="Datos incorrectos";
    }
}
/*try {
    $con = new mysqli ("127.0.0.1" ,USER,PASS, "dwes", 23313);
} catch (mysqli_sql_exception $exception){
    die ("No se ha podido conectar" .$exception->getMessage());
}*/

try {
    $con = new PDO (DSN,USER,PASS);
} catch (PDOException $exception){
    die ("No se ha podido conectar" .$exception->getMessage());
}
var_dump($con);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<fieldset>
    <legend>Acceder</legend>
    <span style="color=red"><?=$msj ?? ""?></span>
    <form action="index.php" method="post">
        <label for ="name">Datos de acceso</label>
        <input type="text" name="name" id="name"><br>
        <label for ="pass">Contraseña</label><br>
        <input type="text" name="pass" id="pass">
        <button type="submit" name="submit">Enviar</button>
    </form>
</fieldset>
</body>
</html>
