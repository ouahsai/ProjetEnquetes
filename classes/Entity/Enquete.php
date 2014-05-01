<?php

namespace Entity;

class Enquete {
    
    protected $id_Enquete;
    protected $titre;
    protected $description;
    
    /**
     * 
     * @var Utilisateur
     */
    protected $utilisateur;
  
    public function getId_Enquete() {
        return $this->id_Enquete;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getUtilisateur() {
        return $this->utilisateur;
    }

    public function setId_Enquete($id_Enquete) {
        $this->id_Enquete = $id_Enquete;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setUtilisateur(Utilisateur $utilisateur) {
        $this->utilisateur = $utilisateur;
    }


   
}
