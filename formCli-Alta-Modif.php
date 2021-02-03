<?php
   header("Content-Type: text/html;charset=utf-8");
   require('class.database.php');

   $modelo=new class_db();
   $base=$modelo->get_conection();
   $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $base->exec("SET CHARACTER SET utf8");
   
   //$base=$modelo->conn;
   //$sql1="Select * from clientes ";
   //$resultado1=$base->query($sql1);
   //$resultado1->execute();
   //$cli_actualizar=$resultado1->fetchall();
   
   //foreach ($resultado1 as $key ) {
     // var_dump($key);
   //}
   //$base=$modelo->get_conection();
   //$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   //$base->exec("SET CHARACTER SET utf8");
   
   
   $mensaje = "";

   $Enviar=isset($_POST["Enviar"]);
   $cli_id = isset($_POST["cliente_id"]) ? ($_POST["cliente_id"] == "-1" ? false : $_POST["cliente_id"]) : false;

   if (!$Enviar && $cli_id){
      $sql1="Select * from clientes where cliente_id=$cli_id";
      $resultado1=$base->prepare($sql1);
      $resultado1->execute();
      $cli_actualizar=$resultado1->fetchall();
      $cli_actualizar=$cli_actualizar[0];
   } 

   if ($Enviar){
      $Valores = array();
      $Campos = array();
      $EsUpdate = $cli_id;
      if (isset($_POST["cliente_nombre"])) {
         $Campos[] = "cliente_nombre";
         $Valores[] = ($EsUpdate ? "cliente_nombre=" : "") . "'".$_POST["cliente_nombre"]."'";
      }
      if (isset($_POST["cliente_dni"])) {
         $Campos[] = "cliente_dni";
         $Valores[] = ($EsUpdate ? "cliente_dni=" : "") . "'".$_POST["cliente_dni"]."'";
      }
      if (isset($_POST["cliente_localidad"])) {
         $Campos[] = "cliente_localidad";
         $Valores[] = ($EsUpdate ? "cliente_localidad=" : "") . "'".$_POST["cliente_localidad"]."'";
      }
      
      if (count($Valores) != 0) {
         try {
            //$this->conn = new mysqli(SELF::serverip,SELF::user,SELF::pass,SELF::db);
            $conn = new mysqli("localhost:3306", 'root', '', "anatodtest"); 
            if ($conn->connect_error) die("Connection failed: " . $conn->connect_error); 
            //if (!$this->conn) {die('No se pudo conectar.');}

            if ($cli_id){
               $sql = "UPDATE clientes SET ".implode(', ', $Valores)." WHERE cliente_id=$cli_id;";
               $mensaje = 'Se actualizaron correctamente los datos del clente';
            }else{
               $sql = "INSERT INTO clientes (".implode(', ', $Campos).") VALUES (".implode(', ', $Valores).")";
               $mensaje = 'Se insertaron correctamente los datos del cliente';
            }
            $conn->query($sql);
            //$resultado1=$base->query($sql1);

         }
         catch(PDOException $e){
            $mensaje = "Error. No se pudo generar la accion. Intente nuevamente";
            //echo $sql . "<br>" . $e->getMessage();
         }
         /*catch (Exception $exc) {
            echo $exc->getTraceAsString();
            $mensaje = "Error. No se pudo generar la accion. Intente nuevamente";
        }*/
      } else {
         //echo "Complete todos los campos";
         $mensaje = "Debe completar todos los campos"; 
         }
   }


?>
<html>
   <head>
      <title>Insertar/Modificar Clientes</title>
      <script src="https://kit.fontawesome.com/1afd94d30f.js" crossorigin="anonymous"></script>
   </head>
<body>
    <form action="formCli-Alta-Modif.php" method="post" enctype="multipart/form-data">
         <label for="cli_id" style="color: #0a0a0a;">Cliente a Insertar/Actualizar:</label>
         <?php
            echo "<select id='cli_id' name='cliente_id' onchange='this.value != -1 && this.form.submit();'>
                  <option value='-1' form.reset();>Insertar</option>";
                  if ($_POST["-1"]) {
                     echo '<input type="reset" value="Restaurar">';
                     
                  }
       
            $sql1="Select * from clientes";
            echo $sql1;
            $resultado1=$base->prepare($sql1);
            $resultado1->execute();
            $resul = $resultado1->fetchall();
            $conteos = count($resul);
            for($conteo=0;$conteo < $conteos; $conteo++){
            //foreach ($resultado1 as $resul)
               echo "<option value='".$resul[$conteo]['cliente_id']."' ".($cli_id == $resul[$conteo]['cliente_id'] ? "selected" : "").">".$resul[$conteo]['cliente_id']."-".$resul[$conteo]['cliente_nombre']."</option>";
               //var_dump($resul);
            }
            echo '</select>';
            
            $formu_nombre=isset($cli_actualizar['cliente_nombre']) ? $cli_actualizar['cliente_nombre'] : "";
            $formu_dni=isset($cli_actualizar['cliente_dni']) ? $cli_actualizar['cliente_dni'] : "";
            
         ?>

      
        <fieldset style="width: 50%;"> 
            <div  style="float:left">
               <div>
                  <label for="nombre">Nombre Cliente:</label>
                  <input id="nombre" type="text" name="cliente_nombre" value="<?php echo $formu_nombre; ?>">
               </div>
               <div>
                  <label for="dni">DNI Cliente:</label>
                  <input id="dni" type="text" name="cliente_dni" value="<?php echo $formu_dni; ?>">
               </div>

               <div>
                  <label for="loc-prov">Localidad / Provincia:</label>
                     <?php 
                        //echo "<select id='id_loc' name='localidad_id' onchange='this.value != -1 && this.form.submit();'>
                        //echo "<select id='id_loc' name='localidad_id';'>
                        //echo "<select name='localidad_id';'>
                        //<option value='-1'>Insertar</option>";
                        echo "<select name='cliente_localidad';'>
                           <option value=' '> </option>";
                           $sql2="Select * from localidades inner join provincias 
                           on provincias.provincia_id=localidades.localidad_provincia";
                           $resultado2=$base->prepare($sql2);
                           $resultado2->execute();
                           $resul1 = $resultado2->fetchall();
                           $conteos = count($resul1);
                           for($conteo=0;$conteo < $conteos; $conteo++){
                              echo "<option value='".$resul1[$conteo]['localidad_id']."' ".($id_loc == $resul1[$conteo]['localidad_id'] ? "selected" : "").">".$resul1[$conteo]['localidad_id']."-".$resul1[$conteo]['localidad_nombre']."-".$resul1[$conteo]['localidad_provincia']."-".$resul1[$conteo]['provincia_nombre']."</option>";
                           }
                        echo '</select>';
                     ?>
               </div>
            </div>
        </fieldset>    
        <dd><input type="submit" value="Insertar/Actualizar" id="Enviar" name="Enviar" /></dd> 
        <div>
         <?php
            echo $mensaje;
         ?>
      </div>
    </form>
</body>
</html>  
