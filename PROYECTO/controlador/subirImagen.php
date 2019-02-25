<?php
require("../configuracion/conexion.php");
session_start();

$nombreAlbum = $_SESSION["nombre_album"];

$nombreImagen = $_POST["nombreImagen"];
$comentario   = $_POST["comentarioImagen"];
$propietario  = $_SESSION["id"];



$nombreFichero = $_FILES["nuevaImagen"]["name"];


//ENCONTRAR EL ID DEL ALBUM

$query  = "SELECT * FROM Albums WHERE propietario = '$propietario' AND nombre_album = '$nombreAlbum';";
$result = mysqli_query($conn, $query);


while ($fila = mysqli_fetch_array($result)) {
    
    $idAlbum = $fila[0];
    
}

$_SESSION["idAlbum"] = $idAlbum;

//AUTOINCREMENTAR ID

$cons   = "SELECT ID_Imagen FROM Imagenes ORDER BY ID_Imagen DESC LIMIT 1;";
$result = mysqli_query($conn, $cons);

while ($fila = mysqli_fetch_array($result)) {
    
    $ID = $fila[0] + 1;
    
}

if ($ID < 1) {
    $ID = 0;
}

//CREAR RUTA UNICA DE IMAGEN

$rutaUnicaImagen = "imagen" . $ID;

move_uploaded_file($_FILES["nuevaImagen"]["tmp_name"], "../galeriaImagenes/$rutaUnicaImagen");

//INSERTAR IMAGEN
$query = "INSERT INTO `Imagenes` VALUES ('$ID', '$comentario', '$propietario','$nombreImagen','$rutaUnicaImagen');";

$result = mysqli_query($conn, $query);

//METER LA IMAGEN EN EL ALBUM

$query = "INSERT INTO `Contiene` VALUES ('$idAlbum', '$ID');";

$result = mysqli_query($conn, $query);

$direccion = "../vista/paginaAlbums.php";

header('Location: ' . $direccion);


?>