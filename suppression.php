<?php
require_once './includes/autoload.php';

// suppression de l'enquête suivant l'id
if (isset($_GET['id'])) {

    $enquete = new Entity\Enquete();
    $question = new Entity\Question();
    $qcm = new Entity\Qcm();
    $reponse = new Entity\Reponse();

    $enqueteMapper = new Mapper\EnqueteMapper();
    $questionMapper = new Mapper\QuestionMapper();
    $qcmMapper = new Mapper\QcmMapper();
    $reponseMapper = new Mapper\ReponseMapper();

    //$enquete = new Entity\Enquete();
    $enquete->setId_enquete((int) $_GET['id']);
    $question->setId_enquete((int) $_GET['id']);

    // on recupere la liste des id_question correspondant à l'id_enquete
    $listIdQuestionByIdEnquete = $questionMapper->getIdQuestionByIdEnquete($question);

    foreach ($listIdQuestionByIdEnquete as $value) {
        $reponse->setId_question($value);
        $reponseMapper->deleteReponseByIdQuestion($reponse);
        $qcm->setId_question($value);
        $qcmMapper->deleteQCMByIdQuestion($qcm);
    }
    $questionMapper->deleteQuestionByIdEnquete($question);
    $enqueteMapper->deleteEnqueteById($enquete);
    
    header("Location: member.php");
}

