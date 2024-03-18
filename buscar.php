<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];

    // Buscar información del usuario
    $sql_usuario = "SELECT * FROM usuarios WHERE nombre LIKE '%$nombre%'";
    $result_usuario = $conn->query($sql_usuario);

    if ($result_usuario->num_rows > 0) {
        echo "<div class='container mt-4'>";
        echo "<h2>Resultados para '$nombre'</h2>";

        while ($row_usuario = $result_usuario->fetch_assoc()) {
            echo "<div class='table-responsive'>";
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'>";
            echo "<tr><th>ID</th><th>Nombre</th><th>Tipo</th></tr></thead>";
            echo "<tbody>";

            echo "<tr>";
            echo "<td>{$row_usuario['id']}</td>";
            echo "<td>{$row_usuario['nombre']}</td>";
            echo "<td>{$row_usuario['tipo']}</td>";
            echo "</tr>";

            // Buscar información de lista_alumnos
            $sql_lista_alumnos = "SELECT * FROM lista_alumnos WHERE alumno_id = {$row_usuario['id']}";
            $result_lista_alumnos = $conn->query($sql_lista_alumnos);

            if ($result_lista_alumnos->num_rows > 0) {
                echo "<tr class='table-secondary'><th>Curso ID</th><th>Grupo ID</th><th>Nombre del Curso</th><th>Nombre del Grupo</th><th>Día</th><th>Hora de Inicio</th><th>Hora de Fin</th><th>Calificación</th></tr>";
                while ($row_lista_alumnos = $result_lista_alumnos->fetch_assoc()) {
                    // Buscar información del curso
                    $sql_curso = "SELECT * FROM cursos WHERE id = {$row_lista_alumnos['curso_id']}";
                    $result_curso = $conn->query($sql_curso);

                    // Buscar información del grupo
                    $sql_grupo = "SELECT * FROM grupos WHERE id = {$row_lista_alumnos['grupo_id']}";
                    $result_grupo = $conn->query($sql_grupo);

                    // Buscar horarios
                    $sql_horarios = "SELECT * FROM horarios WHERE grupo_id = {$row_lista_alumnos['grupo_id']}";
                    $result_horarios = $conn->query($sql_horarios);

                    // Buscar calificaciones
                    $sql_calificaciones = "SELECT * FROM calificaciones WHERE alumno_id = {$row_usuario['id']} AND curso_id = {$row_lista_alumnos['curso_id']}";
                    $result_calificaciones = $conn->query($sql_calificaciones);

                    echo "<tr>";
                    echo "<td>{$row_lista_alumnos['curso_id']}</td>";
                    echo "<td>{$row_lista_alumnos['grupo_id']}</td>";

                    if ($result_curso->num_rows > 0) {
                        $row_curso = $result_curso->fetch_assoc();
                        echo "<td>{$row_curso['nombre']}</td>";
                    } else {
                        echo "<td></td>";
                    }

                    if ($result_grupo->num_rows > 0) {
                        $row_grupo = $result_grupo->fetch_assoc();
                        echo "<td>{$row_grupo['nombre']}</td>";
                    } else {
                        echo "<td></td>";
                    }

                    if ($result_horarios->num_rows > 0) {
                        $row_horarios = $result_horarios->fetch_assoc();
                        echo "<td>{$row_horarios['dia_semana']}</td>";
                        echo "<td>{$row_horarios['hora_inicio']}</td>";
                        echo "<td>{$row_horarios['hora_fin']}</td>";
                    } else {
                        echo "<td></td><td></td><td></td>";
                    }

                    if ($result_calificaciones->num_rows > 0) {
                        $row_calificaciones = $result_calificaciones->fetch_assoc();
                        echo "<td>{$row_calificaciones['calificacion']}</td>";
                    } else {
                        echo "<td></td>";
                    }

                    echo "</tr>";
                }
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        }

        echo "</div>";
    } else {
        echo "<div class='container mt-4'><p>No se encontraron resultados.</p></div>";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tu título aquí</title>
    <!-- Incluye Bootstrap CSS desde CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>