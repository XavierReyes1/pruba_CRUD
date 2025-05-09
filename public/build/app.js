document.addEventListener('DOMContentLoaded', () => {
    // Botones para eliminar
    const botonesEliminar = document.querySelectorAll('.boton-eliminar');

    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', event => {
            event.preventDefault();

            const id = boton.dataset.id;
            const nombre = boton.dataset.nombre;

            Swal.fire({
                title: `¿Quires Eliminar el Registro?`,
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "¡Eliminado!",
                        text: `El Registro ha sido eliminado.`,
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    });

                    const formulario = boton.closest('form');
                    if (formulario) {
                        setTimeout(() => formulario.submit(), 1600);
                    }
                }
            });
        });
    });

    // Botón para cerrar sesión
    const botonSalir = document.querySelector('.boton-salir');
    if (botonSalir) {
        botonSalir.addEventListener('click', event => {
            event.preventDefault();

            Swal.fire({
                title: "¿Cerrar sesión?",
                text: "Tendrás que volver a iniciar sesión para continuar.",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#aaa",
                confirmButtonText: "Sí, salir",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = botonSalir.getAttribute('href');
                }
            });
        });
    }
});
