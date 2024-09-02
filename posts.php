<?php
include 'conexion.php';

// Obtener el ID del post desde la URL
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($post_id > 0) {
    // Consultar los datos del post específico
    $sql = "SELECT titulo, subtitulo, contenido, imagen FROM posts WHERE id = $post_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $titulo = $row['titulo'];
        $subtitulo = $row['subtitulo'];
        $contenido = $row['contenido'];
        $imagen = $row['imagen'];
    } else {
        echo "Publicación no encontrada.";
        exit();
    }
} else {
    echo "ID de publicación no válido.";
    exit();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $titulo; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="icon" href="/images/logoisnd.jpg" type="image/x-icon">
</head>
<body>

<div id="wrapper">

    <header id="header">
        <h1><a href="/index.php">Sistemas y Negocios Digitales</a></h1>
    </header>

    <div id="main">
        <h2><?php echo $titulo; ?></h2>
        <h3><?php echo $subtitulo; ?></h3>
        <?php if (!empty($imagen)) : ?>
            <img src="<?php echo $imagen; ?>" alt="<?php echo $titulo; ?>" style="max-width:100%;">
        <?php endif; ?>
        <p><?php echo nl2br($contenido); ?></p>
    </div>

</div>

</body>
</html>
