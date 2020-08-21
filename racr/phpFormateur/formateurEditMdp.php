<!-- pour vérifier l'authentification -->
<?php 
	session_start();
	require('../security.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>RACR</title>

	<link rel="shortcut icon" href="">

	<!-- Style Font Awesome -->
	<link rel="stylesheet" href="../vendor/fontawesome/css/all.min.css" type="text/css">

	<!-- Style Bootstrap -->
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" type="text/css" />

	<!-- Style css -->
    <link rel="stylesheet" href="../css/style.css" type="text/css">

</head>

<body>

<!-- gestion du header selon la session active -->
<?php
	//si le role de la session est différent du formateur alos on utilise ce menu
	if($_SESSION['PROFILE']['idRole'] != 1){?>
	<!-- Sidebar Wrapper admin -->
	<div id="sidebar-wrapper" class="active">
			<img src="../img/logob.png" class="logo" />
		<ul>
            <li><a href="../phpAdmin/admin.php"><i class="fas fa-tachometer-alt"></i><span>Admin</span></a></li>
            <li><a href="../phpFormation/formation.php"><i class="fas fa-table"></i><span>Formations</span></a></li>
			<li><a href="formateur.php"><i class="fas fa-chalkboard-teacher"></i><span>Formateurs</span></a></li>	
            <li><a href="../phpApprenant/apprenant.php"><i class="fas fa-graduation-cap"></i><span>Apprenants</span></a></li>
            <li><a href="../phpEvaluation/questionnaire.php"><i class="fas fa-align-left"></i><span>Gestion des questionnaires</span></a></li>
            <li><a onclick="return confirm('Etes vous sur de vouloir vous déconnecter')" href="../logOut.php"><i class="fas fa-sign-out-alt" ></i><span>Déconnexion</span></a></li>
		</ul>
	</div>

	<!-- Content Wrapper -->
	<div id="content-wrapper" class="active">
		<button id="toggle-wrapper"><span class="active"></span><span class="active"></span><span class="active"></span></button>
	<?php
	//sinon c'est un formateur, alors on utilise ce menu
	}else{?>
		<!-- Menu formateur -->
		<nav class="navbar navbar-expand-lg navbar-dark bg-info">
				<a class="navbar-brand" href="#"><img src="../img/logob.png" class="logoNav" /></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="../phpApprenant/apprenant.php">Mes apprenants</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="formateurEdit.php?idUser=<?=$_SESSION['PROFILE']['idUser']?>">Mon compte</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" onclick="return confirm('Etes vous sur de vouloir vous déconnecter')" href="../logOut.php">Deconnexion</a>
					</li>
				</ul>
			</div>
		</nav>
	<?php }?>
	<!-- fin de gestion du header -->
        
        <!-- Corps de page -->
            <!-- bouton retour -->
            <div class="container-fluid pl-5 mt-3">
                <a class="retour" href="formateurEdit.php?idUser=<?=$_GET['idUser']?>"><i class="fas fa-long-arrow-alt-left return"></i></a>
            </div>

            <div class="container col-10 col-md-8 col-lg-6 formulaire">
                <div class="card border-info mb-3">
                    <div class="card-header text-center">Nouveau mot de passe</div>
                    <div class="card-body">

                        <!-- formulaire -->
                        <form class="pt-3" method="post" action="formateurFunction.php" enctype="multipart/form-data" novalidate>
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
                <h1 class="text-center"></h1>                
            </div>
    <?php
	//cloture de la div id=content-wrapper uniquement necessaire pour les roles different de formateur
	if($_SESSION['PROFILE']['idRole'] != 1){?>
	</div>
	<?php }?>
	<!-- Pied de page -->

		<!-- JS JQuery -->
        <script src="../vendor/jquery/jquery-3.5.1.min.js"></script>

        <!-- JS Bootstrap -->..
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- JS Exemple Wrapper -->
        <script src="../js/toggle-wrapper.js"></script>

</body>
</html>