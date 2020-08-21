<?php
    require_once'../connect.php';

    //fonction création d'un questionnaire
    if(isset($_POST['creerQuestionnaire'])){
        try{
            $co=connexion();
            $intitule=$_POST['intituleQuestionnaire'];
            $date=date('Y-m-d');

            if(!empty($_POST['intituleQuestionnaire'])){
                $sql='INSERT INTO `questionnaire`(intituleQuestionnaire, dateQuestionnaire) VALUES (:intituleQuestionnaire, :dateQuestionnaire)';
                $newQuestionnaire=$co->prepare($sql);
                $newQuestionnaire -> bindParam(':intituleQuestionnaire', $intitule);
                $newQuestionnaire -> bindParam(':dateQuestionnaire', $date);
                $newQuestionnaire -> execute();
                $id=$co->lastInsertId();
                header("location:editionQuestionnaire.php?idQuestionnaire=$id");
            }else{
                header('location:questionnaire.php');
            }           
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();
        }finally{
            $co=null;
        }
    }

    //afficher liste des questionnaires
    function afficherListeQuestionnaire(){
        try{
            $co=connexion();
            $sql='SELECT * FROM `questionnaire`';
            $listeQuestionnaire=$co->prepare($sql);
            $listeQuestionnaire->execute();
            return $listeQuestionnaire;
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();
        }finally{
            $co=null;
        }
    }

    //supprimerQuestionnaire
    if(isset($_POST['supprimerQuestionnaire'])){
        try{
            $co=connexion();
            $id=$_GET['idQuestionnaire'];
            $sql='DELETE FROM `questionnaire` WHERE `idQuestionnaire` = "'.$id.'"';
            $supprimer=$co->prepare($sql);
            $supprimer->execute();
            header('location:questionnaire.php');
        }catch(PDOException $e){
            echo'Erreur: vous ne pouvez pas supprimer un questionnaire comprenant des questions !';
            header("refresh:5;url=questionnaire.php");
        }finally{
            $co=null;
        }
    }

    //fonction ajouter une question
    if(isset($_POST['ajouter'])){
        try{
            $co=connexion();
            $intitule=$_POST['intitule'];
            $type=$_POST['type'];
            $idCategorie=$_POST['categorie'];
            $idQuestionnaire=$_POST['questionnaire'];

            if(!empty($_POST['intitule']) && !empty($_POST['type']) && !empty($_POST['categorie'])){
                $sql='INSERT INTO question (idQuestionnaire, idCategorie, intituleQuestion, typeQuestion ) VALUES (:idQuestionnaire, :idCategorie, :intituleQuestion, :typeQuestion)';
                $ajoutQuestion=$co->prepare($sql);
                $ajoutQuestion -> bindParam(':idQuestionnaire', $idQuestionnaire);
                $ajoutQuestion -> bindParam(':idCategorie', $idCategorie);
                $ajoutQuestion -> bindParam(':intituleQuestion', $intitule);
                $ajoutQuestion -> bindParam(':typeQuestion', $type);                   
                $ajoutQuestion->execute();
                header("location:editionQuestionnaire.php?idQuestionnaire=$idQuestionnaire");
            }else{
                header("location:editionQuestionnaire.php?idQuestionnaire=$idQuestionnaire&erreur=1");
            }
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
        }finally {
            $co=null;
        }
    }

    //suppression question
    if(isset($_POST['supprimerQuestion'])){
        try{
            $idQuestion=$_GET['idQuestion'];
            $idQuestionnaire=$_GET['idQuestionnaire'];
            $co=connexion();

            $sql='DELETE FROM question WHERE `idQuestion` = "'.$idQuestion.'"';
            $suppressionQuestion=$co->prepare($sql);
            $suppressionQuestion->execute();
            header("location:editionQuestionnaire.php?idQuestionnaire=$idQuestionnaire");
        }catch(PDOException $e){
            echo 'Erreur: l\'evaluation à déjà été utilisée. Vous ne pouvez supprimer des questions si des réponses y sont associées.';
        }finally{
            $co=null;
        }
    }

    //affichage question
    function affichageQuestion(){
        try{
            $co=connexion();
            $idQuestionnaire=$_GET['idQuestionnaire'];
            $sql="SELECT * FROM `question` WHERE `idQuestionnaire` = '".$idQuestionnaire."' ORDER BY `typeQuestion`";
            $affichageQuestionReaction=$co->prepare($sql);
            $affichageQuestionReaction->execute();
            return $affichageQuestionReaction;
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
        }finally {
            $co=null;// on arrete la connexion
        }
    }

    //Créer une nouvelle evaluation page consultation apprenant
    if(isset($_POST['evaluer'])){
        $idApprenant=$_GET['idApprenant'];
        if(!empty($_POST['questionnaire'])){
            try{
                
                $co=connexion();               
                $idQuestionnaire=$_POST['questionnaire'];
                $dateEvaluation=date('Y-m-d');
                $sql='INSERT INTO evaluation (idApprenant, dateEvaluation) VALUES (:idApprenant, :dateEvaluation)';
                $evaluer=$co->prepare($sql);
                $evaluer -> bindParam(':idApprenant', $idApprenant);
                $evaluer -> bindParam(':dateEvaluation', $dateEvaluation);
                $evaluer->execute();
                $idEvaluation=$co->lastInsertId();
                header("location:questionnaireReaction.php?idEvaluation=$idEvaluation&idQuestionnaire=$idQuestionnaire");
            }catch(PDOException $e){
                echo 'Erreur :' .$e->getMessage();
            }finally{
                $co=null;
            }
        }else{
            header("location:../phpApprenant/apprenantConsult.php?idApprenant=$idApprenant");
        }
    }

    //affichage evaluation
    function affichageEvaluation(){
        try{
            $co=connexion();
            $idApprenant=$_GET['idApprenant'];
            $sql='SELECT * FROM evaluation WHERE `idApprenant` = "'.$idApprenant.'"';
            $affichageEvaluation=$co->prepare($sql);
            $affichageEvaluation->execute();
            return $affichageEvaluation;   
        }catch(PDOException $e){
            echo 'Erreur :' .$e->getMessage();
        }finally{
            $co=null;
        }
    }

    //enregistrer les réponses des évaluations
    if(isset($_POST['enregistrerReponse']) OR isset($_POST['passerReponse'])){
        try{
            $co=connexion();

            $idEvaluation=$_POST['idEvaluation'];
            $question=$_POST['question'];
            $valeurReponse=$_POST['reponse'];
            $idQuestionnaire=$_POST['idQuestionnaire'];


            foreach($valeurReponse as $key => $values){
            $sql="INSERT INTO `reponse` (idEvaluation, idQuestion, valeurReponse) VALUES (:idEvaluation ,:idQuestion, :valeurReponse)";       
            $ajout=$co->prepare($sql);
            $ajout -> bindParam(':idEvaluation', $idEvaluation);
            $ajout -> bindParam(':idQuestion', $question[$key]);
            $ajout -> bindParam(':valeurReponse', $valeurReponse[$key]);
            $ajout -> execute();
            }
            $page=null;
            if(empty($_GET['page'])){
                header("location:recapitulatifEvaluation.php?idEvaluation=$idEvaluation&idQuestionnaire=$idQuestionnaire");
            }else{
                if($_GET['page'] == 1){
                    header("location:questionnaireApprentissage.php?idEvaluation=$idEvaluation&idQuestionnaire=$idQuestionnaire");
                }elseif($_GET['page'] == 2){
                    header("location:questionnaireComportement.php?idEvaluation=$idEvaluation&idQuestionnaire=$idQuestionnaire");
                }elseif($_GET['page'] == 3){
                    header("location:questionnaireResultat.php?idEvaluation=$idEvaluation&idQuestionnaire=$idQuestionnaire");
                }else{
                    $_GET['page']=null;                  
                }
            }     
        }catch(PDOException $e){
            echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
        }finally {
            $co=null;// on arrete la connexion
        }      
    }

    //affichage récapitulatif evaluation
    function recapitulatifEvaluation(){
        try{
            $co=connexion();
            $idEvaluation=$_GET['idEvaluation'];
            $sql="SELECT * FROM  reponse r, question q, questionnaire n WHERE idEvaluation = '".$idEvaluation."' AND `r`.`idQuestion` = `q`.`idQuestion` AND `n`.`idQuestionnaire` = `q`.`idQuestionnaire`";
            $recap=$co->prepare($sql);
            $recap->execute();
            return $recap;          
        }catch(PDOException $e){
            echo 'Erreur : ' .$e->getMessage();
        }finally{
            $co=null;
        }
    }

    // affichage information évaluation
    function informationEvaluation(){
        try{
            $co=connexion();
            $idEvaluation=$_GET['idEvaluation'];
            $sql='SELECT * FROM evaluation e, apprenant a, formation f WHERE `e`.`idApprenant` = `a`.`idApprenant` AND `a`.`idFormation` = `f`.`idFormation` AND `idEvaluation` = "'.$idEvaluation.'"';
            $info=$co->prepare($sql);
            $info->execute();
            return$info;
        }catch(PDOException $e){
            echo "Erreur: " .$e->getMessage();
        }finally{
            $co=null;
        }
    }

    
    ?>