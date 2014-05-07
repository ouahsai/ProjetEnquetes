<?php

namespace Mapper;

class ReponseMapper 
{
    protected $_pdo;
    
    public function __construct()
    {
        $this->_pdo = \Manager\PDO::pdoConnection();
    }
    
    public function add(\Entity\Reponse $reponse)
    {
       $query = "INSERT INTO reponse (id_question, valeur_reponse, unique_user_id)
                  VALUES (:id_question, :valeur_reponse, :unique_user_id)";
        
        $stmt = $this->_pdo->prepare($query);
        
        $stmt->bindValue(":id_question", $reponse->getId_question());
        $stmt->bindValue(":valeur_reponse", $reponse->getValeur_reponse());
        $stmt->bindValue(":unique_user_id", uniqid());
        
        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        } 
    }
    
    public function totalReponseByIdEnquete(\Entity\Reponse $reponse)
    {
        $query = "SELECT e.titre, e.description, count(DISTINCT r.unique_user_id)as nb_reponse
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
        $nb_reponse = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $nb_reponse;
    } 
    
    
      
    
    public function reponseQuestionTexte(\Entity\Reponse $reponse)
    {
        $query = "SELECT q.libelle_question, r.valeur_reponse
                  FROM reponse r
                  INNER JOIN question q ON q.id_question = r.id_question
                  INNER JOIN enquete e ON e.id_enquete = q.id_enquete
                  INNER JOIN type_question t ON t.id_type_question = q.id_type_question
                  WHERE q.id_question = :id_question
                  AND q.id_enquete = :id_enquete
                  AND t.libelle_type_question = \"Texte\"";
        
              
        $stmt = $this->_pdo->prepare($query);
            
        $stmt->bindValue(":id_question", $reponse->getId_question());
        $stmt->bindValue(":id_enquete", $reponse->getId_enquete());
        //$stmt->bindValue(":libelle_type_question", $reponse->getLibelle_type_question());

        $stmt->execute();
        $reponseTexte = $stmt->fetchall(\PDO::FETCH_ASSOC);

        if(!$reponseTexte) {
            return false;
        }
        
        return $reponseTexte;
    }
    
    public function reponseQuestionNumerique(\Entity\Reponse $reponse)
    {
        $query = "SELECT q.libelle_question,
                  MIN( CAST( r.VALEUR_REPONSE AS SIGNED ) ) AS min_value,
                  MAX( CAST( r.VALEUR_REPONSE AS SIGNED ) ) AS max_value,
                  AVG( CAST( r.VALEUR_REPONSE AS SIGNED ) ) AS avg_value,
                  SUM( CAST( r.VALEUR_REPONSE AS SIGNED ) ) AS total,
                  r.VALEUR_REPONSE
                  FROM reponse r
                  INNER JOIN question q ON q.id_question = r.id_question
                  INNER JOIN enquete e ON e.id_enquete = q.id_enquete
                  WHERE r.id_question = :id_question
                  AND q.id_enquete = :id_enquete
                  GROUP BY q.libelle_question";
              
        $stmt = $this->_pdo->prepare($query);
            
        $stmt->bindValue(":id_question", $reponse->getId_question());
        $stmt->bindValue(":id_enquete", $reponse->getId_enquete());
        
        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
        $reponseNumQuestion = $stmt->fetchall(\PDO::FETCH_ASSOC);
        return $reponseNumQuestion;
    }
    
    public function reponseQuestionQCM(\Entity\Reponse $reponse)
    {
        $query = "SELECT q.libelle_question, r.valeur_reponse, count( * ) as nb_reponse
                    FROM reponse r
                    INNER JOIN question q ON q.id_question = r.id_question
                    INNER JOIN enquete e ON e.id_enquete = q.id_enquete
                    INNER JOIN type_question t ON t.id_type_question = q.id_type_question
                    WHERE q.id_question = :id_question
                    AND q.id_enquete = :id_enquete
                    AND t.libelle_type_question = \"QCM\"
                    GROUP BY q.libelle_question, r.valeur_reponse
                    ORDER BY nb_reponse DESC";
              
        $stmt = $this->_pdo->prepare($query);
            
        $stmt->bindValue(":id_question", $reponse->getId_question());
        $stmt->bindValue(":id_enquete", $reponse->getId_enquete());
        //$stmt->bindValue(":libelle_type_question", $reponse->getLibelle_type_question());
        
        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
        $reponseQuestionQCM = $stmt->fetchall(\PDO::FETCH_ASSOC);
        return $reponseQuestionQCM;
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
    
    public function deleteReponseByIdUtilisateur(\Entity\Reponse $reponse)
    {
        $query = "DELETE FROM reponse 
                  WHERE id_question 
                  IN ( SELECT qu.id_question
                        FROM question qu, enquete en
                        WHERE qu.id_enquete = en.id_enquete
                        AND en.id_utilisateur = :id_utilisateur)";
        
        $stmt = $this->_pdo->prepare($query);
        
        $stmt->bindValue("id_utilisateur", $reponse->getUtilisateur()->getId_utilisateur());

        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
    }
}
