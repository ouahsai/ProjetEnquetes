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
    protected $id_Utilisateur;
    
    
    public function getId_Enquete() {
        return $this->id_Enquete;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setId_Enquete($id_Enquete) {
        $this->id_Enquete = $id_Enquete;
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

    public function getId_Utilisateur() {
        return $this->id_Utilisateur;
    }

    public function setIdUtilisateur(Utilisateur $id_Utilisateur) {
        $this->id_Utilisateur = $id_Utilisateur;
        return $this;
    }


    
    
}
