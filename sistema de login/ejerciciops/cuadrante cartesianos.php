<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$resultado = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $x = $_POST['x'] ?? '';
    $y = $_POST['y'] ?? '';
    
    if ($x === '' || $y === '') {
        $error = "Por favor, ingresa ambos valores (X e Y)";
    } elseif (!is_numeric($x) || !is_numeric($y)) {
        $error = "Por favor, ingresa valores numéricos válidos";
    } else {
        $x = floatval($x);
        $y = floatval($y);
        
        if ($x == 0 && $y == 0) {
            $resultado = "El punto está en el origen (0,0)";
            $clase = "origen";
        } elseif ($x == 0) {
            $resultado = "El punto está sobre el eje Y";
            $clase = "eje";
        } elseif ($y == 0) {
            $resultado = "El punto está sobre el eje X";
            $clase = "eje";
        } elseif ($x > 0 && $y > 0) {
            $resultado = "El punto está en el I Cuadrante";
            $clase = "cuadrante-i";
        } elseif ($x < 0 && $y > 0) {
            $resultado = "El punto está en el II Cuadrante";
            $clase = "cuadrante-ii";
        } elseif ($x < 0 && $y < 0) {
            $resultado = "El punto está en el III Cuadrante";
            $clase = "cuadrante-iii";
        } elseif ($x > 0 && $y < 0) {
            $resultado = "El punto está en el IV Cuadrante";
            $clase = "cuadrante-iv";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identificación de Cuadrantes</title>
    <link rel="stylesheet" href="../../styles.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>📊 Identificación de Cuadrantes Cartesianos</h1>
            <nav>
                <a href="../dashboard.php" class="btn-back">← Volver al Dashboard</a>
            </nav>
        </header>

        <main class="main-content">
            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($resultado): ?>
                <div class="resultado <?php echo $clase ?? ''; ?>">
                    <h3>Resultado:</h3>
                    <p><strong><?php echo $resultado; ?></strong></p>
                    <p>Coordenadas: (<?php echo $x ?? ''; ?>, <?php echo $y ?? ''; ?>)</p>
                </div>
            <?php endif; ?>

            <div class="calculator-form">
                <h2>Ingresa las coordenadas:</h2>
                
                <form method="POST" class="coordinates-form">
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="x">Coordenada X:</label>
                            <input type="number" id="x" name="x" step="any" placeholder="Ingresa valor X">
                        </div>
                        
                        <div class="form-group">
                            <label for="y">Coordenada Y:</label>
                            <input type="number" id="y" name="y" step="any" placeholder="Ingresa valor Y">
                        </div>
                    </div>

                    <button type="submit" class="btn-calculate">Identificar Cuadrante</button>
                </form>
            </div>

            <!-- Representación visual del plano cartesiano -->
            <div class="plano-cartesiano">
                <h3>Plano Cartesiano de Referencia:</h3>
                <div class="plano">
                    <div class="cuadrante cuadrante-i">
                        <span>I Cuadrante<br>(+, +)</span>
                    </div>
                    <div class="cuadrante cuadrante-ii">
                        <span>II Cuadrante<br>(-, +)</span>
                    </div>
                    <div class="cuadrante cuadrante-iii">
                        <span>III Cuadrante<br>(-, -)</span>
                    </div>
                    <div class="cuadrante cuadrante-iv">
                        <span>IV Cuadrante<br>(+, -)</span>
                    </div>
                    <div class="eje-x">Eje X</div>
                    <div class="eje-y">Eje Y</div>
                    <div class="origen">Origen (0,0)</div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>