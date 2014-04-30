<?php

namespace Mapper;

class UtilisateurMapper 
{
    protected $_pdo;
    protected $_user;
    
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
    }
    
    public function login(\Entity\Utilisateur $utilisateur)
    {
        $user = $this->_checkCredentials($utilisateur);
        if ($user) {
            $this->_user = $user; // store it so it can be accessed later with getUser()
            session_start();
            $_SESSION['user_id'] = $user['id_utilisateur'];
            return $user['id_utilisateur'];
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
            $user = $stmt->fetch(\PDO::FETCH_ASSOC); //returns 1 line as associative array

            if ($this->_encryptPwd($utilisateur->getPassword()) === $user['password']) {
                return $user;
            }
        }
        return false;
    }

    public function getUser()
    {
        return $this->_user;
    }
    
    private function _encryptPwd($pwd)
    {        
        $salt = sha1(md5($pwd));
        $encryptPwd = md5($pwd.$salt);
        
        return $encryptPwd;
    }
}
