<?php
require_once './includes/autoload.php';
session_start();

if (isset($_GET['id'])) {
    $reponse = new Entity\Reponse();
    $reponseMapper = new Mapper\ReponseMapper();
    $reponse->setId_enquete($_GET['id']);
    $nbReponse = $reponseMapper->totalReponseByIdEnquete($reponse);
    var_dump($nbReponse);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Resultats - Enquetes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    
    <body>
                <div class="container">
            
            <div class="page-header">
                <h1 class="">Resultat de l'enquête</h1>
            </div>
                    <div>
                            <a class="btn btn-default btn-xs" href="member.php">Page membre</a>
                            <a class="btn btn-default btn-xs" href="deconnexion.php">Deconnexion</a>
                        </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="page-header">
                        <h3> Titre enquete : <?php echo $nbReponse[0]['titre']; ?></h3>
                        <h4>Description :</h4><p><?php echo $nbReponse[0]['description']; ?></p>
                    </div>
                    
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5>Total de reponses : <?php echo $nbReponse[0]['nb_reponse']; ?></h5>
                    <p>nombre de resultat</p>
                    <h6>Question1</h6>
                    <p>réponse</p>
                </div>
            </div>
        </div>
    </body>
</html>
