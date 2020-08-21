<!-- pour vérifier l'authentification -->
<?php 
	session_start();
	require('../security.php');
	// require('../roleSadmin_admin.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>RACR</title>

	<!-- Style bibliotheque Font Awesome -->
	<link rel="stylesheet" href="../vendor/fontawesome/css/all.min.css" type="text/css">

	<!-- Style Bootstrap -->
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css" type="text/css" />

	<!-- data table bibliotheque -->
	<link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.min.css"/>

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
			<div class="container-fluid p-5">
				<span class="badge badge-info utilisateur mb-2"><?=$_SESSION['PROFILE']['emailUser']?></span>

				<div class="card border-info mb-3">
	<div class="card-header">Liste des apprenants<?php if($_SESSION['PROFILE']['idRole'] != 1){?><a href="apprenantAjout.php" class="lien ml-5"><i class="fas fa-plus-circle circle"> Ajouter un apprenant</i></a><?php }?></div>
					<div class="card-body table-responsive-lg">
						<!-- debut tableau affichage -->
						<table class="table table-info table-hover text-center mt-5" id="dtTable">						
							<thead>
								<tr>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Id formation</th>						
									<th>Email</th>
									<th>Sexe</th>
									<th>Age</th>
									<th>Téléphone</th>
									<th>Code postal</th>
									<th></th>
								</tr>
							</thead>     
							<tbody class="bg-white">
								<?php 	require_once'apprenantFunction.php';
										if($_SESSION['PROFILE']['idRole'] != 1){//si le role est différent de formateur, j'affiche tous les apprenants
											$affichage=affichageApprenant();
										}else{//sinon c'est un formateur, je n'affiche que les apprenants le concernant
											$affichage=affichageApprenantFormateur();
										}
										foreach ($affichage as $cl){?>
								<tr>								
									<td> <?= $cl['nomApprenant'] ?> </td>
									<td> <?= $cl['prenomApprenant'] ?> </td>
									<td> <?= $cl['intituleFormation'] ?> </td> 
									<td> <?= $cl['emailApprenant'] ?> </td>
									<td> <?= $cl['sexeApprenant'] ?> </td> 
									<td> <?= $cl['ageApprenant'] ?> </td>
									<td> <?= $cl['telApprenant'] ?> </td> 
									<td> <?= $cl['codepostalApprenant'] ?> </td>
									<td><a href="apprenantConsult.php?idApprenant=<?= $cl['idApprenant'] ?>" class="button lien2" type="submit"><i class="far fa-eye"></i></a></td>																		
								</tr>      
								<?php } ?>	 
							</tbody>
						</table>    			
						<!-- fin tableau affichage -->
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

	<!-- JS Bootstrap -->
	<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- JS Wrapper -->
	<script src="../js/toggle-wrapper.js"></script>

	<!-- JS data table  -->
	<script src="../vendor/DataTables/datatables.min.js"></script>

	<!-- JS  -->
	<script src="../js/main.js"></script>

</body></html>