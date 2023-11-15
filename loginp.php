<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$database = "atencion_ciudadana";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Lo sentimos, tenemos problemas de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->nombre_completo) && !empty($data->email)) {
        $nombre_completo = $data->nombre_completo;
        $email = $data->email;

        // Verificar si el usuario existe en la base de datos
        $sql = "SELECT * FROM registro WHERE nombre_completo = '$nombre_completo' AND email = '$email'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // El usuario existe en la base de datos
            echo json_encode(["message" => "Inicio de sesión exitoso"]);
        } else {
            echo json_encode(["error" => "Nombre completo y correo electrónico no encontrados en la base de datos"]);
        }
    } else {
        echo json_encode(["error" => "Nombre completo y correo electrónico son obligatorios"]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Manejar las solicitudes OPTIONS para permitir el acceso CORS
    header("HTTP/1.1 200 OK");
}

mysqli_close($conn);
?>
