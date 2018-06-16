<?php

namespace App\Models;

/**
 * @Entity @Table(name="event")
 **/
class Event {

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
    public $company;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $nameEvent;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $email;


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
    public $adress;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $city;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $country;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $tags;

    /**
     * @var string
     * @Column(type="string") 
     */
    public $about;

    /**
     * @return int id
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return string company
     */
    public function getCompany(){
        return $this->company;
    }

    /**
     * @return string nameEvent
     */
    public function getNameEvent(){
        return $this->nameEvent;
    }

    /**
     * @return string email
     */
    public function getEmail() {
        return $this->email;
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
     * @return string adress
     */
    public function getAdress() {
        return $this->adress;
    }
    
    /**
     * @return string city
     */
    public function getCity() {
        return $this->city;
    }  
    
    /**
     * @return string country
     */
    public function getCountry() {
        return $this->country;
    }  
    
    /**
     * @return string tags
     */
    public function getTags() {
        return $this->tags;
    } 

    /**
     * @return string about
     */
    public function getAbout() {
        return $this->about;
    } 


    /**
     * @return App\Models\Event
     */
    public function setCompany($company){

        if (!$company && !is_string($company)) {
            throw new \InvalidArgumentException("Company is required", 400);
        }

        $this->company = $company;
        return $this;  
    }

    /**
     * @return App\Models\Event
     */
    public function setNameEvent($nameEvent){

        if (!$nameEvent && !is_string($nameEvent)) {
            throw new \InvalidArgumentException("Event name is required", 400);
        }

        $this->nameEvent = $nameEvent;
        return $this;  
    }

    /**
     * @return App\Models\Event
     */
    public function setEmail($email) {

        if (!$email && !is_string($email)) {
            throw new \InvalidArgumentException("Password is required", 400);
        }

        $this->email = $email;
        return $this;
    }

    /**
     * @return App\Models\Event
     */
    public function setFirstName($firstName) {

        if (!$firstName && !is_string($firstName)) {
            throw new \InvalidArgumentException("FirstName is required", 400);
        }

        $this->firstName = $firstName;
        return $this;
    }


    /**
     * @return App\Models\Event
     */
    public function setLastName($lastName) {

        if (!$lastName && !is_string($lastName)) {
            throw new \InvalidArgumentException("LastName is required", 400);
        }

        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return App\Models\Event
     */
    public function setAdress($adress) {

        if (!$adress && !is_string($adress)) {
            throw new \InvalidArgumentException("Adress is required", 400);
        }

        $this-> adress= $adress;
        return $this;
    }

    /**
     * @return App\Models\Event
     */
    public function setCity($city) {

        if (!$city && !is_string($city)) {
            throw new \InvalidArgumentException("City is required", 400);
        }

        $this-> city= $city;
        return $this;
    }


    /**
     * @return App\Models\Event
     */
    public function setCountry($country) {

        if (!$country && !is_string($country)) {
            throw new \InvalidArgumentException("Country is required", 400);
        }

        $this->country = $country;
        return $this;
    }


    /**
     * @return App\Models\Event
     */
    public function setTags($tags) {

        if (!tags && !is_string(tags)) {
            throw new \InvalidArgumentException("Tags is required", 400);
        }

        $this->tags = $tags;
        return $this;
    }

    /**
     * @return App\Models\Event
     */
    public function setAbout($about) {

        if (!about && !is_string(about)) {
            throw new \InvalidArgumentException("About is required", 400);
        }

        $this->about = $about;
        return $this;
    }

    /**
     * @return App\Models\Event
     */
    public function getValues() {
        return get_object_vars($this);
    }
}