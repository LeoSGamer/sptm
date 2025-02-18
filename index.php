<?php
// Conectar a la base de datos (para obtener la lista de autopsias)
$host = 'localhost';
$dbname = 'autopsias_bd';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener la lista de autopsias (opcional, para seleccionar una autopsia existente)
    $sql = "SELECT idAutopsia, nombre FROM Cadaver";
    $stmt = $pdo->query($sql);
    $autopsias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Obtener el ID de la autopsia desde la URL (si se redirige después de generar un informe)
$autopsia_id = $_GET['id'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Informe</title>
    <!-- Tailwind CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Generar Informe de Autopsia</h1>

        <!-- Formulario para generar el informe -->
        <form action="generar_informe.php" method="POST" class="space-y-4">
            <div>
                <label for="idAutopsia" class="block text-sm font-medium text-gray-700">Seleccionar Autopsia:</label>
                <select id="idAutopsia" name="idAutopsia" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    <?php foreach ($autopsias as $autopsia): ?>
                        <option value="<?php echo $autopsia['idAutopsia']; ?>">
                            <?php echo $autopsia['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">
                Generar Informe
            </button>
        </form>

        <!-- Enlace para ver los reportes guardados -->
        <div class="mt-8">
            <a href="ver_reportes.php" class="text-blue-600 hover:underline">Ver Reportes Guardados</a>
        </div>

        <!-- Mostrar enlace para ver el PDF recién generado (si existe) -->
        <?php if ($autopsia_id): ?>
            <div class="mt-8">
                <p class="text-green-600">¡Informe generado correctamente!</p>
                <a href="reports/informe_autopsia_<?php echo $autopsia_id; ?>.pdf" target="_blank" class="text-blue-600 hover:underline">
                    Ver PDF
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>