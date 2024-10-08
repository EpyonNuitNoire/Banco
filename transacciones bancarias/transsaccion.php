<?php
session_start();
require 'conexion_bd.php';

if (!isset($_SESSION['usuario_id'])) {
    echo "Debe iniciar sesión para realizar una transacción.";
    exit();
}

$cuenta_remitente = $_SESSION['numero_cuenta'];

$cuenta_destinatario = $_POST['cuenta_destinatario'];
$monto = $_POST['monto'];
$concepto = $_POST['concepto'];

if ($monto <= 0) {
    echo "El monto debe ser mayor que 0.";
    exit();
}

$query = "SELECT * FROM usuarios WHERE numero_cuenta = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $cuenta_destinatario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "La cuenta del destinatario no existe.";
    exit();
}

$query = "SELECT saldo FROM usuarios WHERE numero_cuenta = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $cuenta_remitente);
$stmt->execute();
$result = $stmt->get_result();
$remitente = $result->fetch_assoc();

$saldo_remitente = $remitente['saldo'];

if ($saldo_remitente < $monto) {
    echo "Saldo insuficiente.";
    exit();
}

$conn->autocommit(FALSE); 

$query = "UPDATE usuarios SET saldo = saldo - ? WHERE numero_cuenta = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ds", $monto, $cuenta_remitente);
$stmt->execute();

$query = "UPDATE usuarios SET saldo = saldo + ? WHERE numero_cuenta = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ds", $monto, $cuenta_destinatario);
$stmt->execute();

$query = "INSERT INTO transacciones (cuenta_remitente, cuenta_destinatario, monto, concepto) 
          VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssds", $cuenta_remitente, $cuenta_destinatario, $monto, $concepto);

if ($stmt->execute()) {
    $conn->commit(); 
    echo "Transacción realizada con éxito.";
} else {
    $conn->rollback(); 
    echo "Error en la transacción.";
}

$stmt->close();
$conn->close();
?>
