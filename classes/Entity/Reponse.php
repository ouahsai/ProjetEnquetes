<?php

namespace Entity;

class Reponse
{
    protected $id_reponse;
    protected $valeur_reponse;
    protected $unique_user_id;
    
    /**
     * Association avec question
     * @var Question
     */
    protected $id_question;
    protected $id_type_question;


    /**
     * Association avec enquete
     * @var Enquete
     */
    protected $id_enquete;
    
    /**
     * Association avec type question
     * @var Type_Question
     */
    protected $libelle_type_question;
    
    /**
     * Association avec Utilisateur
     * @var Utilisateur
     */
    protected $utilisateur;
        
    public function getId_reponse() {
        return $this->id_reponse;
    }

    public function getValeur_reponse() {
        return $this->valeur_reponse;
    }

    public function getUnique_user_id() {
        return $this->unique_user_id;
    }

    public function getId_question() {
        return $this->id_question;
    }
    
    public function getId_type_question() {
        return $this->id_type_question;
    }
    
    public function getId_enquete() {
        return $this->id_enquete;
    }
    
    public function getLibelle_type_question() {
        return $this->libelle_type_question;
    }
    
    public function getUtilisateur() {
        return $this->utilisateur;
    }

    public function setId_reponse($id_reponse) {
        $this->id_reponse = (int) $id_reponse;
        return $this;
    }

    public function setValeur_reponse($valeur_reponse) {
        $this->valeur_reponse = (string) $valeur_reponse;
        return $this;
    }

    public function setUnique_user_id($unique_user_id) {
        $this->unique_user_id = (string) $unique_user_id;
        return $this;
    }

    public function setId_question($id_question) {
        $this->id_question = (int) $id_question;
        return $this;
    }
    
    public function setId_type_question($id_type_question) {
        $this->id_type_question = (int) $id_type_question;
        return $this;
    }
    
    public function setId_enquete($id_enquete) {
        $this->id_enquete = (int) $id_enquete;
        return $this;
    }
    
    public function setLibelle_type_question($libelle_type_question) {
        $this->libelle_type_question = (string) $libelle_type_question;
        return $this;
    }
    
    public function setUtilisateur(\Entity\Utilisateur $utilisateur) {
        $this->utilisateur = $utilisateur;
        return $this;
    }
}
