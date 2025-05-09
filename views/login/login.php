
    <h1>Iniciar sesión</h1>
   
    <form method="POST" >
       <?php include_once __DIR__ . '/../alertas.php';?>
        <label>Email:<br>
            <input type="email" name="email"  value="<?php echo $usuario->email; ?>" >
        </label><br><br>
        <label>Contraseña:<br>
            <input type="password" name="password" >
        </label><br><br>
        <button type="submit">Entrar</button>
    </form>


