<?php
/**
 * Página de inicio - Galería de Imágenes
 * Redirecciona al login y muestra información del proyecto
 */

// Configuración básica
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería de Imágenes - Inicio</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: white;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 600px;
            width: 90%;
            margin: 2rem;
        }

        .logo {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #667eea;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }

        .subtitle {
            color: #7f8c8d;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .description {
            text-align: left;
            margin: 2rem 0;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
        }

        .feature {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }

        .feature-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin: 2rem 0;
        }

        .btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            min-width: 150px;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }

        .tech-stack {
            margin: 2rem 0;
            padding: 1.5rem;
            background: #2c3e50;
            color: white;
            border-radius: 10px;
        }

        .tech-stack h3 {
            margin-bottom: 1rem;
            color: #ecf0f1;
        }

        .tech-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }

        .tech-tag {
            background: #34495e;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .github-info {
            margin-top: 2rem;
            padding: 1rem;
            background: #f1f2f6;
            border-radius: 8px;
            border: 2px dashed #bdc3c7;
        }

        @media (max-width: 768px) {
            .container {
                padding: 2rem 1.5rem;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            .btn-group {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 100%;
                max-width: 250px;
            }
        }

        .auto-redirect {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 1rem;
            border-radius: 5px;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            🖼️
        </div>
        
        <h1>Galería de Imágenes</h1>
        <p class="subtitle">Una aplicación web moderna para gestionar tus imágenes</p>

        <div class="auto-redirect">
            <p>⏰ <strong>Redireccionando automáticamente en <span id="countdown">5</span> segundos...</strong></p>
            <p>Si no eres redirigido, haz clic en el botón de abajo.</p>
        </div>

        <div class="description">
            <h3>📋 Sobre el Proyecto</h3>
            <p>Esta es una aplicación web completa desarrollada en PHP que permite a los usuarios crear galerías personales de imágenes con sistema de autenticación y panel de administración.</p>
        </div>

        <div class="features">
            <div class="feature">
                <div class="feature-icon">🔐</div>
                <h4>Autenticación Segura</h4>
                <p>Registro e inicio de sesión con encriptación</p>
            </div>
            <div class="feature">
                <div class="feature-icon">🖼️</div>
                <h4>Galería Personal</h4>
                <p>Cada usuario tiene su propia galería</p>
            </div>
            <div class="feature">
                <div class="feature-icon">👨‍💼</div>
                <h4>Panel Admin</h4>
                <p>Gestión completa de usuarios</p>
            </div>
        </div>

        <div class="btn-group">
            <a href="login.php" class="btn btn-primary">🚀 Ir a la Aplicación</a>
            <a href="#github" class="btn btn-secondary">📁 Ver en GitHub</a>
        </div>

        <div class="tech-stack">
            <h3>🛠️ Tecnologías Utilizadas</h3>
            <div class="tech-tags">
                <span class="tech-tag">PHP</span>
                <span class="tech-tag">MySQL</span>
                <span class="tech-tag">HTML5</span>
                <span class="tech-tag">CSS3</span>
                <span class="tech-tag">JavaScript</span>
                <span class="tech-tag">Responsive Design</span>
            </div>
        </div>

        <div class="github-info" id="github">
            <h3>📂 Proyecto en GitHub</h3>
            <p>Este proyecto está disponible en GitHub como ejemplo de aplicación web completa con PHP y MySQL.</p>
            <p><strong>Características destacadas:</strong></p>
            <ul style="text-align: left; margin: 1rem 0;">
                <li>Sistema de autenticación seguro</li>
                <li>Subida y gestión de imágenes</li>
                <li>Panel de administración</li>
                <li>Diseño responsivo</li>
                <li>Arquitectura MVC básica</li>
            </ul>
        </div>
    </div>

    <script>
        // Redirección automática después de 5 segundos
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');
        
        const countdownInterval = setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;
            
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                window.location.href = 'login.php';
            }
        }, 1000);

        // También redirigir si el usuario hace clic en cualquier parte
        document.addEventListener('click', function() {
            clearInterval(countdownInterval);
            window.location.href = 'login.php';
        });
    </script>
</body>
</html>