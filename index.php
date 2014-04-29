<!DOCTYPE html>

<html>
    <head>
        <title>Accueil - Enquetes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/extra.css">
    </head>
    <body>
        <div id="unauth">
	<div id="main" class="container">
            
            <div class="heading">
            <h1>Accès à la création d'enquêtes</h1>
            </div>
        <div class="well-big">    
        <h2><span class="glyphicon glyphicon-save"></span> S'inscrire</h2>
        <form method="POST" action="user.php" class="form-horizontal">
             <div class="form-group">
                <label class="col-sm-3 control-label" for="identifiant">Votre identifiant (e-mail)</label>
                <div class="col-sm-9">
                <input class="form-control" type="email" name="identifiant" id="identifiant" placeholder="Entrer votre e-mail">
                </div>
            </div>
           <div class="form-group">
                <label class="col-sm-3 control-label" for="password">Password</label>
                    <div class="col-sm-9">
                    <input class="form-control" type="password" name="password" id="password" placeholder="Entrer votre mot de passe">
                    </div>
            </div>
            <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                    <input type="submit" class="btn btn-primary" value="Ajouter">
                    </div>
            </div>
	</form>
            
        <h2><span class="glyphicon glyphicon-user"></span> Se connecter</h2>
        <form method="POST" action="user.php" class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="identifiant">Votre identifiant (e-mail)</label>
                <div class="col-sm-9">
                <input class="form-control" type="email" name="identifiant" id="identifiant" placeholder="Entrer votre e-mail">
                </div>
            </div>
           <div class="form-group">
                <label class="col-sm-3 control-label" for="password">Password</label>
                    <div class="col-sm-9">
                    <input class="form-control" type="password" name="password" id="password" placeholder="Entrer votre mot de passe">
                    </div>
            </div>
            <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                    <input type="submit" class="btn btn-primary" value="Connexion">
                    </div>
            </div>
	</form>
        </div>
        </div>
        </div>
    </body>
</html>
