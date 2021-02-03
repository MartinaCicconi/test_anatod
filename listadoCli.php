<?php
    /*require('class.database.php');
    $modelo=new conexion();
    $base=$modelo->get_conection();
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->exec("SET CHARACTER SET utf8");*/
    //include('class.database.php');
    //$modelo=new class_db();
    //$base=$modelo->conn;
    //$sql1="Select * from clientes ";
    //$resultado1=$base->query($sql1);
    include('class.database.php');
    $modelo=new class_db();
    $base=$modelo->get_conection();
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $base->exec("SET CHARACTER SET utf8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Listado Clientes</title>
    <script src="https://kit.fontawesome.com/1afd94d30f.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        echo 'LISTADO DE CLIENTES </br> </br>';
        $sql="Select * from clientes 
        inner join localidades on localidades.localidad_id=clientes.cliente_localidad 
        inner join provincias on provincias.provincia_id=localidades.localidad_provincia";
        /*"Select cliente_id, cliente_nombre, cliente_dni, localidad_nombre, 
        provincia_nombre from clientes, localidades, provincias inner join 
        localidades on localidades.localidad_id=clientes.cliente_localidad inner join
        provincias on provincias.provincia_id=localidades.localidad_provincia";*/
        $resultado=$base->query($sql);
        //$resultado->execute(array());
        foreach($resultado as $cliente) {
            echo '
            <tr>
                <th id="th" style="width: 10%;">ID Cliente:</th> <td>'.$cliente["cliente_id"].' --- '.'</td>
                <th id="th" style="width: 15%;">Nombre de cliente:</th> <td>'.$cliente["cliente_nombre"].' --- '.'</td>
                <th id="th" style="width: 20%;">Dni de cliente:</th> <td>'.$cliente["cliente_dni"].' --- '.'</td>
                <th id="th" style="width: 20%;">Nombre de la localidad:</th> <td>'.$cliente["localidad_nombre"].' --- '.'</td>
                <th id="th" style="width: 20%;">Nombre de la Provincia:</th> <td>'.$cliente["provincia_nombre"].' --- '.'</td>
            </tr> </br> ';
            
            /*echo '<div id="cli_id">' . $cliente['cliente_id'] . '</div>';
            echo '<div id="cli_nombre">' . $cliente['cliente_nombre'] . '</div>';
            echo '<div id="cli_dni">' . $cliente['cliente_dni'] . '</div>';
            echo '<div id="loc_nombre">' . $cliente['localidad_nombre'] . '</div>';
            echo '<div id="prov_nombre">' . $cliente['provincia_nombre'] . '</div>';*/
        }
    ?>
</body>
</html>
