<?php

# Guardamos la conexion a la BD por si las flys

//FUNCION CREAR USUARIO
function crearUsuario($correo,$nombre,$contrasenya){
     require ("../configuracion/conexion.php");
    
    //COMPROBAR SI EL CORREO YA ESTA EN USO
    $comprobarCorreo ="SELECT correo FROM Usuarios WHERE correo='$correo'";
     $resultCorreo = mysqli_query($conn, $comprobarCorreo);
    
    $filasCorreo=mysqli_num_rows($resultCorreo);
    if($filasCorreo==0){
        
        //COMPROBAR SI YA EXISTE EL NOMBRE DE USUARIO
        
        $comprobarNombre ="SELECT nombre_usuario FROM Usuarios WHERE nombre_usuario='$nombre'";
        $resultNombre = mysqli_query($conn, $comprobarNombre);
    
        $filasNombre=mysqli_num_rows($resultNombre);
        if($filasNombre==0){
            
            //AUTOINCREMENTAR ID
            $cons = "SELECT ID_usuario FROM Usuarios ORDER BY ID_usuario DESC LIMIT 1;";
             $result = mysqli_query($conn, $cons);
                
            while($fila = mysqli_fetch_array($result)){
                    
                    $ID = $fila[0] + 1;
            }
            //METER USUARIO
            $addUsuario = "INSERT INTO Usuarios VALUES('$ID','$nombre','$contrasenya','$correo');";
            $result = mysqli_query($conn, $addUsuario);
            
            
             //INICIAR SESION DESPUES DE CREARLO
            
            $cons="SELECT * FROM Usuarios WHERE correo='$correo' and password='$contrasenya'";
              $result = mysqli_query($conn, $cons);
   
            if ($fila = mysqli_fetch_array($result)) {
        
            session_start();
    	    $_SESSION["correo"] = $fila['correo'];
    	    $_SESSION["usuario"] = $fila['nombre_usuario'];
    	    $_SESSION["id"] =  $fila['ID_usuario'];
    	    $_SESSION["idAlbum"] = "";
	        $_SESSION["nombre_album"] = "";
            }
            
            return 0;
            
            }else{
                return 2;
            }
    }else{
        return 1;
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);

    //LISTA DE ERRORES Y CORRECTO:
    //0 Funciona todo bien
    //1 Correo en uso
    //2 Nombre en uso
    }
    
    
//FUNCION INICIAR SESION
    function iniciarSesion($correo,$contrasenya){
    
    require ("../configuracion/conexion.php");
        
    $cons="SELECT * FROM Usuarios WHERE correo='$correo' and password='$contrasenya';";
    $result = mysqli_query($conn, $cons);
  
    $filas=mysqli_num_rows($result);
    
    //Si el usuario y la contraseña es correcta
    if($filas>0){
	
	//RECOGER DATOS DE ESE USUARIO
	
	 $cons="SELECT * FROM Usuarios WHERE correo='$correo'";
	 
	$campos = mysqli_query($conn, $cons);
	
	while($elemento = mysqli_fetch_array($campos)){
	    $usuario = $elemento["nombre_usuario"];
	    $id = $elemento["ID_usuario"];
	}
	 
	//EMPEZAR SESION Y PASAR DATOS
	session_start();
	$_SESSION["correo"] = $correo;
	$_SESSION["usuario"] = $usuario;
	$_SESSION["id"] = $id;
	$_SESSION["idAlbum"] = "";
	$_SESSION["nombre_album"] = "";
	return 1;
           
    }else{
        //La informacion es incorrecta
        return 2;
    }
    }
    
    
?>
