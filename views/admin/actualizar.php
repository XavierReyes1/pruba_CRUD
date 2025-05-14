<form id="formulario-actualizar" method="POST" class="formulario">
    <?php include_once __DIR__ . '/../alertas.php'; ?>
    <fieldset>
        <legend>Actualizar Usuario</legend>
        <div class="campo">
            <label>Nombre</label>
            <input type="text" name="nombre" value="<?php echo $cliente->nombre; ?>" required>
        </div>
        <div class="campo">
            <label>Apellido</label>
            <input type="text" name="apellido" value="<?php echo $cliente->apellido; ?>" required>
        </div>
        <div class="campo">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $cliente->email; ?>" required>
        </div>
        <div class="campo">
            <label>Teléfono</label>
            <input type="tel" name="telefono" value="<?php echo $cliente->telefono; ?>" pattern="^\+\d{1,3}\s?\d{4,14}$" >
        </div>
        <div class="campo">
            <label>País</label>
            <select name="pais" required>
                <?php
                    $paises = ['Honduras', 'México', 'Estados Unidos', 'Canadá', 'España', 'Argentina'];
                    foreach ($paises as $pais) {
                        $selected = $cliente->pais === $pais ? 'selected' : '';
                        echo "<option value=\"$pais\" $selected>$pais</option>";
                    }
                ?>
            </select>
        </div>
        <input type="hidden" name="id" value="<?php echo $cliente->id; ?>">
        <input type="submit" class="boton boton-verde" value="Actualizar Usuario">
    </fieldset>
    <a href="/admin/index" class="boton">Volver</a>
</form>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/build/app.js"></script>