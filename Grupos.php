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

    <!-- Navbar Start -->
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
            <h3 class="display-4 text-white text-uppercase">Lista Grupos</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Inicio</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Panel Administrativo</p>
            </div>
        </div>
    </div>
</div>
    <!-- Header End -->
    <div class="container-fluid py-5">
    <div class="container pt-3 pb-3">
        <?php
        include 'conexion.php';

        // Consulta para obtener la lista de alumnos con nombres de cursos y grupos
        $sqlAlumnos = "SELECT la.id, u.nombre AS nombre_alumno, c.nombre AS nombre_curso, g.nombre AS nombre_grupo
                       FROM lista_alumnos la
                       INNER JOIN usuarios u ON la.alumno_id = u.id
                       INNER JOIN cursos c ON la.curso_id = c.id
                       INNER JOIN grupos g ON la.grupo_id = g.id
                       ORDER BY g.nombre, la.id";

        $resultAlumnos = $conn->query($sqlAlumnos);

        // Imprimir la tabla de alumnos
        if ($resultAlumnos->num_rows > 0) {
            echo "<h2 class='mb-4'>Lista de Alumnos</h2>";
            echo "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Alumno</th>
                            <th>Curso</th>
                            <th>Grupo</th>
                        </tr>
                    </thead>
                    <tbody>";

            // Imprimir datos de cada alumno
            while ($row = $resultAlumnos->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["nombre_alumno"] . "</td>
                        <td>" . $row["nombre_curso"] . "</td>
                        <td>" . $row["nombre_grupo"] . "</td>
                      </tr>";
            }

            echo "</tbody>
                </table>";
        } else {
            echo "<p class='alert alert-warning'>No se encontraron alumnos.</p>";
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </div>
</div>
