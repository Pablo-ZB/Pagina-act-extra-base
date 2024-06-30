<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id']) && isset($_POST['horario1_dias']) && isset($_POST['horario1_hora']) && isset($_POST['horario2_dias']) && isset($_POST['horario2_hora']) && isset($_POST['sedes'])) {
        $idActividad = $_POST['id'];
        $horario1_dias = implode(", ", $_POST["horario1_dias"]);
        $horario1_hora = $_POST["horario1_hora"];
        $horario2_dias = implode(", ", $_POST["horario2_dias"]);
        $horario2_hora = $_POST["horario2_hora"];
        $sedes = $_POST["sedes"];

        include '../../conexion.php';

        $sql = "UPDATE actividades SET Horario1 = '$horario1_dias $horario1_hora', Horario2 = '$horario2_dias $horario2_hora', Sedes = '$Sedes' WHERE ID_Actividad = $idActividad";

        if ($conn->query($sql) === TRUE) {
            echo "Cambios guardados con éxito.";
            echo '<br><a href="gestionar_actividades.php">Volver</a>';
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
