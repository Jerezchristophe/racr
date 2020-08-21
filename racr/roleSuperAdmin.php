<?php

if(isset($_SERVER['HTTP_REFERER'])){
    if($_SESSION['PROFILE']['idRole'] != 2){// si le role de la session en cour est différent du role super admin
        $url=$_SERVER['HTTP_REFERER'];
        header("location:$url");//// on reste sur la meme page
    }
}else{
    session_destroy();
    header("location:../index.php");
}
?>