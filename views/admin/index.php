<div class="header">
    <h1>Clientes</h1>
    <a href="/logout" class="boton cerrar boton-salir">Cerrar Sesión</a>
</div>
 <a href="/admin/crear" class="boton boton-verde">Crear Cliente</a>
<div class="campo-busqueda formulario">
  <input type="text" id="busqueda" placeholder="Buscar cliente...">
  <button class="boton boton-verde" id="btnBuscar">Buscar</button>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>País</th>
            <th>Fecha Registro</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody id="clientes-body"></tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/build/app.js"></script>
