<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Docente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>

        #disciplinaContainer {
            display: none;
            margin-top: 5px; 
        }

    </style>
</head>
<body>
    <h1>Agregar Docente</h1>
    
    <form action="procesar_agregar_docente.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="apellido_paterno">Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" id="apellido_paterno" required><br>

        <label for="apellido_materno">Apellido Materno:</label>
        <input type="text" name="apellido_materno" id="apellido_materno" required><br>

        <div id="disciplinaContainer">

            <label for="disciplina" id="disciplinaLabel">Disciplina:</label>
            <select id="disciplina" name="disciplina" required>
                
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "act_extraescolares";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
                }

                $sql = "SELECT nombre FROM actividades";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["nombre"] . '">' . $row["nombre"] . '</option>';
                    }
                } else {
                    echo '<option value="">No hay disciplinas disponibles</option>';
                }

                $conn->close();
                ?>
            </select><br><br>
        
        </div>

        <label for="perfil">Perfil:</label>
        <select id="perfil" name="perfil" required onchange="toggleDisciplinas()">
            <option value="Instructor">Instructor</option>
            <option value="Administrador">Administrador</option>
        </select><br><br>

        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" name="nombre_usuario" required><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <span id="mostrarContrasena" onclick="mostrarOcultarContrasena()">
            <i class="fas fa-eye" id="iconoOjo"></i>
        </span><br>

        <input type="submit" value="Agregar Docente">
    </form>
    <script>
        function mostrarOcultarContrasena() {
            var contrasena = document.getElementById("contrasena");
            var iconoOjo = document.getElementById("iconoOjo");
    
            if (contrasena.type === "password") {
                contrasena.type = "text";
                iconoOjo.classList.remove("fa-eye");
                iconoOjo.classList.add("fa-eye-slash");
            } else {
                contrasena.type = "password";
                iconoOjo.classList.remove("fa-eye-slash");
                iconoOjo.classList.add("fa-eye");
            }
        }

        function toggleDisciplinas() {
            var perfil = document.getElementById("perfil");
            var disciplinaContainer = document.getElementById("disciplinaContainer");

            if (perfil.value === "Administrador") {
                
                disciplinaContainer.style.display = "none";
            } else {
            
                disciplinaContainer.style.display = "block";
            }
        }

        toggleDisciplinas();
    </script>
    <br><a href="gestionar_docentes.php">Volver</a>
</body>
</html>