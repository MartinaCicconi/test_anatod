<?php
    header("Content-Type: text/html;charset=utf-8");
    require("conexion.php");  
    $modelo=new conexion();
    $base=$modelo->get_conection();
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->exec("SET CHARACTER SET utf8");
    $mensaje = "";

    $insertarCliente=isset($_POST["insertarCliente"]);
    $Prov_ID = isset($_POST["Prov_ID"]) ? ($_POST["Prov_ID"] == "-1" ? false : $_POST["Prov_ID"]) : false;

    if (!$insertarCliente && $Prov_ID){
        $sql1="Select * from provincia where Prov_ID=$Prov_ID";
        $resultado1=$base->prepare($sql1);
        $resultado1->execute();
        $Prov_actualizar=$resultado1->fetchall();
        $Prov_actualizar=$Prov_actualizar[0];
    } 

    if ($insertarCliente){
        $Valores = array();
        $Campos = array();
        $EsUpdate = $Prov_ID;

        if (isset($_POST["Cli_Nombre"])) {
            $Campos[] = "Cli_Nombre";
            $Valores[] = ($EsUpdate ? "Cli_Nombre=" : "") . "'".$_POST["Cli_Nombre"]."'";
        }
        if (isset($_POST["Cli_DNI"])) {
            $Campos[] = "Cli_DNI";
            $Valores[] = ($EsUpdate ? "Cli_DNI=" : "") . "'".$_POST["Cli_DNI"]."'";
        }
        if (isset($_POST["Prov_NombreProvincia"])) {
            $Campos[] = "Prov_NombreProvincia";
            $Valores[] = ($EsUpdate ? "Prov_NombreProvincia=" : "") . "'".$_POST["Prov_NombreProvincia"]."'";
        }

        if (count($Valores) != 0) {
            try {
                // $servername = "localhost:3306";
                // $username = "root";
                // $password = "";
                // $dbname = "test";
                // $conn = new mysqli("mysql:host=$servername;dbname=$dbname", $username, $password);
                // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $conn = new PDO("localhost:3306", 'root', '', "test");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
               
               if ($Id_Prop){
                  $sql = "UPDATE clientes SET ".implode(', ', $Valores)." WHERE Prov_ID=$Prov_ID;";
                  echo $sql;
                  $mensaje = 'Se actualizaron correctamente los datos';
               }else{
                  $sql = "INSERT INTO clientes (".implode(', ', $Campos).") VALUES (".implode(', ', $Valores).")";
                  $mensaje = 'Se insertaron correctamente los datos de la propiedad';
               }
               $conn->query($sql);
            }
            catch(PDOException $e){
               $mensaje = "Error. No se pudo generar la accion. Intente nuevamente";
            } 
        } else {
            $mensaje = "Debe completar todos los campos"; 
            }
        } 
    // echo "<script language='JavaScript'>
    // location.href = 'index.php' </script>";
?>

    <!-- <script type="text/javascript">alert("Tu mensaje");</script> -->

<!DOCTYPE HTML>
<html>  
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>Pagina Principal</title>
    <link rel="stylesheet" href="style.css">
</head>
</body>
    <div id="left">
        <form action="index.php" method="POST" > 
            <label for="NombreCliente">Nombre de Cliente:</label>
            <input id="NombreCliente" type="text" name="NombreCliente"><br>
            <label for="DNI">DNI del Cliente:</label>
            <input id="DNI" type="text" name="DNI"><br>
            <label for="NombreLocalidad">Nombre de la Localidad:</label>
                <?php
                    echo "<select id='NombreLocalidad' name='Prov_ID' onchange='this.value != -1 && this.form.submit();'>
                                <option value='-1'>Insertar</option>";
                    $sql1="Select * from provincia";
                    $resultado1=$base->prepare($sql1);
                    $resultado1->execute();
                    $resul = $resultado1->fetchall();
                    $conteos = count($resul);
                    for($conteo=0;$conteo < $conteos; $conteo++){
                        echo "<option value='".$resul[$conteo]['Prov_ID']."' ".($Prov_ID == $resul[$conteo]['Prov_ID'] ? "selected" : "").">".$resul[$conteo]['Prov_ID']."-".$resul[$conteo]['Prov_NombreProvincia']."</option>";
                    }
                    echo '</select>';
                    // $formu_Cli_Nombre=isset($Prov_actualizar['Cli_Nombre']) ? $Prov_actualizar['Cli_Nombre'] : "";
                    // $formu_Cli_DNI=isset($Prov_actualizar['Cli_DNI']) ? $Prov_actualizar['Cli_DNI'] : "";                 
                ?>
            <input type="submit" name="insertarCliente" value="Agregar Cliente">
            <?php
                echo isset($_POST["insertarCliente"]) && $_POST["insertarCliente"] == "Agregar Cliente" ? $mensaje : "";
            ?>    
        </form>
    </div>

    <div id="right">
        <form method="post" action="index.php">   
            <label for="fr-NombreProvincia">Nombre de la Provincia:</label>
            <input id="fr-NombreProvincia" type="text" name="NombreProvincia"><br>
            <label for="fr-NombreLocalidad">Nombre de la Localidad:</label>
            <input id="fr-NombreLocalidad" type="text" name="NombreLocalidad"><br>
            <label for="fr-CantClientesLocalidad">Cantidad de clientes asignados a esa localidad:</label>
            <input id="fr-CantClientesLocalidad" type="text" name="CantClientesLocalidad"><br>
            <input type="submit" name="insertarProvincia" value="Agregar Provincia">
                <?php
                    echo isset($_POST["insertarProvincia"]) && $_POST["insertarProvincia"] == "Agregar Provincia" ? $mensaje : "";
                ?>
        </form>

        <p id="botones">
            <a name="Listar Provincias" href="ListadoProvincias.php">Listar Provincias</a>
        </p> 
        
    </div>
</body>
</hmtl>