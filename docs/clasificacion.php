<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$titulo = "EuroFutbol - Clasificacion";
$fichero = basename(__FILE__);
$directorio = "clasificacion";

if ($fichero == "index.php") {
    include_once("php/funciones_plantillas.php");
} else {
    include_once("../php/funciones_plantillas.php");
}
crearHeader($directorio, $titulo);
crearMenu($directorio);

include_once("../php/funciones_insertar.php");
?>

<link href="../css/datatables.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="../js/datatables.min.js" type="text/javascript"></script>
<script src="../js/responsive.bootstrap.min.js" type="text/javascript"></script>

<!--   Contenedor Principal    -->

<div class="container" id="contenedor1">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="container-fluid">
                    <div class="row" id="articulos">
                        <br>
                        <div class="panel-body">
                            <script>
                                $(document).ready(function () {
                                    $('#tabla1').DataTable({
                                        responsive: true
                                    });
                                    $('#tabla2').DataTable({
                                        responsive: true
                                    });
                                    $('#tabla3').DataTable({
                                        responsive: true
                                    });
                                    $('#tabla4').DataTable({
                                        responsive: true
                                    });
                                    $('#tabla5').DataTable({
                                        responsive: true
                                    })
                                });
                            </script>

                            

                            <input type="radio" name="boton" id="primero" checked> 
                            <input type="radio" name="boton" id="segundo"> 
                            <input type="radio" name="boton" id="tercero">
                            <input type="radio" name="boton" id="cuarto">
                            <input type="radio" name="boton" id="quinto">
                            <label for="primero" id="etiqueta1"><img src="../img/botonliga1.png" class="seleccionado"><img src="../img/botonliga2.png" class="noseleccionado"></label>
                            <label for="segundo" id="etiqueta2"><img src="../img/botonpremier1.png" class="seleccionado"><img src="../img/botonpremier2.png" class="noseleccionado"></label>
                            <label for="tercero" id="etiqueta3"><img src="../img/botonbundes1.png" class="seleccionado"><img src="../img/botonbundes2.png" class="noseleccionado"></label>
                            <label for="cuarto" id="etiqueta4"><img src="../img/botonligue1.png" class="seleccionado"><img src="../img/botonligue2.png" class="noseleccionado"></label>
                            <label for="quinto" id="etiqueta5"><img src="../img/botonserie1.png" class="seleccionado"><img src="../img/botonserie2.png" class="noseleccionado"></label>

                            <div id="contenedor-slider" class="panel-body carousel-inner">
                                <div id="caja" class="panel-body">
                                    <div class="diapositiva carousel-item">
                                        <div id="contenedortabla">
                                            <table id="tabla1" class="table results display nowrap" cellspacing="0">
                                                <div class="panel-body tituloliga">Clasificacion Liga Santander</div>
                                                <thead>
                                                    <tr id="cabecera_tabla">
                                                        <th scope="col">POSICION</th>
                                                        <th scope="col">EQUIPO</th>
                                                        <th scope="col">PUNTOS</th>
                                                        <th scope="col" title="Partidos Jugados">PJ</th>
                                                        <th scope="col" title="Partidos Ganados">PG</th>
                                                        <th scope="col" title="Partidos Empatados">PE</th>
                                                        <th scope="col" title="Partidos Perdidos">PP</th>
                                                        <th scope="col" title="Goles a Favor">GF</th>
                                                        <th scope="col" title="Goles en Contra">GC</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    obtenerDatosLiga();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="diapositiva carousel-item">
                                        <div id="contenedortabla">
                                            <table id="tabla2" class="table results display nowrap" cellspacing="0">
                                                <div class="panel-body tituloliga">Clasificacion Premier League</div>
                                                <thead>
                                                    <tr id="cabecera_tabla">
                                                        <th scope="col">POSICION</th>
                                                        <th scope="col">EQUIPO</th>
                                                        <th scope="col">PUNTOS</th>
                                                        <th scope="col" title="Partidos Jugados">PJ</th>
                                                        <th scope="col" title="Partidos Ganados">PG</th>
                                                        <th scope="col" title="Partidos Empatados">PE</th>
                                                        <th scope="col" title="Partidos Perdidos">PP</th>
                                                        <th scope="col" title="Goles a Favor">GF</th>
                                                        <th scope="col" title="Goles en Contra">GC</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    obtenerDatosPremier();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="diapositiva carousel-item">
                                        <div id="contenedortabla">
                                            <table id="tabla3" class="table results display nowrap" cellspacing="0">
                                                <div class="panel-body tituloliga">Clasificacion Bundesliga</div>
                                                <thead>
                                                    <tr id="cabecera_tabla">
                                                        <th scope="col">POSICION</th>
                                                        <th scope="col">EQUIPO</th>
                                                        <th scope="col">PUNTOS</th>
                                                        <th scope="col" title="Partidos Jugados">PJ</th>
                                                        <th scope="col" title="Partidos Ganados">PG</th>
                                                        <th scope="col" title="Partidos Empatados">PE</th>
                                                        <th scope="col" title="Partidos Perdidos">PP</th>
                                                        <th scope="col" title="Goles a Favor">GF</th>
                                                        <th scope="col" title="Goles en Contra">GC</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    obtenerDatosBundes();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="diapositiva carousel-item">
                                        <div id="contenedortabla">
                                            <table id="tabla4" class="table results display nowrap" cellspacing="0">
                                                <div class="panel-body tituloliga">Clasificacion Ligue 1</div>
                                                <thead>
                                                    <tr id="cabecera_tabla">
                                                        <th scope="col">POSICION</th>
                                                        <th scope="col">EQUIPO</th>
                                                        <th scope="col">PUNTOS</th>
                                                        <th scope="col" title="Partidos Jugados">PJ</th>
                                                        <th scope="col" title="Partidos Ganados">PG</th>
                                                        <th scope="col" title="Partidos Empatados">PE</th>
                                                        <th scope="col" title="Partidos Perdidos">PP</th>
                                                        <th scope="col" title="Goles a Favor">GF</th>
                                                        <th scope="col" title="Goles en Contra">GC</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    obtenerDatosLigue();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="diapositiva carousel-item">
                                        <div id="contenedortabla">
                                            <table id="tabla5" class="table results display nowrap" cellspacing="0">
                                                <div class="panel-body tituloliga">Clasificacion Serie A</div>
                                                <thead>
                                                    <tr id="cabecera_tabla">
                                                        <th scope="col">POSICION</th>
                                                        <th scope="col">EQUIPO</th>
                                                        <th scope="col">PUNTOS</th>
                                                        <th scope="col" title="Partidos Jugados">PJ</th>
                                                        <th scope="col" title="Partidos Ganados">PG</th>
                                                        <th scope="col" title="Partidos Empatados">PE</th>
                                                        <th scope="col" title="Partidos Perdidos">PP</th>
                                                        <th scope="col" title="Goles a Favor">GF</th>
                                                        <th scope="col" title="Goles en Contra">GC</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    obtenerDatosSerie();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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