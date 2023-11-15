<?php
include ("admin/config/bd.php");

if($_POST){
  session_start();
  $input_usuario = $_POST['usuario'];
  $input_pass = $_POST['password'];

  $secuenciaSQL = $conn->prepare("SELECT * FROM usuarios WHERE nombre=:nombre AND contra=:contra");
  $secuenciaSQL->bindParam(':nombre', $input_usuario);
  $secuenciaSQL->bindParam(':contra', $input_pass);
  $secuenciaSQL->execute();
  $usuario = $secuenciaSQL->fetch(PDO::FETCH_LAZY);

  if ($usuario) {
    $pass = $usuario['contra'];
    $user = $usuario['nombre'];


    if ($input_usuario === $user && $input_pass === $pass) {
      $_SESSION['usuario'] = "ok";
      $_SESSION['nameuser'] = $user;
      header("location: index.php");
    } else {
      $error = "Usuario o contraseña incorrecto";
    }
  } else {
    $error = "Usuario o contraseña incorrecto";
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="src/bootstrap.min.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
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
      <div class="container">
        <div class="row">
        <div class="col-md-4">
        </div>
            <div class="col-md-4">
            <br><br><br>                
            <div class="card">
                <div class="card-header text-center">
                <span class="iconify" data-icon="line-md:login" data-width="60" data-rotate="180deg" data-flip="horizontal,vertical"></span>                </div>
                <div class="card-body">

                    <form method="POST">
                    <div class = "form-group">


                    <label>Usuario:</label>
                    <input required type="text" class="form-control" name="usuario" aria-describedby="emailHelp" placeholder="Escribe tu usuario">
                    </div>

                    <br> 
                    <div class="form-group">
                    <label>Contraseña:</label>
                    <input required type="password" class="form-control" name="password" placeholder="Escribe tu contraseña">
                    </div>

                    

                    <br>
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary">Log in</button>
                    </div>
                    </form>
                    
                    

                </div>
            </div>    
        
        <br>
        <?php
                  if(isset($error)) {
                      echo '<div id="error-message" class="slide-in-elliptic-bottom-fwd alert alert-dismissible alert-danger text-center" role="alert">';
                      echo '<strong>¡Oops! Se ha producido un error:</strong>';
                      echo '<p>' . $error . '</p>';
                      echo '</div>';
                    } ?>
          </div>
        </div>
      </div>
  </body>
  <script>
</script>
</html>