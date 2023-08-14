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

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $contactos = array();
    
    while ($row = $result->fetch_assoc()) {
        $contactos[] = $row;
    }
    
    echo json_encode($contactos);
} else {
    echo json_encode(array());
}

$conn->close();
?>