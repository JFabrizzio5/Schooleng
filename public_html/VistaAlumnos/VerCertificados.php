<?php
include '../conexion.php';
session_start(); // Iniciar la sesión
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

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

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
                            <a href="AlumnoVista.php" class="nav-item nav-link">Info</a>
                            <a href="VerCertificados.php" class="nav-item nav-link active">Certificados</a>
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

    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-5">
                <?php
                // Incluir el archivo de conexión a la base de datos

                // Verificar si el usuario tiene el rol de "alumno"
                if ($_SESSION['tipo_usuario'] === 'alumno') {
                    // Obtener el ID del alumno de la sesión
                    $alumno_id = $_SESSION['id'];

                    // Consulta SQL para obtener la información de los certificados con nombres de alumno y curso
                    $sql = "SELECT certificados.id, usuarios.nombre AS nombre_alumno, cursos.nombre AS nombre_curso, fecha_certificado
                            FROM certificados
                            INNER JOIN usuarios ON certificados.alumno_id = usuarios.id
                            INNER JOIN cursos ON certificados.curso_id = cursos.id
                            WHERE certificados.alumno_id = ?";

                    // Preparar la declaración
                    $stmt = $conn->prepare($sql);

                    // Vincular parámetros y ejecutar la declaración
                    $stmt->bind_param('i', $alumno_id);

                    // Ejecutar la consulta
                    $stmt->execute();

                    // Vincular el resultado
                    $stmt->bind_result($certificado_id, $nombre_alumno, $nombre_curso, $fecha_certificado);

                    // Mostrar la tabla dentro de un contenedor con estilos
                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-bordered'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th>ID Certificado</th>
                                    <th>Nombre del Alumno</th>
                                    <th>Nombre del Curso</th>
                                    <th>Fecha de Certificado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>";

                    // Recorrer los resultados y mostrar en la tabla
                    while ($stmt->fetch()) {
                        echo "<tr>
                                <td>$certificado_id</td>
                                <td>$nombre_alumno</td>
                                <td>$nombre_curso</td>
                                <td>$fecha_certificado</td>
                                <td><a href='ver_certificado.php?id=$certificado_id' class='btn btn-primary btn-sm'>Ver Certificado</a></td>
                              </tr>";
                    }

                    echo "</tbody></table>";
                    echo "</div>";

                    // Cerrar la declaración y la conexión
                    $stmt->close();
                    $conn->close();
                } else {
                    echo "<p class='text-danger'>Acceso no autorizado</p>"; // Mensaje si el usuario no es un alumno
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y Popper.js (es necesario incluir Popper.js para que Bootstrap funcione correctamente) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
