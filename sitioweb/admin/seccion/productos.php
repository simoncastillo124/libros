<?php include("../template/cabecera.php");?>
<link rel="stylesheet" href="../../src/bootstrap.min.css">

<?php

//buscar los datos
$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtnombre = (isset($_POST['txtnombre']))?$_POST['txtnombre']:"";
$txtfoto = (isset($_FILES['txtfoto']['name']))?$_FILES['txtfoto']['name']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

//conexión SQL insta
include("../config/bd.php");

//Funcionalidad CRUD de los botones 
switch($accion){
    case "agregar":

        //agrega los valores a la BD
        $secuenciaSQL = $conn->prepare("INSERT INTO libros (nombre, imagen) VALUES  (:nombre, :imagen)");
        $secuenciaSQL-> bindParam(':nombre',$txtnombre);

        //inserta una fecha para no confundir imagenes
        $fecha = new DateTime();
        $nombrearchivo = ($txtfoto!="")?$fecha->getTimestamp()."_".$_FILES["txtfoto"]["name"]:"imagen.jpg";

        //agrega la imagen en la carpeta img
        $tmpimg=$_FILES["txtfoto"]["tmp_name"];
        if($tmpimg!=""){

            move_uploaded_file($tmpimg,"../../img/".$nombrearchivo);
        }

        $secuenciaSQL-> bindParam(':imagen',$nombrearchivo);        
        $secuenciaSQL->execute();
        header("Location:productos.php");
        break;
        case "modificar":
            // Actualiza los parámetros
            $secuenciaSQL = $conn->prepare("UPDATE libros SET nombre=:nombre WHERE ID=:id");
            $secuenciaSQL->bindParam(':nombre', $txtnombre);
            $secuenciaSQL->bindParam(':id', $txtID);
            $secuenciaSQL->execute();
        
            // Actualiza la foto solo si se proporciona un nuevo archivo
            if ($txtfoto!="") {
                $fecha = new DateTime();
                $nombrearchivo = $fecha->getTimestamp() . "_" . $_FILES["txtfoto"]["name"];
                $tmpimg = $_FILES["txtfoto"]["tmp_name"];

                
                move_uploaded_file($tmpimg, "../../img/" . $nombrearchivo);
        
                // Borra la imagen antigua si existe
                $secuenciaSQL = $conn->prepare("SELECT imagen FROM libros WHERE ID=:id");
                $secuenciaSQL->bindParam(':id', $txtID);
                $secuenciaSQL->execute();
                $libro = $secuenciaSQL->fetch(PDO::FETCH_LAZY);
                if (isset($libro["imagen"]) && ($libro["imagen"] != "imagen.jpg")) {
                    if (file_exists("../../img/" . $libro["imagen"])) {
                        unlink("../../img/" . $libro["imagen"]);
                    }
                }
        
                // Actualiza la imagen en la base de datos
                $secuenciaSQL = $conn->prepare("UPDATE libros SET imagen=:imagen WHERE ID=:id");
                $secuenciaSQL->bindParam(':imagen', $nombrearchivo);
                $secuenciaSQL->bindParam(':id', $txtID);
                $secuenciaSQL->execute();
            }
            header("Location:productos.php");
            break;    
        case "cancelar":
        header("Location:productos.php");
        break;
        case "seleccionar":
            //selecciona un campo
            $secuenciaSQL = $conn->prepare("SELECT * FROM libros WHERE ID=:id");
            $secuenciaSQL-> bindParam(':id',$txtID);
            $secuenciaSQL->execute();
            $libro = $secuenciaSQL->fetch(PDO::FETCH_LAZY);
            
            $txtnombre = $libro['nombre'];
            $txtfoto = $libro['imagen'];
            break;
        case "borrar":
            //borra la imagen de la carpeta
            $secuenciaSQL = $conn->prepare("SELECT imagen FROM libros WHERE ID=:id");
            $secuenciaSQL-> bindParam(':id',$txtID);
            $secuenciaSQL->execute();
            $libro = $secuenciaSQL->fetch(PDO::FETCH_LAZY);

            if(isset($libro["imagen"]) && ($libro["imagen"]!="imagen.jpg")){
                if (file_exists("../../img/".$libro["imagen"])){
                    unlink("../../img/".$libro["imagen"]);
                }
            }
            //borra los datos de la tabla
            $secuenciaSQL = $conn->prepare("DELETE FROM libros WHERE ID=:id");
            $secuenciaSQL-> bindParam(':id',$txtID);
            $secuenciaSQL-> execute();
            header("Location:productos.php");
            break;
}

$secuenciaSQL = $conn->prepare("SELECT * FROM libros");
$secuenciaSQL->execute();
$listalibros = $secuenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="col-md-5">


<div class="card">
    <div class="card-header">
        Datos de libro
    </div>
        <div class="card-body">

        <form method="POST" enctype="multipart/form-data">      
                <div class = "form-group">
                <label for="txtID">ID:</label>
                <input type="text" class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID" placeholder="ID" readonly>
                </div>

                <label for="txtnombre">Nombre:</label>
                <input type="text" required class="form-control" value="<?php echo $txtnombre;?>" name="txtnombre" id="txtnombre" placeholder="Nombre del libro">

                <label for="txtfoto">Imagen:</label>

                <br>

                <?php if($txtfoto!=""){?>
                <img class="img-thumbnail rounded" src="../../img/<?php echo $txtfoto;?>" width="100" alt="" srcset="">
                <?php } ?>
                

                <input type="file" class="form-control" name="txtfoto" id="txtfoto">
                <br>
                <div class="btn-group" role="group" aria-label="">
                <div class="col-md-5">
                </div>
                <button type="submit" name="accion" <?php echo ($accion=="seleccionar")?"disabled":""; ?> value="agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" <?php echo ($accion!="seleccionar")?"disabled":""; ?> value="modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" <?php echo ($accion!="seleccionar")?"disabled":""; ?> value="cancelar" class="btn btn-info">Cancelar</button>
                </div>    
            </div>
        </form>
    </div>
</div>

<div class="col-md-7 text-center">
    <div class="table-responsive">
        <table class="table table-light table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listalibros as $libro) { ?>
                <tr>
                    <td><?php echo $libro['ID'];?></td>
                    <td><?php echo $libro['nombre'];?></td>
                    <td><img class="img-thumbnail rounded" src="../../img/<?php echo $libro['imagen'];?>" width="100" alt="" srcset=""></td>
                    <td>                    
                    <form method="post">

                    <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['ID'];?>">
                    <input type="submit" name="accion" value="seleccionar" class="btn btn-outline-primary">
                    <input type="submit" name="accion" value="borrar" class="btn btn-outline-secondary">
                </form>
                    
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    
</div>

<?php include("../template/pie.php");?>