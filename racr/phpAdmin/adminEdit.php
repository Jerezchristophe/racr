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

    <?php     

        require_once('../phpFormateur/formateurFunction.php');//appel du fichier fonction pour l'affichage
        $affichEdit=affichageEditionUser();
        foreach($affichEdit as $ed);
    ?>

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
                <div class="card border-info mb-3">
                    <div class="card-header text-center">Edition du profil</div>
                    <div class="card-body">
                    <!-- formulaire -->
                        <form class="pt-3" method="post" action="adminFunction.php" enctype="multipart/form-data" novalidate>

                            <input type="hidden" name="id" value="<?= $ed['idUser']?>">
                            <div class="row justify-content-center">
                                <div class="form-group col-8"> 
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" name="nom" value="<?= $ed['nomUser']?>">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                            <div class="form-group col-8">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" name="prenom" value="<?= $ed['prenomUser']?>">
                                </div>  
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-8"> 
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $ed['emailUser']?>">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-8">
                                    <label for="tel">Téléphone</label>
                                    <input type="tel" class="form-control" name="tel" value="<?= $ed['telephoneUser']?>">
                                </div>  
                            </div>
                            <div class="row justify-content-center">					
                                <div class="form-group col-8">
                                    <label for="cp">Code postal</label>
                                    <input type="text" class="form-control" name="cp" value="<?= $ed['codepostalUser']?>">
                                </div>  
                            </div>
                            <div class="row justify-content-center pt-3">
                                <div class="form-group col-8">
                                    <button type="submit" class="btn btn-info" name="editer">Enregistrer</button>
                                    <a href="adminEditMdp.php?idUser=<?= $ed['idUser']?>"><button type="button" class="btn btn-danger">Modifier mdp</button></a>    
                                </div> 
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-8 text-center">        
                                    <!--création des message d'alert en récupérant le code dans l'url  -->
                                    <p class="info">
                                        <?php                               
                                            if(empty ($_GET['info'])){
                                                $_GET['info']=null;
                                            }else{
                                                if($_GET['info'] == 1){
                                                    echo "✔ Modification bien prise en compte !";
                                                }else{
                                                    $_GET['info']=null;
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