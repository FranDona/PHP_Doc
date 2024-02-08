<?php
// No es necesario copiar ya que esto ya deberia estar creado anteriormente
// Objeto conexión para que funcione $conexion en la sentencia preparada
$conexion = new mysqli($servidor, $usuario, $clave, $bbdd);
// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX



//Visualizar datos---------------------------------------
    $sql = "SELECT * FROM NOMBRE_TABLA";
    $sentPreparada = $conexion->prepare($sql); // $conexión se refiera a una conexión previamente hecha en otra función o en el mismo archivo


    // Verificar si la preparación de la sentencia fue exitosa
    if ($sentPreparada === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }


    $sentPreparada->execute();


    // Verificar si la ejecución de la sentencia fue exitosa
    if ($sentPreparada === false) {
        die("Error en la ejecución de la consulta: " . $sentPreparada->error);
    }


    $tabla = $sentPreparada->get_result();
    $registros = $tabla->fetch_all(MYSQLI_ASSOC);

//-----------------------------------------------------------------------

?>

<!DOCTYPE html>
<html lang="es">
                <!-- Zona de visualizacion de datos -->
            <table class="table text-center table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th class="text-light bg-info">DATO 1</th>
                        <th class="text-light bg-info">DATO 2</th>
                        <th class="text-light bg-info">DATO BOOLEANO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $tabla = $conexion->query($sql);
                    $registros = $tabla->fetch_all(MYSQLI_ASSOC);
                    foreach ($registros as $registro) {
                        echo "<tr>";
                        echo "<td>" . $registro['dato1'] . "</td>";
                        echo "<td>" . $registro['dato2'] . "</td>";
                        echo "<td>";
                        if ($registro['dato_booleano'] == 1) {
                            echo "Es verdadero"; 
                        } else {
                            echo "Es falso";
                        }
                        echo "</td>";
                        echo "<tr>";
                    }
                        
                    ?>
                </tbody>
            </table>
        </main>
    </body>
</html>
