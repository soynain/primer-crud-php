<?php
session_start();
require_once "../CrudMaestros/Repository/RepositoryBdd.php";
require_once "./Controller/AltaProducto.php"; //POST ALTA
require_once "./Controller/BajaProducto.php"; //GET BAJA
require_once "./auth/logout.php"; //GET LOGOUT

$consultaProductos = new RepositoryBdd();
/*se consultan los datos de las tablas*/
$resultadosConsultaProductos = $consultaProductos->ejecutarConsulta();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <title>Panel principal</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white">Crud Productos</a>
            <a class="nav-item text-white" href="/crudmaestros/auth/logout.php?salir">Salir</a>
            <p class="nav-item text-white"><?php echo "Bienvenido " . $_SESSION['usuario'] ?></p>
        </div>
    </nav>
    <div class="container-fluid d-flex justify-content-center mt-4 mb-4">
        <div class="card w-75">
            <h5 class="card-header">Agregar nuevo producto</h5>
            <div class="card-body">
                <form action="panelprincipal.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nombre del producto: </label>
                        <input required name="productName" type="text" class="form-control" id="productName" placeholder="Introduce el nombre del producto">
                        <label for="description" class="form-label">Descripción del producto: </label>
                        <textarea required style="resize: none;" name="description" type="text" class="form-control" id="description" placeholder="Introduce la descripción del producto: "></textarea>
                        <label for="dateSelect" class="form-label">Fecha de alta: </label>
                        <input required name="dateSelect" type="text" class="form-control" onfocus="(this.type='date')" id="dateSelect" placeholder="Selecciona la fecha deseada: ">                     
                        <label for="formFile" class="form-label">Selecciona la imagen de tu producto: </label>
                        <input required name="imagenProd" class="form-control" type="file" id="formFile">
                        <input type="submit" class="btn btn-primary mt-4" value="Registrar nuevo producto">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-center">
        <table class="table table-striped w-75 border border-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha alta</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($resultadosConsultaProductos)) { ?>
                    <?php foreach ($resultadosConsultaProductos as $producto) { ?>
                        <tr>
                            <th scope="row"><?php echo $producto['id'] ?></th>
                            <td><?php echo $producto['nombre'] ?></td>
                            <td class="text-break w-25"><?php echo $producto['descripcion'] ?></td>
                            <td><?php echo date_format(date_create($producto['fechaAlta']), 'd/M/Y') ?></td>
                            <td class="w-25"><?php echo "<img onContextMenu='return false;' style='width:auto; height:95px;' src='data:image/jpeg;base64," . base64_encode($producto['imagen']) . "' />"; ?></td>
                            <td><a class="btn btn-success" href="/crudmaestros/modificarProducto.php?modificar=<?php echo $producto['id'] ?>">Modificar</a>
                                <a href="/crudmaestros/panelprincipal.php?borrar=<?php echo $producto['id'] ?>" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <th scope="row" colspan="6" class="text-center">No hay productos registrados aun</th>
                <?php } ?>
            </tbody>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>