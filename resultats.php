<?php
require_once './includes/autoload.php';
require_once './includes/check_session.php';

if (isset($_GET['id'])) {

    $reponse = new Entity\Reponse();
    $reponseMapper = new Mapper\ReponseMapper();
    $reponse->setId_enquete($_GET['id']);
    $nbReponse = $reponseMapper->totalReponseByIdEnquete($reponse);
    
    if ($nbReponse[0]['nb_reponse'] > 0) {
        $question = new Entity\Question();
        $questionMapper = new Mapper\QuestionMapper();
        $question->setId_enquete($_GET['id']);
        $questions = $questionMapper->getQuestionsByIdEnquete($question);
    } else {
        //todo message si pas de reponses
        $message = "Il n'y a pas de reponse à cette enquete !!";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Resultats - Enquetes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <div class="container">

            <div class="page-header">
                <h1 class="">Resultat de l'enquête</h1>
            </div>
            <div>
                <a class="btn btn-default btn-xs" href="member.php">Page membre</a>
                <a class="btn btn-default btn-xs" href="deconnexion.php">Deconnexion</a>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="page-header">
                        <h3> Titre enquete : <?php echo $nbReponse[0]['titre']; ?></h3>
                        <h4>Description :</h4><p><?php echo $nbReponse[0]['description']; ?></p>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <h5>Total de répondants : <?php echo $nbReponse[0]['nb_reponse']; ?></h5>
                    <?php if ($nbReponse[0]['nb_reponse'] > 0): ?>





    <?php foreach ($questions as $question): ?>
                            <h3>Question :  <?php echo $question['libelle_question'];
        $reponse->setId_question($question['id_question']);
        ?></h3>
                                <?php if ($question['libelle_type_question'] === 'Nombre'):

                                    $reponseQuestion = $reponseMapper->reponseQuestionNumerique($reponse);
                                    ?>
                                <p>réponse:  <ul><?php foreach ($reponseQuestion as $value): ?>
                                        <li>Valeur minimum :&nbsp<?php echo $value['min_value']; ?></li>
                                        <li>Valeur maximale :&nbsp<?php echo $value['max_value']; ?></li>
                                        <li>Moyenne des réponses :&nbsp<?php echo abs($value['avg_value']); ?></li>
                                        <li>Somme des réponses :&nbsp<?php echo $value['total']; ?></li>
                                    <?php endforeach; ?>
                                </ul></p>


                            <?php elseif ($question['libelle_type_question'] === 'QCM'):

                                $reponseQuestion = $reponseMapper->reponseQuestionQCM($reponse);
                                ?>
                                <p>réponse:</p>
                                <table class="table table-striped">    
                                    <tr>
                                        <td>Reponses</td> 
                                        <td>Nombre de reponses</td>
                                    </tr>
                                    <?php foreach ($reponseQuestion as $value): ?>
                                        <tr>
                                            <td><?php echo $value['valeur_reponse']; ?></td>                                                                                                         <td><?php echo $value['nb_reponse']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>


                                <?php else :

                                    $reponseQuestion = $reponseMapper->reponseQuestionTexte($reponse);
                                ?>                                                             
                                <p>réponse:
                                <ul>
                                    <?php foreach ($reponseQuestion as $value): ?>
                                        <li><?php echo $value['valeur_reponse']; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                </p>


                            <?php endif; ?>
    <?php endforeach; ?>
<?php else : ?> 
                        <div class="alert alert-danger">
                            <p><?= $message ?></p>
                        </div>
<?php endif; ?>

                </div>
            </div>
        </div>
    </body>
</html>
