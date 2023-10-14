<?php require_once 'includes/redireccion.php' ?>
<?php require_once 'includes/cabecera.php' ?>
    <?php require_once 'includes/lateral.php' ?>

    <div id="principal">

        <div id="register" class="bloque">
            <h1>Mis datos</h1>
            <form action="actualizar-usuario.php" method="POST">
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
                <input type="text" name="nombre" value="<?= $_SESSION['usuario']['nombre'] ?>"/>
                <?php echo isset( $_SESSION['errores'] ) ? mostrarError( $_SESSION['errores'], 'nombre' ) : '' ?>

                <!-- Apellidos. -->
                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" value="<?= $_SESSION['usuario']['apellidos'] ?>"/>
                <?php echo isset( $_SESSION['errores'] ) ? mostrarError( $_SESSION['errores'], 'apellidos' ) : '' ?>

                <!-- Email. -->
                <label for="email">Email</label>
                <input type="email" name="email" value="<?= $_SESSION['usuario']['email'] ?>"/>
                <?php echo isset( $_SESSION['errores'] ) ? mostrarError( $_SESSION['errores'], 'email' ) : '' ?>

                <!-- Submit. -->
                <input type="submit" name="submit" value="Actualizar"/>
            </form>
            <?php borrarErrores(); ?>
        </div>
 

    </div>

<?php require_once 'includes/pie.php' ?>
