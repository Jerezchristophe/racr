<?php
    session_start();
    session_destroy();//on détruit la session en cour
    header('location:index.php');//redirection vers la page d'authentification
?>