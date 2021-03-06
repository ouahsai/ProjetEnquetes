<?php

namespace Entity;

class Enquete extends Utilisateur {
    
    protected $id_enquete;
    protected $titre;
    protected $description;
    
    /**
     * Association avec l'utilisateur
     * @var id_Utilisateur
     */
    protected $id_utilisateur;
    
    /**
     * Association avec l'utilisateur
     * @var Utilisateur
     */
    protected $utilisateur;
    
  
    public function getId_enquete() {
        return $this->id_enquete;
    }
    
    public function setId_enquete($id_enquete) {
        $this->id_enquete = (int) $id_enquete;
        return $this;
    }

    public function getTitre() {
        return $this->titre;
    }
    
    public function setTitre($titre) {
        $this->titre = (string) $titre;
        return $this;
    }

    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($description) {
        $this->description = (string) $description;
        return $this;
    }

//    public function getId_utilisateur() {
//        return $this->id_utilisateur;
//    }
//
//    public function setId_utilisateur($id_utilisateur) {
//        $this->id_utilisateur = (int) $id_utilisateur;
//        return $this;
//    }

    public function getUtilisateur() {
        return $this->utilisateur;
    }
    public function setUtilisateur(\Entity\Utilisateur $utilisateur) {
        $this->utilisateur = $utilisateur;
        return $this;
    }

}
