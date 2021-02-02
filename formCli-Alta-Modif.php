<?php
    include 'class.database.php';
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
        $EsUpdate = $Id_Prop;
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
              $conn = new mysqli(SELF::serverip,SELF::user,SELF::pass,SELF::db); 
              if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
              
              if ($Id_Prop){
                 $sql = "UPDATE clientes SET ".implode(', ', $Valores)." WHERE cliente_id=$cli_id;";
                 $mensaje = 'Se actualizaron correctamente los datos del clente';
              }else{
                 $sql = "INSERT INTO clientes (".implode(', ', $Campos).") VALUES (".implode(', ', $Valores).")";
                 $mensaje = 'Se insertaron correctamente los datos del cliente';
              }
              $conn->query($sql);
     
              if (!$Id_Prop) SubirImagenes($conn);
           }
           catch(PDOException $e){
              $mensaje = "Error. No se pudo generar la accion. Intente nuevamente";
              //echo $sql . "<br>" . $e->getMessage();
           }
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
         <label for="cli_id" style="color: #fff;">Cliente a Actualizar:</label>
         <?php
            echo "<select id='cli_id' name='cliente_id' onchange='this.value != -1 && this.form.submit();'>
                  <option value='-1'>Insertar</option>";
            $sql1="Select * from clientes";
            $resultado1=$base->prepare($sql1);
            $resultado1->execute();
            $resul = $resultado1->fetchall();
            $conteos = count($resul);
            for($conteo=0;$conteo < $conteos; $conteo++){
               echo "<option value='".$resul[$conteo]['cliente_id']."' ".($cli_id == $resul[$conteo]['cliente_id'] ? "selected" : "").">".$resul[$conteo]['cliente_id']."-".$resul[$conteo]['cliente_nombre']."</option>";
            }
            echo '</select>';
            $formu_nombre=isset($cli_actualizar['cliente_nombre']) ? $cli_actualizar['cliente_nombre'] : "";
            $formu_dni=isset($cli_actualizar['cliente_dni']) ? $cli_actualizar['cliente_dni'] : "";
            
            echo "<select id='id_loc' name='localidad_id' onchange='this.value != -1 && this.form.submit();'>
                        <option value='-1'>Insertar</option>";
               $sql2="Select * from localidades, provincias inner join provincias 
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

        <fieldset style="width: 50%;"> 
        <select name="cliente_localidad"> 
            <option value="-1" id="<?php echo isset($cli_actualizar['cliente_localidad']) ? ($cli_actualizar['cliente_localidad'] == "-1" ? "selected" : "") : ""; ?>">-</option> 
            <option value="1" id="<?php echo isset($cli_actualizar['cliente_localidad']) ? ($cli_actualizar['cliente_localidad'] == "1" ? "selected" : "") : ""; ?>">Localidad 1</option>
            <option value="2" id="<?php echo isset($cli_actualizar['cliente_localidad']) ? ($cli_actualizar['cliente_localidad'] == "2" ? "selected" : "") : ""; ?>">Bahia Blanca</option> 
            <option value="3" id="<?php echo isset($cli_actualizar['cliente_localidad']) ? ($cli_actualizar['cliente_localidad'] == "3" ? "selected" : "") : ""; ?>">Monte Hermoso</option> 
            <option value="4" id="<?php echo isset($cli_actualizar['cliente_localidad']) ? ($cli_actualizar['cliente_localidad'] == "4" ? "selected" : "") : ""; ?>">Bariloche</option> 
         </select>      
        </fieldset>  
        <div>
         <?php
            echo $mensaje;
         ?>
      </div>
    </form>
</body>
</html>  