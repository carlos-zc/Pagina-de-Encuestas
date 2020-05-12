<?php 
    include_once "includes/templates/header.php";  
    include_once "includes/funciones/funciones.php";  
?>

<main>
    <div class="seccion contenedor parte-central">
        <h2 class="centrado">Ver otras Encuestas</h2>
        <div class="listado-encuestas">
            <?php 
                $encuestas = obtenerEncuestas();
                if($encuestas->num_rows > 0){
                    // si hay resultados
                    foreach($encuestas as $encuesta){ 
                        $id = $encuesta['id_encuesta'];
                        $cant = obtenerTotalPreguntas($id)->fetch_assoc();
                        ?>
                        <a class="contenedor-encuesta" href="encuesta.php?id=<?= $id ?>">
                            <h3><?= $encuesta['titulo'] ?></h3>
                            <p>Cantidad de preguntas: <span><?= $cant['total'] ?></span></p>
                        </a>
                    <?php }
                } else {
                    // no hay resultados
                    echo "<p>No hay ninguna encuesta de otros creadores, puedes ver como van las tuyas <a href='adm_encuestas.php' style='color: dodgerblue'>pulsando aqui</a></p>";
                }
            ?>
        </div>
    </div>
</main>

<?php include_once "includes/templates/footer.php"; ?>