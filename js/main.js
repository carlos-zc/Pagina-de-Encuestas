(function(){
    "use strict";

    document.addEventListener('DOMContentLoaded', function(){

        const btnMenu = document.querySelector(".menu-movil"),
              menu = document.querySelector(".navegacion"),
              btnComenzar = document.querySelector("#comenzar"),
              btnCrear = document.querySelector('#crear');

        eventListeners();

        function eventListeners() {
            // Desplegar menu responsive
            btnMenu.addEventListener('click', desplegarMenu);
            
            if(btnCrear){
                // Agrega o elimina preguntas al formulario
                btnComenzar.addEventListener('click', incioEncuesta);
                // Cuando se ejecuta el fomulario
                btnCrear.addEventListener('click', leerFormulario);
            }
            
            
        }
        
        function desplegarMenu() {
            if (menu.style.display == 'block'){
                menu.style.display = 'none';
            } else {
                menu.style.display = 'block';
            }
        }

        if(btnCrear){ //Condiciona que este en el formulario de creacion para evitar errores en otras paginas
            // Neuva encuesta
            var nro_preguntas = document.querySelector("#cantidad-preguntas"),
                nodo_preguntas = document.querySelector('.datos-preguntas'),
                nodo_guia = nodo_preguntas.cloneNode(true),
                nodo_padre = nodo_preguntas.parentNode,
                nuevos_nodos = [];
        }

        function incioEncuesta(event){
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

        }

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

        if(btnCrear){ //Condiciona que este en el formulario de creacion para evitar errores en otras paginas
            // agrega respuestas
            var respuesta_nodo = document.querySelector(".respuesta-encuesta"),
                respuesta_guia = respuesta_nodo.cloneNode(true);
        }
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

        function leerFormulario(e) {
            e.preventDefault();

            const inputTitulo = document.querySelector('.titulo-encuesta input'),
                  inputsPreguntas = document.querySelectorAll('.pregunta-encuesta input'),
                  inputsRespuestas = document.querySelectorAll('.respuesta-encuesta input');

            var valido = true,
                totalVacios = 0;

            inputTitulo.style.border = "none";

            // Valida que los campos no esten vacios
            if(inputTitulo.value === '') {
                inputTitulo.style.border = "1px solid red";
                mostrarNotificacion('Todos los campos son obligatorios', 'error');
                totalVacios++;
                inputTitulo.focus();
                valido = false;
            }

            inputsPreguntas.forEach(pregunta => {
                pregunta.style.border = "none";

                if(pregunta.value === ''){
                    pregunta.style.border = "1px solid red";
                    
                    totalVacios++;
                    if(totalVacios == 1){
                        pregunta.focus();
                        mostrarNotificacion('Todos los campos son obligatorios', 'error');
                    }
                    valido = false;
                }
            });

            inputsRespuestas.forEach(respuesta => {
                respuesta.style.border = "none";

                if(respuesta.value === ''){
                    respuesta.style.border = "1px solid red";
                    
                    totalVacios++;
                    if(totalVacios == 1){
                        respuesta.focus();
                        mostrarNotificacion('Todos los campos son obligatorios', 'error');
                    }
                    valido = false;
                }
            });

            if(valido) {
                // Pasa la validacion, crear llamado a Ajax
                const infoEncuesta = new FormData();
                infoEncuesta.append('titulo', inputTitulo.value);
                infoEncuesta.append('accion', 'crear');

                inputsPreguntas.forEach(pregunta => {
                    infoEncuesta.append(`${pregunta.id}[pregunta]`, pregunta.value);

                    inputsRespuestas.forEach(respuesta => {
                        infoEncuesta.append(`${pregunta.id}[respuestas][${respuesta.id}]`, respuesta.value);
                    });
                });
                
                insertarBD(infoEncuesta);
    
            }
            
        }

        function insertarBD(datos) {
            // llamado a Ajax
            // crear el objeto
            const xhr = new XMLHttpRequest();
        
            // abrir la conexion
            xhr.open('POST', 'includes/modelos/modelo-encuestas.php', true);
        
            // pasar los datos
            xhr.onload = function() {
                if(this.status === 200 ){
                    // leemos la respuesta PHP
                    const respuesta = JSON.parse(xhr.responseText);
        
                    // Mostrar la notificacion
                    mostrarNotificacion('Encuesta creada con éxito', 'correcto');

                    // despues de 3s redireccionar
                    setTimeout(() => {
                        window.location.href = `encuesta.php?id=${respuesta.id}`;
                    }, 3000);
        
                }
            }
            // enviar los datos
            xhr.send(datos);
        }

        // Notificacion en pantalla
        function mostrarNotificacion(mensaje, clase) {
            const notificacion = document.createElement('div');
            notificacion.classList.add(clase, 'notificacion', 'sombra');
            notificacion.textContent = mensaje;

            // agrega
            const divTitulo = document.querySelector('.separacion-menu');
            divTitulo.insertBefore(notificacion, divTitulo.firstElementChild); // se inserta en cualquier elemento es indiferente

            // Ocultar y mostrar la notificacion
            setTimeout(() => {
                notificacion.classList.add('visible');

                setTimeout(() => {
                    notificacion.classList.remove('visible');
                    setTimeout(() => {
                        notificacion.remove();
                    }, 500);
                }, 3000);
            }, 100);
        }


    }); // Fin DOMContentLoaded

})();