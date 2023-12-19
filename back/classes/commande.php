<?php
class Commande{
    private $id;
    private $prix_total;
    private $date_creation;
    private $date_envoi;
    private $date_livraison;
    private $etat;
    private $client;
    public function __construct($id, $client,  $date_creation, $date_envoi, $date_livraison,$prix_total, $etat){
        $this->id = $id;
        $this->prix_total = $prix_total;
        $this->date_creation = $date_creation;
        $this->date_envoi = $date_envoi;
        $this->date_livraison = $date_livraison;
        $this->etat = $etat;
        $this->client = $client;
    }

    public function getId() {
        return $this->id;
    }
   
    public function getPrix_total() {
        return $this->prix_total;
    }
   
    public function getDate_creation() {
        return $this->date_creation;
    }
    
    public function getDate_envoi() {
        return $this->date_envoi;
    }
    
    public function getDate_livraison() {
        return $this->date_livraison;
    }
    
    public function getEtat() {
        return $this->etat;
    }
    
    public function getClient() {
        return $this->client;
    }
    
    
}

