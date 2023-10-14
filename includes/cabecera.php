<?php require_once 'conexion.php' ?>
<?php require_once 'helpers.php' ?>
<?php $categorias = conseguir_categorias( $db ) ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Videojuegos</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <!-- Header. -->
    <header id="cabecera">
        <!-- Logo -->
        <div id="logo">
            <a href="index.php">Blog Videojuegos</a>
        </div>
        <!-- Menu. -->

        <nav id="menu">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                
                <?php if( !empty( $categorias ) ) : ?>
                    <?php while ( $categoria = mysqli_fetch_assoc( $categorias )) : ?>
                        <li><a href="categoria.php?id=<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></a></li>
                    <?php endwhile ; ?>
                <?php endif ; ?>

                <li><a href="index.php">Sobre mi</a></li>
                <li><a href="index.php">Contacto</a></li>
            </ul>
        </nav>
        <div class="clearfix"></div>
    </header>
    <main id="contenedor">

