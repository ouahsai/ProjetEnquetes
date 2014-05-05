<?php

namespace Mapper;

class UtilisateurMapper 
{
    protected $_pdo;
    //protected $_user;
    
    public function __construct() 
    {
       $this->_pdo = \Manager\PDO::pdoConnection();
    }
    
    public function subscription(\Entity\Utilisateur $utilisateur)
    {
        //do tests here
        //if ok
        
        $query = "INSERT INTO utilisateur (nom, prenom, email, password)
                  VALUES (:nom, :prenom, :email, :password)";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue("nom", $utilisateur->getNom());
        $stmt->bindValue("prenom", $utilisateur->getPrenom());
        $stmt->bindValue("email", $utilisateur->getEmail());
        $stmt->bindValue("password", $this->_encryptPwd($utilisateur->getPassword()));
        
        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
        
        $id = $this->_pdo->lastInsertId();
        session_start();
        $_SESSION['user_id'] = $id;
        $_SESSION['nom'] = $utilisateur->getNom();
        $_SESSION['prenom'] = $utilisateur->getPrenom();
    }
    
    public function login(\Entity\Utilisateur $utilisateur)
    {
        if ($user = $this->_checkCredentials($utilisateur)) {
            session_start();
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user->getId_utilisateur();
            $_SESSION['nom'] = $user->getNom();
            $_SESSION['prenom'] = $user->getPrenom();
            
            return $user;
        }
        return false;
    }

    protected function _checkCredentials($utilisateur)
    {
        $query = "SELECT id_utilisateur, nom, prenom, email, password
                  FROM utilisateur 
                  WHERE email = :email";
    
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue("email", $utilisateur->getEmail());
        $stmt->execute();
      
        if ($stmt->rowCount() > 0) {
            
            // configure PDO pour qui retourne des instances de la classe \Entity\Utilisateur
            $stmt->setFetchMode(\PDO::FETCH_CLASS, "\Entity\Utilisateur");
            $user = $stmt->fetch();

            if ($this->_encryptPwd($utilisateur->getPassword()) === $user->getPassword()) {
                return $user;
            }
        }
        return false;
    }
    
    private function _encryptPwd($pwd)
    {        
        $salt = sha1(md5($pwd));
        $encryptPwd = md5($pwd.$salt);
        
        return $encryptPwd;
    }
    
    private function UpdateProfil(\Entity\Utilisateur $utilisateur)
    {        
        $query = "UPDATE utilisateur 
                  SET (nom = :nom, prenom = :prenom, email = :email, password = :password)
                  WHERE id_utilisateur = :id_utilisateur";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue(":nom", $utilisateur->getNom());
        $stmt->bindValue(":prenom", $utilisateur->getPrenom());
        $stmt->bindValue(":email", $utilisateur->getEmail());
        $stmt->bindValue(":password", $this->_encryptPwd($utilisateur->getPassword()));
        $stmt->bindValue(":id_utilisateur", $_SESSION['user_id']);
        
        $succes = $stmt->execute();
        if(!$succes) {
            return false;
        }
        $_SESSION['nom'] = $utilisateur->getNom();
        $_SESSION['prenom'] = $utilisateur->getPrenom();
    }
    
 
    
}
