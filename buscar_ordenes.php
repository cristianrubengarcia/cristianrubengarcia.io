<?php
include('conexion.php'); // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id']; // ID del transportista a buscar

    // Realizar consulta para obtener todos los campos de la tabla 'datos' donde el ID coincida
    $query = "SELECT * FROM datos WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('i', $id); // 'i' para entero, si el ID es un número
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Mostrar los datos en una tabla HTML
        echo "<h3>Detalles del transportista con ID '$id':</h3>";
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Transportista</th>
                    <th>Ordenes</th>
                    <th>Fecha de Registro</th>
                    <th>Otro Campo</th>
                    <!-- Agregar más columnas si es necesario -->
                </tr>";

        // Mostrar los valores de todos los campos
        $row = $result->fetch_assoc();
        echo "<tr>";
        foreach ($row as $field => $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>"; // Escapar valores para seguridad
        }
        echo "</tr>";
        echo "</table>";
    } else {
        echo "No se encontraron datos para el transportista con ID '$id'.";
    }
} else {
    echo "Por favor ingrese un ID válido.";
}
?>
