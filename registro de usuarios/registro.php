<?php
require 'conexion_bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
    $nombre = $_POST['nombre_completo'];
    $correo = $_POST['correo_electronico'];
    $contraseña = $_POST['contraseña'];
    
    function getUsuarios() 
        $db = getBanco();
       $hashedPassword = password_hash($contraseña, PASSWORD_DEFAULT);
                    
     
       $stmt = $this->pdo->prepare('INSERT INTO usuarios (nombre_completo, contraseña) VALUES (:nombre_completo, :contraseña)');

       $stmt->execute(['nombre_completo' => $nombre, 'contraseña' => $hashedPassword]);


?>
