<?php
    include 'class.database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Listado Clientes</title>
    <script src="https://kit.fontawesome.com/1afd94d30f.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $sql="Select cliente_id, cliente_nombre, cliente_dni, localidad_nombre, 
        provincia_nombre from clientes, localidades, provincias inner join 
        localidades on localidades.localidad_id=clientes.cliente_localidad inner join
        provincias on provincias.provincia_id=localidades.localidad_provincia";
        $resultado=$base->prepare($sql);
        $resultado->execute(array());
        foreach($resultado as $cliente) {
            echo '<div id="cli_id">' . $cliente['cliente_id'] . '</div>';
            echo '<div id="cli_nombre">' . $cliente['cliente_nombre'] . '</div>';
            echo '<div id="cli_dni">' . $cliente['cliente_dni'] . '</div>';
            echo '<div id="loc_nombre">' . $cliente['localidad_nombre'] . '</div>';
            echo '<div id="prov_nombre">' . $cliente['provincia_nombre'] . '</div>';
        }
    ?>
</body>
</html>
