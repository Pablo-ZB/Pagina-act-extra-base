<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Alumnos</title>
</head>
<body>
    <h1>Gestionar Alumnos</h1>

    <table>
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Carrera</th>
                <th>Grupo</th>
                <th>Actividad</th>
                <th>Correo_Electronico</th>
                <th>Horario</th>
                <th></th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            
            include '../../conexion.php';

            $sql = "SELECT * FROM alumnos";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["Matricula"] . "</td>";
                    echo "<td>" . $fila["Nombre"] . "</td>";
                    echo "<td>" . $fila["Apellido_Paterno"] . "</td>";
                    echo "<td>" . $fila["Apellido_Materno"] . "</td>";
                    echo "<td>" . $fila["Carrera"] . "</td>";
                    echo "<td>" . $fila["Grupo"] . "</td>";
                    echo "<td>" . $fila["Actividad"] . "</td>";
                    echo "<td>" . $fila["Correo_Electronico"] . "</td>";
                    echo "<td>" . $fila["Horario"] . "</td>";
                    echo "<td><a href='editar_alumno.php?id=" . $fila["Matricula"] . "'>Editar</a> | <a href='#' onclick='confirmarEliminacion(" . $fila["Matricula"] . ")'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "No se encontraron alumnos.";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
    <br><a href="../administradores.php">Volver</a>
    <script>
        function confirmarEliminacion(idAlumno) {
            if (confirm("¿Estás seguro de que deseas eliminar este alumno?")) {
                window.location.href = "eliminar_alumno.php?id=" + idAlumno;
            }
        }
    </script>
</body>
</html>