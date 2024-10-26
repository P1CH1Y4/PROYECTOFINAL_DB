<?php
// Incluir el archivo de conexión para que la conexión esté activa
include 'assets/php/conexion.php';  // Asegúrate de que la ruta sea correcta

$message = "";

// Verificar si el formulario de inicio de sesión ha sido enviado
if (isset($_POST['login'])) {
    $usernameOrEmail = $_POST['username'];  // Puede ser nombre de usuario o correo
    $password = $_POST['password'];

    // Verificar si es un correo electrónico válido
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
        // Si es un correo, buscar por correo electrónico
        $sql = "SELECT * FROM Usuario WHERE Correo_Electronico = ? AND Password = ?";
    } else {
        // Si no es un correo, buscar por nombre de usuario
        $sql = "SELECT * FROM Usuario WHERE Nombre_Usuario = ? AND Password = ?";
    }

    $params = array($usernameOrEmail, $password);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Verificar si la consulta devuelve un registro
    if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        // Si usas contraseñas encriptadas, debes usar password_verify() en lugar de comparar directamente
        // if (password_verify($password, $row['Contrasena'])) {

        // El usuario y contraseña son correctos, iniciar sesión
        session_start();  // Iniciar la sesión si no está iniciada
        $_SESSION['username'] = $row['Nombre_Usuario'];  // Puedes guardar el nombre de usuario o correo en la sesión
        $_SESSION['correo'] = $row['Correo_Electronico']; 
        header("Location: SidebarMenu.php");  // Redirigir al dashboard
        exit();
    } else {
        // Si no coincide, mostrar mensaje de error
        $message = "Usuario o contraseña incorrectos.";
    }
}

// Cerramos el bloque PHP antes de iniciar el HTML
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMG</title>
    <link rel="icon" href="imagenes/book.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="background-blur"></div>
    <div class="login-container">

        <h2>LOGIN</h2>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Usuario o Correo" required><br>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <input type="submit" name="login" value="Ingresar">
            <p><?php echo htmlspecialchars($message); ?></p> <!-- Mostrar el mensaje de error de forma segura -->
        </form>
    </div>
</body>
</html>

