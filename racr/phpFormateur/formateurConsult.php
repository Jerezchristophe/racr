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
			<li><a href="formateur.php"><i class="fas fa-chalkboard-teacher"></i><span>Formateurs</span></a></li>	
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
                <a class="retour" href="formateur.php"><i class="fas fa-long-arrow-alt-left return"></i></a>
			</div>
			
			<div class="container-fluid p-5 mt-2">
				<div class="row">
					<!-- détail du formateur -->
					<div class="col-12 col-md-6">
						<div class="card border-info mb-3">
							<div class="card-header text-center">Détail du formateur </div>
							<div class="card-body">
							<?php 		
								require_once'formateurFunction.php';//appel du fichier fonction pour permettre l'affichage
									$affichage=affichageEditionUser();
									foreach ($affichage as $cl){?>
								<h5 class="card-title">Nom</h5>
								<p class="card-text text-dark"><?= $cl['nomUser'] ?></p>
								<h5 class="card-title">Prenom</h5>
								<p class="card-text text-dark"><?= $cl['prenomUser'] ?></p>
								<h5 class="card-title">Email</h5>
								<p class="card-text text-dark"><?= $cl['emailUser'] ?></p>
								<h5 class="card-title">Télephone</h5>
								<p class="card-text text-dark"><?= $cl['telephoneUser'] ?></p>
								<h5 class="card-title">Code postal</h5>
								<p class="card-text text-dark"><?= $cl['codepostalUser'] ?></p>
							</div>
							<div class="card-body justify-content-center consultation">
								<a href="formateurEdit.php?idUser=<?= $cl['idUser'] ?>" class="button lien2"><i class="far fa-edit"></i></a>
								<form method="post" action="formateurFunction.php?idUser=<?= $cl['idUser'] ?>" enctype="multipart/form-data">
									<button  type="submit" name="supprimer" onclick="return confirm('Etes vous sur de vouloir supprimer le formateur')" class="lien3"><i class="far fa-trash-alt"></i></button>	
								</form>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- Detail du formateur -->

					<!-- gestion des formations -->
					<div class="col-12 col-md-6">
						<div class="card border-info mb-3">
							<div class="card-header text-center">Formations</div>
								<!--attribution des formations  -->
								<div class="card-body">
									<form class="pt-3" method="post" action="formateurFunction.php" enctype="multipart/form-data">
										<h5 class="card-title">Attribuer une formation</h5>
										<input type="hidden" name="idUser"value="<?= $cl['idUser'] ?>"><!--l'idFormateur cahcé pour qu'on puisse le récupérer par $POST -->
										<select type="text" class="form-control" name="idFormation" required>
												<option value="">Choisissez une formation</option>
											<?php
												require_once'../phpFormation/formationFunction.php';// requier le fichier fonction
												$liste=listeDeroulanteFormation();// on stocke la fonction dans une variable puis on echo les lignes de la table
												foreach ($liste as $option){?>
												<option value="<?= $option['idFormation'] ?>"><?= $option['intituleFormation'] ?></option>                                       
											<?php } ?>
										</select>
										<button type="submit" class="btn btn-info mt-3" name="attribuer">Attribuer</button>
									</form>
								</div>
								<!-- fin attribution formation -->

								<!-- affichage des formations attribuées -->
								<div class="card-body">					
									<h5 class="card-title pt-2">Formations attribuées</h5>
									<div class="card-body">
									<?php                       
									$affichF=affichageFormationAttribué();
									foreach ($affichF as $af){?>
										<div class="consultation">
										<p class="card-text text-dark"><?= $af['intituleFormation'] ?></p>
										<form method="post" action="formateurFunction.php?idAttribution=<?=$af['idAttribution']?>&idUser=<?=$cl['idUser']?>" enctype="multipart/form-data">
											<td class="text-center"><button  type="submit" name="supprimerAttibut" onclick="return confirm('Etes vous sur de vouloir supprimer la formation attribué')" class="lien3"><i class="far fa-trash-alt"></i></button></td>	
										</form>
									</div>
									<?php } ?>
									</div>
								</div>
								<!-- fin affichage des formations attribuées -->
							</div>
						</div>
					</div>
				</div>               
            </div>
    </div>

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