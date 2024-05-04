# PHP_Doc

[//]: # (version: 2.0)
[//]: # (author: Fran Dona Villar)
[//]: # (date: 2024-01-23)


- [PHP\_Doc](#php_doc)
  - [¿Que es PHP?](#que-es-php)
  - [Instalación de PHP](#instalación-de-php)
  - [Estructura documentos PHP](#estructura-documentos-php)
    - [Incrustaciones](#incrustaciones)
    - [Archivos Únicos](#archivos-únicos)
    - [Vincular archivos PHP](#vincular-archivos-php)
  - [Log de Errores](#log-de-errores)
  - [CRUD](#crud)
    - [Create](#create)
    - [Read](#read)
      - [Consulta con JOIN](#consulta-con-join)
    - [Update](#update)
    - [Delete](#delete)
    - [Delete Lógico](#delete-lógico)
  - [Funciones PHP](#funciones-php)
    - [Conexión BBDD](#conexión-bbdd)
    - [Registro de Usuarios](#registro-de-usuarios)
    - [Login](#login)
    - [Sesiones](#sesiones)
    - [Fotos de Perfil](#fotos-de-perfil)
    - [Buscador en Streaming](#buscador-en-streaming)
    - [Contenido del Repositorio](#contenido-del-repositorio)
  - [Estructura del Repositorio (por carpetas)](#estructura-del-repositorio-por-carpetas)
    - [LOG ERRORES](#log-errores)
    - [LOGIN](#login-1)
      - [CREDENCIALES UNICAS](#credenciales-unicas)
      - [GRUPO DE CREDENCIALES](#grupo-de-credenciales)
    - [CONEXION BBDD](#conexion-bbdd)
    - [CRUD](#crud-1)
      - [CREATE](#create-1)
      - [DELETE](#delete-1)
      - [READ](#read-1)
      - [UPDATE](#update-1)

## ¿Que es PHP?
PHP es un lenguaje de programación web utilizado para crear sitios dinámicos y aplicaciones. Se ejecuta en el servidor y permite integrar código PHP con HTML para generar contenido personalizado. Su popularidad se debe a su facilidad de uso y a su gran comunidad de desarrolladores.

## Instalación de PHP

>[!NOTE]
Pruebas realizadas en Linux + Apache

```bash
sudo apt update
sudo apt -y install software-properties-common
sudo add-apt-repository ppa:ondrej/php
# Pulsamos ENTER

sudo apt update
sudo apt upgrade

sudo apt -y install php

# Revisamos la version
php -v

# Instalacion de depencencias mas usadas
sudo apt-get install php-pgsql
sudo apt-get install php-xsl
sudo apt-get install php-amqp
sudo apt-get install openssl
sudo apt-get install php-redis
```
<br>

>[!NOTE]
Pasos adicionales si usamos MongoDB

```bash
# Para instalar el Soporte MongoDB
# IMPORTANTE! Si no usamos MongoDB NO LO INSTALAES
sudo apt install php-dev php-pear
sudo pecl install mongodb
# Vemos el listado de librerias instaladas (incluidas las de arriba)
php -m

sudo nano /etc/php/8.2/cli/php.ini
# Dentro del archivo...
extension=mongodb.so
# CTRL + O (Guardar) y CTRL+X (salir)
sudo service apache2 restart
```
---- 

>[!NOTE]
Seguimos con la intalacion normal
```bash
# Instalamos CGI
sudo apt-get install php-cgi

sudo apt-get install php-fpm
# Hay que activar el FPM en el Apache
sudo a2enmod proxy_fcgi setenvif
sudo a2enconf php-fpm

sudo service apache2 restart


# Instalamos dependencias y nos lo bajamos
sudo apt update
sudo apt install curl php8.2-cli php8.2-mbstring git unzip

# Damos permisos al directorio de publicación
sudo chmod 777 -R /var/www/html 
```

## Estructura documentos PHP

### Incrustaciones

Podemos hacer incrustaciones de php en cualquier parte del documento según necesitemos.

```php
<?php
    echo "Podemos crear incrustaciones donde necesitemos usando <?php ?>";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Incrustaciones</title>
</head>
<body>
    <p>Hola Mundo!</p>
    <?php
    echo "De igual manera dentro del código, usando <?php ?>";
    ?>
</body>
</html>
```
[-> Enlace a Ejemplo <-](ejemplos/0.%20ESTRUCTURA/incrustaciones.php)

### Archivos Únicos

Estos archivos únicamente contienen contenido php, se utilizan para crear archivos de funciones concretas que se vinculan al archivo principal.
No es necesario usar la etiqueta de cierre **?>**

```php
<?php
    echo "Documento único php";

```
[-> Enlace a Ejemplo <-](ejemplos/0.%20ESTRUCTURA/archivo_unico.php)

### Vincular archivos PHP

Podemos usar diferentes tipos de vinculacion:

- **include**: Incluye un archivo. Si el archivo no se encuentra o hay un error, PHP solo emite una advertencia y continúa ejecutando el script.
  
- **require**: Similar a include pero si el archivo no se encuentra o hay un error, PHP emite un error fatal y detiene la ejecución del script.
  
-  **include_once**: Incluye el archivo solo una vez durante la ejecución del script, incluso si se llama varias veces.

-  **require_once**: Similar a include_once pero con el mismo comportamiento de require en caso de error.

```php
<?php 

include ('archivo.php');

require ('archivo.php');

include_once ('archivo.php');

require_once ('archivo.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vinculacion de Archivos</title>
</head>
<body>
    <p>Hola Mundo!</p>
</body>
</html>
```
[-> Enlace a Ejemplo <-](ejemplos/0.%20ESTRUCTURA/vincular_archivos.php)

## Log de Errores

Conocer los errores de nuestro código es muy importante en producción, por lo que vamos a crear un archivo que muestre todos nuestros errores.

1. Creamos archivo de errores
```php
<?php
ini_set('display_errors', 1); // Muestra los errores en la pantalla
ini_set('display_startup_errors', 1); // Muestra los errores de inicio
error_reporting(E_ALL); // Reporta todos los errores de PHP

ini_set('error_log', 'errores.log'); // Establece el archivo en el que se van a registrar los errores.
ini_set('log_errors', 1); // Habilita el registro de errores en el archivo especificado arriba
```
[-> Enlace a Ejemplo <-](ejemplos/1.%20LOG%20ERRORES/errores.php)

2. Vinculamos el archivo al documento que queramos revisar

```php
<?php 
  include "errores.php";
?>
```

----

## CRUD

Un CRUD es un acrónimo que significa "Create, Read, Update, Delete" (Crear, Leer, Actualizar, Borrar). Se refiere a las cuatro operaciones básicas que pueden ser realizadas sobre datos en un sistema de gestión de bases de datos o aplicaciones: crear nuevos registros, leer o consultar información existente, actualizar registros existentes y eliminar registros.

### Create
El create lo usaremos para añadir nuevos registros a una tabla
* Dentro del **$_REQUEST['']** colocaremos el nombre del input que usaremos en el formulario
* 
```php
if (isset($_REQUEST['añadir'])) {
    $dato1 = $_REQUEST['dato1'];
    $dato2 = $_REQUEST['dato2'];
    $dato3 =  $_REQUEST['dato3'];

    // Sentencia preparada
    $sql = "INSERT INTO NOMBRE_TABLA 
            (dato1, dato2, dato3)
            VALUES (?, ?, ?)"; // Usamos 0 o 1 si es booleano

    $stmt = $conexion->prepare($sql);

    $stmt->bind_param("sss", $dato1, $dato2, $dato3);
                    // Vinculo los parámetros
                    // - s -> char, varchar
                    // - i -> int, boolean
                    // - d -> decimal, flotante

    //Comprobacion de la consulta
    if ($stmt->execute()) {
        $registro = "Registro insertado correctamente";
    } else {
        $registro = "ERROR al añadir al cliente";
    }
    $stmt->close();
}
```
[-> Ejemplo Completo <-](ejemplos/2.%20CRUD/0.%20CREATE/create.php)
### Read
```php
// Definición de la consulta SQL para seleccionar todos los datos de una tabla llamada NOMBRE_TABLA
$sql = "SELECT * FROM NOMBRE_TABLA";

// Preparación de la consulta SQL utilizando el método prepare() de la conexión a la base de datos
$sentPreparada = $conexion->prepare($sql);

// Verificar si la preparación de la sentencia fue exitosa
if ($sentPreparada === false) {
    // Si la preparación falla, se muestra un mensaje de error con detalles obtenidos de la conexión
    die("Error en la preparación de la consulta: " . $conexion->error);
}

// Ejecución de la consulta preparada
$sentPreparada->execute();

// Verificar si la ejecución de la sentencia fue exitosa
if ($sentPreparada === false) {
    // Si la ejecución falla, se muestra un mensaje de error con detalles obtenidos de la consulta preparada
    die("Error en la ejecución de la consulta: " . $sentPreparada->error);
}

// Obtención de los resultados de la consulta en forma de tabla
$tabla = $sentPreparada->get_result();

// Obtención de todos los registros de la tabla en forma de arreglo asociativo
$registros = $tabla->fetch_all(MYSQLI_ASSOC);
```

[-> Ejemplo Completo <-](ejemplos/2.%20CRUD/1.%20READ/read.php)


Una vez esta creada la lógica de la consulta la mostramos en la parte del html de la siguiente manera

```php
<!DOCTYPE html>
<html lang="es">
            <!-- Zona de visualizacion de datos -->
    <table class="table text-center table-striped table-hover">
        <thead class="table-primary">
            <tr>
                <th> DATO 1 </th>
                <th> DATO 2 </th>
                <th> DATO BOOLEANO </th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Se realiza una consulta a la base de datos utilizando la variable $conexion y $sql
            $tabla = $conexion->query($sql);
            
            // Se obtienen todos los registros de la tabla en forma de arreglo asociativo
            $registros = $tabla->fetch_all(MYSQLI_ASSOC);
            
            // Se recorre cada registro y se imprime en filas de la tabla HTML
            foreach ($registros as $registro) {
                echo "<tr>";
                echo "<td>" . $registro['dato1'] . "</td>";
                echo "<td>" . $registro['dato2'] . "</td>";
                echo "<td>";
                // Se utiliza un operador ternario para imprimir "Verdadero" si dato_booleano es 1, de lo contrario "Falso"
                echo $registro['dato_booleano'] == 1 ? "Verdadero" : "Falso";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</html>
```
[-> Ejemplo Completo <-](ejemplos/2.%20CRUD/1.%20READ/read.php)

>[!NOTE]
> Los datos no solo se pueden mostrar en una tabla, se pueden representar de la manera que se quiera siempre y cuando cumpla el **foreach** para que se muestren todos los datos

#### Consulta con JOIN

Si queremos mostrar datos de dos tablas diferentes en el mismo lugar sera necesario hacer un **Consulta JOIN** en la cual se recogen los datos que queremos de cada tabla:

```sql
SELECT Tabla1.dato1, Tabla1.dato2, Tabla1.dato3, Tabla2.dato4 FROM Tabla1 
JOIN Tabla2  ON Tabla1.id = Tabla2.id_relacionado;
```

Esta consulta mostraría los datos 1,2,3 de la Tabla1 y el dato4 de la Tabla numero 2
### Update

### Delete

### Delete Lógico

----

## Funciones PHP

### Conexión BBDD

### Registro de Usuarios

### Login

### Sesiones

### Fotos de Perfil

### Buscador en Streaming



### Contenido del Repositorio

- Repositorio para estructuras de php y archivos copy paste
---------


## Estructura del Repositorio (por carpetas)

### LOG ERRORES
- 📄**errores.php:** Archivo para mostrar errores en pantalla, también generara un segundo archivo .log de esta manera será mas fácil detectar errores.
---


### LOGIN

#### CREDENCIALES UNICAS
- 📄**login.php:** Login sencillo con unas credenciales ya establecidas
  
#### GRUPO DE CREDENCIALES
- 📄**BBDD_login.php:** Login con unas credenciales establecidas en una base de datos externa
----


### CONEXION BBDD
 Conexión y verificación de la BBDD

- 📄**conexionbbdd.php:** Contiene el código para una conexión y verificación sin archivo externo
- 📄**FUNCION_conexionbbdd.php:** Contiene el código para crear la conexión y verificación desde un archivo de funciones externo
----


### CRUD

#### CREATE
- 📄**create.php:** Creación de Create sin archivo externo
- 📄**FUNCION_create.php:** Creación de Create con archivo externo
  
#### DELETE
- 📄**delete_fisico_logico.php:** Archivo con tabla para usar la función lógica y física
- 📄**funciones_delete:** Archivo de funciones para usar las funciones delete lógico y físico

#### READ
- 📄**read.php:** Estructura para visualizar los datos en una tabla, con nombres personalizados

#### UPDATE
- 

---
