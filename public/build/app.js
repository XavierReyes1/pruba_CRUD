document.addEventListener('DOMContentLoaded', () => {
    const botonesEliminar = document.querySelectorAll('.boton-eliminar');

    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', event => {
            event.preventDefault();

            const id = boton.dataset.id;
            const nombre = boton.dataset.nombre;

            Swal.fire({
                title: `¿Eliminar a ${nombre}?`,
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Opcional: mostrar confirmación visual antes de enviar
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: `${nombre} ha sido eliminado.`,
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    });

                    // Enviar el formulario
                    const formulario = boton.closest('form');
                    if (formulario) {
                        setTimeout(() => formulario.submit(), 1600); // Esperar a que se muestre el mensaje
                    }
                }
            });
        });
    });
});
