<?php 
   include '../modelo/album.php'; 
   $albums = getAlbums();
   
   //echo $albums[3];
   include '../modelo/imagen.php';  
   $imagenes = getImagenes();
   
   //echo $imagenes[0];
   
   
   // ESTO  $albumsID = getAlbumsID();
   
   
   ?>
<!DOCTYPE html>
<html>
   <head>
      <title>PicGallery</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
      <link rel="stylesheet" href="index.css">
      <style>
         body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
         .w3-bar-block .w3-bar-item {padding:20px}
      </style>
      <script src="paginaAlbums.js"></script>
   </head>
   <body>
      <?php
         if(!isset($_SESSION)){ 
             session_start(); 
         }
         if (isset($_SESSION["correo"])){
         ?>
      <!-- BARRA LATERAL (oculta por defecto) -->
      <nav id="barraLateral" class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left">
         <a href="javascript:void(0)" onclick="w3_close()"
            class="w3-bar-item w3-button">Cerrar</a>
         <a id="menuAlbums" class="w3-bar-item ">Albums</a>
         <?php
            //CREANDO EL MENU QUE LISTA LOS ALBUMES
            
              if(!isset($_SESSION)){ 
                  session_start(); 
              }
            
            
              $i = 0;
              while($i < count($albums)){
                ?>
         <div class="w3-bar-item w3-button albumsAutoCreados"><?php echo $albums[$i]; ?></div>
         <?php
            $i++;
            }
            ?>
         <div id="crearAlbum"  class="w3-bar-item w3-button">Crear nuevo Album</div>
         <div id="nombreAlbum" class="w3-bar-item">
            <input id="textoNombreAlbum" placeholder="Nombre del nuevo álbum" type="text" >
            <button id="botonCrearAlbum"><img src="../imagenesWeb/aceptar.jpeg"></button>
            <button id="botonCancelarAlbum"><img src="../imagenesWeb/cancelar.png"></button>
         </div>
         <div id="menuSesion" class="w3-bar-item"> Opciones de Sesión</div>
         <div id="cerrarSesion" class="w3-bar-item w3-button"> Cerrar Sesión</div>
      </nav>
      <!-- PARTE DE ARRIBA -->
      <div class="w3-top">
         <div id="barraSuperior" class="w3-white w3-xxlarge">
            <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
            <div id="nombreUsuario" class="w3-right w3-padding-16"><?php echo $_SESSION["usuario"]; ?></div>
            <a href="index.php">
            <img  id="logo" src="../imagenesWeb/logo.png">
            </a>  
         </div>
      </div>
      <!-- contenido -->
      <div id="divContenido" class="w3-main w3-content w3-padding" >
      <!-- First Photo Grid-->
      <div>
         <h2 id="tituloAlbum"><?php echo $_SESSION["nombre_album"] ?></h2>
      </div>
      <!--
         <form action="subirImagen.php" method="post" enctype="multipart/form-data">
            
          <input type="file" id="nuevaImagen" name="nuevaImagen" ></input>
          <input type="submit" id="subirImagen" name="subirImagen"></input>
          -->
      <!-- boton Opciones Album -->
      <!-- MODAL OPCIONES ALBUM -->
      <input type="image" id="opcionesAlbum" src="../imagenesWeb/Selector.png"></input>
      <div id="modalOpcionesAlbum" class="modal">
         <!-- Modal content -->
         <div class="modal-content">
            <div class="modal-header">
               <span class="close2">&times;</span>
               <h2>Opciones del Álbum</h2>
            </div>
            <div class="modal-body">
               <br>
               <label>Cambiar nombre del álbum</label>
               <input id="nuevoNombre" type="text"></input>
               <button id="botonCambiarNombre"><img src="../imagenesWeb/aceptar.jpeg"></button>
               <br><br>
               <label>Borrar este álbum (AVISO esta acción borrará el album y todo su contenido)</label>
               <button id="botonBorrarAlbum"><img src="../imagenesWeb/borrarCarpeta.jpeg"></button>
            </div>
            <div class="modal-footer">
               <h3><?php echo $_SESSION["nombre_album"] ?></h3>
            </div>
         </div>
      </div>
      <!-- MODAL SUBIR IMAGEN -->
      <input type="image" id="myBtn"  src="../imagenesWeb/subir.png"></input>
      <!-- The Modal -->
      <div id="myModal" class="modal">
         <!-- Modal content -->
         <div class="modal-content">
            <div class="modal-header">
               <span class="close">&times;</span>
               <h2>Subir Imagen</h2>
            </div>
            <div class="modal-body">
               <p>Selecciona la imagen que quieres subir</p>
               <form action="../controlador/subirImagen.php" method="post" enctype="multipart/form-data">
                  <input type="file" id="nuevaImagen" name="nuevaImagen" ></input>
                  <br>
                  <label>Ponle un nombre a tu nueva imagen</label>
                  <input type="text" id="nombreImagen" name="nombreImagen"/>
                  <br><br>
                  <label>Quieres ponerle un comentario?</label>
                  <input type="text" id="comentarioImagen" name="comentarioImagen"/>
                  <br>
                  <input type="submit" id="subirImagen" name="subirImagen"></input>
               </form>
            </div>
            <div class="modal-footer">
               <h3><?php echo $_SESSION["nombre_album"] ?></h3>
            </div>
         </div>
      </div>
      <!--<img id="iconoSubirImagen" src="subir.png"> -->
      <div class="w3-row-padding w3-padding-16 w3-center" id="food">
         <?php
            $i = 0;
            
            while($i < count($imagenes)){
              
              
            ?>
         <div class="w3-quarter divImagenesCreadas">
            <img id="<?php echo $imagenes[$i]."boton"?>" class="iconoImagenesCreadas" src="../imagenesWeb/cancelar.png">
            <img id="<?php echo $imagenes[$i]?>" src="../galeriaImagenes/imagen<?php echo $imagenes[$i]?>"  class="imagenesCreadas">
            <h3><?php echo getNombreImagen($i) ?></h3>
            <p><?php echo getComentarioImagen($i) ?></p>
         </div>
         <?php $i++;} 
            ?>
         <!-- Second Photo Grid-->
         <!--
            <!-- Pagination -->
         <!-- PARA PONER DISTINTAS PAGINAS Y QUE NO CARGUE TODO DE GOLPE 
            <div class="w3-center w3-padding-32">
              <div class="w3-bar">
                <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
                <a href="#" class="w3-bar-item w3-black w3-button">1</a>
                <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
                <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
                <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
                <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
              </div>
            </div>
            -->
         <!-- Footer -->
         <footer class="w3-row-padding w3-padding-32">
            <hr>
            <div class="w3-third">
               <h3>DESCRIPCIÓN</h3>
               <p>Esta es una página web desarrollada por Josue Mañez como proyecto para el segundo curso de Desarrollo de Apliaciones Web </p>
            </div>
            <div class="w3-third">
               <h3>COMPARTE</h3>
               <ul class="w3-ul w3-hoverable">
                  <a href="https://www.facebook.com/">
                     <li class="w3-padding-16">
                        <img src="../imagenesWeb/facebook.png" class="w3-left w3-margin-right" style="width:50px">
                        <span>Comparte tus fotos en:</span><br>
                        <span class="w3-large">Facebook</span>
                     </li>
                  </a>
                  <a href="https://www.instagram.com/">
                     <li class="w3-padding-16">
                        <img src="../imagenesWeb/instagram.png" class="w3-left w3-margin-right" style="width:50px">
                        <span>Comparte tus fotos en:</span><br>
                        <span class="w3-large">Instagram</span>
                     </li>
                  </a>
               </ul>
            </div>
            <div class="w3-third w3-serif">
               <h3>TAGS</h3>
               <p>
                  <span class="w3-tag w3-black w3-margin-bottom">Proyecto</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Fotos</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Imagenes</span>
                  <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Usuarios</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Galeria</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">WEB</span>
                  <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Pics</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Albums</span>
                  <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Diseño</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">JavaScript</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">PHP</span>
                  <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">CSS</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">HTML</span>
               </p>
            </div>
         </footer>
         <?php
            }
            ?>
         <!-- End page content -->
      </div>
      <script>
         // Script to open and close sidebar
         function w3_open() {
           document.getElementById("barraLateral").style.display = "block";
         }
          
         function w3_close() {
           document.getElementById("barraLateral").style.display = "none";
         }
      </script>
   </body>
</html>