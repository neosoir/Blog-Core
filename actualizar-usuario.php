<?php

// Validar formulario;
if ( isset( $_POST['submit'] ) ) {

    // Conexion a la base de datos.
    require_once 'includes/conexion.php';
    
    $nombre     =   isset( $_POST['nombre'] )    ? mysqli_real_escape_string( $db, $_POST['nombre'] ) : false;
    $apellido   =   isset( $_POST['apellidos'] ) ? mysqli_real_escape_string( $db, $_POST['apellidos'] ) : false;
    $email      =   isset( $_POST['email'] )     ? mysqli_real_escape_string( $db, trim( $_POST['email'] ) ) : false;
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

    $guardar_usuario = false;

    // Insert user.
    if ( count( $errores ) == 0 ) {

        $guardar_usuario    =   true;
        $usuario            =  $_SESSION['usuario'];

        // Comprobar si existe el usuario.
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query( $db, $sql );
        $isset_user  = mysqli_fetch_assoc( $isset_email );

        if ( $isset_user['id'] == $usuario['id'] || empty( $isset_user ) ) {

            $sql =  "UPDATE usuarios SET
                        nombre      = '$nombre',
                        apellidos   = '$apellido',
                        email       = '$email'
                        WHERE id = " . $usuario['id']
                    ;
    
    
            // Validar si existe el correo electronico.
            $guardar = mysqli_query( $db, $sql );
    
            if ( $guardar ) {
    
                $_SESSION['usuario']['nombre']      = $nombre;
                $_SESSION['usuario']['apellidos']   = $apellido;
                $_SESSION['usuario']['email']       = $email;
                $_SESSION['completado']             = "Tus datos se ha actualizado con exito";
    
            }
    
            else 
                $_SESSION['errores']['general'] = "Fallo al guardar actualizar el usuario";

        }
        else 
            $_SESSION['errores']['general'] = "El usuario ya existe";
    
    }
    else 
        $_SESSION['errores'] = $errores;
    
}

header('Location: mis-datos.php');