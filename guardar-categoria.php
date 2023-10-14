<?php

if ( isset( $_POST ) ) {

    require_once 'includes/conexion.php';

    $nombre     =   isset( $_POST['nombre'] ) ? mysqli_real_escape_string( $db, $_POST['nombre'] ) : false;
    $errores    =   [];

    // Nombre.
    if  ( !empty( $nombre ) ) 
        $nombre_validado = true;

    else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre es no es valido";
    }

    // Insert user.
    if ( count( $errores ) == 0 ) {

        $sql                =   "INSERT INTO categorias VALUES( null, '$nombre' )";
        $guardar            =   mysqli_query( $db, $sql );

        if ( $guardar ) 
            $_SESSION['completado'] = "La categoria se ha con exito";

        else 
            $_SESSION['errores']['general'] = "Fallo al guardar la categoria";

    }
    else 
        $_SESSION['errores'] = $errores;

}
header('Location: index.php');
