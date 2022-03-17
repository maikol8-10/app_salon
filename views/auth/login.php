<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inciar sesion con tus datos</p>

<form class="formulario" method="post" action="/">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Tu Email">
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" name="password" placeholder="Tu Password">
    </div>

    <input type="submit" class="boton" value="Iniciar Sesion" /></input>
</form>

<div class="acciones">
    <a href="/crear-cuenta" class="">Aún no tienes una cuenta? Crear cuenta</a>
    <a href="/olvide" class="">Olvides tu password</a>
</div>