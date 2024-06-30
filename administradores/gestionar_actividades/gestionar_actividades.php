<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Actividades</title>
</head>
<body>
    <h1>Gestionar Actividades</h1>
    
    <div>
        <a href="agregar_actividad.html">Agregar</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Horario1</th>
                <th>Horario2</th>
                <th>Sedes</th>
                <th>Inscritos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            include '../../conexion.php';

            $sql = "SELECT * FROM actividades";
            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["ID_Actividad"] . "</td>";
                    echo "<td>" . $fila["Nombre"] . "</td>";
                    echo "<td>" . $fila["Tipo"] . "</td>";
                    echo "<td>" . $fila["Horario1"] . "</td>";
                    echo "<td>" . $fila["Horario2"] . "</td>";
                    echo "<td>" . $fila["Sedes"] . "</td>";
                    echo "<td>" . $fila["Inscritos"] . "</td>";
                    echo "<td>";
                    echo "<a href='editar_actividad.php?id=" . $fila["ID_Actividad"] . "'>Editar</a> | ";
                    echo "<a href='#' onclick='confirmarEliminacion(" . $fila["ID_Actividad"] . ")'>Eliminar</a> | ";
                    echo "<button class='ver-inscritos' data-nombre='" . $fila["Nombre"] . "'>Ver Inscritos</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "No se encontraron actividades.";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <div id="inscritos-container">
    <!-- Aquí se mostrará la lista de inscritos -->
    </div>

    <br><a href="../administradores.php">Volver</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function confirmarEliminacion(idActividad) {
            if (confirm("¿Estás seguro de que deseas eliminar esta actividad?")) {
                window.location.href = "eliminar_actividad.php?id=" + idActividad;
            }
        }

        $(document).ready(function() {
        $(".ver-inscritos").click(function() {
            var actividadNombre = $(this).data("nombre");

            // Enviar una solicitud AJAX para obtener la lista de inscritos
            $.ajax({
                url: "obtener_inscritos.php", // Reemplaza con la URL correcta
                type: "GET",
                data: { actividad_nombre: actividadNombre },
                success: function(response) {
                    // Mostrar la lista de inscritos en el contenedor
                    $("#inscritos-container").html(response);
                },
                error: function() {
                    alert("Error al cargar la lista de inscritos.");
                }
            });
        });
    });
    
    </script>
</body>
</html>
