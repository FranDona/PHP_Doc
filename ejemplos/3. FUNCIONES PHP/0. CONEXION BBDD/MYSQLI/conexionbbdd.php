<?php

function conectarBBDD() 
{
    // Parametros de conexion
    $servidor = "localhost";
    $usuario = "root";
    $clave = "root";
    $bbdd = "nombreBBDD";

    // Objeto de conexión
    $conexion = new mysqli($servidor, $usuario, $clave, $bbdd);

    // Comprobamos la conexión
    if ($conexion->connect_error) {
        die("Error de Conexión: " . $conexion->connect_error);
    }

    return $conexion;
}


// Para conectar estas dos funciones se tendrá que:
// 1º Vincular el archivo de funciones usando:  include 'nombre_archivo_funciones.php';  o  require 'nombre_archivo_funciones.php';
// 2º Vincular la funcion usando: 

//$conexion = conectarBBDD();
//----------------------------------------------------------


//Verificacion de la conexion de BBDD

//if (verificar_conexion($conexion)) {
//    $conexionCorrecta = "Conexion correcta";
//} else {
//    $conexionCorrecta = "Error de Conexión";
//}
//----------------------------------------------------------

