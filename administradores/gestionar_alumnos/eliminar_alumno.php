<?php
if (isset($_GET['id'])) {
    $idAlumno = $_GET['id'];

    include '../../conexion.php';

    $sql_get_actividad = "SELECT Actividad FROM alumnos WHERE Matricula = $idAlumno";
    $resultado_actividad = $conn->query($sql_get_actividad);

    if ($resultado_actividad->num_rows == 1) {
        $fila_actividad = $resultado_actividad->fetch_assoc();
        $actividad = $fila_actividad['Actividad'];

        $sql_actualizar_actividad = "UPDATE actividades SET inscritos = inscritos - 1 WHERE Nombre = '$actividad'";
        if ($conn->query($sql_actualizar_actividad) === TRUE) {
            $sql_eliminar_alumno = "DELETE FROM alumnos WHERE Matricula = $idAlumno";
            if ($conn->query($sql_eliminar_alumno) === TRUE) {
                echo "Alumno eliminado con éxito.";
                echo '<br><a href="gestionar_alumnos.php">Volver</a>';
            } else {
                echo "Error al eliminar el alumno: " . $conn->error;
            }
        } else {
            echo "Error al actualizar la actividad: " . $conn->error;
        }
    } else {
        echo "No se encontró la actividad del alumno.";
    }

    $conn->close();
} else {
    echo "ID de alumno no proporcionado.";
}
?>
