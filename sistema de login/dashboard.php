<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Ejercicios</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>📊 Panel Principal</h1>
            <div class="user-info">
                Bienvenido, <?php echo $_SESSION['usuario']; ?> 
                | <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
            </div>
        </header>
        
        <main class="exercises-grid">
            <div class="exercise-card">
                <h2>📐 Ejercicio 2</h2>
                <p>Cálculo de Área y Volumen de Figuras</p>
                <a href="ejerciciops/calculadora_figura.php" class="btn-exercise">Ir al Ejercicio</a>
            </div>
            
            <div class="exercise-card">
                <h2>📊 Ejercicio 3</h2>
                <p>Identificación de Cuadrantes Cartesianos</p>
                <a href="ejerciciops/cuadrante cartesianos.php" class="btn-exercise">Ir al Ejercicio</a>
            </div>
        </main>
        
        <footer class="dashboard-footer">
            <p>Sistema de Evaluación Práctica - Git y GitHub</p>
        </footer>
    </div>
</body>
</html>