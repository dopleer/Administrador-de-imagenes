<?php
require_once 'includes/config.php';
require_once 'includes/funciones.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['imagen_id'])) {
    $funciones = new Funciones();
    $funciones->eliminarImagen($_POST['imagen_id'], $_SESSION['user_id']);
}

redirect('dashboard.php');
?>