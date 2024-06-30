<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido_paterno']) && isset($_POST['apellido_materno'])  && isset($_POST['carrera'])  && isset($_POST['grupo'])  && isset($_POST['actividad'])  && isset($_POST['correo_electronico'])  && isset($_POST['horario'])) {
        $idAlumno = $_POST['id'];
        $nuevoNombre = $_POST['nombre'];
        $nuevoApellidoP = $_POST['apellido_paterno'];
        $nuevoApellidoM = $_POST['apellido_materno'];
        $nuevaCarrera = $_POST['carrera'];
        $nuevoGrupo = $_POST['grupo'];
        $nuevaActividad = $_POST['actividad'];
        $nuevoCorreo = $_POST['correo_electronico'];
        $nuevoHorario = $_POST['horario'];

        include '../../conexion.php';

        $sql = "UPDATE alumnos SET  Nombre = '$nuevoNombre', Apellido_Paterno = '$nuevoApellidoP', Apellido_Materno = '$nuevoApellidoM', Carrera = '$nuevaCarrera', Grupo = '$nuevoGrupo', Actividad = '$nuevaActividad', Correo_Electronico = '$nuevoCorreo', Horario = '$nuevoHorario' WHERE Matricula = $idAlumno";

        $sqlActividadAnterior = "SELECT Actividad FROM alumnos WHERE Matricula = $idAlumno";
        $resultadoActividadAnterior = $conn->query($sqlActividadAnterior);
        $filaActividadAnterior = $resultadoActividadAnterior->fetch_assoc();

        if ($filaActividadAnterior) {
            $actividadAnterior = $filaActividadAnterior["Actividad"];
    
            // Decrementa en 1 el contador de inscritos en la actividad anterior
            $sqlDecrementar = "UPDATE actividades SET inscritos = inscritos - 1 WHERE nombre = '$actividadAnterior'";
            $conn->query($sqlDecrementar);
    
            // Incrementa en 1 el contador de inscritos en la nueva actividad
            $sqlIncrementar = "UPDATE actividades SET inscritos = inscritos + 1 WHERE nombre = '$nuevaActividad'";
            $conn->query($sqlIncrementar);
    
        } else {
            echo "Error al obtener la actividad anterior del alumno.";
        }


        if ($conn->query($sql) === TRUE) {
            echo "Cambios guardados con exito.";
            echo '<br><a href="gestionar_alumnos.php">Volver</a>';
        } else {
            echo "Error al guardar los cambios: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Datos incompletos.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
