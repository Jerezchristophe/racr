<!-- pour vérifier l'authentification -->
<?php 
	session_start();
	require('../security.php');
	require('../roleSadmin_admin.php');
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
            <li><a href="../phpAdmin/admin.php"><i class="fas fa-tachometer-alt"></i><span>Admin</span></a></li>
            <li><a href="../phpFormation/formation.php"><i class="fas fa-table"></i><span>Formations</span></a></li>
			<li><a href="../phpFormateur/formateur.php"><i class="fas fa-chalkboard-teacher"></i><span>Formateurs</span></a></li>	
            <li><a href="apprenant.php"><i class="fas fa-graduation-cap"></i><span>Apprenants</span></a></li>
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
            <a class="retour" href="apprenant.php"><i class="fas fa-long-arrow-alt-left return"></i></a>
        </div>
        
            <div class="container col-10 col-md-8 col-lg-6 formulaire">
                <div class="card border-info mb-3">
                    <div class="card-header text-center">Ajouter un apprenant</div>
                    <div class="card-body">
                        <!-- formulaire -->
                        <form class="pt-3" method="post" action="apprenantFunction.php" enctype="multipart/form-data">

                            <div class="row justify-content-center">
                                <div class="form-group col-8">
                                    <label for="idFormation">Formation</label>
                                    <select type="text" class="form-control" name="idFormation">
                                            <option value="">Choisissez une formation</option>
                                        <?php
                                            require_once'../phpFormation/formationFunction.php';// requier le fichier fonction
                                            $liste=listeDeroulanteFormation();// on stocke la fonction dans une variable puis on echo les lignes de la table
                                            foreach ($liste as $option){?>
                                            <option value="<?= $option['idFormation'] ?>"><?= $option['intituleFormation'] ?></option>
                                            
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="form-group col-4">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" required>
                                </div>
                                <div class="form-group col-4">           
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" name="prenom" required>       
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="form-group col-4">
                                    <label for="age">Age</label>
                                    <input type="number" class="form-control" name="age">
                                </div>
                                <div class="form-group col-4">                      
                                    <label for="codePostal">Code postal</label>
                                    <input type="text" class="form-control" name="codePostal">
                                </div> 
                            </div>

                            <div class="row justify-content-center">                    
                            <div class="form-group col-8">                   
                                <div class="custom-control custom-radio custom-control-inline">          
                                    <input type="radio" class="custom-control-input" id="customRadioInline1" name="sexe" value="homme" checked>
                                    <label class="custom-control-label" for="customRadioInline1">homme</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="customRadioInline2" name="sexe" value="femme">
                                    <label class="custom-control-label" for="customRadioInline2">femme</label>
                                </div>
                            </div>    
                            </div>   

                            <div class="row justify-content-center">
                                <div class="form-group col-8"> 
                                    <label for="tel">Téléphone</label>
                                    <input type="tel" class="form-control" name="tel">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                            <div class="form-group col-8">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>  
                            </div>
                            <div class="row justify-content-center pt-3">
                                <div class="form-group col-8">
                                        <button type="submit" class="btn btn-info" name="ajouter">Enregistrer</button>
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