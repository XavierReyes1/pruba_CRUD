


<form action="" method="post" class="formulario">
    <fieldset>
        <legend>Actualizar Usuario</legend>
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre Usuario" required value="<?php echo $cliente->nombre; ?>">
        </div>
        <div class="campo">
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" placeholder="Apellido Usuario" required value="<?php echo $cliente->apellido; ?>">
        </div>
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Email Usuario" required value="<?php echo $cliente->email; ?>">
        </div>
        <div class="campo">
            <label for="telefono">Telefono</label>
            <input type="tel" name="telefono" id="telefono" placeholder="Telefono Usuario" value="<?php echo $cliente->telefono; ?>">
        </div>
        <div class="campo">
            <label for="pais">Pais</label>
            <input type="text" name="pais" id="pais" placeholder="Pais Usuario" value="<?php echo $cliente->pais; ?>">
        </div>
        <input type="submit" value="Actualizar Usuario">
    </fieldset>
</form>