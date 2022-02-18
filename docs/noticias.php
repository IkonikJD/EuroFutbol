<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$titulo = "EuroFutbol - Noticias";
$fichero = basename(__FILE__);
$directorio = "noticias";

if ($fichero == "index.php") {
    include_once("php/funciones_plantillas.php");
} else {
    include_once("../php/funciones_plantillas.php");
}
crearHeader($directorio, $titulo);
crearMenu($directorio);
?>

<!--   Contenedor Principal    -->

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="container-fluid">
                    <div class="row" id="articulos">
                        <div class="col-md-8">
                            <div class="panel-body introduccion">
                                <p><span class="titulo">El Real Madrid no puede volver a casa</span></p>
                                <img src="../img/noticia1.jpg" alt="Imagen Jornada" class="imagennoticia img-responsive">
                            </div>
                            <div class="panel-body text-justify">
                                <p>El Real Madrid sigue sin poder regresar a la capital y deberá pasar una tercera noche en Pamplona, lo que
                                    eleva aún más su indignación por este viaje que empezó el viernes y que aún no ha terminado.<br><br>
                                    <a class="btn btn-primary btn-success" href="nuevasnoticias.php?id=1" role="button">Leer Mas</a></p>
                            </div><hr>
                            <div class="col-md-6">
                                <div class="panel-body"><span class="titulo1">CHAMPIONS LEAGUE - ATLETICO DE MADRID VS ARSENAL</span><br><img src="../img/noticia2.jpg" alt="Imagen Jornada" class="imagennoticiaarriba img-responsive">
                                    <a href="nuevasnoticias.php?id=2">Atlético de Madrid - Chelsea: Arteta y el Aston Villa muestran el camino a Simeone</a><br><hr>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel-body"><span class="titulo1">EUROPA LEAGUE - CALENDARIO DE DIECISEISAVOS</span><br><img src="../img/noticia3.jpg" alt="Imagen Jornada" class="imagennoticiaarriba img-responsive">
                                    <a href="nuevasnoticias.php?id=3">Horarios y fechas de los dieciseisavos de final de la Europa League</a><br><hr>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">                          
                            <div class="panel-body noticiaslado"><span class="titulo1">CHELSEA - PREMIER LEAGUE</span><img src="../img/noticia4.jpg" alt="Imagen Jornada" class="imagennoticialado img-responsive">
                                <br><a href="nuevasnoticias.php?id=4">Werner termina con su sequía en la goleada del Chelsea al Morecambe</a><br><hr>
                            </div>
                            <div class="panel-body"><span class="titulo1">PSG - LIGUE 1</span><br><img src="../img/noticia5.jpg" alt="Imagen Jornada" class="imagennoticialado img-responsive">
                                <a href="nuevasnoticias.php?id=5">Pochettino no se corta con su estrella tras su debut en el PSG: "Mbappé debe mejorar"</a><br><hr>
                            </div>
                            <div class="panel-body"><span class="titulo1">JUVENTUS - SERIE A</span><br><img src="../img/noticia6.jpg" alt="Imagen Jornada" class="imagennoticialado img-responsive">
                                <a href="nuevasnoticias.php?id=6">Cristiano bigolea al Udinese y ya tiene más goles oficiales que Pelé</a><br><hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
crearPie();
?>   