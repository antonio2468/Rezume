<?php

require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];

if(!empty($_POST)){
  
  $email = trim($_POST['email']);



  if (esNulo([$email])){
    $errors []= "Debes LLenar Todos los Campos";
  }
  if (!esEmail($email)){
    $errors []= "La Direccion de Correo no es Valida";
  }

  if (count($errors) == 0){
    if(emailExiste($email, $con)){

      $sql = $con->prepare("SELECT usuarios.id, clientes.nombres FROM usuarios INNER JOIN clientes ON usuarios.id_cliente=clientes.id
      WHERE clientes.email LIKE ? LIMIT 1");
      $sql->execute([$email]);
      $row = $sql->fetch(PDO::FETCH_ASSOC);
      $user_id = $row['id'];
      $nombres = $row['nombres'];


      $token = solicitaPassword($user_id, $con);
      if($token !== null){

        require 'clases/Mailer.php';
        $mailer=new Mailer();
        $url = "http://localhost/rezume1/" . 'reset_password.php?id='. $user_id .'&token='.$token;

        $asunto = "Recuperar Password - Tienda Online";
        $cuerpo = "Estimado $nombres: <br> Si has Solicitado el Cambio de Tu Contraseña da click en el 
        Siguiente Link <a href='$url'>$url</a>.";
        $cuerpo .= "<br>Si no Hiciste esta Solicitud Puedes Ignorar este Correo.";


        if($mailer->enviarEmail($email, $asunto, $cuerpo)){
          echo "<p><b>Correo Enviado</b></p>";
          echo "<p>Hemos Enviado un Correo Electronico a la direccion $email para Restablecer la Contraseña.</p>";

          exit;
        }
      }
    }
    else{
      $errors[] = "No Existe una Cuenta Asociada a esta Direccion de Correo Electronico";
    }
  }

}
?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/registro.css">
    <link rel="stylesheet" href="public/css/login.css">
    <title>Recupera Contraseña</title>
  </head>
  <body class="container bg-fondo">
    
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Recuperar Contraseña</h5>


            <form action="recupera.php" method="post" class="row g-3" autocomplete="off">


            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email"
                placeholder="juan@gmail.com" required autofocus>
                <label for="email">Email</label>
              </div>

              
              <div class="d-grid mb-2">
                <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase" type="submit">Continuar</button>
              </div>

			  <div class="form-floating mb-3">
                <div class="text-center">
					¿No Tienes Cuenta?
					<br>
                    <a class="small" href="registro.php">Registrate Aqui</a>
                  </div>
                </div>


              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
  </body>
</html>