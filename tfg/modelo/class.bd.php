<?php
    class bd{
        private $con;

        public function __construct(){
            require_once("../../../cred.php");

            $this->con= new mysqli("localhost",USU_CONN,PSW_CONN,"tfg_paponazo");
        }

        public function getCon(){
            return $this->con;
        }
    }
?>