<?php include_once "includes/templates/header.php"; ?>

<main>
    <div class="seccion contenedor parte-central">
        <div class="encuesta">
            <h2>Título de la encuesta</h2>
            <form action="">
                <div class="form-encuesta">
                    <p class="pregunta">1- Esta es la primera interrogante a responder</p>
                    <div class="respuesta">
                        <input type="radio" name="respuesta" id="respuesta1" value="1">
                        <label for="respuesta1">A) Esta es, pulsala</label>
                    </div>
                    <div class="respuesta">
                        <input type="radio" name="respuesta" id="respuesta1-2" value="2">
                        <label for="respuesta1-2">B) Esta no es, ¿o si?</label>
                    </div>
                    
                </div><!-- .form-encuesta -->

                <div class="form-encuesta">
                    <p class="pregunta">2- Esta es la segunda interrogante a responder</p>
                    <div class="respuesta">
                        <input type="radio" name="respuesta2" id="respuesta2-1" value="1">
                        <label for="respuesta2-1">A) Esta es, pulsala</label>
                    </div>
                    <div class="respuesta">
                        <input type="radio" name="respuesta2" id="respuesta2-2" value="2">
                        <label for="respuesta2-2">B) Esta no es, ¿o si?</label>
                    </div>
                    
                </div><!-- .form-encuesta -->

                <input type="submit" value="Terminar" class="boton boton-terciario">
            </form>
        </div><!-- .encuesta -->
    </div>
</main>

<?php include_once "includes/templates/footer.php"; ?>
