<?php
// Incluir tu archivo de conexión
include 'conexion.php';

try {
    // Verificar si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $alumnoId = $_POST['alumno'];
        $cursoId = $_POST['curso'];
        $grupoId = $_POST['grupo'];

        // Consulta preparada para evitar inyecciones SQL
        $query = "INSERT INTO lista_alumnos (alumno_id, curso_id, grupo_id) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);

        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, "iii", $alumnoId, $cursoId, $grupoId);

        // Ejecutar la consulta
        $result = mysqli_stmt_execute($stmt);

        // Verificar si la consulta se ejecutó correctamente
        if ($result) {
            echo "Alumno agregado a la lista exitosamente.";
        } else {
            throw new Exception("Error al agregar alumno a la lista: " . mysqli_error($conn));
        }

        // Cerrar la consulta preparada
        mysqli_stmt_close($stmt);
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Resto de tu código HTML y formularios aquí
?>
