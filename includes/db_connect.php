<?php

// CREDENCIALES LOCALHOST
define("HOST", "localhost"); 			// The host you want to connect to.
define("USER", "root"); 			// The database username.
define("PASSWORD", ""); 	// The database password.
define("DATABASE", "asignaturas");             // The database name.

// // CREDENCIALES HOSTINGER SIMULADOR.URL.PH
// define("HOST", "localhost"); 			// The host you want to connect to.
// define("USER", "u918487991_ramos"); 			// The database username.
// define("PASSWORD", "password"); 	// The database password.
// define("DATABASE", "u918487991_ramos");             // The database name.

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if ($mysqli->connect_error) {
	echo "No se pudo conectar a la base de datos";
	exit();
}