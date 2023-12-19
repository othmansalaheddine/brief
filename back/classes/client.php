<?php
class Client{
    private $idclient;
    private $nom;
    private $adress;
    private $telephone;
    private $email;
    private $username;
    private $password;

    public function __construct($idclient, $nom, $adress, $telephone, $email, $username, $password) {
        $this->idclient = $idclient;
        $this->nom = $nom;
        $this->adress = $adress;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
    }
    public function getId() {
        return $this->idclient;
    }
    public function getName() {
        return $this->nom;
    }
    public function getAdresse() {
        return $this->adress;
    }
    public function getTelephone() {
        return $this->telephone;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getUsername() {
        return $this->username;
    }
    public function getPassword() {
        return $this->password;
    }
    

}