<?php
if (isset($_GET['id'])) {
    $idAlumno = $_GET['id'];

    include '../../conexion.php';

    $sql = "SELECT * FROM alumnos WHERE Matricula = $idAlumno";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
       
    } else {
        echo "No se encontró el alumno.";
    }

    $conn->close();
} else {
    echo "ID de alumno no proporcionado.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<script>


    
    document.addEventListener("DOMContentLoaded", function() {

     // ACTIVIDAD Y HORARIO
     const actividadSelect = document.getElementById("actividad");
    const horarioSelect = document.getElementById("horario");

    const actividadesHorarios = {
        <?php

        include '../../conexion.php';

        $sql = "SELECT Nombre, Horario1, Horario2 FROM actividades";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            while ($fila_actividad = $resultado->fetch_assoc()) {
                echo "'" . $fila_actividad["Nombre"] . "': ['" . $fila_actividad["Horario1"] . "', '" . $fila_actividad["Horario2"] . "'], ";
            }
        }

        $conn->close();
        ?>
    };

    function actualizarHorario() {
        const actividadSeleccionada = actividadSelect.value;
        const horarios = actividadesHorarios[actividadSeleccionada] || [];
        
        horarioSelect.innerHTML = "";

        horarios.forEach(horario => {
            const option = document.createElement("option");
            option.value = horario;
            option.textContent = horario;
            horarioSelect.appendChild(option);
        });
    }

    actividadSelect.addEventListener("change", actualizarHorario);

    actualizarHorario();

    //  GRUPO, MATRICULA Y CORREO

    const grupoNumero = document.getElementById("grupoNumero");
    const grupoLetra = document.getElementById("grupoLetra");
    const grupoInput = document.createElement("input");   
    grupoInput.type = "hidden";
    grupoInput.name = "grupo";     
    document.querySelector("form").appendChild(grupoInput);

    const matriculaInput = document.getElementById("matricula");
    const matriculaError = document.getElementById("matriculaError");
    const correoInput = document.getElementById("correo_electronico");
    const correoError = document.getElementById("correo_electronicoError");

    function updateGrupo() {
            const numeroSeleccionado = grupoNumero.value;
            const letraSeleccionada = grupoLetra.value;
            grupoInput.value = numeroSeleccionado + letraSeleccionada;
        }

        grupoNumero.addEventListener("change", updateGrupo);
        grupoLetra.addEventListener("change", updateGrupo);

        updateGrupo();
    
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

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno</title>
</head>
<body>
    <h1>Editar Alumno</h1>
    
    <form action="guardar_edicion.php" method="POST">
        
    <label for="matricula">Matrícula:</label>
        <input type="text" name="matricula" id="matricula" required maxlength="10" pattern="[0-9]+" value="<?php echo $fila["Matricula"]; ?>"><br>
        <div id="matriculaError" style="color: red;"></div>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $fila["Nombre"]; ?>"><br>

        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" value="<?php echo $fila["Apellido_Paterno"]; ?>"><br>

        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" name="apellido_materno" value="<?php echo $fila["Apellido_Materno"]; ?>"><br>

        <label for="carrera">Carrera:</label>
        <select id="carrera" name="carrera" required>
            <option value="Ingeniería en Software">Ingeniería de Software</option>
            <option value="Ingeniería Civíl">Ingeniería Civíl</option>
            <option value="Ingeniería en Redes y Telecomunicaciones">Ingeniería en Redes y Telecomunicaciones</option>
            <option value="Ingeniería en Tecnologías de Manufactura">Ingeniería en Tecnologías de Manufactura</option>
            <option value="Ingeniería en Tecnología Ambiental">Ingeniería en Tecnología Ambiental</option>
            <option value="Licenciatura en Administración y Gestión Empresarial">Licenciatura en Administración y Gestión Empresarial</option>

        </select><br><br>

        <label for="grupoNumero">Grupo:</label>
            <select id="grupoNumero" name="grupoNumero" required>
                <?php
                $numerosGrupo = range(1, 8);

                foreach ($numerosGrupo as $numero) {
                    $selected = ($fila["Grupo"] && is_numeric($fila["Grupo"]) && $fila["Grupo"] == $numero) ? "selected" : "";
                    echo "<option value='$numero' $selected>$numero</option>";
                }
                ?>
            </select>

            <label for="grupoLetra"></label>
            <select id="grupoLetra" name="grupoLetra" required>
                <?php
                $letrasGrupo = range('a', 'c');

                foreach ($letrasGrupo as $letra) {
                    $selected = ($fila["Grupo"] && is_string($fila["Grupo"]) && $fila["Grupo"] == $letra) ? "selected" : "";
                    echo "<option value='$letra' $selected>$letra</option>";
                }
                ?>
            </select><br>

        

        <label for="actividad">Actividad:</label>
            <select id="actividad" name="actividad" required>
                <?php

            include '../../conexion.php';

                $sql = "SELECT Nombre FROM actividades";
                $resultado = $conn->query($sql);

                if ($resultado->num_rows > 0) {
                    while ($fila_actividad = $resultado->fetch_assoc()) {
                        echo "<option>" . $fila_actividad["Nombre"] . "</option>";
                    }
                }

                $conn->close();
                ?>
            </select><br>


        <label for="correo_electronico">Correo electrónico:</label>
        <input type="text" name="correo_electronico" id="correo_electronico" value="<?php echo $fila["Correo_Electronico"]; ?>" required><br>
        <div id="correo_electronicoError" style="color: red;"></div>

        <label for="horario">Horario:</label>
            <select id="horario" name="horario" required>
                

            </select><br>

        <input type="hidden" name="id" value="<?php echo $idAlumno; ?>">

        <input type="submit" value="Guardar Cambios">
        
    </form>
    <br><a href="gestionar_alumnos.php">Volver</a>
</body>
</html>