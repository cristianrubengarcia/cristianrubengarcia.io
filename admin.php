<?php
session_start();
include("conexion.php");

if ($_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}
// Obtener lista de transportistas de la base de datos
$query_transportistas = "SELECT DISTINCT nombre FROM datos";
$result_transportistas = mysqli_query($conexion, $query_transportistas);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['transportista'])) {
    $transportista = mysqli_real_escape_string($conexion, $_POST['transportista']);
    $query_ordenes = "SELECT SUM(ordenes) AS total_ordenes FROM datos WHERE nombre = '$transportista'";
    $result_ordenes = mysqli_query($conexion, $query_ordenes);
    $ordenes = mysqli_fetch_assoc($result_ordenes)['total_ordenes'] ?? 0;
} else {
    $ordenes = null;
}

// Obtener lista de transportistas de la base de datos
$query_transportistas = "SELECT DISTINCT nombre FROM datos";
$result_transportistas = mysqli_query($conexion, $query_transportistas);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['transportista'])) {
    $transportista = mysqli_real_escape_string($conexion, $_POST['transportista']);
    $query_ordenes = "SELECT SUM(ordenes) AS total_ordenes FROM datos WHERE nombre = '$transportista'";
    $result_ordenes = mysqli_query($conexion, $query_ordenes);
    $ordenes = mysqli_fetch_assoc($result_ordenes)['total_ordenes'] ?? 0;
} else {
    $ordenes = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Órdenes</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <h2>Bienvenido, Administrador</h2>
    <form method="POST" action="admin.php">
        <label for="transportista">Seleccionar Transportista:</label>
        <select name="transportista" id="transportista" required>
            <option value="">Seleccione un transportista</option>
            <?php while ($row = mysqli_fetch_assoc($result_transportistas)): ?>
                <option value="<?= htmlspecialchars($row['nombre']) ?>">
                    <?= htmlspecialchars($row['nombre']) ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Consultar Órdenes</button>
        
    </form>
    
    <?php if ($ordenes !== null): ?>
        <h3>El transportista seleccionado tiene <?= $ordenes ?> órdenes solicitadas.</h3>
    <?php endif; ?>
</body>
</html>
