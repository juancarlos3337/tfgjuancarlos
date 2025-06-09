<?php
class pedido{
    private $con;

    public function __construct(){
        require_once("class.bd.php");

        $this->con= (new bd())->getCon();
    }

    public function insertarPedido($usuario,$precioTotal,$fecha,$hora){
        $sentencia="insert into pedidos(usuario,preciototal,fecha,hora) values(?,?,?,?);";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("idss",$usuario,$precioTotal,$fecha,$hora);
        $consulta->execute();

        $res=false;
        if($consulta->affected_rows ==1) $res=true;
        $consulta->close();

        return $res; //devuelve true si se a podido añadir el usuario
    }

    public function obtenerIdPedido($usuario,$fecha,$hora){
        $sentencia="select cod_pedido from pedidos pedidos where usuario =? and fecha=? and hora=?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("iss",$usuario,$fecha,$hora);
        $consulta->bind_result($idPedido);
        $consulta->execute();

        $consulta->fetch();
        return $idPedido;
    }

    public function listarPedidosDeHoy($fecha){
        $sentencia="select usuarios.codigo,pedidos.cod_pedido,usuarios.nombre, usuarios.apellido, pedidos.preciototal, pedidos.fecha, pedidos.hora, pedidos.realizado from pedidos,usuarios where usuarios.codigo=pedidos.usuario and pedidos.fecha=?;"; 
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("s",$fecha);
        $consulta->bind_result($usu,$ped,$nombre,$ape,$precio,$date,$hora,$realizado);
        $consulta->execute();

        $pedido=[];
        while($consulta->fetch()){
            $hora=substr($hora,0,5);
            array_push($pedido,[$usu,$ped,$nombre,$ape,$precio,$date,$hora,$realizado]);
        }
        $consulta->close();
        return $pedido;
    }

    // public function listarPedidosDeHoyUsuario($fecha,$id){
    //     $sentencia="select patatas.nombre,patatas.precio,tienen.cantidad,pedidos.preciototal, pedidos.hora, pedidos.realizado from pedidos,usuarios,patatas,tienen where usuarios.codigo=pedidos.usuario and pedidos.cod_pedido=tienen.cod_pedido and tienen.cod_patata=patatas.cod_patata and pedidos.fecha=? and pedidos.usuario=?;"; 

    //     $consulta=$this->con->prepare($sentencia);
    //     $consulta->bind_param("si",$fecha,$id);
    //     $consulta->bind_result($patata,$precioUnitario,$cantidad,$precioTotal,$hora,$realizado);
    //     $consulta->execute();

    //     $pedido=[];
    //     while($consulta->fetch()){
    //         array_push($pedido,[$patata,$precioUnitario,$cantidad,$precioTotal,$hora,$realizado]);
    //     }
    //     $consulta->close();
    //     return $pedido;
    // }

    public function listarPedidosDeHoyUsuario($fecha,$id){
        $sentencia="select pedidos.cod_pedido,patatas.nombre,patatas.precio,tienen.cantidad,pedidos.preciototal, pedidos.hora, pedidos.realizado from pedidos,usuarios,patatas,tienen where usuarios.codigo=pedidos.usuario and pedidos.cod_pedido=tienen.cod_pedido and tienen.cod_patata=patatas.cod_patata and pedidos.fecha=? and pedidos.usuario=?;"; 

        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("si",$fecha,$id);
        $consulta->bind_result($codPedido,$patata,$precioUnitario,$cantidad,$precioTotal,$hora,$realizado);
        $consulta->execute();

        $pedidos=[];
        while($consulta->fetch()){
           if(!isset($pedidos[$codPedido])){
                $pedidos[$codPedido] =[
                    'hora'=>$hora,
                    'precioTotal'=>$precioTotal,
                    'realizado'=>$realizado,
                    'productos'=>[]
                ];
           }

           $pedidos[$codPedido]['productos'][]=[
                'nombre'=>$patata,
                'precioUnitario'=>$precioUnitario,
                'cantidad'=>$cantidad
           ];
        }
        $consulta->close();
        return array_values($pedidos);
    }
    public function actualizarPedido($idusuario,$idpedido,$fecha,$hora){
        $sentencia="update pedidos set realizado=1 where usuario=? and cod_pedido=? and fecha=? and hora=?;";
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_param("iiss",$idusuario,$idpedido,$fecha,$hora);
        $consulta->execute();

        $res=false;
        if($consulta->affected_rows ==1) $res=true;
        $consulta->close();

        return $res; 
    }

    public function listarDatosPedidosHoy(){
        $sentencia="select (select count(*) from pedidos where date(fecha) = curdate()) as total_pedidos_hoy, (select sum(preciototal) from pedidos where date(fecha) = curdate()) as ingresos_hoy, (select hour(hora) from pedidos where date(fecha) = curdate() group by hour(hora) order by count(*) desc limit 1) as hora_mas_activa, (select count(*) from pedidos where date(fecha) = curdate() and hour(hora) = (select hour(hora) from pedidos where date(fecha) = curdate() group by hour(fecha) order by count(*) desc limit 1)) as pedidos_en_hora_mas_activa;"; 
        $consulta=$this->con->prepare($sentencia);
        $consulta->bind_result($totalPedidos,$ingresosHoy,$horaActiva,$pedidosHora);
        $consulta->execute();

        $pedido=[];
        while($consulta->fetch()){
            array_push($pedido,[$totalPedidos,$ingresosHoy,$horaActiva,$pedidosHora]);
        }
        $consulta->close();
        return $pedido;
    }
}
?>