<?php
if ($_POST) {
    try {
        //   print_r($_POST);
        if (
            !empty($_POST['productName']) &&
            !empty($_POST['description']) &&
            !empty($_POST['dateSelect'])
        ) {
            $blobFotoProducto = file_get_contents($_FILES['imagenProd']['tmp_name']);
            $insertarProducto = new RepositoryBdd();
            $insertarProducto->ejecutarInsercion(
                $_POST['productName'],
                $_POST['description'],
                date_format(date_create($_POST['dateSelect']), 'Y-m-d H:i:s'),
                $blobFotoProducto
            );
        }
        header("Location:/crudmaestros/panelprincipal.php");
    } catch (\Throwable $th) {
        header("Location:/crudmaestros/panelprincipal.php");
        throw $th;
    }
}
