<?php
$titulo = "EuroFutbol - Logout";
$directorio = "logout";
$fichero = basename(__FILE__);

if ($fichero == "index.php") {
    include_once("php/funciones_plantillas.php");
} else {
    include_once("../php/funciones_plantillas.php");
}
?>
<meta http-equiv="refresh" content="3; url=../index.php" /> <!-- Este meta sirve para redirigir a otra pagina pasados
unos segundos, en este caso, pasados 3 segundos se reenvia al usuario al index-->
<?php
include_once("../php/funciones_sesion.php");
session_start();
logout();
crearHeader($directorio, $titulo);
crearMenu($directorio);
?>
<!--   Contenedor Principal    -->

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">¡ Hasta Pronto !</h3>
                </div>
                <div class="panel-body"> La sesión ha sido cerrada con éxito. Esperamos volver a verte pronto.<br>
                    Seras redirigido automaticamente a la pagina principal...</p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
crearPie();
?>   