<?php
$user = 'root';
$pass = ''; // Déjalo vacío
$db   = 'frame2pm';
$host = '127.0.0.1';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
} else {
    echo "¡Conexión exitosa! El servidor está aceptando root sin contraseña.";
}
?>