<?php



require 'config/config.php';
require 'config/database.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;


$lista_carrito = array();

if($productos != null){
    foreach ($productos as $clave => $cantidad){

        $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos WHERE id=? AND activo=1");
        $sql->execute([$clave]);
        $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);

    }
}
else{
    header("Location: cliente_inicio.php");
    exit;
}
//session_destroy();

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

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>



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
			<a href="carrito.php">Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?> </span></a>
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

<main>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h1>Detalles de Pago </h1>
                <div id="paypal-button-container"></div>
            </div>
        <div class="col-6">

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Subtotal</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($lista_carrito == null){
                        echo '<tr><td colspan="5" class="text-center">Lista Vacia</td></tr>';
                    } else{
                        $total = 0;
                        foreach($lista_carrito as $producto){
                            $_id=$producto['id'];
                            $nombre=$producto['nombre'];
                            $precio=$producto['precio'];
                            $descuento=$producto['descuento'];
                            $cantidad=$producto['cantidad'];
                            $precio_desc=$precio-(($precio * $descuento) / 100);
                            $subtotal = $cantidad * $precio_desc;
                            $total+= $subtotal;
                        
                    ?>
                    <tr>
                        <td><?php echo $nombre; ?></td>
                        <td>
                            <div id="subtotal_<?php echo$_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2, '.', ','); ?> </div>
                        </td>
                    </tr>    
                    <?php } ?>

                                <tr>
                                      <td colspan="2">
                                        <p class="h3 text-end" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                                      </td>


                </tbody>
                <?php } ?>
            </table>
        </div>

      
    </div>
    </div>
    </div>
</main>





	


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
     <!-- Include the PayPal JavaScript SDK -->
     <script src="https://www.paypal.com/sdk/js?client-id=AXc1S76V8UvVwtTkocBtikqo11TPhLeG6TFlPN9h_ETOCPPh3ASMFpXCPnaFrLGAXdmttYoCXXjqEy2O"></script>



    <script>
      paypal.Buttons({
       style: {
        color: 'blue',
        shape: 'pill',
        label: 'pay'
       },
       createOrder: function(data, actions){
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: <?php echo $total; ?>
                }
            }]
        });
       },
        onApprove: function(data, actions) {
            let URL = 'clases/captura.php'
            actions.order.capture().then(function (detalles){
                console.log(detalles)
                return fetch(url, {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        detalles: detalles
                    })
                })
            });
          },
         onCancel: function(data){
            alert("Pago Cancelado");
            console.log(data);
         }
        }).render('#paypal-button-container');
    </script>
    <!-- Set up a container element for the button -->
	<!-- Google Map -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    	<script src="js/google-map.js"></script> -->

    </body>
    </html>