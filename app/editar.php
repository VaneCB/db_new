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
    <title>Document</title>
</head>
<body>
<form method="post" action="actualizar.php">
    <fieldset>
        <legend>Producto</legend>
        <input type="hidden" name="cod" value=<?="{$producto['cod']}"?>>
        <label for="nombre_corto">Nombre corto</label>
        <input type="text" name="nombre_corto" value=<?="{$producto['nombre_corto']}"?>><br>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value=<?="{$producto['nombre']}"?>><br>
        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"><?="{$producto['descripcion']}"?></textarea><br>
        <label for="PVP">Precio</label>
        <input type="text" name="PVP" value=<?="{$producto['PVP']}"?>><br>
        <button type="submit" name="submit" value="actualizar">Actualizar</button>
        <button type="" name="submit" value="cancelar">Cancelar</button>
    </fieldset>
</form>
</body>
</html>
