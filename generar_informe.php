<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

// Configuración de la base de datos
$host = '127.0.0.1';
$dbname = 'autopsias_db';
$username = 'prueba';
$password = '000';

try {
    // Conectar a la base de datos usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el ID de la autopsia (puede venir de un formulario o URL)
    $autopsia_id = $_GET['id'] ?? 1; // Por defecto, usa el ID 1 si no se proporciona

    // Consulta SQL para obtener los datos de la autopsia y relacionados
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
        WHERE a.idAutopsia = :id
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $autopsia_id]);
    $autopsia = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró la autopsia
    if (!$autopsia) {
        die("No se encontró la autopsia con el ID proporcionado.");
    }

    // Datos para la plantilla
    $data = [
        'nombre' => $autopsia['nombre_cadaver'],
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

    // Cargar la plantilla HTML
    $html = file_get_contents('templates/pdf.html');

    // Reemplazar los placeholders con los datos reales
    foreach ($data as $key => $value) {
        $html = str_replace("[$key]", $value, $html);
    }
    // Crear el PDF
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Guardar el PDF en la carpeta /reports
    $output = $dompdf->output();
    file_put_contents(__DIR__ . '/reports/informe_autopsia_' . $autopsia_id . '.pdf', $output);

    // Redirigir de vuelta a index.php
    header('Location: index.php?id=' . $autopsia_id);
    exit;
    // Crear el PDF
    //$dompdf = new Dompdf();
    //$dompdf->loadHtml($html);
    //$dompdf->setPaper('A4', 'portrait');
    //$dompdf->render();

    // Guardar el PDF en la carpeta /reports (opcional), se puede crear la carpeta y se le da permisos
    //$output = $dompdf->output();
    //file_put_contents('reports/informe_autopsia_' . $autopsia_id . '.pdf', $output);

    // Descargar el PDF automáticamente
    //$dompdf->stream("informe_autopsia_$autopsia_id.pdf", ["Attachment" => true]);

} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
