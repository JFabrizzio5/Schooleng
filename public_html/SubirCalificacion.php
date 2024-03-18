<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Calificaciones</title>
</head>
<body>
<?php
// Incluir el archivo de conexión a la base de datos
include('conexion.php');

// Resto del código...

// Consultar la lista de alumnos y cursos para llenar los selects
$queryAlumnos = "SELECT id, nombre FROM usuarios WHERE tipo = 'alumno' ORDER BY nombre";
$resultAlumnos = mysqli_query($conn, $queryAlumnos); // Usa $conn en lugar de $conexion
$queryAlumnos2 = "SELECT id, nombre FROM usuarios WHERE tipo = 'alumno' ORDER BY nombre";
$resultAlumnos2 = mysqli_query($conn, $queryAlumnos2); // Usa $conn en lugar de $conexion

$queryCursos = "SELECT id, nombre FROM cursos ORDER BY nombre";
$resultCursos = mysqli_query($conn, $queryCursos); // Usa $conn en lugar de $conexion


// Consultar la lista de profesores, grupos y cursos para llenar los selects
$queryProfesores = "SELECT id, nombre FROM usuarios WHERE tipo = 'profesor' ORDER BY nombre";
$resultProfesores = mysqli_query($conn, $queryProfesores);

$queryGrupos = "SELECT id, nombre FROM grupos ORDER BY nombre";
$resultGrupos = mysqli_query($conn, $queryGrupos);


$queryGrupos2 = "SELECT id, nombre FROM grupos ORDER BY nombre";
$resultGrupos2 = mysqli_query($conn, $queryGrupos2);

$queryCursos = "SELECT id, nombre FROM cursos ORDER BY nombre";
$resultCursos = mysqli_query($conn, $queryCursos);
$queryCursos2 = "SELECT id, nombre FROM cursos ORDER BY nombre";
$resultCursos2 = mysqli_query($conn, $queryCursos2);
$queryCursos3 = "SELECT id, nombre FROM cursos ORDER BY nombre";
$resultCursos3 = mysqli_query($conn, $queryCursos3);
$queryCursos4 = "SELECT id, nombre FROM cursos ORDER BY nombre";
$resultCursos4 = mysqli_query($conn, $queryCursos4);

?>






</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gestion</title>
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
    <!-- Navbar End -->

    <!-- Category Start -->
 
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add an event listener to the select element
            $('#selectForm').on('change', function () {
                // Get the selected form
                var selectedForm = $(this).val();

                // Hide all form containers
                $('.form-container').hide();

                // Show the selected form container
                if (selectedForm !== 'none') {
                    $('#' + selectedForm).show();
                }
            });

            // Trigger the change event on page load to hide all forms
            $('#selectForm').trigger('change');
        });
    </script>
</head>

<body>

    <!-- Your existing body content -->
<section>
    <div class="container-fluid page-header" style="margin-bottom: 90px;">
        <div class="container">
            <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
                <h3 class="display-4 text-white text-uppercase">Gestion</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Inicio</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Panel Administrativo</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <!-- Select element to choose the form -->
        <label for="selectForm">Elije la alta</label>
        <select id="selectForm" class="form-control">
            <option value="none" selected disabled>Choose a form</option>
            <option value="professorForm">Agregar Calificacion</option>
            <option value="courseForm">Agregar Grupo</option>
            <option value="studentForm">Asignar grupo y horario a profesor</option>
            <option value="horaryForm">Agregar Alumno a grupo</option>
        </select>

        <!-- Form containers for professor, course, and student -->
        <div id="professorForm" class="form-container mt-4">
        <form action="AltaCalificacion.php" method="post">
    <label for="alumno">Seleccionar Alumno:</label>
    <select name="alumno" id="alumno" required>
        <?php
        while ($row = mysqli_fetch_assoc($resultAlumnos)) {
            echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }
        ?>
    </select>
    <br>

    <label for="curso">Seleccionar Curso:</label>
    <select name="curso" id="curso" required>
        <?php
        while ($row = mysqli_fetch_assoc($resultCursos)) {
            echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }
        ?>
    </select>
    <br>

    <label for="calificacion">Calificación:</label>
    <input type="number" name="calificacion" id="calificacion" step="any" required>
    <br>

    <input type="submit" class="btn btn-primary"  value="Subir Calificación">
</form>
        </div>

        <div id="courseForm" class="form-container mt-4">
    
        <form action="Altagrupos.php" method="post">
    <label for="curso">Seleccionar Curso:</label>
    <select name="curso" id="curso" required>
        <?php
        while ($row = mysqli_fetch_assoc($resultCursos2)) {
            echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }
        ?>
    </select>
    <br>

    <label for="nombre_grupo">Nombre del Grupo:</label>
    <input type="text" name="nombre_grupo" id="nombre_grupo" required>
    <br>

    <input type="submit" class="btn btn-primary" value="Subir Grupo">
</form>
        </div>

        <div id="studentForm" class="form-container mt-4">
        <form action="Altahorarios.php" method="post">
    <label for="profesor">Seleccionar Profesor:</label>
    <select name="profesor" id="profesor" required>
        <?php
        while ($row = mysqli_fetch_assoc($resultProfesores)) {
            echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }
        ?>
    </select>
    <br>

    <label for="grupo">Seleccionar Grupo:</label>
<select name="grupo" id="grupo" required>
    <?php
    // Reset the result set
    mysqli_data_seek($resultGrupos, 0);

    while ($row = mysqli_fetch_assoc($resultGrupos)) {
        echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
    }
    ?>
</select>
    <br>

    <label for="curso">Seleccionar Curso:</label>
    <select name="curso" id="curso" required>
        <?php
        while ($row = mysqli_fetch_assoc($resultCursos3)) {
            echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
        }
        ?>
    </select>
    <br>

    <label for="dia_semana">Día de la Semana:</label>
<input type="text" name="dia_semana" id="dia_semana" required pattern="[1-7]" title="Ingresa un número del 1 al 7">

    <br>

    <label for="hora_inicio">Hora de Inicio:</label>
    <input type="time" name="hora_inicio" id="hora_inicio" required>
    <br>

    <label for="hora_fin">Hora de Fin:</label>
    <input type="time" name="hora_fin" id="hora_fin" required>
    <br>

    <input type="submit" class="btn btn-primary" value="Subir Horario">
</form>


        </div>
    </div>

    <div id="horaryForm" class="form-container mt-4">
    <div class="container mt-5">
    <form action="Subirlistas.php" method="post">
        <label for="alumno">Seleccionar Alumno:</label>
        <select name="alumno" id="alumno" required>
            <?php
            // Aquí debes obtener la lista de alumnos, ajusta según tu estructura
            while ($row = mysqli_fetch_assoc($resultAlumnos2)) {
                echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
            }
            ?>
        </select>
        <br>

        <label for="curso">Seleccionar Curso:</label>
        <select name="curso" id="curso" required>
            <?php
            // Obtener la lista de cursos
            while ($row = mysqli_fetch_assoc($resultCursos4)) {
                echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
            }
            ?>
        </select>
        <br>

        <label for="grupo">Seleccionar Grupo:</label>
        <select name="grupo" id="grupo" required>
            <?php
            // Obtener la lista de grupos
            while ($row = mysqli_fetch_assoc($resultGrupos2)) {
                echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
            }
            ?>
        </select>
        <br>

        <input type="submit" class="btn btn-primary" value="Agregar a Lista">
    </form>

    </div>

    </div>
</section>



      <!-- Footer Start -->
      <div class="container-fluid bg-dark text-white py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
    <div class="row pt-5">
        <div class="col-lg-7 col-md-12">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Get In Touch</h5>
                    <p><i class="fa fa-map-marker-alt mr-2"></i>
                        Morelos · Puebla, Mexico · Estado de México · Hidalgo, Mexico · Córdoba, Veracruz de Ignacio de la Llave</p>
                    <p><i class="fa fa-phone-alt mr-2"></i>
                        221 435 2691</p>
                    <p><i class="fa fa-envelope mr-2"></i>gpoico_computacion@hotmail.com</p>
                    <div class="d-flex justify-content-start mt-4">
                        <a class="btn btn-outline-light btn-square mr-2" href="https://www.facebook.com/profile.php?id=100066610234418&mibextid=LQQJ4d"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-square mr-2" href="https://www.instagram.com/icocompuinglespuebla?igsh=dWY1d2M2ZGtmNmY%3D"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-square mr-2" href="https://youtube.com/@icocompuingles9850?si=4zLhDl41GxYU_l5d"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-square" href="https://www.icocompuingles.com/"><i class="fa fa-globe" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <h5 class="text-primary text-uppercase mb-4" style="letter-spacing: 5px;">Our Courses</h5>
                    <div class="d-flex flex-column justify-content-start">

                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>CompuKids</a>
                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>World english kids</a>
                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Worlds English Course</a>
                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Asistente Ejecutivo en alta</a>
                        

                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Desarrollador de redes y sistemas</a>
                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Diseño Grafico Digital</a>
                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Asistente ejecutivo en informatica</a>
                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Marketing </a>
                        
                        
                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Web Design</a>
                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Apps Design</a>
                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Marketing</a>
                        <a class="text-white mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Research</a>
                      
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-12 mb-5">
            <p></p>
            <div class="w-100">         
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
    <div class="row">
        <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
          
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
