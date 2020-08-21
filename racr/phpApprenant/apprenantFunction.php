 <?php
    
    //appel du fichier contenant la connexion a la bdd
    require_once'../connect.php';


    // fonction d'affichage de la tabe apprenant 
        function affichageApprenant(){// création de la fonction
            try {                       
                $co=connexion();//connxion a la bdd
                $sql = 'SELECT apprenant . *,  formation . intituleFormation FROM apprenant  LEFT JOIN formation ON apprenant . idFormation = formation . idFormation';//création variable requete sql
                $affichage=$co->prepare($sql);//création de la variable qui fait appel au pdo pour préparer la requete req
                $affichage->execute();//exécution de cette variable
                return $affichage;// on retourne le résultat obtenu pour pouvoir l'utiliser
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;// on arrete la connexion
            }
        }

    // fonction d'affichage de la tabe apprenant du formateur
    function affichageApprenantFormateur(){// création de la fonction
        try {                       
            $co=connexion();//connxion a la bdd
            $id=$_SESSION['PROFILE']['idUser'];
            $sql = 'SELECT `apprenant`.*, `formation`.`intituleFormation`, `en_charge`.`idUser` FROM `apprenant` LEFT JOIN `formation` ON `apprenant`.`idFormation` = `formation`.`idFormation` LEFT JOIN `en_charge` ON `en_charge`.`idFormation` = `formation`.`idFormation` WHERE `en_charge`.`idUser` = "'.$id.'"';//création variable requete sql
            $affichage=$co->prepare($sql);//création de la variable qui fait appel au pdo pour préparer la requete req
            $affichage->execute();//exécution de cette variable
            return $affichage;// on retourne le résultat obtenu pour pouvoir l'utiliser
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
        }finally {
            $co=null;// on arrete la connexion
        }
    }

    // fonction d'affichage d'un seul apprenant
        function consultApprenant(){// création de la fonction
            try {
                $id=$_GET['idApprenant'];//on récupère la valeur idApprenant dans l'url avec $_GET dans une variable $id
                $co=connexion();//connxion a la bdd
                $sql='SELECT * FROM apprenant a, formation f WHERE `a`.`idFormation` = `f`.`idFormation` AND `a`.`idApprenant` = "'.$id.'"';// requete sql
                $affichage=$co->prepare($sql);//création de la variable qui fait appel au pdo pour préparer la requete req
                $affichage->execute();//exécution de cette variable
                return $affichage;// on retourne le résultat obtenu pour pouvoir l'utiliser
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;// on arrete la connexion
            }
        }


    // Condition pour faire un insert dans la table apprenant
        if(isset($_POST['ajouter'])){//si et seulement si le bouton ajouter est true
            try{
                $co=connexion();//connxion a la bdd
                $idAp=null;
                $idFormation=$_POST['idFormation'];//on récupère les valeurs par la methode post
                $nom=$_POST['nom'];
                $prenom=$_POST['prenom'];
                $email=$_POST['email'];
                $sexe=$_POST['sexe'];
                $age=$_POST['age'];
                $tel=$_POST['tel'];
                $codePostal=$_POST['codePostal'];

                $formap=$co->prepare("INSERT INTO apprenant(idApprenant, idFormation, nomApprenant, prenomApprenant, emailApprenant, sexeApprenant, ageApprenant, telApprenant, codepostalApprenant) VALUE (?,?,?,?,?,?,?,?,?)");
                
                $formap -> bindParam(1, $idAp);
                $formap -> bindParam(2, $idFormation);
                $formap -> bindParam(3, $nom);
                $formap -> bindParam(4, $prenom);
                $formap -> bindParam(5, $email);
                $formap -> bindParam(6, $sexe);
                $formap -> bindParam(7, $age);
                $formap -> bindParam(8, $tel);
                $formap -> bindParam(9, $codePostal);

                $formap->execute();
                header("location:apprenant.php");
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;
            }                 
        }


    // Condition de supression d'une occurence dans la bdd
        if(isset($_POST["supprimer"])){
            try{
                $idApprenant=$_GET['idApprenant'];//creation de variable en récupérant donnée dans l'url
                $co=connexion();
                $supApprenant='DELETE FROM apprenant WHERE idApprenant="'.$idApprenant.'"';// création variable contenant la requete sql
                $sup=$co->prepare($supApprenant);//nouvelle variable contenant la préparation de la requete
                $sup->execute();//exécution de la requete
                header("location:apprenant.php");
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;
            }               
        }

        // condion pour l'édition d'un apprenant
        if(isset($_POST['editer'])){
            try{
                $co=connexion();

                $id=$_POST['idApprenant'];// récupération par la méthode post des champs du formulaire
                $idFormation=$_POST['idFormation'];
                $nom=$_POST['nom'];
                $prenom=$_POST['prenom'];
                $email=$_POST['email'];
                $sexe=$_POST['sexe'];
                $age=$_POST['age'];
                $tel=$_POST['tel'];
                $codePostal=$_POST['codePostal'];
                
                $apprenantUpdate='UPDATE apprenant SET `idFormation` = :idF , `nomApprenant` = :nom , `prenomApprenant` = :prenom , `emailApprenant` =  :email , `sexeApprenant` = :sexe , `ageApprenant` = :age , `telApprenant` = :tel , `codepostalApprenant` = :cp WHERE `idApprenant` = "'.$id.'"';// création variable contenant la requete sql
                $edit=$co->prepare($apprenantUpdate);//nouvelle variable contenant la préparation de la requete

                $edit -> bindParam(':idF' ,$idFormation);
                $edit -> bindParam(':nom' ,$nom);
                $edit -> bindParam(':prenom' ,$prenom);
                $edit -> bindParam(':email' ,$email);
                $edit -> bindParam(':sexe' ,$sexe);
                $edit -> bindParam(':age' ,$age);
                $edit -> bindParam(':tel' ,$tel);
                $edit -> bindParam(':cp' ,$codePostal);

                $edit->execute();//exécution de la requete
                header("location:apprenantConsult.php?idApprenant=$id");
            }catch(PDOException $e){
                echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
            }finally {
                $co=null;
            }          
        }
?>

