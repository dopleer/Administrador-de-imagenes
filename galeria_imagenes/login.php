<?php
// Incluir archivos de configuración
require_once 'includes/config.php';
require_once 'includes/funciones.php';

// Verificar si ya está logueado
if (isLoggedIn()) {
    redirect('dashboard.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que se enviaron los datos
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        try {
            $funciones = new Funciones();
            
            if ($funciones->login($_POST['username'], $_POST['password'])) {
                redirect('dashboard.php');
            } else {
                $error = "Usuario o contraseña incorrectos";
            }
        } catch (Exception $e) {
            $error = "Error: " . $e->getMessage();
        }
    } else {
        $error = "Por favor, completa todos los campos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Galería de Imágenes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Iniciar Sesión</h2>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Usuario o Email:</label>
                    <input type="text" name="username" required>
                </div>
                
                <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" name="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
            
            <p>¿No tienes cuenta? <a href="register.php">Regístrate aquí</a></p>
        </div>
    </div>
</body>
</html>