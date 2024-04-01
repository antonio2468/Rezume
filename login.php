<?php

require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';

$db = new Database();
$con = $db->conectar();

$errors = [];
if (!empty($_POST)) {

  $usuario = trim($_POST['usuario']);
  $password = trim($_POST['password']);



  if (esNulo([$usuario, $password])) {
    $errors[] = "Debes LLenar Todos los Campos";
  }

  if (count($errors) == 0) {
    $errors[] = login($usuario, $password, $con);
  }


  if (!esEmail($email)) {
    $errors[] = "La Direccion de Correo no es Valida";
  }





}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Shoes Store</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="public/css/login.css">


</head>

<body data-spy="scroll" data-target="#pb-navbar" data-offset="200">



  <!--Contenido-->
  <div class="container-fluid ps-md-0 bg-fondo">
    <div class="row g-0">
      <div class="d-none d-md-flex col-md-6 col-lg-4 "></div>
      <div class="col-md-6 col-lg-3">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
                <main class="form-login m-auto pt-4">

                  <h2>Iniciar Sesion </h2>

                  <?php mostrarMensajes($errors); ?>

                  <form class="row g-3" action="login.php" method="post" autocomplete="off">

                    <div class="form-floating">
                      <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuario">
                      <label for="usuario">Usuario</label>
                    </div>

                    <div class="form-floating">
                      <input class="form-control" type="password" name="password" id="password"
                        placeholder="Contraseña">
                      <label for="password">Contraseña</label>
                    </div>

                    <div class="col-12">
                      <a href="recupera.php">¿Olvidaste tu Contraseña?</a>
                    </div>

                    <div class="d-grid gap-3 col-12">
                      <button type="submit" class="btn btn-primary">Ingresar</button>
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
        </div>
      </div>
    </div>
  </div>




</body>

</html>