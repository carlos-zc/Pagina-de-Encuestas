<?php
    $conn = new mysqli('localhost', 'root', 'root', 'tu_encuesta');

    if( $conn -> connect_error) {
        echo $error -> $conn -> connect_error;
    }
?>