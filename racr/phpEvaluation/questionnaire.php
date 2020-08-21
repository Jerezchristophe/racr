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

	<!-- Style Font Awesome -->
	<link rel="stylesheet" href="../vendor/fontawesome/css/all.min.css" type="text/css">

	<!-- Style Bootstrap -->
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" type="text/css" />

	<!-- data table bibliotheque -->
	<link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.min.css"/>

	<!-- Style Exemple Wrapper -->
	<link rel="stylesheet" href="../css/style.css" type="text/css">

	<?php

		?>
</head>

<body>

	<!-- Sidebar Wrapper -->
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

			<!-- Corps de page -->
			
			<div class="container-fluid p-5 mt-5">
				<div class="row justify-content-center">

					<!-- gestion des questionnaires -->
					<div class="col-12 col-md-8">
					<!-- affichage de l'email de la session en cour -->
					<span class="badge badge-info utilisateur mb-2"><?=$_SESSION['PROFILE']['emailUser']?></span>
						<div class="card border-info mb-5">
							<div class="card-header">Gestion des questionnaires</div>
								<!--creer un questionnaire  -->
								<div class="card-body">
									<h5 class="card-title">Créer un questionnaire</h5>
										<form class="needs-validation pt-3" method="post" action="evaluationFunction.php" enctype="multipart/form-data">
											<div class="form-group">
												<label for="intituleQuestionnaire">Intitulé du questionnaire</label>
												<input class="form-control" type="text" id="intituleQuestionnaire" name="intituleQuestionnaire" required>
											</div>
											<button type="submit" class="btn btn-info" name="creerQuestionnaire">créer</button>
										</form>
								</div>
								
								<!-- fin créeation questionnaire -->

								<!-- affichage des questionnaires -->
								<div class="card-body table-responsive">					
									<h5 class="card-title pt-2">Listes des questionnaires</h5>
									<table class="table">
										<tbody>
											
												<?php
													require_once 'evaluationFunction.php';
													$listeQuestionnaire=afficherListeQuestionnaire();
													foreach($listeQuestionnaire as $quest){
												?>
												<tr>
												<td class="card-text text-dark"><?=$quest['intituleQuestionnaire']?></td>
												<td class="card-text text-dark"><?=date("d-m-Y",strtotime($quest['dateQuestionnaire']))?></td>											
												<td class="pl-4"><a href="editionQuestionnaire.php?idQuestionnaire=<?=$quest['idQuestionnaire']?>" class="lien2"><i class="far fa-edit"></i></a></td>									
												<td>
													<form method="post" action="evaluationFunction.php?idQuestionnaire=<?=$quest['idQuestionnaire']?>" enctype="multipart/form-data">
														<button type="submit" name="supprimerQuestionnaire" onclick="return confirm('Etes vous sur de vouloir supprimer la questionnaire: <?=$quest['intituleQuestionnaire']?>')" class="lien3"><i class="far fa-trash-alt"></i></button>
													</form>
												</td>
												</tr>
													<?php } ?>	
											
										</tbody>
									</table>
								</div>
								<!-- fin affichage des questionnaires -->
							</div>
						</div>
					</div>
					<!--fin gestion questionnaires  -->
				</div>               
            </div>
    </div>

	<!-- JS JQuery -->
	<script src="../vendor/jquery/jquery-3.5.1.min.js"></script>

	<!-- JS Bootstrap -->
	<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- JS Wrapper -->
	<script src="../js/toggle-wrapper.js"></script>

	<!-- JS data table  -->
	<script src="../vendor/DataTables/datatables.min.js"></script>

	<!-- JS  -->
	<script src="../js/main.js"></script>

</body></html>