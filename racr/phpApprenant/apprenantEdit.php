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

	<!-- data table bibliotheque -->
	<link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.min.css"/>

	<!-- Style Exemple Wrapper -->
	<link rel="stylesheet" href="../css/style.css" type="text/css">
	
    <?php
        require_once('apprenantFunction.php');//appel du fichier fonction pour permettre l'affichage
        $affichage=consultApprenant();
		foreach ($affichage as $cl);
    ?>

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
			<li><a href="../phpFormateur/formateur.php"><i class="fas fa-chalkboard-teacher"></i><span>Formateurs</span></a></li>	
			<li><a href="apprenant.php"><i class="fas fa-graduation-cap"></i><span>Apprenants</span></a></li>
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
					<li class="nav-item active">
						<a class="nav-link" href="#">Mes apprenants</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="monCompte.php?idUser=<?=$_SESSION['PROFILE']['idUser']?>">Mon compte</a>
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
        <!--bouton retour  -->
        <div class="container-fluid pl-5 mt-3">
            <a class="retour" href="apprenantConsult.php?idApprenant=<?=$_GET['idApprenant']?>"><i class="fas fa-long-arrow-alt-left return"></i></a>
        </div>
        
        <div class="container col-10 col-md-8 col-lg-6 formulaire">
            <div class="card border-info mb-3">
                <div class="card-header text-center">Edition du profil</div>
                    <div class="card-body">
                        <!-- formulaire -->
                        <form class="pt-3" method="post" action="apprenantFunction.php" enctype="multipart/form-data">
                            <div class="row justify-content-center">
                                <div class="form-group col-8">
                                    <label for="idFormation">Formation</label>
                                    <select type="text" class="form-control" name="idFormation">
                                            <option value="<?= $cl['idFormation']?>"><?= $cl['intituleFormation'] ?></option>
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
                                    <input type="text" class="form-control" id="nom" name="idApprenant" value="<?= $cl['idApprenant']?>" hidden> 
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $cl['nomApprenant']?>">
                                </div>
                                <div class="form-group col-4">           
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" name="prenom"  value="<?= $cl['prenomApprenant']?>">       
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="form-group col-4">
                                    <label for="age">Age</label>
                                    <input type="number" class="form-control" name="age"  value="<?= $cl['ageApprenant']?>">
                                </div>
                                <div class="form-group col-4">                      
                                    <label for="codePostal">Code postal</label>
                                    <input type="text" class="form-control" name="codePostal"  value="<?= $cl['codepostalApprenant']?>">
                                </div> 
                            </div>

                            <div class="row justify-content-center">                    
                            <div class="form-group col-8">                   
                                <div class="custom-control custom-radio custom-control-inline">          
                                    <input type="radio" class="custom-control-input" id="customRadioInline1" name="sexe" value="homme" <?php if($cl['sexeApprenant']=='homme'){echo "checked";}?>>
                                    <label class="custom-control-label" for="customRadioInline1">homme</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="customRadioInline2" name="sexe" value="femme" <?php if($cl['sexeApprenant']=='femme'){echo "checked";}?>>
                                    <label class="custom-control-label" for="customRadioInline2">femme</label>
                                </div>
                            </div>    
                            </div>   

                            <div class="row justify-content-center">
                                <div class="form-group col-8"> 
                                    <label for="tel">Téléphone</label>
                                    <input type="tel" class="form-control" name="tel"  value="<?= $cl['telApprenant']?>">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="form-group col-8">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email"  value="<?= $cl['emailApprenant']?>">
                                </div>  
                            </div>
                            <div class="row justify-content-center pt-3">
                                <div class="form-group col-8">
                                    <button type="submit" class="btn btn-primary" name="editer">Enregistrer</button>
                                </div> 
                            </div>    
                        </form>
                        <!-- fin formulaire -->
                    </div>
                </div>              
            </div>  
        </div>
    <?php
	//cloture de la div id=content-wrapper uniquement necessaire pour les roles different de formateur
	if($_SESSION['PROFILE']['idRole'] != 1){?>
	</div>
	<?php }?>

    <!-- JS JQuery -->
    <script src="../vendor/jquery/jquery-3.5.1.min.js"></script>

    <!-- JS Bootstrap -->..
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- JS Wrapper -->
    <script src="../js/toggle-wrapper.js"></script>

    <!-- JS data table  -->
    <script src="../vendor/DataTables/datatables.min.js"></script>

    <!-- JS  -->
    <script src="../js/main.js"></script>

</body>
</html>