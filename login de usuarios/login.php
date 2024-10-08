<?php
require 'conexion_bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo_electronico'];
    $contraseña = $_POST['contraseña'];
    
    $query = "SELECT * FROM usuarios WHERE correo_electronico = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
        
        if (password_verify($contraseña, $usuario['contraseña'])) {
            echo "Login exitoso. Bienvenido " . $usuario['nombre_completo'];
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Correo no registrado.";
    }
    
    $stmt->close();
    $conn->close();
}
?>
