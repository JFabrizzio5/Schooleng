<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';
session_start(); // Iniciar la sesión

// Variables para manejar los resultados y mensajes
$alumno_encontrado = false;
$resultado_horarios = null;
$resultado_calificaciones = null;
$mensaje_error = "";

// Verificar si la conexión está establecida
if ($conn) {
    // Obtener el ID del alumno desde la sesión
    $alumno_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

    // Verificar si se tiene un ID de alumno en la sesión
    if ($alumno_id) {
        // Consulta para obtener los horarios y grupos del alumno
        $consulta_horarios = "SELECT horarios.dia_semana, horarios.hora_inicio, horarios.hora_fin, grupos.nombre as nombre_grupo
                            FROM horarios
                            INNER JOIN grupos ON horarios.grupo_id = grupos.id
                            INNER JOIN lista_alumnos ON grupos.id = lista_alumnos.grupo_id
                            WHERE lista_alumnos.alumno_id = ?";
        $stmt_horarios = $conn->prepare($consulta_horarios);
        $stmt_horarios->bind_param('i', $alumno_id);
        $stmt_horarios->execute();
        $resultado_horarios = $stmt_horarios->get_result();

        // Consulta para obtener las calificaciones del alumno
        $consulta_calificaciones = "SELECT cursos.nombre as nombre_curso, calificaciones.calificacion
                                    FROM calificaciones
                                    INNER JOIN cursos ON calificaciones.curso_id = cursos.id
                                    WHERE calificaciones.alumno_id = ?";
        $stmt_calificaciones = $conn->prepare($consulta_calificaciones);
        $stmt_calificaciones->bind_param('i', $alumno_id);
        $stmt_calificaciones->execute();
        $resultado_calificaciones = $stmt_calificaciones->get_result();

        // Verificar si se encontraron horarios para el alumno
        if ($resultado_horarios->num_rows > 0) {
            $alumno_encontrado = true;
        } else {
            $mensaje_error = "No se encontraron horarios para el alumno.";
        }

        // Cerrar la declaración de horarios
        $stmt_horarios->close();
        $stmt_calificaciones->close();
    } else {
        $mensaje_error = "No se encontró un ID de alumno en la sesión.";
    }
} else {
    $mensaje_error = "Error en la conexión a la base de datos.";
}

// Cerrar la conexión
$conn->close();
?>
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
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
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
    <!-- Topbar End -->


    <!-- Navbar Start -->
  
<!-- Navbar Start -->
<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
      
           
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0"><span class="text-primary">E</span>COURSES</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav py-0">
                        <a href="index.html" class="nav-item nav-link active">Info</a>
                        <!-- Puedes agregar este botón en tu página -->
                        <a href="../cerrar_sesion.php" class="nav-item nav-link active">Cerrar Sesión</a>

                        
                        <div class="nav-item dropdown">
                           
                        </div>
                     
                    </div>
                 
                </div>
            </nav>
        </div>
    </div>
</div>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="container-fluid page-header" style="margin-bottom: 90px;">
        <div class="container">
            <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
                <h3 class="display-4 text-white text-uppercase"> <?php echo isset($_SESSION['nombre']) ? 'Hola, ' . $_SESSION['nombre'] : 'Bienvenido'; ?></h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Info</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-5">
                <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Hi</h5>
                <h1>Estos son los horarios para tus grupos asignados</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                <?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Verificar si el usuario está autenticado como profesor
if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] === 'profesor') {
    // Obtener el ID del profesor autenticado
    $profesor_id = $_SESSION['id'];

    // Consulta para obtener los horarios de clase del profesor
    $sql_horarios = "SELECT dia_semana, hora_inicio, hora_fin, nombre
    FROM horarios
    INNER JOIN grupos ON horarios.grupo_id = grupos.id
    WHERE profesor_id = ?";

    // Preparar la declaración
    $stmt_horarios = $conn->prepare($sql_horarios);
    $stmt_horarios->bind_param('i', $profesor_id);

    // Ejecutar la consulta de horarios
    $stmt_horarios->execute();

    // Vincular el resultado
    $stmt_horarios->bind_result($num_dia_semana, $hora_inicio, $hora_fin, $nombre_grupo);

    // Imprimir la tabla de horarios con Bootstrap
    echo '<h2>Horarios de Clase</h2>';
    echo '<table class="table table-bordered">';
    echo '<thead class="thead-dark">';
    echo '<tr><th>Día de la Semana</th><th>Hora de Inicio</th><th>Hora de Fin</th><th>Grupo</th></tr>';
    echo '</thead><tbody>';

    while ($stmt_horarios->fetch()) {
        // Convertir el número del día de la semana a su nombre correspondiente
        $nombre_dia_semana = '';
        switch ($num_dia_semana) {
            case 1:
                $nombre_dia_semana = 'Lunes';
                break;
            case 2:
                $nombre_dia_semana = 'Martes';
                break;
            case 3:
                $nombre_dia_semana = 'Miércoles';
                break;
            case 4:
                $nombre_dia_semana = 'Jueves';
                break;
            case 5:
                $nombre_dia_semana = 'Viernes';
                break;
            case 6:
                $nombre_dia_semana = 'Sábado';
                break;
            case 7:
                $nombre_dia_semana = 'Domingo';
                break;
            default:
                $nombre_dia_semana = 'Desconocido';
                break;
        }

        echo '<tr>';
        echo '<td>' . $nombre_dia_semana . '</td>';
        echo '<td>' . $hora_inicio . '</td>';
        echo '<td>' . $hora_fin . '</td>';
        echo '<td>' . $nombre_grupo . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';

    // Cerrar la declaración de horarios
    $stmt_horarios->close();

    // Ahora, obtener la lista de alumnos según los grupos dados
// Ahora, obtener la lista de alumnos según los grupos dados
$sql_lista_alumnos = "SELECT u.nombre AS nombre_alumno, g.nombre AS nombre_grupo
                      FROM lista_alumnos la
                      INNER JOIN usuarios u ON la.alumno_id = u.id
                      INNER JOIN grupos g ON la.grupo_id = g.id
                      INNER JOIN horarios h ON g.id = h.grupo_id
                      WHERE h.profesor_id = ?";

    // Preparar la declaración
    $stmt_lista_alumnos = $conn->prepare($sql_lista_alumnos);
    $stmt_lista_alumnos->bind_param('i', $profesor_id);

    // Ejecutar la consulta de lista de alumnos
    $stmt_lista_alumnos->execute();

    // Vincular el resultado
    $stmt_lista_alumnos->bind_result($nombre_alumno, $nombre_grupo_alumno);

    // Imprimir la tabla de lista de alumnos con Bootstrap
    echo '<h2>Lista de Alumnos</h2>';
    echo '<table class="table table-bordered">';
    echo '<thead class="thead-dark">';
    echo '<tr><th>Alumno</th><th>Grupo</th></tr>';
    echo '</thead><tbody>';

    while ($stmt_lista_alumnos->fetch()) {
        echo '<tr>';
        echo '<td>' . $nombre_alumno . '</td>';
        echo '<td>' . $nombre_grupo_alumno . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';

    // Cerrar la declaración de lista de alumnos
    $stmt_lista_alumnos->close();
} else {
    echo "Acceso no autorizado.";
}

// Cerrar la conexión
$conn->close();
?>



            </tbody>
        </table>

       
        
      </div>
            </div>
        </div>
    </div>
    
    <!-- Team End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-7 col-md-12">
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Get In Touch</h5>
                        <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+012 345 67890</p>
                        <p><i class="fa fa-envelope mr-2"></i>info@example.com</p>
                        <div class="d-flex justify-content-start mt-4">
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-light btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Our Courses</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Web Design</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Apps Design</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Marketing</a>
                            <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Research</a>
                            <a class="text-white" href="#"><i class="fa fa-angle-right mr-2"></i>SEO</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 mb-5">
                <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Newsletter</h5>
                <p>Rebum labore lorem dolores kasd est, et ipsum amet et at kasd, ipsum sea tempor magna tempor. Accu kasd sed ea duo ipsum. Dolor duo eirmod sea justo no lorem est diam</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 30px;" placeholder="Your Email Address">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white">&copy; <a href="#">Domain Name</a>. All Rights Reserved. Designed by <a href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <ul class="nav d-inline-flex">
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-0" href="#">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
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