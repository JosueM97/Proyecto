<?php
function getImagenes() {
    
    require ("../configuracion/conexion.php");
    
    session_start();
    
    $idAlbum = $_SESSION["idAlbum"];
    
    
    $query = "SELECT * FROM Imagenes WHERE ID_Imagen IN (SELECT ID_imagen FROM Contiene WHERE ID_album='$idAlbum');";
    
    
    $result = mysqli_query($conn, $query);
    
    $array;
    $i = 0;
   while ($fila = mysqli_fetch_array($result)) {

    $array[$i] = $fila['ID_Imagen'];
    $i++;
  }
    return $array;
    
}


function getNombreImagen($idImagen){
 
 require ("../configuracion/conexion.php");
 
 $query = "SELECT nombre_imagen FROM Imagenes WHERE ID_Imagen = $idImagen;";
    
 $result = mysqli_query($conn, $query);
 
 while ($fila = mysqli_fetch_array($result)) {

    $nombreImagen = $fila['nombre_imagen'];
  }

return $nombreImagen;
}


function getComentarioImagen($idImagen){
    require ("../configuracion/conexion.php");
 
    $query = "SELECT comentario FROM Imagenes WHERE ID_Imagen = $idImagen;";
    
    $result = mysqli_query($conn, $query);
 
    while ($fila = mysqli_fetch_array($result)) {

        $comentario = $fila['comentario'];
    }

return $comentario;
    
}

function borrarImagen($idImagen){
    
    
    require ("../configuracion/conexion.php");
 
    unlink("../galeriaImagenes/imagen".$idImagen);
 
    $query = "DELETE FROM Imagenes WHERE ID_Imagen = $idImagen;";
    
    mysqli_query($conn, $query);
    
    $query = "DELETE FROM Contiene WHERE ID_imagen = $idImagen;";
    
    mysqli_query($conn, $query);
    
    
}





/*
function subirImagen($nombreImagen,$comentario,$nombreFichero){
    //$tamaño = $_FILES["nuevaImagen"]["size"]."<br>";
    
    //echo "El tipo de archivo es: ".$_FILES["nuevaImagen"]["type"]."<br>";
  
  
    require ("../configuracion/conexion.php");
    session_start();
    
    
    $propietario = $_SESSION["id"];
    
    $idAlbum = $_SESSION["idAlbum"];
    
    
     //AUTOINCREMENTAR ID
     
        $cons = "SELECT ID_Imagen FROM Imagenes ORDER BY ID_Imagen DESC LIMIT 1;";
        $result = mysqli_query($conn, $cons);
                
        while($fila = mysqli_fetch_array($result)){
 
           $ID = $fila[0] + 1;
           error_log("[ * LOG * ] -> idIm: ". $ID);
        
        }
        
    //CREAR RUTA UNICA DE IMAGEN
    
    $rutaUnicaImagen = "imagen".$ID;
    
    move_uploaded_file ( $_FILES["nuevaImagen"]["tmp_name"], "../galeriaImagenes/$rutaUnicaImagen");
    
    //INSERTAR IMAGEN
    $query = "INSERT INTO `Imagenes` VALUES ('$ID', '$comentario', '$propietario', '0','$nombreImagen','$rutaUnicaImagen');";
    
    $result = mysqli_query($conn, $query);
    
    //METER LA IMAGEN EN EL ALBUM
    
    $query = "INSERT INTO `Contiene` VALUES ('$idAlbum', '$ID');";
    
    $result = mysqli_query($conn, $query);
    
    $direccion = "../vista/paginaAlbums.php";
    
    header('Location: '. $direccion);
}
*/



?>