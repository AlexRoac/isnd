<?php
// Iniciar la sesión
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

require_once "conexion.php";

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validar nombre de usuario
    if (isset($_POST["username"]) && !empty(trim($_POST["username"]))) {
        $username = trim($_POST["username"]);
    } else {
        $username_err = "Por favor, ingrese el nombre de usuario";
    }

    // Validar contraseña
    if (isset($_POST["password"]) && !empty(trim($_POST["password"]))) {
        $password = trim($_POST["password"]);
    } else {
        $password_err = "Por favor, ingrese una contraseña";
    }

    // Validar credenciales
    if (empty($username_err) && empty($password_err)) {

        $sql = "SELECT id, username, email, clave FROM usuarios WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $email, $stored_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        // Comparar la contraseña sin hashing
                        if ($password === $stored_password) {
                            // Iniciar la sesión
                            session_start();

                            // Almacenar datos en variables de sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirigir a index.php
                            header("location: index.php");
                            exit;
                        } else {
                            $password_err = "La contraseña es incorrecta";
                        }
                    }
                } else {
                    $username_err = "No se ha encontrado ninguna cuenta con ese nombre";
                }
            } else {
                echo "¡UPS! Algo salió mal, inténtalo más tarde.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
?>
