<?php

namespace Entity;

class Qcm 
{
    protected $id_qcm;
    protected $valeur_qcm;
    
    /**
     * Association avec question
     * @var Question
     */
    protected $id_question;
    
    /**
     * Association avec Utilisateur
     * @var Utilisateur
     */
    protected $utilisateur;
    
    
    public function getId_qcm() {
        return $this->id_qcm;
    }

    public function getValeur_qcm() {
        return $this->valeur_qcm;
    }

    public function getId_question() {
        return $this->id_question;
    }
    
    public function getUtilisateur() {
        return $this->utilisateur;
    }

    public function setId_qcm($id_qcm) {
        $this->id_qcm = (int) $id_qcm;
        return $this;
    }

    public function setValeur_qcm($valeur_qcm) {
        $this->valeur_qcm = (string) $valeur_qcm;
        return $this;
    }

    public function setId_question($id_question) {
        $this->id_question = (int) $id_question;
        return $this;
    }
    
    public function setUtilisateur(\Entity\Utilisateur $utilisateur) {
        $this->utilisateur = $utilisateur;
        return $this;
    }
    
}
