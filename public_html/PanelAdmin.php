<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EPanel</title>
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
                            
                            <a href="course.html" class="nav-item nav-link active">Panel</a>
                            <a href="cerrar_sesion.php" class="nav-item nav-link active">Cerrar sesion</a>
                            <div class="nav-item dropdown">
                              
                                <div class="dropdown-menu rounded-0 m-0">
                                   
                                </div>
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
                <h3 class="display-4 text-white text-uppercase">Panel Administrativo</h3>
                <div class="d-inline-flex text-white">
                    <p class="m-0 text-uppercase"><a class="text-white" href="">Inicio</a></p>
                    <i class="fa fa-angle-double-right pt-1 px-3"></i>
                    <p class="m-0 text-uppercase">Panel Administrativo,Bienvenido 
                    <?php 
    if (isset($_SESSION['nombre'])) {
    // Imprime el nombre de la persona de la sesión
    echo $_SESSION['nombre'];
} else {
    // Si el nombre de la persona de la sesión no está establecido, redirige o realiza alguna acción adecuada
    echo "No has iniciado sesión.";
    // Puedes redirigir o realizar otra acción aquí
}
?></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


<!-- Category Start -->
<div class="container-fluid py-5">
    <div class="container pt-3 pb-3">
        <div class="text-center mb-5">
            <h5 class="text-primary text-uppercase mb-3" style="letter-spacing: 5px;">Admin</h5>
            <h1>Opciones</h1>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="cat-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="img/cat-1.jpg" alt="">
                    <a class="cat-overlay text-white text-decoration-none" href="Altas.html">
                        <h4 class="text-white font-weight-medium">Altas Generales</h4>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="cat-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="img/cat-2.jpg" alt="">
                    <a class="cat-overlay text-white text-decoration-none" href="SubirCalificacion.php">
                        <h4 class="text-white font-weight-medium">Administracion General</h4>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="cat-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="img/cat-3.jpg" alt="buscam">
                    <a class="cat-overlay text-white text-decoration-none" href="buscarm.php">
                        <h4 class="text-white font-weight-medium">Buscar Info profesores</h4>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="cat-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="img/cat-4.jpg" alt="">
                    <a class="cat-overlay text-white text-decoration-none" href="CalificacionesEdit.php">
                        <h4 class="text-white font-weight-medium">Editar Calificaciones</h4>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="cat-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="img/cat-5.jpg" alt="">
                    <a class="cat-overlay text-white text-decoration-none" href="EditarUsuariosB.php">
                        <h4 class="text-white font-weight-medium">Baja Usuario</h4>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="cat-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="img/cat-6.jpg" alt="">
                    <a class="cat-overlay text-white text-decoration-none" href="Grupos.php">
                        <h4 class="text-white font-weight-medium">Listas grupos</h4>
                    </a>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 mb-4">
                <div class="cat-item position-relative overflow-hidden rounded mb-2">
                    <img class="img-fluid" src="img/cat-2.jpg" alt="">
                    <a class="cat-overlay text-white text-decoration-none" href="EmitirCertificado.php">
                        <h4 class="text-white font-weight-medium">Emitir Certificados</h4>
                    </a>
                </div>
            </div>
        </div>
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