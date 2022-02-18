<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$titulo = "EuroFutbol - Registro";
$fichero = basename(__FILE__);
$directorio = "registro";

if ($fichero == "index.php") {
    include_once("php/funciones_plantillas.php");
} else {
    include_once("../php/funciones_plantillas.php");
}
crearHeader($directorio, $titulo);
crearMenu($directorio);

include_once("../php/funciones_insertar.php");

if (isset($_POST['enviar'])) {
    registrarUsuario($_POST);
} else {
    ?>

    <!--   Contenedor Principal    -->
    <div class="container">
        <div class="jumbotron">
            <h1 class="text-center">Formulario de Registro</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Instrucciones</h3>
                    </div>
                    <div class="panel-body">
                        <p class="text-justify">
                            Para unirte a EuroFutbol, deberas introducir un nombre de usuario, email y contraseña.
                            El email que escribas debera ser real, porque lo necesitaras para gestionar tu cuenta.
                            Te recomendamos que utilices contraseña con minusculas, mayusculas, numeros y caracteres especiales
                            para mayor seguridad.<br><center> !Bienvenido a EuroFutbol!</center>
                        </p>
                        <a href="#" class="text-center" onclick="login()">¿Ya tienes cuenta?</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Introduce tus Datos</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="form1" method="POST" action="registro.php">
                            <div class="form-group">
                                <label>Nombre de Usuario</label>
                                <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Juan" onchange="valida()" ><br><span id="errornom"></span>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" id="email" name="email" placeholder="email@correo.com" onchange="valida1()" ><br> <span id="errorem"></span>
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input class="form-control" type="password" id="clave1" name="clave1" onchange="valida2()" ><br> <span id="errorpa1"></span>
                            </div>
                            <div class="form-group">
                                <label>Repite la Contraseña</label>
                                <input class="form-control" type="password" id="clave2" name="clave2" onchange="valida3()" ><br> <span id="errorpa2"></span>
                            </div>
                            <button type="submit" id="enviar" name="enviar" class="btn btn-default btn-success">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
?>

<?php
crearPie();
?>   

