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

            <!-- bouton retour -->
            <div class="container-fluid pl-5 mt-3">
                <a class="retour" href="questionnaire.php"><i class="fas fa-long-arrow-alt-left return"></i></a>
            </div>

            <!-- ajout question -->
            
            <section class="container-fluid pl-5 mt-1">           
                <div class="row justify-content-center">
                    <article class="col-12 col-sm-8">
                    <span class="badge badge-info utilisateur mb-2"><?=$_SESSION['PROFILE']['emailUser']?></span>    
                    <div class="card border-info">
                            <div class="card-header text-center">Ajouter une question</div>
                            <div class="card-body">
                                <form class="form-group" action="evaluationFunction.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="questionnaire" value="<?=$_GET['idQuestionnaire']?>">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="categorie">Catégorie</label>
                                            <select id="categorie" class="form-control" name="categorie">
                                                <option value="">Choisissez la catégorie</option>
                                                <option value="1">Réaction</option>
                                                <option value="2">Apprentissage</option>
                                                <option value="3">Comportement</option>
                                                <option value="4">Résultat</option>
                                        </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="type">Type</label>
                                            <small class="text-muted">definit le style de réponse</small>
                                            <select id="type" class="form-control" name="type">
                                                <option value="">Choisissez un type de réponse</option>
                                                <option value="0">Curseur</option>
                                                <option value="1">Zone de texte</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="inputEmail4">Intitulé de la question</label>
                                            <small class="text-muted">maximum 250 caractères</small>
                                            <textarea class="form-control" name="intitule" id="intitule" cols="30" rows="2" maxlength="250" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info" name="ajouter">Ajouter</button>
                                    <span class="alert">
                                        <?php                                                                                 
                                            if(empty ($_GET['erreur'])){
                                                 $_GET['erreur']=null;
                                            }else{
                                                if($_GET['erreur'] == 1){
                                                    echo "Tous les champs doivent être remplis !";
                                                }else{
                                                    $_GET['erreur']=null;
                                                }
                                            }                                    
                                        ?>
                                    </span>
                                </form>
                                
                            </div>
                        </div>
                        
                    </article>
                </div>
            </section>
			<!-- fin ajout question -->

            <!-- affichage question -->
			<section class="container-fluid p-5">
                <div class="row">
                    <!-- affichage question reaction -->
                    <article class="col-12 col-sm-6 mb-4">
                        <div class="card border-info">
                            <div class="card-header text-center">Reaction</div>
                            <div class="card-body">
                                <ol class="questionOl">
                                <?php
                                    require_once"evaluationFunction.php";
                                    $idQuestionnaire=$_GET['idQuestionnaire'];
                                    $affichage=affichageQuestion();
                                    foreach($affichage as $question){
                                        if($question['idCategorie'] == 1){
                                        if($question['typeQuestion'] == 0){?>
                                            <li class="questionLi"><?=$question['intituleQuestion']?>
                                                <small class="commentaire text-muted"> réponse à curseur
                                                    <form class="pr-4" method="post" action="evaluationFunction.php?idQuestion=<?=$question['idQuestion']?>&idQuestionnaire=<?=$idQuestionnaire?>" enctype="multipart/form-data">
                                                        <button type="submit" name="supprimerQuestion" onclick="return confirm('Etes vous sur de vouloir supprimer la question: <?=$question['intituleQuestion']?>')" class="lien3"><i class="far fa-trash-alt"></i></button>	
                                                    </form>
                                                </small>
                                            </li>
                                        <?php }else{?>
                                            <li class="questionLi"><?=$question['intituleQuestion']?>
                                                <small class="commentaire text-muted"> réponse avec zone de texte
                                                    <form class="pr-4" method="post" action="evaluationFunction.php?idQuestion=<?=$question['idQuestion']?>&idQuestionnaire=<?=$idQuestionnaire?>" enctype="multipart/form-data">
                                                        <button type="submit" name="supprimerQuestion" onclick="return confirm('Etes vous sur de vouloir supprimer la question: <?=$question['intituleQuestion']?>')" class="lien3"><i class="far fa-trash-alt"></i></button>	
                                                    </form>
                                                </small>
                                            </li>
                                    <?php }}}?>                                                                        
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
                                    require_once"evaluationFunction.php";
                                    $affichage=affichageQuestion();
                                    foreach($affichage as $question){
                                        if($question['idCategorie'] == 2){
                                        if($question['typeQuestion'] == 0){?>
                                            <li class="questionLi"><?=$question['intituleQuestion']?><small class="commentaire text-muted"> réponse à curseur
                                            <form class="pr-4" method="post" action="evaluationFunction.php?idQuestion=<?=$question['idQuestion']?>&idQuestionnaire=<?=$idQuestionnaire?>" enctype="multipart/form-data">
											    <button type="submit" name="supprimerQuestion" onclick="return confirm('Etes vous sur de vouloir supprimer la question: <?=$question['intituleQuestion']?>')" class="lien3"><i class="far fa-trash-alt"></i></button>	
                                            </form></small>
                                            </li>
                                        <?php }else{?>
                                            <li class="questionLi"><?=$question['intituleQuestion']?><small class="commentaire text-muted"> réponse avec zone de texte
                                            <form class="pr-4" method="post" action="evaluationFunction.php?idQuestion=<?=$question['idQuestion']?>&idQuestionnaire=<?=$idQuestionnaire?>" enctype="multipart/form-data">
											    <button type="submit" name="supprimerQuestion" onclick="return confirm('Etes vous sur de vouloir supprimer la question: <?=$question['intituleQuestion']?>')" class="lien3"><i class="far fa-trash-alt"></i></button>	
                                            </form></small>
                                            </li>
                                    <?php }}}?>                                                                        
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
                                    require_once"evaluationFunction.php";
                                    $affichage=affichageQuestion();
                                    foreach($affichage as $question){
                                        if($question['idCategorie'] == 3){
                                        if($question['typeQuestion'] == 0){?>
                                            <li class="questionLi"><?=$question['intituleQuestion']?><small class="commentaire text-muted"> réponse à curseur
                                            <form class="pr-4" method="post" action="evaluationFunction.php?idQuestion=<?=$question['idQuestion']?>&idQuestionnaire=<?=$idQuestionnaire?>" enctype="multipart/form-data">
											    <button type="submit" name="supprimerQuestion" onclick="return confirm('Etes vous sur de vouloir supprimer la question: <?=$question['intituleQuestion']?>')" class="lien3"><i class="far fa-trash-alt"></i></button>	
                                            </form></small>
                                            </li>
                                        <?php }else{?>
                                            <li class="questionLi"><?=$question['intituleQuestion']?><small class="commentaire text-muted"> réponse avec zone de texte
                                            <form class="pr-4" method="post" action="evaluationFunction.php?idQuestion=<?=$question['idQuestion']?>&idQuestionnaire=<?=$idQuestionnaire?>" enctype="multipart/form-data">
											    <button type="submit" name="supprimerQuestion" onclick="return confirm('Etes vous sur de vouloir supprimer la question: <?=$question['intituleQuestion']?>')" class="lien3"><i class="far fa-trash-alt"></i></button>	
                                            </form></small>
                                            </li>
                                    <?php }}}?>                                                                        
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
                                    require_once"evaluationFunction.php";
                                    $affichage=affichageQuestion();
                                    foreach($affichage as $question){
                                        if($question['idCategorie'] == 4){
                                        if($question['typeQuestion'] == 0){?>
                                            <li class="questionLi"><?=$question['intituleQuestion']?><small class="commentaire text-muted"> réponse à curseur
                                            <form class="pr-4" method="post" action="evaluationFunction.php?idQuestion=<?=$question['idQuestion']?>&idQuestionnaire=<?=$idQuestionnaire?>" enctype="multipart/form-data">
											    <button type="submit" name="supprimerQuestion" onclick="return confirm('Etes vous sur de vouloir supprimer la question: <?=$question['intituleQuestion']?>')" class="lien3"><i class="far fa-trash-alt"></i></button>	
                                            </form></small>
                                            </li>
                                        <?php }else{?>
                                            <li class="questionLi"><?=$question['intituleQuestion']?><small class="commentaire text-muted"> réponse avec zone de texte
                                            <form class="pr-4" method="post" action="evaluationFunction.php?idQuestion=<?=$question['idQuestion']?>&idQuestionnaire=<?=$idQuestionnaire?>" enctype="multipart/form-data">
											    <button type="submit" name="supprimerQuestion" onclick="return confirm('Etes vous sur de vouloir supprimer la question: <?=$question['intituleQuestion']?>')" class="lien3"><i class="far fa-trash-alt"></i></button>	
                                            </form></small>
                                            </li>
                                <?php }}}?>                                                                        
                            </ol>
                            </div>
                        </div>
                    </article>
                </div>              
            </section>
            <!-- fin affichage question -->
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

</body>
</html>