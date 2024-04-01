<?php



require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT id, nombre, precio FROM productos WHERE activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);


//session_destroy();





?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shoes Store</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="fonts/icomoon/style.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/css.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/estilo.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700" rel="stylesheet">


</head>
<body data-spy="scroll" data-target="#pb-navbar" data-offset="200">



	
<header>

    <nav>
        <ul>
		<li><a href="cliente_inicio.php">Inicio</a></li>
		<li><a href="portafolio.php">Portafolio</a></li>
		<li class="nav-item"><a href="resume.php" class="nav-link active">Resume</a></l>
		<li><a href="about.php">Acerca de </a></li>
		<li><a href="contacto.php">Contacto</a></li>

		<li class="nav-item ">
			<a href="checkout.php">Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?> </span></a>
		</li>
		


		<li class="nav-item dropdown">
          		<a style="color:red" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          	  		<?php echo $_SESSION['user_name']; ?>
          		</a>
          		<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            			<li><a class="dropdown-item" href="login.php">Salir del sistema</a></li>
          		</ul>
        	</li>
	 </ul>
    </nav>
</header>




	<section class="site-hero" style="background-image: url(images/imagen1.jpg);" id="section-home" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row intro-text align-items-center justify-content-center">
				<div class="col-md-10 text-center pt-5">

					<h1 class="site-heading site-animate">Hello, I'm <strong class="d-block">Nike</strong></h1>
					<strong class="d-block text-white text-uppercase letter-spacing">and this is My Store</strong>

				</div>
			</div>
		</div>
	</section> <!-- section -->

	<!-- .section -->
	
	 <!-- Option 1: Bootstrap Bundle with Popper -->
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	 
	
	<section class="site-section " id="section-resume">
		<div class="container">
			<div class="row">
				<div class="col-md-12 mb-5">
					<div class="section-heading text-center">
						<h2>My <strong>Resume</strong></h2>
					</div>
				</div>
				<div class="col-md-6">
					<h2 class="mb-5">Education</h2>
					<div class="resume-item mb-4">
						<span class="date"><span class="icon-calendar"></span> March 2013 - Present</span>
						<h4>Masteral in Information Technology</h4>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<span class="school">New York University</span>
					</div>

					<div class="resume-item mb-4">
						<span class="date"><span class="icon-calendar"></span> March 2013 - Present Deacember.</span>
						<h4>Masteral in Information Technology</h4>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<span class="school">New York University</span>
					</div>

					<div class="resume-item mb-4">
						<span class="date"><span class="icon-calendar"></span> March 2013 - Present</span>
						<h4>Masteral in Information Technology</h4>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<span class="school">New York University</span>
					</div>

					<div class="resume-item mb-4">
						<span class="date"><span class="icon-calendar"></span> March 2013 - Present Deacember.</span>
						<h4>Masteral in Information Technology</h4>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<span class="school">New York University</span>
					</div>

				</div>
				<div class="col-md-6">


					<h2 class="mb-5">Experience</h2>

					<div class="resume-item mb-4">
						<span class="date"><span class="icon-calendar"></span> March 2013 - Present</span>
						<h4>Lead Product Designer</h4>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<span class="school">Github</span>
					</div>

					<div class="resume-item mb-4">
						<span class="date"><span class="icon-calendar"></span> March 2013 - Present</span>
						<h4>Lead Product Designer</h4>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<span class="school">Facebook</span>
					</div>

					<div class="resume-item mb-4">
						<span class="date"><span class="icon-calendar"></span> March 2013 - Present</span>
						<h4>Lead Product Designer</h4>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<span class="school">Twitter</span>
					</div>

					<div class="resume-item mb-4">
						<span class="date"><span class="icon-calendar"></span> March 2013 - Present</span>
						<h4>Lead Product Designer</h4>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<span class="school">Shopify</span>
					</div>


				</div>
			</div>
		</div>
	</section> <!-- .section -->

	


	<footer class="site-footer">
		<div class="container">

			<div class="row mb-5">
				<p class="col-12 text-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with pure programming</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
			
			<div class="row mb-5">
				<div class="col-md-12 text-center">
					<p>
						<a href="#" class="social-item"><span class="icon-facebook2"></span></a>
						<a href="#" class="social-item"><span class="icon-twitter"></span></a>
						<a href="#" class="social-item"><span class="icon-instagram2"></span></a>
						<a href="#" class="social-item"><span class="icon-linkedin2"></span></a>
						<a href="#" class="social-item"><span class="icon-vimeo"></span></a>
					</p>
				</div>
			</div>
			
		</div>
	</footer>




	<script src="js/vendor/jquery.min.js"></script>
	<script src="js/vendor/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/vendor/popper.min.js"></script>
	<script src="js/vendor/bootstrap.min.js"></script>

	<script src="js/vendor/jquery.easing.1.3.js"></script>

	<script src="js/vendor/jquery.stellar.min.js"></script>
	<script src="js/vendor/jquery.waypoints.min.js"></script>

	<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
	<script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
	<script src="js/custom.js"></script>

	<!-- Google Map -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    	<script src="js/google-map.js"></script> -->

    </body>
	
    </html>
	