<?php

namespace Manager;

class PDO
{  
    static public function pdoConnection()
    {
        // \PDO la classe PDO qui n'a pas de namespace
        // si on cherche dans le namespace Mapper : Mapper\PDO
        $pdo = new \PDO("mysql:host=localhost;dbname=enquetes;charset=UTF8", "root", "");
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        return $pdo;
    }
    
    static public function getTableName($className)
    {
        // récupère "nom_de_table" de Mapper\"nom_de_table"Mapper et passe en minuscules
        $tableName = strtolower(preg_replace('/Mapper\\\([A-Za-z]+)Mapper$/', "$1", get_class($className)));
        
        return $tableName;
    }
}
