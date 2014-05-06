<?php

require_once './includes/autoload.php';

$utilisateur = new Entity\Utilisateur();
$utilisateurMapper = new Mapper\UtilisateurMapper();

// suppression d'une enquête suivant son id
if (isset($_GET['id'])) {

    $enquete = new Entity\Enquete();
    $question = new Entity\Question();
    $qcm = new Entity\Qcm();
    $reponse = new Entity\Reponse();

    $enqueteMapper = new Mapper\EnqueteMapper();
    $questionMapper = new Mapper\QuestionMapper();
    $qcmMapper = new Mapper\QcmMapper();
    $reponseMapper = new Mapper\ReponseMapper();

    $enquete->setId_enquete((int) $_GET['id']);
    $question->setId_enquete((int) $_GET['id']);

    // recupere la liste des id_question correspondant à l'id_enquete
    $id_question = $questionMapper->getIdQuestionByIdEnquete($question);

    foreach ($id_question as $value) {
        $reponse->setId_question($value);
        $reponseMapper->deleteReponseByIdQuestion($reponse);
        $qcm->setId_question($value);
        $qcmMapper->deleteQCMByIdQuestion($qcm);
    }
    
    $questionMapper->deleteQuestionByIdEnquete($question);
    $enqueteMapper->deleteEnqueteById($enquete);
    
    header("Location: member.php");
}

if (isset($_GET['update'])) {
    
    $enquete = new Entity\Enquete();
    $question = new Entity\Question();
    $qcm = new Entity\Qcm();
    $reponse = new Entity\Reponse();
    
    $utilisateur->setId_utilisateur($_GET['update']);
    $enquete->setUtilisateur($utilisateur);
    $question->setUtilisateur($utilisateur);
    $qcm->setUtilisateur($utilisateur);
    $reponse->setUtilisateur($utilisateur);
    
    $enqueteMapper = new Mapper\EnqueteMapper();
    $questionMapper = new Mapper\QuestionMapper();
    $qcmMapper = new Mapper\QcmMapper();
    $reponseMapper = new Mapper\ReponseMapper();
    
    
    $reponseMapper->deleteReponseByIdUtilisateur($reponse);
    $qcmMapper->deleteQCMByIdUtilisateur($qcm);
    $questionMapper->deleteQuestionByIdUtilisateur($question);
    $enqueteMapper->deleteEnqueteByIdUtilisateur($enquete);
    $utilisateurMapper->deleteProfilByIdUtilisateur($utilisateur);
  
    header("Location: index.php");
}
