<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ECOURSES - Online Courses HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid d-none d-lg-block">
    <div class="row align-items-center py-4 px-xl-5">
        <div class="col-lg-3">
            <a href="" class="text-decoration-none">
                <h1 class="m-0"><span class="text-primary">COMPU</span>INGLES</h1>
            </a>
        </div>
        <div class="col-lg-3 text-right">
            <div class="d-inline-flex align-items-center">
                <i class="fa fa-2x fa-map-marker-alt text-primary mr-3"></i>
                <div class="text-left">
                    <h6 class="font-weight-semi-bold mb-1">Our Office</h6>
                    <small> Morelos · Puebla, Mexico · Estado de México · Hidalgo, Mexico · Córdoba, Veracruz de Ignacio de la Llave</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 text-right">
            <div class="d-inline-flex align-items-center">
                <i class="fa fa-2x fa-envelope text-primary mr-3"></i>
                <div class="text-left">
                    <h6 class="font-weight-semi-bold mb-1">Email Us</h6>
                    <small>gpoico_computacion@hotmail.com</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 text-right">
            <div class="d-inline-flex align-items-center">
                <i class="fa fa-2x fa-phone text-primary mr-3"></i>
                <div class="text-left">
                    <h6 class="font-weight-semi-bold mb-1">Call Us</h6>
                    <small>+221 435 2691</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Barra de navegación -->
<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                <h1 class="m-0"><span class="text-primary">COMPU</span>INGLES</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav py-0">
                        <a href="PanelAdmin.php" class="nav-item nav-link">Atras</a>
                        <div class="nav-item dropdown">
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>

<!-- Encabezado de la página -->
<div class="container-fluid page-header" style="margin-bottom: 90px;">
    <div class="container">
        <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
            <h3 class="display-4 text-white text-uppercase">Editar horario y calificaciones</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Inicio</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Panel Administrativo</p>
            </div>
        </div>
    </div>
</div>
<style>
        .scrollable-container {
            max-height: 70vh; /* Establece la altura máxima del contenedor scrollable */
            overflow-y: auto; /* Permite desplazarse verticalmente si el contenido es más grande */
        }
    </style>

<div class="container-fluid py-5">
    <div class="container pt-3 pb-3 scrollable-container">
        <?php
        // Incluye el archivo de conexión a la base de datos
        include 'conexion.php';

        // Verifica si se ha enviado el formulario de edición o eliminación
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['editar_calificacion'])) {
                // Procesa la edición de calificaciones
                foreach ($_POST['nueva_calificacion'] as $calificacion_id => $nueva_calificacion) {
                    $nuevo_curso_id = $_POST['nuevo_curso'][$calificacion_id];
                    actualizarCalificacion($conn, $calificacion_id, $nueva_calificacion, $nuevo_curso_id);
                }
            } elseif (isset($_POST['eliminar_calificacion'])) {
                // Procesa la eliminación de calificaciones
                $calificacion_id = $_POST['calificacion_id'];
                eliminarCalificacion($conn, $calificacion_id);
            } elseif (isset($_POST['editar_horario'])) {
                // Procesa la edición de horarios
                foreach ($_POST['nuevo_horario'] as $horario_id => $nuevo_horario) {
                    $nuevo_profesor_id = $_POST['nuevo_profesor'][$horario_id];
                    $nuevo_grupo_id = $_POST['nuevo_grupo'][$horario_id];
                    actualizarHorario($conn, $horario_id, $nuevo_horario, $nuevo_profesor_id, $nuevo_grupo_id);
                }
            } elseif (isset($_POST['eliminar_horario'])) {
                // Procesa la eliminación de horarios
                $horario_id = $_POST['horario_id'];
                eliminarHorario($conn, $horario_id);
            }
        }

        // Realiza la consulta para obtener las calificaciones con el nombre del curso
        $query = "SELECT calificaciones.id, usuarios.nombre as alumno, cursos.id as curso_id, cursos.nombre as curso, calificacion FROM calificaciones
                  INNER JOIN usuarios ON calificaciones.alumno_id = usuarios.id
                  INNER JOIN cursos ON calificaciones.curso_id = cursos.id";

        // Utiliza $conn en lugar de $conexion
        $resultado = mysqli_query($conn, $query);

        if (!$resultado) {
            die("Error en la consulta: " . mysqli_error($conn));
        }

        // Muestra la tabla con las calificaciones y el formulario de edición y eliminación
        echo "<form method='post' action='CalificacionesEdit.php'>";
        echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Alumno</th>
                        <th>Curso</th>
                        <th>Calificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>";

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>
                    <td>{$fila['id']}</td>
                    <td>{$fila['alumno']}</td>
                    <td>
                        <select class='form-select' name='nuevo_curso[{$fila['id']}]'>";

            // Obtener la lista de cursos para el select
            $queryCursos = "SELECT id, nombre FROM cursos";
            $resultCursos = mysqli_query($conn, $queryCursos);

            while ($curso = mysqli_fetch_assoc($resultCursos)) {
                $selected = ($curso['id'] == $fila['curso_id']) ? 'selected' : '';
                echo "<option value='{$curso['id']}' $selected>{$curso['nombre']}</option>";
            }

            echo "</select>
                    </td>
                    <td>
                        <input class='form-control' type='text' name='nueva_calificacion[{$fila['id']}]' value='{$fila['calificacion']}' required>
                    </td>
                    <td>
                        <button class='btn btn-primary' type='submit' name='editar_calificacion'>Editar</button>
                        <button class='btn btn-danger' type='submit' name='eliminar_calificacion'>Eliminar</button>
                        <input type='hidden' name='calificacion_id' value='{$fila['id']}'>
                    </td>
                  </tr>";
        }

        echo "</tbody>
            </table>";
        echo "</form>";

        // Cierra la conexión a la base de datos
        mysqli_close($conn);
        ?>

        <?php
        // Incluye el archivo de conexión a la base de datos
        include 'conexion.php';

        // Realiza la consulta para obtener los horarios con el nombre del profesor y del grupo
        $query = "SELECT horarios.id, usuarios.nombre as profesor, grupos.nombre as grupo, dia_semana, hora_inicio, hora_fin FROM horarios
                  INNER JOIN usuarios ON horarios.profesor_id = usuarios.id
                  INNER JOIN grupos ON horarios.grupo_id = grupos.id";

        // Utiliza $conn en lugar de $conexion
        $resultado = mysqli_query($conn, $query);

        if (!$resultado) {
            die("Error en la consulta: " . mysqli_error($conn));
        }

        // Muestra la tabla con los horarios y el formulario de edición y eliminación
        echo "<form method='post' action='CalificacionesEdit.php'>";
        echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Profesor</th>
                        <th>Grupo</th>
                        <th>Día de la semana</th>
                        <th>Hora de inicio</th>
                        <th>Hora fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>";

        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>
                    <td>{$fila['id']}</td>
                    <td>
                        <select class='form-select' name='nuevo_profesor[{$fila['id']}]'>";

            // Obtener la lista de profesores para el select
            $queryProfesores = "SELECT id, nombre FROM usuarios WHERE tipo = 'profesor'";
            $resultProfesores = mysqli_query($conn, $queryProfesores);

            while ($profesor = mysqli_fetch_assoc($resultProfesores)) {
                $selectedProfesor = ($profesor['id'] == $fila['profesor']) ? 'selected' : '';
                echo "<option value='{$profesor['id']}' $selectedProfesor>{$profesor['nombre']}</option>";
            }

            echo "</select>
                    </td>
                    <td>
                        <select class='form-select' name='nuevo_grupo[{$fila['id']}]'>";

            // Obtener la lista de grupos para el select
            $queryGrupos = "SELECT id, nombre FROM grupos";
            $resultGrupos = mysqli_query($conn, $queryGrupos);

            while ($grupo = mysqli_fetch_assoc($resultGrupos)) {
                $selectedGrupo = ($grupo['id'] == $fila['grupo_id']) ? 'selected' : '';
                echo "<option value='{$grupo['id']}' $selectedGrupo>{$grupo['nombre']}</option>";
            }

            echo "</select>
                    </td>
                    <td><input class='form-control' type='number' name='nuevo_horario[{$fila['id']}][dia_semana]' value='{$fila['dia_semana']}' min='1' max='7' required></td>
                    <td><input class='form-control' type='time' name='nuevo_horario[{$fila['id']}][hora_inicio]' value='{$fila['hora_inicio']}' required></td>
                    <td><input class='form-control' type='time' name='nuevo_horario[{$fila['id']}][hora_fin]' value='{$fila['hora_fin']}' required></td>
                    <td>
                        <button class='btn btn-primary' type='submit' name='editar_horario'>Editar</button>
                        <button class='btn btn-danger' type='submit' name='eliminar_horario'>Eliminar</button>
                        <input type='hidden' name='horario_id' value='{$fila['id']}'>
                    </td>
                  </tr>";
        }

        echo "</tbody>
            </table>";
        echo "</form>";

        // Cierra la conexión a la base de datos
        mysqli_close($conn);

        // Función para actualizar la calificación
        function actualizarCalificacion($conn, $calificacion_id, $nueva_calificacion, $nuevo_curso_id) {
            // Evita la inyección SQL utilizando prepared statements
            $query = "UPDATE calificaciones SET calificacion = ?, curso_id = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);

            // Verifica si la preparación de la sentencia fue exitosa
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "dii", $nueva_calificacion, $nuevo_curso_id, $calificacion_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                die("Error al preparar la sentencia: " . mysqli_error($conn));
            }
        }

        // Función para eliminar la calificación
        function eliminarCalificacion($conn, $calificacion_id) {
            // Evita la inyección SQL utilizando prepared statements
            $query = "DELETE FROM calificaciones WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);

            // Verifica si la preparación de la sentencia fue exitosa
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $calificacion_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                die("Error al preparar la sentencia: " . mysqli_error($conn));
            }
        }

        // Función para actualizar el horario
        function actualizarHorario($conn, $horario_id, $nuevo_horario, $nuevo_profesor_id, $nuevo_grupo_id) {
            // Evita la inyección SQL utilizando prepared statements
            $query = "UPDATE horarios SET dia_semana = ?, hora_inicio = ?, hora_fin = ?, profesor_id = ?, grupo_id = ? WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);

            // Verifica si la preparación de la sentencia fue exitosa
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssiii", $nuevo_horario['dia_semana'], $nuevo_horario['hora_inicio'], $nuevo_horario['hora_fin'], $nuevo_profesor_id, $nuevo_grupo_id, $horario_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                die("Error al preparar la sentencia: " . mysqli_error($conn));
            }
        }

        // Función para eliminar el horario
        function eliminarHorario($conn, $horario_id) {
            // Evita la inyección SQL utilizando prepared statements
            $query = "DELETE FROM horarios WHERE id = ?";
            $stmt = mysqli_prepare($conn, $query);

            // Verifica si la preparación de la sentencia fue exitosa
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

<!-- Category Start -->

    <!-- Category Start -->


 
    <!-- Courses End -->


    <!-- Footer Start -->

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>