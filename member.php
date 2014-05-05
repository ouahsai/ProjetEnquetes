<?php
require_once './includes/autoload.php';

session_start();

//si la session utilisateur existe, la personne est connecté donc on 
//recupere la liste des enquetes de cette personne
if (isset($_SESSION['user_id'])) {
    
    $pagination = new Entity\Pagination();

    if (isset($_GET['page'])) {
        $pagination->setPageDebut($_GET['page']);
        $page = $_GET['page'];
    }
    
    $enquete = new Entity\Enquete();
    $enqueteMapper = new Mapper\EnqueteMapper();
    
    require_once './suppression.php';
    
    $enquete->setId_utilisateur((int) $_SESSION['user_id']);
    $listEnquetes = $enqueteMapper->getEnqueteByIdUtilisateur($enquete, $pagination);
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
            
            <?php if ($listEnquetes) : ?>
                <h4>Liste des enquetes :</h4>
                <div class="table-container">
                    <table class="table table-striped">
                        <?php foreach ($listEnquetes as $value) : ?>
                            <tr>
                                <td><div><?= $value['titre'] ?></div></td>
                                <td><a class="btn btn-default btn-sm" href="enquete.php">Voir l'enquête</a></td>
                                <td><a value="<?= htmlspecialchars($value['id_enquete'])?>" class="btn btn-default btn-sm" href="resultats.php?id=<?= htmlspecialchars($value['id_enquete']) ?>">Résultats</a></td>
                                <td><a value="<?= htmlspecialchars($value['id_enquete']) ?>" class="btn btn-warning btn-sm" href="enquete.php?id=<?= htmlspecialchars($value['id_enquete']) ?>">Modifier</a></td>
                                <td><a value="<?= htmlspecialchars($value['id_enquete']) ?>" class="btn btn-danger btn-sm" href="suppression.php?id=<?= htmlspecialchars($value['id_enquete']) ?>">Supprimer</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="pagination-container clearfix">
                    <?php if ($pagination->get_number_pages() > 1) : ?>
                        <ul class="pagination">
                            <?php for($i=1; $i<=$pagination->get_number_pages(); $i++) : ?>
                                <li class="<?= $i == $page ? "active" : "" ?>"><a href="member.php?page=<?= $i ?>"><?= $i ?></a></li>
                            <?php endfor; ?>
                        </ul>
                    <?php endif; ?>
                    <a class="btn btn-primary" href="enquete.php">Nouvelle Enquête</a>
                </div>
            <?php else : ?>
                <div class="alert alert-info">
                    <p>La liste des enquêtes est vide !</p>
                </div>
                <a class="btn btn-primary" href="enquete.php">Nouvelle Enquête</a>
            <?php endif; ?>
        </div>
    </body>
</html>
