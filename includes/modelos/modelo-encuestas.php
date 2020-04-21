<?php 

if($_POST['accion'] == 'crear') {
    // creara un nuevo registro en la base de datos
    require_once('../funciones/bd_conexion.php');

    $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_STRING); // estos filtros impiden que agregen contenido html

    try {
        // Insercion de datos mediante prepared statements
        $stmt = $conn->prepare("INSERT INTO encuesta (titulo) VALUES (?)");
        $stmt->bind_param("s", $titulo);
        $stmt->execute();
        $idEncuesta = $conn->insert_id;

        $i = 1;
        while($_POST['pregunta'.$i]) {
            $pregunta = filter_var($_POST['pregunta'.$i]['pregunta'], FILTER_SANITIZE_STRING);

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

        $ip = $_SERVER['REMOTE_ADDR'];
        $stmt = $conn->prepare("INSERT INTO usuario (ip_usuario, id_enc_usuario) VALUES (?,?)");
        $stmt->bind_param("si", $ip, $idEncuesta);
        $stmt->execute();

        $respuesta = [
            'respuesta' => 'correcto',
            'id' => $idEncuesta
        ];
        $stmt->close();
        $conn->close();
        
    } catch(Exception $e){
        $respuesta = [
            'error' => $e->getMessage()
        ];
    }

    echo json_encode($respuesta);


} else {
    echo json_encode($_POST);
}


?>