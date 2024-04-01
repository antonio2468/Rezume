<?php

require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id =='' || $token ==''){
    echo 'Error al procesar la peticiòn';
    exit;
}else {
    $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);
    if($token == $token_tmp) {
        $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
        $sql->execute([$id]);

        if($sql->fetchColumn() > 0){
            $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento FROM productos WHERE id=? AND activo=1
            LIMIT 1");
            $sql->execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['nombre'];
            $descripcion = $row['descripcion'];
            $precio = $row['precio'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);
            $dir_images = 'images/productos/' . $id . '/';

            $rutaImg = $dir_images . 'principal.PNG';
            
            if(!file_exists($rutaImg)){
            $rutaImg = 'images/noPhoto.PNG';
            }
            $imagenes = array();
            $dir = dir($dir_images);
            while (($archivo = $dir->read()) !=false){
                if($archivo != 'principal.PNG' && (strpos($archivo, 'PNG') || strpos($archivo, 'jpg'))){
                    $imagenes[] = $dir_images . $archivo;
                }
            }
            $dir->close();

        }
        
    }else{
        echo 'Error al Procesar la Peticion';
        exit;
    }
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Rezume Free Template by Colorlib</title>
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
		<li><a href="#section-portfolio">Portafolio</a></li>
		<li><a href="#section-resume">Resume</a></l>
		<li><a href="#section-about">Acerca de </a></li>
		<li><a href="#section-contact">Contacto</a></li>

		<li class="nav-item ">
			<a class="nav-link" href="checkout.php">Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?> </span></a>
		</li>
		


		<li class="nav-item dropdown">
          		<a style="color:red" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          	  		<?php echo $_SESSION['usuario']; ?>
          		</a>
          		<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            			<li><a class="dropdown-item" href="servidor/login/logout.php">Salir del sistema</a></li>
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
		

			<!--Contenido-->
			<!--Contenido-->
			<main>
        <div class="container">
        <div class="row">
        <div class="col-md-6 order-md-1">

        <div id="carouselImages" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselImages" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselImages" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselImages" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src ="<?php echo  $rutaImg; ?>" class="d-block w-100">
    </div>

    <?php foreach($imagenes as $img) { ?>
    <div class="carousel-item ">
    <img src ="<?php echo  $img; ?>" class="d-block w-100">
    </div>

    <?php } ?>

   
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
   
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    
  </button>
</div>


</div>
<div class="col-md-6 order-md-2">
<H2><?php echo $nombre;  ?> </H2>

<?php if($descuento > 0) { ?>
    <p><del><?php echo MONEDA . number_format($precio, 2, '.',',');  ?> </del><p>
<H2>
    <?php echo MONEDA . number_format($precio, 2, '.',',');  ?>
    <small class="text-success"><?php echo $descuento; ?>% descuento </small>
 </H2>

 <?php }else{ ?>
    <H2>
    <?php echo MONEDA . number_format($precio, 2, '.',',');  ?>
    
 </H2>

 <?php }?>


<p class="lead">
    <?php echo $descripcion; ?>

</p>
<div class="d-grid gap-3 col-10 mx-auto">
	<button class="btn btn-primary" type="button"> Comprar Ahora</button>
	<button class="btn btn-danger" type="button" onclick="addProducto(<?php echo $id; ?>, '<?php echo $token_tmp ?>')"> Agregar al Carrito</button>
 </div>

</div>

</div>
        </div>
    </main>


			
		</div>
	</section>
	<!-- .section -->

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