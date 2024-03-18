<?php
// Verificar si se han enviado datos mediante el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión
    include 'conexion.php';

    // Obtener los datos del formulario
    $alumno_id = $_POST['alumno_id'];
    $curso_id = $_POST['curso_id'];
    $fecha_certificado = $_POST['fecha_certificado'];

    // Insertar el nuevo certificado en la tabla certificados
    $sql = "INSERT INTO certificados (alumno_id, fecha_certificado, curso_id) VALUES ($alumno_id, '$fecha_certificado', $curso_id)";

    if ($conn->query($sql) === TRUE) {
        echo "Certificado agregado correctamente";
    } else {
        echo "Error al agregar el certificado: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
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
                        <a href="PanelAdmin.php" class="nav-item nav-link active">Atras</a>
                        <!-- Puedes agregar este botón en tu página -->
                     

                        
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
                    <p class="m-0 text-uppercase"></p>
                </div>
            </div>
        </div>
    </div>
<body>

<div class="container main-container mt-4 bg-white p-4 rounded">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="form-container">

                <form action="EmitirCertificado.php" method="post">
                        <div class="form-group">
                            <label for="alumno_id">Seleccionar Alumno:</label>
                            <select class="form-control" name="alumno_id" id="alumno_id">
                                <?php
                                // Incluir el archivo de conexión
                                include 'conexion.php';

                                // Consulta para obtener la lista de alumnos desde la base de datos
                                $query_alumnos = "SELECT id, nombre FROM usuarios WHERE tipo = 'alumno'";
                                $result_alumnos = $conn->query($query_alumnos);

                                // Llenar las opciones del select con los datos obtenidos
                                while ($alumno = $result_alumnos->fetch_assoc()) {
                                    echo "<option value='{$alumno['id']}'>{$alumno['nombre']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="curso_id">Seleccionar Curso:</label>
                            <select class="form-control" name="curso_id" id="curso_id">
                                <?php
                                // Consulta para obtener la lista de cursos desde la base de datos
                                $query_cursos = "SELECT id, nombre FROM cursos";
                                $result_cursos = $conn->query($query_cursos);

                                // Llenar las opciones del select con los datos obtenidos
                                while ($curso = $result_cursos->fetch_assoc()) {
                                    echo "<option value='{$curso['id']}'>{$curso['nombre']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha_certificado">Fecha del Certificado:</label>
                            <input type="date" class="form-control" name="fecha_certificado" id="fecha_certificado" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Enviar Certificado</button>
                    </form>

</div>
            </div>
        </div>
    </div>
</body>
</html>
