<?php

namespace Entity;

class Enquete {
    
    protected $idEnquete;
    protected $titre;
    protected $description;
    
    /**
     * 
     * @var Utilisateur
     */
    protected $idUtilisateur;
    
    
    public function getIdEnquete() {
        return $this->idEnquete;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setIdEnquete($idEnquete) {
        $this->idEnquete = $idEnquete;
        return $this;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(Utilisateur $idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
        return $this;
    }


    
    
}
