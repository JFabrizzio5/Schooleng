<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se enviaron datos mediante el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar datos del formulario
    $nombreCurso = $_POST['nombreCurso'];

    // Preparar la consulta SQL para insertar datos en la tabla de cursos
    $sql = "INSERT INTO cursos (nombre) VALUES (?)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular parámetros y ejecutar la declaración
    $stmt->bind_param('s', $nombreCurso);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir a PanelAdmin.html
        header("Location: PanelAdmin.html");
        exit(); // Importante: asegúrate de salir después de la redirección
    } else {
        echo "Error al registrar curso: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
