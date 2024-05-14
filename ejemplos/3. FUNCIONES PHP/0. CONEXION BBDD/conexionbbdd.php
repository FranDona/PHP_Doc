<?php
// Conexión con la BBDD--------
$servidor = "localhost";
$usuario = "root";
$clave = "root";
$bbdd = "hyundauto";
$archivoSQL = "hyundauto.sql";
//------------------------------


// Objeto conexión-----------------------------------
$conexion = new mysqli($servidor, $usuario, $clave);
// Comprobamos la conexión
if ($conexion->connect_error) {
    die("Error de Conexión: " . $conexion->connect_error);
} else {
    $conexionCorrecta = "Conexión correcta";
}
?>