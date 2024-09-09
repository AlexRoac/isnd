<?php
session_start();
include 'conexion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Ruta de la foto por defecto
$default_picture = 'uploads/foto_default.png';

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre de usuario de la sesión
    $username = $_SESSION['username'];

    // Manejo de la subida de foto
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
        // Directorio para subir la imagen
        $target_dir = "uploads/";
        $fileTmpPath = $_FILES["profile_picture"]["tmp_name"];
        $fileMimeType = mime_content_type($fileTmpPath);

        // Verificar si el archivo es una imagen real
        $check = getimagesize($fileTmpPath);
        if ($check === false) {
            echo "El archivo no es una imagen.";
            exit();
        }

        // Crear una imagen a partir del archivo dependiendo de su tipo
        switch ($fileMimeType) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($fileTmpPath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($fileTmpPath);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($fileTmpPath);
                break;
            default:
                echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
                exit();
        }

        if ($image) {
            // Generar un nombre único para el archivo .webp
            $outputFile = $target_dir . uniqid('profile_', true) . '.webp';

            // Guardar la imagen como .webp (calidad 80)
            if (imagewebp($image, $outputFile, 80)) {
                // Actualizar la ruta de la foto en la base de datos
                $stmt = $conn->prepare("UPDATE usuarios SET foto_perfil = ? WHERE nombre = ?");
                $stmt->bind_param("ss", $outputFile, $username);
                if ($stmt->execute()) {
                    $_SESSION['profile_picture'] = $outputFile; // Actualizar la ruta en la sesión
                    echo "Foto de perfil actualizada correctamente.";
                    // Redirigir a la página principal después de la actualización
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Lo siento, hubo un error al guardar la imagen .webp.";
            }

            // Liberar memoria
            imagedestroy($image);
        } else {
            echo "Error al crear la imagen desde el archivo subido.";
        }
    }

    // Manejo de la eliminación de foto
    if (isset($_POST['delete']) && $_POST['delete'] == '1') {
        // Actualizar la ruta de la foto en la base de datos
        $stmt = $conn->prepare("UPDATE usuarios SET foto_perfil = ? WHERE nombre = ?");
        $stmt->bind_param("ss", $default_picture, $username);
        if ($stmt->execute()) {
            $_SESSION['profile_picture'] = $default_picture; // Actualizar la ruta en la sesión
            echo "Foto de perfil eliminada correctamente.";
            // Redirigir a la página principal después de la eliminación
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Cerrar la conexión
$conn->close();
?>
