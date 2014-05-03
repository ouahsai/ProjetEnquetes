<?php

namespace Mapper;

class ReponseMapper 
{
    protected $_pdo;
    
    public function __construct()
    {
        $this->_pdo = \Manager\PDO::pdoConnection();
    }
    public function add()
    {
       
    }
    
    public function deleteReponse(\Entity\Question $reponse)
    {
        $query = "DELETE FROM reponse
                  WHERE id_question = :id_question";
        
        $stmt = $this->_pdo->prepare($query);
        
        $stmt->bindValue("id_question", $reponse->getId_question());

        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
    } 
}
