<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Docentes</title>
</head>
<body>
    <h1>Gestionar Docentes</h1>
    
    <div>
        <a href="agregar_docente.php">Agregar</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Disciplina</th>
                <th>Perfil</th>
                <th>Usuario</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php

            include '../../conexion.php';

            $sql = "SELECT * FROM instructores";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["ID_Instructor"] . "</td>";
                    echo "<td>" . $fila["Nombre"] . "</td>";
                    echo "<td>" . $fila["Apellido_Paterno"] . "</td>";
                    echo "<td>" . $fila["Apellido_Materno"] . "</td>";
                    echo "<td>" . $fila["Disciplina"] . "</td>";
                    echo "<td>" . $fila["Perfil"] . "</td>";
                    echo "<td>" . $fila["Nombre_usuario"] . "</td>";
                    echo "<td><a href='editar_docente.php?id=" . $fila["ID_Instructor"] . "'>Editar</a> | <a href='#' onclick='confirmarEliminacion(" . $fila["ID_Instructor"] . ")'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "No se encontraron instructores.";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
    <br><a href="../administradores.php">Volver</a>
    <script>
        function confirmarEliminacion(idInstructor) {
            if (confirm("¿Estás seguro de que deseas eliminar este docente?")) {
                window.location.href = "eliminar_docente.php?id=" + idInstructor;
            }
        }
    </script>
</body>
</html>