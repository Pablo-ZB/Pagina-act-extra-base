<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $matricula = $_POST["matricula"];
    $apellidoPaterno = $_POST["apellido_paterno"];
    $apellidoMaterno = $_POST["apellido_materno"];
    $nombre = $_POST["nombres"];
    $correoElectronico = $_POST["correo_electronico"];
    $carrera = $_POST["carrera"];
    $numeroGrupo = $_POST["numero_grupo"];
    $letraGrupo = $_POST["letra_grupo"];
    $grupo = $numeroGrupo . $letraGrupo;
    $actividad = $_POST["actividad"];
    $horarioElegido = $_POST["horario"];


    include '../conexion.php';

    $conn->begin_transaction();

    $sql_alumno = "INSERT INTO alumnos (Matricula, Nombre, Apellido_Paterno, Apellido_Materno, Carrera, Grupo, Actividad, Correo_Electronico, Horario)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt_alumno = $conn->prepare($sql_alumno)) {
        $stmt_alumno->bind_param("sssssssss", $matricula, $nombre, $apellidoPaterno, $apellidoMaterno, $carrera, $grupo, $actividad, $correoElectronico, $horarioElegido);

        if ($stmt_alumno->execute()) {

            $sql_inscritos = "SELECT Inscritos FROM actividades WHERE Nombre = ?";
            if ($stmt_inscritos = $conn->prepare($sql_inscritos)) {
                $stmt_inscritos->bind_param("s", $actividad);
                $stmt_inscritos->execute();
                $stmt_inscritos->bind_result($inscritos);
                $stmt_inscritos->fetch();
                $stmt_inscritos->close();
                
                $inscritos++;

                $sql_update = "UPDATE actividades SET Inscritos = ? WHERE Nombre = ?";
                if ($stmt_update = $conn->prepare($sql_update)) {
                    $stmt_update->bind_param("ss", $inscritos, $actividad);

                    if ($stmt_update->execute()) {
                        $conn->commit();
                        echo "Su registro ha sido exitoso.";
                        echo '<br><a href="alumnos.php">Volver</a>';
                    } else {
                        $conn->rollback(); 
                        echo "Error al actualizar el número de inscritos: " . $stmt_update->error;
                    }

                    $stmt_update->close();
                } else {
                    $conn->rollback(); 
                    echo "Error en la preparación de la sentencia UPDATE: " . $conn->error;
                }
            } else {
                $conn->rollback(); 
                echo "Error en la preparación de la sentencia SELECT: " . $conn->error;
            }
        } else {
            $conn->rollback();
            echo "Error al guardar los datos del alumno: " . $stmt_alumno->error;
        }

        $stmt_alumno->close();
    } else {
        $conn->rollback(); 
        echo "Error en la preparación de la sentencia INSERT: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Acceso no autorizado.";
}

?>
