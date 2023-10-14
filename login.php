<?php

if ( isset( $_POST ) ) {

    // Coneccion a la base de datos.
    require_once 'includes/conexion.php';

    // Borrar error antiguo.
    if ( isset( $_SESSION['error_login'] ) ) 
        $_SESSION['error_login'] = null;
    

    $email      = trim( $_POST['email'] );
    $password   = trim( $_POST['password'] );

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if ( $login && ( mysqli_num_rows( $login ) == 1 ) ) {

        $usuario    = mysqli_fetch_assoc( $login );
        $verify     = password_verify( $password, $usuario['password'] );

        if ( $verify ) 
            $_SESSION['usuario'] = $usuario;

        else 
            $_SESSION['error_login'] = 'Login incorrecto';

    }

}

// Redirigir al index
header('Location: index.php');