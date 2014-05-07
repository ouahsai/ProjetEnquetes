<?php
require_once 'autoload.php';
require_once 'check_session.php';


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
    
    header("Location: ../member.php");
}

// suppression du compte utilisateur
//
// $utilisateur = new Entity\Utilisateur();
// $utilisateurMapper = new Mapper\UtilisateurMapper();
//if (isset($_POST['delete'])) {
//    // récupère la liste des enquêtes pour l'utilisateur en session
//    $id_enquete = $enqueteMapper->getIdEnqueteByIdUtilisateur($enquete);
//    
//    foreach ($id_enquete as $value) {
//        
//        // recupere la liste des id_question correspondant à l'id_enquete
//        $id_question = $questionMapper->getIdQuestionByIdEnquete($question);
//        
//        // todo test if qcm entry exists
//        $qcmMapper->deleteQCMByIdQuestion($id_question);
//        $reponseMapper->deleteReponseByIdQuestion($id_question);
//        
//        // suppression des question associées à l'enquête
//        $questionMapper->deleteQuestionByIdEnquete($value);
//    }
//    
//    //suppression des enquêtes associées à utilisateur
//    $enqueteMapper->deleteEnqueteByIdUtilisateur($_SESSION["id_user"]);
//
//    // suppression de l'utilisateur
//    $utilisateurMapper->deleteProfilByIdUtilisateur($_SESSION["id_user"]);
//    
//    header("Location: ../index.php");
//}

// suppression du compte utilisateur
if (isset($_POST['delete'])) {
    
    $utilisateur = new Entity\Utilisateur();
    $enquete = new Entity\Enquete();
    $question = new Entity\Question();
    $qcm = new Entity\Qcm();
    $reponse = new Entity\Reponse();
    
    $utilisateur->setId_utilisateur((int) $_SESSION['user_id']);
    $enquete->setUtilisateur($utilisateur);
    $question->setUtilisateur($utilisateur);
    $qcm->setUtilisateur($utilisateur);
    $reponse->setUtilisateur($utilisateur);
    
    $utilisateurMapper = new Mapper\UtilisateurMapper();
    $enqueteMapper = new Mapper\EnqueteMapper();
    $questionMapper = new Mapper\QuestionMapper();
    $qcmMapper = new Mapper\QcmMapper();
    $reponseMapper = new Mapper\ReponseMapper();
        
    $reponseMapper->deleteReponseByIdUtilisateur($reponse);
    $qcmMapper->deleteQCMByIdUtilisateur($qcm);
    $questionMapper->deleteQuestionByIdUtilisateur($question);
    $enqueteMapper->deleteEnqueteByIdUtilisateur($enquete);
    $utilisateurMapper->deleteProfilByIdUtilisateur($utilisateur);
  
    header("Location: ../index.php");
}
//pour modification compte dans la base
if (isset($_POST['lastname'], $_POST['firstname'],
          $_POST['join_email'], $_POST['join_pwd'],$_SESSION['user_id'] )) 
{
    $utilisateur = new Entity\Utilisateur();
    $utilisateur->setId_utilisateur((int) $_SESSION['user_id']);
        
    // ci dessous peut s'automatiser avec un Hydrateur (en anglais Hydrator)
    $utilisateur->setNom($_POST['lastname'])
                ->setPrenom($_POST['firstname'])
                ->setEmail($_POST['join_email'])
                ->setPassword($_POST['join_pwd']);
    
    $utilisateurMapper = new Mapper\UtilisateurMapper();
    $utilisateurMapper->updateProfilByIdUtilisateur($utilisateur);
    
    header("Location: member.php?page=1");
    exit();
}