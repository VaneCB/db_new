<?php
class DB
{
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO(DSN,USER,PASS);
            //$this->conexion = new_sqli("127.0.0.1", USER, PASS, "dwes", 23313);
        } catch (PDOException $exception) {
            die ("No se ha podido conectar" . $exception->getMessage());
        }

    }

    public function valida_usuario($nombre,$pass){
        $consulta =<<<FIN
    select * 
    from usuarios 
    where nombre = '$nombre' 
    and 
    pass='$pass';
FIN;
        $rtdo= $this->conexion->query($consulta);
        if ($rtdo->rowCount() > 0){
            return true;
        }else {
            return false;
        }
    }
}