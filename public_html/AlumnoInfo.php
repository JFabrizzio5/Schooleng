<?php
// Incluir archivo de conexión
include 'conexion.php';

// Variables para manejar los resultados y mensajes
$alumno_encontrado = false;
$resultado_horarios = null;
$mensaje_error = "";

// Verificar si se ha enviado un nombre de alumno
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre_alumno = $_POST['nombre_alumno'];

    // Verificar si la conexión está establecida
    if ($conn) {
        // Consulta para obtener la información del alumno utilizando LIKE
        $consulta_alumno = "SELECT * FROM usuarios WHERE tipo = 'alumno' AND nombre LIKE '%$nombre_alumno%'";
        $resultado_alumno = $conn->query($consulta_alumno);


        // Verificar si se encontró el alumno
        if ($resultado_alumno && $resultado_alumno->num_rows > 0) {
            $alumno = $resultado_alumno->fetch_assoc();
            $alumno_id = $alumno['id'];

            // Consulta para obtener los horarios y grupos del alumno
            $consulta_horarios = "SELECT horarios.dia_semana, horarios.hora_inicio, horarios.hora_fin, grupos.nombre as nombre_grupo
                                FROM horarios
                                INNER JOIN grupos ON horarios.grupo_id = grupos.id
                                INNER JOIN lista_alumnos ON grupos.id = lista_alumnos.grupo_id
                                WHERE lista_alumnos.alumno_id = $alumno_id";

            $resultado_horarios = $conn->query($consulta_horarios);

            $alumno_encontrado = true;
        } else {
            $mensaje_error = "No se encontró al alumno con el nombre proporcionado.";
        }
    } else {
        $mensaje_error = "Error en la conexión a la base de datos.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metaetiquetas y enlaces CSS -->
</head>

<body>

<div class="container mt-4">
    <h2>Buscar Información del Alumno</h2>

    <!-- Formulario de búsqueda -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="nombre_alumno">Nombre del Alumno:</label>
            <input type="text" class="form-control" id="nombre_alumno" name="nombre_alumno" required>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <?php
    // Mostrar resultados o mensaje de error
    if ($alumno_encontrado) {
        ?>
        <h3>Información del Alumno: <?php echo $alumno['nombre']; ?></h3>
        <table class="table">
            <thead>
            <tr>
                <th>Día de la Semana</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Nombre del Grupo</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Mostrar los horarios y grupos del alumno
            while ($fila = $resultado_horarios->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila['dia_semana'] . "</td>";
                echo "<td>" . $fila['hora_inicio'] . "</td>";
                echo "<td>" . $fila['hora_fin'] . "</td>";
                echo "<td>" . $fila['nombre_grupo'] . "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <?php
    } elseif (!empty($mensaje_error)) {
        echo "<p class='text-danger'>$mensaje_error</p>";
    }
    ?>
</div>

<!-- Enlaces JavaScript -->
</body>
</html>
