<?php

if (!empty($_POST["loginBtn"])) {
    if (empty($_POST["username"]) and empty($_POST["password"])) {
        echo "LOS CAMPOS ESTAN VACIOS";
    } else {
        $username=$_POST["username"];
        $password=$_POST["password"];
        $sql=$conexion->query(" select * from usuarios where nombre='$username' and password='$password' ");
        if ($datos=$sql->fetch_object()) {
            header("location:index.php");
        } else {
            echo '<div> Acceso denegado </div>';
        }
    }
}

?>
