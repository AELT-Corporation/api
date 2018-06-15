<?php

namespace App\Models;

/**
 * @Entity @Table(name="Eventss")
 **/
class Events {

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
    public $name;


    /**
     * @var string
     * @Column(type="string") 
     */
    public $email;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $password;

    /**
     * @return int id
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return string name
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return string email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return string password
     */
    public function getPassword() {
        return $this->password;
    }    

    /**
     * @return App\Models\Events
     */
    public function setName($name){

        if (!$name && !is_string($name)) {
            throw new \InvalidArgumentException("Events name is required", 400);
        }

        $this->name = $name;
        return $this;  
    }

     /**
     * @return App\Models\Events
     */
    public function setPassword($password) {

        if (!$password && !is_string($password)) {
            throw new \InvalidArgumentException("Password is required", 400);
        }

        $this->password = $password;
        return $this;
    }


    /**
     * @return App\Models\Events
     */
    public function setEmail($email) {

        if (!$email && !is_string($email)) {
            throw new \InvalidArgumentException("Password is required", 400);
        }

        $this->email = $email;
        return $this;
    }

    /**
     * @return App\Models\Events
     */
    public function getValues() {
        return get_object_vars($this);
    }
}