<?php include_once "includes/templates/header.php"; ?>

<main>
    <div class="seccion contenedor parte-central">
        <form action="#">
            <div class="crea-encuesta">
                <div class="inicio-encuesta">
                    <div class="titulo-encuesta">
                        <label for="titulo">Título:</label>
                        <input type="text" name="titulo" id="titulo" maxlength="50" placeholder="¿De qué tratará esta encuesta?">
                    </div>
                    <div class="nro-preguntas">
                        <label for="cantidad-preguntas">Número de preguntas a realizar:</label>
                        <input type="number" name="cantidad-preguntas" id="cantidad-preguntas" min="1" max="30" placeholder="1" value="1">
                    </div>
                    
                    <button id="comenzar" class="boton boton-secundario">Comenzar</button>
                </div><!-- .inicio-encuesta -->
                
                <div class="contenedor-padre" style="display: none">
                    <h3>Contenido de las preguntas</h3>
                    <div class="contenedor-preguntas">
                        <div class="datos-preguntas">
                            <div class="formulario-alineado">
                                <div class="pregunta-encuesta">
                                    <label for="pregunta">Pregunta #1</label>
                                    <input type="text" name="pregunta" id="pregunta" maxlength="90" placeholder="¿Qué deseas preguntar?">
                                </div>
                                <div class="cant-respuestas">
                                    <label for="nro-respuestas">Cantidad de respuestas posibles</label>
                                    <input type="number" name="nro-respuestas" id="nro-respuestas" min="2" max="10" placeholder="2" value="2">
                                </div>
                            </div>
                    
                            <div class="contenedor-respuestas">
                                <div class="respuesta-encuesta">
                                    <label for="respuesta1">Respuesta #1</label>
                                    <input type="text" name="respuesta1" id="respuesta1" maxlength="100" placeholder="Respuesta...">
                                </div>
                                <div class="respuesta-encuesta">
                                    <label for="respuesta2">Respuesta #2</label>
                                    <input type="text" name="respuesta2" id="respuesta2" maxlength="100" placeholder="Respuesta...">
                                </div>
                            </div><!-- .contenedor-respuestas -->
                            
                        </div><!-- .datos-preguntas -->
                        
                    </div><!-- .contenedor-preguntas -->
                    
                    <input type="submit" id="crear" value="Crear" class="boton boton-terciario">
                </div>
            </div><!-- .crea-encuesta -->
        </form>
    </div>
</main>

<?php include_once "includes/templates/footer.php"; ?>
