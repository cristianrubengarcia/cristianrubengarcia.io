<?php
include("conexion.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $ordenes = (int)$_POST['ordenes'];
    $fecha = date("Y-m-d");

    $query = "INSERT INTO datos (nombre, email, ordenes, fecha) VALUES ('$name', '$email', $ordenes, '$fecha')";
    if (mysqli_query($conexion, $query)) {
        echo "<p>Registro exitoso</p>";
    } else {
        echo "<p>Error al registrar: " . mysqli_error($conexion) . "</p>";
    }
}
?>