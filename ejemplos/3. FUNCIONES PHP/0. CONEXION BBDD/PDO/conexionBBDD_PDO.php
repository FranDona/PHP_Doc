<?php
function conectarBBDD_PDO()
{
    $servidor = "localhost";
    $usuario = "root";
    $clave = "root";
    $bbdd = "nombreBBDD";

    try {
        // Objeto conexión PDO
        $conn = new PDO("mysql:host=$servidor;dbname=$bbdd", $usuario, $clave);
        // Configura PDO para que lance excepciones en caso de errores
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        // Captura cualquier excepción que ocurra durante la conexión
        die("Error de Conexión: " . $e->getMessage());
    }
} 


// Para conectar estas dos funciones se tendrá que:
// 1º Vincular el archivo de funciones usando:  include 'nombre_archivo_funciones.php';  o  require 'nombre_archivo_funciones.php';
// 2º Vincular la funcion usando: 

//$conexion = conectarBBDD_PDO();
//----------------------------------------------------------