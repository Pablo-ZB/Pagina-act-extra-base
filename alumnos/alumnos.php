<!DOCTYPE html>
<html>
<head>
    <title>Selecciona una actividad</title>
</head>
<body>
    <h1>Selecciona una actividad:</h1>
    <ul>
        <?php
        
        include '../conexion.php';

        if ($conn->connect_error) {
            die("Error en la conexi�n a la base de datos: " . $conn->connect_error);
        }

        $sql = "SELECT nombre FROM actividades WHERE inscritos < 50";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li><a href="procesar_seleccion.php?actividad=' . $row['nombre'] . '">' . $row['nombre'] . '</a></li>';
            }
        } else {
            echo "No se encontraron actividades en la base de datos.";
        }

        $conn->close();
        ?>
    </ul>

</body>
</html>
