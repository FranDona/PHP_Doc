<?php
ini_set('display_errors', 1); // Muestra los errores en la pantalla
ini_set('display_startup_errors', 1); // Muestra los errores de inicio
error_reporting(E_ALL); // Reporta todos los errores de PHP

ini_set('error_log', 'errores.log'); // Establece el archivo en el que se van a registrar los errores.
ini_set('log_errors', 1); // Habilita el registro de errores en el archivo especificado arriba


//-----------------------------------------------------------------------------------------------------
// Este archivo se colocara al principio del documento de la siguiente manera: require("errores.php");
//-----------------------------------------------------------------------------------------------------