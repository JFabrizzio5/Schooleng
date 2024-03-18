<?php
// Tu archivo de conexión a la base de datos
include 'conexion.php';

// Verificamos la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Resto del código...
    $nombreProfesor = $_POST['nombreProfesor'];
    $materiaProfesor = $_POST['materiaProfesor'];
    $diaProfesor = $_POST['diaProfesor'];
    $horariosProfesor = $_POST['horariosProfesor'];
    $passwordProfesor = password_hash($_POST['passwordProfesor'], PASSWORD_DEFAULT);

    // Inserta los datos en la tabla de usuarios
    $query = "INSERT INTO usuarios (nombre, contrasena, tipo) VALUES ('$nombreProfesor', '$passwordProfesor', 'profesor')";
    $conn->query($query);

    // Obtén el ID del profesor recién insertado
    $profesorId = $conn->insert_id;

    // Inserta la materia que enseña en la tabla de horarios para cada día y hora seleccionada
    foreach ($horariosProfesor as $hora) {
        $query_horario = "INSERT INTO horarios (profesor_id, dia_semana, hora_inicio, hora_fin) VALUES ('$profesorId', '$diaProfesor', '$hora:00:00', '$hora:59:59')";
        $conn->query($query_horario);
    }

    // Cierra la conexión
    $conn->close();

    // Redirige a alguna página después de agregar el profesor
    header("Location: Altas.html");
    exit();
}
?>
