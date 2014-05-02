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
}
