<?php

    // nos conectamos a la base de datos
    $mysqli = new mysqli('localhost', 'root', '', 'votacion');

    // verificamos la conexión 
    if (mysqli_connect_errno()) {
        printf("La conexión falló: %s\n", mysqli_connect_error());
        exit();
    }

    // si está seteada la variable nombre
    // es que se presionó alguno de los botones
    if(isset($_POST['nombre'])) {
        $id=mysql_escape_String($_POST['id']);
        $nombre=mysql_escape_String($_POST['nombre']);

        // actualizamos el valor del video
        $query = "UPDATE videos SET $nombre = $nombre + 1 WHERE id = $id";
        $mysqli->query($query);
    }

    // si está seteada la variable id
    // es que se presionó alguno de los botones
    // o la página se acaba de cargar
    if(isset($_POST['id'])) {

        // obtenemos los votos del video
        $id=mysql_escape_String($_POST['id']);
        $query2 = "SELECT `bueno`,`malo` FROM `videos` WHERE `id` = $id";
        $resultado = $mysqli->query($query2); 

        if($resultado !== FALSE) {
            while ($obj = $resultado->fetch_object()) {

                // cantidad de votos positivos y negativos
                $bueno = $obj->bueno;
                $malo = $obj->malo;
            }   

            // total de votos y el porcentaje de cada uno
            $total=$bueno+$malo; 
            $buenoPorcentaje=floor(($bueno*99)/$total); 
            $maloPorcentaje=floor(($malo*99)/$total); 

            // se devuelve el resultado
            // creamos los elementos HTML necesarios para que jQuery
            // los incruste en la página    
            ?>
            <b><?php echo $total; ?></b>
            <div id="votos">
                <div id="barraverde" style="width:<?php echo $buenoPorcentaje; ?>%"></div>
                <div id="barraroja" style="width:<?php echo $maloPorcentaje; ?>%"></div>
            </div>
            <?php
        }
    }
?>
