document.addEventListener("DOMContentLoaded", cargar, false);


var ip = window.location.host;

var arrayRegistro = [];
var arrayLogin = [];
var botonRegistro;
var botonLogin;

function cargar() {
	document.getElementById("botonCambiarRegistro").addEventListener("click", cambiarARegistro);
	document.getElementById("botonCambiarLogin").addEventListener("click", cambiarALogin);

	var vector = document.getElementsByClassName("contenedorRegistro");

	for (var i = 0; i < vector.length; i++) {
		vector[i].addEventListener("focusout", cambiarColor);

	}


	//PARTE PHP

	document.getElementById("botonRegistrarse").addEventListener("click", crearUsuario);
	document.getElementById("botonLogin").addEventListener("click", iniciarSesion);


}

function cambiarColor() {
	if (this.value == "") {
		this.style.color = "red";
	} else {
		this.style.color = "black";
	}

}

function cambiarARegistro() {

	arrayLogin = document.getElementsByClassName("apartadoLogin");

	for (var i = 0; i < arrayLogin.length; i++) {
		arrayLogin[i].style.display = "none";

	}

	arrayRegistro = document.getElementsByClassName("apartadoRegistrarse");

	for (var i = 0; i < arrayRegistro.length; i++) {
		arrayRegistro[i].style.display = "block";
	}
}

function cambiarALogin() {

	arrayLogin = document.getElementsByClassName("apartadoLogin");

	for (var i = 0; i < arrayLogin.length; i++) {
		arrayLogin[i].style.display = "block";

	}

	arrayRegistro = document.getElementsByClassName("apartadoRegistrarse");

	for (var i = 0; i < arrayRegistro.length; i++) {
		arrayRegistro[i].style.display = "none";
	}
}

function crearUsuario() {


	var nombre = document.getElementById("nombre").value;
	var password = document.getElementById("pass").value;
	var correo = document.getElementById("correo").value;

	var password2 = document.getElementById("repetir").value;


	if ((nombre == "") || (password == "") || (correo == "") || (password2 == "")) {

	} else {

		if (password == password2) {


			//Construimos objeto XMLHttpRequest
			peticion_http = new XMLHttpRequest();

			peticion_http.addEventListener("readystatechange", mensajeRegistro);

			//peticion_http.open("GET", "http://" + ip + ":8080/PROYECTO/crearUsuario.php?nombre=" + nombre + "&password=" + password + "&correo=" + correo );
			peticion_http.open("GET", "http://" + ip + "/PROYECTO/controlador/controlador.php?nombre=" + nombre + "&password=" + password + "&correo=" + correo + "&accion=" + "crearUsuario");
			peticion_http.send();

		} else {
			alert("Las contraseñas no coinciden");
		}
	}
}


function mensajeRegistro() {
	if (this.readyState == 4 && this.status == 200) {
		var resultado = this.responseText;
		//alert(resultado);
		if (resultado == 0) {
			alert("Te has registrado con exito");

			//pasar a la pagina principal despues del registro
			location.href = "http://" + ip + "/PROYECTO/vista/index.php";

		}
		if (resultado == 1) {
			alert("Ese correo ya está siendo usado");
		}
		if (resultado == 2) {
			alert("El nombre ya está siendo usado")
		}

	}
}

function iniciarSesion() {

	var password = document.getElementById("passSesion").value;
	var correo = document.getElementById("correoSesion").value;

	//Construimos objeto XMLHttpRequest
	peticion_http = new XMLHttpRequest();


	peticion_http.addEventListener("readystatechange", mensajeLogin);

	peticion_http.open("GET", "http://" + ip + "/PROYECTO/controlador/controlador.php?correo=" + correo + "&password=" + password + "&accion=" + "iniciarSesion");
	peticion_http.send();

}

function mensajeLogin() {
	if (this.readyState == 4 && this.status == 200) {
		var resultado = this.responseText;
		//alert(resultado);
		if (resultado == 1) {
			location.href = "http://" + ip + "/PROYECTO/vista/index.php";
		} else {
			alert("El correo y/o la contraseña no son válidos");
		}

	}


}