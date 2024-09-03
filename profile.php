<!DOCTYPE HTML>
<html>
	<head>
		<title>ISND</title>
		<?php
		session_start();

		if (!isset($_SESSION['username'])) {
			header('Location: index.php'); // Redirigir al formulario de login si no hay sesión
			exit;
		}
		?>
		<meta charset="utf-8" /> 
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="icon" href="/images/logoisnd.jpg" type="image/x-icon">


	</head>
	<body > <!-- <body>is preload -->

	

		<!-- Wrapper -->
			<div id="wrapper">

			
					
			<?php include 'navbar.php'; ?>



			</div>
						<!-- Posts List -->
							<section>
								<ul class="posts">
									<li>
										<article>
											<header>
												<h3><a href="single.html">Como hacer tu CV de programador</a></h3>
												<time class="published" datetime="2022-10-20">October 20, 2022</time>
											</header>
											<a href="single.html" class="image"><img src="images/cvprogramador.png" alt="" /></a>
										</article>
									</li>
									<li>
										<article>
											<header>
												<h3><a href="single.html">Los mejores libros para mejor habitos</a></h3>
												<time class="published" datetime="2025-10-12">October 15, 2025</time>
											</header>
											<a href="single.html" class="image"><img src="images/habitoslibro.jpg" alt="" /></a>
										</article>
									</li>
									<li>
										<article>
											<header>
												<h3><a href="single.html">Retos de programación</a></h3>
												<time class="published" datetime="2022-10-10">October 10, 2022</time>
											</header>
											<a href="single.html" class="image"><img src="images/retoprogramacion.jpeg" alt="" /></a>
										</article>
									</li>
									<li>
										<article>
											<header>
												<h3><a href="single.html">Las 10 más importantes noticias Tecnologicas</a></h3>
												<time class="published" datetime="2022-10-08">October 8, 2022</time>
											</header>
											<a href="single.html" class="image"><img src="images/markmeme.jpeg" alt="" /></a>
										</article>
									</li>
									<li>
										<article>
											<header>
												<h3><a href="single.html">Concurso de programación</a></h3>
												<time class="published" datetime="2024-12-01">Diciembre 1, 2024</time>
											</header>
											<a href="single.html" class="image"><img src="images/devoloperrr.png" alt="" /></a>
										</article>
									</li>
									<li>
										<article>
											<header>
												<h3><a href="single.html">Bitcoin rompe record historico</a></h3>
												<time class="published" datetime="2020-10-06">October 7, 2020</time>
											</header>
											<a href="single.html" class="image"><img src="images/bitcoin.png" alt="" /></a>
										</article>
									</li>
									<li>
										<article>
											<header>
												<h3><a href="single.html">AR & VR y nuevas tecnologias</a></h3>
												<time class="published" datetime="2023-10-06">October 7, 2023</time>
											</header>
											<a href="single.html" class="image"><img src="images/vrar.jpg" alt="" /></a>
										</article>
									</li>
								</ul>
							</section>

						<!-- About -->
							<section class="blurb">
								<h2>About</h2>
								<p>Hecha por la comunidad y para la comunidad.</p>
								<ul class="actions">
									<li><a href="#" class="button">Learn More</a></li>
								</ul>
							</section>

						<!-- Footer -->
							<section id="footer">
								<ul class="icons">
									<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
									<li><a href="https://www.instagram.com/isnd.iest/" target="_blank" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="icon solid fa-rss"><span class="label">RSS</span></a></li>
									<li><a href="#" class="icon solid fa-envelope"><span class="label">Email</span></a></li>
								</ul>
								<p class="copyright">&copy; Hunters </a>.</p>
							</section>

					</section>

		
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/carrusel.js"></script>
			

	</body>
</html>