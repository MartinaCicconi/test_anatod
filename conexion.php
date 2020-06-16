<?php 

  /**
  * 
  */
  class conexion{
  	
  	public function get_conection(){
  //		$conexion=new PDO('mysql:host=localhost; dbname=mayorista','root','');

      $conexion=new PDO('mysql:host=localhost; dbname=test','root','');

  		return $conexion;
  	}
  }

 ?>