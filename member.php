<?php
require_once './includes/autoload.php';

session_start();
if (isset($_SESSION['user_id'])) {

    //si la session utilisateur existe, la personne est connecté donc on recupere la liste des enquetes de cette personne
    $enqueteMapper = new Mapper\EnqueteMapper(); // appel de la class enqueteMapper
    $utilisateur = new Entity\Utilisateur(); //appel de l entity Utilisateur
    $enquete = new Entity\Enquete(); // appel de l entity Enquete
    $utilisateur->setId_utilisateur($_SESSION['user_id']); // set de l'id_utilisateur dans l'objet utilisateur
    $enquete->setUtilisateur($utilisateur); // association de l'objet utilisateur sur l'objet enquete
    $listEnquetes = $enqueteMapper->getEnqueteByIdUtilisateur($enquete);
}

$message = "Vous n'avez pas encore créé d'enquêtes!";
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
        <header class="navbar navbar-fixed-top navbar-inverse">
                <
        </header>
        <div class="container">
            <div class="page-header">
                <h1 class="">Espace Membre</h1>
            </div>
            <img src="img/users_default.png" alt="photo profil" title="Photo profil" height="100" width="100">
            <h4>Compte de :<?php //$_SESSION['nom'] ?> <?php //$_SESSION['prenom'] ?></h4>
            <div>
                <button>Modifier compte</button>
                <button>Supprimer compte</button>
                <button>Deconnexion</button>
            </div>

            <h5>Liste des enquetes :</h5>
            <div>
                <?php if ($listEnquetes) { ?>
                    <ul class="list-group-item-text">
                        <?php foreach ($listEnquetes as $elt) {
                            $enquete->setId_Enquete($elt['ID_ENQUETE']);
                            ?>
                        <li class=""><?php echo $elt['TITRE'] ?></li><br>
                            <a href="creation_modif.php"><button type="button" class="btn btn-primary">Show</button></a>
                            <a href="creation_modif.php?id=<?php echo $enquete->getId_Enquete(); ?>"><button type="button" class="btn btn-warning">Update</button></a>
                            <button type="button" class="btn btn-danger">Delete</button>
                            <a href="result.php"><button type="button" class="btn btn-success">Results</button></a><br><br>
                        <?php } ?>
                    </ul>

                <?php } else { ?>
                    <p><?php echo $message; ?></p>
                <?php } ?>
            </div>  
            <div>
                <a href="creation_modif.php"><button type="button" class="btn btn-default">Nouvelle Enquete</button></a>
            </div>
        </div>
    </body>
</html>