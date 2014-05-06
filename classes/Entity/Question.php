<?php

namespace Entity;

class Question 
{
    protected $id_question;
    protected $libelle_question;
    
    /**
     * Association avec Enquete
     * @var Enquete
     */
    protected $id_enquete;
    
    /**
     * Association avec TypeQuestion
     * @var TypeQuestion
     */
    protected $id_type_question;
    
    /**
     * Association avec Utilisateur
     * @var Utilisateur
     */
    protected $utilisateur;
    
    
    public function getId_question() {
        return $this->id_question;
    }

    public function getLibelle_question() {
        return $this->libelle_question;
    }

    public function getId_enquete() {
        return $this->id_enquete;
    }

    public function getId_type_question() {
        return $this->id_type_question;
    }

    public function getUtilisateur() {
        return $this->utilisateur;
    }
    
    public function setId_question($id_question) {
        $this->id_question = (int) $id_question;
        return $this;
    }

    public function setLibelle_question($libelle_question) {
        $this->libelle_question = (string) $libelle_question;
        return $this;
    }

    public function setId_enquete($id_enquete) {
        $this->id_enquete = (int) $id_enquete;
        return $this;
    }

    public function setId_type_question($id_type_question) {
        $this->id_type_question = (int) $id_type_question;
        return $this;
    }
    
    public function setUtilisateur(\Entity\Utilisateur $utilisateur) {
        $this->utilisateur = $utilisateur;
        return $this;
    }


}
