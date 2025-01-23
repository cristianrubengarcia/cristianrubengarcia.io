<?php
session_start();
if ($_SESSION['role'] !== 'user') {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
</head>
<body>
    <h2>Solicitud de Órdenes</h2>
    <form action="registro.php" method="post">
        <label for="name">Nombre del Transportista:</label>
        <input type="text" name="name" id="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="ordenes">Cantidad de Órdenes Necesarias:</label>
        <input type="number" name="ordenes" id="ordenes" required>
        <button type="submit">Solicitar</button>
    </form>
</body>
</html>
