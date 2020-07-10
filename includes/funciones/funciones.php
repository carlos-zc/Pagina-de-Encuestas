<?php 

function obtenerEncuestasPropias() {
    include "bd_conexion.php";
    $ip = getIpUsuario();
    try {
        $sql = "SELECT titulo, id_encuesta FROM usuario";
        $sql .= " INNER JOIN encuesta ON usuario.id_enc_usuario = encuesta.id_encuesta";
        $sql .= " WHERE ip_usuario = '$ip' AND accion = 'creador' ORDER BY id_encuesta";
        return $conn->query($sql);
    } catch(Exception $e) {
        echo "Error!!". $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerVecesRealizada($id) {
    include "bd_conexion.php";
    try {
        $sql = "SELECT COUNT(*) AS total FROM usuario";
        $sql .= " WHERE accion = 'encuestado' AND id_enc_usuario = $id";
        return $conn->query($sql);
    } catch(Exception $e) {
        echo "Error!!". $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerEncuestas() {
    include "bd_conexion.php";
    $ip = getIpUsuario();
    try {
        $sql = "SELECT titulo, id_encuesta FROM usuario";
        $sql .= " INNER JOIN encuesta ON usuario.id_enc_usuario = encuesta.id_encuesta";
        $sql .= " WHERE accion = 'creador' AND NOT ip_usuario = '$ip' ORDER BY id_encuesta";
        return $conn->query($sql);
    } catch(Exception $e) {
        echo "Error!!". $e->getMessage() . "<br>";
        return false;
    }
}

function obtenerTotalPreguntas($id) {
    include "bd_conexion.php";
    try {
        $sql = "SELECT COUNT(*) AS total FROM pregunta";
        $sql .= " WHERE id_enc_pregunta = $id";
        return $conn->query($sql);
    } catch(Exception $e) {
        echo "Error!!". $e->getMessage() . "<br>";
        return false;
    }
}

function propietarioEncuesta($id) {
    include "bd_conexion.php";
    $ip = getIpUsuario();
    try {
        $sql = "SELECT accion FROM usuario";
        $sql .= " WHERE id_enc_usuario = $id AND ip_usuario = '$ip' ";
        $respuesta = $conn->query($sql)->fetch_assoc();
        if($respuesta['accion'] == 'creador'){
            return true;
        } else {
            return false;
        }

    } catch(Exception $e) {
        echo "Error!!". $e->getMessage() . "<br>";
    }
}

function realizado($id) {
    include "bd_conexion.php";
    $ip = getIpUsuario();
    try {
        $sql = "SELECT accion FROM usuario";
        $sql .= " WHERE id_enc_usuario = $id AND ip_usuario = '$ip' ";
        $respuesta = $conn->query($sql)->fetch_assoc();
        if($respuesta['accion'] == 'encuestado'){
            return true;
        } else {
            return false;
        }

    } catch(Exception $e) {
        echo "Error!!". $e->getMessage() . "<br>";
    }
}

function getIpUsuario() {

    foreach ( [ 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR' ] as $key ) {

        // Comprobamos si existe la clave solicitada en el array de la variable $_SERVER 
        if ( array_key_exists( $key, $_SERVER ) ) {

            // Eliminamos los espacios blancos del inicio y final para cada clave que existe en la variable $_SERVER 
            foreach ( array_map( 'trim', explode( ',', $_SERVER[ $key ] ) ) as $ip ) {

                // Filtramos* la variable y retorna el primero que pase el filtro
                if ( filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) !== false ) {
                    return $ip;
                }
            }
        }
    }

    return '?'; // Retornamos '?' si no hay ninguna IP o no pase el filtro
} 