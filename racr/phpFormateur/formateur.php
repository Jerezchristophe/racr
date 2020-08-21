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

	<!-- data table bibliotheque -->
	<link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.min.css"/>

	<!-- Style Exemple Wrapper -->
	<link rel="stylesheet" href="../css/style.css" type="text/css">
	
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
			<div class="container-fluid p-5">
			<span class="badge badge-info utilisateur mb-2"><?=$_SESSION['PROFILE']['emailUser']?></span>

				<div class="card border-info mb-3">
					<div class="card-header">Liste de vos formateurs<a href="formateurAjout.php" class="lien ml-5"><i class="fas fa-plus-circle circle"> Nouveau formateur</i></a></div>
					<div class="card-body table-responsive-lg">
				
					<!-- debut tableau affichage -->

						<table class="table table-info table-hover text-center mt-5" id="dtTable">
													
								<thead>
									<tr>
										<th>Nom</th>
										<th>Prénom</th>						
										<th>Email</th>								
										<th>Téléphone</th>
										<th>Code postal</th>
										<th></th>
									</tr>
								</thead>     
								<tbody class="bg-white">
								<?php 	require_once'formateurFunction.php';//appel du fichier function
										$affichage=affichageformateur();									
										foreach ($affichage as $cl){?>
									<tr>								
										<td><?=$cl['nomUser']?></td>
										<td><?=$cl['prenomUser']?></td>
										<td><?=$cl['emailUser']?></td>
										<td><?=$cl['telephoneUser']?></td> 
										<td><?=$cl['codepostalUser']?></td>
										<td><a href="formateurConsult.php?idUser=<?= $cl['idUser'] ?>" class="button lien2" type="submit"><i class="far fa-eye"></i></a></td>																
									</tr>      
									<?php } ?>	 
								</tbody>
						</table>    			
					<!-- fin tableau affichage -->
					</div>
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