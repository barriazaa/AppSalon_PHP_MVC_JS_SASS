<h1 class="nombre-pagina">Crear Cuenta </h1>
<p class="descripcion-pagina">Llenar el siguiente formulario</p>

<?php
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" method="POST" action="/crear-cuenta">

    <div class="campo">
        <label for="nombre">Nombre</label>
        <input
            type="text"
            id="nombre"
            placeholder="Tu nombre"
            name="nombre"
            value="<?php echo isset($usuario) ? s($usuario->nombre) : ''; ?>"

        />
    </div>
    <div class="campo">
        <label for="apellido">Apellido</label>
        <input
            type="text"
            id="apellido"
            placeholder="Tu apellido"
            name="apellido"
            value="<?php echo isset($usuario) ? s($usuario->apellido) : ''; ?>"
            
        />
    </div>
    <div class="campo">
        <label for="Telefono">Telefono</label>
        <input
            type="tel"
            id="telefono"
            placeholder="Tu telefono"
            name="telefono"
            value="<?php echo isset($usuario) ? s($usuario->telefono) : ''; ?>"
            
        />
    </div>
    <div class="campo">
        <label for="email">E-mail</label>
        <input
            type="email"
            id="email"
            placeholder="Tu E-mail"
            name="email"
            value="<?php echo isset($usuario) ? s($usuario->email) : ''; ?>"
            
        />
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            placeholder="Tu password"
            name="password"
            
            
        />
    </div>

    <input type="submit" class="boton" value="Crear Cuenta">

</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesion</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>