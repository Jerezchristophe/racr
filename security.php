<?php
    //Pour accéder a la page des apprenants il faut etre authentifié
    if(!isset($_SESSION['PROFILE'])){// si $_SESSION['PROFILE] n'esiste pas alors on sera dirigé vers la page de connexion
        header('location:../index.php');
    }
?>