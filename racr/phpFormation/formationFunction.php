<?php
    
    //appel du fichier contenant la connexion a la bdd
    require_once'../connect.php';


    // fonction d'affichage de la table formation 
        function affichageFormation(){// création de la fonction
            try {                       
                $co=connexion();//connxion a la bdd
                $sql = 'SELECT*FROM formation';//création variable requete sql
                $affichage=$co->prepare($sql);//création de la variable qui fait appel au pdo pour préparer la requete req
                $affichage->execute();//exécution de cette variable
                return $affichage;// on retourne le résultat obtenu pour pouvoir l'utiliser
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;// on arrete la connexion
            }
        }

        // Condition pour faire un insert dans la table formation
        if(isset($_POST['ajouter'])){//si et seulement si le bouton ajouter est true
            try{
                $co=connexion();//connxion a la bdd
                $idFormation=null;
                $intitule=$_POST['intitule'];//on récupère les valeurs par la methode post
                $domaine=$_POST['domaine'];
                $debut=$_POST['dateDebut'];
                $fin=$_POST['dateFin'];

                $ajoutFormation=$co->prepare("INSERT INTO formation(idFormation, intituleFormation, domaineFormation, dateDebutFormation, dateFinFormation) VALUE (:idFormation, :intitule, :domaine, :debut, :fin)");
                // avec bindParam ou parra récupérer les erreurs et les erreurs  SQL
                $ajoutFormation -> bindParam(':idFormation', $idFormation);// on attribu les variables aux value
                $ajoutFormation -> bindParam(':intitule', $intitule);
                $ajoutFormation -> bindParam(':domaine', $domaine);
                $ajoutFormation -> bindParam(':debut', $debut);
                $ajoutFormation -> bindParam(':fin', $fin);

                $ajoutFormation->execute();
                header("location:formation.php");
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;
            }                 
        }

        // fonction d'affichage de la formation pour l'edition
        function affichageEditionFormation(){// création de la fonction
            try {
                $id=$_GET['idFormation'];//on récupère la valeur idFormation dans l'url avec $_GET dans une variable $id
                $co=connexion();//connxion a la bdd
                $sql='SELECT * FROM formation WHERE idformation = "'.$id.'"';// requete sql
                $affichageEdition=$co->prepare($sql);//création de la variable qui fait appel au pdo pour préparer la requete req
                $affichageEdition->execute();//exécution de cette variable
                return $affichageEdition;// on retourne le résultat obtenu pour pouvoir l'utiliser
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;// on arrete la connexion
            }
        }

          // condion pour l'édition d'une formation
          if(isset($_POST['editer'])){
            try{
                $id=$_POST['id'];// récupération par la méthode post des champs du formulaire
                $intitule=$_POST['intitule'];
                $domaine=$_POST['domaine'];
                $dateD=$_POST['dateDebut'];
                $dateF=$_POST['dateFin'];

                $co=connexion();

                $formationUpdate='UPDATE formation SET idFormation = :id, intituleFormation = :intitule, domaineFormation = :domaine, dateDebutFormation = :dateD, dateFinFormation = :dateF WHERE idFormation = "'.$id.'"';// création variable contenant la requete sql

                $edit=$co->prepare($formationUpdate);//nouvelle variable contenant la préparation de la requete
                
                // avec bindParam ou parra récupérer les erreurs et les erreurs  SQL
                $edit -> bindParam(':id', $id);// on attribu les variables aux value
                $edit -> bindParam(':intitule', $intitule);
                $edit -> bindParam(':domaine', $domaine);
                $edit -> bindParam(':dateD', $dateD);
                $edit -> bindParam(':dateF', $dateF);

                $edit->execute();//exécution de la requete
                header("location:formation.php");
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;
            }        
        }

        // Condition de supression d'une occurence dans la bdd
        if(isset($_POST["supprimer"])){
            try{
                $idFormation=$_GET['idFormation'];//creation de variable en récupérant donnée dans l'url
                $co=connexion();
                $supFormation='DELETE FROM formation WHERE idformation="'.$idFormation.'"';// création variable contenant la requete sql
                $sup=$co->prepare($supFormation);//nouvelle variable contenant la préparation de la requete
                $sup->execute();//exécution de la requete
                header("location:formation.php");  
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;
            }             
        }

        

    //fonction affichage liste déroulante des formation pour l'ajout d'un apprenant
    function ListeDeroulanteFormation(){// création de la fonction
        try {                       
            $co=connexion();//connxion a la bdd
            $req=$sql = "SELECT * FROM formation";//création variable requete sql
            $liste=$co->prepare($req);//création de la variable qui fait appel au pdo pour préparer la requete req
            $liste->execute();//exécution de cette variable
            return $liste;// on retourne le résultat obtenu pour pouvoir l'utiliser
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
        }finally {
            $co=null;// on arrete la connexion
        };
    }
?>