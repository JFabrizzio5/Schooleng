<?php
// Incluir el archivo de conexión a la base de datos
include('conexion.php');

// Obtener datos del formulario
$profesor_id = $_POST['profesor'];
$grupo_id = $_POST['grupo'];
$curso_id = $_POST['curso'];
$dia_semana = $_POST['dia_semana'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fin = $_POST['hora_fin'];

// Insertar el horario en la base de datos
$queryInsertHorario = "INSERT INTO horarios (profesor_id, dia_semana, hora_inicio, hora_fin, grupo_id, curso_id) VALUES ($profesor_id, '$dia_semana', '$hora_inicio', '$hora_fin', $grupo_id, $curso_id)";
$resultInsertHorario = mysqli_query($conn, $queryInsertHorario);

if ($resultInsertHorario) {
    echo "Horario subido correctamente.";
} else {
    echo "Error al subir el horario: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>
