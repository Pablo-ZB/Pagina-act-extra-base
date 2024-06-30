<?php

include '../../conexion.php';

$nombre = $_POST["nombre"];
$tipo = $_POST["tipo"];
$horario1_dias = implode(", ", $_POST["horario1_dias"]);
$horario1_hora = $_POST["horario1_hora"];
$horario2_dias = implode(", ", $_POST["horario2_dias"]);
$horario2_hora = $_POST["horario2_hora"];
$sedes = $_POST["sedes"];

$sql = "INSERT INTO actividades (Nombre, Tipo, Horario1, Horario2, Sedes) VALUES ('$nombre', '$tipo', '$horario1_dias $horario1_hora', '$horario2_dias $horario2_hora', '$sedes')";

if ($conn->query($sql) === TRUE) {
    echo "La actividad se ha agregado correctamente.";
    echo '<br><a href="gestionar_actividades.php">Volver</a>';
} else {
    echo "Error al agregar la actividad: " . $conn->error;
}

$conn->close();
?>
