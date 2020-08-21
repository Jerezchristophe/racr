<?php
    session_start();
    require('../security.php');//pour vérifier l'authentification 
    require('../roleSuperAdmin.php');// pour vérifier le role
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
                <a class="retour" href="adminEdit.php?idUser=<?=$_GET['idUser']?>"><i class="fas fa-long-arrow-alt-left return"></i></a>
            </div>

            <div class="container col-10 col-md-8 col-lg-6 formulaire">
                <div class="card border-info mb-3">
                    <div class="card-header text-center">Modification du mot de passe</div>
                    <div class="card-body">
                        <!-- formulaire -->
                        <form class="pt-3" method="post" action="adminFunction.php" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="id" value="<?= $_GET['idUser']?>">
                            <div class="row justify-content-center">
                                <div class="form-group col-8">
                                    <label for="mdp">Nouveau mot de passe *</label>
                                    <input type="password" class="form-control" id="mdp" name="mdp" required>
                                </div>  
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-8">
                                    <label for="mdp2">Confirmez le nouveau mot de passe *</label>
                                    <input type="password" class="form-control" id="mdp2" name="mdp2" required>
                                </div>  
                            </div>
                            <div class="row justify-content-center pt-3">
                                <div class="form-group col-8">
                                    <button type="submit" class="btn btn-info" name="modifierMdp">Enregistrer</button>
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