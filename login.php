<?php
include("conexion.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conexion, $_POST['username']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);

    $query = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $user['username'];

        if ($user['role'] === 'admin') {
            header('Location: admin.php');
        } else {
            header('Location: user.php');
        }
    } else {
        echo "<p>Usuario o contraseña incorrectos</p>";
    }
}
?>
