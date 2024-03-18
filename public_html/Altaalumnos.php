<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se enviaron datos mediante el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar datos del formulario
    $nombre = $_POST['nombre'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT); // Hash de la contraseña
    $tipo = $_POST['tipo'];

    // Preparar la consulta SQL para insertar datos en la tabla de usuarios
    $sql = "INSERT INTO usuarios (nombre, contrasena, tipo) VALUES (?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular parámetros y ejecutar la declaración
    $stmt->bind_param('sss', $nombre, $contrasena, $tipo);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header("Location: PanelAdmin.html");
        exit();
    } else {
        echo "Error al registrar alumno: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
