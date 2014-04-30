<?php
require_once './includes/autoload.php';

if (isset($_POST["fields"])) {

    $question = new \Entity\question();
    $pdo = \Manager\PDO::pdoConnection();
    $question->setLibelleQuestion($_POST["fields"]);
    $mapper = new Mapper\QuestionMapper($pdo);

    $id = $mapper->add($question);
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
        <header class="navbar navbar-fixed-top navbar-inverse">

        </header>
        
        <div class="container">
            <div class="page-header">
                <h1><label class="control-label" for="field1">Création du questionnaire</label></h1>
            </div>
            <div class="row">
                <div class="control-group" id="fields">
                    
                    
                    <div class="controls">
                        <form method="post" action = "#" role="form" autocomplete="off">
                            <div class="entry input-group col-xs-3">
                                <input class="form-control" name="fields[]" type="text" placeholder="Votre Question" />
                                <span class="input-group-btn">
                                    <button class="btn btn-success btn-add" type="button">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Valider">
                            </div>
                        </form>
                        
                        <br>
                        <small>Appuyer sur &nbsp;<span class="glyphicon glyphicon-plus gs"></span>&nbsp; pour ajouter une autre Question</small>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="js/jquery-1.11.0.js"></script>
        <script>
            $(function() {
                $(document).on('click', '.btn-add', function(e) {
                    e.preventDefault();

                    var controlForm = $('.controls form'),
                        currentEntry = $(this).parents('.entry:first'),
                        newEntry = $(currentEntry.clone()).insertAfter(currentEntry);

                    newEntry.find('input').val('');
                    controlForm.find('.entry:not(:last) .btn-add')
                               .removeClass('btn-add').addClass('btn-remove')
                               .removeClass('btn-success').addClass('btn-danger')
                               .html('<span class="glyphicon glyphicon-minus"></span>');
                       
                }).on('click', '.btn-remove', function(e) {
                    e.preventDefault();
                    $(this).parents('.entry:first').remove();
                });
            });
        </script>

    </body>
</html>