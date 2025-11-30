<?php
require_once 'includes/config.php';
require_once 'includes/funciones.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$funciones = new Funciones();
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        try {
            if ($funciones->subirImagen($_SESSION['user_id'], $_FILES['imagen'])) {
                $mensaje = "Imagen subida correctamente";
            } else {
                $mensaje = "Error al subir la imagen";
            }
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
    } else {
        $mensaje = "Error en la subida del archivo";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen - Galería de Imágenes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <h1>Subir Imagen</h1>
            <div class="nav-links">
                <a href="dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
                <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="upload-form">
            <h2>Subir Nueva Imagen</h2>
            
            <?php if ($mensaje): ?>
                <div class="<?php echo strpos($mensaje, 'correctamente') !== false ? 'success' : 'error'; ?>">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Seleccionar imagen (JPEG, PNG, GIF, WebP - Máx. 5MB):</label>
                    <input type="file" name="imagen" accept="image/*" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Subir Imagen</button>
                <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</body>
</html>