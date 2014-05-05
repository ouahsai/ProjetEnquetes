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
    
    public function deleteReponseByIdQuestion(\Entity\Reponse $reponse)
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
    
    public function totalReponseByIdEnquete(\Entity\Reponse $reponse)
    {
        $query = "SELECT count(r.unique_user_id)as nb_reponse
                  FROM reponse r
                  inner join question q on q.id_question = r.id_question
                  inner join enquete e on e.id_enquete = q.id_enquete
                  WHERE q.id_enquete = :id_enquete";
        
        $stmt = $this->_pdo->prepare($query);
        
        $stmt->bindValue(":id_enquete", $reponse->getId_enquete());

        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
        $nb_reponse = $succes->fetch(\PDO::FETCH_ASSOC)['nb_reponse'];
        return $nb_reponse;
    } 
    
    public function reponseByIdTypeQuestion(\Entity\Reponse $reponse)
    {
        $query = "SELECT q.libelle_question, r.valeur_reponse
                  FROM reponse r
                  INNER JOIN question q ON q.id_question = r.id_question
                  INNER JOIN enquete e ON e.id_enquete = q.id_enquete
                  INNER JOIN type_question t ON t.id_type_question = q.id_type_question
                  WHERE q.id_question = :id_question
                  AND q.id_enquete = :id_enquete
                  AND t.libelle_type_question = :libelle_type_question";
              
        $stmt = $this->_pdo->prepare($query);
            
        $stmt->bindValue(":id_question", $reponse->getId_question());
        $stmt->bindValue(":id_enquete", $reponse->getId_enquete());
        $stmt->bindValue(":libelle_type_question", $reponse->getId_enquete());

        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
        $textReponse = $succes->fetchall(\PDO::FETCH_ASSOC);
        return $textReponse;
    }
    
}
