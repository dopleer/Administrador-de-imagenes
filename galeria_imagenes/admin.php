<?php
require_once 'includes/config.php';
require_once 'includes/funciones.php';

if (!isLoggedIn() || !isAdmin()) {
    redirect('dashboard.php');
}

$funciones = new Funciones();
$usuarios = $funciones->obtenerTodosUsuarios();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_usuario'])) {
    $funciones->eliminarUsuario($_POST['usuario_id']);
    redirect('admin.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <h1>Panel de Administración</h1>
            <div class="nav-links">
                <a href="dashboard.php" class="btn btn-secondary">Volver al Dashboard</a>
                <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2>Gestión de Usuarios</h2>
        
        <div class="users-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Tipo</th>
                        <th>Fecha Registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo htmlspecialchars($usuario['username']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td><?php echo $usuario['tipo']; ?></td>
                            <td><?php echo $usuario['fecha_registro']; ?></td>
                            <td>
                                <?php if ($usuario['id'] != $_SESSION['user_id']): ?>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
                                        <button type="submit" name="eliminar_usuario" class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de eliminar este usuario? Se eliminarán todas sus imágenes.')">
                                            Eliminar
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">Usuario actual</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>