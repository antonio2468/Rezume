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
		<li><a href="resume.php">Resume</a></l>
		<li><a href="about.php">Acerca de </a></li>
		<li class="nav-item"><a href="contacto.php" class="nav-link active">Contacto</a></li>

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



	

	<section class="site-section" id="section-contact">
		<div class="container">
			<div class="row">
				<div class="col-md-12 mb-5">
					<div class="section-heading text-center">
						<h1>Get <strong>In Touch</strong></h1>
					</div>
				</div>

				<div class="col-md-7 mb-5 mb-md-0">
					<form action="" class="site-form">
						<h1 class="mb-5">Get In Touch</h1>
						<div class="form-group">
							<input type="text" class="form-control px-3 py-4" placeholder="Your Name">
						</div>
						<div class="form-group">
							<input type="email" class="form-control px-3 py-4" placeholder="Your Email">
						</div>
						<div class="form-group">
							<input type="number" class="form-control px-3 py-4" placeholder="Your Phone">
						</div>
						<div class="form-group mb-5">
							<textarea class="form-control px-3 py-4"cols="30" rows="10" placeholder="Write a Message"></textarea>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary  px-4 py-3" value="Send Message">
						</div>
					</form>
				</div>
				<div class="col-md-5 pl-md-5">
					<h1 class="mb-5">My Contact Details</h1>
					<ul class="site-contact-details">
						<li>
							<span class="text-uppercase">Email</span>
							ShoesCortes@gmail.com
						</li>
						<li>
							<span class="text-uppercase">Phone</span>
							+52 449-459-74-06
						</li>
						<li>
							<span class="text-uppercase">Address</span>
							Aguascalientes, Ags <br>
							Gral. Zargaoza #1555<br>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>


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
	