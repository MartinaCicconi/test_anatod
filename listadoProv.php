<?php
    include 'class.database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Listado Provincias y Localidades</title>
    <script src="https://kit.fontawesome.com/1afd94d30f.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $sql="Select * from localidades, provincias inner join provincias 
            on provincias.provincia_id=localidades.localidad_provincia";
        $resultado=$base->prepare($sql);
        $resultado->execute(array());
        foreach($resultado as $prov) {
            echo '<div id="prov_id">' . $prov['provincia_id'] . '</div>';
            echo '<div id="prov_nombre">' . $prov['provincia_nombre'] . '</div>';
            echo '<div id="loc_nombre">' . $prov['localidad_nombre'] . '</div>';

            $sql1="Select cliente_id, localidad_id from clientes, localidades
            inner join localidades on localidades.localidad_id=clientes.cliente_localidad";
            $resultado1=$base->prepare($sql1);
            $resultado1->execute(array());
            $conteo_props=$resultado->rowCount();
            if ($conteo_props==0){
                $mensaje = 'No hay clientes en esa localidad';
            } else if {
                echo 'La cantidad de clientes en esa localidad es ' + $conteo_props;
            }
        }
    ?>
</body>
</html>
