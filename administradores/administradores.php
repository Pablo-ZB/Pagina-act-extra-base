<?php


session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['perfil'] !== 'Administrador') {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantalla de Administrador</title>
</head>
<body>
    <h1>Panel de Administrador</h1>
    <ul>
        <li><a href="gestionar_actividades/gestionar_actividades.php">Gestionar Actividades</a></li>
        <li><a href="gestionar_docentes/gestionar_docentes.php">Gestionar Docentes</a></li>
        <li><a href="gestionar_alumnos/gestionar_alumnos.php">Gestionar Alumnos</a></li>
        <li><a href="imprimir_reportes/reportes.php">Imprimir Reportes</a></li>
    </ul>
    
    <a href="cerrar_sesion.php">Cerrar sesión</a>
</body>
</html>
