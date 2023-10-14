<?php
// Conexion.
$seridor        =   'localhost';
$usuario        =   'neo';
$password       =   'hi mysql';
$basededatos    =   'blog';
$db             =   mysqli_connect( $seridor, $usuario, $password, $basededatos );

mysqli_query( $db, "SET NAMES 'utf8'" );

// Inicial sesion.
if ( !isset( $_SESSION ) ) 
    session_start();
