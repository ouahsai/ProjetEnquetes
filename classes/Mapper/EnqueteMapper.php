<?php

namespace Mapper;

class EnqueteMapper 
{
    protected $_pdo;
    
    public function __construct() 
    {
        $this->_pdo = \Manager\PDO::pdoConnection();
    }

    public function add(\Entity\Enquete $enquete) 
    {
        $query = "INSERT INTO enquete (id_utilisateur, titre, description)
                  VALUES (:id_utilisateur, :titre, :description)";
        
        $stmt = $this->_pdo->prepare($query);
        
        $stmt->bindValue("id_utilisateur", $enquete->getId_utilisateur());
        $stmt->bindValue("titre", $enquete->getTitre());
        $stmt->bindValue("description", $enquete->getDescription());
        
        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
        
        return $this->_pdo->lastInsertId();
    }
    
    public function getEnqueteByIdUtilisateur(\Entity\Enquete $enquete, \Entity\Pagination $pagination)
    {  
        $query = "SELECT COUNT(*) as nb_elt
                  FROM enquete 
                  WHERE id_utilisateur = :id";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue(":id", $enquete->getId_utilisateur());
        $succes = $stmt->execute();
        if(!$succes) {
            return false;
        }
        $nb_elt = $stmt->fetch(\PDO::FETCH_ASSOC)['nb_elt'];
        
        $pagination->set_number_pages($nb_elt);
        $pageDebut = $pagination->get_PageDebut();
        $pagefin = $pagination->get_page_fin();
        
        $query1 = "SELECT id_enquete, titre, description
                   FROM enquete
                   WHERE id_utilisateur = :id LIMIT $pageDebut, $pagefin";
        
        $stmt = $this->_pdo->prepare($query1);
        $stmt->bindValue(":id", $enquete->getId_utilisateur());
        $stmt->execute();
        $listEnquetes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($listEnquetes){
            return $listEnquetes;
        }
        else{
            return false;
        }
    }
    
    public function deleteEnqueteById(\Entity\Enquete $enquete) 
    {
        $query = "DELETE FROM enquete
                  WHERE id_enquete = :id";

        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue(":id", $enquete->getId_enquete());
        $stmt->execute();
        if ($stmt) {
            $message = "Votre enquête a été supprimée de la base de données";
            return $message;
        } else {
            $message = "Une erreur est survenue dans la suppression de l'enquête, veuillez reessayer";
            return $message;
        }
    }

}
