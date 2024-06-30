<!DOCTYPE html>
<html>
<head>
<?php
if (isset($_GET["actividad"])) {
    $actividad = $_GET["actividad"];
    
    include '../conexion.php';

    $sql_horarios = "SELECT horario1, horario2 FROM actividades WHERE nombre = ?";
    if ($stmt_horarios = $conn->prepare($sql_horarios)) {
        $stmt_horarios->bind_param("s", $actividad);
        $stmt_horarios->execute();
        $stmt_horarios->bind_result($horario1, $horario2);
        $stmt_horarios->fetch();
        $stmt_horarios->close();
    } else {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
} else {
    echo "Error: Seleccione una actividad válida.";
}

?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const matriculaInput = document.getElementById("matricula");
    const matriculaError = document.getElementById("matriculaError");
    const correoInput = document.getElementById("correo_electronico");
    const correoError = document.getElementById("correo_electronicoError");

    matriculaInput.addEventListener("input", function() {
        const matriculaValue = this.value;
        if (matriculaValue.length > 10) {
            matriculaError.textContent = "La matrícula debe tener exactamente 10 dígitos.";
            this.value = matriculaValue.slice(0, 10);
        } else {
            matriculaError.textContent = "";
        }
    });

    correoInput.addEventListener("input", function() {
        const correoValue = this.value;
        const correoFormatoValido = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(correoValue);
        
        if (!correoFormatoValido) {
            correoError.textContent = "Ingresa un correo electrónico válido.";
        } else {
            correoError.textContent = "";
        }
    });
});
</script>
    <title>Formulario</title>
</head>


<body>
    <h1>Completa los campos:</h1>
    <form action="procesar_formulario.php" method="post">
        <label for="matricula">Matrícula:</label>
        <input type="number" name="matricula" id="matricula" required maxlength="10" pattern="[0-9]+"><br>
        <div id="matriculaError" style="color: red;"></div>
            
        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" id="apellido_paterno" required><br>

        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" name="apellido_materno" id="apellido_materno" required><br>

        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" id="nombres" required><br>

        <label for="correo_electronico">Correo electrónico:</label>
        <input type="text" name="correo_electronico" id="correo_electronico" required><br>
        <div id="correo_electronicoError" style="color: red;"></div>
        
        <label for="carrera">Carrera:</label>
        <select id="carrera" name="carrera" required>
            <option value="Ingeniería en Software">Ingeniería de Software</option>
            <option value="Ingeniería Civíl">Ingeniería Civíl</option>
            <option value="Ingeniería en Redes y Telecomunicaciones">Ingeniería en Redes y Telecomunicaciones</option>
            <option value="Ingeniería en Tecnologías de Manufactura">Ingeniería en Tecnologías de Manufactura</option>
            <option value="Ingeniería en Tecnología Ambiental">Ingeniería en Tecnología Ambiental</option>
            <option value="Licenciatura en Administración y Gestión Empresarial">Licenciatura en Administración y Gestión Empresarial</option>

        </select><br><br>
        
        <label for="grupo">Grupo:</label>
        <select id="numero_grupo" name="numero_grupo" required>
            <option value="1">1</option>
            <option value="1">2</option>
            <option value="1">3</option>
            <option value="4">4</option>
            <option value="1">5</option>
            <option value="1">6</option>
            <option value="7">7</option>
            <option value="1">8</option>
        </select>

        <select id="letra_grupo" name="letra_grupo" required>
            <option value="a">a</option>
            <option value="b">b</option>
            <option value="b">c</option>
        </select><br>

        <label for="horario">Selecciona un horario:</label><br>
        <input type="radio" name="horario" value="<?php echo $horario1; ?>" required> <?php echo $horario1; ?><br>
        <input type="radio" name="horario" value="<?php echo $horario2; ?>" required> <?php echo $horario2; ?><br>


        <input type="hidden" name="actividad" value="<?php echo $_GET['actividad']; ?>">
        
        <input type="submit" value="Guardar">
    </form>
    <br><a href="alumnos.php">Volver</a>
</body>
</html>