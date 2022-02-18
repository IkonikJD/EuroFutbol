<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$titulo = "EuroFutbol - Eliminar Respuesta";
$fichero = basename(__FILE__);
$directorio = "eliminartema";

if ($fichero == "index.php") {
    include_once("php/funciones_plantillas.php");
} else {
    include_once("../php/funciones_plantillas.php");
}
crearHeader($directorio, $titulo);
crearMenu($directorio);

include_once("../php/funciones_insertar.php");

if (!empty($_SESSION['usuario'])) {
    $varsesion = $_SESSION['usuario'];
}

if (isset($_GET["id"])) { //Si el parametro esta definido, se almacena en la variable
    $id = $_GET['id'];
}

if (isset($_GET["nombre"])) { //Si el parametro esta definido, se almacena en la variable
    $nombre = $_GET['nombre'];
}

if (isset($_POST['enviar'])) {
    borrarRespuesta($varsesion, $_POST, $id, $nombre);
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
            <div class="jumbotron" id="forobloqueado"><a class="btn btn-primary botonvolver btn-success" href="javascript: history.go(-1)" role="button">Volver</a>
                <h1 class="text-center">Borrar Respuesta</h1>
                <p class="text-center" id="avisoborrado">Antes de eliminar una respuesta, debemos comprobar que seas el
                    autor de la respuesta, por favor, introduce tu contraseña</p>
                <form role="form" id="form1" method="POST" action="borrar_respuesta.php<?php echo "?id=$id&nombre=$nombre"; ?>">
                    <div class="form-group text-center">
                        <label class="labels"> CONTRASEÑA</label> <input class="form-control text-center clavesform" type="password" id="clave1" name="clave1" onchange="valida2()" ><br> <span id="errorpa1"></span>
                        <label class="labels">REPITE LA CONTRASEÑA</label> <input class="form-control text-center clavesform" type="password" id="clave2" name="clave2" onchange="valida3()" ><br> <span id="errorpa2"></span>
                        <button type="submit" id="enviar" name="enviar" class="btn btn-default btn-success">Eliminar Respuesta</button>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<?php
crearPie();
?>   

