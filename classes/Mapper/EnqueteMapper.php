<?php

namespace Mapper;

class EnqueteMapper {
    
    protected $_pdo;
    
    public function __construct() {
        $this->_pdo = \Manager\PDO::pdoConnection();
    }

    public function getEnqueteById($id){
             
        $query = "SELECT titre FROM enquete where id_enquete = :id";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $listEnquetes = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        if ($listEnquetes){
            return $listEnquetes;
        }
        else{
            return false;
        }
     }
}
