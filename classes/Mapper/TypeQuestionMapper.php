<?php

namespace Mapper;


class TypeQuestionMapper 
{
    protected $_pdo;
    
    public function __construct()
    {
        $this->_pdo = \Manager\PDO::pdoConnection();
    }
    
    public function getAll()
    {
        $query = "SELECT libelle_type_question
                  FROM type_question";
        
        $stmt = $this->_pdo->query($query);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        
        $results = $stmt->fetchAll();
        
        return $results;
    }
    
    public function getIdTypeQuestionByLibelle(\Entity\TypeQuestion $type_question)
    {
        $query = "SELECT id_type_question as id
                  FROM type_question
                  WHERE libelle_type_question = :libelle";
       
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue("libelle", $type_question->getLibelle_type_question());
        $stmt->execute();
   
        $results = $stmt->fetch();
        
        if(empty($results)) {
            return false;
        }
        
        return $results["id"];
    }
}
