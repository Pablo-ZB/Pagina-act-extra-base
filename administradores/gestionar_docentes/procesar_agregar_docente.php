<?php

include '../../conexion.php';

$nombre = $_POST["nombre"];
$apellidoPaterno = $_POST["apellido_paterno"];
$apellidoMaterno = $_POST["apellido_materno"];
$perfil = $_POST["perfil"];
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];

$disciplina = "";
if ($perfil !== "Administrador") {
    $disciplina = $_POST["disciplina"];
}

$hash_contraseña = password_hash($contrasena, PASSWORD_DEFAULT);

$sql = "INSERT INTO instructores (Nombre, Apellido_Paterno, Apellido_Materno, Disciplina, Perfil, Nombre_usuario, Contrasena) VALUES ('$nombre', '$apellidoPaterno' , '$apellidoMaterno', '$disciplina', '$perfil','$nombre_usuario', '$hash_contraseña')";

if ($conn->query($sql) === TRUE) {
    echo "Se ha agregado correctamente.";
    echo '<br><a href="gestionar_docentes.php">Volver</a>';
} else {
    echo "Error al agregar la actividad: " . $conn->error;
}

$conn->close();
?>
