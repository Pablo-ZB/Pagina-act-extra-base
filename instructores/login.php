<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }
        

        h2 {
            background-color: black;
            color: #fff;
            padding: 10px;
        }
        
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            width: 300px;
        }
        
        label {
            display: block;
            margin-top: 10px;
        }
        
        input[type="text"],
        input[type="password"]{
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }
        
        input[type="submit"] {
            background-color: #eeeded;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        
        input[type="submit"]:hover {
            background-color: #aeaaaa;
        }

       
        #mostrarContrasena {
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Iniciar Sesión</h2>
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
    </div>


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
