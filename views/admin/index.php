<div class="header">

    <h1>Clientes</h1>
    <a href="/admin/logar">Cerrar Sesión</a>
</div>


<table>
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
                        <input type="submit" value="Eliminar">
                    </form>
            </tr>
        <?php endforeach; ?>
       
    </tbody>
</table>