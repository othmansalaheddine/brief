<?php
class Admin{
    private $id;
    private $name;
    private $adresse;
    private $phone;
    private $username;
    private $email;
    private $password;
   
    // private $adresse;
    public function __construct($id, $name, $adresse,$phone,$email,$username, $password){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->adresse = $adresse;
        $this->phone = $phone;
        $this->username = $username;
        
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getAdresse(){
        return $this->adresse;
    }
    public function getPhone(){
        return $this->phone;
    }
    public function getUsername(){
        return $this->username;
    }
}