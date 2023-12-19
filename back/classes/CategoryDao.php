<?php
require_once 'db_connection.php';
require_once 'categorie.php';

class CategoryDao {
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection(); 
    }
    
    public function select(){
        $query = $this->db->prepare("SELECT * FROM categorie");
        $query->execute();
        $categories[]=array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $categories[]=new Category($row['idcategorie'],$row['nomcategorie'],$row['descriptioncategorie'],$row['imagecategorie']);
        }
        return $categories;  
    
    }
    public function selectById($id){

        $query = $this->db->prepare("SELECT * FROM categorie WHERE idcategorie = '$id'");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $category = new Category($row['idcategorie'],$row['nomcategorie'],$row['descriptioncategorie'],$row['imagecategorie']);
        }
        return $category;
    }
    public function insert($category){
        $query=$this->db->prepare("CALL insert_category(:nomcategorie,:descriptioncategorie,:imagecategorie)");
        $nomcategorie = $category->getName();
        $descriptioncategorie = $category->getDescription();
        $imagecategorie = $category->getImg();
        $query->bindParam(':nomcategorie', $nomcategorie);
        $query->bindParam(':descriptioncategorie', $descriptioncategorie);
        $query->bindParam(':imagecategorie', $imagecategorie);
        $query->execute();
    }

    public function update($category){
        $query = $this->db->prepare("UPDATE categorie SET nomcategorie=:name,descriptioncategorie=:description,imagecategorie=:image WHERE idcategorie=:id");
        $nomcategorie = $category->getName();
        $descriptioncategorie = $category->getDescription();
        $id=$category->getId();
        $imagecategorie = $category->getImg();
        $query->bindParam(':name', $nomcategorie);
        $query->bindParam(':description', $descriptioncategorie);
        $query->bindParam(':image', $imagecategorie);
        $query->bindParam(':id', $id);
        $query->execute();
    }
    public function delete($category){
        $query = $this->db->prepare("DELETE FROM categorie WHERE idcategorie=:id");
        $id = $category->getId();                              
        $query->bindParam(':id',$id);
        $query->execute();
    }

}

