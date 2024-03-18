<?php
// Incluir tu archivo de conexión
include 'conexion.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $profesorId = $_POST['profesor'];
    $grupoId = $_POST['grupo'];
    $cursoId = $_POST['curso'];
    $diaSemana = $_POST['dia_semana'];
    $horaInicio = $_POST['hora_inicio'];
    $horaFin = $_POST['hora_fin'];

    // Consulta preparada para evitar inyecciones SQL
    $query = "INSERT INTO horarios (profesor_id, dia_semana, hora_inicio, hora_fin, grupo_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Vincular parámetros
    mysqli_stmt_bind_param($stmt, "isssi", $profesorId, $diaSemana, $horaInicio, $horaFin, $grupoId);

    // Ejecutar la consulta
    $result = mysqli_stmt_execute($stmt);

    // Verificar si la consulta se ejecutó correctamente
    if ($result) {
        echo "Horario creado exitosamente.";
    } else {
        echo "Error al crear el horario: " . mysqli_error($conn);
    }

    // Cerrar la consulta preparada
    mysqli_stmt_close($stmt);
}

// Resto de tu código HTML y formularios aquí
?>
