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
}
