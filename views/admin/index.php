<div class="header">

    <h1>Clientes</h1>
    <a href="/" class="boton cerrar boton-salir">Cerrar Sesión</a>
</div>

<div class="formulario">
    <form method="GET" action="/admin/usuarios" class="filtro-form">
        <div class="campo-busqueda">
        <input type="text" name="busqueda" placeholder="Buscar por nombre o email" value="<?php echo $_GET['busqueda'] ?? ''; ?>">
        <input type="submit" value="Filtrar" class="boton boton-verde">
        </div>
    </form>
</div>
<table>
    <a href="/admin/crear" class="boton boton-verde">Crear Cliente</a>
    <thead>
        <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Pais</th>
            <th>Fecha Registro</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php  foreach($clientes as $cliente): ?>
            
            <tr>
                <td><?php echo $cliente->id; ?></td>
                <td><?php echo $cliente->nombre; ?></td>
                <td><?php echo $cliente->apellido; ?></td>
                <td><?php echo $cliente->email; ?></td>
                <td><?php echo $cliente->telefono; ?></td>
                <td><?php echo $cliente->pais; ?></td>
                <td><?php echo $cliente->fecha_registro; ?></td>
                <td>
                    <a href="/admin/actualizar?id=<?php echo $cliente->id; ?>">Actualizar</a>
                    <form method="POST" action="/admin/eliminar">
                        <input type="hidden" name="id" value="<?php echo $cliente->id; ?>">
                        <input type="submit" value="Eliminar" class="boton boton-eliminar">
                    </form>
            </tr>
        <?php endforeach; ?>
       
    </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/build/app.js"></script>