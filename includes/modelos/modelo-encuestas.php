<?php 
require_once('../funciones/funciones.php');

if($_POST['accion'] == 'crear') {
    // creara un nuevo registro en la base de datos
    require_once('../funciones/bd_conexion.php');

    $titulo = $_POST['titulo'];

    try {
        // Insercion de datos mediante prepared statements
        $stmt = $conn->prepare("INSERT INTO encuesta (titulo) VALUES (?)");
        $stmt->bind_param("s", $titulo);
        $stmt->execute();
        $idEncuesta = $conn->insert_id;

        $i = 1;
        while($_POST['pregunta'.$i]) {
            $pregunta = $_POST['pregunta'.$i]['pregunta'];

            $stmt = $conn->prepare("INSERT INTO pregunta (pregunta, id_enc_pregunta) VALUES (?,?)");
            $stmt->bind_param("si", $pregunta, $idEncuesta);
            $stmt->execute();
            $idPregunta = $stmt->insert_id;
            
            foreach($_POST['pregunta'.$i]['respuestas'] as $respuesta) {    
                $stmt = $conn->prepare("INSERT INTO respuesta (respuesta, id_preg_respuesta) VALUES (?,?)");
                $stmt->bind_param("si", $respuesta, $idPregunta);
                $stmt->execute();
            }
            $i++;
        }

        $ip = getIpUsuario();
        $accion = 'creador';
        $stmt = $conn->prepare("INSERT INTO usuario (ip_usuario, id_enc_usuario, accion) VALUES (?,?,?)");
        $stmt->bind_param("sis", $ip, $idEncuesta, $accion);
        $stmt->execute();

        $respuesta = [
            'respuesta' => 'correcto',
            'id' => $idEncuesta,
            'accion' => 'crear'
        ];
        $stmt->close();
        $conn->close();
        
    } catch(Exception $e){
        $respuesta = [
            'error' => $e->getMessage()
        ];
    }

    die(json_encode($respuesta));

}

if($_POST['accion'] == 'responder') {
    // guardara la respuesta en la base de datos
    require_once('../funciones/bd_conexion.php');

    $id_encuesta = $_POST['id_encuesta'];
    $id_respuestas = explode(",", $_POST['respuestas']);

    try {
        foreach ($id_respuestas as $id) {
            // Insercion de datos mediante prepared statements
            $stmt = $conn->prepare("UPDATE respuesta SET conteo = conteo + 1 WHERE id_respuesta = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
        

        $ip = getIpUsuario();
        $accion = 'encuestado';
        $stmt = $conn->prepare("INSERT INTO usuario (ip_usuario, id_enc_usuario, accion) VALUES (?,?,?)");
        $stmt->bind_param("sis", $ip, $id_encuesta, $accion);
        $stmt->execute();

        $respuesta = [
            'respuesta' => 'correcto',
            'id' => $id_encuesta,
            'accion' => 'responder'
        ];
        $stmt->close();
        $conn->close();
        
    } catch(Exception $e){
        $respuesta = [
            'error' => $e->getMessage()
        ];
    }

    die(json_encode($respuesta));

}

?>