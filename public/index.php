<?php
$autopsia_id = $_GET['id'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Informe</title>
</head>
<body>
    <h1>Generar Informe de Autopsia</h1>
    <form action="generar_informe.php" method="GET">
        <label for="id">ID de la Autopsia:</label>
        <input type="number" id="id" name="id" required>
        <button type="submit">Generar Informe</button>
    </form>

    <?php if ($autopsia_id): ?>
        <a href="<?php echo __DIR__; ?>/reports/informe_autopsia_<?php echo $autopsia_id; ?>.pdf" target="_blank">
            <button>Ver PDF</button>
        </a>
    <?php endif; ?>
</body>
</html>
