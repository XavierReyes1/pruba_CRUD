document.addEventListener('DOMContentLoaded', function() {
    // Asignar eventos a todos los botones de eliminar
    const botonesEliminar = document.querySelectorAll('.boton-eliminar');
    
    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function(e) {
            e.preventDefault(); // Prevenir el comportamiento por defecto
            
            // Obtener datos del usuario desde atributos data-*
            const id = this.getAttribute('data-id');
            const nombre = this.getAttribute('data-nombre');
            
            // Mostrar confirmación
            if (confirm(`¿Estás seguro que deseas eliminar a ${nombre}? Esta acción no se puede deshacer.`)) {
                // Si confirman, enviar el formulario
                const formEliminar = this.closest('form');
                formEliminar.submit();
            }
        });
    });
});