<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$titulo = "EuroFutbol - Editar Tema";
$fichero = basename(__FILE__);
$directorio = "editartema";

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


if (isset($_GET["id"])) { //Si el parametro esta definido, se almacena en la variable
    $id = $_GET['id'];
}

if (isset($_GET["titulo"])) { //Si el parametro esta definido, se almacena en la variable
    $titulo = $_GET['titulo'];
}

if (isset($_GET["nombre"])) { //Si el parametro esta definido, se almacena en la variable
    $nombre = $_GET['nombre'];
}

$respuesta = verRespuestaPropia($id); //Esto llama a la funcion indicada, para poder incluir el contenido de la respuesta
//en el textarea y de esta forma que el usuario pueda editarlo

if (isset($_POST['enviar'])) {
    editarRespuesta($varsesion, $_POST, $id, $nombre);
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
                <h1 class="text-center">Editar Respuesta</h1>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="form1" method="POST" action="editar_respuesta.php<?php echo "?id=$id&nombre=$nombre"; ?>"> 
                            <div class="form-group text-center">
                                <a class="btn btn-primary botonvolver btn-success" href="javascript: history.go(-1)" role="button">Volver</a>
                                <label class="labels"> TITULO</label> <br> <input class="form-control text-center" type="text" name="titulo" id="titulo_respuesta" 
                                                                                  onchange="valida_titulo()" value="<?php echo "$titulo" ?>" 
                                                                                  OnFocus="this.blur()"><br><span id="errornom"></span>
                                <!-- La funcion onfucus, this.blur, permite que el contenido del value, no pueda ser cambiado
                                decidi añadirla, para que los usuarios no puedan cambiar los titulos de las respuestas una vez creados
                                ya que de la forma que lo tengo, todas las respuestas tienen como titulo Re: Titulo del Tema respondido,
                                he decidido realizarlo de esta forma, ya que me he dado cuenta que en muchos foros, utilizan esta forma-->  
                                <label class="labels"> CONTENIDO</label> <br> <textarea class="form-control" id="texto" name="texto" cols="100" rows="10"><?php echo "$respuesta"; ?></textarea><br>
                                <button type="submit" id="enviar" name="enviar" class="btn btn-default btn-success">Publicar Respuesta</button>
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

