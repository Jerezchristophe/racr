<?php
    if($_SESSION['PROFILE']['idRole'] != 2 AND $_SESSION['PROFILE']['idRole'] != 0){// si le role de la session en cour est différent du role super admin et admin
        session_destroy();
        header("location:../index.php");// on reste sur la meme page
    }
?>