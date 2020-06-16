<?php
    $NombreCliente = $_POST["NombreCliente"];
    $DNI = $_POST["DNI"];
    $NombreLocalidad = $_POST["NombreLocalidad"];
    $NombreProvincia = $_POST["NombreProvincia"];
   

    $servername='anatodtest.c75o4mima6rb.us-east-1.rds.amazonaws.com';
    $user='test';
    $password="";
    $db='test_anatod';

    try {
        $conn = mysqli_connect($servername, $user, $password, $db);
        $conn->set_charset("utf8");

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO clientes (Cli_Nombre, Cli_DNI, Cli_NombreLocalidad, Cli_NombreProvincia)
        VALUES ('$NombreCliente', '$DNI', '$NombreLocalidad', '$NombreProvincia')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "Se han insertado correctamente los datos";
        }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }

    $conn = null;

  echo "<script language='JavaScript'>
location.href = 'Admin.php' </script>";
?>

    <script type="text/javascript">alert("Tu mensaje");</script>