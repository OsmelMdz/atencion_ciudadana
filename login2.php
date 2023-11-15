<?php
header("Access-Control-Allow-Origin: *"); // Cambia * por la URL de tu frontend en producción
header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Origin: http://localhost:4200"); // Cambia esta URL según tu frontend
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

session_start();

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $username = isset($data['username']) ? $data['username'] : '';
    $password = isset($data['password']) ? $data['password'] : '';

    if ($username === 'Admin' && $password === 'admin@123') {
        $_SESSION['admin'] = true;
        $response['success'] = true;
    } else {
        $response['success'] = false;
        $response['error_message'] = "Usuario y Contraseña incorrecta. Por favor, intenta nuevamente.";
    }
} else {
    $response['success'] = false;
    $response['error_message'] = "Método de solicitud no permitido.";
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo json_encode($response);
?>