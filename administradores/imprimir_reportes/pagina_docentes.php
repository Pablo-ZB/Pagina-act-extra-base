<?php

session_start();

if (isset($_SESSION["docente"])) {
    $docente = $_SESSION["docente"]; 


    include '../../conexion.php';


$sql_docentes = "SELECT * FROM instructores WHERE Nombre = '$docente'";
$resultado_docentes = $conn->query($sql_docentes);

if ($resultado_docentes) {
    $fila_docente = $resultado_docentes->fetch_assoc();
    $act_docente = $fila_docente['Disciplina'];
    $nombre_completo = $fila_docente['Nombre'] . ' ' . $fila_docente['Apellido_Paterno'] . ' ' . $fila_docente['Apellido_Materno'];
} else {
    echo "Error al obtener la disciplina del docente.";
}





$sql_actividades = "SELECT * FROM actividades WHERE Nombre = '$act_docente'";
$resultado_actividades = $conn->query($sql_actividades);

$sql_alumnos = "SELECT * FROM alumnos WHERE Actividad = '$act_docente'";
$resultado_alumnos = $conn->query($sql_alumnos);

} else {
    echo "Error: No se proporcionó el parámetro 'docente' en la sesión.";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Página de Docentes</title>
    <style>
        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="top-right">
        <a href="generar_pdf.php" target="_blank">Guardar en PDF</a>
        <a href="generar_excel.php">Guardar en Excel</a>
    </div>
    <h1>Reporte de <?php echo $nombre_completo; ?></h1>

    <h2>Datos_Actividad:</h2>
    <table border="1">
    <thead>
        <tr>
            <th>Actividad</th>
            <th>Horario1</th>
            <th>Horario2</th>
            <th>Sedes</th>
            <th>Inscritos</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $resultado_actividades->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['Nombre']; ?></td>
                <td><?php echo $row['Horario1']; ?></td>
                <td><?php echo $row['Horario2']; ?></td>
                <td><?php echo $row['Sedes']; ?></td>
                <td><?php echo $row['Inscritos']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>


    <h2>Alumnos:</h2>
    <table border="1">
    <thead>
        <tr>
            <th>Matricula</th>
            <th>Nombre</th>
            <th>Carrera</th>
            <th>Grupo</th>
            <th>Correo Electronico</th>
            <th>Horario</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $resultado_alumnos->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['Matricula']; ?></td>
                <td><?php echo $row['Nombre'] . ' ' . $row['Apellido_Paterno'] . ' ' . $row['Apellido_Materno']; ?></td>
                <td><?php echo $row['Carrera']; ?></td>
                <td><?php echo $row['Grupo']; ?></td>
                <td><?php echo $row['Correo_Electronico']; ?></td>
                <td><?php echo $row['Horario']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<a href="reportes.php">Volver</a>
</body>
</html>
        
<?php
$conn->close();
?>
