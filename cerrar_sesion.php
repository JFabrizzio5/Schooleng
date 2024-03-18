<?php
// Iniciar la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Destruir todas las variables de sesión
$_SESSION = array();

// Finalizar la sesión
session_destroy();

// Redirigir a la página de inicio de sesión u otra página de tu elección
header("Location: IniciarSession.html"); // Cambia "inicio_sesion.php" por tu página de inicio de sesión
exit();
?>
