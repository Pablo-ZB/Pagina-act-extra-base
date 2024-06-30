<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method="post" action="procesar_login.php">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required>
        <span id="mostrarContrasena" onclick="mostrarOcultarContrasena()">
            <i class="fas fa-eye" id="iconoOjo"></i>
        </span><br>
        
        <input type="submit" value="Iniciar Sesión">
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
    </script>
</body>
</html>
