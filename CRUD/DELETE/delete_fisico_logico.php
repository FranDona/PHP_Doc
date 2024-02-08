<?php
require("funciones_delete.php");

// Conexión con la BBDD-------
$conexion = conectarBBDD();
//-----------------------------

// (Borrado FISICO)
if (isset($_REQUEST['fisico'])) {
    $resultado = borraradoFisico("nombre_tabla", $conexion, "clave_principal", $_REQUEST['clave_principal'], "s");
}

// (Borrado LOGICO)
if (isset($_REQUEST['logico'])) {
    $resultado = borradoLogico("nombre_tabla", $conexion, "clave_principal", $_REQUEST['clave_principal'], "s", "activo"); 
}



//Visualizar datos---------------------------------------
    $sql = "SELECT * FROM nombre_tabla";
    $sentPreparada = $conexion->prepare($sql);

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
                        <th class="text-light bg-info"></th>
                        <th class="text-light bg-info"></th>

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
                        
                    ?>

                        <td>
                            <form action="#" method="get">
                                <input type="hidden" name="matricula" value="<?php echo $registro['dato_clave'] ?>">
                                <input type="submit" value="Borrado Fisico" name="fisico">
                            </form>
                        </td>
                        <td>
                            <form action="#" method="get">
                                <input type="hidden" name="matricula" value="<?php echo $registro['dato_clave'] ?>">
                                <input type="submit" value="Borrado Lógico" name="logico">
                            </form>
                        </td>

                    <?php
                    }
                    ?> 
                </tbody>
            </table>
        </main>
    </body>
</html>


