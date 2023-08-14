<?php
header("Access-Control-Allow-Origin: *"); // Cambia * por la URL de tu frontend en producción
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS, DELETE"); // Permitir métodos POST, OPTIONS y DELETE
header("Access-Control-Allow-Headers: Content-Type"); // Permitir el encabezado Content-Type
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$database = "atencion_ciudadana";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Lo sentimos tenemos problemas de conexión: " . $conn->connect_error);
}

$id = $_GET['id']; // Obtener el ID del contacto a eliminar desde la URL

$sql = "DELETE FROM contactos WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["message" => "Contacto eliminado exitosamente"]);
} else {
    echo json_encode(["error" => "Error al eliminar el contacto: " . mysqli_error($conn)]);
}

mysqli_close($conn);
?>
