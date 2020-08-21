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

	<!-- Sidebar Wrapper -->
	<div id="sidebar-wrapper" class="active">
			<img src="../img/logob.png" class="logo" />
		<ul>
			<li><a href="../phpAdmin/admin.php"><i class="fas fa-tachometer-alt"></i><span>Admin</span></a></li>
			<li><a href="formation.php"><i class="fas fa-table"></i><span>Formations</span></a></li>
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
			
			<div class="container-fluid p-5">
				<span class="badge badge-info utilisateur mb-2"><?=$_SESSION['PROFILE']['emailUser']?></span>
				<!-- card -->
				<div class="card border-info mb-3">
					<div class="card-header">Liste des formations<a href="formationAjout.php" class="lien ml-5"><i class="fas fa-plus-circle circle"> Nouvelle formation</i></a></div>
					<div class="card-body table-responsive-lg">
					<!-- debut tableau d'affichage -->
						<table class="table table-info table-hover text-center mt-5" id="dtTable">						
							<thead>
								<tr>
									<th>Intitulé</th>
									<th>Domaine</th>
									<th>Date de début</th>						
									<th>Date de fin</th>
									<th></th>
									<th></th>
								</tr>
							</thead>     
							<tbody class="bg-white">
							<?php 	require_once'formationFunction.php';
									$affichage=affichageformation();
									foreach ($affichage as $cl){?>
								<tr>								
									<td> <?= $cl['intituleFormation'] ?> </td>
									<td> <?= $cl['domaineFormation'] ?> </td>
									<td data-order="<?=$cl['dateDebutFormation']?>"> <?= date("d-m-Y",strtotime($cl['dateDebutFormation'])); ?> </td> 
									<td data-order="<?=$cl['dateFinFormation']?>"> <?= date("d-m-Y",strtotime($cl['dateFinFormation'])) ?> </td>
									<td><a href="formationEdit.php?idFormation=<?= $cl['idFormation'] ?>" class="button lien2" type="submit"><i class="far fa-edit"></i></a></td>	
										<form method="post" action="formationFunction.php?idFormation=<?= $cl['idFormation'] ?>" enctype="multipart/form-data">
											<td><button  type="submit" name="supprimer" onclick="return confirm('Attention ! Les apprenants de cette formation seront sans formation ! Etes vous sur de vouloir supprimer la formation ?')" class="lien3"><i class="far fa-trash-alt"></i></button></td>	
										</form>																		
								</tr>      
							<?php } ?>	 
							</tbody>	
						</table>    
					</div>
				</div>




				
			</div>
			<!-- fin tableau affichage -->
		
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