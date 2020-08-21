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
					<li class="nav-item">
						<a class="nav-link" href="apprenant.php">Mes apprenants</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../phpFormateur/formateurEdit.php?idUser=<?=$_SESSION['PROFILE']['idUser']?>">Mon compte</a>
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
            	<a class="retour" href="apprenant.php"><i class="fas fa-long-arrow-alt-left return"></i></a>
        	</div>
        
			<div class="container-fluid p-5 mt-2">
				<div class="row">
					<!-- détail apprenant -->
					<article class="col-12 col-md-6">
						<div class="card border-info mb-3">
							<div class="card-header text-center">Détail de l'apprenant</div>
							<div class="card-body">
							<?php 		
								require_once'apprenantFunction.php';
								$affichage=consultApprenant();
								 foreach ($affichage as $cl){?>
								<div class="container pb-4">
									<div class="row">
										<div class="col-12 col-sm-6">
											<h5 class="card-title">Nom</h5>
											<p class="card-text text-dark"><?= $cl['nomApprenant'] ?></p>
										</div>
										<div class="col-12 col-sm-6">
											<h5 class="card-title">Prenom</h5>
											<p class="card-text text-dark"><?= $cl['prenomApprenant'] ?></p>
										</div>
									</div>
								</div>
								<div class="container pb-4">
									<div class="row">
										<div class="col-12 col-sm-6">
											<h5 class="card-title">Email</h5>
											<p class="card-text text-dark"><?= $cl['emailApprenant'] ?></p>
										</div>
										<div class="col-12 col-sm-6">
											<h5 class="card-title">Formation</h5>
											<p class="card-text text-dark"><?= $cl['intituleFormation'] ?></p>
										</div>
									</div>
								</div>
								<div class="container pb-4">
									<div class="row">
										<div class="col-12 col-sm-6">
											<h5 class="card-title">Age</h5>
											<p class="card-text text-dark"><?= $cl['ageApprenant'] ?></p>
										</div>
										<div class="col-12 col-sm-6">
											<h5 class="card-title">Sexe</h5>
											<p class="card-text text-dark"><?= $cl['sexeApprenant'] ?></p>
										</div>
									</div>
								</div>
								<div class="container pb-4">
									<div class="row">
										<div class="col-12 col-sm-6">
											<h5 class="card-title">Téléphone</h5>
											<p class="card-text text-dark"><?= $cl['telApprenant'] ?></p>
										</div>
										<div class="col-12 col-sm-6">
											<h5 class="card-title">Code postal</h5>
											<p class="card-text text-dark"><?= $cl['codepostalApprenant'] ?></p>
										</div>
									</div>
								</div>								
							</div>
							<div class="card-body justify-content-center consultation">
								<a href="apprenantEdit.php?idApprenant=<?= $cl['idApprenant'] ?>" class="button lien2"><i class="far fa-edit"></i></a>
								<?php
								//bouton de supression uniquement pour les Roles admins
								if($_SESSION['PROFILE']['idRole'] != 1){?>
								<form method="post" action="ApprenantFunction.php?idApprenant=<?= $cl['idApprenant'] ?>" enctype="multipart/form-data">
									<button  type="submit" name="supprimer" onclick="return confirm('Etes vous sur de vouloir supprimer l\'apprenant')" class="lien3"><i class="far fa-trash-alt"></i></button>	
								</form>
								<?php }?>
							</div>
							<?php } ?>
						</div>
					</article>
					<!-- fin detail apprenant -->

					<!-- gestion des evaluations -->
					<article class="col-12 col-md-6">
						<div class="card border-info mb-3">
							<div class="card-header text-center">Evaluations</div>
								<div class="card-body">

									<!-- créer évaluation -->
									<div class="container pb-4">
										<div class="row">
											<div class="col-12 text-center">
												<form method="post" action="../phpEvaluation/evaluationFunction.php?idApprenant=<?=$cl['idApprenant']?>" enctype="multipart/form-data">
													<select type="text" class="form-control" name="questionnaire" required>
														<option value="">Choisissez un questionnaire</option>
														<?php
															require_once'../phpEvaluation/evaluationFunction.php';
															$listeQuestionnaire=afficherListeQuestionnaire();
															foreach($listeQuestionnaire as $questionnaire){?>															
															<option value="<?=$questionnaire['idQuestionnaire']?>"><?=$questionnaire['intituleQuestionnaire']?></option>
															<?php } ?>														
													</select>
													<button type="submit" class="btn btn-info mt-3" name="evaluer">Evaluer</button>
												</form>
											</div>
										</div>
									</div>
									<!-- fin création évaluation -->

									<!-- liste des évaluations -->
									<div class="container pb-4">
									<div class="row">
										<div class="col-12">
											<h5 class="card-title">Evaluations éffectuées</h5>

											<?php											
												$affichageEvaluation=affichageEvaluation();
												$ligne=$affichageEvaluation->rowCount();
												if($ligne == 0){?> 
													<p class="card-text text-dark">Aucune évaluation effectuée</p>
												<?php }else{ 
													foreach($affichageEvaluation as $ae) {?>
														<p class="card-text text-dark"><?=$ae['idEvaluation']?>-<?=$ae['dateEvaluation']?><a href="../phpEvaluation/recapitulatifEvaluation.php?idEvaluation=<?=$ae['idEvaluation']?>" class="button lien2 ml-4" type="submit"><i class="far fa-eye"></i></a></p>
												<?php }}?>
										</div>
									</div>
									<!-- fin liste des évaluations -->
								</div>									
								</div>								
							</div>
						</div>
					</article>
					<!-- fin gestion des evaluations -->
				</div>
			</div>
			<!-- fin tableau affichage -->
		
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

</body></html>