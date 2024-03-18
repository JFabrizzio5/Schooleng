<?php
include 'conexion.php';

// Función para dar de baja un usuario
function darDeBaja($conn, $id_usuario) {
    $sql_select = "SELECT nombre FROM usuarios WHERE id = $id_usuario";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre_usuario = $row['nombre'];

        // Dar de baja al usuario
        $fecha_baja = date("Y-m-d");
        $nombre_baja = "Dado de baja: $nombre_usuario fecha: ($fecha_baja)";
        $sql_baja = "UPDATE usuarios SET nombre = '$nombre_baja' WHERE id = $id_usuario";

        if ($conn->query($sql_baja) === TRUE) {
            echo "Usuario dado de baja correctamente.";
        } else {
            echo "Error al dar de baja al usuario: " . $conn->error;
        }
    } else {
        echo "Usuario no encontrado.";
    }
}

// Procesar el formulario de edición si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accion'])) {
        $id_usuario = $_POST['id_usuario'];

        if ($_POST['accion'] == 'editar') {
            $nuevo_nombre = $_POST['nuevo_nombre'];
            $sql_update = "UPDATE usuarios SET nombre = '$nuevo_nombre' WHERE id = $id_usuario";

            if ($conn->query($sql_update) === TRUE) {
                echo "Nombre actualizado correctamente.";
            } else {
                echo "Error al actualizar el nombre: " . $conn->error;
            }
        } elseif ($_POST['accion'] == 'dar_baja') {
            darDeBaja($conn, $id_usuario);
        }
    }
}

// Obtener la lista de usuarios
$sql_select_all = "SELECT id, nombre, tipo FROM usuarios";
$result_all = $conn->query($sql_select_all);

// Mostrar la lista de usuarios y sus formularios de edición
?>

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
            <h3 class="display-4 text-white text-uppercase">Lista usuarios</h3>
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
   <center> <h2>Lista de Usuarios</h2> </center>
<div class="container-fluid py-5">
    <div class="container pt-3 pb-3 scrollable-container">
<main class="container mt-4">
    <div class="text-center">
    
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row_all = $result_all->fetch_assoc()) {
                    $id_usuario = $row_all['id'];
                    $nombre_usuario = $row_all['nombre'];
                    $tipo_usuario = $row_all['tipo'];
                ?>
                <tr>
                    <td><?php echo $id_usuario; ?></td>
                    <td contenteditable="true"><?php echo $nombre_usuario; ?></td>
                    <td><?php echo $tipo_usuario; ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                            <input type="hidden" name="accion" value="editar">
                            <input type="text" name="nuevo_nombre" placeholder="Nuevo Nombre" value="<?php echo $nombre_usuario; ?>">
                            <input type="submit" class="btn btn-primary" value="Guardar">
                        </form>

                        <form method="post" action="">
                            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                            <input type="hidden" name="accion" value="dar_baja">
                            <input type="submit" class="btn btn-danger" value="Dar de Baja">
                        </form>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
     </div>
        </div>
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
