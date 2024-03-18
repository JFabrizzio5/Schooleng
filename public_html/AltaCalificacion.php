<?php
// Incluir el archivo de conexión a la base de datos
include('conexion.php');

// Obtener datos del formulario
$alumno_id = $_POST['alumno'];
$curso_id = $_POST['curso'];
$calificacion = $_POST['calificacion'];

// Insertar la calificación en la base de datos
$queryInsertCalificacion = "INSERT INTO calificaciones (alumno_id, curso_id, calificacion) VALUES ($alumno_id, $curso_id, $calificacion)";
$resultInsertCalificacion = mysqli_query($conn, $queryInsertCalificacion); // Utiliza $conn en lugar de $conexion

if ($resultInsertCalificacion) {
    echo "Calificación subida correctamente.";
} else {
    echo "Error al subir la calificación: " . mysqli_error($conn); // Utiliza $conn en lugar de $conexion
}

// Cerrar la conexión
mysqli_close($conn); // Utiliza $conn en lugar de $conexion
?>
