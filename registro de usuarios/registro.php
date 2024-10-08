<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $_POST['nombre_completo'];
    $correo = $_POST['correo_electronico'];
    $contraseña = $_POST['contraseña'];
    
 
    $archivo_json = 'registro.js';

    if (file_exists($archivo_json)) {
        $contenido_actual = file_get_contents($archivo_json);
        $array_datos = json_decode($contenido_actual, true);
    } else 
        $array_datos = array();

        $datos = array(
            'nombre'=> $nombre,
            'correo '=> $correo,
            'contraseña' => $contraseña
        );

        $array_datos[] = $datos;

        file_put_contents($archivo_json, json_encode($array_datos, JSON_PRETTY_PRINT));

        echo "<h2>Datos recibidos y guardados correctamente:</h2>";
        echo "Nombre: " . $nombre . "<br>";
        echo "Correo Electrónico: " . $correo . "<br>";
        echo "Contraseña: " . $contraseña . "<br>";
    }else {
        echo "Todos los campos son obligatorios.";
    }


?>


