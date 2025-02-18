<?php
// Ruta de la carpeta de reportes
$rutaReportes = __DIR__ . '/reports';

// Obtener la lista de archivos PDF en la carpeta
$archivos = glob($rutaReportes . '/*.pdf');

// Verificar si hay archivos
if (empty($archivos)) {
    echo "<p>No hay reportes disponibles.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reportes</title>
    <!-- Tailwind CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Reportes Generados</h1>
        <ul class="space-y-4">
            <?php foreach ($archivos as $archivo): ?>
                <li class="bg-gray-50 p-4 rounded-lg">
                    <a href="<?php echo basename($archivo); ?>" target="_blank" class="text-blue-600 hover:underline">
                        <?php echo basename($archivo); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>