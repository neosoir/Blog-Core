<?php require_once 'includes/cabecera.php' ?>
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

    <!-- Caja Principal. -->
    <div id="principal">
        <h1><?= $entrada['titulo'] ?></h1>
        <a href="categoria.php?id=<?= $entrada['categoria_id'] ?>">
            <h2><?= $entrada['categoria'] ?></h2>
        </a>
        <h4><?= $entrada['fecha'] ?> | <?= $entrada['usuario'] ?></h4>
        <p><?= $entrada['descripcion'] ?></p>

        <?php if ( isset( $_SESSION['usuario'] ) && $_SESSION['usuario']['id'] == $entrada['usuario_id'] ) : ?>
            <br/>
            <a href="editar-entrada.php?id=<?= $entrada['id'] ?>" class="boton boton-verde">Editar entrada</a>
            <a href="borrar-entrada.php?id=<?= $entrada['id'] ?>" class="boton">Borrar entrada</a>
        <?php endif ; ?>
    </div>

<?php require_once 'includes/pie.php' ?>
