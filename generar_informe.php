<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

// Configuración de la base de datos
$host = 'localhost';
$dbname = 'autopsias_bd';
$username = 'root';
$password = '';

try {
    // Conectar a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el ID de la autopsia desde el formulario
    $idAutopsia = $_POST['idAutopsia'];

    // Consulta SQL para obtener los datos de la autopsia
    $sql = "
        SELECT 
            a.idAutopsia,
            a.fechaAutopsia,
            a.procedimiento,
            a.hallazgos,
            p.nombre AS nombre_patologo,
            p.especialidad,
            cm.descripcion AS causa_muerte,
            c.nombre AS nombre_cadaver,
            c.datosBiometricos,
            hc.diagonosticosPreexistentes AS historial_clinico,
            hc.tratamientos,
            ec.tipoExamen,
            ec.resultados AS resultados_examen,
            m.tipoMuestra,
            m.resultados AS resultados_muestra
        FROM Autopsia a
        JOIN Patologo p ON a.Patologo_idPatologo = p.idPatologo
        JOIN Cadaver c ON a.Cadaver_idCadaver = c.idCadaver
        LEFT JOIN CausaMuerte cm ON a.idAutopsia = cm.Autopsia_idAutopsia
        LEFT JOIN HistorialClinico hc ON c.idCadaver = hc.Cadaver_idCadaver
        LEFT JOIN ExamenComplementario ec ON a.idAutopsia = ec.Autopsia_idAutopsia
        LEFT JOIN Muestra m ON c.idCadaver = m.Cadaver_idCadaver
        WHERE a.idAutopsia = :idAutopsia
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['idAutopsia' => $idAutopsia]);
    $autopsia = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró la autopsia
    if (!$autopsia) {
        die("No se encontró la autopsia con el ID proporcionado.");
    }

    // Cargar la plantilla HTML
    $html = file_get_contents(__DIR__ . '/templates/template.html');

    // Reemplazar placeholders con los datos de la base de datos
    $data = [
        'nombre' => $autopsia['nombre_cadaver'],
        'edad' => 'Edad no disponible', // Ajusta según tu estructura
        'sexo' => 'Sexo no disponible', // Ajusta según tu estructura
        'fecha_muerte' => 'Fecha de muerte no disponible', // Ajusta según tu estructura
        'historial_clinico' => $autopsia['historial_clinico'],
        'tratamientos' => $autopsia['tratamientos'],
        'tipo_examen' => $autopsia['tipoExamen'],
        'resultados_examen' => $autopsia['resultados_examen'],
        'tipo_muestra' => $autopsia['tipoMuestra'],
        'resultados_muestra' => $autopsia['resultados_muestra'],
        'procedimiento_autopsia' => $autopsia['procedimiento'],
        'fecha_autopsia' => $autopsia['fechaAutopsia'],
        'hallazgos' => $autopsia['hallazgos'],
        'causa_muerte' => $autopsia['causa_muerte'],
        'nombre_patologo' => $autopsia['nombre_patologo'],
        'especialidad' => $autopsia['especialidad']
    ];

    foreach ($data as $key => $value) {
        $html = str_replace("[$key]", $value, $html);
    }

    // Crear el PDF
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Guardar el PDF en la carpeta /reports
    $rutaPDF = __DIR__ . '/reports/informe_autopsia_' . $idAutopsia . '.pdf';
    file_put_contents($rutaPDF, $dompdf->output());

    // Insertar los datos del informe en la base de datos (opcional)
    $sql = "
        INSERT INTO Informes (contenido, rutaPDF, Autopsia_idAutopsia)
        VALUES (:contenido, :rutaPDF, :autopsia_id)
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'contenido' => $html, // Puedes guardar el contenido HTML si lo necesitas
        'rutaPDF' => $rutaPDF,
        'autopsia_id' => $idAutopsia
    ]);

    // Redirigir de vuelta a index.php
    header('Location: index.php?id=' . $idAutopsia);
    exit;

} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}