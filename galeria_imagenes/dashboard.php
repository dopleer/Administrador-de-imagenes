<?php
require_once 'includes/config.php';
require_once 'includes/funciones.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$funciones = new Funciones();
$imagenes = $funciones->obtenerImagenes($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Galería de Imágenes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <h1>Mi Galería</h1>
            <div class="nav-links">
                <span>Hola, <?php echo $_SESSION['username']; ?></span>
                <?php if (isAdmin()): ?>
                    <a href="admin.php" class="btn btn-secondary">Panel Admin</a>
                <?php endif; ?>
                <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="dashboard-header">
            <h2>Mis Imágenes</h2>
            <a href="subir_imagen.php" class="btn btn-primary">Subir Nueva Imagen</a>
        </div>

        <?php if (empty($imagenes)): ?>
            <div class="empty-state">
                <p>No tienes imágenes en tu galería.</p>
                <a href="subir_imagen.php" class="btn btn-primary">Subir tu primera imagen</a>
            </div>
        <?php else: ?>
            <div class="gallery-grid">
                <?php foreach ($imagenes as $imagen): ?>
                    <div class="gallery-item">
                        <img src="uploads/<?php echo $_SESSION['user_id'] . '/' . $imagen['nombre_archivo']; ?>" 
                             alt="<?php echo htmlspecialchars($imagen['nombre_original']); ?>">
                        <div class="gallery-item-info">
                            <h4><?php echo htmlspecialchars($imagen['nombre_original']); ?></h4>
                            <p><?php echo round($imagen['tamaño'] / 1024, 2); ?> KB</p>
                            <form action="eliminar_imagen.php" method="POST" class="delete-form">
                                <input type="hidden" name="imagen_id" value="<?php echo $imagen['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('¿Estás seguro de eliminar esta imagen?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>