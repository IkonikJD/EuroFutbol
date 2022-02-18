/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Esta funcion sirve para sustituir el contenido de articulos, por el nuevo contenido de la primera columna Bienvenida
function boton() {
document.getElementById('articulos').innerHTML = '<div class="col-md-12"><br><button type="button" class="botonranking btn btn-default btn-success" onclick="recargar(this)">Volver</button><div class="panel-body introduccion"><p><span class="titulo">BIENVENIDO !</span></p>\n\
\n\<p>\n\
<span class="titulo1">SI QUIERES SABER TODO ACERCA DE LAS PRINCIPALES LIGAS DE EUROPA, ¡EUROFUTBOL ES TU PAGINA!</span></p></div>\n\
<div class="panel-body text-justify"><p>EuroFutbol es la mejor pagina de futbol en español, donde podras tener acceso a toda la informacion,relativa a las cinco grandes liga de europa (Liga Santander, Premier League, Bundesliga, Ligue 1 y Serie A).</p><p>Ademas por supuesto de toda la informacion sobre la UEFA Champions League y UEFA Europa League, fichajes y mucho mas...Las cinco grandes ligas europeas (la Premier League inglesa, la Bundesliga alemana, LaLiga española, la Serie A italiana y la Ligue 1 francesa) cada vez son más poderosas económicamente, hasta el punto que las ganancias de sus clubs suponen el 75 % de las de todas las primeras divisiones europeas.</p>\n\El poderío económico del ‘Top 5’ de competiciones no ha hecho sino crecer en la última década, ya que del 69 % que representaban en 2009 sobre el total de los ingresos de las primeras categorías de los 55 países de la UEFA han pasado al 75 % en 2018, en un periodo en el que los ingresos totales se han duplicado, de 11.700 millones a 21.080, según datos de la asociación del fútbol europeo. En los ingresos del último año revelado por un extenso informe de la UEFA, 2018, la Premier League inglesa domina con 5.400 millones de euros de ingresos, seguida por la Bundesliga (3.200) y LaLiga (3.100) casi empatadas, con la Serie A (2.300) y la Ligue 1 (1.700) a continuación, todas ellas con una diferencia abismal sobre los ingresos de los clubes del siguiente campeonato, el ruso (752).</p>\n\
<br><img src="./img/portada.jpg" alt="Imagen Portada" class="imageninicio img-responsive"></div></div>';
        }

//Esta funcion sirve para sustituir el contenido de articulos, por el nuevo contenido de la segunda columna Jornada
function boton1() {
document.getElementById('articulos').innerHTML = '<div class="col-md-12"><br><button type="button" class="botonranking btn btn-default btn-success" onclick="recargar(this)">Volver</button><div class="panel-body introduccion"><p><span class="titulo">ULTIMA JORNADA !</span></p> <p><span class="titulo1">LA LIGA SANTANDER DISPUTARA SU JORNADA NUMERO 18</span></p></div><div class="panel-body text-justify"><img src="./img/horario.jpg" alt="Imagen Horario" class="imageninicio img-responsive"><br><p>LaLiga ha dado a conocer los horarios de la jornada 18 de LaLiga Santander 2020/21. Esta comenzará el viernes 8 de enero con el Celt -Villarreal y terminará el lunes 11 de enero con el Huesca-Betis.Los cuatro equipos que juegan Champions League disputarán sus respectivos encuentros el sábado 9 de enero. El Sevilla se medirá en el Sanchéz Pizjuán a la Real Sociedad, a las 14.00 horas. Le sigue el Atlético-Athletic, a las 16.15 horas en el Wanda Metropolitano; el Granada-Barcelona, a las 18.30; y el Osasuna-Real Madrid, a las 21.00 horas.<br><br> <br></div></div>';
}

//Esta funcion sirve para sustituir el contenido de articulos, por el nuevo contenido de la tercera columna Ranking
function boton2() {
document.getElementById('articulos').innerHTML = '<div class="col-md-6"><br><button type="button" class="botonranking btn btn-default btn-success" onclick="recargar(this)">Volver</button><div class="panel-body introduccion"><p><span class="titulo">PICHICHI DE LA LIGA SANTANDER</span></p></div><div class="panel-body"><p>Antes de comenzar los partidos de la jornada 18 de la Liga Santander, Luis Suarez, jugador del Atletico de Madrid, es el máximo goleador de la competición con 9 goles, empatado con Gerard (Villareal) y Iago Aspas (Celta).</p><br><img src="./img/luis.jpeg" alt="Imagen Pichichi" class="imageninicio img-responsive"><br></div></div><div class="col-md-6"><div class="panel-body introduccionasistente"><p><span class="titulo">MAXIMO ASISTENTE DE LA LIGA SANTANDER</span></p></div><div class="panel-body"><p>Respecto a los máximos asistentes de la Liga Santander, Messi, del Barcelona, es el futbolista que más goles ha entregado con 12 asistencias. Portu, jugador de la Real Sociedad, es el segundo con 8 pases de gol, mientras que Roberto Torres, del Osasuna, ocupa la tercera plaza del ranking con 7 asistencias.</p><br><img src="./img/messi.jpg" alt="Imagen Asistente" class="imageninicio img-responsive"></div></div>';
}

//Esta funcion nos permite validar si el usuario ha acertado en la pagina del juego
function acierta(id, valido1, valido2, url, carta, error) {
var valor = document.getElementById(id).value.toLowerCase();
        if (valor == valido1 || valor == valido2) {
document.getElementById(error).innerHTML = '';
        document.getElementById(carta).innerHTML = '<img src="' + url + '" class="imagenposicion"><br>';
        } else {
document.getElementById(error).innerHTML = 'Lo siento, pero no has acertado el jugador que se esconde tras la carta\n\
                                                        debe volver a intentarlo con otro jugador';
        }
}

//Esta funcion valida que todos los campos del formulario, esten correctos
function validar() {
var nombre = document.getElementById('nombre').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('clave1').value;
        var password2 = document.getElementById('clave2').value;
        if (!isNaN(nombre)) {
alert('Debes introducir un nombre valido');
        return false;
        } else if (!isNaN(email)) {
alert('Debes introducir un email valido');
        return false;
        } else if (!isNaN(password)) {
alert('Debes introducir una contraseña valida');
        return false;
        } else if (!isNaN(password2)) {
alert('Debes introducir una contraseña valida');
        return false;
        }
}

//Esta funcion valida que el nombre en el formulario, sea correcto
function valida() {
var nombre = document.getElementById('nombre').value;
        document.getElementById('errornom').innerHTML = '';
        if (!isNaN(nombre)) {
document.getElementById('errornom').innerHTML = ' * El nombre no puede contener unicamente caracteres numéricos';
        document.getElementById('nombre').focus();
        document.getElementById('nombre').value = '';
        } else if (nombre.length <= 3) {
document.getElementById('errornom').innerHTML = ' * Debes introducir un nombre con 4 caracteres o mas';
        document.getElementById('nombre').focus();
        document.getElementById('nombre').value = '';
        } else if (nombre.length >= 50) {
document.getElementById('errornom').innerHTML = ' * Debes introducir un nombre con menos de 50 caracteres';
        document.getElementById('nombre').focus();
        document.getElementById('nombre').value = '';
        } else {
//document.getElementById('nombre').readOnly = true; Esta opcion hace que al introducir un nombre correcto el usuario
//no pueda modificar ese campo, he decidido desactivarlo, aunque me parece una buena funcion y por eso la he dejado en
//el codigo ya que podria ser una opcion interesante para utilizarse.
document.getElementById('errornom').innerHTML = ' ';
        }
}

//Esta funcion valida que el email en el formulario, sea correcto
function valida1() {
var email = document.getElementById('email').value;
        document.getElementById('errorem').innerHTML = '';
        expresion = /\w+@\w+\.+[a-z]/;
        if (!expresion.test(email)) {
document.getElementById('errorem').innerHTML = ' * Debes introducir un email con el formato correcto, similar al ejemplo';
        document.getElementById('email').focus();
        document.getElementById('email').value = '';
        } else {
//document.getElementById('email').readOnly = true;
document.getElementById('errorem').innerHTML = ' ';
        }
}

//Esta funcion valida que la contraseña en el formulario, sea correcta
function valida2() {
var password1 = document.getElementById('clave1').value;
        document.getElementById('errorpa1').innerHTML = '';
        if (password1.length < 8) {
document.getElementById('errorpa1').innerHTML = '  La contraseña debe contener mas de 8 caracteres<br><br>';
        document.getElementById('clave1').focus();
        document.getElementById('clave1').value = '';
        } else if (password1.length > 50) {
document.getElementById('errorpa1').innerHTML = '  La contraseña debe contener menos de 50 caracteres<br><br>';
        document.getElementById('clave1').focus();
        document.getElementById('clave1').value = '';
        } else {
//document.getElementById('clave1').readOnly = true;
document.getElementById('errorpa1').innerHTML = ' ';
        }
}

//Esta funcion valida que la contraseña sea la misma en ambas opciones
function valida3() {
var password1 = document.getElementById('clave1').value;
        var password2 = document.getElementById('clave2').value;
        document.getElementById('errorpa2').innerHTML = '';
        if (password1 != password2) {
document.getElementById('errorpa2').innerHTML = '  Ambas contraseñas deben coincidir<br><br>';
        document.getElementById('clave2').focus();
        document.getElementById('clave2').value = '';
        } else {
//document.getElementById('clave2').readOnly = true;
document.getElementById('errorpa2').innerHTML = ' ';
        }
}

//Esta funcion simplemente recarga la pagina en la que nos encontramos, esta puesta aqui, para ser llamada en 
//los momentos que necesitemos
function recargar() {
location.reload();
}

//Esta funcion, oculta el div de inicio de sesion
function login() {
var oculto = document.getElementById('login'); //Esta linea almacena el div llamado login en la variable oculto
        oculto.style.display = (oculto.style.display == 'none') ? 'inline' : 'none'; //Y esta linea, sustituye el parametro display none, por inline
}

//Esta funcion valida que el titulo en el formulario, sea correcto
function valida_titulo() {
var titulo = document.getElementById('tituloform').value;
        document.getElementById('errornom').innerHTML = '';
        if (!isNaN(titulo)) {
document.getElementById('errornom').innerHTML = ' * El titulo no puede contener unicamente caracteres numéricos<br><br>';
        document.getElementById('tituloform').focus();
        document.getElementById('tituloform').value = '';
        } else if (titulo.length <= 3) {
document.getElementById('errornom').innerHTML = ' * Debes introducir un titulo con 4 caracteres o mas<br><br>';
        document.getElementById('tituloform').focus();
        document.getElementById('tituloform').value = '';
        } else if (titulo.length >= 30) {
document.getElementById('errornom').innerHTML = ' * Debes introducir un titulo con menos de 30 caracteres<br><br>';
        document.getElementById('tituloform').focus();
        document.getElementById('tituloform').value = '';
        } else {
document.getElementById('tituloform').readOnly = true;
        document.getElementById('errornom').innerHTML = ' ';
        }
}