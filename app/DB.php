<?php
class DB
{
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO(DSN,USER,PASS);
        } catch (PDOException $exception) {
            die ("No se ha podido conectar" . $exception->getMessage());
        }

    }
    
    private function ejecuta_consulta($sentencia,$valores){
        $rtdo= $this->conexion->prepare($sentencia);
        $rtdo->execute($valores);
        return $rtdo;
    }
    
    private function dime_familias(){
        $sentencia = "select * from familias";
        return $this->ejecuta_consulta($sentencia);
    }
    public function valida_usuario($nombre,$pass){
        //$consulta ="select * from usuarios where nombre = ? and pass=?";
       //Crear consulta
        $consulta ="select * from usuarios where nombre = :nombre and pass=:pass";
        $rtdo= $this->conexion->prepare($consulta);
        $rtdo->bindParam(":nombre",$nombre);
        $rtdo->bindParam(":pass",$pass);
        //Ejecuto la sentencia
        $rtdo->execute();
    //Podria omitir el bindparam y hacerlo en el execute $rtdo->execute([$nombre,$pass]);
        if ($rtdo->rowCount() > 0){
            return true;
        }else {
            return false;
        }
    }
}