<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function registrarUsuario($datos) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Recibir los datos y almacenarlos en variables
    $nombre = $datos['nombre'];
    $email = $datos['email'];
    $clave1 = $datos['clave1'];
    $clave2 = $datos['clave2'];

//Comprobaciones de php para validar o no el formulario
    if (empty($nombre)) {
        echo '<script>alert("* Debes escribir un nombre de usuario");
        window.history.go(-1);</script>'; //Este metodo es menos estetico, pero para eso disponemos de javascript
//el cual valida igualmente y señala los errores debajo de los campos de formulario, pero con la validacion de
//php nos aseguramos que los campos se validen correctamente, si se produce un fallo, se vuelve a la pagina de
//formulario, fue la forma que mas me gusto para realizar este proceso
    } elseif (strlen($nombre) < 4) {
        echo '<script>alert("* El nombre debe contener mas de 4 caracteres");
        window.history.go(-1);</script>';
    } elseif (strlen($nombre) > 30) {
        echo '<script>alert("* El nombre debe contener menos de 30 caracteres");
        window.history.go(-1);</script>';
    } elseif (empty($email)) {
        echo '<script>alert("* Debes escribir un correo");
        window.history.go(-1);</script>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //Esta variable valida el formato estandar de correo
        echo '<script>alert("* Formato de correo no valido");
        window.history.go(-1);</script>';
    } elseif (empty($clave1)) {
        echo '<script>alert("* Debes escribir una contraseña");
        window.history.go(-1);</script>';
    } elseif (strlen($clave1) < 8) {
        echo '<script>alert("* La contraseña debe contener mas de 8 caracteres");
        window.history.go(-1);</script>';
    } elseif (strlen($clave1) > 50) {
        echo '<script>alert("* La contraseña debe contener menos de 50 caracteres");
        window.history.go(-1);</script>';
    } elseif (empty($clave2)) {
        echo '<script>alert("* Debes repetir la contraseña");
        window.history.go(-1);</script>';
    } elseif ($clave1 !== $clave2) {
        echo '<script>alert("* Ambas contraseñas deben coincidir");
        window.history.go(-1);</script>';
    } else {

//Esto encripta la contraseña, pero he decidido no aplicarlo para facilitar las pruebas a la hora del desarrollo, en una
//pagina real, se deberia añadir esta opcion para mayor seguridad. Nota: en insertar hay que poner clave si activo esto
//$clave = password_hash($clave1, PASSWORD_DEFAULT);
//Consulta para insertar
        $insertar = "insert into usuarios (nombre, email, password) values ('$nombre', '$email', '$clave1')";

//Consulta para comprobar si ya existe ese usuario en la base de datos
        $verificar_usuario = mysqli_query($conexion, "select * from usuarios where nombre = '$nombre'");
        if (mysqli_num_rows($verificar_usuario) > 0) {
            echo '<script>alert("El usuario ya esta registrado");
        window.history.go(-1);</script>';
            exit;
        }

//Consulta para comprobar si ya existe ese correo en la base de datos
        $verificar_correo = mysqli_query($conexion, "select * from usuarios where email = '$email'");
        if (mysqli_num_rows($verificar_correo) > 0) {
            echo '<script>alert("El correo ya esta registrado");
        window.history.go(-1);</script>';
            exit;
        }

//Ejecutar consulta de insertar
        $resultado = mysqli_query($conexion, $insertar);

        if (!$resultado) {
            echo "Error al Registrarse";
        } else {
            header("Location:../docs/registro_completado.php?nombre=$nombre"); //Paso una variable por parametro para
//despues mostrar el nombre del usuario recien registrado en la pagina de registro completado, es algo que
//me parecio curioso y llamativo por eso decidi añadirlo
        }

//Cerrar conexion a la base de datos
        mysqli_close($conexion);
    }
}

function insertarTema($varsesion, $datos) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Recibir los datos y almacenarlos en variables
    $titulo = $datos['titulo'];
    $contenido = $datos['texto'];

//Comprobaciones de php para validar o no el formulario
    if (empty($titulo)) {
        echo '<script>alert("No puedes crear un tema sin titulo");
        window.history.go(-1);</script>';
    } elseif (strlen($titulo) < 4) {
        echo '<script>alert("El titulo debe tener mas de 4 caracteres");
        window.history.go(-1);</script>';
        exit;
    } elseif (strlen($titulo) > 100) {
        echo '<script>alert("El titulo debe tener menos de 100 caracteres");
        window.history.go(-1);</script>';
        exit;
    } elseif (empty($contenido)) {
        echo '<script>alert("No puedes crear un tema sin contenido");
        window.history.go(-1);</script>';
    } else {

//Consulta para conseguir el id del usuario que ha creado el tema
        $buscar_id = mysqli_query($conexion, "select id from usuarios where nombre = '$varsesion'");
        $row = mysqli_fetch_array($buscar_id);
        $id_autor = $row['id'];

//Consulta para insertar los datos de los temas en la base de datos
        $insertar = "insert into temas (autor_id, titulo, texto) values ('$id_autor','$titulo', '$contenido')";

//Consulta para comprobar si ya existe ese usuario en la base de datos
        $verificar_titulo = mysqli_query($conexion, "select * from temas where titulo = '$titulo'");
        if (mysqli_num_rows($verificar_titulo) > 0) {
            echo '<script>alert("Ya existe un tema con ese nombre, porfavor, introduce otro");
        window.history.go(-1);</script>';
            exit;
        }

//Ejecutar consulta de insertar
        $resultado = mysqli_query($conexion, $insertar);

        if (!$resultado) {
            echo "Error al crear el Tema";
        } else {
            header("Location:../docs/foro.php");
        }

//Cerrar conexion a la base de datos
        mysqli_close($conexion);
    }
}

function mostrarForo($varsesion) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Consulta para seleccionar los campos necesarios, para mostrar los temas en el foro
    $consulta = mysqli_query($conexion, "select b.id, b.titulo, a.nombre, b.fecha from usuarios as a, temas as b where a.id=b.autor_id order by fecha desc");
    $nfilas = mysqli_num_rows($consulta);

//Este if comprueba los resultados de la consulta. Funciona con un for, el cual se encarga de ir añadiendo los nuevos temas 
//con su respectivo orden y estructura en el foro
    if ($nfilas > 0) {
        for ($i = 0; $i < $nfilas; $i++) {
            $fila = mysqli_fetch_array($consulta);
            $id = $fila['id'];
            $titulo = $fila['titulo'];
            $admin = "admin";

//Consulta para seleccionar el numero de respuestas que tiene un tema
            $respuestas = mysqli_query($conexion, "select count(tema_id) from respuestas where tema_id='$id'");
            $fila2 = mysqli_fetch_array($respuestas);
            $cuenta_respuestas = $fila2['count(tema_id)'];
            $nombre = $fila['nombre'];
            echo "<div class='row' id='caja_temas'>";
            if ($admin == $varsesion) { //Esto sirve para mostrar los botones al autor del tema si esta logueado
                echo "<div class='col-md-4'>"
                . "<div class='panel-body' id='recuadro_temas'><a href='../docs/temas.php?id=$id'>", $fila['titulo'], "</a>";
                echo "<a id='botones_temas' href='../docs/borrar_tema.php?id=$id&nombre=$admin'>"
                . "<button class='boton_temas btn btn-default btn-success btn-xs' name='borrar'>Borrar</button></a>"
                . "<a id='botones_temas' href='../docs/editar_tema.php?id=$id&nombre=$admin&titulo=$titulo'>"
                . "<button class='boton_temas btn btn-default btn-success btn-xs' name='editar'>Editar</button></a></div></div>";
            } elseif ($nombre == $varsesion) { //Esto sirve para mostrar los botones al autor del tema si esta logueado
                echo "<div class='col-md-4'>"
                . "<div class='panel-body' id='recuadro_temas'><a href='../docs/temas.php?id=$id'>", $fila['titulo'], "</a>";
                echo "<a id='botones_temas' href='../docs/borrar_tema.php?id=$id&nombre=$nombre'>"
                . "<button class='boton_temas btn btn-default btn-success btn-xs' name='borrar'>Borrar</button></a>"
                . "<a id='botones_temas' href='../docs/editar_tema.php?id=$id&nombre=$nombre&titulo=$titulo'>"
                . "<button class='boton_temas btn btn-default btn-success btn-xs' name='editar'>Editar</button></a></div></div>";
            } else {  //Los demas usuarios que no sean el autor o el admin lo veran sin botones
                echo "<div class='col-md-4'>"
                . "<div class='panel-body' id='recuadro_temas'><a href='../docs/temas.php?id=$id'>", $fila['titulo'], "</a></div></div>";
            }
            echo "<div class='col-md-3'><div class='panel-body text-center bordesabajo'>", $fila['nombre'], "</div></div>";
            echo "<div class='col-md-3'><div class='panel-body text-center bordesabajo'>", $fila['fecha'], "</div></div>";
            echo "<div class='col-md-2'><div class='panel-body text-center bordesabajo'> $cuenta_respuestas </div></div>";
            echo "</div>";
        }
    }

    mysqli_close($conexion);
}

function mostrarTemas($varsesion) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Busca si existe el parametro id, de ser asi almacena el resultado en la variable y continua las operaciones
    if (isset($_GET["id"])) {
        $id = $_GET['id'];

//Consulta para selecionar los campos necesarios para mostrar los temas por completo
        $consulta = mysqli_query($conexion, "select a.id, b.nombre, a.fecha, a.titulo, a.texto from temas as a, usuarios as b where a.id='$id' and b.id=a.autor_id");
        $row = mysqli_fetch_array($consulta);
        $titulo = $row['titulo'];
        $autor = $row['nombre'];
        $fecha = $row['fecha'];
        $texto = nl2br($row['texto']); //Esta funcion, permite que haya saltos de linea, en los campos de texto
        $admin = "admin";

        if ($admin == $varsesion) {
            echo "<div class='panel-body' id='botones_temas'><a href='../docs/borrar_tema.php?id=$id&nombre=$admin'>"
            . "<a href='../docs/nueva_respuesta.php?id=$id&titulo=$titulo'><button type='button' class='respuesta_propia btn btn-default btn-success'>Responder</button></a>"
            . "<a id='botones_temas' href='../docs/borrar_tema.php?id=$id&nombre=$admin'>"
            . "<button class='boton_temas btn btn-default btn-success btn-xs' name='borrar'>Borrar</button></a>"
            . "<a href='../docs/editar_tema.php?id=$id&nombre=$admin&titulo=$titulo'>"
            . "<button class='boton_temas btn btn-default btn-success btn-xs' name='editar'>Editar</button></a></div>";
            echo "<div id='tema_titulo'> $titulo </div>";
        } elseif ($autor == $varsesion) {
            echo "<div class='panel-body' id='botones_temas'><a href='../docs/borrar_tema.php?id=$id&nombre=$autor'>"
            . "<a href='../docs/nueva_respuesta.php?id=$id&titulo=$titulo'><button type='button' class='respuesta_propia btn btn-default btn-success'>Responder</button></a>"
            . "<a id='botones_temas' href='../docs/borrar_tema.php?id=$id&nombre=$nombre'>"
            . "<button class='boton_temas btn btn-default btn-success btn-xs' name='borrar'>Borrar</button></a>"
            . "<a href='../docs/editar_tema.php?id=$id&nombre=$autor&titulo=$titulo'>"
            . "<button class='boton_temas btn btn-default btn-success btn-xs' name='editar'>Editar</button></a></div>";
            echo "<div class='panel-body' id='tema_titulo'> $titulo </div>";
        } else {
            echo "<a href='../docs/nueva_respuesta.php?id=$id&titulo=$titulo'><button type='button' class='btn btn-default btn-success'>Responder</button></a><br><br>";
            echo "<div class='panel-body' id='tema_titulo'> $titulo </div>";
        }
        echo "<div class='panel-body' id='tema_autor'>Creado por $autor , el $fecha </div>";
        echo "<div class='panel-body' id='tema_texto'>$texto</div>";
    }
}

function insertarRespuesta($varsesion, $datos) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Recibir los datos y almacenarlos en variables
    $titulo = $datos['titulo'];
    $texto = $datos['texto'];
    $id = $datos['identificador'];

//Consulta para conseguir el id del usuario que ha realizado la respuesta a un tema
    $buscar_id = mysqli_query($conexion, "select id from usuarios where nombre = '$varsesion'");
    $row = mysqli_fetch_array($buscar_id);
    $id_autor = $row['id'];

//Consulta para insertar los datos de las respuestas a los temas en la base de datos
    $insertar = "insert into respuestas (autor_id, tema_id, titulo, texto) values ('$id_autor', '$id' ,'$titulo', '$texto')";

//Ejecutar consulta de insertar
    $resultado = mysqli_query($conexion, $insertar);

    if (!$resultado) {
        echo "Error al crear el Tema";
    } else {
        header("Location:../docs/temas.php?id=$id");
    }

//Cerrar conexion a la base de datos
    mysqli_close($conexion);
}

function mostrarRespuestas($varsesion) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

    if (isset($_GET["id"])) {
        $id = $_GET['id'];

//Consulta para selecionar los campos necesarios para mostrar las respuestas en sus respectivos temas
        $consulta = mysqli_query($conexion, "select a.id, b.nombre, a.tema_id, a.titulo, a.texto, a.fecha from usuarios as b, respuestas as a where a.tema_id='$id' and b.id=a.autor_id order by fecha asc");
        $nfilas = mysqli_num_rows($consulta);
        $admin = "admin";

        if ($nfilas > 0) {
            for ($i = 0; $i < $nfilas; $i++) {
                $row = mysqli_fetch_array($consulta);
                $id_res = $row['id'];
                $titulo = $row['titulo'];
                $autor = $row['nombre'];
                $fecha = $row['fecha'];
                $texto = nl2br($row['texto']);

                if ($admin == $varsesion) {
                    echo "<div class='panel-body' id='botones_temas'><a href='../docs/borrar_respuesta.php?id=$id_res&nombre=$admin'>"
                    . "<a href='../docs/nueva_respuesta.php?id=$id&titulo=$titulo'><button type='button' class='respuesta_propia btn btn-default btn-success'>Responder</button></a>"
                    . "<a id='botones_temas' href='../docs/borrar_respuesta.php?id=$id_res&nombre=$admin&titulo=$titulo'>"
                    . "<button class='boton_temas btn btn-default btn-success btn-xs' name='borrar'>Borrar</button></a>"
                    . "<a href='../docs/editar_respuesta.php?id=$id_res&nombre=$admin&titulo=$titulo'>"
                    . "<button class='boton_temas btn btn-default btn-success btn-xs' name='editar'>Editar</button></a></div>";
                    echo "<div class='panel-body' id='tema_titulo'>Re: $titulo </div>";
                } elseif ($autor == $varsesion) {
                    echo "<div class='panel-body' id='botones_temas'><a href='../docs/borrar_respuesta.php?id=$id_res&nombre=$autor'>"
                    . "<a href='../docs/nueva_respuesta.php?id=$id&titulo=$titulo'><button type='button' class='respuesta_propia btn btn-default btn-success'>Responder</button></a>"
                    . "<a id='botones_temas' href='../docs/borrar_respuesta.php?id=$id_res&nombre=$admin&titulo=$titulo'>"
                    . "<button class='boton_temas btn btn-default btn-success btn-xs' name='borrar'>Borrar</button></a>"
                    . "<a href='../docs/editar_respuesta.php?id=$id_res&nombre=$autor&titulo=$titulo'>"
                    . "<button class='boton_temas btn btn-default btn-success btn-xs' name='editar'>Editar</button></a></div>";
                    echo "<div class='panel-body' id='tema_titulo'>Re: $titulo </div>";
                } else {
                    echo "<a href='../docs/nueva_respuesta.php?id=$id&titulo=$titulo'><button type='button' class='btn btn-default btn-success'>Responder</button></a><br><br>";
                    echo "<div class='panel-body' id='tema_titulo'>Re: $titulo </div>";
                }
                echo "<div class='panel-body' id='tema_autor'>Creado por $autor , el $fecha </div>";
                echo "<div class='panel-body' id='tema_texto'>$texto</div><br><hr>";
            }
        }
    }
}

function borrarTema($varsesion, $datos, $id, $nombre) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Recibir los datos y almacenarlos en variables
    $clave1 = $datos['clave1'];
    $clave2 = $datos['clave2'];

//Comprobaciones de php para validar o no el formulario
    if (empty($clave1)) {
        echo '<script>alert("* Debes escribir una contraseña");
        window.history.go(-1);</script>';
    } elseif (strlen($clave1) < 8) {
        echo '<script>alert("* La contraseña debe contener mas de 8 caracteres");
        window.history.go(-1);</script>';
    } elseif (strlen($clave1) > 50) {
        echo '<script>alert("* La contraseña debe contener menos de 50 caracteres");
        window.history.go(-1);</script>';
    } elseif (empty($clave2)) {
        echo '<script>alert("* Debes repetir la contraseña");
        window.history.go(-1);</script>';
    } elseif ($clave1 !== $clave2) {
        echo '<script>alert("* Ambas contraseñas deben coincidir");
        window.history.go(-1);</script>';
    } else {
//Consulta para comprobar que el usuario es el autor del tema
        $consulta = "select * from usuarios where nombre='$nombre' and password='$clave2'";
        $validacion = mysqli_query($conexion, $consulta);

        $filas = mysqli_num_rows($validacion);

        if ($filas > 0) {
//Consulta para eliminar el tema indicado
            $eliminar = mysqli_query($conexion, "delete from temas where id='$id'");
            $resultado = mysqli_query($conexion, $eliminar);
            header("Location: foro.php");
        } else {
            echo '<script>alert("La contraseña es incorrecta, el tema no sera eliminado");
        window.history.go(-1);</script>';
        }
    }


//Cerrar conexion a la base de datos
    mysqli_close($conexion);
}

function verTemaPropio($id) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Consulta para seleccionar el contenido del texto del tema seleccionado, lo uso para editar los temas de esta forma
//cuando un usuario edita su tema, le aparecera en el campo del texto, todo su contenido anterior, asi puede cambiar lo que
//quiera sin tener que escribir de nuevo todo 
    $contenido = mysqli_query($conexion, "select titulo, texto from temas where id='$id'");
    $fila3 = mysqli_fetch_array($contenido);
    $texto = $fila3['texto'];

    return $texto;
}

function verRespuestaPropia($id) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Consulta para seleccionar el contenido del texto de la respuesta seleccionada, lo uso para editar los temas de esta forma
//cuando un usuario edita su respuesta, le aparecera en el campo del texto, todo su contenido anterior, asi puede cambiar 
//lo que quiera sin tener que escribir de nuevo todo 
    $contenido = mysqli_query($conexion, "select titulo, texto from respuestas where id='$id'");
    $fila3 = mysqli_fetch_array($contenido);
    $respuesta = $fila3['texto'];

    return $respuesta;
}

function editarTema($varsesion, $datos, $id, $nombre) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Recibir los datos y almacenarlos en variables
    $titulo = $datos['titulo'];
    $texto = $datos['texto'];

//Comprobaciones de php para validar o no el formulario
    if (empty($titulo)) {
        echo '<script>alert("No puedes editar un tema sin titulo");
        window.history.go(-1);</script>';
    } elseif (strlen($titulo) < 4) {
        echo '<script>alert("El titulo debe tener mas de 4 caracteres");
        window.history.go(-1);</script>';
        exit;
    } elseif (strlen($titulo) > 100) {
        echo '<script>alert("El titulo debe tener menos de 100 caracteres");
        window.history.go(-1);</script>';
        exit;
    } elseif (empty($texto)) {
        echo '<script>alert("No puedes editar un tema sin contenido");
        window.history.go(-1);</script>';
    } else {

        if ($varsesion == $nombre) {
//Consulta para actualizar los campos editados por el usuario en la base de datos
            $update = mysqli_query($conexion, "update temas set titulo='$titulo', texto='$texto' where id='$id'");
            $resultado = mysqli_query($conexion, $update);
            header("Location: temas.php?id=$id");
        } else {
            echo '<script>alert("No eres el autor del tema, no puedes editarlo");
        window.history.go(-1);</script>';
        }
    }
}

function borrarRespuesta($varsesion, $datos, $id, $nombre) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Recibir los datos y almacenarlos en variables
    $clave1 = $datos['clave1'];
    $clave2 = $datos['clave2'];

//Comprobaciones de php para validar o no el formulario
    if (empty($clave1)) {
        echo '<script>alert("* Debes escribir una contraseña");
        window.history.go(-1);</script>';
    } elseif (strlen($clave1) < 8) {
        echo '<script>alert("* La contraseña debe contener mas de 8 caracteres");
        window.history.go(-1);</script>';
    } elseif (strlen($clave1) > 50) {
        echo '<script>alert("* La contraseña debe contener menos de 50 caracteres");
        window.history.go(-1);</script>';
    } elseif (empty($clave2)) {
        echo '<script>alert("* Debes repetir la contraseña");
        window.history.go(-1);</script>';
    } elseif ($clave1 !== $clave2) {
        echo '<script>alert("* Ambas contraseñas deben coincidir");
        window.history.go(-1);</script>';
    } else {
//Consulta para comprobar que el usuario es el autor de la respuesta
        $consulta = "select * from usuarios where nombre='$nombre' and password='$clave2'";
        $validacion = mysqli_query($conexion, $consulta);

        $filas = mysqli_num_rows($validacion);

        if ($filas > 0) {
//Consulta para eliminar la respuesta indicada
            $eliminar = mysqli_query($conexion, "delete from respuestas where id='$id'");
            $resultado = mysqli_query($conexion, $eliminar);
            header("Location: foro.php");
        } else {
            echo '<script>alert("La contraseña es incorrecta, el tema no sera eliminado");
        window.history.go(-1);</script>';
        }
    }


//Cerrar conexion a la base de datos
    mysqli_close($conexion);
}

function editarRespuesta($varsesion, $datos, $id, $nombre) {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Recibir los datos y almacenarlos en variables
    $titulo = $datos['titulo'];
    $texto = $datos['texto'];

//Comprobaciones de php para validar o no el formulario
    if (empty($titulo)) {
        echo '<script>alert("No puedes editar un tema sin titulo");
        window.history.go(-1);</script>';
    } elseif (strlen($titulo) < 4) {
        echo '<script>alert("El titulo debe tener mas de 4 caracteres");
        window.history.go(-1);</script>';
        exit;
    } elseif (strlen($titulo) > 100) {
        echo '<script>alert("El titulo debe tener menos de 100 caracteres");
        window.history.go(-1);</script>';
        exit;
    } elseif (empty($texto)) {
        echo '<script>alert("No puedes editar un tema sin contenido");
        window.history.go(-1);</script>';
    } else {

        if ($varsesion == $nombre) {
//Consulta para actualizar los campos editados por el usuario en la base de datos
            $update = mysqli_query($conexion, "update respuestas set titulo='$titulo', texto='$texto' where id='$id'");
            $resultado = mysqli_query($conexion, $update);
            header("Location: foro.php");
        } else {
            echo '<script>alert("No eres el autor del tema, no puedes editarlo");
        window.history.go(-1);</script>';
        }
    }
}

function obtenerDatosLiga() {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Consulta para seleccionar los campos necesarios, para mostrar los temas en el foro
    $consulta = mysqli_query($conexion, "select * from liga order by puntos desc");
    $nfilas = mysqli_num_rows($consulta);

//Este if comprueba los resultados de la consulta. Funciona con un for, el cual se encarga de ir añadiendo los nuevos temas 
//con su respectivo orden y estructura en el foro

    if ($nfilas > 0) {
        for ($i = 0; $i < $nfilas; $i++) {
            $fila = mysqli_fetch_array($consulta);
            $equipo = $fila['equipo'];
            $puntos = $fila['puntos'];
            $partidos = $fila['partidos'];
            $ganados = $fila['ganados'];
            $empatados = $fila['empatados'];
            $perdidos = $fila['perdidos'];
            $goles = $fila['goles'];
            $encajados = $fila['encajados'];
            $posicion = $i + 1;

            echo "<tr>"
            . "<th>$posicion</th>"
            . "<td>$equipo</td>"
            . "<td>$puntos</td>"
            . "<td>$partidos</td>"
            . "<td>$ganados</td>"
            . "<td>$empatados</td>"
            . "<td>$perdidos</td>"
            . "<td>$goles</td>"
            . "<td>$encajados</td>"
            . "</tr>";
        }
    }

    mysqli_close($conexion);
}

function obtenerDatosPremier() {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Consulta para seleccionar los campos necesarios, para mostrar los temas en el foro
    $consulta = mysqli_query($conexion, "select * from premier order by puntos desc");
    $nfilas = mysqli_num_rows($consulta);

//Este if comprueba los resultados de la consulta. Funciona con un for, el cual se encarga de ir añadiendo los nuevos temas 
//con su respectivo orden y estructura en el foro

    if ($nfilas > 0) {
        for ($i = 0; $i < $nfilas; $i++) {
            $fila = mysqli_fetch_array($consulta);
            $equipo = $fila['equipo'];
            $puntos = $fila['puntos'];
            $partidos = $fila['partidos'];
            $ganados = $fila['ganados'];
            $empatados = $fila['empatados'];
            $perdidos = $fila['perdidos'];
            $goles = $fila['goles'];
            $encajados = $fila['encajados'];
            $posicion = $i + 1;

            echo "<tr>"
            . "<th>$posicion</th>"
            . "<td>$equipo</td>"
            . "<td>$puntos</td>"
            . "<td>$partidos</td>"
            . "<td>$ganados</td>"
            . "<td>$empatados</td>"
            . "<td>$perdidos</td>"
            . "<td>$goles</td>"
            . "<td>$encajados</td>"
            . "</tr>";
        }
    }

    mysqli_close($conexion);
}

function obtenerDatosSerie() {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Consulta para seleccionar los campos necesarios, para mostrar los temas en el foro
    $consulta = mysqli_query($conexion, "select * from serie order by puntos desc");
    $nfilas = mysqli_num_rows($consulta);

//Este if comprueba los resultados de la consulta. Funciona con un for, el cual se encarga de ir añadiendo los nuevos temas 
//con su respectivo orden y estructura en el foro

    if ($nfilas > 0) {
        for ($i = 0; $i < $nfilas; $i++) {
            $fila = mysqli_fetch_array($consulta);
            $equipo = $fila['equipo'];
            $puntos = $fila['puntos'];
            $partidos = $fila['partidos'];
            $ganados = $fila['ganados'];
            $empatados = $fila['empatados'];
            $perdidos = $fila['perdidos'];
            $goles = $fila['goles'];
            $encajados = $fila['encajados'];
            $posicion = $i + 1;

            echo "<tr>"
            . "<th>$posicion</th>"
            . "<td>$equipo</td>"
            . "<td>$puntos</td>"
            . "<td>$partidos</td>"
            . "<td>$ganados</td>"
            . "<td>$empatados</td>"
            . "<td>$perdidos</td>"
            . "<td>$goles</td>"
            . "<td>$encajados</td>"
            . "</tr>";
        }
    }

    mysqli_close($conexion);
}

function obtenerDatosLigue() {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Consulta para seleccionar los campos necesarios, para mostrar los temas en el foro
    $consulta = mysqli_query($conexion, "select * from ligue order by puntos desc");
    $nfilas = mysqli_num_rows($consulta);

//Este if comprueba los resultados de la consulta. Funciona con un for, el cual se encarga de ir añadiendo los nuevos temas 
//con su respectivo orden y estructura en el foro

    if ($nfilas > 0) {
        for ($i = 0; $i < $nfilas; $i++) {
            $fila = mysqli_fetch_array($consulta);
            $equipo = $fila['equipo'];
            $puntos = $fila['puntos'];
            $partidos = $fila['partidos'];
            $ganados = $fila['ganados'];
            $empatados = $fila['empatados'];
            $perdidos = $fila['perdidos'];
            $goles = $fila['goles'];
            $encajados = $fila['encajados'];
            $posicion = $i + 1;

            echo "<tr>"
            . "<th>$posicion</th>"
            . "<td>$equipo</td>"
            . "<td>$puntos</td>"
            . "<td>$partidos</td>"
            . "<td>$ganados</td>"
            . "<td>$empatados</td>"
            . "<td>$perdidos</td>"
            . "<td>$goles</td>"
            . "<td>$encajados</td>"
            . "</tr>";
        }
    }

    mysqli_close($conexion);
}

function obtenerDatosBundes() {
//LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

//Consulta para seleccionar los campos necesarios, para mostrar los temas en el foro
    $consulta = mysqli_query($conexion, "select * from bundes order by puntos desc");
    $nfilas = mysqli_num_rows($consulta);

//Este if comprueba los resultados de la consulta. Funciona con un for, el cual se encarga de ir añadiendo los nuevos temas 
//con su respectivo orden y estructura en el foro

    if ($nfilas > 0) {
        for ($i = 0; $i < $nfilas; $i++) {
            $fila = mysqli_fetch_array($consulta);
            $equipo = $fila['equipo'];
            $puntos = $fila['puntos'];
            $partidos = $fila['partidos'];
            $ganados = $fila['ganados'];
            $empatados = $fila['empatados'];
            $perdidos = $fila['perdidos'];
            $goles = $fila['goles'];
            $encajados = $fila['encajados'];
            $posicion = $i + 1;

            echo "<tr>"
            . "<th>$posicion</th>"
            . "<td>$equipo</td>"
            . "<td>$puntos</td>"
            . "<td>$partidos</td>"
            . "<td>$ganados</td>"
            . "<td>$empatados</td>"
            . "<td>$perdidos</td>"
            . "<td>$goles</td>"
            . "<td>$encajados</td>"
            . "</tr>";
        }
    }

    mysqli_close($conexion);
}

function mostrarNoticias() {
    //LLamar al fichero indicado, para iniciar la conexion
    $conexion = conexion();

    $id = $_GET['id'];

//Consulta para seleccionar los campos necesarios, para mostrar los temas en el foro
    $consulta = mysqli_query($conexion, "select * from noticias where id='$id'");
    $nfilas = mysqli_num_rows($consulta);
    $fila = mysqli_fetch_array($consulta);
    $titulo = $fila['titulo'];
    $texto = nl2br($fila['texto']); //Esta funcion, permite que haya saltos de linea, en los campos de texto
    $fecha = $fila['fecha'];


    echo "<div class='panel-body' id='tema_titulo_noticia'> $titulo"
    . "<img src='../img/noticia$id.jpg' alt='Imagen Jornada' class='imagennoticiaprincipal img-responsive'>"
    . "</div>";
    echo "<div class='panel-body' id='tema_autor'>Creado el $fecha </div>";
    echo "<div class='panel-body' id='tema_texto'>$texto</div>";

    mysqli_close($conexion);
}
