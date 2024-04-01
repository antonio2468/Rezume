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
		<li class="nav-item"><a href="portafolio.php" class="nav-link active">Portafolio</a></li>
		<li><a href="resume.php">Resume</a></l>
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





	<section class="site-section" id="section-portfolio">
		<div class="container">
			<div class="row">
				<div class="section-heading text-center col-md-12">
					<h2>Featured <strong>CATALOGO</strong></h2>
				</div>
			</div>
			 <!-- ======= Our Clients Section ======= -->
			 <section id="clients" class="clients">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h1>Proveedores</h1>
        </div>

        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

          <div class="col-lg-4 col-md-4 col-6">
            <div class="client-logo">
              <img src="assets/img/clients/adidas.png" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-6">
            <div class="client-logo">
              <img src="assets/img/clients/nike.png" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-4 col-md-4 col-6">
            <div class="client-logo">
              <img src="assets/img/clients/converse.png" class="img-fluid" alt="">
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Our Clients Section -->

			<!--Contenido-->
			<main>
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($resultado as $row) { ?>
                <div class="col">
                    <div class="card shadow-sm">
                    
                    <?php 
                    $id = $row['id'];
                    $imagen = "images/productos/"  . $id . "/principal.PNG";

                    if(!file_exists($imagen)){
                        $imagen = "images/noPhoto.PNG";
                    }
                    ?>

                        <img src="<?php echo $imagen; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['nombre'];?></h5>
                            <p class="card-text">$ <?php echo $row['precio'];?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="details.php ?id=<?php echo $row['id'];?>&token=<?php echo
									hash_hmac('sha1',$row['id'], KEY_TOKEN); ?>" class="btn btn-primary">Detalles</a>
                                </div>
								<button class="btn btn-outline-danger" type="button" onclick="addProducto(<?php echo $row['id']; ?>, '<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>')">Agregar al Carrito </button>
								</div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </main>


			
		</div>
	</section>

	<script>
		function addProducto(id, token){
			let url = 'clases/carrito.php'
			let formData = new FormData()
			formData.append('id', id)
			formData.append('token', token)

			fetch(url, {
				method: 'POST',
				body: formData,
				mode: 'cors'
			}).then(response => response.json())
			.then(data =>{
				if(data.ok){
					let elemento =document.getElementById("num_cart")
					elemento.innerHTML = data.numero
				}
			})
		}
	</script>
	<!-- .section -->
	
	 <!-- Option 1: Bootstrap Bundle with Popper -->
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	 


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