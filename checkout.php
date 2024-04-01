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
		<li><a href="cliente_inicio.php" >Inicio</a></li>
		<li><a href="portafolio.php">Portafolio</a></li>
		<li><a href="resume.php">Resume</a></l>
		<li><a href="about.php">Acerca de </a></li>
		<li><a href="contacto.php">Contacto</a></li>

		<li class="nav-item ">
			<a class="nav-link" href="#carrito.php">Carrito <span id="num_cart" class="badge bg-secondary"><?php echo $num_cart; ?> </span></a>
		</li>
		


		<li class="nav-item dropdown">
            <?php if(isset($_SESSION['user_id'])){ ?>
          		<a style="color:red" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          	  	<i class="fas fa-user"></i>	
                <?php echo $_SESSION['user_name']; ?>
          		</a>
                <?php } else{ ?>
                
                <a href = "login.php" class="btn btn-succes">Ingresar</a>
                <?php }  ?>
          		<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            			<li><a class="dropdown-item" href="login.php">Salir del sistema</a></li>
          		</ul>
        	</li>
	 </ul>
    </nav>
</header>

<main>
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
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
                        <td><?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?></td>
                        <td>


						<input type="number" min="1" max="10" step="1" value="<?php echo $cantidad?>" size="5" id="cantidad_<?php echo $_id; ?>"onchange="actualizaCantidad(this.value,<?php echo $_id;?>)">

                        </td>
                        <td>
                            <div id="subtotal_<?php echo$_id; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2, '.', ','); ?> </div>
                        </td>
                        <td><a id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>"data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a></td>
                    </tr>    
                    <?php } ?>

                                <tr>
                                      <td colspan="3"></td>
                                      <td colspan="2">
                                        <p class="h3" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?></p>
                                      </td>


                </tbody>
                <?php } ?>
            </table>
        </div>

        <?php if ($lista_carrito != null) { ?>

        <div class="row">
            <div class="col-md-5 offset-md-7 d-grid gap-2">
                <a href="pago.php" class="btn btn-primary btn-lg">Realizar Pago</a>
            </div>
        </div>
        <?php } ?>
    </div>
</main>


<!-- Modal -->
<div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="eliminaModalLabel">Alerta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       ¿Desea Eliminar el Producto de la Lista?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn-elimina"  type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<script>

		let eliminaModal = document.getElementById('eliminaModal')
		eliminaModal.addEventListener('show.bs.modal', function(event){
			let button = event.relatedTarget
			let id = button.getAttribute('data-bs-id')
			let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
			buttonElimina.value = id
		})
       
        function actualizaCantidad(cantidad, id) {

            let url = 'clases/actualizar_carrito.php';
            let formData = new FormData();
            formData.append('action', 'agregar');
            formData.append('id', id);
            formData.append('cantidad', cantidad);

            fetch(url, {
                    method: 'POST',
                    body: formData,
                    mode: 'cors',
                }).then(response => response.json()).then(data => {
                   
					if (data.ok) {

                    let divsubtotal = document.getElementById('subtotal_' + id)
					divsubtotal.innerHTML = data.sub

					let total = 0.00
					let list = document.getElementsByName('subtotal[]')

					for (let i = 0; i < list.length; i++){
						total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''))
					}

					total = new Intl.NumberFormat('en-US', {
						minimumFractionDigits: 2
					}).format(total)
					document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total

                    }
                })
        }


		function eliminar() {
			let botonElimina = document.getElementById('btn-elimina')
			let id = botonElimina.value

let url = 'clases/actualizar_carrito.php';
let formData = new FormData();
formData.append('action', 'eliminar');
formData.append('id', id); 

fetch(url, {
		method: 'POST',
		body: formData,
		mode: 'cors',
	}).then(response => response.json()).then(data => {
	   
		if (data.ok) {
				location.reload()

		}
	})
}
       
    </script>
	


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