<?php
require "conexion.php";
$carga=fn($clase)=>require("$clase.php");
spl_autoload_register($carga);

if (isset($_POST['submit'])){
    $bd = new DB();
    $cod = $_POST['cod'];
    $nombre_corto = $_POST['nombre_corto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['PVP'];
    $descripcion = $_POST['descripcion'];
    $familia = $_POST['familia'];

    $rtdo =  $bd->actualizar_producto($cod, $nombre_corto, $nombre, $precio, $descripcion);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
     <title>Document</title>
</head>
<body>

<?php
header("Refresh:3;url=listado.php?familia=$familia");
if ($rtdo==true){
    echo "<h1>Se han actualizado los datos con exito el producto $nombre_corto con codigo $cod </h1>";
}else if($rtdo==false && !$_POST['reset']){
    echo "<h1>Ha ocurrido un error</h1>";
}else{
    echo "<h1>Has cancelado los cambios</h1>";
}



?>
</body>
</html>
