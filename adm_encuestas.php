<?php 
    include_once "includes/templates/header.php";  
    include_once "includes/funciones/funciones.php";  
?>

<main>
    <div class="seccion contenedor parte-central">
        <h2 class="centrado">Administra tus Encuestas</h2>
        <div class="listado-encuestas">
            <?php 
                $encuestas = obtenerEncuestasPropias();
                if($encuestas->num_rows > 0){
                    // si hay resultados
                    foreach($encuestas as $encuesta){ 
                        $id = $encuesta['id_encuesta'];
                        $realizado = obtenerVecesRealizada($id)->fetch_assoc();
                        ?>
                        <a class="contenedor-encuesta" href="encuesta.php?id=<?= $id ?>">
                            <h3><?= $encuesta['titulo'] ?></h3>
                            <p>Veces realizada: <span><?= $realizado['total'] ?></span></p>
                        </a>
                    <?php }
                } else {
                    // no hay resultados
                    echo "<p>Aun no has creado ninguna encuesta, puedes crear una ahora <a href='nueva_encuesta.php' style='color: dodgerblue'>pulsando aqui</a></p>";
                }
            ?>
        </div>
    </div>
</main>

<?php include_once "includes/templates/footer.php"; ?>