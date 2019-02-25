document.addEventListener("DOMContentLoaded", cargar, false);


var ip = window.location.host;

var arrayRegistro = [];
var arrayLogin = [];
var botonRegistro;
var botonLogin;

function cargar() {

	//CERRAR SESION

	document.getElementById("cerrarSesion").addEventListener("click", cerrarSesion);

	//CAMBIAR A CREAR ALBUM
	document.getElementById("crearAlbum").addEventListener("click", cambiarACrearAlbum);

	//VOLVER A CAMBIAR AL MENU ANTERIOR
	document.getElementById("botonCancelarAlbum").addEventListener("click", cambiarAlMenuNormal);


	//CREAR NUEVO ALBUM
	document.getElementById("botonCrearAlbum").addEventListener("click", crearAlbum);

    //CAMBIAR NOMBRE ALBUM
    document.getElementById("botonCambiarNombre").addEventListener("click",cambiarNombreAlbum);
	//BORRAR ALBUM
	document.getElementById("botonBorrarAlbum").addEventListener("click", borrarAlbum);

	//ENCONTRAR LA ID DE LOS ALBUMS AL HACER CLICK

	var albums = document.getElementsByClassName("albumsAutoCreados");

	for (var i = 0; i < albums.length; i++) {
		albums[i].addEventListener('click', encontrarIdAlbum);
	}


	//BORRAR IMAGENES-----------------------------------------


	//mostrar botones
	var imagenes = document.getElementsByClassName("imagenesCreadas");

	for (var i = 0; i < imagenes.length; i++) {
		imagenes[i].addEventListener('mouseover', mostrarBotonBorrar);
		imagenes[i].addEventListener('mouseout', ocultarBotonBorrar);
	}

	//funcion borrar


	var botones = document.getElementsByClassName("iconoImagenesCreadas");

	for (var i = 0; i < botones.length; i++) {
		botones[i].addEventListener('click', borrarImagen);
	}


	//-----------------------------------------------------------------


	//MODAL SUBIR IMAGENES----------------------------------------
	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	btn.onclick = function () {
		modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function () {
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function (event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
	//----------------------------------------------------------------


	//MODAL SUBIR IMAGENES----------------------------------------
	// Get the modal
	var modal2 = document.getElementById('modalOpcionesAlbum');

	// Get the button that opens the modal
	var btn2 = document.getElementById("opcionesAlbum");

	// Get the <span> element that closes the modal
	var span2 = document.getElementsByClassName("close2")[0];

	// When the user clicks the button, open the modal 
	btn2.onclick = function () {
		modal2.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span2.onclick = function () {
		modal2.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function (event2) {
		if (event2.target == modal2) {
			modal2.style.display = "none";
		}
	}
	//----------------------------------------------------------------

}

function cerrarSesion() {

	location.href = "http://" + ip + "/PROYECTO/controlador/cerrarSesion.php";


}

function cambiarACrearAlbum() {
	this.style.display = "none";

	var texto = document.getElementById("nombreAlbum");

	texto.style.display = "block";

}

function cambiarAlMenuNormal() {

	//HACER INVISIBLE
	document.getElementById("nombreAlbum").style.display = "none"

	//HACER VISIBLE
	document.getElementById("crearAlbum").style.display = "block";

}

function crearAlbum() {

	//if(document.getElementById("textoNombreAlbum".value != "")){


	var nombreAlbum = document.getElementById("textoNombreAlbum").value;


	//Construimos objeto XMLHttpRequest
	peticion_http = new XMLHttpRequest();

	peticion_http.addEventListener("readystatechange", recargarNombresAlbums);


	peticion_http.open("GET", "http://" + ip + "/PROYECTO/controlador/controlador.php?nombreAlbum=" + nombreAlbum + "&accion=" + "crearAlbum");
	peticion_http.send();


	//}

}

function mensajeLogin() {
	if (this.readyState == 4 && this.status == 200) {
		var resultado = this.responseText;
		


	}

}

function encontrarIdAlbum() {

	var nombreAlbum = this.innerHTML;


	//Construimos objeto XMLHttpRequest
	peticion_http = new XMLHttpRequest();

	peticion_http.addEventListener("readystatechange", recargarAlbums);

	//alert(nombreAlbum);

	peticion_http.open("GET", "http://" + ip + "/PROYECTO/controlador/controlador.php?nombreAlbum=" + nombreAlbum + "&accion=" + "buscarIdAlbum");
	peticion_http.send();

}

function recargarAlbums() {
	if (this.readyState == 4 && this.status == 200) {
		location.href = "http://" + ip + "/PROYECTO/vista/paginaAlbums.php";

	}
}

function recargarNombresAlbums() {
	if (this.readyState == 4 && this.status == 200) {
		location.href = "http://" + ip + "/PROYECTO/vista/paginaAlbums.php";

	}

}



function cambiarNombreAlbum(){
    peticion_http = new XMLHttpRequest();

	peticion_http.addEventListener("readystatechange", afterCambiarNombreAlbum);
	
	var nuevoNombre = document.getElementById("nuevoNombre").value;


	peticion_http.open("GET", "http://" + ip + "/PROYECTO/controlador/controlador.php?nuevoNombre=" + nuevoNombre + "&accion=" + "cambiarNombreAlbum");
	peticion_http.send();
    
}

function afterCambiarNombreAlbum(){
    if (this.readyState == 4 && this.status == 200) {
		location.href = "http://" + ip + "/PROYECTO/vista/paginaAlbums.php";
	}
}



function borrarAlbum() {


	//Construimos objeto XMLHttpRequest
	peticion_http = new XMLHttpRequest();

	peticion_http.addEventListener("readystatechange", afterBorrarAlbum);


	peticion_http.open("GET", "http://" + ip + "/PROYECTO/controlador/controlador.php?accion=" + "borrarAlbum");
	peticion_http.send();

}

function afterBorrarAlbum() {
	if (this.readyState == 4 && this.status == 200) {
		location.href = "http://" + ip + "/PROYECTO/vista/index.php";
	}

}


function mostrarBotonBorrar() {

	var botones = document.getElementsByClassName("iconoImagenesCreadas");

	var iden = this.id + "boton";


	document.getElementById(iden).style.display = "block";

}


function ocultarBotonBorrar() {


	var botones = document.getElementsByClassName("iconoImagenesCreadas");

	for (var i = 0; i < botones.length; i++) {
		botones[i].style.display = "none";
		botones[i].style.left = "240px";
	}
}


function borrarImagen() {

	var imagen = this.id;

	//para quitar la palabra boton del id y quedarnos solo con la id de la imagen
	var identificador = imagen.slice(0, -5);

	//Construimos objeto XMLHttpRequest
	peticion_http = new XMLHttpRequest();

	peticion_http.addEventListener("readystatechange", afterBorrarImagen);


	peticion_http.open("GET", "http://" + ip + "/PROYECTO/controlador/controlador.php?idImagen=" + identificador + "&accion=" + "borrarImagen");
	peticion_http.send();

}

function afterBorrarImagen() {
	if (this.readyState == 4 && this.status == 200) {
		location.href = "http://" + ip + "/PROYECTO/vista/paginaAlbums.php";
	}
}