<?php include("template/cabecera.php");?>
<?php include ("admin/config/bd.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] == 'agregar') {

    if (isset($_POST['libro_nombre'])) {
        $libro_nombre = $_POST['libro_nombre'];

        $consultaSQL = $conn->prepare("INSERT INTO compras (ID, nombre) VALUES (:libro_id, :libro_nombre)");
        $consultaSQL->bindParam(':libro_id', $libro_id, PDO::PARAM_INT);
        $consultaSQL->bindParam(':libro_nombre', $libro_nombre, PDO::PARAM_STR);
        $consultaSQL->execute();
    }
}


$secuenciaSQL = $conn->prepare("SELECT * FROM libros");
$secuenciaSQL->execute();
$listalibros = $secuenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
<?php foreach($listalibros as $libro) {?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      .slide-in-elliptic-bottom-fwd {
	-webkit-animation: slide-in-elliptic-bottom-fwd 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
	        animation: slide-in-elliptic-bottom-fwd 0.7s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
}
@-webkit-keyframes slide-in-elliptic-bottom-fwd {
  0% {
    -webkit-transform: translateY(600px) rotateX(30deg) scale(0);
            transform: translateY(600px) rotateX(30deg) scale(0);
    -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0) rotateX(0) scale(1);
            transform: translateY(0) rotateX(0) scale(1);
    -webkit-transform-origin: 50% -1400px;
            transform-origin: 50% -1400px;
    opacity: 1;
  }
}
@keyframes slide-in-elliptic-bottom-fwd {
  0% {
    -webkit-transform: translateY(600px) rotateX(30deg) scale(0);
            transform: translateY(600px) rotateX(30deg) scale(0);
    -webkit-transform-origin: 50% 100%;
            transform-origin: 50% 100%;
    opacity: 0;
  }
  100% {
    -webkit-transform: translateY(0) rotateX(0) scale(1);
            transform: translateY(0) rotateX(0) scale(1);
    -webkit-transform-origin: 50% -1400px;
            transform-origin: 50% -1400px;
    opacity: 1;
  }
}
    </style>
</head>
<body>
    
</body>
</html>

<div class="col-md-3 text-center">
    <div class="card h-100">
    <img class="card-img-top" src="./img/<?php echo $libro['imagen']?>" alt="">

        <div class="card-body">
        <h4 class="card-title"><?php echo $libro['nombre']?></h4>
        <form method="post" action="">
                <input type="hidden" name="libro_nombre" value="<?php echo $libro['nombre']?>">
                <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
            </form>
        </div>
    </div>
</div>
<?php } ?>
 <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] == 'agregar') {
                      echo '<div id="mensaje-compra" class="slide-in-elliptic-bottom-fwd position-absolute alert alert-dismissible alert-success text-center" role="alert" style="max-width: 1300px">';
                      echo '<strong>Su compra fue realizada con exito!</strong>';
                      echo '</div>';
                    } ?>

<?php include("template/pie.php");?>