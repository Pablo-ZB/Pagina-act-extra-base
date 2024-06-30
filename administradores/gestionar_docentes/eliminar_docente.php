<?php
if (isset($_GET['id'])) {
    $idInstructor = $_GET['id'];

    include '../../conexion.php';

    $sql = "DELETE FROM instructores WHERE ID_Instructor = $idInstructor";

    if ($conn->query($sql) === TRUE) {
        echo "Docente eliminado con éxito.";
        echo '<br><a href="gestionar_docentes.php">Volver</a>';
    } else {
        echo "Error al eliminar el docente: " . $conn->error;
    }

    $conn->close();
} else {
    echo "ID de docente no proporcionado.";
}
?>
