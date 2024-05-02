<?php
//BORRADO LOGICO
function borradoLogico($nombreTabla, $conexion, $pk, $valorPK, $vinculo, $campo)
{
    $sql = "UPDATE $nombreTabla SET $campo = 0 WHERE $pk = ?";
    $sentPreparada = $conexion->prepare($sql);
    $sentPreparada->bind_param($vinculo, $valorPK);
    if ($sentPreparada->execute()) {
        return "Borrado Lógico correcto";
    } else {
        return "ERROR en el BORRADO";
    }
}


// BORRADO FISICO
function borraradoFisico($nombreTabla, $conexion, $pk, $valorPK, $vinculo)
{
    $sql = "DELETE FROM $nombreTabla WHERE $pk = ?";
    $sentPreparada = $conexion->prepare($sql);
    $sentPreparada->bind_param($vinculo, $valorPK);
    if ($sentPreparada->execute()) {
        return "Borrado Fisico correcto";
    } else {
        return "ERROR en el DELETE";
    }
}

