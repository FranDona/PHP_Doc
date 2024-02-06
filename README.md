# ALL_PHP

[//]: # (version: 1.0)
[//]: # (author: Fran Dona Villar)
[//]: # (date: 2024-01-23)


- [ALL\_PHP](#all_php)
    - [Contenido del Repositorio](#contenido-del-repositorio)
  - [Estructura del Repositorio (por carpetas)](#estructura-del-repositorio-por-carpetas)
    - [LOG ERRORES](#log-errores)
    - [LOGIN](#login)
      - [CREDENCIALES UNICAS](#credenciales-unicas)
      - [GRUPO DE CREDENCIALES](#grupo-de-credenciales)
    - [CONEXION BBDD](#conexion-bbdd)
    - [CRUD](#crud)
      - [CREATE](#create)

### Contenido del Repositorio

- Repositorio para estructuras de php y archivos copy paste
  
---------

## Estructura del Repositorio (por carpetas)

### LOG ERRORES
- **errores.php:** Archivo para mostrar errores en pantalla, también generara un segundo archivo .log de esta manera será mas fácil detectar errores.
---
### LOGIN

#### CREDENCIALES UNICAS
- **login.php:** Login sencillo con unas credenciales ya establecidas
  
#### GRUPO DE CREDENCIALES
- **BBDD_login.php:** Login con unas credenciales establecidas en una base de datos externa
----
### CONEXION BBDD
 Conexión y verificación de la BBDD

- **conexionbbdd.php:** Contiene el código para una conexión y verificación sin archivo externo
-  **FUNCION_conexionbbdd.php:** Contiene el código para crear la conexión y verificación desde un archivo de funciones externo
----
### CRUD
#### CREATE
- **create.php:** Creacion de Create sin archivo externo
- **FUNCION_create.php:** Creacion de Create con archivo externo