<?php

//Formulario Añadir Clientes ------------------------------------------
if (isset($_REQUEST['añadir'])) {
    $dato1 = $_REQUEST['dato1'];
    $dato2 = $_REQUEST['dato2'];
    $dato3 =  $_REQUEST['dato3'];

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
}
//--------------------------------------------------------------------


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>CRUD - Create</title>
</head>
    <body>
    <article>
        <?php 
        if (isset($_REQUEST['añadir'])) {
                        echo $registro;
                    }
        ?>
            <form action="#" method="post" class="form">
                <fieldset class="w-75 p-3">

                <!-- DATO 1 -->
                    <label for="dato1" class="form-label">Dato 1</label>
                    <input type="text" name="dato1" id="dato1" class="form-control" require><br>

                <!-- DATO 2 -->
                    <label for="dato2" class="form-label">Dato 2</label>
                    <input type="text" name="dato2" id="dato2" class="form-control" require><br>

                <!-- DATO 3 -->
                    <label for="dato3" class="form-label">Dato 3</label>
                    <input type="text" name="dato3" id="dato3" class="form-control" require><br>

                <!-- ENVIO -->
                    <input type="submit" value="Añadir" class="btn btn-primary form-control" name="añadir"><br>

                </fieldset>
            </form>
        </article>
    </body>
</html>
