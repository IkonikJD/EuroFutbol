<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function conexion() {
    //Crea la conexion con la base de datos
    $conexion = mysqli_connect("host", "usuario", "contraseña", "nombre_basededatos")
            or die("No se puede conectar con el servidor");
    return $conexion;
}

function loguearse($directorio, $datos) {
    //LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Recibir los datos y almacenarlos en variables
    $usuario = $datos['usuario'];
    $clave = $datos['clave'];
    $url = $_SERVER['PHP_SELF']; //Esa variable es global, sirve para definir la ruta actual de la pagina

//Consulta para comprobar si el usuario y contraseña son correctos
    $consulta = "select * from usuarios where nombre='$usuario' and password='$clave'";
    $validacion = mysqli_query($conexion, $consulta);

    $filas = mysqli_num_rows($validacion);

    if ($filas > 0) { 
        session_start(); //Esta funcion inicia la sesion o reanuda la sesion iniciada
        $_SESSION['usuario'] = $usuario;
        header("Location: $url");
    } else {
        header("Location: $url?0=%");
    }

    mysqli_free_result($validacion);
    mysqli_close($conexion);
}

function logout() {
    session_destroy(); //Esta funcion cierra o destruye la sesion iniciada
}
