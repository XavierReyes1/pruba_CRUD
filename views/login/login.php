
    <h1>Iniciar sesión</h1>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" action="/login">
        <label>Email:<br>
            <input type="email" name="email" required>
        </label><br><br>
        <label>Contraseña:<br>
            <input type="password" name="password" required>
        </label><br><br>
        <button type="submit">Entrar</button>
    </form>


