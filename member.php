<?php 
session_start();

if(isset($_SESSION['user_id'])){
    
    //si la session utilisateur existe, la personne est connecté donc on recupere la liste des enquetes de cette personne
    $enquete = new Mapper\EnqueteMapper();
    $listEnquetes = $enquete->getEnqueteById($_SESSION['user_id']); 
}
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
            
            <h4>Compte de PASCAL HENRI</h4>
            <img src="#" alt="photo profil" title="Photo profil" height="70" width="70">
            <button>Modifier compte</button>
            <button>Supprimer compte</button>
            
            <h5>Liste des enquetes :</h5>
            <div>
                <?php if ($listEnquetes){?>
                <ul>
                   <?php foreach ($listEnquetes as $elt){?>
                    <li><?php echo $elt ?></li></br>
                       <button class="btn btn-primary">Show</button>
                       <button class="btn btn-warning">Update</button>
                       <button class="btn btn-danger">Delete</button>
                       <button class="btn btn-success">Results</button>
                    <?php } ?>
                </ul>
                <?php } ?>                 
            </div>  
            <div>
                <a href="creation_modification.php"><button class="btn btn-default">Nouvelle Enquete</button></a>
            </div>
            </div>
    </body>
</html>
