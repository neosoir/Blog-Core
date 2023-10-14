<?php require_once 'includes/redireccion.php' ?>
<?php require_once 'includes/cabecera.php' ?>
<?php $categorias = conseguir_categorias( $db ) ?>

<?php 

    // Redirect rules.
    if ( !isset( $_GET['id'] ) || empty( $_GET['id'] ) ) 
        header( "Location: index.php" );

    else {

        $entrada = conseguir_entrada( $db, $_GET['id'] );
        if ( !isset( $entrada['id'] ) ) 
            header( "Location: index.php" );

    }


?>
    <?php require_once 'includes/lateral.php' ?>

    <div id="principal">
        <h1>Editar Entradas</h1>
        <p>Edita tu entrada: <?= $entrada['titulo'] ?></p>
        <br/>
        <form action="guardar-entrada.php?editar=<?= $entrada['id'] ?>" method="POST">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" value="<?= $entrada['titulo'] ?>">
            <?php echo isset( $_SESSION['errores_entrada'] ) ? mostrarError( $_SESSION['errores_entrada'], 'titulo' ) : '' ?>

            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" cols="30" rows="10"><?= $entrada['descripcion'] ?></textarea>
            <?php echo isset( $_SESSION['errores_entrada'] ) ? mostrarError( $_SESSION['errores_entrada'], 'descripcion' ) : '' ?>

            <select name="categoria">
                <option value="">Selecciona<option>
                <?php if( !empty( $categorias ) ) : ?>
                    <?php while ( $categoria = mysqli_fetch_assoc( $categorias )) : ?>
                        <option value="<?= $categoria['id'] ?>" <?= ( $categoria['id'] == $entrada['categoria_id'] ) ? 'selected="selected"' : '' ?>><?= $categoria['nombre'] ?><option>
                    <?php endwhile ; ?>
                <?php endif ; ?>
            </select>
            <?php echo isset( $_SESSION['errores_entrada'] ) ? mostrarError( $_SESSION['errores_entrada'], 'categoria' ) : '' ?>

            <input type="submit" value="Guardar">
        </form>
        <?php borrarErrores(); ?>
    </div>

<?php require_once 'includes/pie.php' ?>
