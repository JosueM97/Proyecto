<?php


//CREAR UN ALBUM NUEVO
function crearAlbum($nombreAlbum,$propietario){
    require ("../configuracion/conexion.php");
    session_start();
    
    
    //QUE SOLO PUEDA TENER 3 ALBUMS CADA USUARIO 
    $cons="SELECT * FROM Albums WHERE propietario=" . $_SESSION['id'];
    $result = mysqli_query($conn, $cons);
    
    $filasAlbums=mysqli_num_rows($result);
    if($filasAlbums<3){
     
     
     //COMPROBAR QUE EL USUARIO NO TIENE YA UN ALBUM CON ESE NOMBRE
     
     $query = "SELECT * FROM Albums WHERE propietario = '$propietario' AND nombre_album = '$nombreAlbum';";
     $result = mysqli_query($conn, $query);
    
     $filasAlbums=mysqli_num_rows($result);
     if($filasAlbums==0){
     
        
        //AUTOINCREMENTAR ID
        $cons = "SELECT ID_album FROM Albums ORDER BY ID_album DESC LIMIT 1;";
        $result = mysqli_query($conn, $cons);
                
        while($fila = mysqli_fetch_array($result)){
 
           $ID = $fila[0] + 1;
        
        }
        
        if($ID < 1){
            $ID = 0;
        }
        
        
    
        $query = "INSERT INTO `Albums` (`ID_album`, `nombre_album`, `propietario`) VALUES ('$ID', '$nombreAlbum', '$propietario');";
        
        $result = mysqli_query($conn, $query);
        
        //PONER EN LA SESION EL NOMBRE DEL ALBUM Y LA ID
        $_SESSION["nombre_album"] = $nombreAlbum;
        $_SESSION["idAlbum"] = $fila[0];
        

         
     }else{
      // TODO > MENSAJE DE YA HAY UN ALBUM CON ESE NOMBRE
     }
    }else{
         //TO DO-> MENSAJE DE YA HAY 3 ALBUMS 
    }
    
}

//DEVOLVER TODOS LOS ALBUMES

function getAlbums() {
    require ("../configuracion/conexion.php");
    session_start();
    
    $query = "SELECT * FROM Albums WHERE propietario = ". $_SESSION['id'];

    $result = mysqli_query($conn, $query);
    
    $array;
    $i = 0;
   while ($fila = mysqli_fetch_array($result)) {

    $array[$i] = $fila['nombre_album'];
    $i++;
  }
    return $array;
    
}


//PONER EN LA SESION EL ID DEL ALBUM

function buscarIdAlbum($nombreAlbum){
     require ("../configuracion/conexion.php");
    
    session_start();
    
    $propietario = $_SESSION["id"];
    
    //BUSCAR LA ID DEL USUARIO SABIENDO EL ID DEL USUARIO (PROPIETARIO) Y EL NOMBRE DEL ALBUM QUE DEBE SER UNICO
    $query = "SELECT ID_album FROM Albums WHERE propietario = '$propietario' AND nombre_album = '$nombreAlbum';";

    $result = mysqli_query($conn, $query);
    
    $array;
    
    //PASAR EL LA ID DEL ALBUM A LA SESION idAlbum
    while ($fila = mysqli_fetch_array($result)) {
       
      $_SESSION["idAlbum"] = $fila[0];
    }
  
    //METER EN LA SESION EL NOMBRE DEL ALBUM
  
    $_SESSION["nombre_album"] = $nombreAlbum;
    
    
}

function cambiarNombreAlbum($nuevoNombre){
    require ("../configuracion/conexion.php");
     session_start();
     
     $idAlbum = $_SESSION["idAlbum"];
     $propietario = $_SESSION["id"];
   
   $query = "SELECT ID_album FROM Albums WHERE nombre_album = '$nuevoNombre' AND propietario = '$propietario';";
   
        $result = mysqli_query($conn, $query);
    
        $filasNombre=mysqli_num_rows($result);
        if($filasNombre==0){
            
            $query = "UPDATE Albums SET nombre_album = '$nuevoNombre' WHERE ID_album = '$idAlbum';";
            mysqli_query($conn, $query);
            
            //reiniciar la sesion
            $_SESSION["nombre_album"] = $nuevoNombre;
            $_SESSION["idAlbum"] = $idAlbum;
        }else{
            echo "yaExiste";
        }

    
}

function borrarAlbum(){
     require ("../configuracion/conexion.php");
     session_start();
     
     $idAlbum = $_SESSION["idAlbum"];
   
   
   $query = "SELECT ID_Imagen FROM Contiene WHERE ID_album = $idAlbum;";

    $result = mysqli_query($conn, $query);
    
     while ($fila = mysqli_fetch_array($result)) {
       
       $imagenActual = $fila[0];
       
       //BORRAR IMAGENES DE LA CARPETA LA IMAGEN
       unlink("../galeriaImagenes/imagen".$imagenActual);
       
       //BORRAR LAS IMAGENES DE LA BASE DE DATOS
      $query="DELETE FROM Imagenes WHERE ID_Imagen = $imagenActual;";
      mysqli_query($conn, $query);
    }
    
    //BORRAR DE LA TABLA CONTIENE
    $query = "DELETE FROM Contiene WHERE ID_album = $idAlbum";
    mysqli_query($conn, $query);
    
    
    //BORRAR EL ALBUM
    
    $query = "DELETE FROM Albums WHERE ID_album = $idAlbum";
    mysqli_query($conn, $query);
    
    
}


?>