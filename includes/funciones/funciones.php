<?php 

function obtenerEncuestasPropias() {
    include "bd_conexion.php";
    $ip = $_SERVER['REMOTE_ADDR'];
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
    $ip = $_SERVER['REMOTE_ADDR'];
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