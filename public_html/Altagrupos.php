<?php
// Incluir el archivo de conexión a la base de datos
include('conexion.php');

// Obtener datos del formulario
$curso_id = $_POST['curso'];
$nombre_grupo = $_POST['nombre_grupo'];

// Insertar el grupo en la base de datos
$queryInsertGrupo = "INSERT INTO grupos (curso_id, nombre) VALUES ($curso_id, '$nombre_grupo')";
$resultInsertGrupo = mysqli_query($conn, $queryInsertGrupo);

if ($resultInsertGrupo) {
    echo "Grupo subido correctamente.";
} else {
    echo "Error al subir el grupo: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>
