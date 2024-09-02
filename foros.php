<!DOCTYPE HTML>
<html>
<head>
    <title>ISND</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="icon" href="/images/logoisnd.jpg" type="image/x-icon">
    <style>
		.postimg {
			width: 300px;
			max-height: 600px
		}
		/* Estilos para el botón de crear publicación */
		#open-form-button {
			position: fixed;
			bottom: 80px;
			right: 50px;
			z-index: 2;
			background-color: #f4f5f5;
		}
        /* Estilos para ocultar el contenedor del formulario por defecto */
        .hidden {
            display: none;
        }
        /* Estilos para el modal */
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

        /* Estilos para el contenido del modal */
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            width: 50%;
            position: relative;
        }

        /* Estilos para el botón de cerrar */
        .close-button {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 25px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <h1><a href="/index.php">Sistemas y Negocios Digitales</a></h1>
            <nav class="links">
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Novedades</a></li>
                    <li><a href="#">Foros</a></li>
                    <li><a href="/proyectos.php">Proyectos</a></li>
                    <li><a href="#">Certificaciones</a></li>
                </ul>
            </nav>
            <nav class="main">
                <ul>
                    <li class="search">
                        <a class="fa-search" href="#search">Search</a>
                        <form id="search" method="get" action="#">
                            <input type="text" name="query" placeholder="Search" />
                        </form>
                    </li>
                    <li class="menu">
                        <a class="fa-bars" href="#menu">Menu</a>
                    </li>
                </ul>
            </nav>
        </header>

        <!-- Menu -->
        <section id="menu">

            <!-- Search -->
            <section>
                <form class="search" method="get" action="#">
                    <input type="text" name="query" placeholder="Search" />
                </form>
            </section>

            <!-- Links -->
            <section>
                <ul class="links">
                    <li>
                        <a href="#">
                            <h3>Perfil</h3>
                            <p>Breve explicación de ti.</p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h3>Proyectos</h3>
                            <p>Aquí los proyectos en los que participas.</p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <h3>Configuración</h3>
                            <p>Haz a tu gusto esta página!</p>
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

        <!-- Main -->
        <div id="main">

            <!-- Botón para abrir el formulario -->
<!-- Botón para abrir el formulario -->
			<button id="open-form-button" class="button large">Crear Publicación</button>

            <!-- Formulario para crear una nueva publicación (oculto inicialmente) -->
            <div id="new-post-container-hidden" class="hidden">
                <div id="new-post-container-modal" class="modal">
                    <div class="modal-content">
                        <span id="close-form-button" class="close-button">&times;</span>
                        <form id="new-post-form" action="crear_post.php" method="post" enctype="multipart/form-data">
                            <div class="field">
                                <label for="titulo">Título:</label>
                                <input type="text" id="titulo" name="titulo" required>
                            </div>
							<div class="field">
                                <label for="subtitulo">Subtitulo:</label>
                                <input type="text" id="subtitulo" name="subtitulo" required>
                            </div>
                            <div class="field">
                                <label for="imagen">Imagen:</label>
                                <input type="file" id="imagen" name="imagen" accept="image/*" required>
                            </div>
                            <div class="field">
                                <label for="contenido">Contenido:</label>
                                <textarea id="contenido" name="contenido" required></textarea>
                            </div>
                            <button type="submit" class="button large">Crear Publicación</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contenedor para mostrar publicaciones -->
                <?php
                // Configuración de la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "isnddb";

                // Crear conexión
                $conn = new mysqli($servername, $username, $password, $database);

                // Verificar conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consultar publicaciones
                $sql = "SELECT * FROM posts ORDER BY fecha DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
						echo "<article class='post'>";
						echo "    <header>";
						echo "        <div class='title'>";
						echo "            <h2><a href='post.php?id=" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['titulo']) . "</a></h2>";
						echo "            <p>" . htmlspecialchars($row['subtitulo']) . "</p>";
						echo "        </div>";
						echo "        <div class='meta'>";
						echo "            <time class='published' datetime='" . date('Y-m-d', strtotime($row['fecha'])) . "'>" . date('F j, Y', strtotime($row['fecha'])) . "</time>";
						echo "            <a href='#' class='author'><span class='name'>Alejandro Acosta</span><img src='images/alex.png' alt='' /></a>";
						echo "        </div>";
						echo "    </header>";
						
						if ($row['imagen']) {
							echo "    <a href='post.php?id=" . htmlspecialchars($row['id']) . "'><img src='" . htmlspecialchars($row['imagen']) . "' alt='' class='postimg'/></a>";
						}
						
						echo "    <p>" . htmlspecialchars($row['contenido']) . "</p>";
						
						echo "    <footer>";
						echo "        <ul class='actions'>";
						echo "            <li><a href='post.php?id=" . htmlspecialchars($row['id']) . "' class='button large'>Continue Reading</a></li>";
						echo "        </ul>";
						echo "        <ul class='stats'>";
						echo "            <!-- Aquí puedes agregar más estadísticas si lo deseas -->";
						echo "            <li><a href='#' class='icon solid fa-heart'>28</a></li>";
						echo "            <li><a href='#' class='icon solid fa-comment'>128</a></li>";
						echo "        </ul>";
						echo "    </footer>";
						echo "</article>";
					}
				}						
                // Cerrar la conexión
                $conn->close();
                ?>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script>
        // Script para mostrar y ocultar el formulario
        document.getElementById('open-form-button').addEventListener('click', function() {
            document.getElementById('new-post-container-hidden').classList.remove('hidden');
        });

        document.getElementById('close-form-button').addEventListener('click', function() {
            document.getElementById('new-post-container-hidden').classList.add('hidden');
        });

        window.onclick = function(event) {
            if (event.target == document.getElementById('new-post-container-modal')) {
                document.getElementById('new-post-container-hidden').classList.add('hidden');
            }
        };
    </script>
</body>
</html>
