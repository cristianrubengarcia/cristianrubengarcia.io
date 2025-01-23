<?php
// conexion.php
$conexion = mysqli_connect("localhost", "root", "", "registro");
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>