<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Credenciales definidas (cambia según necesites)
    $usuario_valido = "admin";
    $password_valido = "1234";
    
    if ($usuario === $usuario_valido && $password === $password_valido) {
        $_SESSION['usuario'] = $usuario;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Ejercicios</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h1> Iniciar Sesión</h1>
            <img src="https://cdn-icons-png.flaticon.com/512/2997/2997911.png" alt="Matemáticas" class="login-image">
            
            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="btn-login">Ingresar</button>
            </form>
            
            <div class="credentials">
                <p><strong>Usuario:</strong> admin</p>
                <p><strong>Contraseña:</strong> 1234</p>
            </div>
        </div>
    </div>
</body>
</html>