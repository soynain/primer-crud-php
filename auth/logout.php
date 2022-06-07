<?php
if ($_GET) {
    if(isset($_GET['salir'])){
        session_start();
    session_destroy();
    header("Location:/crudmaestros/public/html/index.html");
    }
}
?>
