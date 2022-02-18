<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$titulo = "EuroFutbol - Nuevo Tema";
$fichero = basename(__FILE__);
$directorio = "nuevotema";

if ($fichero == "index.php") {
    include_once("php/funciones_plantillas.php");
} else {
    include_once("../php/funciones_plantillas.php");
}
crearHeader($directorio, $titulo);
crearMenu($directorio);

include_once("../php/funciones_insertar.php");

if (!empty($_SESSION['usuario'])) { //Si la variable indicada, no esta definida, se define
    $varsesion = $_SESSION['usuario'];
}

if (isset($_POST['enviar'])) {
    insertarTema($varsesion, $_POST);
} else {
    ?>
    <!--   Contenedor Principal    -->
    <?php
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
            <div class="jumbotron">
                <h1 class="text-center">Crear Nuevo Tema</h1>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form role="form" id="form1" method="POST" action="nuevo_tema.php"> 
                            <div class="form-group text-center">
                                <a class="btn btn-primary botonvolver btn-success" href="javascript: history.go(-1)" role="button">Volver</a>
                                <label class="labels"> TITULO</label> <br> <input class="form-control text-center" type="text" name="titulo" id="tituloform" onchange="valida_titulo()"><br><span id="errornom"></span>
                                <label class="labels"> CONTENIDO</label> <br> <textarea class="form-control" id="texto" name="texto" cols="100" rows="10"></textarea><br>
                                <button type="submit" id="enviar" name="enviar" class="btn btn-default btn-success">Enviar</button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>

    <?php } ?>
<?php } ?>
<?php
crearPie();
?>   

