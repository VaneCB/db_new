<?php
require "conexion.php";
$carga=fn($clase)=>require("$clase.php");
spl_autoload_register($carga);
ini_set('display_errors',true);
error_reporting(E_ALL);

session_start();

if(!isset($_SESSION['user'])){

}
$usuario = $_SESSION['user'];

$opcion = $_POST['submit'] ?? "";
switch ($opcion){
    case "Listado Productos":
        $bd = new DB();
        $familia = $_POST['familia'];
        $productos = $bd->mostrar_productos($familia);
        break;
    case "logout":
        session_destroy();
        header("location:index.php?msj=Espero que vuelvas pronto");
        exit;

    default:
}
$db = new DB();

$familias = $db->obtener_familias();
$familiaSeleccionada = isset($_POST['familia']) ? $_POST['familia'] : null;

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
<header> <?= "Bienvenid@ " .$usuario?>
    <form action="listado.php" method="post" class="alert-light">
        <button type="submit" value="logout" name="submit" class="btn btn-danger m-3">Log out</button>
    </form>
</header>

<div class="alert alert-primary m-3 w-auto p-4">
<form method="post" action="listado.php">
<fieldset>
    <legend>Productos</legend>
    <label for="familia">Selecciona una familia para ver los productos</label>
    <?=Plantilla::listado_familias($familias, $familiaSeleccionada)?>
    <button type="submit" name="submit" value="Listado Productos" class="btn btn-info">Mostrar productos</button>
    <?php
    if(isset($productos)){
       echo Plantilla::listado_productos($productos);
       // var_dump($productos);
    }

    ?>
</fieldset>
</form>

</div>
</body>
</html>
