<?php
// Iniciar sesión solo si no está ya iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'galeria_imagenes');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configuración de la aplicación
define('SITE_URL', 'http://localhost/galeria_imagenes');
define('UPLOAD_DIR', 'uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);

// Función para verificar si el usuario está logueado
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Función para verificar si es administrador
function isAdmin() {
    return isset($_SESSION['user_tipo']) && $_SESSION['user_tipo'] === 'admin';
}

// Redirección
function redirect($url) {
    header("Location: $url");
    exit;
}
?>