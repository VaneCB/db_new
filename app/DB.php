<?php
class DB
{
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO(DSN, USER, PASS);
        } catch (PDOException $exception) {
            die ("No se ha podido conectar" . $exception->getMessage());
        }

    }

    private function ejecuta_consulta(string $sentencia, array $valores = []): PDOStatement
    {
        $rtdo = $this->conexion->prepare($sentencia);
        $rtdo->execute($valores);
        return $rtdo;
    }


    public function obtener_familias(): array
    {
        $sentencia = "select * from familia";
        $rtdo = $this->ejecuta_consulta($sentencia);
        $filas = [];
        while ($fila = $rtdo->fetch(PDO::FETCH_ASSOC)) {
            $filas[] = $fila;
        }
        return $filas;
    }

    public function valida_usuario($nombre, $pass)
    {
        //$consulta ="select * from usuarios where nombre = ? and pass=?";
        //Crear consulta
        $consulta = "select * from usuarios where nombre = :nombre and pass=:pass";
        $valores = [":nombre" => $nombre, ":pass" => $pass];
        $rtdo = $this->ejecuta_consulta($consulta, $valores);

        /*$rtdo= $this->conexion->prepare($consulta);
        $rtdo->bindParam(":nombre",$nombre);
        $rtdo->bindParam(":pass",$pass);
        //Ejecuto la sentencia
        $rtdo->execute();*/
        //Podria omitir el bindparam y hacerlo en el execute $rtdo->execute([$nombre,$pass]);
        if ($rtdo->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function mostrar_productos($familia): array
    {
        //self::obtener_familias();
        $sentencia = "select * from producto where familia = ?";
        $valores =[$familia];
        $rtdo = $this->ejecuta_consulta($sentencia, $valores);
        $filas = [];
        while ($fila = $rtdo->fetch(PDO::FETCH_ASSOC)) {
            $filas[] = $fila;
        }
        return $filas;
    }

    public function ver_producto($cod): array {
        $sentencia = "select * from producto where cod = ? LIMIT 1";
        $valores = [$cod];
        $rtdo = $this->ejecuta_consulta($sentencia, $valores);
        $producto = $rtdo->fetch(PDO::FETCH_ASSOC);
        return $producto;
    }

    public function actualizar_producto($cod, $nombre_corto, $nombre, $precio, $descripcion) {
        $sentencia = "UPDATE producto SET nombre_corto= ? , nombre = ?, PVP = ?, descripcion = ? WHERE cod = ?";
        $valores = [$nombre_corto, $nombre, $precio, $descripcion, $cod];
        try {
            $rtdo = $this->ejecuta_consulta($sentencia, $valores);
            return true;
        } catch (PDOException $e) {
            echo "<h1>Error </h1>".$e->getMessage();
            return false;
        }
    }
}