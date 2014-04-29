<?php

namespace Entity;

class Reponse {
    
    protected $idReponse;
    protected $valeurReponse;
    protected $uniqueUserId;
    
    /**
     * 
     * @var Question
     */
    protected $idQuestion;
    
    public function getIdReponse() {
        return $this->idReponse;
    }

    public function getValeurReponse() {
        return $this->valeurReponse;
    }

    public function getUniqueUserId() {
        return $this->uniqueUserId;
    }

    public function setIdReponse($idReponse) {
        $this->idReponse = $idReponse;
        return $this;
    }

    public function setValeurReponse($valeurReponse) {
        $this->valeurReponse = $valeurReponse;
        return $this;
    }

    public function setUniqueUserId($uniqueUserId) {
        $this->uniqueUserId = $uniqueUserId;
        return $this;
    }
    public function getIdQuestion() {
        return $this->idQuestion;
    }

    public function setIdQuestion(Question $idQuestion) {
        $this->idQuestion = $idQuestion;
        return $this;
    }



}
