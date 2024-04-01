<?php



require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];
if(!empty($_POST)){
  $nombres = trim($_POST['nombres']);
  $apellidos = trim($_POST['apellidos']);
  $email = trim($_POST['email']);
  $telefono = trim($_POST['telefono']);
  $dni = trim($_POST['dni']);
  $usuario = trim($_POST['usuario']);
  $password = trim($_POST['password']);
  $repassword = trim($_POST['repassword']);



  if (esNulo([$nombres, $apellidos, $email, $telefono, $dni, $usuario, $password, $repassword])){
    $errors []= "Debes LLenar Todos los Campos";
  }

  if (usuarioExiste($usuario, $con)){
    $errors []= "El Nombre de Usuario $usuario ya Existe";
  }

  if (emailExiste($email, $con)){
    $errors []= "El El Correo Electronico $email ya Existe";
  }

  if (!validaPassword($password, $repassword)){
    $errors []= "Las Contraseñas no Coinciden";
  }


  if (!validar_clave($password, $con)){
    $errors []= "La clave no cumple con alguno de estos parametros";
    $errors [] = "La clave no puede tener más de 16 caracteres";
    $errors [] = "La clave debe tener al menos una letra minúscula";
    $errors [] = "La clave debe tener al menos una letra mayúscula";
    $errors [] = "La clave debe tener al menos un caracter numérico";
  }


  if (!esEmail($email)){
    $errors []= "La Direccion de Correo no es Valida";
  }

if(count($errors) == 0){


  $id = registraCliente([$nombres, $apellidos, $email, $telefono, $dni], $con);
  if($id > 0){

require 'clases/Mailer.php';
$mailer=new Mailer();
$token = generaToken();
 
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    $idUsuario = registraUsuario([$usuario, $pass_hash, $token, $id], $con);
   
    if($idUsuario > 0){

      $url = "http://localhost/rezume1/" . 'activa_cliente.php?id='.$idUsuario .'&token='.$token;
      $asunto = "Activar Cuenta - Tienda Online";
      $cuerpo = "Estimado $nombres: <br> Para Continuar con el Proceso de Registro es Indispensable dar Click
       en la siguiente Liga <a href='$url'>Activar Cuenta</a>";


if($mailer->enviarEmail($email, $asunto, $cuerpo)){
  echo "Para Terminar el Proceso de Registro Siga las Instrucciones que se le han enviado a la
   direccion de Correo Electronico $email";
  exit;
}
    }else{
      $errors []= "Error al Registrar Usuario";
    
    }

  }else{
    $errors []= "Error al Registrar Cliente";
  }
}

}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tienda En linea</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/registro.css">
    <link rel="stylesheet" href="public/css/login.css">



</head>

<body data-spy="scroll" data-target="#pb-navbar" data-offset="200">



    <!--Contenido-->
    <div class="container-fluid ps-md-0 bg-fondo">
        <div class="row g-0">
            <div class="d-none d-md-flex col-md-6 col-lg-4 "></div>
            <div class="col-md-6 col-lg-12">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 col-lg-8 mx-auto">
                                <main>
                                    <br>
                                    <br>
                                    <div class="container">
                                        <h2>Datos del Cliente </h2>
                                        <?php mostrarMensajes($errors); ?>
                                        <form class="row g-3" action="registro.php" method="post" autocomplete="off">
                                            <div class="col-md-6">
                                                <label for="nombres"><span class="text-danger">*</span><b>Nombres</b></label>
                                                <input type="text" name="nombres" id="nombres" class="form-control"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="apellidos"><span
                                                        class="text-danger">*</span><b>Apellidos</b></label>
                                                <input type="text" name="apellidos" id="apellidos" class="form-control"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="email"><span class="text-danger">*</span><b>Correo
                                                    Electronico</b></label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="telefono"><span class="text-danger">*</span><b>Telefono</b></label>
                                                <input type="tel" name="telefono" id="telefono" class="form-control"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="dni"><span class="text-danger">*</span><b>DNI</b></label>
                                                <input type="text" name="dni" id="dni" class="form-control" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="usuario"><span class="text-danger">*</span><b>Usuario</b></label>
                                                <input type="text" name="usuario" id="usuario" class="form-control"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="password"><span
                                                        class="text-danger">*</span><b>Contraseña</b></label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="repassword"><span class="text-danger">*</span><b>Repetir
                                                    Contraseña</b></label>
                                                <input type="password" name="repassword" id="repassword"
                                                    class="form-control" required>
                                            </div>

                                        <i><b> </b>  </i>
                                        
                                        
                                        <div class="row">
                                        <div class="col-sm-3">
                                                    <!-- Label de registro con llamada al modal -->
                                                    
                                                        <input type="checkbox" name="terminos" tabinde="7"
                                                            >
                                                            <b>Acepto Terminos</b>
                                                    </label>
                                                </div>

                                        <div class="col-sm-3">
                                                    <!-- Label de registro con llamada al modal -->
                                                    
                                                    <u><strong  onclick="mostrarTerminos()">Ver Términos y Condiciones</strong></u>
                                                     
                                                </div>

                                                <div class="col-sm-6">
                                                <b> Al Registrarme Estoy Aceptando Los Terminos y Condiciones
                                                    Acordados Por Esta Pagina Incluyendo el uso de las Cookies.</b>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-danger">Registrar</button>
                                            </div>
                                            
                                           
                                        </form>
                                        <style>
    .align-right {
        text-align: right;
    }
</style>

<div class="align-right">
<a class="btn btn-primary" href="login.php">Inicia Sesión</a>
</div>

                                    </div>
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal de Términos y Condiciones -->
    <div class="modal fade" id="modalTerminos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Términos y Condiciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p><strong>1. Aceptación de Términos y Condiciones</strong></p>
                <p>Al acceder y utilizar los servicios ofrecidos por SneakerShore, aceptas los siguientes términos y condiciones. Si no estás de acuerdo con alguno de los aspectos detallados a continuación, te recomendamos que no utilices nuestros servicios.</p>
                <!-- Agrega aquí el resto de los puntos -->
                <p><strong>2. Uso Apropiado del Sitio</strong></p>
                <p>SneakerShore ofrece una plataforma en línea para la compra de zapatillas y productos relacionados. Al utilizar nuestro sitio, te comprometes a hacerlo de manera ética y legal. No está permitido utilizar nuestros servicios con fines ilegales o no autorizados.</p>
                <!-- Agrega aquí el resto de los puntos -->
                <p><strong>3. Registro de Cuenta</strong></p>
                <p>Para acceder a ciertas funciones de SneakerShore, puede ser necesario que crees una cuenta. Es tu responsabilidad proporcionar información precisa y actualizada durante el proceso de registro. Mantén la confidencialidad de tu información de inicio de sesión y notifícanos de inmediato sobre cualquier uso no autorizado de tu cuenta.</p>
                <!-- Agrega aquí el resto de los puntos -->
                <p><strong>4. Privacidad</strong></p>
                <p>Entendemos la importancia de la privacidad. Consulta nuestra Política de Privacidad para comprender cómo recopilamos, utilizamos y protegemos tus datos personales.</p>
                <!-- Agrega aquí el resto de los puntos -->
                <p><strong>5. Compras y Pagos</strong></p>
                <p>Al realizar una compra en SneakerShore, aceptas proporcionar información precisa y completa relacionada con la transacción. Nos reservamos el derecho de rechazar o cancelar pedidos en cualquier momento por razones como la disponibilidad del producto, errores en la información de precios o cualquier otra razón discrecional.</p>
                <!-- Agrega aquí el resto de los puntos -->
                <p><strong>6. Devoluciones y Reembolsos</strong></p>
                <p>Consulta nuestra política de devoluciones para obtener información detallada sobre cómo manejar devoluciones y solicitar reembolsos.</p>
                <!-- Agrega aquí el resto de los puntos -->
                <p><strong>7. Propiedad Intelectual</strong></p>
                <p>Todos los derechos de propiedad intelectual relacionados con los servicios de SneakerShore, incluyendo pero no limitado a marcas registradas, nombres comerciales, logotipos y contenido, son propiedad exclusiva de SneakerShore. No se permite la reproducción, distribución o modificación no autorizada de dicho contenido.</p>
                <!-- Agrega aquí el resto de los puntos -->
                <p><strong>8. Modificaciones en Términos y Condiciones</strong></p>
                <p>Nos reservamos el derecho de actualizar y modificar estos términos y condiciones en cualquier momento. Las modificaciones entrarán en vigor tan pronto como se publiquen en el sitio. Es tu responsabilidad revisar regularmente estos términos para estar al tanto de cualquier cambio.</p>
                <!-- Agrega aquí el resto de los puntos -->
                <p><strong>9. Comunicación</strong></p>
                <p>Al utilizar nuestros servicios, aceptas recibir comunicaciones, incluyendo correos electrónicos, relacionadas con tu cuenta y promociones. Puedes optar por no recibir comunicaciones promocionales en cualquier momento.</p>
                <!-- Agrega aquí el resto de los puntos -->

                <p><strong>10. Ley Aplicable</strong></p>
                <p>Estos términos y condiciones se rigen por las leyes del lugar donde SneakerShore tiene su sede principal. Cualquier disputa derivada de estos términos estará sujeta a la jurisdicción exclusiva de los tribunales competentes en esa ubicación.</p>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ... Código posterior ... -->

    <script>
    function mostrarTerminos() {
        // Muestra el modal de términos y condiciones
        var modal = new bootstrap.Modal(document.getElementById('modalTerminos'));
        modal.show();
    }

    function aceptarTerminos() {
        // Marcamos la casilla de aceptación al aceptar términos
        document.getElementById('aceptoTerminos').checked = true;
        // Cerrar el modal
        var modal = new bootstrap.Modal(document.getElementById('modalTerminos'));
        modal.show();
    }
    </script>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>