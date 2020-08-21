<!-- pour vérifier l'authentification -->
<?php 
    session_start();
    require('../security.php');
    require('../roleSuperAdmin.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>RACR</title>

	<link rel="shortcut icon" href="#">

	<!-- Style Font Awesome -->
	<link rel="stylesheet" href="../vendor/fontawesome/css/all.min.css" type="text/css">

	<!-- Style Bootstrap -->
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" type="text/css" />

	<!-- Style css -->
    <link rel="stylesheet" href="../css/style.css" type="text/css">

    


</head>

<body>

	<!-- Sidebar Wrapper -->
	<div id="sidebar-wrapper" class="active">
			<img src="../img/logob.png" class="logo" />
		<ul>
            <li><a href="admin.php"><i class="fas fa-tachometer-alt"></i><span>Admin</span></a></li>
			<li><a href="../phpFormation/formation.php"><i class="fas fa-table"></i><span>Formations</span></a></li>
			<li><a href="../phpFormateur/formateur.php"><i class="fas fa-chalkboard-teacher"></i><span>Formateurs</span></a></li>	
            <li><a href="../phpApprenant/apprenant.php"><i class="fas fa-graduation-cap"></i><span>Apprenants</span></a></li>
            <li><a href="../phpEvaluation/questionnaire.php"><i class="fas fa-align-left"></i><span>Gestion des questionnaires</span></a></li>
			<li><a onclick="return confirm('Etes vous sur de vouloir vous déconnecter')" href="../logOut.php"><i class="fas fa-sign-out-alt" ></i><span>Déconnexion</span></a></li>
		</ul>
	</div>



	<!-- Content Wrapper -->
	<div id="content-wrapper" class="active">
		<button id="toggle-wrapper"><span class="active"></span><span class="active"></span><span class="active"></span></button>
        
        <!-- Corps de page -->
        <!-- bouton retour -->
        <div class="container-fluid pl-5 mt-3">
            <a class="retour" href="admin.php"><i class="fas fa-long-arrow-alt-left return"></i></a>
        </div>

        <div class="container col-10 col-md-8 col-lg-6 formulaire">
            <div class="card border-info mb-5">
                <div class="card-header text-center">Ajouter un administrateur</div>
                <div class="card-body">
                <!-- formulaire -->
                    <form class="pt-3" method="post" action="adminFunction.php" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="form-group col-10 col-sm-8"> 
                                <label for="nom">Nom * (tous les champs précédé de * sont obligatoires)</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-10 col-sm-8"> 
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-10 col-sm-8"> 
                                <label for="email2">Confirmez l'email *</label>
                                <input type="email" class="form-control" id="email2" name="email2" required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-10 col-sm-8">
                                <label for="mdp">Mot de passe *</label>
                                <input type="password" class="form-control" id="mdp" name="mdp" required>
                            </div>  
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-10 col-sm-8">
                                <label for="mdp2">Confirmez le mot de passe *</label>
                                <input type="password" class="form-control" id="mdp2" name="mdp2" required>
                            </div>  
                        </div>
                        <div class="row justify-content-center pt-3">
                            <div class="form-group col-10 col-sm-8">
                                <button type="submit" class="btn btn-info" name="ajouter">Enregistrer</button>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-6">        
                                <!--création des message d'alert en récupérant le code dans l'url  -->
                                <p class="alert">
                                    <?php                               
                                        $erreur=null;
                                        if(empty ($_GET['erreur'])){
                                            $_GET['erreur']=null;
                                        }else{
                                            if($_GET['erreur'] == 1){
                                                echo "Les mots de passe doivent correspondre !";
                                            }elseif($_GET['erreur'] == 2){
                                                echo "L'adresse email est déjà existante !";
                                            }elseif($_GET['erreur'] == 3){
                                                echo "L'email n'est pas valide !";
                                            }elseif($_GET['erreur'] == 4){
                                                echo "Les emails doivent correspondre !";
                                            }else{
                                                $_GET['erreur']=null;
                                            }
                                        }                                    
                                    ?>
                                </p>                                                                                     
                            </div>
                        </div>
                    </form>
                <!-- fin formulaire -->
                </div>
            </div>
            </div>       
    </div>
	<!-- Pied de page -->

		<!-- JS JQuery -->
        <script src="../vendor/jquery/jquery-3.5.1.min.js"></script>

        <!-- JS Bootstrap -->..
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- JS Exemple Wrapper -->
        <script src="../js/toggle-wrapper.js"></script>

</body>
</html>