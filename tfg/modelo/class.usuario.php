<?php

class usuario{
    private $con;

    public function __construct(){
        require_once("class.bd.php");

        $this->con= (new bd())->getCon();
    }

    public function comprobarUsuario($nombre,$email){
        $sentencia="select count(*) from usuarios where nombre=? and email=?;";
        $consulta= $this->con->prepare($sentencia);
        $consulta->bind_param("ss",$nombre,$email);
        $consulta->bind_result($contador);
        $consulta->execute();

        $consulta->fetch();
        $existe=false;
        if($contador==1)$existe=true;
        $consulta->close();
        return $existe;
    }

    public function sacarTipo($nombreUsu){
        $sentencia="select tipo from usuarios where nombre =?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("s",$nombreUsu);
        $consulta->bind_result($tipo);
        $consulta->execute();

        $consulta->fetch();
        return $tipo;
    }

    public function obtenerId($nombreUsu){
        $sentencia="select codigo from usuarios where nombre =?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("s",$nombreUsu);
        $consulta->bind_result($idUsuario);
        $consulta->execute();

        $consulta->fetch();
        return $idUsuario;
    }

    public function insertarUsuario($nombre,$ape,$email,$tlf,$pw){
        try{
            $sentencia="insert into usuarios(nombre,apellido,email,tlf,pw) values(?,?,?,?,?);";
            $consulta=$this->con->prepare($sentencia);
            $consulta->bind_param("sssis",$nombre,$ape,$email,$tlf,$pw);
            $consulta->execute();

            $res=false;
            if($consulta->affected_rows ==1) $res=true;
            $consulta->close();

            return $res; //devuelve true si se a podido añadir el usuario
        }catch(mysqli_sql_exception $e){
            $res= false;
            return $res;
        }
        
    }
    
    public function obtenerDatos($id){
        $sentencia="select nombre,apellido,tlf from usuarios where codigo =?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("i",$id);
        $consulta->bind_result($nombre,$ape,$tlf);
        $consulta->execute();
  
        $consulta->fetch();
        $datos=[$nombre,$ape,$tlf];
        $consulta->close();
        return $datos;
    }

    public function obtenerPwCodificada($nombre,$email){
        $sentencia="select pw from usuarios where nombre =? and email=?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("ss",$nombre,$email);
        $consulta->bind_result($pw);
        $consulta->execute();
  
        $consulta->fetch();
        $datos=$pw;
        $consulta->close();
        return $datos;
    }

    public function actualizarUsuario($nombre,$ape,$tlf,$idusu){
        $sentencia="update usuarios set nombre=?,apellido=?,tlf=? where codigo=?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("ssii",$nombre,$ape,$tlf,$idusu);
        $consulta->execute();

        $res=false;
        if($consulta->affected_rows ==1) $res=true;
        $consulta->close();

        return $res; 
    }
}
?>