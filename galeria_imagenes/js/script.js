// Funciones JavaScript para mejorar la UX
document.addEventListener('DOMContentLoaded', function() {
    // Previsualización de imagen antes de subir
    const fileInput = document.querySelector('input[type="file"]');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validar tamaño
                const maxSize = 5 * 1024 * 1024; // 5MB
                if (file.size > maxSize) {
                    alert('El archivo es demasiado grande. Máximo 5MB permitido.');
                    e.target.value = '';
                    return;
                }
                
                // Validar tipo
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!allowedTypes.includes(file.type)) {
                    alert('Tipo de archivo no permitido. Solo se permiten imágenes JPEG, PNG, GIF y WebP.');
                    e.target.value = '';
                    return;
                }
            }
        });
    }
    
    // Confirmación para acciones destructivas
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('¿Estás seguro de que quieres realizar esta acción?')) {
                e.preventDefault();
            }
        });
    });
    
    // Auto-ocultar mensajes después de 5 segundos
    const messages = document.querySelectorAll('.error, .success');
    messages.forEach(message => {
        setTimeout(() => {
            message.style.opacity = '0';
            setTimeout(() => message.remove(), 300);
        }, 5000);
    });
});