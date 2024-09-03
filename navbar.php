<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php'); // Redirigir al formulario de login si no hay sesión
    exit;
}

$profile_picture = $_SESSION['profile_picture'];
?>

<header id="header">
    <h1><a href="/index.php">Sistemas y Negocios Digitales</a></h1>
    <nav class="links">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#">Novedades</a></li>
            <li><a href="foros.php">Foros</a></li>
            <li><a href="proyectos.php">Proyectos</a></li>
            <li><a href="#">Certificaciones</a></li>
        </ul>
    </nav>
    <nav class="main">
        <ul>
            <li>
                <div class="meta">
                    <a style="margin-left: 10px; margin-right: 10px;" href="#menu" class="author">
                        <?php echo $_SESSION['username']; ?>
                        <img src="<?php echo $profile_picture; ?>" alt="" style="margin-left: 10px; border-radius: 100%; width: 50px; height: 50px;" />
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</header>

<section id="menu" style="z-index: 100;">
    <!-- Search -->
    <section>
        <form class="search" method="get" action="#">
            <input type="text" name="query" placeholder="Search" />
        </form>
    </section>

    <!-- Links -->
    <section>
        <div class="meta">
            <!-- Imagen del perfil en el menú con opciones -->
            <a href="javascript:void(0);" onclick="togglePhotoOptions(event);">
                <img src="<?php echo $profile_picture; ?>" style="border-radius: 100%; width: 100px; height: 100px; display: block;" />
            </a>
            <!-- Botones para subir y eliminar imagen (inicialmente ocultos) -->
            <div id="photoOptions" style="display: none;">
                <form action="subir_foto_perfil.php" method="post" enctype="multipart/form-data">
				<input type="file" id="fileInput" name="profile_picture" accept="image/*" onchange="this.form.submit();" />
                <input type="submit" value="Subir nueva foto" style="display: none;" />
</form>

<form action="subir_foto_perfil.php" method="post">
    <input type="hidden" name="delete" value="1" />
    <input type="submit" value="Eliminar foto" />
</form>
            </div>
        </div>

        <a href="profile.php"><?php echo $_SESSION['username']; ?></a>

        <ul class="links">
            <li>
                <a href="#">
                    <h3>Proyectos</h3>
                    <p>Aqui los proyectos en los que participas.</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Configuracion</h3>
                    <p>Haz a tu gusto esta pagina!</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Ayuda</h3>
                    <p>Reporta alguna injusticia o queja.</p>
                </a>
            </li>
        </ul>
    </section>

    <!-- Actions -->
    <section>
        <ul class="actions stacked">
            <li><a href="/login.php" class="button large fit">Log In</a></li>
        </ul>
    </section>
</section>

<!-- JavaScript para mostrar/ocultar opciones de foto sin cerrar el menú -->
<script>
function togglePhotoOptions(event) {
    event.stopPropagation(); // Evitar que el clic cierre el menú
    var options = document.getElementById('photoOptions');
    if (options.style.display === 'none') {
        options.style.display = 'block';
    } else {
        options.style.display = 'none';
    }
}
</script>