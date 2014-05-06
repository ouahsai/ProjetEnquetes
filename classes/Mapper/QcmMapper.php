<?php

namespace Mapper;

class QcmMapper 
{
    protected $_pdo;

    public function __construct() 
    {
        $this->_pdo = \Manager\PDO::pdoConnection();
    }
    
    public function add(\Entity\Qcm $qcm)
    {
        $query = "INSERT INTO qcm (id_question, valeur_qcm)
                  VALUES (:id_question, :valeur_qcm)";

        $stmt = $this->_pdo->prepare($query);

        $stmt->bindValue("id_question", $qcm->getId_question());
        $stmt->bindValue("valeur_qcm", $qcm->getValeur_qcm());

        $succes = $stmt->execute();

        if(!$succes) {
            return false;
        }
    }
    
    public function deleteQCMByIdQuestion(\Entity\Qcm $qcm)
    {
        $query = "DELETE FROM qcm 
                  WHERE id_question = :id_question";

        $stmt = $this->_pdo->prepare($query);

        $stmt->bindValue(":id_question", $qcm->getId_question());
        
        $succes = $stmt->execute();

        if(!$succes) {
            return false;
        }
    }
    
    public function deleteQCMByIdUtilisateur(\Entity\Qcm $qcm)
    {
        $query = "DELETE FROM qcm 
            WHERE id_question 
            IN (SELECT qu.id_question
                FROM question qu, enquete en
                WHERE qu.id_enquete = en.id_enquete
                AND en.id_utilisateur = :id_utilisateur)";

        $stmt = $this->_pdo->prepare($query);

        $stmt->bindValue(":id_utilisateur", $qcm->getUtilisateur()->getId_utilisateur());
        
        $succes = $stmt->execute();

        if(!$succes) {
            return false;
        }
    }
}
