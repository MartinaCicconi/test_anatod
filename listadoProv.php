<?php
    include('class.database.php');
    $modelo=new class_db();
    $base=$modelo->get_conection();
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->exec("SET CHARACTER SET utf8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Listado Localidades</title>
    <script src="https://kit.fontawesome.com/1afd94d30f.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
         echo 'LISTADO DE LOCALIDADES </br> </br>';
        //$sql="Select * from localidades COUNT(clientes.cliente_id) AS cant_cliente inner join provincias 
          // on provincias.provincia_id=localidades.localidad_provincia";
        $sql="SELECT provincias.provincia_id, localidades.localidad_nombre, provincias.provincia_nombre, 
        COUNT(clientes.cliente_id) AS cant_clientes FROM localidades 
        INNER JOIN provincias on provincias.provincia_id=localidades.localidad_provincia 
        INNER JOIN clientes on clientes.cliente_localidad=localidades.localidad_id 
        GROUP BY clientes.cliente_localidad ORDER BY localidades.localidad_id";
        //$sql="Select * from localidades 
        //inner join clientes on clientes.cliente_localidad=localidades.localidad_id";
        $resultado=$base->query($sql);
        //$resultado->execute(array());
        foreach($resultado as $prov) {
            echo '
            <tr>
            <th id="th" style="width: 10%;">ID Provincia:</th> <td>'.$prov["provincia_id"].' - '.'</td>
            <th id="th" style="width: 15%;">Nombre de Provincia:</th> <td>'.$prov["provincia_nombre"].' - '.'</td>
            <th id="th" style="width: 20%;">Nombre de Localidad:</th> <td>'.$prov["localidad_nombre"].' - '.'</td>
            <th id="th" style="width: 20%;">Cantidad de clientes asignados a esa localidad:</th> <td>'.$prov["cant_clientes"].' - '.'</td>
            </tr> </br> ';
           // echo '<div id="prov_id">' . $prov['provincia_id'] . '</div>';
           // echo '<div id="prov_nombre">' . $prov['provincia_nombre'] . '</div>';
           // echo '<div id="loc_nombre">' . $prov['localidad_nombre'] . '</div>';

           /* $sql1="Select * from clientes inner join localidades 
            on localidades.localidad_id=clientes.cliente_localidad";
            $resultado1=$base->prepare($sql1);
            $resultado1->execute(array());
            $conteo=$resultado->rowCount();
            if ($conteo==0){
                $mensaje = 'No hay clientes en esa localidad';
            } else {
                echo 'La cantidad de clientes en esa localidad es ' . $conteo;
            } */
        }
    ?>
</body>
</html>
