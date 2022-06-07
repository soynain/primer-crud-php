<?php
session_start();
require_once "./Repository/RepositoryBdd.php";
require_once "./Controller/ModificacionProducto.php";
if ($_GET) {
    if (isset($_GET['modificar'])) {
       // echo $_GET['modificar'] . "</br>";
        $consultaParaModificar = new RepositoryBdd();
        $resultadoConsultaAModificar = $consultaParaModificar->getConexion()->prepare("select * from alta_producto where id=?");
        $resultadoConsultaAModificar->bindParam(1, $_GET['modificar']);
        //    $resultadoConsultaAModificar->setFetchMode(PDO::FETCH_ASSOC);
        try {
            //obtener consulta, recuerda que para tener una fila debes asignar el fetch all a una variable
            $resultadoConsultaAModificar->execute();
            $arrayValoresConsulta = $resultadoConsultaAModificar->fetchAll();
          //  print_r($arrayValoresConsulta[0]['nombre']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/style.css">
    <title>Modificar</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white">Crud Productos</a>
            <a class="nav-item text-white" href="/crudmaestros/panelprincipal.php">Regresar</a>
            <p class="nav-item text-white"><?php echo "Bienvenido ".$_SESSION['usuario'] ?></p>
        </div>
    </nav>
    <div class="container-fluid d-flex justify-content-center mt-4 mb-4">
        <div class="card w-75">
            <h5 class="card-header">Agregar nuevo producto</h5>
            <div class="card-body">
               
                <form action="modificarProducto.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                    <input type="hidden" name="id" value='<?php echo $arrayValoresConsulta[0]['id'] ?>'>
                        <label for="productName" class="form-label">Nombre del producto: </label>
                        <input required value='<?php echo $arrayValoresConsulta[0]['nombre'] ?>' name="productName" type="text" class="form-control" id="productName">
                        <label for="description" class="form-label">Descripción del producto: </label>
                        <textarea required style="resize: none;" name="description" type="text" class="form-control" id="description"><?php echo $arrayValoresConsulta[0]['descripcion'] ?></textarea>
                        <label for="dateSelect" class="form-label">Fecha de alta: </label>
                        <input required value='<?php echo date_format(date_create($arrayValoresConsulta[0]['fechaAlta']),'d/m/Y') ?>' name="dateSelect" type="text" class="form-control" onfocus="(this.type='date')" id="dateSelect">
                        <label for="formFile" class="form-label">Selecciona la imagen de tu producto: </label>
                        <input required name="imagenProd" class="form-control" type="file" id="formFile">
                        <input type="submit" class="btn btn-primary mt-4" value="Actualizar producto">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>