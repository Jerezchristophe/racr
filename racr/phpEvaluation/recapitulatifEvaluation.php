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
    
        <!-- bouton retour -->
        <?php
            require_once'evaluationFunction.php';
            $idApprenant=informationEvaluation();
            foreach ($idApprenant as $idA);
        ?>          
        <div class="container-fluid pl-5 mt-3">
            <a class="retour" href="../phpApprenant/apprenantConsult.php?idApprenant=<?=$idA['idApprenant']?>"><i class="fas fa-long-arrow-alt-left return"></i></a>
        </div>

        <div class="container-fluid px-5 pt-4">
            <div class="row">
                <!-- détail apprenant -->
					<article class="col-12 col-md-6">
						<div class="card border-info mb-3">
							<div class="card-header text-center">Détail de l'évaluation</div>
							<div class="card-body">
							<?php 		
								$information=informationEvaluation();
								 foreach ($information as $info){?>

											<p class=" text-dark"><?= $info['nomApprenant'] ?> <?= $info['prenomApprenant'] ?></p>
											<p class=" text-dark"></p>
										    <p class=" text-dark"><?= $info['emailApprenant'] ?></p>
									

								<div class="container pb-4">
									<div class="row">
										<div class="col-12 col-sm-6">
											<h5 class="card-title">Formation</h5>										
                                            <p class="card-text text-dark"><?= $info['intituleFormation'] ?></p>
										</div>
										<div class="col-12 col-sm-6">
											<h5 class="card-title">Num évaluation</h5>
											<p class="card-text text-dark"><?= $info['idEvaluation'] ?></p>
										</div>
									</div>
								</div>							
							</div>
							<?php } ?>
						</div>
					</article>
					<!-- fin detail apprenant -->
            </div>
        </div>
            <!-- affichage question -->
			<section class="container-fluid px-5">
                <div class="row">
                    <!-- affichage question reaction -->
                    <article class="col-12 col-sm-6 mb-4">
                        <div class="card border-info">
                            <div class="card-header text-center">Reaction</div>
                            <div class="card-body">
                                <ol class="questionOl">
                                <?php
                                    $recap=recapitulatifEvaluation();
                                    foreach($recap as $resultat){
                                            if($resultat['idCategorie'] == 1){?>
                                            <li class="questionLi"><?=$resultat['intituleQuestion']?><p class="reponse"><?php if($resultat['valeurReponse']== "-1"){
                                                                                                                                    echo"Pas de réponse";
                                                                                                                                }elseif($resultat['valeurReponse']== "votre réponse"){
                                                                                                                                    echo"Pas de réponse";
                                                                                                                                }else{
                                                                                                                                    echo $resultat['valeurReponse'];}?></p></li>                                         
                                        <?php }} ?>                                                                      
                                </ol>                               
                            </div>
                        </div>
                    </article>
                    <!-- affichage question apprentissage -->
                    <article class="col-12 col-sm-6 mb-4">
                        <div class="card border-info">
                            <div class="card-header text-center">Apprentissage</div>
                            <div class="card-body">
                                <ol class="questionOl">
                                <?php   
                                        $recap=recapitulatifEvaluation();
                                        foreach($recap as $resultat){
                                        if($resultat['idCategorie'] == 2){?>
                                            <li class="questionLi"><?=$resultat['intituleQuestion']?><p class="reponse"><?php if($resultat['valeurReponse']== "-1"){
                                                                                                                                    echo"Pas de réponse";
                                                                                                                                }elseif($resultat['valeurReponse']== "votre réponse"){
                                                                                                                                    echo"Pas de réponse";
                                                                                                                                }else{
                                                                                                                                    echo $resultat['valeurReponse'];}?></p></li> 
                                <?php }} ?>                                                                                                                                                                        
                                </ol>
                            </div>
                        </div>
                    </article>
                    <!-- affichage question comportement -->
                    <article class="col-12 col-sm-6 mb-4">
                        <div class="card border-info">
                            <div class="card-header text-center">Comportement</div>
                            <div class="card-body">
                                <ol class="questionOl">
                                <?php
                                    $recap=recapitulatifEvaluation();
                                    foreach($recap as $resultat){
                                    if($resultat['idCategorie'] == 3){?>
                                            <li class="questionLi"><?=$resultat['intituleQuestion']?><p class="reponse"><?php if($resultat['valeurReponse']== "-1"){
                                                                                                                                    echo"Pas de réponse";
                                                                                                                                }elseif($resultat['valeurReponse']== "votre réponse"){
                                                                                                                                    echo"Pas de réponse";
                                                                                                                                }else{
                                                                                                                                    echo $resultat['valeurReponse'];}?></p></li>
                                    <?php }}?>                                                                        
                                </ol>
                            </div>
                        </div>
                    </article>
                    <!-- affichage question resultat -->
                    <article class="col-12 col-sm-6 mb-4">
                        <div class="card border-info">
                            <div class="card-header text-center">Résultat</div>
                            <div class="card-body">
                            <ol class="questionOl">
                                <?php
                                    $recap=recapitulatifEvaluation();
                                    foreach($recap as $resultat){
                                    if($resultat['idCategorie'] == 4){?>
                                            <li class="questionLi"><?=$resultat['intituleQuestion']?><p class="reponse"><?php if($resultat['valeurReponse']== "-1"){
                                                                                                                                    echo"Pas de réponse";
                                                                                                                                }elseif($resultat['valeurReponse']== "votre réponse"){
                                                                                                                                    echo"Pas de réponse";
                                                                                                                                }else{
                                                                                                                                    echo $resultat['valeurReponse'];}?></p></li>
                                <?php }}?>                                                                        
                            </ol>
                            </div>
                        </div>
                    </article>
                    <!-- bouton impression de la page -->
                    <div class="container-fluid px-5 mb-5">
                        <div class="row justify-content-center">
                            <div>
                                <input class="btn btn-info" type="button" value="imprimer" onClick="window.print()">  
                            </div>                            
                        </div>                      
                    </div>
                </div>              
            </section>
            <!-- fin affichage question -->

            
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