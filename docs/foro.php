<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$titulo = "EuroFutbol - Foro";
$fichero = basename(__FILE__);
$directorio = "foro";

if ($fichero == "index.php") {
    include_once("php/funciones_plantillas.php");
} else {
    include_once("../php/funciones_plantillas.php");
}
crearHeader($directorio, $titulo);
crearMenu($directorio);

include_once("../php/funciones_insertar.php");
?>

<!--   Contenedor Principal    -->
<?php
if (!empty($_SESSION['usuario'])) { //Si la variable indicada, no esta definida, se define
    $varsesion = $_SESSION['usuario'];
}

if (!isset($varsesion) || empty($varsesion)) {
    ?>

    <div class="container">
        <div class="jumbotron" id="forobloqueado">
            <h1 class="text-center">Contenido Bloqueado</h1>
            <p class="text-center" id="avisoforo"> Debes estar registrado para acceder a esta zona de la web</p>
        </div>
    </div>

    <?php
} else {
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" id="articulos"><a id="volvertemas" class="btn btn-primary btn-success" href="nuevo_tema.php" role="button">Crear Nuevo Tema</a>
                    <br><div class="container" id="foro"> 
                        <div class="row" id="cabecera_foro">
                            <div class="col-md-4">
                                <div class="panel-body text-center">Tema</div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel-body text-center">Autor</div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel-body text-center">Fecha</div>
                            </div>
                            <div class="col-md-2">
                                <div class="panel-body text-center">Respuestas</div>
                            </div>
                        </div>
                        <?php
                        mostrarForo($varsesion);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

<?php
crearPie();
?>   

