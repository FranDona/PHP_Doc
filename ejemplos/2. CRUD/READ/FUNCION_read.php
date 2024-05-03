<?php

// No es necesario copiar ya que esto ya deberia estar creado anteriormente
// Objeto conexión para que funcione $conexion en la sentencia preparada
$conexion = new mysqli($servidor, $usuario, $clave, $bbdd, $sentPreparada);
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

function mostrarDatos($conexion)
{
    $sql = "SELECT * FROM NOMBRE_TABLA";
    $sentPreparada = $conexion->prepare($sql);

    if ($sentPreparada === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $sentPreparada->execute();

    if ($sentPreparada === false) {
        die("Error en la ejecución de la consulta: " . $sentPreparada->error);
    }

    $tabla = $sentPreparada->get_result();
    $registros = $tabla->fetch_all(MYSQLI_ASSOC);

    echo "<table class='table text-center table-striped table-hover'>";
    echo "<thead class='table-primary'>";
    echo "<tr>";
    echo "<th class='text-light bg-info'>DATO 1</th>";
    echo "<th class='text-light bg-info'>DATO 2</th>";
    echo "<th class='text-light bg-info'>DATO BOOLEANO</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    foreach ($registros as $registro) {
        echo "<tr>";
        echo "<td>" . $registro['dato1'] . "</td>";
        echo "<td>" . $registro['dato2'] . "</td>";
        echo "<td>";
        echo $registro['dato_booleano'] == 1 ? "Es verdadero" : "Es falso";
        echo "</td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
}

?>




