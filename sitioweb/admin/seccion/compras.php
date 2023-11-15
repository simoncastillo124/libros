<?php include("../template/cabecera.php"); ?>
<?php include("../config/bd.php");

$secuenciaSQL = $conn->prepare("SELECT * FROM compras");
$secuenciaSQL->execute();
$compra = $secuenciaSQL->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

    if ($accion === "borrar") {
        $libro_id = (isset($_POST['libro_id'])) ? $_POST['libro_id'] : "";
        $libro_nombre = (isset($_POST['libro_nombre'])) ? $_POST['libro_nombre'] : "";

        $consultaSQL = $conn->prepare("DELETE FROM compras WHERE ID = :libro_id AND nombre = :libro_nombre");
        $consultaSQL->bindParam(':libro_id', $libro_id);
        $consultaSQL->bindParam(':libro_nombre', $libro_nombre);
        $consultaSQL->execute();
        header("Location: compras.php");
    }
}
?>

<link rel="stylesheet" href="../../src/bootstrap.min.css">
<div class="col-md-3"></div>
<div class="col-md-6 align-items-center">
    <div class="table-responsive text-center">
        <table class="table table-light bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($compra as $libro) { ?>
                    <tr>
                        <td><?php echo $libro['ID']; ?></td>
                        <td><?php echo $libro['nombre']; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="libro_id" value="<?php echo $libro['ID']; ?>">
                                <input type="hidden" name="libro_nombre" value="<?php echo $libro['nombre']; ?>">
                                <input type="submit" name="accion" value="borrar" class="btn btn-outline-secondary">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include("../template/pie.php"); ?>
