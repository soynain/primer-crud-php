<?php
class RepositoryBdd
{
    private $conexion;
    /*nota propia: el constructor lleva dos guiones zonso*/ 
    public function __construct()
    {
        try {
            $this->conexion = new PDO('mysql:host=localhost;port=3306;dbname=phppractica', 'root', '211772809');
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //    $prueba=$this->conexion->prepare('select * from alta_producto');
        } catch (PDOException $e) {
            return "falla de conexion".$e;
        }
    }

    public function ejecutarConsulta()
    {
        try {
            $resultados = $this->conexion->prepare("select * from alta_producto");
            $resultados->execute();
            return $resultados->fetchAll();
        } catch (PDOException $e) {
            echo $e->getCode()." ddasdsa";
        }
    }

    public function ejecutarInsercion($nombre, $descripcion, $fechaAlta, $imagen)
    {
        $resultadoInsercion = $this->conexion->prepare("insert into alta_producto(nombre,descripcion,fechaAlta,imagen) values (?,?,?,?)");
        $resultadoInsercion->bindParam(1, $nombre);
        $resultadoInsercion->bindParam(2, $descripcion);
        $resultadoInsercion->bindParam(3, $fechaAlta);
        $resultadoInsercion->bindParam(4, $imagen);
        try {
            $resultadoInsercion->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getConexion()
    {
        return $this->conexion;
    }
}
