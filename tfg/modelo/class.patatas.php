<?php
class patata{
    private $con;

    public function __construct(){
        require_once("class.bd.php");

        $this->con= (new bd())->getCon();
    }

    // public function listarPatatas(){
    //     $sentencia="select cod_patata,nombre,precio,descri,img from patatas;";
    //     $consulta=$this->con->prepare($sentencia);
    //     $consulta->bind_result($id,$nombre,$precio,$descri,$img);
    //     $consulta->execute();

    //     $patatas=[];
    //     while($consulta->fetch()){
    //         array_push($patatas,[$id,$nombre,$precio,$descri,$img]);
    //     }
    //     $consulta->close();
    //     return $patatas;
    // }

    //funcion de prueba
    public function listarPatatas(){
        $sentencia="select cod_patata,nombre,precio,descri,img from patatas;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_result($id,$nombre,$precio,$descri,$img);
        $consulta->execute();

        $patatasFila=[];
        while($consulta->fetch()){
           $patatasFila[]=[$id,$nombre,$precio,$descri,$img];
        }
        
        $consulta->close();
        $patatas=[];

        foreach ($patatasFila as $p) {
            $ingre = $this->obtenerIngredientes($p[0]);
            $p[]=$ingre;
            $patatas[]=$p;
        }
        return $patatas;
    }
    // Fucnion en pruebas
    public function obtenerIngredientes($idPatata){
        $sentencia="select nombre from ingredientes,poseen where ingredientes.cod_ingre=poseen.cod_ingre and poseen.cod_patata =?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("i",$idPatata);
        $consulta->bind_result($nombre);
        $consulta->execute();
   
        $ingredientes=[];
        while($consulta->fetch()){
            $ingredientes[]=$nombre;
        }
        
        $consulta->close();
        return $ingredientes;
    }

    public function insertarPatata(){

    }

    public function obtenerPatata($id){
        $sentencia="select nombre,precio,descri,img from patatas where cod_patata=?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("i",$id);
        $consulta->bind_result($nombre,$precio,$descri,$img);
        $consulta->execute();

           
        $consulta->fetch();
        $patata=[$nombre,$precio,$descri,$img];
        $consulta->close();
        return $patata;
    }

    public function modpatataSinImg($nombre,$precio,$descri,$cod_patata){
        $sentencia="update patatas set nombre=?,precio=?,descri=? where cod_patata=?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("sdsi",$nombre,$precio,$descri,$cod_patata);
        $consulta->execute();

        $res=false;
        if($consulta->affected_rows ==1) $res=true;
        $consulta->close();

        return $res; 
    }

    public function modpatataConImg($nombre,$precio,$descri,$img,$cod_patata){
        $sentencia="update patatas set  nombre=?,precio=?,descri=?,img=? where cod_patata=?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("sdssi",$nombre,$precio,$descri,$img,$cod_patata);
        $consulta->execute();

        $res=false;
        if($consulta->affected_rows ==1) $res=true;
        $consulta->close();

        return $res; 
    }

    
}
?>