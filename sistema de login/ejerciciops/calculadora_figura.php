<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
    exit();
}

$resultado = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $figura = $_POST['figura'] ?? '';
    
    if ($figura == 'cilindro') {
        $radio = $_POST['radio'] ?? '';
        $altura = $_POST['altura'] ?? '';
        
        if (is_numeric($radio) && is_numeric($altura) && $radio > 0 && $altura > 0) {
            $area_base = M_PI * pow($radio, 2);
            $area_lateral = 2 * M_PI * $radio * $altura;
            $area_total = 2 * $area_base + $area_lateral;
            $volumen = $area_base * $altura;
            
            $resultado = "
                <div class='resultado'>
                    <h3>Resultados del Cilindro:</h3>
                    <p><strong>Área de la base:</strong> " . number_format($area_base, 2) . " unidades²</p>
                    <p><strong>Área lateral:</strong> " . number_format($area_lateral, 2) . " unidades²</p>
                    <p><strong>Área total:</strong> " . number_format($area_total, 2) . " unidades²</p>
                    <p><strong>Volumen:</strong> " . number_format($volumen, 2) . " unidades³</p>
                </div>
            ";
        } else {
            $error = "Por favor, ingresa valores válidos positivos para radio y altura";
        }
        
    } elseif ($figura == 'rectangulo') {
        $base = $_POST['base'] ?? '';
        $altura_rect = $_POST['altura_rect'] ?? '';
        
        if (is_numeric($base) && is_numeric($altura_rect) && $base > 0 && $altura_rect > 0) {
            $area = $base * $altura_rect;
            $perimetro = 2 * ($base + $altura_rect);
            
            $resultado = "
                <div class='resultado'>
                    <h3>Resultados del Rectángulo:</h3>
                    <p><strong>Área:</strong> " . number_format($area, 2) . " unidades²</p>
                    <p><strong>Perímetro:</strong> " . number_format($perimetro, 2) . " unidades</p>
                </div>
            ";
        } else {
            $error = "Por favor, ingresa valores válidos positivos para base y altura";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Figuras</title>
    <link rel="stylesheet" href="../../styles.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>📐 Calculadora de Área y Volumen</h1>
            <nav>
                <a href="../dashboard.php" class="btn-back">← Volver al Dashboard</a>
            </nav>
        </header>

        <main class="main-content">
            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($resultado): ?>
                <?php echo $resultado; ?>
            <?php endif; ?>

            <div class="calculator-form">
                <h2>Selecciona una figura:</h2>
                
                <form method="POST" class="figures-form">
                    <div class="form-group">
                        <label>
                            <input type="radio" name="figura" value="cilindro" required> Cilindro
                        </label>
                        <label>
                            <input type="radio" name="figura" value="rectangulo" required> Rectángulo
                        </label>
                    </div>

                    <!-- Campos para Cilindro -->
                    <div id="campos-cilindro" class="figure-fields">
                        <div class="form-group">
                            <label for="radio">Radio:</label>
                            <input type="number" id="radio" name="radio" step="0.01" min="0.01">
                        </div>
                        <div class="form-group">
                            <label for="altura">Altura:</label>
                            <input type="number" id="altura" name="altura" step="0.01" min="0.01">
                        </div>
                    </div>

                    <!-- Campos para Rectángulo -->
                    <div id="campos-rectangulo" class="figure-fields">
                        <div class="form-group">
                            <label for="base">Base:</label>
                            <input type="number" id="base" name="base" step="0.01" min="0.01">
                        </div>
                        <div class="form-group">
                            <label for="altura_rect">Altura:</label>
                            <input type="number" id="altura_rect" name="altura_rect" step="0.01" min="0.01">
                        </div>
                    </div>

                    <button type="submit" class="btn-calculate">Calcular</button>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Mostrar/ocultar campos según la figura seleccionada
        document.querySelectorAll('input[name="figura"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.figure-fields').forEach(div => {
                    div.style.display = 'none';
                });
                
                if (this.value === 'cilindro') {
                    document.getElementById('campos-cilindro').style.display = 'block';
                } else if (this.value === 'rectangulo') {
                    document.getElementById('campos-rectangulo').style.display = 'block';
                }
            });
        });

        // Ocultar todos los campos inicialmente
        document.querySelectorAll('.figure-fields').forEach(div => {
            div.style.display = 'none';
        });
    </script>
</body>
</html>