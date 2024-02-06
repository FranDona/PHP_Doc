<?php
require("errores.php"); // Archivo para la visualizacion de errores (X)

//------------------------------------------------------------------------------------------------------------------------//
// Tratamos formulario: Cuando enviamos el formulario se encarga de comprar en la base de datos (previamente conectada)   //
// que las credenciales están correctas, en caso de que sean correctas te llevara a la pagina indicada, si no dará un error//
//------------------------------------------------------------------------------------------------------------------------//



if (isset($_POST['enviar'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    try {
        $conexion = new PDO($dsn, $usuario_bd, $contraseña_bd);
        // Establecer el modo de error de PDO a excepción
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit();
    }

    // Verificar las credenciales del usuario en la base de datos
    $consulta = "SELECT * FROM tabla_usuarios WHERE usuario = :usuario AND clave = :clave";
    $statement = $conexion->prepare($consulta);
    $statement->bindParam(':usuario', $usuario);
    $statement->bindParam(':clave', $clave);
    $statement->execute();

    $usuario_valido = $statement->fetch(PDO::FETCH_ASSOC);

    if ($usuario_valido) {
        // Las credenciales son válidas, iniciar sesión y redirigir
        $_SESSION['usuario'] = $usuario;
        header("Location: inicio.php");
        exit();
    } else {
        // Credenciales inválidas, mostrar mensaje de error
        $mensajesesion = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="css/hyundai-logo.ico" type="image/x-icon">
    <title>Login</title>
    <link rel="stylesheet" href="css/soloLogin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
<section class="login-container">
    <h2>Iniciar Sesión</h2>
    <?php if (isset($mensajesesion)) : ?>
        <p style="color: red;"><?php echo $mensajesesion; ?></p>
    <?php endif; ?>
    <form action="#" method="post" class="form">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" name="usuario" id="usuario" class="form-control">

        <label for="clave" class="form-label">Contraseña</label>
        <input type="password" name="clave" id="clave" class="form-control">

        <input type="submit" value="Iniciar Sesion" class="btn btn-primary mt-4 form-control" name="enviar">

        <!-- Mensaje de Inicio de sesion Incorrecto -->
        <p class="text-center"><?php echo isset($mensajesesion) ? $mensajesesion : ''; ?></p>
        <!-- -------------------------------------- -->
    </form>
</section>
</body>
</html>
