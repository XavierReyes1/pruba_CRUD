
    <h1>Iniciar sesión</h1>
   
    <form method="POST" class="formulario">
               <?php include_once __DIR__ . '/../alertas.php';?>
        <fieldset>
            <legend>Iniciar sesión</legend>
        
<div class="campo">
        <label for="">Email: </label>
            <input type="email" name="email"  value="<?php echo $usuario->email ?? ''; ?>" placeholder="Ingresa tu email" >
       
        </div>
        <div class="campo">
        <label for="password">Contraseña:   </label>
            <input type="password" name="password"  id="password" placeholder="Ingresa tu password" >
            </div>
        <button type="submit" class="boton boton-verde">Entrar</button>

        </fieldset>
    </form>


