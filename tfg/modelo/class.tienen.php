<?php
class tienen{
    private $con;

    public function __construct(){
        require_once("class.bd.php");

        $this->con= (new bd())->getCon();
    }

    public function insertarDatos($idPedido,$idPatata,$cantidad){
            $sentencia="insert into tienen(cod_pedido,cod_patata,cantidad) values(?,?,?) on duplicate key update cantidad= cantidad + values(cantidad);";
            $consulta=$this->con->prepare($sentencia);
            $consulta->bind_param("iii",$idPedido,$idPatata,$cantidad);
            $consulta->execute();

            $res=false;
            if($consulta->affected_rows ==1) $res=true;
            $consulta->close();

            return $res; //devuelve true si se a podido añadir el usuario
        }
}
?>