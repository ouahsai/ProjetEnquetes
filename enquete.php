<?php
require_once './includes/autoload.php';

$message = "";

var_dump($_POST["question"]);
$listMessages = [
    "Vous devez renseigner un titre d'enquête",
    "Vous devez définir au minimum une question",
    "Vous devez choisir un type de réponse associé à la question"
];

// mandatory fields
if (!isset($_POST["title"]) || empty($_POST["title"])) { $message = $listMessages[0]; }

//foreach($_POST["question"] as $key => $value){
//    if(!isset($value)){ $message = $listMessages[1]; }
//}
//foreach($_POST["type"] as $key => $value){
//    if(!isset($value)){ $message = $listMessages[2]; }
//}

if (!isset($_POST["question"]) || empty($_POST["question"])) { $message = $listMessages[1]; }
if (!isset($_POST["type"]) || empty($_POST["type"])) { $message = $listMessages[2]; }

// équivalent de if(isset(), ..., ...)
$check_array = array('title', 'description', 'question', 'type');
if (!array_diff($check_array, array_keys($_POST)))
{
    $enquete = new \Entity\Enquete();
    $typeQuestion = new \Entity\TypeQuestion();
    $question = new \Entity\Question();
    $qcm = new \Entity\Qcm();
    
    $enquete->setId_utilisateur(1)   //TODO -> push $_SESSION['user_id']
            ->setTitre($_POST["title"])
            ->setDescription($_POST["description"]);
    
    $mapper = new Mapper\EnqueteMapper();
    $id_enquete = $mapper->add($enquete); // (string) last_insert_id enquete
    
    foreach($_POST["question"] as $key => $value){

        // insert into typeQuestion
        $typeQuestion->setLibelle_type_question($_POST["type"][$key]);
        
        $mapper = new Mapper\TypeQuestionMapper();
        $id_type_question = $mapper->add($typeQuestion); // (string) last_insert_id typeQuestion

        // insert into question
        $question->setId_enquete((int) $id_enquete)  // needs to be converted
                 ->setId_type_question((int) $id_type_question)
                 ->setLibelle_question($value);
        
        $mapper = new Mapper\QuestionMapper();
        $id_question = $mapper->add($question); // (string) last_insert_id question
        
        // insert into qcm
        if($_POST["type"][$key] === "QCM") {
            $qcmValues = implode(",", $_POST["qcm$key"]);

            $qcm->setId_question((int) $id_question)
                ->setValeur_qcm($qcmValues);

            $mapper = new Mapper\QcmMapper();
            $mapper->add($qcm);
        }
    }
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

        <div class="container">
            <div class="row">
                <div class="control-group" id="fields">
                    
                    <?php if (!empty($message)) : ?>
                        <div class="alert alert-danger">
                            <p><?= $message ?></p>
                        </div>
                    <?php endif; ?>
                    
                    <div class="controls">

                        <form class="form-horizontal" method="post" action="enquete.php" role="form" autocomplete="off">
                            
                            <div class="page-header">
                                <h2><label class="control-label" for="">Enquête</label></h2>
                            </div>
                            <div class="form-group">
                                <label for="inputTitle" class="col-sm-2 control-label">Titre * :</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Titre">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textareaDescription" class="col-sm-2 control-label">Description :</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" id="textareaDescription" rows="3" placeholder="Description"></textarea>
                                </div>
                            </div>
                                
                            <div class="page-header">
                                <h2><label class="control-label" for="">Questions</label></h2>
                            </div>
                            
                            <small class="info">Appuyer sur &nbsp;<span class="glyphicon glyphicon-plus gs"></span>&nbsp; 
                                   pour ajouter une autre Question ou une réponse au QCM
                            </small>
                            
                            <div class="entry">
                                <div>
                                    <div class="input-group col-xs-7">
                                        <input class="form-control" name="question[]" type="text" placeholder="Votre Question" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-success btn-add" type="button">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Texte</a></li>
                                            <li><a href="#">Nombre</a></li>
                                            <li><a href="#">QCM</a></li>
                                            <input type="hidden" class="hidden" name="type[]">
                                        </ul>
                                    </div>
                                </div>
                                <div class="clearfix qcm">
                                    <div class="input-group col-xs-3">
                                        <label for="">Réponses au QCM :</label>
                                        <div class="qcm-answer">
                                            <input class="form-control input-sm" name="qcm0[]" type="text">
                                            <span class="input-group-btn">
                                                <button class="btn btn-success btn-xs btn-qcm-add" type="button">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                        <div class="qcm-answer">
                                            <input class="form-control input-sm" name="qcm0[]" type="text">
                                            <span class="input-group-btn">
                                                <button class="btn btn-success btn-xs btn-qcm-add" type="button">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group validation">
                                <input type="submit" class="btn btn-success" value="Soumettre l'enquête">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/jquery-1.11.0.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $(function() {
                
                if ($('.controls').length) {
                    
                    var $controls = $('.controls');
                    
//                    if(typeof sessionStorage != 'undefined') {
//                        if('Form' in sessionStorage) {
//                            $controls.empty().html(sessionStorage.getItem('Form'));
//                        } else {
//                            $controls.find('.qcm').hide();
//                        }
//                    }
                    
                    $controls.find('.qcm').hide();
                    
                    var initText = "Type de réponse à cette question",
                        caret = "&nbsp;<span class='caret'></span>",
                        currentButtonHtml = $controls.find('form .btn-group button')
                                            .html(initText + caret).html();

                    $controls.on('click', '.btn-add', function(e) {
                        e.preventDefault();

                        var controlForm = $controls.find('form:first'),
                            currentEntry = $(this).parents('.entry:first'),
                            newEntry = $(currentEntry.clone()).insertAfter(currentEntry);
                            
                        $controls.trigger("setIndexes")
                                 .trigger("setSessionStorage");
                                
                        newEntry.find('.btn-group > button').html(currentButtonHtml)
                                .end().find('.qcm').hide();

                        newEntry.find('input').val('');
                        controlForm.find('.entry:not(:last) .btn-add')
                                   .removeClass('btn-add').addClass('btn-remove')
                                   .removeClass('btn-success').addClass('btn-danger')
                                   .html('<span class="glyphicon glyphicon-minus"></span>');

                    }).on('click', '.btn-remove', function(e) {
                        e.preventDefault();
                        
                        $(this).parents('.entry:first').remove();
                        $controls.trigger("setIndexes")
                                 .trigger("setSessionStorage");

                    }).on('click', '.btn-group > ul a', function(e) {
                        e.preventDefault();
                        
                        var currentText = $(this).text(),
                            currentQcm = $(this).parents(".entry").find(".qcm"),
                            ulParent = $(this).parent().parent(),
                            hidden = ulParent.find(".hidden");
                    
                        hidden.val(currentText);
                        ulParent.prev().html(currentText + caret);
                        
                        if ($(this).parent().index() === 2) { //case QCM
                            currentQcm.show();
                            $controls.trigger("setSessionStorage");
                        } else {
                            currentQcm.hide();
                            $controls.trigger("setSessionStorage");
                        }
                        
                        

                    }).on("setIndexes", function() {
                        $(this).find('.qcm').each(function(index){
                            $(this).find("input[name]")
                                   .attr("name", "qcm"+index+"[]");
                        });                        
                        
                    }).on("setSessionStorage", function() {
                        sessionStorage.setItem("Form", $(this).html());
                    });
                }
            });
        </script>
    </body>
</html>