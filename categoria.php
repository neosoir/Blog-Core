<?php require_once 'includes/cabecera.php' ?>
<?php 

    // Redirect rules.
    if ( !isset( $_GET['id'] ) || empty( $_GET['id'] ) ) 
        header( "Location: index.php" );

    else {

        $categoria = conseguir_categoria( $db, $_GET['id'] );
        if ( !isset( $categoria['id'] ) ) 
            header( "Location: index.php" );

    }

    $entradas = conseguir_entradas( $db, null, $_GET['id'] );


?>
    
    <?php require_once 'includes/lateral.php' ?>

    <!-- Caja Principal. -->
    <div id="principal">
        <h1>Entradas de <?= $categoria['nombre'] ?></h1>

        <?php if( !empty( $entradas ) && mysqli_num_rows( $entradas ) >= 1 ) : ?>
            <?php while ( $entrada = mysqli_fetch_assoc( $entradas )) : ?>
                <a href="entrada.php?id=<?= $entrada['id'] ?>">
                    <article class="entrada">
                        <h2><?= $entrada['titulo'] ?></h2>
                        <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha'] ?></span>
                        <p><?= substr( $entrada['descripcion'], 0, 200) ?>...</p>
                    </article>
                </a>
            <?php endwhile ; ?>
        <?php else : ?>
            <div class="alerta">No hay entradas en esta categoria</div>
        <?php endif ; ?>

    </div>

<?php require_once 'includes/pie.php' ?>
