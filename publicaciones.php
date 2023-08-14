<?php
header("Access-Control-Allow-Origin: *"); // Cambia * por la URL de tu frontend en producción
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: http://localhost:8100"); // Cambia esta URL según tu frontend
header("Access-Control-Allow-Methods: POST, OPTIONS"); // Permitir métodos POST y OPTIONS
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

$title = $_POST['title'];
$description = $_POST['description'];
$image = basename($_FILES["image"]["name"]);

$sql = "INSERT INTO publicaciones (titulo, descripcion, imagen, status) VALUES ('$title', '$description', '$image', '1')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["message" => "Publicación creada exitosamente"]);
} else {
    echo json_encode(["error" => "Error al crear la publicación: " . mysqli_error($conn)]);
}

mysqli_close($conn);
?>
