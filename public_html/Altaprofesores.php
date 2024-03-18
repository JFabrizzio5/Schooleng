<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se enviaron datos mediante el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar datos del formulario
    $nombreProfesor = $_POST['nombreProfesor'];
    $contrasenaProfesor = password_hash($_POST['contrasenaProfesor'], PASSWORD_DEFAULT); // Hash de la contraseña
    $tipo = $_POST['tipo'];

    // Preparar la consulta SQL para insertar datos en la tabla de usuarios
    $sql = "INSERT INTO usuarios (nombre, contrasena, tipo) VALUES (?, ?, ?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular parámetros y ejecutar la declaración
    $stmt->bind_param('sss', $nombreProfesor, $contrasenaProfesor, $tipo);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Profesor registrado correctamente.";
    } else {
        echo "Error al registrar profesor: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
