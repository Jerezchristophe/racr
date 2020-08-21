<?php 

function connexion(){
try 
{
    $strConnection = 'mysql:host=localhost;dbname=racr';
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
     $co = new PDO($strConnection, '', '', $options);
    $co -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $co;
}

catch (PDOException $e){
    echo 'Erreur:' . $e->getMessage();
    //le point . signifie la concaténation
    //$e->getMessage() c'est le message d'erreur
}
}
?>