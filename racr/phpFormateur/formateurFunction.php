<?php

    //appel du fichier contenant la connexion a la bdd
    require_once'../connect.php';


    // fonction d'affichage de la tabe formateur 
        function affichageFormateur(){// création de la fonction
            try{                       
                $co=connexion();//connxion a la bdd
                $sql = 'SELECT * FROM `user` WHERE `idRole`=1';//création variable requete sql
                $affichage=$co->prepare($sql);//création de la variable qui fait appel au pdo pour préparer la requete req
                $affichage->execute();//exécution de cette variable
                return $affichage;// on retourne le résultat obtenu pour pouvoir l'utiliser
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;// on arrete la connexion
            }
        }

    // fonction da'affichage d'un seul user
        function affichageEditionUser(){//création de la fonction
            try{
                $co=connexion();//connexion a la bdd
                $id=$_GET['idUser'];
                $sqlEdition = 'SELECT * FROM `user` WHERE `idUser`="'.$id.'"';//création variable requete sql
                $affichageEdition=$co->prepare($sqlEdition);//création de la variable qui fait appel au pdo pour préparer la requete req
                $affichageEdition->execute();//exécution de cette variable
                return $affichageEdition;// on retourne le résultat obtenu pour pouvoir l'utiliser
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();//si le try ne fonctionne pas , on attrape l'erreur pour ensuite l'afficher
            }finally{
                $co=null;//on arrete la connexion
            }
        }

    // Affichage des formations attribuéas aux formateurs
        function affichageFormationAttribué(){
            try{
                $co=connexion();
                $id=$_GET['idUser'];
                $sql='SELECT `en_charge`.*, `formation`.`intituleFormation` FROM `en_charge` LEFT JOIN `formation` ON `en_charge`.`idFormation` = `formation`.`idFormation` WHERE `idUser` = "'.$id.'"';
                $affichageFormation=$co->prepare($sql);
                $affichageFormation->execute();
                return $affichageFormation;
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();//si le try ne fonctionne pas , on attrape l'erreur pour ensuite l'afficher
            }finally{
                $co=null;//on arrete la connexion
            }
        }

    // condition pour faire un insert dans la table formateur
         if(isset($_POST['ajouter'])){//si et seulement si le bouton ajouter est true
            try{          
                if(!empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])){// si les champs ne sont pas null             
                    $co=connexion();//connexion a la bdd  
                    $nom=$_POST['nom'];//on récuprere la value des champs en sécurisant les entrées de code avec htmlspecialchars
                    $email=$_POST['email'];
                    $email2=htmlspecialchars($_POST['email2']);
                    $mdp=$_POST['mdp'];
                    $mdp2=$_POST['mdp2'];
                    $idR=1; 

                    if($email == $email2){// on vérifie que les deux champs email sont identiques
                        if(filter_var($email, FILTER_VALIDATE_EMAIL)){// vérification supplémentaires de la conformité de l'adresse mail
                            $reqEmail=$co->prepare('SELECT * FROM user WHERE emailUser=?');//on préparare la requete sql pour la vérification d'un doublon
                            $reqEmail->execute(array($email));//on éxécute la requete
                            $emailExist = $reqEmail->rowCount();//on vérifie si l'email entré existe dans la bdd
                            if($emailExist == 0){// si il n'existe pas on continue                    
                                if($mdp == $mdp2){// vérification que les champs mdp sont identiques
                                    $mdpH=password_hash($mdp,PASSWORD_DEFAULT);// hashage du mot de passe
                                    $sql='INSERT INTO user(`idRole`, nomUser, emailUser, mdpUser) VALUES (:idR, :nom, :email, :mdp)';//requete sql
                                    $ajoutFormateur=$co->prepare($sql);//création de la variable qui fait appel au pdo pour préparer la requete req

                                    // avec bindParam ou pourra récupérer les erreurs et les erreurs  SQL
                                    $ajoutFormateur -> bindParam(':idR', $idR);
                                    $ajoutFormateur -> bindParam(':nom', $nom);// on attribue les variables aux values
                                    $ajoutFormateur -> bindParam(':email', $email);
                                    $ajoutFormateur -> bindParam(':mdp', $mdpH);
                                    
                                    $ajoutFormateur->execute();//exécution de cette variable
                                    $nouveauFormateur=$co->lastInsertId();
                                    header("location:formateurConsult.php?idUser=$nouveauFormateur");
                                }else{
                                    header("location:formateurAjout.php?erreur=1");//mdp non identiques
                                }
                            }else{
                                header("location:formateurAjout.php?erreur=2");//email deja existant
                            }
                        }else{
                            header("location:formateurAjout.php?erreur=3");//email non valide
                        }
                    }else{
                        header("location:formateurAjout.php?erreur=4");// email non identiques
                    }                  
                }else{
                    header('location:formateurAjout.php');// tous les champs non remplie
                }              
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;
            }                 
        }
  

    // condition pour éditer un formateur
        if(isset($_POST['editer'])){//si et seulement si le bouton editer est true
            try{
                $co=connexion();//connexion a la bdd
                $id=$_POST['id'];
                $nom=htmlspecialchars($_POST['nom']);
                $prenom=htmlspecialchars($_POST['prenom']);
                $email=htmlspecialchars($_POST['email']);
                $telephone=htmlspecialchars($_POST['tel']);
                $cp=htmlspecialchars($_POST['cp']);

                $sql='UPDATE user SET `nomUser` = "'.$nom.'" , `prenomUser` = "'.$prenom.'", `emailUser` = "'.$email.'", `telephoneUser` = "'.$telephone.'", `codepostalUser` = "'.$cp.'" WHERE `idUser` = "'.$id.'"';
                $editFormateur=$co->prepare($sql);//création de la variable qui fait appel au pdo pour préparer la requete req
                $editFormateur->execute();//exécution de cette variable
                header("location:formateurConsult.php?idUser=$id");
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally{
                $co=null;
            }       
        }
        
    // Condition de supression d'une occurence dans la bdd table formateur
        if(isset($_POST["supprimer"])){
            try{
                $id=$_GET['idUser'];//creation de variable en récupérant donnée dans l'url
                $co=connexion();
                $supFormateur='DELETE FROM user WHERE `idUser`="'.$id.'"';// création variable contenant la requete sql
                $sup=$co->prepare($supFormateur);//nouvelle variable contenant la préparation de la requete
                $sup->execute();//exécution de la requete
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;
            }   
        header("location:formateur.php");     
        }

    //Condition pour attribuer une formation a un formateur
        if(isset($_POST['attribuer'])){//si  et seulement si le bouton attriber est true
            try{
                $co=connexion();//connexion a la bdd
                $id=$_POST['idUser'];
                $formation=$_POST['idFormation'];
                $sql='INSERT INTO en_charge (idUser, idFormation) VALUE (?,?)';
                $insert=$co->prepare($sql);
                $params=array($id,$formation);
                $insert->execute($params);//exécution de cette variable
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;
            }         
          header("location:formateurConsult.php?idUser=$id"); 
        }

    // Condition de supression d'une occurence dans la bdd table en_charge
    if(isset($_POST["supprimerAttibut"])){
        try{
            $idA=$_GET['idAttribution'];//creation de variable en récupérant donnée dans l'url
            $id=$_GET['idUser'];
            $co=connexion();
            $supFormateur='DELETE FROM en_charge WHERE `idAttribution`="'.$idA.'"';// création variable contenant la requete sql
            $sup=$co->prepare($supFormateur);//nouvelle variable contenant la préparation de la requete
            $sup->execute();//exécution de la requete
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
        }finally {
            $co=null;
        }   
        header("location:formateurConsult.php?idUser=$id");     
    }

    //modification du mot de passe formateur
    if(isset($_POST['modifierMdp'])){
        try{
            $id=$_POST['id'];
            $mdp=$_POST['mdp'];
            $mdp2=$_POST['mdp2'];
            $co=connexion();

            if($mdp == $mdp2){
                $mdpH=password_hash($mdp,PASSWORD_DEFAULT);
                $sql='UPDATE user SET `mdpUser` = :mdp WHERE `idUser` = "'.$id.'"';
                $editMdp=$co->prepare($sql);

                $editMdp->bindParam(':mdp', $mdpH);
                $editMdp->execute();                
                header("location:formateurEdit.php?idUser=$id&info=1");  
            }else{
                header("location:formateurEditMdp.php?idUser=$id&erreur=1");
            }
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
        }finally {
            $co=null;
        }    
    }
?>
