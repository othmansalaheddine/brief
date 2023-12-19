<?php
class category{
    private $id;
    private $name;
    private $description;
    private $img;
    
    public function __construct($id, $name, $description, $img){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->img = $img;
    }

    public function getId(){
        return $this->id;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function getImg(){
        return $this->img;
    }
}