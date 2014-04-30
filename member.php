<?php 
require_once './includes/autoload.php';

session_start();
if(isset($_SESSION['user_id'])){
    
    //si la session utilisateur existe, la personne est connecté donc on recupere la liste des enquetes de cette personne
    $enquete = new Mapper\EnqueteMapper();
    $listEnquetes = $enquete->getEnqueteByIdUtilisateur(1); 
    var_dump($listEnquetes);
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
    </head>
    <body>
        <div class="container">
            
            
            <img src="img/users_default.png" alt="photo profil" title="Photo profil" height="100" width="100">
            <!--<h4>Compte de <?php $_SESSION['nom']?> <?php $_SESSION['prenom']?></h4>-->
            <div>
                <button>Modifier compte</button><br>
                <button>Supprimer compte</button>
            </div>
            
            <h5>Liste des enquetes :</h5>
            <div>
                <?php if ($listEnquetes){?>
                <ul>
                   <?php foreach ($listEnquetes as $elt){?>
                    <li><?php echo $elt['TITRE'] ?></li><br>
                    <a href="creation_modif.php"><button class="btn btn-primary">Show</button></a>
                    <a href="creation_modif.php?id=<?php echo $elt['ID_ENQUETE']?>"><button class="btn btn-warning">Update</button></a>
                    <button class="btn btn-danger">Delete</button>
                    <a href="result.php"><button class="btn btn-success">Results</button></a>
                    <br><br>
                    <?php } ?>
                </ul>
                
                <?php } else{ ?>
                <p><?php echo $message; ?></p>
                <?php }?>
            </div>  
            <div>
                <a href="creation_modif.php"><button class="btn btn-default">Nouvelle Enquete</button></a>
            </div>
            </div>
    </body>
</html>
