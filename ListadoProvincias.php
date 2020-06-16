<?php
    require("conexion.php");  
    $modelo=new conexion();
    $mensaje = '';
    $base=$modelo->get_conection();

    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $base->exec("SET CHARACTER SET utf8");

    $sql1="Select * from provincia";
    $resultado1=$base->prepare($sql1);
    $resultado1->execute(array());
    $conteo_props=$resultado1->rowCount();
    foreach($resultado1 as $provincia) {
        echo '
        <div id="Prov_ID">' . 'Prov_ID: ' . $provincia['Prov_ID'] . '</div>
        <div id="Prov_NombreProvincia">' . 'Prov_NombreProvincia: ' . $provincia['Prov_NombreProvincia'] . '</div>
        <div id="Prov_NombreLocalidad">' . 'Prov_NombreLocalidad: ' . $provincia['Prov_NombreLocalidad'] . '</div>
        <div id="Prov_CantClientes">' . 'Prov_CantClientes: ' . $provincia['Prov_CantClientes'] . '</div>
        ';
    }
?>
<html>
    <body>
        <p id="botones">
            <a name="Volver" href="index.php">Volver</a>
        </p> 
    </body>
</html>