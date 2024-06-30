<?php
if (isset($_GET['id'])) {
    $idActividad = $_GET['id'];

    include '../../conexion.php';

    $sql = "SELECT * FROM actividades WHERE ID_Actividad = $idActividad";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
    } else {
        echo "No se encontró la actividad.";
    }

    $conn->close();
} else {
    echo "ID de actividad no proporcionado.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Actividad </title>
</head>
<body>
    <h1>Editar <?php echo $fila["Nombre"]; ?></h1>
    
    <form action="guardar_edicion.php" method="POST">
        <label>Horario1:</label><br>
            <input type="checkbox" id="lun1" name="horario1_dias[]" value="Lun">
            <label for="lun1">Lunes</label>
            <input type="checkbox" id="mar1" name="horario1_dias[]" value="Mar">
            <label for="mar1">Martes</label>
            <input type="checkbox" id="mie1" name="horario1_dias[]" value="Mie">
            <label for="mie1">Miércoles</label>
            <input type="checkbox" id="jue1" name="horario1_dias[]" value="Jue">
            <label for="jue1">Jueves</label>
            <input type="checkbox" id="vie1" name="horario1_dias[]" value="Vie">
            <label for="vie1">Viernes</label>
            <input type="checkbox" id="sab1" name="horario1_dias[]" value="Sab">
            <label for="sab1">Sábado</label>
            <input type="checkbox" id="dom1" name="horario1_dias[]" value="Dom">
            <label for="dom1">Domingo</label><br><br>

        <label for="horario1_hora"></label>
        <input type="time" id="horario1_hora" name="horario1_hora" required><br><br>

        <label>Horario2:</label><br>
            <input type="checkbox" id="lun2" name="horario2_dias[]" value="Lun">
            <label for="lun2">Lunes</label>
            <input type="checkbox" id="mar2" name="horario2_dias[]" value="Mar">
            <label for="mar2">Martes</label>
            <input type="checkbox" id="mie2" name="horario2_dias[]" value="Mie">
            <label for="mie2">Miércoles</label>
            <input type="checkbox" id="jue2" name="horario2_dias[]" value="Jue">
            <label for="jue2">Jueves</label>
            <input type="checkbox" id="vie2" name="horario2_dias[]" value="Vie">
            <label for="vie2">Viernes</label>
            <input type="checkbox" id="sab2" name="horario2_dias[]" value="Sab">
            <label for="sab2">Sábado</label>
            <input type="checkbox" id="dom2" name="horario2_dias[]" value="Dom">
            <label for="dom2">Domingo</label><br><br>

        <label for="horario2_hora"></label>
        <input type="time" id="horario2_hora" name="horario2_hora" required><br><br>

        <label for="sedes">Sedes:</label>
        <input type="text" name="sedes" value="<?php echo $fila["Sedes"]; ?>"><br>

        <input type="hidden" name="id" value="<?php echo $idActividad; ?>">

        <input type="submit" value="Guardar Cambios">
        
    </form>
    <br><a href="gestionar_actividades.php">Volver</a>
</body>
</html>

