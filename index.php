<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$titulo = "EuroFutbol - Inicio"; //Esto establece el titulo de la pagina actual, esta en todas
$directorio = "inicio";         //Variable que establece el nombre del directorio
$fichero = basename(__FILE__);  //Esta funcion, te da el nombre y extension del fichero actual 
//Este if comprueba donde estamos situados, si es index.php llama al fichero de funciones
//desde una ruta, si es cualquier otro fichero, lo llama desde otra ruta
if ($fichero == "index.php") {
    include_once("php/funciones_plantillas.php");
} else {
    include_once("../php/funciones_plantillas.php");
}
crearHeader($directorio, $titulo); //LLama a la funcion que crea la plantilla del header en todas las paginas
crearMenu($directorio);     //LLama a la funcion que crea la plantilla del menu en todas las paginas
?>




<!--   Contenedor Principal    -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <?php
                crearSlider();  //LLama a la funcion que crea el slider
                ?>
                <div class="container-fluid">
                    <div class="row" id="articulos">
                        <div class="col-md-4">
                            <div class="panel-body introduccion">
                                <p><span class="titulo">BIENVENIDO !</span></p>

                                <p><span class="titulo1">SI QUIERES SABER TODO ACERCA DE LAS PRINCIPALES LIGAS DE EUROPA, ¡EUROFUTBOL ES TU PAGINA!</span></p>
                            </div>
                            <div class="panel-body">
                                <p>EuroFutbol es la mejor pagina de futbol en español, donde podras tener acceso a toda la informacion,
                                    relativa a las cinco grandes liga de europa (Liga Santander, Premier League, Bundesliga, Ligue 1 y Serie A).</p><br>
                                <p>Ademas por supuesto de toda la informacion sobre la UEFA Champions League y UEFA Europa League, fichajes 
                                    y mucho mas...<br><br> <button type="button" class="boton btn btn-default btn-success" onclick="boton(this)">Leer más</button></p><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel-body introduccion">
                                <p><span class="titulo">ULTIMA JORNADA !</span></p>

                                <p><span class="titulo1">LA LIGA SANTANDER DISPUTARA SU JORNADA NUMERO 18</span></p>
                            </div>
                            <div class="panel-body"><img src="./img/jornada18.jpg" alt="Imagen Jornada" class="imageninicio img-responsive"><br>
                                <p>El viernes arrancará la penúltima jornada de la primera vuelta con un gran partido en Balaídos: 
                                    Celta-Villarreal. Dos días antes los Reyes nos traen otra gran cita en San Mamés, el aplazado 
                                    Athletic-Barça, cuyos puntos Fantasy se sumarán a la segunda jornada de LaLiga. El Partidazo 
                                    de la 18ª será el Osasuna-Real Madrid (sábado, 21 h.).<br><br> <button type="button" class="boton btn btn-default btn-success" onclick="boton1(this)">Leer más</button></p><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="panel-body introduccion">
                                <p><span class="titulo">RANKING</span></p>
                            </div>
                            <div class="panel-body">
                                <p><img src="./img/barcelona.png" alt="Imagen Barcelona" class="ranking img-responsive"><img src="./img/realmadrid.png" alt="Imagen Madrid" class="ranking img-responsive"> <span class="titulo1">GOLES A FAVOR</span></p> 
                                <p>El Futbol Club Barcelona y el Real Madrid encabezan el Ranking de Goles a Favor con 30 goles cada uno...</p>

                                <hr id="linea">

                                <p><img src="./img/osasuna.png" alt="Imagen Madrid" class="ranking"> <span class="titulo1">DE CABEZA</span>
                                <p>El Osasuna encabeza el Ranking de Goles de cabeza con 13 goles, seguido por el Granada CF. con 12 tantos...<br><br><button type="button" class="boton btn btn-default btn-success" onclick="boton2(this)">Leer más</button></p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
crearPie();  //LLama a la funcion que crea la plantilla del footer en todas las paginas
?>   
