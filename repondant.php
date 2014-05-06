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
                <h1 class="">Projet enquêtes</h1>
            </div>
            
            <?php if (!empty($message)) : ?>
                <div class="alert alert-danger">
                    <p><?= $message ?></p>
                </div>
            <?php endif; ?>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="page-header">
                        <h4><span class="glyphicon glyphicon-user"></span> Inscription</h4>
                    </div>
                    <form method="POST" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="lastname">Nom * :</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Entrer votre nom" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="firstname">Prenom * :</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Entrer votre prenom" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="join_email">Identifiant (e-mail) * :</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="email" name="join_email" id="join_email" placeholder="Entrer votre e-mail" required>
                            </div>
                        </div>
                       <div class="form-group">
                            <label class="col-sm-4 control-label" for="join_pwd">Mot de passe * :</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="password" name="join_pwd" id="join_pwd" placeholder="Entrer votre mot de passe" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-9">
                                <input type="submit" class="btn btn-primary" value="S'inscrire">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 connection">
                    <div class="page-header">
                        <h4><span class="glyphicon glyphicon-save"></span> Déjà inscrit ? Se connecter</h4>
                    </div>
                    <form method="POST" action="index.php" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="connect_email">Identifiant (e-mail) :</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="email" name="connect_email" id="connect_email" placeholder="Entrer votre e-mail">
                            </div>
                        </div>
                       <div class="form-group">
                            <label class="col-sm-4 control-label" for="connect_pwd">Mot de passe :</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="password" name="connect_pwd" id="connect_pwd" placeholder="Entrer votre mot de passe">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-9">
                                <input type="submit" class="btn btn-success" value="Se connecter">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
