<?php
require_once './includes/autoload.php';
require_once './includes/check_session.php';

/**********************************************
 * ERRORS
 */

$message = "";
    
//var_dump($_POST["question"]);
//$listMessages = [
//    "Vous devez renseigner un titre d'enquête",
//    "Vous devez définir au minimum une question",
//    "Vous devez choisir un type de réponse associé à la question"
//];
//
//// mandatory fields
//if (!isset($_POST["title"]) || empty($_POST["title"])) {
//    $message = $listMessages[0];
//}
//if (!isset($_POST["question"]) || empty($_POST["question"])) {
//    $message = $listMessages[1];
//}
//if (!isset($_POST["type"]) || empty($_POST["type"])) {
//    $message = $listMessages[2];
//}

/**********************************************
 * INSERT
 */

// récupère la liste des libelle de type_question 
// pour l'affichage sous forme de liste déroulante
$typeQuestionMapper = new Mapper\TypeQuestionMapper();
$libelle_type_question = $typeQuestionMapper->getAll();

// équivalent de if(isset(), ..., ...)
$check_array = array('title', 'description', 'question', 'type');
if (!array_diff($check_array, array_keys($_POST))) {
    
    $enquete = new \Entity\Enquete();
    $typeQuestion = new \Entity\TypeQuestion();
    $question = new \Entity\Question();
    $qcm = new \Entity\Qcm();
    $pagination = new Entity\Pagination();
    
    $enquete->setId_utilisateur($_SESSION['user_id'])
            ->setTitre($_POST["title"])
            ->setDescription($_POST["description"]);

    $enqueteMapper = new Mapper\EnqueteMapper();
    $id_enquete = $enqueteMapper->add($enquete); // (string) last_insert_id enquete
  
    foreach ($_POST["question"] as $key => $value) {

        // select id_type_question from typeQuestion
        $typeQuestion->setLibelle_type_question($_POST["type"][$key]);
        $id_type_question = $typeQuestionMapper->getIdTypeQuestionByLibelle($typeQuestion); // (int) id typeQuestion
        
        // insert into question
        $question->setId_enquete((int) $id_enquete)  // needs to be converted
                 ->setId_type_question($id_type_question)
                 ->setLibelle_question($value);

        $questionMapper = new Mapper\QuestionMapper();
        $id_question = $questionMapper->add($question); // (string) last_insert_id question
        
        // insert into qcm
        if($_POST["type"][$key] === "QCM") {
            $qcmValues = $_POST["qcm$key"];
            $qcmMapper = new Mapper\QcmMapper();
            
            foreach($qcmValues as $value){
                $qcm->setId_question((int) $id_question)
                    ->setValeur_qcm($value);

                $qcmMapper->add($qcm);
            }
        }
    }

    $enqueteMapper->getEnqueteByIdUtilisateur($enquete, $pagination);
    header("Location: member.php?page=" . $pagination->get_number_pages());
    exit();
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

        <div class="survey container">
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
                                        <input class="form-control inputQuestion" name="question[]" type="text" placeholder="Votre Question" />
                                        <span class="input-group-btn">
                                            <button class="btn btn-default btn-add" type="button">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </span>
                                    </div>
                                    <div class="btn-group list">
                                        <button type="button" class="btn btn-default dropdown-toggle buttonType" data-toggle="dropdown"></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <?php foreach ($libelle_type_question as $value) : ?>
                                                <li><a href="#"><?php echo $value['libelle_type_question']; ?></a></li>
                                            <?php endforeach; ?>
                                            <li><input type="hidden" class="hidden" name="type[]"></li>
                                        </ul>
                                        
                                    </div>
                                </div>
                                <div class="clearfix qcm">
                                    <div class="input-group col-xs-3">
                                        <label for="">Réponses au QCM :</label>

                                        <div class="entry-qcm">
                                            <input class="form-control input-sm" name="qcm0[]" type="text">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default btn-xs btn-add-qcm" type="button">
                                                    <span class="glyphicon glyphicon-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group validation">
                                <input type="submit" class="btn btn-primary" value="<?= $text = isset($_GET["id"]) ? "Modifier l'enquête" : "Soumettre l'enquête" ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/jquery-1.11.0.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/controls.js"></script>
        
        <?php if(isset($_GET["id"])) : ?>
        <script>
        $.getJSON('./js/list_results.js', function(response) {
            
            var caret = "&nbsp;<span class='caret'></span>";
            var id_question;

            $.each(response, function(index, value){

                id_question = value.id_question;

                if (value.id_question === id_question) {

                    //console.log(value.id_question);
                    //console.log(value.valeur_qcm);
                    $('.controls').find('.inputQuestion').eq(index).val(value.libelle_question);
                    $('.controls').find('.list .buttonType')
                             .eq(index).html(value.libelle_type_question + caret);
                }


    //            if (value.libelle_type_question === "QCM") {
    //                
    //                
    ////                    for(var i=0; i<id_question.length; i++){
    ////                        $('.btn-add-qcm').trigger('click');
    ////                    }
    //                    console.log(id_question); //2
    //                    //console.log(value.valeur_qcm); //3
    //                    if (index === response.length - 1) return false;
    //                    $('.list a').trigger('click');
    //                
    //                
    //            }

                if (index === response.length - 1) return false;
                $('.btn-add').trigger('click');
            });

            var title = $('#inputTitle'),
                description = $('#textareaDescription');
            
            title.val(response[0].titre);
            description.html(response[0].description);
        });
        </script>
        <?php endif; ?>
    </body>
</html>
