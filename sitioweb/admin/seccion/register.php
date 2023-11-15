<?php include ("../config/bd.php");?>
<?php include ("../template/cabecera.php");?>



<?php
$txtnombre = (isset($_POST['usuario']))?$_POST['usuario']:"";
$txtpass = (isset($_POST['password']))?$_POST['password']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";
switch($accion){
    case "agregar":
        $secuenciaSQL = $conn->prepare("INSERT INTO administrador (usuario, pass) VALUES  (:nombre, :pass)");
        $secuenciaSQL-> bindParam(':nombre',$txtnombre);
        $secuenciaSQL-> bindParam(':pass',$txtpass);
        $secuenciaSQL->execute();
        break;
    }
?>
<link rel="stylesheet" href="../../src/bootstrap.min.css">

<div class="container">
    <div class="row">
        <!-- Columna para el formulario -->
        <div class="col-md-5">
            <br><br><br>
            <div class="card">
                <div class="card-header text-center">
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Nuevo usuario:</label>
                                <input required type="text" class="form-control" name="usuario" aria-describedby="emailHelp" placeholder="Escribe tu usuario">
                            </div>
                            <br>
                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input required type="password" class="form-control" name="password" placeholder="Escribe tu contraseña">
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
<?php
$secuenciaSQL = $conn->prepare("SELECT * FROM usuarios");
$secuenciaSQL->execute();
$usuarios = $secuenciaSQL->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

    if ($accion === "borrar") {
        $usuario_id = (isset($_POST['usuario_id'])) ? $_POST['usuario_id'] : "";
        $usuario_nombre = (isset($_POST['usuario_nombre'])) ? $_POST['usuario_nombre'] : "";

        $consultaSQL = $conn->prepare("DELETE FROM usuarios WHERE nombre = :usuario_id");
        $consultaSQL->bindParam(':usuario_id', $usuario_id);
        $consultaSQL->execute();
        header("Location: usuarios.php");
    }
}
?>
<div class="col-md-7 mt-5">
<h1 class="text-center">Registro de Usuarios</h1>
            <div class="table-responsive text-center">
                <table class="table table-light border">
                    <thead>
                        <tr>
                            <th scope="col">Nombre de Usuario</th>
                            <th scope="col">Contraseña</th>
                            <th scope="col">Gmail</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario) { ?>
                            <tr>
                                <td><?php echo $usuario['nombre']; ?></td>
                                <td><?php echo $usuario['contra']; ?></td>
                                <td><?php echo $usuario['gmail']; ?></td>
                                <td><?php echo $usuario['tel']; ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="usuario_nombre" value="<?php echo $usuario['nombre']; ?>">
                                        <input type="submit" name="accion" value="borrar" class="btn btn-outline-secondary">
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include("../template/pie.php"); ?>

