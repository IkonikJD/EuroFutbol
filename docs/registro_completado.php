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

//Si el usuario ha sido registrado correctamente, se pasa por parametro el nombre del usuario recien registrado, de esta
//forma podemos añadirlo mediante una variable al mensaje de bienvenida
if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {                                                                                                     
    $usuario = $_GET['nombre'];
} else {
    $usuario = "";
}
if (!empty($_SESSION['usuario'])) { //Si la variable indicada, no esta definida, se define
    $varsesion = $_SESSION['usuario'];
}

if (!isset($varsesion) || empty($varsesion)) {
    ?>
    <!--   Contenedor Principal    -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">¡ Bienvenido !</h3>
                    </div>
                    <div class="panel-body">
        ¡ Gracias por Registrarte <?php echo $usuario; ?> !<br>
        <a href="#" onclick="login(); return false;">Inicia Sesión</a> para comenzar a usar tu cuenta.
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php
    } else {
        header("Location: ../index.php");
    }
    ?>

    <?php
    crearPie();
    ?>   
