<?php
require  "conexion.php";

ini_set('display_errors',true);
error_reporting(E_ALL);

$carga=fn($clase)=>require("$clase.php");
spl_autoload_register($carga);

session_start();

if(isset($_SESSION['user'])){
    header("location:listado.php");
}

if (isset($_POST['submit'])){
    $db = new DB();
    $user = $_POST['name'];
    $pass = $_POST['pass'];
    if ($db->valida_usuario($user,$pass)){
        $_SESSION['user']=$user;
        header("location:listado.php");
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
//var_dump($con);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<div class="alert alert-primary m-3 w-25 p-4">
    <form action="index.php" method="post">
    <fieldset>
        <legend class="text-center">Acceder</legend>
        <span style="color=red"><?=$msj ?? ""?></span>
            <label for ="name" class="form-label p-2">Usuario</label>
            <input type="text" name="name" id="name" class="form-control p-2">
            <label for ="pass" class="form-label p-2">Contraseña</label><br>
            <input type="text" name="pass" id="pass" class="form-control p-2"><br>
            <button class="btn btn-primary btn-sm pt-2 text-center" type="submit" name="submit">Enviar</button>
    </fieldset>
    </form>
</div>
</body>
</html>
