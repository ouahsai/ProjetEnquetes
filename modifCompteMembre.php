<?php
require_once './includes/autoload.php';
session_start();
$message = "";
$utilisateur = new \Entity\Utilisateur();
$mapper = new \Mapper\UtilisateurMapper();
//TODO errors 

if (isset($_SESSION['user_id'])) {
    
    $utilisateur->setId_utilisateur($_SESSION['user_id']);
    $infoUtilisateur = $mapper->GetAllUtilisateurByIdUtilisateur($utilisateur); 
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Accueil - Enquetes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    
    <body>
<!--        <header class="navbar navbar-fixed-top navbar-inverse">

        </header> -->

        <div class="index container">
            
            <div class="page-header">
                <h1 class="">Modifcation du compte</h1>
            </div>
            
            <?php if (!empty($message)) : ?>
                <div class="alert alert-danger">
                    <p><?= $message ?></p>
                </div>
            <?php endif; ?>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h4><span class="glyphicon glyphicon-user"></span> <?= htmlspecialchars($_SESSION["nom"] ." ". $_SESSION["prenom"]) ?> </h4>
                    </div>
                    <form method="POST" action="includes/common.php" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="lastname">Nom * :</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="lastname" id="lastname" value="<?php echo $infoUtilisateur[0]['NOM'];?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="firstname">Prenom * :</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="firstname" id="firstname" value="<?php echo $infoUtilisateur[0]['PRENOM'];?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="join_email">Identifiant (e-mail) * :</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="email" name="join_email" id="join_email" value="<?php echo $infoUtilisateur[0]['EMAIL'];?>" required>
                            </div>
                        </div>
                       <div class="form-group">
                            <label class="col-sm-4 control-label" for="join_pwd">Mot de passe * :</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="password" name="join_pwd" id="join_pwd" placeholder="Nouveau mot de passe" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-9">
                                <input type="submit" class="btn btn-primary" value="Valider">
                            </div>
                        </div>
                    </form>
                </div>
               
                
                
                
            </div>
        </div>
    </body>
</html>
