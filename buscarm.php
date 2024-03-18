<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Byscar maestros</title>
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

<!-- Encabezado superior -->
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
            <h3 class="display-4 text-white text-uppercase">Buscar Profesores</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Inicio</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Panel Administrativo</p>
            </div>
        </div>
    </div>
</div>

<!-- Contenido principal -->
<div class="container mt-4">
    <h1>Buscador de Profesores</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="nombre">Nombre del Profesor:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del profesor">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <div class="row pt-5">
        <div class="col-lg-7 col-md-12">
            <div class="row">
                    <?php
                    include 'conexion.php';

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $nombre = '%' . $_POST["nombre"] . '%';

                        // Utilizar consulta preparada para prevenir inyección SQL
                        $sql_usuario = "SELECT * FROM usuarios WHERE nombre LIKE  ? AND tipo = 'profesor'";
                        $stmt = $conn->prepare($sql_usuario);
                        $stmt->bind_param("s", $nombre);
                        $stmt->execute();
                        $result_usuario = $stmt->get_result();

                        if ($result_usuario->num_rows > 0) {
                        
                            echo "<h2>Resultados para '$nombre'</h2>";

                            while ($row_usuario = $result_usuario->fetch_assoc()) {
                                echo "<div class='table-responsive'>";
                                echo "<table class='table table-bordered'>";
                                echo "<thead class='thead-dark'>";
                                echo "<tr><th>ID</th><th>Nombre</th><th>Tipo</th></tr></thead>";
                                echo "<tbody>";

                                echo "<tr>";
                                echo "<td>{$row_usuario['id']}</td>";
                                echo "<td>{$row_usuario['nombre']}</td>";
                                echo "<td>{$row_usuario['tipo']}</td>";
                            
                                echo "</tr>";

                                // Mostrar información relacionada con el profesor (cursos, horarios, etc.)
                                echo "<tr><td colspan='4'><strong>Horarios asignados</strong></td></tr>";

                                // Ejemplo: Mostrar horarios del profesor con el nombre del grupo
                                echo "<tr><td colspan='4'>Horarios:</td></tr>";
                                $profesor_id = $row_usuario['id'];
                                $sql_horarios = "SELECT horarios.*, grupos.nombre AS nombre_grupo FROM horarios
                                                JOIN grupos ON horarios.grupo_id = grupos.id
                                                WHERE horarios.profesor_id = ?";
                                $stmt_horarios = $conn->prepare($sql_horarios);
                                $stmt_horarios->bind_param("i", $profesor_id);
                                $stmt_horarios->execute();
                                $result_horarios = $stmt_horarios->get_result();

                                while ($row_horario = $result_horarios->fetch_assoc()) {
                                    echo "<tr><td colspan='4'>{$row_horario['dia_semana']} - {$row_horario['hora_inicio']} a {$row_horario['hora_fin']} - Grupo: {$row_horario['nombre_grupo']}</td></tr>";
                                }

                                echo "</tbody>";
                                echo "</table>";
                                echo "</div>";
                            }

                            echo "</div>";
                        } else {
                            echo "<div class='container mt-4'><p>No se encontraron profesores con ese nombre.</p></div>";
                        }

                        // Cerrar consulta preparada
                        $stmt->close();
                        $stmt_horarios->close();
                    }

                    $conn->close();

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST['edit'])) {
                            // Acción de editar
                            $edit_id = $_POST['edit_id'];
                            // Redirige a la página de edición
                            header("Location: editar_profe.php?id=$edit_id");
                            exit();
                        } elseif (isset($_POST['delete'])) {
                            // Acción de eliminar
                            $delete_id = $_POST['delete_id'];

                            // Utilizar consulta preparada para prevenir inyección SQL
                            $sql_delete = "DELETE FROM usuarios WHERE id = ?";
                            $stmt_delete = $conn->prepare($sql_delete);
                            $stmt_delete->bind_param("i", $delete_id);
                            $stmt_delete->execute();

                            // Cerrar consulta preparada
                            $stmt_delete->close();

                            // Redirige a la página actual para refrescar los resultados
                            header("Location: {$_SERVER['PHP_SELF']}");
                            exit();
                        }
                    }

                    ?>
           </div>
        </div>
    </div>

</div>

<!-- Incluye Bootstrap JS desde CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>