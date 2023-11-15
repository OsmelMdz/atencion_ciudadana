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

    if (!empty($data->nombre_completo) && !empty($data->telefono) && !empty($data->email)) {
        $nombre_completo = $data->nombre_completo;
        $telefono = $data->telefono;
        $email = $data->email;

        // Verificar si el usuario ya existe en la base de datos
        $check_query = "SELECT * FROM registro WHERE email = '$email'";
        $result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($result) > 0) {
            echo json_encode(["error" => "El usuario ya está registrado"]);
        } else {
            // Registro de usuario en la base de datos
            $sql = "INSERT INTO registro (nombre_completo, telefono, email) VALUES ('$nombre_completo', '$telefono', '$email')";

            if (mysqli_query($conn, $sql)) {
                echo json_encode(["message" => "Usuario registrado exitosamente"]);
            } else {
                echo json_encode(["error" => "Error al registrar usuario: " . mysqli_error($conn)]);
            }
        }
    } else {
        echo json_encode(["error" => "Todos los campos son obligatorios"]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Manejar las solicitudes OPTIONS para permitir el acceso CORS
    header("HTTP/1.1 200 OK");
}

mysqli_close($conn);
?>
