<?php
if ($_POST) {
    try {
        if (
            !empty($_POST['productName']) &&
            !empty($_POST['description']) &&
            !empty($_POST['dateSelect']) &&
            !empty($_POST['id'])
        ) {
            $modificarProducto = new RepositoryBdd();
            $blobFotoProducto = file_get_contents($_FILES['imagenProd']['tmp_name']);
            $modificarProducto->ejecutarModificacionRegistro(
                $_POST['id'],
                $_POST['productName'],
                $_POST['description'],
                date_format(date_create($_POST['dateSelect']), 'Y-m-d H:i:s'),
                $blobFotoProducto
            );
            header("Location:/crudmaestros/panelprincipal.php");
        }
    } catch (\Throwable $th) {
        //si el input file viene vacio, este atrapa la excepción
        header("Location:/crudmaestros/panelprincipal.php");
        throw $th;
    }
}
