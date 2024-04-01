<?php
define("CLIENT_ID", "AXc1S76V8UvVwtTkocBtikqo11TPhLeG6TFlPN9h_ETOCPPh3ASMFpXCPnaFrLGAXdmttYoCXXjqEy2O");
define("CURRENCY", "MXN");
define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA", "$");

session_start(); 
//if (!isset($_SESSION['usuario'])) {
//    header("location:index.php");
  //}

$num_cart = 0;
if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>