<?php
include 'conexion.php';

// Consultar los datos de la tabla
$sql = "SELECT ID_Carrera, Nombre_Carrera, ID_Profesor FROM Carrera";
$stmt = sqlsrv_query($conn, $sql);

// Verificar si la consulta fue exitosa
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Construir la tabla HTML
echo "<table border='1'>
        <tr>
            <th>ID Carreras</th>
            <th>Nombre de la Carrera</th>
            <th>ID Profesor</th>
        </tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>
            <td>" . $row['ID_Carrera'] . "</td>
            <td>" . $row['Nombre_Carrera'] . "</td>
            <td>" . $row['ID_Profesor'] . "</td>
        </tr>";
}
echo "</table>";

?>