document.addEventListener("DOMContentLoaded", cargar, false);


var ip = window.location.host;

var arrayRegistro = [];
var arrayLogin = [];
var botonRegistro;
var botonLogin;

function cargar() {

	//LOGOUT

	document.getElementById("cerrarSesion").addEventListener("click", cerrarSesion);

	//CAMBIAR A CREAR ALBUM
	document.getElementById("crearAlbum").addEventListener("click", cambiarACrearAlbum);

	//VOLVER A CAMBIAR AL MENU ANTERIOR
	document.getElementById("botonCancelarAlbum").addEventListener("click", cambiarAlMenuNormal);


	//CREAR NUEVO ALBUM
	document.getElementById("botonCrearAlbum").addEventListener("click", crearAlbum);


	//ENCONTRAR LA ID DE LOS ALBUMS AL HACER CLICK

	var albums = document.getElementsByClassName("albumsAutoCreados");

	for (var i = 0; i < albums.length; i++) {
		albums[i].addEventListener('click', encontrarIdAlbum);
	}


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
		alert(resultado);


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