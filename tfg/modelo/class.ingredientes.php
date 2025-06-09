<?php
class ingrediente{
    private $con;

    public function __construct(){
        require_once("class.bd.php");

        $this->con= (new bd())->getCon();
    }

    public function obtenerIngredientesPatata($idPatata){
        $sentencia="select nombre from ingredientes,poseen 
        where ingredientes.cod_ingre=poseen.cod_ingre and poseen.cod_patata =?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("i",$idPatata);
        $consulta->bind_result($nombre);
        $consulta->execute();
   
        $ingredientes=[];
        while($consulta->fetch()){
            array_push($ingredientes,[$nombre]);
        }
        $consulta->close();
        return $ingredientes;
    }
}
?>