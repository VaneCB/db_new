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

    $rtdo =  $bd->actualizar_producto($cod, $nombre_corto, $nombre, $precio, $descripcion);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="refresh" content="5;url=listado.php">
    <title>Document</title>
</head>
<body>

<?php
if ($rtdo==true){
    echo "<h1>Se han actualizado los datos con exito</h1>";
}else{
    echo "<h1>Ha ocurrido un error</h1>";
}

?>
</body>
</html>
