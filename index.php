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

	<!-- Style css -->
	<link rel="stylesheet" href="../css/style.css" type="text/css">

</head>

<body>




	<!-- Content Wrapper -->
	<div id="content-wrapper">
	
        
        <!-- Corps de page -->
        <div class="container p-5">
            <div class="row justify-content-center">
                <div  class="col-12 col-sm-6">
                    <div class="card border-info  mb-3">
                        <div class="card-header text-center connexion"><img src="../img/logob.png" class="logo2"/></div>
                        <div class="card-body">
                            <h5 class="card-title text-center">Identification</h5>
                            <!-- formulaire -->
                            <form class="needs-validation pt-3" method="post" action="authentifier.php" enctype="multipart/form-data" novalidate>          
                                <div class="row justify-content-center">
                                    <div class="form-group col-8"> 
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                <div class="form-group col-8">
                                        <label for="mdp">Mot de passe</label>
                                        <input type="password" class="form-control" name="mdp">
                                    </div>  
                                </div>
                                <div class="row justify-content-center pt-3">
                                    <div class="form-group col-1">
                                            <button type="submit" class="btn btn-info btnconnexion" name="ajouter">S'identifier</button>
                                    </div> 
                                </div>
                                <div class="row justify-content-center">
                                    <div class="form-group col-4">        
                                        <!--création des message d'alert en récupérant le code dans l'url  -->
                                        <p class="alert">
                                            <?php                               
                                                
                                                if(empty ($_GET['erreur'])){
                                                    $_GET['erreur']=null;
                                                }else{
                                                    if($_GET['erreur'] == 1){
                                                        echo "Mot de passe ou email incorrect";
                                                    }else{
                                                        $_GET['erreur']=null;
                                                    }
                                                }                                    
                                            ?>
                                        </p>                                                                                     
                                    </div>
                                </div>    
                            </form>
                            <!-- fin formulaire -->
                        </div>
                    </div> 
                </div>     
            </div>       
        </div>       
    </div>
	<!-- Pied de page -->

		<!-- JS JQuery -->
        <script src="../vendor/jquery/jquery-3.5.1.min.js"></script>

        <!-- JS Bootstrap -->..
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- JS Exemple Wrapper -->
        <script src="../js/toggle-wrapper.js"></script>


</body>
</html>