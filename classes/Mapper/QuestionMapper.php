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
        $query = "INSERT INTO question (id_enquete, id_type_question, libelle_question)
                  VALUES (:id_enquete, :id_type_question, :libelle_question)";
        
        $stmt = $this->_pdo->prepare($query);
        
        $stmt->bindValue("id_enquete", $question->getId_enquete());
        $stmt->bindValue("id_type_question", $question->getId_type_question());
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
        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
    } 
    
    public function deleteQuestionByIdUtilisateur(\Entity\Question $question)
    {
        $query = "DELETE FROM question
                 WHERE id_enquete 
                 IN (SELECT en.id_enquete
                    FROM enquete en
                    WHERE en.id_utilisateur = :id_utilisateur)";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue("id_utilisateur", $question->getUtilisateur()->getId_utilisateur());
        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
    } 
   
    public function getQuestionsByIdEnquete(\Entity\Question $question)
    {
        $query = "SELECT q.libelle_question, q.id_question, t.libelle_type_question
                  FROM question q
                  INNER JOIN type_question t ON t.id_type_question = q.id_type_question
                  WHERE id_enquete = :id_enquete";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue("id_enquete", $question->getId_enquete());
        $stmt->execute();
        
        $listQuestion = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $listQuestion;
    } 
}
