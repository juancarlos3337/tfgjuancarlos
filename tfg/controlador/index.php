<?php

//Funcion para iniciar sesion en la aplicacion web.
    function iniciarSesion(){
         session_start();
        require_once("../modelo/sessionesCookies.php");
        require_once("../modelo/class.usuario.php");
        $usuario=new usuario();

        if(!isset($_POST["recordar"])) unset_cookie("usuario");

        //comprobamos con la bd que existe el usu y la contraseña
        $pwcodificada=$usuario->obtenerPwCodificada($_POST["nombre"],$_POST["email"]);
        if($usuario->comprobarUsuario($_POST["nombre"],$_POST["email"]) && password_verify($_POST["pw"],$pwcodificada)){ 
            if(isset($_POST["recordar"])) set_cookie("usuario",$_POST["nombre"]);
            set_session("usu",$_POST["nombre"]) ;

            $tipo=$usuario->sacarTipo($_SESSION["usu"]);
            $_SESSION["tipo"]=$tipo;

            $id_usuario=$usuario->obtenerId($_SESSION["usu"]);
            $_SESSION["idUsu"]=$id_usuario;
            // una vez comprobamos que existe el usuario, nos guardamos el tipo de usuario
            //  y lo mandamos a la pagina principal pero con la sesion iniciada
           header("Location: ../controlador/index.php");
            exit;

        }else{
           
          $_SESSION['errorIniciar']= "Credenciales incorrectas";
          require_once("../vistas/login.php");
        }
    
    }

    //funcion para realizar un registro en nuestra aplicacion web
    function enviarRegistro(){
        require_once("../modelo/class.usuario.php");
        $usuario= new usuario();
        $pwplano=$_POST["pw"];
        $pwcodificada=password_hash($pwplano,PASSWORD_DEFAULT);
        $resultado=$usuario->insertarUsuario($_POST["nombre"],$_POST["apellido"],$_POST["email"],$_POST["tlf"],$pwcodificada);
    
        if($resultado==true){
            //si me registro me lleva al inicio de sesio
            require_once("../vistas/login.php");
        }else{
            session_start();
            require_once("../modelo/sessionesCookies.php");
            $_SESSION['errorRegistro'] = "El correo ya está registrado.";
            require_once("../vistas/registro.php");
        }
    }

    //funcion para listar todos los productos de nuestra bd
  

    function verCarta(){
        // antes de cambiar de vista obtenemos todas las papas de la 
        // bd para luego mostrarla en la vista
        require_once("../modelo/class.patatas.php");           
        $patata=new patata();
        $patatas=$patata->listarPatatas();
        $contador=count($patatas);  //obtenemos la longitud del array 
                                    // para usarlo con posterioridad
        require_once("../vistas/carta.php");
    }

    function registro(){
        require_once("../vistas/registro.php");
    }

    function login() {
        require_once("../vistas/login.php");
    }

    function logout() {
        unset_session();
        header("Location: ../controlador/index.php");
        exit;
    }

    function verPedido(){
        require_once("../vistas/pedido.php");
    }

    function contacto(){
        require_once("../vistas/contacto.php");
    }

    function sobreNosotros(){
        require_once("../vistas/sobreNosotros.php");
    }

    function verPerfil(){
        require_once("../modelo/sessionesCookies.php");
        require_once("../modelo/class.usuario.php");
        $usu= new usuario();
        $usuario=get_session("usu");
        $id=$_SESSION["idUsu"];
        $datosUsuario=$usu->obtenerDatos($id);
        // obtengo los datos del usuario pàra luegoi mostrarlos
        require_once("../vistas/perfil.php");
    }

    function modificarPerfil(){
        require_once("../modelo/class.usuario.php");
        $usu= new usuario();
        $nombre=$_POST["nombre"];
        $ape=$_POST["ape"];
        $tlf=$_POST["tlf"];
        $idusu=$_POST["idusuMod"];
        $res=$usu->actualizarUsuario($nombre,$ape,$tlf,$idusu);
        if($res=true) {
            header("Location: ../controlador/index.php");
            exit;
        }
    }

    function realizarPedido(){
        require_once("../modelo/sessionesCookies.php");
        require_once("../modelo/class.pedido.php");
        require_once("../modelo/class.tienen.php");
        $patatas=$_POST["patatas"];
        $pedido= new pedido();
        $tienen= new tienen();

        //obtenemos las variables necesarias para guardarlas en la tabla de pedido
        $usuario=get_session("usu");
        $idUsu=$_SESSION["idUsu"];
        $precioTotal=$_POST["totalPedido"];
        $fecha=obtenerFecha();
        $hora=$_POST["hora"] .":". $_POST["minuto"];

        $idPedidoExiste= $pedido->obtenerIdPedido($idUsu,$fecha,$hora);
        if($idPedidoExiste){
            echo "
            <script>
                alert('Ya tienes un pedido programado para esa hora. Por favor, elige otra hora.');
                window.location.href = 'index.php?action=verPedidosUsuario';
                
            </script>
            ";
            exit;
        }
        $res=$pedido->insertarPedido($idUsu,$precioTotal,$fecha,$hora);
        $idPedido=$pedido->obtenerIdPedido($idUsu,$fecha,$hora);
      
        for ($i=0; $i < count($patatas); $i++) { 
            $idPatata=$patatas[$i]["idPatata"];
            $cantidad=$patatas[$i]["cantidadPatata"];
            $res2=$tienen->insertarDatos($idPedido,$idPatata,$cantidad);
        }
         require_once("../vistas/modalRealizarPedido.php");
        exit;
        
    }

    function obtenerFecha(){
        return date('Y/m/d');
    }
   
    function obtenerHora(){
        return date('H:i:s');
    }

    function modificacionPatata(){
    require_once("../modelo/class.patatas.php");
    require_once("../modelo/sessionesCookies.php");
    $patata=new patata();
    $id=$_POST["idpatata"];
    
    $patataModificada=$patata->obtenerPatata($id);
    require("../vistas/modificarPatata.php");
    }

    function cambiarPatata(){
        require_once("../modelo/class.patatas.php");
        require_once("../modelo/class.usuario.php");
        require_once("../modelo/sessionesCookies.php");
        $patata= new patata();
        $usuario=new usuario();


        $nombreUsuario=get_session("usu");
        $idusu=$usuario->obtenerId($nombreUsuario);
        $idpatata=$_POST["idpatataMod"];
        //antes de modificar compruebo que han cambiado la img
        if(empty($_FILES["img"]["name"])){
            //si esta vacio modifico los datos sin la img
            $res=$patata->modpatataSinImg($_POST["nombre"],$_POST["precio"],$_POST["descri"],$idpatata);
            if($res=true)verCarta();
        }else{
            //me traigo la ruta de la img de la bd
            //la borro y machaco la img 
            unlink($_POST["urlpatataMod"]);

            $nombre=$_FILES["img"]["name"];
            $nombreTemp=$_FILES["img"]["tmp_name"];
            
            $ruta = compRuta($nombreTemp, $nombre);

            $res=$patata->modpatataConImg($_POST["nombre"],$_POST["precio"],$_POST["descri"],$ruta,$idpatata);
            if($res=true)verCarta();

        }

    }

    function compRuta($nombreTemporal,$nombre){
        $nombreu=get_session("usu");
        $rutaOrigen=$nombreTemporal;
        $rutaDestino= "../img/". $_SESSION["usu"] ."/";

        if(!file_exists($rutaDestino)){
            mkdir($rutaDestino);
        }
        $rutaDestino.=$nombre;
        move_uploaded_file($rutaOrigen,$rutaDestino);
        return $rutaDestino;
    }


    function verPedidosAdmin(){
        require_once("../modelo/sessionesCookies.php");
        require_once("../modelo/class.pedido.php");

        $nombreUsuario=get_session("usu");
        $pedidos=new pedido();
        $diaActual=obtenerFecha();
        $pedidosDeHoy=$pedidos->listarPedidosDeHoy($diaActual);
        $datosPedidos=$pedidos->listarDatosPedidosHoy();
        require_once("../vistas/verPedidos.php");
    }

    function verPedidosUsuario(){
        require_once("../modelo/sessionesCookies.php");
        require_once("../modelo/class.pedido.php");

        $nombreUsuario=get_session("usu");
        $pedidos=new pedido();
        $diaActual=obtenerFecha();
        $id=$_SESSION["idUsu"];
        $pedidosDeHoy=$pedidos->listarPedidosDeHoyUsuario($diaActual,$id);
        require_once("../vistas/verPedidosUsuario.php");
    }
    function finalizarPedido(){
        require_once("../modelo/sessionesCookies.php");
        require_once("../modelo/class.pedido.php");
        $nombre=get_session("usu");
        $pedido=new pedido();

        $idUsuario=$_POST["idusu"];
        $idPedido=$_POST["idpedido"];
        $fecha=$_POST["fecha"];
        $hora=$_POST["hora"];

        $res=$pedido->actualizarPedido($idUsuario,$idPedido,$fecha,$hora);
        if($res==true){
            verPedidosAdmin();
        }

    }
    // nada mas empezar, redijiremos a la pagina principal, si no esta seteada la sesion significa que no ha iniciado sesion, si inicia sesion, se guarda el nombre de usaurio
    // y dará acceso  las funcionalidades de usuarios registrados
    require_once("../modelo/sessionesCookies.php");
        if(isset($_REQUEST["action"])){
            $action=$_REQUEST["action"];
            $action();
        }else{
            
            // start_session();
            if (is_session("usu")) {
                $nombreUsuario = get_session("usu");
            } else {
                $nombreUsuario = null;
            }
            require_once("../vistas/index.php");        
        }
?>