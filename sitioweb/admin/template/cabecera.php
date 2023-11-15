<?php
session_start();
if(!isset($_SESSION['usuario'])){
  header("Location:../index.php");
}else{
  if($_SESSION['usuario']=="ok"){
    $user=$_SESSION["nombreusuario"];
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./../src/bootstrap.min.css">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js" ></script>
  </head>
  <body>

<?php $url = "HTTP://".$_SERVER['HTTP_HOST']."/sitioweb"?>

<nav class="navbar navbar-expand navbar-dark bg-primary">
    <div class="nav navbar-nav mx-auto">
        <a  readonly class="nav-item nav-link position-absolute bottom-10 start-0" aria-current="page"><span class="iconify" data-icon="clarity:administrator-solid" data-width="50"></span></a>
        <h3>
        <a class="nav-item nav-link" href="<?php echo $url ?>/admin/inicio.php">Inicio</a>
        </h3>
        <h3>
        <a class="nav-item nav-link" href="<?php echo $url ?>/admin/seccion/productos.php">Administrador de libros</a>
        </h3>
        <h3>
        <a class="nav-item nav-link" href="<?php echo $url ?>/admin/seccion/compras.php">Compras</a> 
        </h3>
        <h3>
        <a class="nav-item nav-link" href="<?php echo $url ?>/admin/seccion/register.php">Registro de admin</a> 
        </h3>
        <h3>
        <a class="nav-item nav-link" href="<?php echo $url ?>">Ver sitio web</a> 
        </h3>
        <a class="nav-item nav-link position-absolute bottom-10 end-0" href="<?php echo $url ?>/admin/seccion/cerrar.php"><span class="iconify" data-icon="el:off" data-width="35"></span></a>
    </div>
</nav>
<div class="container">
<br>
    <div class="row">
