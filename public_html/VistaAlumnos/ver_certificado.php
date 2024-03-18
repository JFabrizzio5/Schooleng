<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Verificar si se proporcionó un ID en el parámetro GET
if (isset($_GET['id'])) {
    // Obtener el valor del ID del certificado desde el parámetro GET
    $certificado_id = intval($_GET['id']);

    // Verificar si se proporcionó un ID válido
    if ($certificado_id <= 0) {
        die("ID de certificado no válido.");
    }

    // Consulta SQL para obtener la información del certificado con el ID específico
    $sql = "SELECT usuarios.nombre AS nombre_alumno, cursos.nombre AS nombre_curso, fecha_certificado
            FROM certificados
            INNER JOIN usuarios ON certificados.alumno_id = usuarios.id
            INNER JOIN cursos ON certificados.curso_id = cursos.id
            WHERE certificados.id = ?";
} else {
    // Consulta SQL para obtener la información de todos los certificados
    $sql = "SELECT usuarios.nombre AS nombre_alumno, cursos.nombre AS nombre_curso, fecha_certificado
            FROM certificados
            INNER JOIN usuarios ON certificados.alumno_id = usuarios.id
            INNER JOIN cursos ON certificados.curso_id = cursos.id";
}

// Preparar la declaración
$stmt = $conn->prepare($sql);

// Si se proporcionó un ID, vincular el parámetro
if (isset($certificado_id)) {
    $stmt->bind_param('i', $certificado_id);
}

// Ejecutar la consulta
$stmt->execute();

// Vincular el resultado
$stmt->bind_result($nombre_alumno, $nombre_curso, $fecha_certificado);

// Mostrar errores de MySQL
if ($stmt->errno) {
    echo "Error de MySQL: " . $stmt->error;
} else {
    // Mostrar los resultados en formato de texto
   // echo "<h2>Certificado</h2>";
    while ($stmt->fetch()) {
        //echo "<p>Nombre del Alumno: $nombre_alumno</p>";
        //echo "<p>Nombre del Curso: $nombre_curso</p>";
        //echo "<p>Fecha de Certificado: $fecha_certificado</p>";
        //echo "<hr>";
    }

    // Volver al inicio del conjunto de resultados
    $stmt->data_seek(0);
}

// Cerrar la declaración
$stmt->close();
?>
<!-- Agrega la referencia a la biblioteca html2pdf.js -->
<script src="https://unpkg.com/html2pdf.js"></script>

<style>
    body {
        background-color: #8cc6ec;
    }

    .handwritten {
        font-family: 'Dancing Script';
    }

    .inner-border {
        border: 6px solid gold;
        padding: 40px;
    }

    .error {
        color: red;
    }

    h1 {
        text-transform: capitalize;
    }

    h2 {
        font-family: 'Almendra SC';
        font-size: 50px;
        font-weight: bold;
        text-transform: uppercase;
        text-align: center;
    }

    h3 {
        font-family: 'Almendra SC';
        font-size: 30px;
        font-weight: bold;
        text-transform: uppercase;
        text-align: center;
    }

    .meltdown {}

    .certificate {
        background-color: #ddd;
        margin-top: 20px;
        padding: 30px;
        border: 3px solid black;
        background-image: url('https://craiglager.co.uk/wp-content/uploads/2016/06/C1ROVk6.png');
        background-size: 500px;
        background-repeat: no-repeat;
        background-position: center;
    }

    .name-wrapper {
        border-bottom: 4px solid #333;
        margin: 20px;
    }

    .name-wrapper h1 {
        font-size: 80px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('btnGenerarPDF').addEventListener('click', function () {
            // Obtener los datos necesarios
            var nombreAlumno = "<?php echo $nombre_alumno; ?>";
            var nombreCurso = "<?php echo $nombre_curso; ?>";
            var fechaCertificado = "<?php echo $fecha_certificado; ?>";

            // Seleccionar el elemento que contiene el certificado
            var certificateElement = document.querySelector('.certificate');

            // Configuración de opciones para la generación del PDF
            var options = {
                margin: 10,
                filename: 'certificado.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
            };

            // Generar el PDF
            html2pdf().from(certificateElement).set(options).outputPdf().then(function (pdf) {
                // Abrir el PDF en una nueva ventana
                var blob = new Blob([pdf], { type: 'application/pdf' });
                var url = URL.createObjectURL(blob);

                // Crear un objeto de ventana para abrir el PDF
                var nuevaVentana = window.open(url, '_blank');

                // Cerrar la ventana después de imprimir
                nuevaVentana.onload = function () {
                    nuevaVentana.print();
                    nuevaVentana.onafterprint = function () {
                        nuevaVentana.close();
                    };
                };
            });
        });
    });
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    function generarPDF() {
        var pdf = new jsPDF();
        var contenidoHTML = document.documentElement.outerHTML;

        pdf.fromHTML(contenidoHTML, 15, 15, {
            'width': 170
        });

        pdf.save('documento.pdf');
    }
</script>
<div class="container" ng-app="app">
    <div class="certificate col-xs-12">
        <div class="inner-border">
            <h2>COMPUINGLES</h2>
            <h3>Certificado para:</h3>
            <div class="row">
                <div class="col-xs-6 col-xs-push-3 text-center name-wrapper">
                   <h2 class="handwritten"><?php echo $nombre_alumno; ?></h2>

                </div>
            </div>
            <h3>Por el logro de cursar al 100%</h3>
            <h2 class="meltdown"><?php echo $nombre_curso; ?></h2>
            <div class="row">
                <div class="col-xs-12 text-center date">
                    Fecha de certificacion<br /><span class="handwritten"><?php echo $fecha_certificado; ?></span>
                </div>
              

            </div>
        </div>
    </div>
</div>


