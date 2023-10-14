<?php

// Validar formulario;
if ( isset( $_POST['submit'] ) ) {

    // Conexion a la base de datos.
    require_once 'includes/conexion.php';
    
    $nombre     =   isset( $_POST['nombre'] )    ? mysqli_real_escape_string( $db, $_POST['nombre'] ) : false;
    $apellido   =   isset( $_POST['apellidos'] ) ? mysqli_real_escape_string( $db, $_POST['apellidos'] ) : false;
    $email      =   isset( $_POST['email'] )     ? mysqli_real_escape_string( $db, trim( $_POST['email'] ) ) : false;
    $password   =   isset( $_POST['password'] )  ? mysqli_real_escape_string( $db, $_POST['password'] ) : false;
    $errores    =   [];

    // Nombre.
    if  ( 
            !empty( $nombre ) 
            && !is_numeric( $nombre ) 
            && !preg_match("/[0-9]/", $nombre) 
        ) 
        $nombre_validado = true;

    else {
        $nombre_validado = false;
        $errores['nombre'] = "El nombre es no es valido";
    }

    // Apellidos.
    if  ( 
            !empty( $apellido ) 
            && !is_numeric( $apellido ) 
            && !preg_match("/[0-9]/", $apellido) 
        ) 
        $apellido_validado = true;

    else {
        $apellido_validado = false;
        $errores['apellidos'] = "El apellido es no es valido";
    }

    // Email.
    if  ( 
            !empty( $email ) 
            && filter_var( $email, FILTER_VALIDATE_EMAIL )
        ) 
        $email_validado = true;

    else {
        $email_validado = false;
        $errores['email'] = "El email es incorrecto";
    }

    // Password.
    if  ( !empty( $password ) ) 
        $password_validado = true;

    else {
        $password_validado = false;
        $errores['password'] = "La contraseña esta vacia";
    }

    $guardar_usuario = false;

    // Insert user.
    if ( count( $errores ) == 0 ) {
        $guardar_usuario = true;

        // Cifrar la contraseña.
        $password_segura = password_hash( $password, PASSWORD_BCRYPT, ['cost' => 4] );

        $sql = "INSERT INTO usuarios VALUES( null, '$nombre', '$apellido', '$email', '$password_segura', CURDATE() )";

        // Validar si existe el correo electronico.
        $guardar = mysqli_query( $db, $sql );

        if ( $guardar ) 
            $_SESSION['completado'] = "El resgistro se ha completado con exito";

        else 
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";

    }
    else 
        $_SESSION['errores'] = $errores;
    
}
header('Location: index.php');