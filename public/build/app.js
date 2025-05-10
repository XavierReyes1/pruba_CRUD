document.addEventListener('DOMContentLoaded', () => {
    const tablaBody = document.querySelector('#clientes-body');
    const inputBusqueda = document.querySelector('#busqueda');

    async function cargarClientes(busqueda = '') {
        const res = await fetch(`/api/clientes?busqueda=${encodeURIComponent(busqueda)}`);
        const json = await res.json();
        tablaBody.innerHTML = '';
        if (!json.success) return;
        json.data.forEach(cliente => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${cliente.id}</td>
                <td>${cliente.nombre}</td>
                <td>${cliente.apellido}</td>
                <td>${cliente.email}</td>
                <td>${cliente.telefono}</td>
                <td>${cliente.pais}</td>
                <td>${cliente.fecha_registro}</td>
                <td>
                    <a href="/admin/actualizar?id=${cliente.id}" class="boton boton-amarillo">Editar</a>
                    <button data-id="${cliente.id}" class="boton boton-rojo btn-eliminar">Eliminar</button>
                </td>`;
            tablaBody.appendChild(tr);
        });
        attachEventos();
    }

    function attachEventos() {
        document.querySelectorAll('.btn-eliminar').forEach(btn => {
            btn.addEventListener('click', async () => {
                const id = btn.dataset.id;
                const confirmacion = await Swal.fire({
                    title: '¿Eliminar cliente?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                });

                if (confirmacion.isConfirmed) {
                    const formData = new FormData();
                    formData.append('id', id);

                    const res = await fetch('/api/eliminar-cliente', {
                        method: 'POST',
                        body: formData
                    });

                    const json = await res.json();
                    if (json.success) {
                        Swal.fire('Eliminado', 'El cliente ha sido eliminado.', 'success');
                        cargarClientes(inputBusqueda.value);
                    } else {
                        Swal.fire('Error', json.mensaje || 'No se pudo eliminar', 'error');
                    }
                }
            });
        });
    }

    inputBusqueda?.addEventListener('input', e => {
        cargarClientes(e.target.value);
    });

    cargarClientes();

    // Cierre de sesión
    const botonSalir = document.querySelector('.boton-salir');
    if (botonSalir) {
        botonSalir.addEventListener('click', e => {
            e.preventDefault();
            Swal.fire({
                title: "¿Cerrar sesión?",
                text: "Tendrás que volver a iniciar sesión.",
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
