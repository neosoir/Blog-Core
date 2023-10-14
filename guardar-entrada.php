<?php

if ( isset( $_POST ) ) {

    require_once 'includes/conexion.php';
    
    $titulo         =   isset( $_POST['titulo'] ) ? mysqli_real_escape_string( $db, $_POST['titulo'] ) : false;
    $descripcion    =   isset( $_POST['descripcion'] ) ? mysqli_real_escape_string( $db, $_POST['descripcion'] ) : false;
    $categoria      =   isset( $_POST['categoria'] ) ? (int)mysqli_real_escape_string( $db, $_POST['categoria'] ) : false;
    $usuario        =   $_SESSION['usuario']['id'];
    $errores        =   [];

    // Titulo.
    if  ( empty( $titulo ) ) 
        $errores['titulo'] = "El titulo es no es valido";

    // Descripcion.
    if  ( empty( $descripcion ) ) 
        $errores['descripcion'] = "El descripcion es no es valido";

    // Descripcion.
    if  ( empty( $categoria ) || !is_numeric( $categoria ) ) 
        $errores['categoria'] = "La categoria es no es valido";

    // Insert user.
    if ( count( $errores ) == 0 ) {

        $entrada_id =   $_GET['editar'];

        if ( isset( $entrada_id ) ) {
            $usuario_id =   $_SESSION['usuario']['id'];
            $sql        =   "UPDATE entradas SET categoria_id = $categoria, titulo = '$titulo', descripcion = '$descripcion' " .
                                "WHERE id = $entrada_id AND usuario_id = $usuario_id";
        }
        else {
            $sql        =   "INSERT INTO entradas VALUES( null, $usuario, $categoria, '$titulo', '$descripcion', CURDATE() )";
        }

        $guardar    =   mysqli_query( $db, $sql );

        header('Location: index.php');
        
    }
    else {

        $_SESSION['errores_entrada'] = $errores;

        if ( isset( $_GET['editar'] ) ) {
            header('Location: editar-entrada.php?id=' . $_GET['editar']);
        }
        else {
            header('Location: crear-entrada.php');
        }

    }


}


