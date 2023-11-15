 <?php include ("../config/bd.php");?>



<?php
$input_usuario = (isset($_POST['usuario']))?$_POST['usuario']:"";
$input_pass = (isset($_POST['password']))?$_POST['password']:"";
$input_gmail = (isset($_POST['mail']))?$_POST['mail']:"";
$input_tel = (isset($_POST['tel']))?$_POST['tel']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";
switch($accion){
    case "agregar":
        $secuenciaSQL = $conn->prepare("INSERT INTO usuarios (nombre, contra, gmail, tel) VALUES  (:usuario, :pass, :gmail, :tel)");
        $secuenciaSQL->bindParam(':usuario', $input_usuario);
        $secuenciaSQL->bindParam(':pass', $input_pass);
        $secuenciaSQL->bindParam(':gmail', $input_gmail);
        $secuenciaSQL->bindParam(':tel', $input_tel);
              $secuenciaSQL->execute();
        break;
    }
?>
<link rel="stylesheet" href="../../src/bootstrap.min.css">

<div class="container">
        <div class="row">
            <div class="col-md-4">
            <br><br><br>                
            <div class="card">
                <div class="card-header text-center">
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

                    <div class="form-group">
                    <label>Gmail:</label>
                    <input required type="gmail" class="form-control" name="mail" placeholder="Escribe tu contraseña">
                    </div>

                    <br> 
                    <div class="form-group">
                    <label>Telefono:</label>
                    <input required type="number" class="form-control" name="telefono" placeholder="Escribe tu contraseña">
                    </div>

                    <br>
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary" name="accion" value="agregar">Registrar admin</button>
                    </div>
                    </form>
                    
                    

                </div>
                </div>    
                </div>    
                </div>    
        