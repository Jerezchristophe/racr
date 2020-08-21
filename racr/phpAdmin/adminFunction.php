<?php

    //appel du fichier contenant la connexion a la bdd
    require_once'../connect.php';


    // fonction d'affichage des administrateurs 
        function affichageUser(){// création de la fonction
            try{                       
                $co=connexion();//connxion a la bdd
                $sql = 'SELECT * FROM `user` WHERE `idRole`= 0';//création variable requete sql
                $affichageUser=$co->prepare($sql);//création de la variable qui fait appel au pdo pour préparer la requete req
                $affichageUser->execute();//exécution de cette variable
                return $affichageUser;// on retourne le résultat obtenu pour pouvoir l'utiliser
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;// on arrete la connexion
            }
        }

    // condition pour ajouter un admin dans la table user
    if(isset($_POST['ajouter'])){//si et seulement si le bouton ajouter est true
        try{          
            if(!empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])){// si les champs ne sont pas null             
                $co=connexion();//connexion a la bdd  
                $nom=$_POST['nom'];//on récuprere la value des champs en sécurisant les entrées de code avec htmlspecialchars
                $email=$_POST['email'];
                $email2=htmlspecialchars($_POST['email2']);
                $mdp=$_POST['mdp'];
                $mdp2=$_POST['mdp2'];
                $idR=0; 

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
                                header("location:admin.php");
                            }else{
                                header("location:adminAjout.php?erreur=1");//mdp non identiques
                            }
                        }else{
                            header("location:adminAjout.php?erreur=2");//email deja existant
                        }
                    }else{
                        header("location:adminAjout.php?erreur=3");//email non valide
                    }
                }else{
                    header("location:adminAjout.php?erreur=4");// email non identiques
                }                  
            }else{
                header('location:adminAjout.php');// tous les champs non remplie
            }              
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
        }finally {
            $co=null;
        }                 
    }

    // condition pour éditer un admin
    if(isset($_POST['editer'])){//si et seulement si le bouton editer est true
        try{
            $co=connexion();//connexion a la bdd
            $id=$_POST['id'];
            $nom=$_POST['nom'];
            $prenom=$_POST['prenom'];
            $email=$_POST['email'];
            $telephone=$_POST['tel'];
            $cp=$_POST['cp'];


            $sql='UPDATE user SET `nomUser` = :nom, `prenomUser` = :prenom, `emailUser` = :email, `telephoneUser` = :tel, `codepostalUser` = :cp WHERE `idUser` = "'.$id.'"';
            $editUser=$co->prepare($sql);//création de la variable qui fait appel au pdo pour préparer la requete req

            $editUser -> bindParam(':nom', $nom);
            $editUser -> bindParam(':prenom', $prenom);
            $editUser -> bindParam(':email', $email);
            $editUser -> bindParam(':tel', $telephone);
            $editUser -> bindParam(':cp', $cp);

            $editUser->execute();//exécution de cette variable
            header("location:admin.php");
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
        }finally{
            $co=null;
        }       
    }

    //condition pour la modification du mot de passe admin
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
                header("location:adminEdit.php?idUser=$id&info=1");  
            }else{
                header("location:adminEditMdp.php?idUser=$id&erreur=1");
            }
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
        }finally {
            $co=null;
        }    
    }

    // Condition de supression d'une occurence dans la bdd table user
    if(isset($_POST["supprimer"])){
        try{
            $id=$_GET['idUser'];//creation de variable en récupérant donnée dans l'url
            $co=connexion();
            $supAdmin='DELETE FROM user WHERE `idUser`="'.$id.'"';// création variable contenant la requete sql
            $sup=$co->prepare($supAdmin);//nouvelle variable contenant la préparation de la requete
            $sup->execute();//exécution de la requete
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
        }finally {
            $co=null;
        }   
    header("location:admin.php");     
    }

?>