<?php
class Product{
    private $idproduct;
    private $name;
    private $description;
    private $price;
    private $priceOffer;
    private $price_achat;
    private $stock;
    private $qantity_min;
    private $img;
    private $category;
    
    public function __construct($idproduct, $name, $description, $price, $priceOffer, $price_achat, $stock, $qantity_min, $img, $category){
        $this->idproduct = $idproduct;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->priceOffer = $priceOffer;
        $this->price_achat = $price_achat;
        $this->stock = $stock;
        $this->qantity_min = $qantity_min;
        $this->img = $img;
        $this->category = $category;
    }
    
    public function getIdproduct(){
        return $this->idproduct;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function getPrice(){
        return $this->price;
    }
    
    public function getPriceOffer(){
        return $this->priceOffer;
    }
    
    public function getPrice_achat(){
        return $this->price_achat;
    }
    
    public function getStock(){
        return $this->stock;
    }
    
    public function getQantity_min(){
        return $this->qantity_min;
    }
    
    public function getImg(){
        return $this->img;
    }
    
    public function getCategory(){
        return $this->category;
    }
    
}