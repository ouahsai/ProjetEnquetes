<?php

namespace Mapper;


class TypeQuestionMapper 
{
    protected $_pdo;
    
    public function __construct()
    {
        $this->_pdo = \Manager\PDO::pdoConnection();
    }
    
    public function add(\Entity\TypeQuestion $type_question)
    {
//     
//        $query = "INSERT INTO type_question (libelle_type_question)
//                  VALUES (:libelle_type_question)";
//
//        $stmt = $this->_pdo->prepare($query);
//        $stmt->bindValue("libelle_type_question", $type_question->getLibelle_type_question());
//        
//        $succes = $stmt->execute();
//        
//        if(!$succes) {
//            return false;
//        }
//        
//        return $this->_pdo->lastInsertId();
    } 
    
    public function getTypeQuestion(){
       
       $query = "SELECT id_type_question, libelle_type_question FROM type_question";
       $stmt = $this->_pdo->query($query);
       $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

       return $result;
    }
}
