<?php
include 'conexion.php';

// Consultar los datos de la tabla Alumno
$sql = "SELECT ID_Alumno, Nombre, Apellido, Edad, Direccion, Telefono, ID_Usuario, ID_Carrera, ID_Seccion FROM Alumno";
$stmt = sqlsrv_query($conn, $sql);

// Verificar si la consulta fue exitosa
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Construir la tabla HTML
echo "<table border='1'>
        <tr>
            <th>ID Alumno</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Edad</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>ID Usuario</th>
            <th>ID Carrera</th>
            <th>ID Sección</th>
        </tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>
            <td>" . $row['ID_Alumno'] . "</td>
            <td>" . $row['Nombre'] . "</td>
            <td>" . $row['Apellido'] . "</td>
            <td>" . $row['Edad'] . "</td>
            <td>" . $row['Direccion'] . "</td>
            <td>" . $row['Telefono'] . "</td>
            <td>" . $row['ID_Usuario'] . "</td>
            <td>" . $row['ID_Carrera'] . "</td>
            <td>" . $row['ID_Seccion'] . "</td>
        </tr>";
}
echo "</table>";
?>
