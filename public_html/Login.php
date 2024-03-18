<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';
session_start(); // Iniciar la sesión

// Verificar si se enviaron datos mediante el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recuperar datos del formulario
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

    // Preparar la consulta SQL para obtener datos del usuario
    $sql = "SELECT id, nombre, contrasena, tipo FROM usuarios WHERE nombre = ? LIMIT 1";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Vincular parámetros y ejecutar la declaración
    $stmt->bind_param('s', $nombre);

    // Ejecutar la consulta
    $stmt->execute();

    // Vincular el resultado
    $stmt->bind_result($id, $nombre_db, $contrasena_db, $tipo_usuario);

    // Obtener el resultado
    $stmt->fetch();

    // Verificar si la contraseña proporcionada es correcta
    if (password_verify($contrasena, $contrasena_db)) {
        // Iniciar la sesión y almacenar datos del usuario
        $_SESSION['id'] = $id;
        $_SESSION['nombre'] = $nombre_db;
        $_SESSION['tipo_usuario'] = $tipo_usuario;

        // Redireccionar según el tipo de usuario
        switch ($tipo_usuario) {
            case 'admin':
                header("Location: PanelAdmin.php");
                break;
            case 'profesor':
                header("Location: VistasProfesores/VistaProfesores.php");
                break;
            case 'alumno':
                header("Location: VistaAlumnos/AlumnoVista.php");
                break;
            default:
                echo "Invalid role";
                break;
        }

        exit();
    } else {
        echo "Nombre de usuario o contraseña incorrectos";
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
