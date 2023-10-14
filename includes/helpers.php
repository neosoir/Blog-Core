<?php

function mostrarError( $errores, $campo ) {

    $alerta = '';

    if ( isset( $errores[$campo] ) && !empty($campo) )
        $alerta = "<div class='alerta alerta-error'>" . $errores[$campo] . "</div>";

    return $alerta;

}

function borrarErrores() {

    $borrado = false;

    if ( isset( $_SESSION['errores'] ) )
        $_SESSION['errores'] = null;

    if ( isset( $_SESSION['completado'] ) )
        $_SESSION['completado'] = null;

    if ( isset( $_SESSION['errores_entrada'] ) )
        $_SESSION['errores_entrada'] = null;

    //$borrado    =  session_unset();

    return $borrado;
}

function conseguir_categorias( $db ) {

    $sql        = "SELECT * FROM categorias ORDER BY id ASC";
    $categorias = mysqli_query( $db, $sql );
    $result     = [];

    if ( $categorias && mysqli_num_rows( $categorias ) >= 1 ) 
        $result = $categorias;
    
    return $result;

}

function conseguir_categoria( $db, $id ) {

    $sql        = "SELECT * FROM categorias WHERE id = $id";
    $categorias = mysqli_query( $db, $sql );
    $result     = [];

    if ( $categorias && mysqli_num_rows( $categorias ) >= 1 ) 
        $result = mysqli_fetch_assoc( $categorias );
    
    return $result;

}

function conseguir_entradas( $db, $limit = null, $categoria = null, $busqueda = null ) {

    $sql =  "SELECT e.*, c.nombre as 'categoria' FROM entradas e
                INNER JOIN categorias c ON e.categoria_id = c.id
            ";

    if ( $categoria ) 
        $sql .= " WHERE e.categoria_id = $categoria " ;

    if ( $busqueda ) 
        $sql .= " WHERE e.titulo LIKE '%$busqueda%' " ;

    $sql .= ' ORDER BY e.id DESC '; 

    if ( $limit ) 
        $sql .= " LIMIT $limit" ;


    $entradas   = mysqli_query( $db, $sql );
    $result     = [];

    if ( $entradas && mysqli_num_rows( $entradas ) >= 1 ) 
        $result = $entradas;

    return $entradas;

}

function conseguir_entrada( $db, $id ) {

    $sql        = "SELECT e.*, c.nombre AS 'categoria', CONCAT( u.nombre, ' ', u.apellidos )  AS 'usuario' FROM entradas e "
                    . "INNER JOIN categorias c ON e.categoria_id = c.id " 
                    . "INNER JOIN usuarios u ON e.usuario_id = u.id " 
                    . "WHERE e.id = $id";
    $entrada    = mysqli_query( $db, $sql );
    $result     = [];

    if ( $entrada && mysqli_num_rows( $entrada ) >= 1 ) 
        $result = mysqli_fetch_assoc( $entrada );
    
    return $result;

}

