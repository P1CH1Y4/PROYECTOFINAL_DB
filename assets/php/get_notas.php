<?php
include 'conexion.php';

// Consultar los datos de la tabla
$sql = "SELECT ID_Nota, Promedio_Acadenico, ID_Alumno, ID_Asignatura FROM Nota";
$stmt = sqlsrv_query($conn, $sql);

// Verificar si la consulta fue exitosa
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Construir la tabla HTML
echo "<table border='1'>
        <tr>
            <th>ID Nota</th>
            <th>Promedio Academico </th>
            <th>ID Alumno</th>
            <th>ID Asignatura</th>
        </tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>
            <td>" . $row['ID_Nota'] . "</td>
            <td>" . $row['Promedio_Acadenico'] . "</td>
            <td>" . $row['ID_Alumno'] . "</td>
            <td>" . $row['ID_Asignatura'] . "</td>
        </tr>";
}
echo "</table>";

?>