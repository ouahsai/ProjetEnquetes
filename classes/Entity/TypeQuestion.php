<?php

namespace Entity;

class TypeQuestion {
    
    protected $id_type_question;
    protected $libelle_type_question;
    
    
    public function getId_type_question() {
        return $this->id_type_question;
    }

    public function getLibelle_type_question() {
        return $this->libelle_type_question;
    }

    public function setId_type_question($id_type_question) {
        $this->id_type_question = (int) $id_type_question;
        return $this;
    }

    public function setLibelle_type_question($libelle_type_question) {
        $this->libelle_type_question = (string) $libelle_type_question;
        return $this;
    }
}
