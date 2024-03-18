<?php
$servername = "localhost";
$username = "id21758233_compuingles";
$password = "Alexa041006$";
$database = "id21758233_compuingles";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
