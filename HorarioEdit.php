<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Your existing head content -->
</head>

<body>

    <!-- Navbar Start -->
    <!-- Your existing navbar content -->
    <!-- Navbar End -->

    <!-- Header Start -->
    <!-- Your existing header content -->
    <!-- Header End -->

    <!-- Category Start -->
    <div class="container-fluid py-5">
        <div class="container pt-3 pb-3">
            <?php
            // Include the database connection file
            include 'conexion.php';

            // Check if the form for editing or deleting schedules is submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['editar_horario'])) {
                    // Process the schedule editing
                    foreach ($_POST['nuevo_horario'] as $horario_id => $nuevo_horario) {
                        $nuevo_profesor_id = $_POST['nuevo_profesor'][$horario_id];
                        $nuevo_grupo_id = $_POST['nuevo_grupo'][$horario_id];
                        actualizarHorario($conn, $horario_id, $nuevo_horario, $nuevo_profesor_id, $nuevo_grupo_id);
                    }
                } elseif (isset($_POST['eliminar_horario'])) {
                    // Process the schedule deletion
                    $horario_id = $_POST['horario_id'];
                    eliminarHorario($conn, $horario_id);
                }
            }

            // Fetch the schedules with the professor's name and group name
            $query = "SELECT horarios.id, usuarios.nombre as profesor, grupos.nombre as grupo, dia_semana, hora_inicio, hora_fin FROM horarios
                      INNER JOIN usuarios ON horarios.profesor_id = usuarios.id
                      INNER JOIN grupos ON horarios.grupo_id = grupos.id";

            // Use $conn instead of $conexion
            $resultado = mysqli_query($conn, $query);

            if (!$resultado) {
                die("Error en la consulta: " . mysqli_error($conn));
            }

            // Display the table with schedules and the editing/deleting form
            echo "<form method='post' action='EditarHorario.php'>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Profesor</th>
                        <th>Grupo</th>
                        <th>Día de la semana</th>
                        <th>Hora de inicio</th>
                        <th>Hora fin</th>
                        <th>Acciones</th>
                    </tr>";

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>
                        <td>{$fila['id']}</td>
                        <td>
                            <select name='nuevo_profesor[{$fila['id']}]'>";

                // Get the list of professors for the select
                $queryProfesores = "SELECT id, nombre FROM usuarios WHERE tipo = 'profesor'";
                $resultProfesores = mysqli_query($conn, $queryProfesores);

                while ($profesor = mysqli_fetch_assoc($resultProfesores)) {
                    $selectedProfesor = ($profesor['id'] == $fila['profesor']) ? 'selected' : '';
                    echo "<option value='{$profesor['id']}' $selectedProfesor>{$profesor['nombre']}</option>";
                }

                echo "</select>
                        </td>
                        <td>
                            <select name='nuevo_grupo[{$fila['id']}]'>";

                // Get the list of groups for the select
                $queryGrupos = "SELECT id, nombre FROM grupos";
                $resultGrupos = mysqli_query($conn, $queryGrupos);

                while ($grupo = mysqli_fetch_assoc($resultGrupos)) {
                    $selectedGrupo = ($grupo['id'] == $fila['grupo_id']) ? 'selected' : '';
                    echo "<option value='{$grupo['id']}' $selectedGrupo>{$grupo['nombre']}</option>";
                }

                echo "</select>
                        </td>
                        <td><input type='number' name='nuevo_horario[{$fila['id']}][dia_semana]' value='{$fila['dia_semana']}' min='1' max='7' required></td>
                        <td><input type='time' name='nuevo_horario[{$fila['id']}][hora_inicio]' value='{$fila['hora_inicio']}' required></td>
                        <td><input type='time' name='nuevo_horario[{$fila['id']}][hora_fin]' value='{$fila['hora_fin']}' required></td>
                        <td>
                            <input type='submit' name='editar_horario' value='Editar'>
                            <input type='submit' name='eliminar_horario' value='Eliminar'>
                            <input type='hidden' name='horario_id' value='{$fila['id']}'>
                        </td>
                      </tr>";
            }

            echo "</table>";
            echo "</form>";

            // Close the database connection
            mysqli_close($conn);

            // Function to update the schedule
            function actualizarHorario($conn, $horario_id, $nuevo_horario, $nuevo_profesor_id, $nuevo_grupo_id) {
                // Avoid SQL injection using prepared statements
                $query = "UPDATE horarios SET dia_semana = ?, hora_inicio = ?, hora_fin = ?, profesor_id = ?, grupo_id = ? WHERE id = ?";
                $stmt = mysqli_prepare($conn, $query);

                // Check if the statement preparation was successful
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sssiii", $nuevo_horario['dia_semana'], $nuevo_horario['hora_inicio'], $nuevo_horario['hora_fin'], $nuevo_profesor_id, $nuevo_grupo_id, $horario_id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                } else {
                    die("Error al preparar la sentencia: " . mysqli_error($conn));
                }
            }

            // Function to delete the schedule
            function eliminarHorario($conn, $horario_id) {
                // Avoid SQL injection using prepared statements
                $query = "DELETE FROM horarios WHERE id = ?";
                $stmt = mysqli_prepare($conn, $query);

                // Check if the statement preparation was successful
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "i", $horario_id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                } else {
                    die("Error al preparar la sentencia: " . mysqli_error($conn));
                }
            }
            ?>
        </div>
    </div>
    <!-- Category End -->

    <!-- Your existing scripts and footer content -->

</body>

</html>
