<?php

function conectar_bd($servidor, $usuario, $clave, $bbdd) {
    $conexion = new mysqli($servidor, $usuario, $clave, $bbdd);
    if ($conexion->connect_error) {
        die("Error de Conexión: " . $conexion->connect_error);
    }
    return $conexion;
}

function verificar_conexion($conexion) {
    return $conexion->connect_errno === 0;
}


// Para conectar estas dos funciones se tendrá que:
// 1º Vincular el archivo de funciones usando:  include 'nombre_archivo_funciones.php';  o  require 'nombre_archivo_funciones.php';
// 2º Vincular la funcion usando: 

//Conexión de la BBDD

//$conexion = conectar_bd($servidor, $usuario, $clave, $bbdd);
//----------------------------------------------------------


//Verificacion de la conexion de BBDD

//if (verificar_conexion($conexion)) {
//    $conexionCorrecta = "Conexion correcta";
//} else {
//    $conexionCorrecta = "Error de Conexión";
//}
//----------------------------------------------------------


// Además tendremos que añadir los parámetros para para la conexión en el documento principal:

//$servidor = "localhost";
//$usuario = "root";
//$clave = "root";
//$bbdd = "nombrebbdd";
//$archivoSQL = "nombrebbdd.sql";

