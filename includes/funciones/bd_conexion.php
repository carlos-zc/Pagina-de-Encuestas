<?php
    $conn = new mysqli('sql10.freesqldatabase.com', 'sql10353817', 'sSGtN7BDP3', 'sql10353817');

    if( $conn -> connect_error) {
        echo $error -> $conn -> connect_error;
    }
?>