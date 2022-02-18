<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$titulo = "EuroFutbol - Noticias";
$fichero = basename(__FILE__);
$directorio = "nuevasnoticias";

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

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" id="articulos"><a id="volvertemas" class="btn btn-primary btn-success" href="javascript: history.go(-1)" role="button">Volver</a>
                    <br><div class="container" id="foro">
                        <?php
                        mostrarNoticias();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php
crearPie();
?>   