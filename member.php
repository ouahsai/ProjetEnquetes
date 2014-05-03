<?php
require_once './includes/autoload.php';

session_start();

$message = "";

$pagination = new Entity\Pagination();
if (isset($_GET['page'])) {
    $pagination->setPageDebut($_GET['page']);
}
if (isset($_SESSION['user_id'])) {

    //si la session utilisateur existe, la personne est connecté donc on recupere la liste des enquetes de cette personne
    $enqueteMapper = new Mapper\EnqueteMapper(); // appel de la class enqueteMapper
    $utilisateur = new Entity\Utilisateur(); //appel de l'entity Utilisateur
    $enquete = new Entity\Enquete(); // appel de l'entity Enquete
    $enquete->setId_utilisateur($_SESSION['user_id']);
    
    //$utilisateur->setId_utilisateur(15); // set de l'id_utilisateur dans l'objet utilisateur
    //$enquete->setUtilisateur($utilisateur); // association de l'objet utilisateur sur l'objet enquete
    $listEnquetes = $enqueteMapper->getEnqueteByIdUtilisateur($enquete, $pagination);
    
    if (!$listEnquetes){ //affiche un message d'erreur
        $message = "Vous n'avez pas encore créé d'enquêtes !";
    }
}

// suppression de l'enquête
if (isset($_GET['id'])) {

    $enqueteMapper = new Mapper\EnqueteMapper(); // appel de la class enqueteMapper
    $questionMapper = new Mapper\QuestionMapper();
    $qcmMapper = new Mapper\QcmMapper();
    $reponseMapper = new Mapper\ReponseMapper();

    $enquete = new Entity\Enquete(); // appel de l entity Enquete
    $enquete->setId_enquete($_GET['id']);
    $question = new Entity\Question();
    $question->setId_enquete($_GET['id']);
    $qcm = new Entity\Qcm();
    $reponse = new Entity\Reponse();
    
    // on recupere la list des id_question correspondant à l'id_enquete
    $listIdQuestion = $questionMapper->selectIdQuestion($question);

    foreach ($listIdQuestion as $idQuestion) {
        $reponse->setId_question($idQuestion);
        $reponseMapper->deleteReponse($reponse);
        $qcm->setId_question($idQuestion);
        $qcmMapper->deleteQCM($qcm);
    }
    $questionMapper->deleteQuestion($question);
    $enqueteMapper->deleteEnqueteById($enquete);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Membre - Enquetes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
<!--        <header class="navbar navbar-fixed-top navbar-inverse">

        </header>-->
        
        <div class="member container">
            <div class="page-header clearfix">
                <div class="user clearfix">
                    <img src="img/users_default.png" alt="photo profil" title="Photo profil" height="52" width="52">
                    <div class="block-user">
                        <h4>Utilisateur connecté : <?= htmlspecialchars($_SESSION["nom"] ." ". $_SESSION["prenom"]) ?></h4>
                        <div>
                            <a class="btn btn-default btn-xs" href="index.php">Modifier compte</a>
                            <a class="btn btn-default btn-xs" href="">Supprimer compte</a>
                            <a class="btn btn-default btn-xs" href="deconnexion.php">Deconnexion</a>
                        </div>
                    </div>
                </div>
                <h1>Espace Membre</h1>
            </div>
            
            <h4>Liste des enquetes :</h4>
            <table class="table table-striped">
                <?php if (!empty($listEnquetes)) : ?>
                    <?php foreach ($listEnquetes as $value) : ?>
                        <tr>
                            <td><div><?= $value['titre'] ?></div></td>
                            <td><a class="btn btn-default btn-sm" href="enquete.php">Voir l'enquête</a></td>
                            <td><a class="btn btn-default btn-sm" href="resultats.php?id=<?= htmlspecialchars($value['id_enquete']) ?>">Résultats</a></td>
                            <td><a class="btn btn-warning btn-sm" href="enquete.php?id=<?= htmlspecialchars($value['id_enquete']) ?>">Modifier l'enquête</a></td>
                            <td><a class="btn btn-danger btn-sm" href="member.php?id=<?= htmlspecialchars($value['id_enquete']) ?>">Supprimer l'enquête</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="alert alert-info">
                        <p><?= $message ?></p>
                    </div>
                    <a class="btn btn-primary" href="enquete.php">Nouvelle Enquete</a>
                <?php endif; ?>
            </table>
        </div>
    </body>
</html>
