<?php

namespace Entity;

class Utilisateur {
    
    protected $idUtilisateur;
    protected $email;
    protected $password;
    
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
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
