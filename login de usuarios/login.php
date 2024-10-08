<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo_electronico'];
    $contraseña = $_POST['contraseña'];
    
  


    $archivo_json = 'login.js';
    
    if (file_exists($archivo_json)) {
        $contenido_actual = file_get_contents($archivo_json);
        $array_datos = json_decode($contenido_actual, true);
    } else 
        $array_datos = array();

        $datos = array(
            'correo' => $correo,
            'contraseña' => $contraseña
           );
    
    
        $array_datos[] = $datos;
    
        file_put_contents($archivo_json, json_encode($array_datos, JSON_PRETTY_PRINT));
    
        echo "<h2>Inicio de sesion exitoso:</h2>";
        echo "Correo Electronico: " . $correo . "<br>";
        echo "Contraseña: " . $contraseña . "<br>";
        
        }else {
        echo "Todos los campos son obligatorios.";
    }
 


?>
