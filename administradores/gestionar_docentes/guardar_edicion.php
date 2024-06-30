<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido_paterno']) && isset($_POST['apellido_materno']) && isset($_POST['disciplina']) && isset($_POST['perfil']) && isset($_POST['usuario']) && isset($_POST['contrasena'])) {
        $idInstructor = $_POST['id'];
        $nuevoNombre = $_POST['nombre'];
        $nuevoApellidoP = $_POST['apellido_paterno'];
        $nuevoApellidoM = $_POST['apellido_materno'];
        $nuevoPerfil = $_POST['perfil'];
        $nuevoUsuario = $_POST['usuario'];
        $nuevaContraseña = $_POST['contrasena'];



        $nuevaDisciplina = "";
        if ($nuevoPerfil !== "Administrador") {
            $nuevaDisciplina = $_POST["disciplina"];
        }

        $hash_contraseña = password_hash($nuevaContraseña, PASSWORD_DEFAULT);
        
        include '../../conexion.php';

        $sql = "UPDATE instructores SET  Nombre = '$nuevoNombre', Apellido_Paterno = '$nuevoApellidoP', Apellido_Materno = '$nuevoApellidoM', Disciplina = '$nuevaDisciplina', Perfil = '$nuevoPerfil', Nombre_usuario = '$nuevoUsuario', Contrasena = '$hash_contraseña' WHERE ID_Instructor = $idInstructor";

        if ($conn->query($sql) === TRUE) {
            echo "Cambios guardados con exito.";
            echo '<br><a href="gestionar_docentes.php">Volver</a>';
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
