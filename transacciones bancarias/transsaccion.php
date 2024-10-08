<?php
session_start();


if (!isset($_SESSION['usuario_id'])) {
    echo "Debe iniciar sesión para realizar una transacción.";
    exit();


$cuenta_remitente = $_SESSION['numero_cuenta'];

$cuenta_destinatario = $_POST['cuenta_destinatario'];
$monto = $_POST['monto'];
$concepto = $_POST['concepto'];



$archivo_json = 'transacciones.js';

if (file_exists($archivo_json)) {
    $contenido_actual = file_get_contents($archivo_json);
    $array_datos = json_decode($contenido_actual, true);
} else 
    $array_datos = array();
    
    $datos = array(
        'Cuenta Destinatorio'=> $cuenta_destinatario,
        'Cuenta Remitente '=> $cuenta_remitente,
        'Monto' => $monto,
        'Concepto' => $concepto,
    );


    $array_datos[] = $datos;

    file_put_contents($archivo_json, json_encode($array_datos, JSON_PRETTY_PRINT));

    echo "<h2>Transaccion exitosa:</h2>";
    echo "Cuenta del Destinatario: " . $cuenta_destinatario . "<br>";
    echo "Monto a Transferir: " . $monto . "<br>";
    echo "Concepto: " . $concepto . "<br>";
}else {
    echo "Todos los campos son obligatorios.";
 }



?>
