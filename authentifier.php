<?php
    //appel du fichier contenant la connexion a la bdd
    require_once'connect.php';

    try{
        $co=connexion();//connxion a la bdd

        $email=$_POST['email'];//on récupere les valeurs des champs
        $mdp=$_POST['mdp'];
      
        $auth=$co->prepare('SELECT * FROM user WHERE emailUser = ?');
        $auth->bindParam(1, $email);
        $auth->execute();
        $user = $auth->fetch();

        if(password_verify($mdp, $user['mdpUser'])){//vérification du mot de passe
            if($user['idRole'] == 2){// si super admin, je le dirige vers la page des admins
                session_start();
                $_SESSION['PROFILE']=$user;
                header('location:phpAdmin/admin.php');
            }else{// sinon, formateur et admin seront dirigé vers la page des apprenants
                session_start();
                $_SESSION['PROFILE']=$user;
                header('location:phpApprenant/apprenant.php');          
            }   
        }else{//si le mot de passe n'est pas correct, retour a la page de connexion
            header('location:index.php?erreur=1');
        }
    }catch(PDOException $e){
        echo 'Erreur: ' .$e->getMessage();// si le try ne fonctionne pas, on attrape l'erreur pout ensuite l'afficher
    }finally {
        $co=null;
    }        
?>