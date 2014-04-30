<?php

namespace Manager;

class UserService 
{
    protected $_pdo;
    protected $_nom;    
    protected $_prenom; 
    protected $_email;    
    protected $_password; 
    
    protected $_user;     // stores the user data

    public function __construct(\PDO $pdo, $email, $password, $nom = null, $prenom = null) 
    {
       $this->_pdo = $pdo;
       $this->_nom = $nom;
       $this->_prenom = $prenom;
       $this->_email = $email;
       $this->_password = $password;
    }
    
    public function join()
    {
        //do tests here
        //if ok
        
        $query = "INSERT INTO utilisateur (nom, prenom, email, password)
                  VALUES (:nom, :prenom, :email, :password)";
        
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue("nom", $this->_nom);
        $stmt->bindValue("prenom", $this->_prenom);
        $stmt->bindValue("email", $this->_email);
        $stmt->bindValue("password", $this->encryptPwd($this->_password));
        
        $succes = $stmt->execute();
        
        if(!$succes) {
            return false;
        }
        
        $id = $this->_pdo->lastInsertId();
        session_start();
        $_SESSION['user_id'] = $id;
    }
    
    public function login()
    {
        $user = $this->_checkCredentials();
        if ($user) {
            $this->_user = $user; // store it so it can be accessed later with getUser()
            session_start();
            $_SESSION['user_id'] = $user['id_utilisateur'];
            return $user['id_utilisateur'];
        }
        return false;
    }

    protected function _checkCredentials()
    {
        $query = "SELECT id_utilisateur, nom, prenom, email, password
                  FROM utilisateur 
                  WHERE email = :email";
    
        $stmt = $this->_pdo->prepare($query);
        $stmt->bindValue("email", $this->_email);
        $stmt->execute();
      
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(\PDO::FETCH_ASSOC); //returns 1 line as associative array

            if ($this->encryptPwd($this->_password) === $user['password']) {
                return $user;
            }
        }
        return false;
    }

    public function getUser()
    {
        return $this->_user;
    }
    
    private function encryptPwd($pwd)
    {        
        $salt = sha1(md5($pwd));
        $encryptPwd = md5($pwd.$salt);
        
        return $encryptPwd;
    }
}
