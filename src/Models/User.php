<?php

namespace App\Models;

/**
 * @Entity @Table(name="users")
 **/
class User {

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
    public $firstName;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $lastName;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $area;

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
     * @var string
     * @Column(type="string") 
     */
    public $company;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $country;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $city;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $github;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $office;

    /**
     * @return int id
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return string firstName
     */
    public function getFirstName(){
        return $this->firstName;
    }

    /**
     * @return string lastName
     */
    public function getLastName(){
        return $this->lastName;
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
     * @return string area
     */
    public function getArea() {
        return $this->area;
    } 

    /**
     * @return string company
     */
    public function getCompany() {
        return $this->company;
    } 

    /**
     * @return string country
     */
    public function getCountry() {
        return $this->country;
    } 

    /**
     * @return string city
     */
    public function getCity() {
        return $this->city;
    }

    /**
     * @return string github
     */
    public function getGithub() {
        return $this->github;
    }

    /**
     * @return string office
     */
    public function getOffice() {
        return $this->office;
    }

    /**
     * @return App\Models\User
     */
    public function setOffice($office){

        if (!$office && !is_string($office)) {
            throw new \InvalidArgumentException("User office is required", 400);
        }

        $this->office = $office;
        return $this;
    }

    /**
     * @return App\Models\User
     */
    public function setGithub($github){

        if (!$github && !is_string($github)) {
            throw new \InvalidArgumentException("User github is required", 400);
        }

        $this->github = $github;
        return $this;  
    }
    
    /**
     * @return App\Models\User
     */
    public function setCity($city){

        if (!$city && !is_string($city)) {
            throw new \InvalidArgumentException("User city is required", 400);
        }

        $this->city = $city;
        return $this;  
    }

    /**
     * @return App\Models\User
     */
    public function setCountry($country){

        if (!$country && !is_string($country)) {
            throw new \InvalidArgumentException("User country is required", 400);
        }

        $this->country = $country;
        return $this;  
    }

    /**
     * @return App\Models\User
     */
    public function setCompany($company){

        if (!$company && !is_string($company)) {
            throw new \InvalidArgumentException("User company is required", 400);
        }

        $this->company = $company;
        return $this;  
    }

    /**
     * @return App\Models\User
     */
    public function setArea($area){

        if (!$area && !is_string($area)) {
            throw new \InvalidArgumentException("User area is required", 400);
        }

        $this->area = $area;
        return $this;  
    }

    /**
     * @return App\Models\User
     */
    public function setFirstName($firstName){

        if (!$firstName && !is_string($firstName)) {
            throw new \InvalidArgumentException("User FirstName is required", 400);
        }

        $this->firstName = $firstName;
        return $this;  
    }

    /**
     * @return App\Models\User
     */
    public function setLastName($lastName){

        if (!$lastname && !is_string($lastName)) {
            throw new \InvalidArgumentException("User lastname is required", 400);
        }

        $this->lastName = $lastName;
        return $this;  
    }

     /**
     * @return App\Models\User
     */
    public function setPassword($password) {

        if (!$password && !is_string($password)) {
            throw new \InvalidArgumentException("Password is required", 400);
        }

        $this->password = $password;
        return $this;
    }


    /**
     * @return App\Models\User
     */
    public function setEmail($email) {

        if (!$email && !is_string($email)) {
            throw new \InvalidArgumentException("Password is required", 400);
        }

        $this->email = $email;
        return $this;
    }

    /**
     * @return App\Models\User
     */
    public function getValues() {
        return get_object_vars($this);
    }
}