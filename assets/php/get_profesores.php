<?php
include 'conexion.php';

// Consultar los datos de la tabla
$sql = "SELECT ID_Profesor, Nombre, Apellido, Telefono, Correo, ID_Usuario FROM Profesor";
$stmt = sqlsrv_query($conn, $sql);

// Verificar si la consulta fue exitosa
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Construir la tabla HTML
echo "<table border='1'>
        <tr>
            <th>ID Profesor</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>ID Usuario</th>
        </tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>
            <td>" . $row['ID_Profesor'] . "</td>
            <td>" . $row['Nombre'] . "</td>
            <td>" . $row['Apellido'] . "</td>
            <td>" . $row['Telefono'] . "</td>
            <td>" . $row['ID_Usuario'] . "</td>
        </tr>";
}
echo "</table>";

?>
