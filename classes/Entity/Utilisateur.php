<?php

namespace Entity;

class Utilisateur {
    
    protected $id_utilisateur;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    
    
    public function getId_utilisateur() {
        return $this->id_utilisateur;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setId_utilisateur($id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
        return $this;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }
    
}
