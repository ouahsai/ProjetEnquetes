<?php

namespace Mapper;

class EnqueteMapper {
    
    protected $_pdo;
    
    public function __construct() {
        $this->_pdo = \Manager\PDO::pdoConnection();
    }

    public function getEnqueteByIdUtilisateur(\Entity\Enquete $enquete){
             
        $query = "SELECT ID_ENQUETE,TITRE,DESCRIPTION FROM enquete where ID_UTILISATEUR = :id";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue(":id", $enquete->getUtilisateur()->getId_utilisateur());
        $stmt->execute();
        $listEnquetes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        if ($listEnquetes){
            return $listEnquetes;
        }
        else{
            return false;
        }
     }
     
    public function deleteEnqueteById(\Entity\Enquete $enquete){
        $query = "DELETE FROM enquete WHERE ID_ENQUETE = :id";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue(":id", $enquete->getId_Enquete());
        $stmt->execute();
        if ($stmt){
            $message = "Votre enquête a été supprimée de la base de données";
            return $message;
        }
        else{
            $message = "Une erreur est survenue dans la suppression de l'enquête, veuillez reessayer";
            return $message;
        }
    }
}
