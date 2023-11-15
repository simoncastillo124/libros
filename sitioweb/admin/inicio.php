 <?php include("template/cabecera.php");?>
        <div class="col-md-12">
            

            <div class="jumbotron">
            <h1 class="display-3">bienvenido <?php echo $user; ?></h1>
            <p class="lead">Administración de libros en el sistema.</p>
            <hr class="my-2">
            <p class="lead">
            <a class="btn btn-primary btn-lg" href="seccion/productos.php" role="button">Deposito de libros</a>
            <a class="btn btn-primary btn-lg" href="seccion/compras.php" role="button">Compras efectuadas</a>
            </p>
            </div>

        </div>
<?php include("template/pie.php");?> 
