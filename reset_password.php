<?php

require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';

$user_id = $_GET['id'] ?? $_POST['user_id'] ?? '';
$token = $_GET['token'] ?? $_POST['token'] ?? '';

if($user_id == '' || $token == ''){
    header("Location: cliente_inicio.php");
    exit;
}


$db = new Database();
$con = $db->conectar();

$errors = [];

if(!verificaTokenRequest($user_id, $token, $con)){

    echo"No se Pudo Verificar la Informacion";
    exit;
}


if(!empty($_POST)){
  
  $password = trim($_POST['password']);
  $repassword = trim($_POST['repassword']);



  if (esNulo([$user_id, $token, $password, $repassword])){
    $errors []= "Debes LLenar Todos los Campos";
  }

  

  if (!validaPassword($password, $repassword)){
    $errors []= "Las Contraseñas no Coinciden";
  }


if(count($errors) == 0){
  $pass_hash = password_hash($password, PASSWORD_DEFAULT);
  if(actualizaPassword($user_id, $pass_hash, $con)){
    echo "Contraseña Modificada.<br> <a href='login.php'>Iniciar Sesion </a>";
    exit;
  } else {
    $errors[] = "Error al Modificar Contraseña. Intentalo Nuevamente. ";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/registro.css">
	

</head>
<body data-spy="scroll" data-target="#pb-navbar" data-offset="200">



	<!--Contenido-->
  <div class="container-fluid ps-md-0 bg-fondo" >
  <div class="row g-0">
    <div class="d-none d-md-flex col-md-6 col-lg-4 "></div>
    <div class="col-md-6 col-lg-3">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
  <main class="form-login m-auto pt-4">
 
    <h2>Cambiar Contraseña</h2>

    <?php mostrarMensajes($errors); ?>
    
        <form class="row g-3" action="reset_password.php" method="post" autocomplete="off">

        <input type="hidden" name="user_id" id="user_id" value="<?= $user_id; ?>" />
        <input type="hidden" name="token" id="token" value="<?= $token; ?>" />

        <div class="form-floating">
            <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña">
            <label for="password">Contraseña</label>
          </div>

          <div class="form-floating">
            <input class="form-control" type="password" name="repassword" id="repassword" placeholder="Confirmar Contraseña">
            <label for="password">Repetir Contraseña</label>
          </div>


          <div class="d-grid gap-3 col-12">
            <button type="submit" class="btn btn-primary">Cambiar</button>  
          </div>

          <hr>

          <div class="col-12">
            ¿No Tienes Cuenta? <a href="registro.php">Registrate Aqui</a>  
          </div>



            
</form>

    </main>
    </div>
  </div>
</div>



    </body>
    </html>