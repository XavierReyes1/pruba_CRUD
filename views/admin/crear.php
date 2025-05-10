<form method="POST" class="formulario">
    <?php include_once __DIR__ . '/../alertas.php'; ?>
    <fieldset>
        <legend>Crear Usuario</legend>
        <div class="campo">
            <label>Nombre</label>
            <input type="text" name="nombre" required>
        </div>
        <div class="campo">
            <label>Apellido</label>
            <input type="text" name="apellido" required>
        </div>
        <div class="campo">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="campo">
            <label>Teléfono</label>
            <input type="tel" name="telefono" pattern="^\+\d{1,3}\s?\d{4,14}$" title="Ej: +504 12345678" required>
        </div>
        <div class="campo">
            <label>País</label>
            <select name="pais" required>
                <option disabled selected>-- Selecciona --</option>
                <option>Honduras</option>
                <option>México</option>
                <option>Estados Unidos</option>
                <option>Canadá</option>
                <option>España</option>
                <option>Argentina</option>
            </select>
        </div>
        <input type="submit" class="boton boton-verde" value="Crear Usuario">
    </fieldset>
    <a href="/admin/index" class="boton">Volver</a>
</form>
