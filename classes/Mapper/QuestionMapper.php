<?php

namespace Mapper;

class QuestionMapper
{
    protected $_pdo;
    
    public function __construct()
    {
        $this->_pdo = \Manager\PDO::pdoConnection();
    }
    
    public function add(\Entity\Question $question)
    {
        $query = "INSERT INTO question (id_enquete, libelle_question)
                  VALUES (:id_enquete, :libelle_question)";
        
        $stmt = $this->_pdo->prepare($query);
        
        $stmt->bindValue("id_enquete", $question->getId_enquete());
        $stmt->bindValue("libelle_question", $question->getLibelle_question());

        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
        
        return $this->_pdo->lastInsertId();
    }
    
    public function getIdQuestionByIdEnquete(\Entity\Question $question)
    {
        $query = "SELECT id_question
                  FROM question
                  WHERE id_enquete = :id_enquete";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue("id_enquete", $question->getId_enquete());
        $stmt->execute();
        
        $listIdQuestion = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        
        return $listIdQuestion;
    } 
    
    public function deleteQuestionByIdEnquete(\Entity\Question $question)
    {
        $query = "DELETE FROM question
                  WHERE id_enquete = :id_enquete";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue("id_enquete", $question->getId_enquete());
        $stmt->execute();
    } 
    
   
}
