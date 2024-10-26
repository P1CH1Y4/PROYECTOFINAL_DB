<?php
// Conexión a la base de datos
include 'conexion.php';

// Variables para el mensaje de éxito o error
$mensaje = "";
$mensajeError = "";

// Obtener opciones de carrera, sección y rol
$carreras = [];
$sqlCarrera = "SELECT ID_Carrera, Nombre_Carrera FROM Carrera";
$queryCarrera = sqlsrv_query($conn, $sqlCarrera);
while ($row = sqlsrv_fetch_array($queryCarrera, SQLSRV_FETCH_ASSOC)) {
    $carreras[] = $row;
}

$secciones = [];
$sqlSeccion = "SELECT ID_Seccion, Nombre_Seccion FROM Seccion";
$querySeccion = sqlsrv_query($conn, $sqlSeccion);
while ($row = sqlsrv_fetch_array($querySeccion, SQLSRV_FETCH_ASSOC)) {
    $secciones[] = $row;
}

$roles = [];
$sqlRol = "SELECT ID_Rol, Rol FROM Rol";
$queryRol = sqlsrv_query($conn, $sqlRol);
while ($row = sqlsrv_fetch_array($queryRol, SQLSRV_FETCH_ASSOC)) {
    $roles[] = $row;
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $carrera = $_POST['carrera'];
    $seccion = $_POST['seccion'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $rol = $_POST['rol'];
    
    // Insertar en Usuario y obtener el ID generado usando OUTPUT INSERTED.ID_Usuario
    $sqlInsertUsuario = "INSERT INTO Usuario (Nombre_Usuario, Correo_Electronico, Password, Rol, Estado) 
                         OUTPUT INSERTED.ID_Usuario
                         VALUES (?, ?, ?, ?, 'activo')";
    $paramsUsuario = array($nombreUsuario, $correo, $password, $rol);
    $queryUsuario = sqlsrv_query($conn, $sqlInsertUsuario, $paramsUsuario);

    if ($queryUsuario && $rowUserId = sqlsrv_fetch_array($queryUsuario, SQLSRV_FETCH_ASSOC)) {
        $idUsuario = $rowUserId['ID_Usuario'];

        // Inserción en Alumno
        $sqlInsertAlumno = "INSERT INTO Alumno (Nombre, Apellido, Edad, Direccion, Telefono, ID_Usuario, ID_Carrera, ID_Seccion) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $paramsAlumno = array($nombre, $apellido, $edad, $direccion, $telefono, $idUsuario, $carrera, $seccion);
        $queryAlumno = sqlsrv_query($conn, $sqlInsertAlumno, $paramsAlumno);
        
        if ($queryAlumno) {
            $mensaje = "Alumno registrado exitosamente.";
        } else {
            $mensajeError = "Error al registrar al alumno: " . print_r(sqlsrv_errors(), true);
        }
    } else {
        $mensajeError = "Error: No se pudo obtener el ID del usuario recién creado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <h2>Registro de Usuario y Alumno</h2>
    <form method="POST">
        <div class="form-container">
            <div class="form-section">
                <h3>Datos del Alumno</h3>
                <label>Nombre:</label><br>
                <input type="text" name="nombre" required><br><br>

                <label>Apellido:</label><br>
                <input type="text" name="apellido" required><br><br>

                <label>Edad:</label><br>
                <input type="number" name="edad" required><br><br>

                <label>Dirección:</label><br>
                <input type="text" name="direccion" required><br><br>

                <label>Teléfono:</label><br>
                <input type="text" name="telefono" required><br><br>

                <label>Carrera:</label><br>
                <select name="carrera" required>
                    <?php foreach ($carreras as $carrera): ?>
                        <option value="<?php echo $carrera['ID_Carrera']; ?>"><?php echo $carrera['Nombre_Carrera']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <label>Sección:</label><br>
                <select name="seccion" required>
                    <?php foreach ($secciones as $seccion): ?>
                        <option value="<?php echo $seccion['ID_Seccion']; ?>"><?php echo $seccion['Nombre_Seccion']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>
            </div>

            <div class="form-section">
                <h3>Datos de Usuario</h3>
                <label>Nombre de Usuario:</label><br>
                <input type="text" name="nombreUsuario" required><br><br>

                <label>Correo Electrónico:</label><br>
                <input type="email" name="correo" required><br><br>

                <label>Contraseña:</label><br>
                <input type="password" name="password" required><br><br>

                <label>Rol:</label><br>
                <select name="rol" required>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?php echo $rol['Rol']; ?>"><?php echo $rol['Rol']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>
            </div>
        </div>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>


