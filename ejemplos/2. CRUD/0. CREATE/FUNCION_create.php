<?php
function añadirCliente($conexion, $dato1, $dato2, $dato3) {
    // Sentencia preparada
    $sql = "INSERT INTO NOMBRE_TABLA 
            (dato1, dato2, dato3)
            VALUES (?, ?, ?)";
            // En caso de booleano con dato por defecto usamos 1 o 0

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

    return $registro;
}

// Para conectar esta funcion se tendra que:
// 1º Vincular el archivo de funciones usando:  include 'nombre_archivo_funciones.php';  o  require 'nombre_archivo_funciones.php';
// 2º Vincular la funcion usando: 

// $resultado = añadirCliente($conexion, $dato1, $dato2, $dato3);

