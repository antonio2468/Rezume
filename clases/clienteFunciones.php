<?php


function esNulo(array $parametos){
    foreach($parametos as $parameto){
        if(strlen(trim($parameto)) < 1){
            return true;
        }
    }
    return false;
}



function esEmail($email){
  if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
    }
    return false;
}


function validaPassword($password, $repassword){
    if(strcmp($password, $repassword) === 0){
        return true;
    }
      return false;
  }




function generaToken(){
    return md5(uniqid(mt_rand(), false));
}
function registraCliente(array $datos, $con)
{
    $sql = $con->prepare("INSERT INTO clientes (nombres, apellidos, email, telefono, dni, estatus, fecha_alta) VALUES
    (?,?,?,?,?, 1, now())");
    if($sql->execute($datos)){
        return $con->lastInsertId();
    }
    return 0;
}


function registraUsuario(array $datos, $con)
{
    $sql = $con->prepare("INSERT INTO usuarios (usuario, password, token, id_cliente) VALUES (?,?,?,?)");
    if($sql->execute($datos)){
        return $con->lastInsertId();
    }
    return 0;
}



function usuarioExiste($usuario, $con)
{
    $sql = $con->prepare("SELECT id FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    if($sql->fetchColumn() > 0){
        return true;
    }
    return false;
}


function validar_clave($password,$con){
    if(strlen($password) < 6){
        $errors [] = "La clave debe tener al menos 6 caracteres";
       return false;
    }
    if(strlen($password) > 16){
        $errors [] = "La clave no puede tener más de 16 caracteres";
       return false;
    }
    if (!preg_match('`[a-z]`',$password)){
        $errors [] = "La clave debe tener al menos una letra minúscula";
       return false;
    }
    if (!preg_match('`[A-Z]`',$password)){
        $errors [] = "La clave debe tener al menos una letra mayúscula";
       return false;
    }
    if (!preg_match('`[0-9]`',$password)){
        $errors [] = "La clave debe tener al menos un caracter numérico";
       return false;
    }
    $errors [] = "";
    return true;
 }


function emailExiste($email, $con)
{
    $sql = $con->prepare("SELECT id FROM clientes WHERE email LIKE ? LIMIT 1");
    $sql->execute([$email]);
    if($sql->fetchColumn() > 0){
        return true;
    }
    return false;
}


function mostrarMensajes(array $errors)
{
    if(count($errors) > 0) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"><ul>';
        foreach($errors AS $error){
            echo '<li>'. $error . '</li>'; 
        }
        echo '<ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

    }
}



function validaToken($id, $token, $con)
{
    $msg = "";
    $sql = $con->prepare("SELECT id FROM usuarios WHERE id = ? and token LIKE ? LIMIT 1");
    $sql->execute([$id, $token]);
    if($sql->fetchColumn() > 0){
       if(activarUsuario($id, $con)){
        $msg = "Cuenta Activada.";
       }else{
        $msg = "Error al Activar la Cuenta.";
       }
    }else{
        $msg = "No Existe el Registro del Cliente.";
    }
    return $msg;
}

function activarUsuario($id, $con){
    $sql = $con->prepare("UPDATE usuarios SET activacion = 1,  token = '' WHERE id = ?");
    return $sql->execute([$id]);
}



function login($usuario, $password, $con)
{
    $sql = $con->prepare("SELECT id, usuario, password FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    if($row =  $sql->fetch(PDO::FETCH_ASSOC)){
        if(esActivo($usuario, $con)){
            if(password_verify($password, $row['password'])){

                if($row ['usuario'] == 'admin'){
                    $_SESSION['user_id'] = $row ['id'];
                    $_SESSION['user_name'] = $row ['usuario'];
                    header("Location: admin_inicio.php");
                    exit;
                }else {
                    $_SESSION['user_id'] = $row ['id'];
                    $_SESSION['user_name'] = $row ['usuario'];
                    header("Location: cliente_inicio.php");
                    exit;
                }

                    
            }
        } else {
            return 'El Usuario no ha sido Activado.';
        }

    }
    return 'El Usuario y/o Contraseña Son Incorrectos.';
}


function esActivo($usuario, $con)
{
    $sql = $con->prepare("SELECT activacion FROM usuarios WHERE usuario LIKE ? LIMIT 1");
    $sql->execute([$usuario]);
    $row =  $sql->fetch(PDO::FETCH_ASSOC);
    if($row ['activacion'] == 1){
        return true;
    }
    return false;
}


function solicitaPassword($user_id, $con){
    $token = generaToken();
    $sql = $con->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE id = ?");
    if($sql->execute([$token, $user_id])){
        return $token;
    }
    return null;
}


function verificaTokenRequest($user_id, $token, $con){
    $sql = $con->prepare("SELECT id FROM usuarios WHERE id = ? AND token_password LIKE ? AND password_request = 1 LIMIT 1");
    $sql->execute([$user_id, $token]);
    if($sql->fetchColumn() > 0){
        return true;
    }
    return null;
}

function actualizaPassword($user_id, $password, $con){
    $sql = $con->prepare("UPDATE usuarios SET password=?, token_password = '', password_request
    = 0 WHERE id = ?");
    if($sql->execute([$password, $user_id])){
        return true;
    }
    return false;
}



?>