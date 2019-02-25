<?php
$accion = $_GET["accion"];
//$accionPost = $_POST["accion"];
//LOS REQUIRE SIEMPRE AQUI ARRIBA, SI SE PONE 2 VECES AUNQUE SEA DENTRO DE IF NO FUNCIONA POR QUE DECLARA LA MISMA FUNCION 2 VECES O MAS
require_once("../modelo/usuario.php");
require_once("../modelo/album.php");
require_once("../modelo/imagen.php");
session_start();
if ($accion == "crearUsuario") {
    $correo        = $_GET["correo"];
    $nombre        = $_GET["nombre"];
    $contraUsuario = $_GET["password"];
    $resultado     = crearUsuario($correo, $nombre, $contraUsuario);
    echo $resultado;
}

if ($accion == "iniciarSesion") {
    $correo        = $_GET["correo"];
    $contraUsuario = $_GET["password"];
    $resultado     = iniciarSesion($correo, $contraUsuario);
    echo $resultado;
}

if ($accion == "crearAlbum") {
    $nombreAlbum = $_GET["nombreAlbum"];
    $propietario = $_SESSION['id'];
    error_log("[ * LOG * ] -> Propietario: " . $propietario);
    crearAlbum($nombreAlbum, $propietario);
}

if ($accion == "buscarIdAlbum") {
    $nombreAlbum = $_GET["nombreAlbum"];
    buscarIdAlbum($nombreAlbum);
}

if ($accion == "subirImagen") {
    $nombreImagen  = $_POST["nombreImagen"];
    $comentario    = $_POST["comentarioImagen"];
    $nombreFichero = $_FILES["nuevaImagen"]["name"];
    subirImagen($nombreImagen, $comentario, $nombreFichero);
}

if ($accion == "borrarAlbum") {
    borrarAlbum();
}

if ($accion == "borrarImagen") {
    $idImagen = $_GET["idImagen"];
    borrarImagen($idImagen);
}
if ($accion == "cambiarNombreAlbum"){
    
    $nuevoNombreImagen = $_GET["nuevoNombre"];
    cambiarNombreAlbum($nuevoNombreImagen);
}
?>