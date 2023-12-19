<?php
class LigneCommand{
    private $command;
    private $product;
    private $quantite;
    private $prix;

    public function __construct($command, $product, $quantite, $prix){
        $this->command = $command;
        $this->product = $product;
        $this->quantite = $quantite;
        $this->prix = $prix;
    }
    public function getCommand(){
        return $this->command;
    }
    public function getProduct(){
        return $this->product;
    }
    public function getQuantite(){
        return $this->quantite;
    }
    public function getPrix(){
        return $this->prix;
    }
}