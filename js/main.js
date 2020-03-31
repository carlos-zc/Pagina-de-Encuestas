(function(){
    "use strict";

    document.addEventListener('DOMContentLoaded', function(){

        var boton_menu = document.querySelector(".menu-movil");
        var menu = document.querySelector(".navegacion");
        
        // Desplegar menu responsive
        boton_menu.addEventListener('click', function(){
            if (menu.style.display == 'block'){
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        });

        // Neuva encuesta
        var comenzar = document.querySelector("#comenzar");
        var nro_preguntas = document.querySelector("#cantidad-preguntas");
        var nodo_preguntas = document.querySelector('.datos-preguntas');
        var nodo_guia = nodo_preguntas.cloneNode(true);
        var nodo_padre = nodo_preguntas.parentNode;
        var nuevos_nodos = [];

        comenzar.addEventListener('click', function(event){
            event.preventDefault();
            document.querySelector('.crea-encuesta .contenedor-padre').style.display = 'block';

            if(nuevos_nodos.length == 0){
                nodo_padre.innerHTML = '';
    
                for(var i = 0; i < nro_preguntas.value; i++){ // agrega la cantidad de preguntas especificada
                    nuevos_nodos[i] = nodo_guia.cloneNode(true);
                    nodo_padre.appendChild(nuevos_nodos[i]);
                    ModificarNodoPregunta(nuevos_nodos[i], i);
                }

            } else if(nuevos_nodos.length < nro_preguntas.value) { // agrega mas preguntas segun falten
                for(var i = nuevos_nodos.length; i < nro_preguntas.value; i++){
                    nuevos_nodos[i] = nodo_guia.cloneNode(true);
                    nodo_padre.appendChild(nuevos_nodos[i]);
                    ModificarNodoPregunta(nuevos_nodos[i], i);
                }

            } else if(nuevos_nodos.length > nro_preguntas.value) { // borra los preguntas sobrantes
                for(var i = nro_preguntas.value; i < nuevos_nodos.length; i++){
                    nodo_padre.removeChild(nuevos_nodos[i]);
                }
                nuevos_nodos.splice(nro_preguntas.value, nuevos_nodos.length);

            }

        });

        // Funcion acomodar datos nodo pregunta
        function ModificarNodoPregunta(nodo, indice){
            nodo.querySelector('.pregunta-encuesta label').innerHTML = 'Pregunta #' + (indice+1);
            nodo.querySelector('.pregunta-encuesta label').setAttribute('for', 'pregunta' + (indice+1) );
            nodo.querySelector('.pregunta-encuesta input').setAttribute('id', 'pregunta' + (indice+1) );

            nodo.querySelector('.cant-respuestas label').setAttribute('for', 'nro-respuestas' + (indice+1) );
            var nro_respuestas = nodo.querySelector('.cant-respuestas input');
            nro_respuestas.setAttribute('id', 'nro-respuestas' + (indice+1) );
            nro_respuestas.addEventListener('change', cantRespuestas);
        }

        // agrega respuestas
        var respuesta_nodo = document.querySelector(".respuesta-encuesta");
        var respuesta_guia = respuesta_nodo.cloneNode(true);

        function cantRespuestas(){

            var respuesta_padre = this.parentNode.parentNode.parentNode.querySelector('.contenedor-respuestas');
            var respuestas_actuales = Array.from(respuesta_padre.querySelectorAll('.respuesta-encuesta'));

            // for(var i = 0; i < this.value; i++){ // modifica los atributos de las respuestas actuales
            //     ModificarNodoRespuesta(respuestas_actuales[i], i);
            // }

            if(respuestas_actuales.length < this.value) { // agrega mas respuestas segun falten
                for(var i = respuestas_actuales.length; i < this.value; i++){
                    respuestas_actuales[i] = respuesta_guia.cloneNode(true);
                    respuesta_padre.appendChild(respuestas_actuales[i]);
                    ModificarNodoRespuesta(respuestas_actuales[i], i);
                }

            } else if(respuestas_actuales.length > this.value) { // borra los respuestas sobrantes
                for(var i = this.value; i < respuestas_actuales.length; i++){
                    respuesta_padre.removeChild(respuestas_actuales[i]);
                }
                respuestas_actuales.splice(this.value, respuestas_actuales.length);

            }

        }

        // Funcion acomodar datos nodo respuesta
        function ModificarNodoRespuesta(nodo, indice){
            nodo.querySelector('label').innerHTML = 'Respuesta #' + (indice+1);
            nodo.querySelector('label').setAttribute('for', 'respuesta' + (indice+1) );
            nodo.querySelector('input').setAttribute('id', 'respuesta' + (indice+1) );
        }


    }); // Fin DOMContentLoaded

})();