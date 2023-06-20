<?php
require_once('conexion.php');

$idSancion = $_GET['idSancion'];
$estado = $_GET['estado'];

// Ejecutar la consulta UPDATE para actualizar el estado en la base de datos
$query = "UPDATE sanciones SET estado = ? WHERE id_sancion = ?";
$stmt = $db->prepare($query);
$stmt->execute([$estado, $idSancion]);

// Redirigir de vuelta al archivo principal
header('Location: ../sanciones.php');
exit;
?>