<?php
/*
 * anatod ® - ©
 */
/**
* 
*/
//class conexion{
  class class_db{
    public function get_conection(){
//		$conexion=new PDO('mysql:host=localhost; dbname=mayorista','root','');

    $conexion=new PDO('mysql:host=localhost; dbname=anatodtest','root','');

        return $conexion;
    }
}

?>
<?php

//class class_db {
    
    //PUBLIC  $conn=NULL; 
        /*
    CONST user      =   'test',
          pass      =   'test5678',
          db        =   'test_anatod',
          serverip  =   'anatod-test.c75o4mima6rb.us-east-1.rds.amazonaws.com';*/
   /*       CONST user      =   'root',
          pass      =   '',
          db        =   'test_anatod_estaEsLaBuena',
          serverip  =   'localhost';
    
    public function __construct(){
       
        if(!$this->conn){
            try {
                $this->conn = new mysqli(SELF::serverip,SELF::user,SELF::pass,SELF::db); 
                $this->conn->set_charset("utf8");
                if (!$this->conn) {die('No se pudo conectar.');}
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
    }
}*/
?>