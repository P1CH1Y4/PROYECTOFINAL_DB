<?php
include 'conexion.php';

// Consultar los datos de la tabla
$sql = "SELECT ID_Asignatura, Nombre_Asignatura, ID_Carrera FROM Asignatura";
$stmt = sqlsrv_query($conn, $sql);

// Verificar si la consulta fue exitosa
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Construir la tabla HTML
echo "<table border='1'>
        <tr>
            <th>ID Asignatura</th>
            <th>Nombre de la Asignatura</th>
            <th>ID Carrera</th>
        </tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>
            <td>" . $row['ID_Asignatura'] . "</td>
            <td>" . $row['Nombre_Asignatura'] . "</td>
            <td>" . $row['ID_Carrera'] . "</td>
        </tr>";
}
echo "</table>";

?>