<?php
    if($_GET){
        if(isset($_GET['borrar'])){
            $eliminarRegistro=new RepositoryBdd();
            $eliminarRegistro->ejecutarEliminacionRegistro($_GET['borrar']);
        }
        header("Location:/crudmaestros/panelprincipal.php");
    }
?>