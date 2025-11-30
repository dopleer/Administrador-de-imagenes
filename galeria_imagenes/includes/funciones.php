<?php
require_once 'database.php';

class Funciones {
    private $db;
    
    public function __construct() {
        try {
            $this->db = (new Database())->getConnection();
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
    
    // Registro de usuario
    public function registrarUsuario($username, $email, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO usuarios (username, email, password) VALUES (?, ?, ?)");
            return $stmt->execute([$username, $email, $hashedPassword]);
        } catch (PDOException $e) {
            // Si es error de duplicado
            if ($e->getCode() == 23000) {
                throw new Exception("El nombre de usuario o email ya existe");
            }
            throw new Exception("Error al registrar usuario: " . $e->getMessage());
        }
    }
    
    // Login de usuario - ¡ESTE MÉTODO DEBE ESTAR PRESENTE!
    public function login($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE username = ? OR email = ?");
            $stmt->execute([$username, $username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_tipo'] = $user['tipo'];
                return true;
            }
            return false;
        } catch (PDOException $e) {
            throw new Exception("Error en el login: " . $e->getMessage());
        }
    }
    
    // Obtener imágenes del usuario
    public function obtenerImagenes($usuario_id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM imagenes WHERE usuario_id = ? ORDER BY fecha_subida DESC");
            $stmt->execute([$usuario_id]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error al obtener imágenes: " . $e->getMessage());
        }
    }
    
    // Subir imagen
    public function subirImagen($usuario_id, $archivo) {
        try {
            // Validar tipo de archivo
            if (!in_array($archivo['type'], ALLOWED_TYPES)) {
                throw new Exception("Tipo de archivo no permitido. Solo se permiten JPEG, PNG, GIF y WebP.");
            }
            
            // Validar tamaño
            if ($archivo['size'] > MAX_FILE_SIZE) {
                throw new Exception("Archivo demasiado grande. Máximo 5MB permitido.");
            }
            
            // Crear directorio del usuario si no existe
            $userDir = UPLOAD_DIR . $usuario_id . '/';
            if (!is_dir($userDir)) {
                mkdir($userDir, 0755, true);
            }
            
            // Generar nombre único
            $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
            $nombreArchivo = uniqid() . '.' . $extension;
            $rutaCompleta = $userDir . $nombreArchivo;
            
            // Mover archivo
            if (move_uploaded_file($archivo['tmp_name'], $rutaCompleta)) {
                $stmt = $this->db->prepare(
                    "INSERT INTO imagenes (usuario_id, nombre_archivo, nombre_original, tamaño, tipo) 
                     VALUES (?, ?, ?, ?, ?)"
                );
                return $stmt->execute([
                    $usuario_id,
                    $nombreArchivo,
                    $archivo['name'],
                    $archivo['size'],
                    $archivo['type']
                ]);
            } else {
                throw new Exception("Error al mover el archivo subido.");
            }
        } catch (PDOException $e) {
            throw new Exception("Error al subir imagen: " . $e->getMessage());
        }
    }
    
    // Eliminar imagen
    public function eliminarImagen($imagen_id, $usuario_id) {
        try {
            // Obtener información de la imagen
            $stmt = $this->db->prepare("SELECT * FROM imagenes WHERE id = ? AND usuario_id = ?");
            $stmt->execute([$imagen_id, $usuario_id]);
            $imagen = $stmt->fetch();
            
            if ($imagen) {
                // Eliminar archivo físico
                $rutaArchivo = UPLOAD_DIR . $usuario_id . '/' . $imagen['nombre_archivo'];
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }
                
                // Eliminar de la base de datos
                $stmt = $this->db->prepare("DELETE FROM imagenes WHERE id = ?");
                return $stmt->execute([$imagen_id]);
            }
            
            return false;
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar imagen: " . $e->getMessage());
        }
    }
    
    // Funciones de administrador
    public function obtenerTodosUsuarios() {
        try {
            $stmt = $this->db->prepare("SELECT id, username, email, tipo, fecha_registro FROM usuarios");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error al obtener usuarios: " . $e->getMessage());
        }
    }
    
    public function eliminarUsuario($usuario_id) {
        try {
            // Eliminar imágenes del usuario
            $userDir = UPLOAD_DIR . $usuario_id . '/';
            if (is_dir($userDir)) {
                $files = glob($userDir . '*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                rmdir($userDir);
            }
            
            $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
            return $stmt->execute([$usuario_id]);
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar usuario: " . $e->getMessage());
        }
    }
}
?>