<?php
    function set_cookie(String $nom,$val){
        setcookie($nom,$val,time()+(86400*30));
    }

    function unset_cookie(String $nom){
        $completado=false;
        if(isset($_COOKIE[$nom])){
            setcookie($nom,"",time()-(86400*30));
            $completado=true;
        }
        return $completado;
    }
    function set_session(String $nom,$val){
        session_start();
        $_SESSION[$nom]=$val;
    }

    function start_session(){
        if(session_status() === PHP_SESSION_NONE)
        session_start();
    }

    function get_session(String $nom){
        start_session();
        return $_SESSION[$nom];
    }
    function unset_session(){
        start_session();
        session_unset();
        session_destroy();
    }

    function is_session(String $nom){
       start_session();
        $isset= isset($_SESSION[$nom]);
        return $isset;
    }
?>