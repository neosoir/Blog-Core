<?php require_once 'includes/redireccion.php' ?>
<?php require_once 'includes/cabecera.php' ?>
<?php $categorias = conseguir_categorias( $db ) ?>
    <?php require_once 'includes/lateral.php' ?>

    <div id="principal">
        <h1>Crear Entradas</h1>
        <p>Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido</p>
        <br/>
        <form action="guardar-entrada.php" method="POST">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo">
            <?php echo isset( $_SESSION['errores_entrada'] ) ? mostrarError( $_SESSION['errores_entrada'], 'titulo' ) : '' ?>

            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" cols="30" rows="10"></textarea>
            <?php echo isset( $_SESSION['errores_entrada'] ) ? mostrarError( $_SESSION['errores_entrada'], 'descripcion' ) : '' ?>

            <select name="categoria">
                <option value="">Selecciona<option>
                <?php if( !empty( $categorias ) ) : ?>
                    <?php while ( $categoria = mysqli_fetch_assoc( $categorias )) : ?>
                        <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?><option>
                    <?php endwhile ; ?>
                <?php endif ; ?>
            </select>
            <?php echo isset( $_SESSION['errores_entrada'] ) ? mostrarError( $_SESSION['errores_entrada'], 'categoria' ) : '' ?>

            <input type="submit" value="Guardar">
        </form>
        <?php borrarErrores(); ?>
    </div>

<?php require_once 'includes/pie.php' ?>
