<?php

namespace App\Models;

/**
 * @Entity @Table(name="participation")
 **/
class Participation {

    /**
     * @var int
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    public $id;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $idUser;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $idEvent;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $status;

    /**
     * @return int id
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return string idUser
     */
    public function getIdUser(){
        return $this->idUser;
    }

    /**
     * @return string idEvent
     */
    public function getIdEvent(){
        return $this->idEvent;
    }

    /**
     * @return string status
     */
    public function getIdStatus(){
        return $this->idEvent;
    }

    /**
     * @return App\Models\Participation
     */
    public function setidUser($idUser){

        if (!$idUser && !is_string($idUser)) {
            throw new \InvalidArgumentException("Participation idUser is required", 400);
        }

        $this->idUser = $idUser;
        return $this;
    }

    /**
     * @return App\Models\Participation
     */
    public function setidEvent($idEvent){

        if (!$idEvent && !is_string($idEvent)) {
            throw new \InvalidArgumentException("Participation idEvent is required", 400);
        }

        $this->idEvent = $idEvent;
        return $this;
    }

    /**
     * @return App\Models\Participation
     */
    public function setStatus($status){

        if (!$status && !is_string($status)) {
            throw new \InvalidArgumentException("Participation status is required", 400);
        }

        $this->status = $status;
        return $this;
    }

    /**
     * @return App\Models\Participation
     */
    public function getValues() {
        return get_object_vars($this);
    }
}