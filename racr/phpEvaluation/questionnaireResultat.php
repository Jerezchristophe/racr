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
			<li><a href="../phpApprenant/apprenant.php"><i class="fas fa-graduation-cap"></i><span>Apprenants</span></a></li>
			<li><a href="questionnaire.php"><i class="fas fa-align-left"></i><span>Gestion des questionnaires</span></a></li>	
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
			<section class="container-fluid pl-5 mt-5">           
                <div class="row justify-content-center">
                    <article class="col-12 col-sm-8">   
                    <div class="card border-info">
                            <div class="card-header text-center">Questionnaire Resultat</div>
                            <div class="card-body">
								<form action="evaluationFunction.php" method="post" enctype="multipart/form-data">
									<ol class="questionOl">
										<?php
											require_once"evaluationFunction.php";
											$affichage=affichageQuestion();
											foreach($affichage as $question){
													if($question['idCategorie'] == 4){?>
													<li class="questionLi py-3"><?=$question['intituleQuestion']?></li>
													<input type="hidden" name="idQuestionnaire" value="<?=$_GET['idQuestionnaire']?>">
													<input type="hidden" name="idEvaluation" value="<?=$_GET['idEvaluation']?>">
													<input type="hidden" name="question[]" value="<?=$question['idQuestion']?>">
												<?php if($question['typeQuestion'] == 0){?>											
													<input type="range" class="range custom-slider custom-slider-bullet" name="reponse[]" value="-1" min="-1" max="5">
													<p class="rangevaleur">N 0 1 2 3 4 5</p>
												<?php }else{?>
													<textarea class="col-12" name="reponse[]" cols="100" rows="3">votre réponse</textarea>
											<?php }}}?>
											<button type="submit" class="btn btn-success mt-4" name="enregistrerReponse">Valider</button>
											<button type="submit" class="btn btn-info mt-4" name="passerReponse">Passer</button>                                                                         
										</ol>										
									</form>	
                            </div>
                        </div>
                        
                    </article>
                </div>
            </section>		
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