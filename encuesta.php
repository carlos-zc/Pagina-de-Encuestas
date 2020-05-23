<?php 
    include_once "includes/templates/header.php"; 
    include_once "includes/funciones/bd_conexion.php";
    include_once "includes/funciones/funciones.php";
    $id = $_GET['id']; 
    
    
    $sql_encuesta = mysqli_query($conn, "SELECT `titulo` FROM `encuesta` WHERE `id_encuesta`=$id");
    $row_encuesta = mysqli_fetch_assoc($sql_encuesta);
?>

<main>
    <div class="seccion contenedor parte-central">
        <div class="encuesta">
            <h2><?php echo $row_encuesta['titulo']; ?></h2>
            <form action="">
                <?php
                    $letras=['1' => 'A', '2' => 'B', '3' => 'C', '4' => 'D', '5' => 'E', '6' => 'F', '7' => 'G'];
                    $p=1;
                    $sql_pregunta = mysqli_query($conn, "SELECT `pregunta`, `id_pregunta` FROM `pregunta` WHERE `id_enc_pregunta`=$id");
                    while($row_pregunta = mysqli_fetch_assoc($sql_pregunta)){
                        $r=1;
                        echo '<div class="form-encuesta">
                            <p class="pregunta">'.$p.'- '.$row_pregunta['pregunta'].'</p>';
                        $sql_respuesta = mysqli_query($conn, "SELECT `respuesta`, `id_respuesta` FROM `respuesta` WHERE `id_preg_respuesta`=$row_pregunta[id_pregunta]");
                            while($row_respuesta = mysqli_fetch_assoc($sql_respuesta)){
                                echo '<div class="respuesta">
                                    <input type="radio" name="p'.$row_pregunta['id_pregunta'].'" id="r'.$row_respuesta['id_respuesta'].'" value="'.$row_respuesta['id_respuesta'].'">
                                    <label for="r'.$row_respuesta['id_respuesta'].'">'.$letras[$r].') '.$row_respuesta['respuesta'].'</label>
                                </div>';
                                $r++;
                            }
                        echo '</div>';
                        $p++;
                    }
                ?>
                <?php if(!propietarioEncuesta($id) && !realizado($id)):
                    // Muestra el submit si no eres el creador y si no la haz respondido anteriormente?>
                    <input type="hidden" name="id_encuesta" id="id_encuesta" value="<?= $id ?>">
                    <input type="submit" id="responder" value="Terminar" class="boton boton-terciario">
                <?php endif; ?>
                <?php if(realizado($id)) { ?>
                    <p class="realizado">Ya ha respondido esta encuesta, puedes elegir otra 
                        <a href="buscar_encuestas.php" style='color: dodgerblue'>pulsando aqui</a>
                    </p>
                <?php } ?>
            </form>
        </div><!-- .encuesta -->
    </div>
</main>

<?php include_once "includes/templates/footer.php"; ?>
