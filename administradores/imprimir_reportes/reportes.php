<!DOCTYPE html>
<html>
<head>
    <title>Imprimir Reportes</title>
</head>
<body>
    <table>
    <thead>
            <tr>
                <th>Docente</th>
                <th>Actividad</th>
            </tr>
        </thead>
        <tbody>
    <h1></h1>
    <ul>
        <?php
        
        include '../../conexion.php';

        $sql = "SELECT * FROM instructores WHERE Perfil = 'Instructor'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nombre_completo = $row['Nombre'] . ' ' . $row['Apellido_Paterno'] . ' ' . $row['Apellido_Materno'];
                echo "<tr>";
                echo '<td><a href="procesar_seleccion.php?docente=' . urlencode($row['Nombre']) . '">' . $nombre_completo . '</a></td>';
                echo "<td>" . $row["Disciplina"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "No se encontraron actividades en la base de datos.";
        }

        $conn->close();
        ?>
    </ul>
    </tbody>
    </table>
    <br><a href="../administradores.php">Volver</a>

</body>
</html>
