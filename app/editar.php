<?php
require "conexion.php";
$carga=fn($clase)=>require("$clase.php");
spl_autoload_register($carga);

if (isset($_POST['producto'])){
    $cod = $_POST['producto'];
    $bd = new DB();
    $producto =  $bd->ver_producto($cod);
}

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
<div class="alert alert-primary m-3 w-50">
<form class="p-5 w-100" method="post" action="actualizar.php">
    <fieldset>
        <legend class="text-center">Modificar producto</legend>
        <input type="hidden" name="cod" value=<?="{$producto['cod']}"?>>
        <input type="hidden" name="familia" value=<?="{$producto['familia']}"?>>
        <label for="nombre_corto">Nombre corto</label>
        <input class="form-control" type="text" name="nombre_corto" value="<?=htmlspecialchars($producto['nombre_corto'])?>"><br>
        <label for="nombre">Nombre</label>
        <input class="form-control" type="text" name="nombre" value=<?="{$producto['nombre']}"?>><br>
        <label for="descripcion">Descripcion</label>
        <textarea class="form-control" name="descripcion"><?="{$producto['descripcion']}"?></textarea><br>
        <label for="PVP">Precio</label>
        <input class="form-control" type="text" name="PVP" value=<?="{$producto['PVP']}"?>><br>
        <div class="text-center">
        <button class="btn btn-success" type="submit" name="submit" value="actualizar">Actualizar</button>
        <button class="btn btn-danger" type="submit" name="reset" value="cancelar">Cancelar</button>
        </div>
    </fieldset>
</form>
</div>
</body>
</html>
