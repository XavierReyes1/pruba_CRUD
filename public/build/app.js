document.addEventListener('DOMContentLoaded', () => {
    // Elementos comunes
    const tablaBody = document.querySelector('#clientes-body');
    const inputBusqueda = document.querySelector('#busqueda');
    const botonSalir = document.querySelector('.boton-salir');
    
    // Cargar clientes al iniciar
    if (tablaBody) cargarClientes();

    // Busqueda
    if (inputBusqueda) {
        inputBusqueda.addEventListener('input', () => cargarClientes(inputBusqueda.value));
    }

    // Cierre de sesión
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

    // Formulario de creación
    const formularioCrear = document.getElementById('formulario-crear');
    if (formularioCrear) {
        formularioCrear.addEventListener('submit', manejarCreacion);
    }

    // Formulario de actualización
    const formularioActualizar = document.getElementById('formulario-actualizar');
    if (formularioActualizar) {
        formularioActualizar.addEventListener('submit', manejarActualizacion);
    }

    // Funciones principales
    async function cargarClientes(busqueda = '') {
        try {
            const res = await fetch(`/api/clientes?busqueda=${encodeURIComponent(busqueda)}`);
            const { success, data } = await res.json();
            
            if (success && tablaBody) {
                renderizarClientes(data);
            }
        } catch (error) {
            console.error('Error:', error);
            mostrarError('No se pudieron cargar los clientes');
        }
    }

    function renderizarClientes(clientes) {
        tablaBody.innerHTML = '';
        
        clientes.forEach(cliente => {
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
        
        // Eventos para botones de eliminar
        document.querySelectorAll('.btn-eliminar').forEach(btn => {
            btn.addEventListener('click', () => eliminarCliente(btn.dataset.id));
        });
    }

    async function eliminarCliente(id) {
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
            try {
                 const res = await fetch(`/api/eliminar-cliente?id=${id}`, {
                    method: 'DELETE'
                });
                
                const { success, mensaje } = await res.json();
                
                if (success) {
                    await Swal.fire('Eliminado', 'El cliente ha sido eliminado.', 'success');
                    cargarClientes(inputBusqueda?.value || '');
                } else {
                    throw new Error(mensaje || 'No se pudo eliminar el cliente');
                }
            } catch (error) {
                mostrarError(error.message);
            }
        }
    }

    async function manejarCreacion(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        const datos = Object.fromEntries(formData.entries());
        
        try {
            Swal.showLoading();
            
           const res = await fetch('/api/crear-cliente', {
            method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datos)
            });
            
            const { success, data, errores, mensaje } = await res.json();
            
            if (success) {
                await Swal.fire('Éxito', 'Cliente creado correctamente', 'success');
                window.location.href = '/admin/index';
            } else {
                throw new Error(errores ? Object.values(errores).join('<br>') : mensaje);
            }
        } catch (error) {
            mostrarError(error.message);
        }
    }

    async function manejarActualizacion(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        const datos = Object.fromEntries(formData.entries());
        const id = datos.id;
        
        try {
            Swal.showLoading();
            
            const res = await fetch('/api/actualizar-cliente', {
            method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datos)
            });
            
            const { success, data, errores, mensaje } = await res.json();
            
            if (success) {
                await Swal.fire('Éxito', 'Cliente actualizado correctamente', 'success');
                window.location.href = '/admin/index';
            } else {
                throw new Error(errores ? Object.values(errores).join('<br>') : mensaje);
            }
        } catch (error) {
            mostrarError(error.message);
        }
    }

    // Ejemplo de cómo consumir tu API con JWT
async function obtenerClientes() {
    // Obtener el token de donde lo hayas almacenado (localStorage, cookies, etc.)
      const token = localStorage.getItem('jwt_token'); // O donde almacenes el token
    
    try {

const response = await fetch('/api/clientes', {
    headers: {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json'
    }
});
        
        if (!response.ok) {
            const errorData = await response.json();
            throw new Error(errorData.error || 'Error en la solicitud');
        }
        
        return await response.json();
    } catch (error) {
        console.error('Error:', error);
        // Manejar el error (redirigir a login si es 401)
        if (error.message.includes('Token')) {
            window.location.href = '/login';
        }
        return null;
    }
}

    function mostrarError(mensaje) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: mensaje,
            timer: 8000
        });
    }
});