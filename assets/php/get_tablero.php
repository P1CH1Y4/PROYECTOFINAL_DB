<?php
// Conexión a la base de datos
include 'conexion.php';

// Consulta SQL para obtener el promedio y nombre completo de cada alumno
$sql = "SELECT CONCAT(a.Nombre, ' ', a.Apellido) AS NombreCompleto, 
               AVG(n.Promedio_Acadenico) AS Promedio
        FROM Nota AS n
        JOIN Alumno AS a ON n.ID_Alumno = a.ID_Alumno
        GROUP BY a.Nombre, a.Apellido";

$stmt = sqlsrv_query($conn, $sql);

$data = [];
if ($stmt) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = $row;
    }
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Devolver los datos en formato JSON
echo json_encode($data);
?>
