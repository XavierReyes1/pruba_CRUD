


<form action="" method="post" class="formulario">
    <?php include_once __DIR__ . '/../alertas.php'; ?>

    <fieldset>
        <legend>Actualizar Usuario</legend>
       <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre Usuario" value="<?php echo $cliente->nombre; ?>">
        </div>
        <div class="campo">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Apellido Usuario" value="<?php echo $cliente->apellido; ?>">
        </div>
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email Usuario" value="<?php echo $cliente->email; ?>">
        </div>
        <div class="campo">
            <label for="telefono">Telefono</label>
            <input type="tel" name="telefono" id="telefono" placeholder="Telefono Usuario" value="<?php echo $cliente->telefono; ?>"  pattern="^\+\d{1,3}\s?\d{4,14}$" title="El teléfono debe tener un formato internacional válido, por ejemplo: +52 1234567890"> 

            <label for="pais">Pais</label>
           <select name="pais" id="pais">
            <option disabled>-- Seleccione un país --</option>
            <option value="Honduras" <?php echo $cliente->pais === 'Honduras' ? 'selected' : ''; ?>>Honduras</option>
            <option value="México" <?php echo $cliente->pais === 'México' ? 'selected' : ''; ?>>México</option>
            <option value="Estados Unidos" <?php echo $cliente->pais === 'Estados Unidos' ? 'selected' : ''; ?>>Estados Unidos</option>
            <option value="Canadá" <?php echo $cliente->pais === 'Canadá' ? 'selected' : ''; ?>>Canadá</option>
            <option value="España" <?php echo $cliente->pais === 'España' ? 'selected' : ''; ?>>España</option>
            <option value="Argentina" <?php echo $cliente->pais === 'Argentina' ? 'selected' : ''; ?>>Argentina</option>
        </select>
        </div>
        <input type="submit" value="Actualizar Usuario" class="boton boton-verde">
    </fieldset>
    <a href="/admin/index" class="boton">Volver</a>
</form>