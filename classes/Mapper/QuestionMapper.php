<?php

namespace Mapper;

class QuestionMapper
{
     protected $_pdo;
    
    public function __construct(\PDO $pdo)
    {
        $this->_pdo = $pdo;
    }
    
    public function add(\Entity\Question $question)
    {
        var_dump($question);
        $sql = "INSERT INTO question (id_enquete, id_type_question, libelle_question)
                VALUES (:id_enquete, :id_type_question, :libelle_question)";
        
        $stmt = $this->pdo->prepare($sql);
        
        $stmt->bindValue("id_enquete", $question->getIdEnquete());
        $stmt->bindValue("id_type_question", $question->getIdTypeQuestion());
        $stmt->bindValue("libelle_question", $question->getLibelleQuestion());
        
        
        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
        
        $id = $this->pdo->lastInsertId();
        
        $dvd->setId_dvd($id);
        
        return $id;
    } 
}
