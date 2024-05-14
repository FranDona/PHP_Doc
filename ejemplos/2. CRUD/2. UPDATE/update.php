<?php
// LÓGICA UPDATE ---------------------------------------
if (isset($_POST['actualizar'])) {
    $datoUnico = $_POST['datoUnico'];
    $dato1 = $_POST['dato1'];
    $dato2 = $_POST['dato2'];
    $dato3 = $_POST['dato3'];

    $sqlUpdate = "UPDATE NOMBRE_TABLA 
                  SET dato1=?, 
                      dato2=?,
                      dato3=?
                  WHERE datoUnico=?";

    $sentenciaSQL = $conexion->prepare($sqlUpdate);
    $sentenciaSQL->bind_param("ssss", $dato1, $dato2, $dato3, $datoUnico);

    if ($sentenciaSQL->execute()) {
        $resultado .= "<br> Registro actualizado correctamente";
    } else {
        $resultado .= "<br> ERROR en la actualización";
    }
}
?>
//-----------------------------------------------------------------------

<!DOCTYPE html>
<html lang="es">
    <body>
        <h2>Formulario de Actualización</h2>
        <form action="tu_script_php.php" method="POST">
            <label for="datoUnico">Dato Único:</label>
            <input type="text" name="datoUnico" id="datoUnico" disabled="disabled">

            <label for="dato1">Dato 1:</label>
            <input type="text" name="dato1" id="dato1" required>

            <label for="dato2">Dato 2:</label>
            <input type="text" name="dato2" id="dato2" required>

            <label for="dato3">Dato 3:</label>
            <input type="text" name="dato3" id="dato3" required>

            <input type="submit" name="actualizar" value="Actualizar">
        </form>
    </body>
</html>
