<?php
// Incluir la conexión a la base de datos
$servername = "162.241.2.36";
$username = "issmarco_socialisnd";
$password = "F5dUOIwy(chr";
$database = "issmarco_socialisnd";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Register</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>
    <body class="is-preload">
        <style>
            .modal {
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
                display: flex;
                justify-content: center;
                align-items: center;
            }

            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .login-container {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                width: 100%;
            }

            .login-container h2 {
                margin-bottom: 20px;
                color: #333;
                text-align: center;
            }

            .login-container input[type="text"],
            .login-container input[type="password"] {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .login-container button {
                width: 100%;
                background-color: #ffffff;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
                align-items: center;
                text-align: center;
            }

            .login-container button:hover {
                background-color: #000000;
            }

            .login-container p {
                text-align: center;
                color: #000000;
                margin-top: 20px;
            }

            .login-container p a {
                color: #007bff;
                text-decoration: none;
            }

            .login-container p a:hover {
                text-decoration: underline;
            }

            @media (max-width: 400px) {
                .login-container {
                    padding: 15px;
                }

                .login-container h2 {
                    font-size: 20px;
                }

                .login-container button {
                    font-size: 14px;
                }
            }

            .hidden {
                display: none;
            }
        </style>

        <!-- Wrapper -->
        <div id="wrapper">
            <!-- Header -->
            <header id="header">
                <h1><a href="index.php">Sistemas y Negocios Digitales</a></h1>
            </header>

            <!-- Main -->
            <div id="main">
                <!-- Post -->
                <article class="post">
                    <header>
                        <div class="title">
                            <h2>¡Bienvenidos, ingenieros en Sistemas y Negocios Digitales!</h2>
                            <h3>¡Registrate Aquí!</h3>
                            <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                    $email = $_POST['email'];
                                    $id = $_POST['id'];
                                
                                    if (!empty($username) && !empty($password) && !empty($email) && !empty($id)) {
                                        $sql_check = "SELECT * FROM usuarios WHERE nombre = ? OR correo = ?";
                                        $stmt = $conn->prepare($sql_check);
                                        $stmt->bind_param("ss", $username, $email);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                
                                        if ($result->num_rows > 0) {
                                            echo "El usuario o el correo ya están registrados.";
                                        } else {
                                            $sql = "INSERT INTO usuarios (nombre, password, correo, id) VALUES (?, ?, ?, ?)";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("ssss", $username, $password, $email, $id);
                                            
                                            if ($stmt->execute()) {
                                                echo "Usuario registrado exitosamente. <a href='login.php'>Inicia sesión aquí</a>";
                                            } else {
                                                echo "Error al registrar el usuario: " . $conn->error;
                                            }
                                        }
                                    } else {
                                        echo "Por favor, completa todos los campos.";
                                    }
                                
                                    $stmt->close();
                                    $conn->close();
                                }
                            ?>
                        </div>
                        <div class="login-container">
                            <form action="" method="post">
                                <input id="username" type="text" placeholder="Username" required name="username">
                                <input id="inputPassword" type="password" placeholder="Password" required name="password">
                                <input id="email" type="text" placeholder="Correo Electrónico" required name="email">
                                <input id="id" type="text" placeholder="ID" required name="id">
                                <button name="registerBtn" class="botonpro" type="submit">Crear cuenta</button>
                            </form>
                            <p>If you have an account, please <a href="login.php">Login</a></p>
                        </div>
                    </header>
                </article>
            </div>
        </div>
    </body>
</html>
