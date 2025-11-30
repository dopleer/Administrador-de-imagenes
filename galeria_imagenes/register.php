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
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $error = "Las contraseñas no coinciden";
    } else {
        try {
            $funciones = new Funciones();
            
            if ($funciones->registrarUsuario($_POST['username'], $_POST['email'], $_POST['password'])) {
                $_SESSION['success'] = "Usuario registrado correctamente. Ahora puedes iniciar sesión.";
                redirect('login.php');
            } else {
                $error = "Error al registrar usuario";
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Galería de Imágenes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Registro de Usuario</h2>
            
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Nombre de Usuario:</label>
                    <input type="text" name="username" required>
                </div>
                
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label>Contraseña:</label>
                    <input type="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label>Confirmar Contraseña:</label>
                    <input type="password" name="confirm_password" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
            
            <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </div>
    </div>
</body>
</html>