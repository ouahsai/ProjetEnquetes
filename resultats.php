<?php
require_once './includes/autoload.php';
session_start();

if (isset($_GET['id'])) {
    $reponse = new Entity\Reponse();
    $reponseMapper = new Mapper\ReponseMapper();
    $reponse->setId_enquete($_GET['id']);
    $reponse->setId_question(8);
    $nbReponse = $reponseMapper->totalReponseByIdEnquete($reponse);
    $reponsequestion = $reponseMapper->reponseQuestionTexte($reponse);
    var_dump($reponsequestion);
    
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
                    <h5>Total de répondants : <?php echo $nbReponse[0]['nb_reponse']; ?></h5>
                    
                    <h6>Question :  <?php echo $reponsequestion[0]['libelle_question'] ?> </h6>
                    <p>réponse:  <?php foreach ($reponsequestion as $value){ ?>
                    <li><?php echo $value['valeur_reponse']; ?></li>
                    <?php } ?> </p>
                </div>
            </div>
        </div>
    </body>
</html>
