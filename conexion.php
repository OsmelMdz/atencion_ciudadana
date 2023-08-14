<?php
header("Access-Control-Allow-Origin: *"); // Cambia * por la URL de tu frontend en producción
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$database = "atencion_ciudadana";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Lo sentimos tenemos problemas de conexión: " . $conn->connect_error);
}
echo "Hay conexión";
mysqli_close($conn);
?>
