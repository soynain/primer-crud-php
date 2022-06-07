<?php
if ($_POST) {
    //  echo $_POST;
    if (!empty($_POST['us_vbl']) && !empty($_POST['pss_vbl'])) {
        session_start();
        $_SESSION['usuario'] = htmlspecialchars($_POST['us_vbl']);
        $_SESSION['contra'] = $_POST['pss_vbl'];
        header('Location:/crudmaestros/panelprincipal.php');
    }else{
        header('Location:/crudmaestros/public/html/index');
    }
}
