<?php require_once 'includes/cabecera.php' ?>
<?php $entradas = conseguir_entradas( $db, 4 ) ?>
    
    <?php require_once 'includes/lateral.php' ?>

    <!-- Caja Principal. -->
    <div id="principal">
        <h1>Ultimas Entradas</h1>

        <?php if( !empty( $entradas ) ) : ?>
            <?php while ( $entrada = mysqli_fetch_assoc( $entradas )) : ?>
                <a href="entrada.php?id=<?= $entrada['id'] ?>">
                    <article class="entrada">
                        <h2><?= $entrada['titulo'] ?></h2>
                        <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha'] ?></span>
                        <p><?= substr( $entrada['descripcion'], 0, 200) ?>...</p>
                    </article>
                </a>
            <?php endwhile ; ?>
        <?php endif ; ?>

        <div id="ver-todas">
            <a href="entradas.php">Ver todas las entradas</a>
        </div>
    </div>

<?php require_once 'includes/pie.php' ?>
