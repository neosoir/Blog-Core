<!-- Sidebar. -->
<aside id="sidebar">

    <div id="buscador" class="bloque">
        <h3>Buscar</h3>
        <form action="buscar.php" method="POST">
            <input type="text" name="busqueda"/>
            <input type="submit" value="Buscar"/>
        </form>
    </div>


    <?php if( isset( $_SESSION['usuario'] ) ) : ?>
        <div class="bloque" id="usuario-logueado">
            <h3>Bienvenido <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos'] ?> </h3>
            <a href="crear-entrada.php" class="boton boton-verde">Crear entradas</a>
            <a href="crear-categoria.php" class="boton">Crear categorias</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="cerrar.php" class="boton boton-rojo">Cerrar Sesión</a>
        </div>
    <?php else : ?>
        <div id="login" class="bloque">
            <h3>Identificate</h3>
            <?php if( isset( $_SESSION['error_login'] ) ) : ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['error_login'] ?>
                </div>
            <?php endif ; ?>

            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email"/>
                <label for="password">Contraseña</label>
                <input type="password" name="password"/>
                <input type="submit" value="Entrar"/>
            </form>
        </div>
        <div id="register" class="bloque">
            <h3>Registro</h3>
            <form action="registro.php" method="POST">
                <?php if( isset( $_SESSION['completado'] ) ) : ?>
                    <div class="alerta alerta-exito">
                        <?= $_SESSION['completado'] ?>
                    </div>
                <?php elseif ( $_SESSION['errores']['general'] ) : ?>
                    <div class="alerta alerta-error">
                        <?= $_SESSION['errores']['general'] ?>
                    </div>
                <?php endif ; ?>
                <!-- Nombre. -->
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre"/>
                <?php echo isset( $_SESSION['errores'] ) ? mostrarError( $_SESSION['errores'], 'nombre' ) : '' ?>

                <!-- Apellidos. -->
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos"/>
                <?php echo isset( $_SESSION['errores'] ) ? mostrarError( $_SESSION['errores'], 'apellidos' ) : '' ?>

                <!-- Email. -->
                <label for="email">Email</label>
                <input type="email" name="email"/>
                <?php echo isset( $_SESSION['errores'] ) ? mostrarError( $_SESSION['errores'], 'email' ) : '' ?>

                <!-- Contraseña. -->
                <label for="password">Contraseña</label>
                <input type="password" name="password"/>
                <?php echo isset( $_SESSION['errores'] ) ? mostrarError( $_SESSION['errores'], 'password' ) : '' ?>

                <!-- Submit. -->
                <input type="submit" name="submit" value="Registrar"/>
            </form>
            <?php borrarErrores(); ?>
        </div>
    <?php endif ; ?>

</aside>