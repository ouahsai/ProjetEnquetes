<?php

session_start();

if(isset($_GET['idenquete'])){

$enqueteMapper = new Mapper\EnqueteMapper(); // appel de la class enqueteMapper
$questionMapper= new Mapper\QuestionMapper();
$qcmMapper = new Mapper\QcmMapper();
$reponseMapper = new Mapper\ReponseMapper();

$enquete = new Entity\Enquete(); // appel de l entity Enquete
$enquete->setId_enquete($_GET['idenquete']);
$question = new Entity\Question();
$question->setId_enquete($_GET['idenquete']);
$qcm = new Entity\Qcm();
$reponse = new Entity\Reponse();
// on recupere la list des id_question correspondant à l'id_enquete
$listIdQuestion = $questionMapper->selectIdQuestion($question);

foreach ($listIdQuestion as $idQuestion){
    $reponse->setId_question($idQuestion);
    $reponseMapper->deleteReponse($reponse);
    $qcm->setId_question($idQuestion);
    $qcmMapper->deleteQCM($qcm);
}
$questionMapper->deleteQuestion($question);
$enqueteMapper->deleteEnqueteById($enquete);

}

