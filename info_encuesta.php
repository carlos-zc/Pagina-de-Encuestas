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
        <h2><?php echo $row_encuesta['titulo']; ?></h2>
        
        <?php
            $p=0;
            $sql_pregunta = mysqli_query($conn, "SELECT `pregunta`, `id_pregunta` FROM `pregunta` WHERE `id_enc_pregunta`=$id");
            while($row_pregunta = mysqli_fetch_assoc($sql_pregunta)){
                echo "<p><strong>- $row_pregunta[pregunta]:</strong></p>";
                $r=0;
                $sql_respuesta = mysqli_query($conn, "SELECT `respuesta`, `conteo`, `id_respuesta` FROM `respuesta` WHERE `id_preg_respuesta`=$row_pregunta[id_pregunta]");
                while($row_respuesta = mysqli_fetch_assoc($sql_respuesta)){
                    $vector_respuesta [$r] = $row_respuesta['conteo'];
                    echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;- $row_respuesta[respuesta]: <strong>$row_respuesta[conteo] Votos.</strong></p>";
                    $r++;
                }    
                $vector_grafica [$p] = $vector_respuesta;                         
                $p++;
            }
            // var_dump($vector_respuesta);
            // var_dump($vector_grafica);
        ?>

        <div class="grafica">
            <svg viewBox="-30 -10 550 350">

                <!-- Lineas de Separacion -->                    
                <line x1="0" y1="30" x2="500" y2="30" style="stroke:gray;stroke-width:0.5;"/>
                <line x1="0" y1="60" x2="500" y2="60" style="stroke:gray;stroke-width:0.5;"/>
                <line x1="0" y1="90" x2="500" y2="90" style="stroke:gray;stroke-width:0.5;"/>
                <line x1="0" y1="120" x2="500" y2="120" style="stroke:gray;stroke-width:0.5;"/>
                <line x1="0" y1="150" x2="500" y2="150" style="stroke:gray;stroke-width:0.5;"/>
                <line x1="0" y1="180" x2="500" y2="180" style="stroke:gray;stroke-width:0.5;"/>
                <line x1="0" y1="210" x2="500" y2="210" style="stroke:gray;stroke-width:0.5;"/>
                <line x1="0" y1="240" x2="500" y2="240" style="stroke:gray;stroke-width:0.5;"/>
                <line x1="0" y1="270" x2="500" y2="270" style="stroke:gray;stroke-width:0.5;"/>       
                
                <?php  
                
                    $letras = [
                        '1' => 'A',
                        '2' => 'B',
                        '3' => 'C',
                        '4' => 'D',
                        '5' => 'E',
                        '6' => 'F'
                    ];

                    $colores = [
                        '1' => 'rgb(23, 190, 187)',
                        '2' => 'rgb(46, 40, 42)',
                        '3' => 'rgb(126, 62, 47)',
                        '4' => 'rgb(205, 83, 52)',
                        '5' => 'rgb(237, 184, 139)',
                        '6' => 'rgb(250, 216, 214)'
                    ];
                    
                    $maximo = 0;
                 
                    for ($i=0; $i < count($vector_grafica); $i++) { 
                        // Separacion Horizontal
                        $dimension_secc = 500 / count($vector_grafica);                        
                        $divisor = $dimension_secc * ($i);

                        echo "<line x1='$divisor' y1='0' x2='$divisor' y2='300' style='stroke:gray;stroke-width:0.5;'/>";                                            
                        if($i == 0){
                            $posicionlabel = ($dimension_secc - 75) / 2;
                        }else{
                            $posicionlabel = (($dimension_secc - 75) / 2) + ($dimension_secc * $i);
                        }
                        $c = $i + 1;
                        echo "<text x='$posicionlabel' y='333' fill='black'>Pregunta $c</text>";                        
                        if($maximo < max($vector_grafica[$i])){
                            $maximo = max($vector_grafica[$i]);
                        }
                    }

                    // Valores
                    $valorx=-25;
                    $valory=3;
                    if($maximo == 0){
                        echo "<text x='$valorx' y='$valory' fill='black'>1</text>";
                    }else{
                        for ($i=0; $i < 10 ; $i++) { 
                            if($i == 0){
                                echo "<text x='$valorx' y='$valory' fill='black'>$maximo</text>";
                            }else{                            
                                $valory = $valory + 30;
                                $valor = $maximo - (($maximo / 10) * $i); 
                                if(strval($valor) == strval(intval($valor))){
                                    echo "<text x='$valorx' y='$valory' fill='black'>$valor</text>";
                                }
                                
                            }                        
                        }
                    }
                        
                    echo "<text x='$valorx' y='303' fill='black'>0</text>";               

                    for ($i=0; $i < count($vector_grafica); $i++) { 

                        // Barras Del Grafico
                        $dimension_bars = (90 * $dimension_secc) / 100;
                        $cant_resp = count($vector_grafica[$i]);                        
                        $b=1;
                        $grosor = ($dimension_bars / $cant_resp) * 0.9;
                        foreach($vector_grafica[$i] as $barras){
                            if($i == 0){
                                if($b == 1){
                                    $posicion = (($dimension_secc - $dimension_bars) /2);                                     
                                }else{
                                    $posicion = $posicion + ($dimension_bars / $cant_resp);                                     
                                } 
                            }else{
                                if($b == 1){
                                    $posicion = (($dimension_secc - $dimension_bars) /2) + ($dimension_secc * $i);                                    
                                }else{
                                    $posicion = $posicion + ($dimension_bars / $cant_resp);                                    
                                } 
                            }
                            
                            if($maximo != 0){
                                if($barras == $maximo){
                                    $altura = 300;
                                    $posiciony = 0;
                                }elseif($barras == 0){
                                    $altura = 0;                            
                                    $posiciony = 300;
                                }else{
                                    $altura = ($barras * 300) / $maximo;                              
                                    $posiciony = 300 - $altura;
                                }  
                            }else{
                                $altura = 0;                            
                                $posiciony = 300;
                            }
                                                             
                            echo "<rect id='$barras' width='$grosor' height='$altura' x='$posicion' y='$posiciony' style='fill:$colores[$b];stroke-width:1;stroke:rgb(0,0,0)'/>";
                            
                            $posicionop = (($grosor - 10) / 2) + $posicion;
                            
                            echo "<text x='$posicionop' y='315' fill='black'>$letras[$b]</text>";                            
                            // echo "<rect width='10' height='10' x='$posicionop' y='320' style='fill:rgb(179, 255, 0);stroke-width:0;stroke:rgb(0,0,0)' />";
                            $b++;
                        }                                            
                    }
                ?>
                
                <!-- Plano Base -->
                <line x1="0" y1="0" x2="500" y2="0" style="stroke:black;stroke-width:1;"/>
                <line x1="0" y1="0" x2="0" y2="300" style="stroke:black;stroke-width:1;"/>
                <line x1="0" y1="300" x2="500" y2="300" style="stroke:black;stroke-width:1;"/>
                <line x1="500" y1="0" x2="500" y2="300" style="stroke:black;stroke-width:1;"/>                
            
            </svg>
        </div>
    </div>
</main>

<?php include_once "includes/templates/footer.php"; ?>