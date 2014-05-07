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
    
    
    //TODO : changer le nom de la méthode, on récupère les questions (avec type et qcm) + les enquêtes 
    public function getQuestionsByIdEnquete(\Entity\Question $question)
    {
        $query = "SELECT e.titre, e.description, 
                         q.libelle_question, q.id_question, t.libelle_type_question, 
                         qc.valeur_qcm
                  FROM question q
                  INNER JOIN type_question t ON t.id_type_question = q.id_type_question
                  LEFT OUTER JOIN qcm qc ON qc.id_question = q.id_question
                  INNER JOIN enquete e ON e.id_enquete = q.id_enquete
                  WHERE q.id_enquete = :id_enquete";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue("id_enquete", $question->getId_enquete());
        $stmt->execute();
        
        $listQuestion = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        if(!$listQuestion) {
            return false;
        }
        
        return $listQuestion;
    } 
}
