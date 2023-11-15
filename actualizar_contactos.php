<?php
header("Access-Control-Allow-Origin: *"); // Cambia * por la URL de tu frontend en producción
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Origin: http://localhost:4200"); // Cambia esta URL según tu frontend
header("Access-Control-Allow-Methods: PUT, OPTIONS"); // Permitir métodos PUT y OPTIONS
header("Access-Control-Allow-Headers: Content-Type"); // Permitir el encabezado Content-Type
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$database = "atencion_ciudadana";
$username = "root";
$password = "";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Lo sentimos tenemos problemas de conexión: " . $conn->connect_error);
}

// Recibir los datos del cuerpo de la solicitud PUT
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['nombre']) && isset($data['telefono']) && isset($data['status'])) {
    $id = $data['id'];
    $nombre = $data['nombre'];
    $telefono = $data['telefono'];
    $status = $data['status'];

    // Consulta SQL para actualizar el contacto por ID
    $sql = "UPDATE `contactos` SET `nombre`='$nombre', `telefono`='$telefono', `status`='$status' WHERE `id`='$id'";

    if ($conn->query($sql) === TRUE) {
        $response = array('message' => 'Contacto actualizado exitosamente');
        echo json_encode($response);
    } else {
        $response = array('error' => 'Error al actualizar el contacto: ' . $conn->error);
        echo json_encode($response);
    }
} else {
    $response = array('error' => 'Datos incompletos');
    echo json_encode($response);
}

$conn->close();
?>
