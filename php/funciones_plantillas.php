<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function crearHeader($directorio, $titulo) {
    ?>
    <!DOCTYPE html>
    <!--
    To change this license header, choose License Headers in Project Properties.
    To change this template file, choose Tools | Templates
    and open the template in the editor.
    -->
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <?php
            if (!isset($titulo) || empty($titulo)) { //Si la variable del titulo no esta definida o esta vacia
                $titulo = "EuroFutbol - Inicio"; //Se define con ese nombre
            }
            echo "<title>$titulo</title>";
            if ($directorio != "inicio") {
                echo "<link href='../css/estilo.css' rel='stylesheet' type='text/css'/>";
                echo "<link href='../css/bootstrap.min.css' rel='stylesheet' type='text/css'/>";
                echo "<link href='../css/style.css' rel='stylesheet' type='text/css'/>";
                echo "<link rel='icon' type='image/png' href='../img/favicon.png'>";
                echo "<script src='../js/jquery.min.js' type='text/javascript'></script>";
                echo "<script src='../js/bootstrap.min.js' type='text/javascript'></script>";
                echo "<script src='../js/javascript.js' type='text/javascript'></script>";
            } else {
                ?>
                <link href="css/estilo.css" rel="stylesheet" type="text/css"/>
                <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                <link href="css/style.css" rel="stylesheet" type="text/css"/>
                <link rel="icon" type="image/png" href="./img/favicon.png">
                <script src="js/jquery.min.js" type="text/javascript"></script>
                <script src='js/bootstrap.min.js' type='text/javascript'></script>
                <script src="js/javascript.js" type="text/javascript"></script>
                <?php
            }

            //Esta funcion sirve si el usuario falla al loguearse, se recarga la pagina y se despliega
            //el formulario de login con el error, se pasa por parametro un dato inventado al crear el error
            //si ese dato existe se realiza la carga del fallo, si no el usuario se loguea correctamente
            if (isset($_GET['0']) && !empty($_GET['0'])) {
                $despliegue_login = '<body onload="login()">';
            } else {
                $despliegue_login = "";
            }
            ?>
        </head>
        <?php echo $despliegue_login; ?>
        <?php
    }

    function crearMenu($directorio) {
        ?>
        <!-- Cabecera -->
        <header id="cabeza">      
            <?php
            if ($directorio != "inicio") {
                echo "<img src='../img/logo.png' class='img-responsive' alt='Logo Responsive' id='imglogo'><br>";
            } else {
                echo "<img src='img/logo.png' class='img-responsive' alt='Logo Responsive' id='imglogo'><br>";
            }

            if ($directorio != "inicio") {
                include_once("../php/funciones_sesion.php");
            } else {
                include_once("php/funciones_sesion.php");
            }

            $url = $_SERVER['PHP_SELF'];



            //Esta variable de abajo, sirve para que no muestre los errores a los usuarios, de momento la dejo desactivada para verlos yo
            //error_reporting(0);
            //Primero debe llamarse  a la sesion o iniciar una nueva, luego se carga la variable

            session_start();
            if (!empty($_SESSION['usuario'])) { //Si la variable indicada, no esta definida, se define
                $varsesion = $_SESSION['usuario'];
            }

            if (isset($_POST['submit'])) {

                loguearse($directorio, $_POST);
            } else {
                ?>


                <!-- Menu -->
                <nav class="navbar navbar-default navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Este boton despliega la barra de navegacion</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">EUROFUTBOL</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <?php
                            if ($directorio != "inicio") {
                                echo "<ul class='nav navbar-nav'>";
                                echo "<li class='paginas'><a href='../index.php'><span class='icon-home'></span> Inicio</a></li>";
                                echo "<li class='paginas'><a href='noticias.php'><span class='icon-earth'></span> Noticias</a></li>";
                                echo "<li class='paginas'><a href='foro.php'><span class='icon-users'></span> Foro</a></li>";
                                echo "<li class='paginas'><a href='clasificacion.php'><span class='icon-trophy'></span> Clasificación</a></li>";
                                echo "</ul>";
                                if (!isset($varsesion) || empty($varsesion)) {
                                    echo "<ul class='nav navbar-nav navbar-right'>";
                                    echo "<li class='apaginas' onclick='login()'><a href='#' onclick='return false;'><span class='icon-enter'></span> Iniciar Sesión</a></li>";
                                    echo "<li class='apaginas'><a href='registro.php'><span class='icon-profile'></span> Registro</a></li>";
                                    echo "</ul>";
                                } else {
                                    echo "<ul class='nav navbar-nav navbar-right'>";
                                    echo "<li class='apaginas'><a href='#' onclick='return false;'><span class='icon-user'></span> ", $_SESSION['usuario'], "</a></li>";
                                    echo "<li class='apaginas'><a href='cerrar_sesion.php'><span class='icon-exit'></span> Cerrar Sesión</a></li>";
                                    echo "</ul>";
                                }
                            } else {
                                ?>
                                <ul class="nav navbar-nav">
                                    <li class="paginas"><a href="index.php"><span class="icon-home"></span> Inicio</a></li>
                                    <li class="paginas"><a href="docs/noticias.php"><span class="icon-earth"></span> Noticias</a></li>
                                    <li class="paginas"><a href="docs/foro.php"><span class="icon-users"></span> Foro</a></li>
                                    <li class="paginas"><a href="docs/clasificacion.php"><span class="icon-trophy"></span> Clasificación</a></li>
                                </ul>
                                <?php
                                if (!isset($varsesion) || empty($varsesion)) {
                                    ?>
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="apaginas" onclick="login()"><a href="#" onclick="return false;"><span class="icon-enter"></span> Iniciar Sesión</a></li>
                                        <li class="apaginas"><a href="docs/registro.php"><span class="icon-profile"></span> Registro</a></li>                                    
                                    </ul>
                                    <?php
                                } else {
                                    ?>
                                    <ul class="nav navbar-nav navbar-right">
                                        <li class="apaginas"><a href="#" onclick="return false;"><span class="icon-user"></span> <?php echo " ", $_SESSION['usuario']; ?></a></li>
                                        <li class="apaginas"><a href="docs/cerrar_sesion.php"><span class="icon-exit"></span> Cerrar Sesión</a></li>                                       
                                    </ul>
                                <?php } ?>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="panel-body" id="login" style="display:none">
                        <form role="form" action="<?php echo $url ?>" method="POST">
                            <div class="form-group">
                                <label>Usuario:</label> <input class="form-control logins" type="text" id="usuario" name="usuario">
                                <label>Contraseña:</label> <input class="form-control logins" type="password" id="clave" name="clave">
                            </div>                
                            <input type="hidden" name="0">
                            <button type="submit" id="enviar" name="submit" class="btn btn-default btn-success">Enviar</button>
                            <?php
                            if (isset($_GET['0']) && !empty($_GET['0'])) {

                                echo "<p id=\"errorlogin\">* El usuario introducido no esta registrado</p>";
                            } else {
                                echo "";
                            }
                            ?>
                        </form>
                    </div> 
                </nav>
            </header>
            <?php
        }
    }

    function crearSlider() {
        ?>
        <div id="my-carousel" class="carousel slide img-thumbnail push-down-1" data-ride="carousel" data-interval="3000">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#my-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#my-carousel" data-slide-to="1"></li>
                <li data-target="#my-carousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                <div class="item active">
                    <a href="docs/nuevasnoticias.php?id=7"><img class="img-responsive imgslider" src="img/mvso.png" alt=""></a>
                </div>
                <div class="item">
                    <a href="docs/nuevasnoticias.php?id=8"><img class="img-responsive imgslider" src="img/mvsm.png" alt=""></a>
                </div>
                <div class="item">
                    <a href="docs/nuevasnoticias.php?id=9"><img class="img-responsive imgslider" src="img/bvsb.png" alt=""></a>    
                </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#my-carousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#my-carousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <?php
    }

    function crearPie() {
        ?>
        <!--   Footer    -->
        <div class="panel-footer"> José David Prieto Suárez © 2020 - <a class="linkspie" href="#">EuroFutbol</a> | <a class="linkspie" href="#">Twitter</a> | <a class="linkspie" href="#">Facebook</a></div>
    </body>
    </html>

    <?php
}
