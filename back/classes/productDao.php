<?php
require_once 'CategoryDao.php';
require_once 'categorie.php';
require_once 'db_connection.php';
require_once 'product.php';
class ProductDao{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection(); 
    }
    
    public function select(){
        $query = $this->db->prepare("SELECT * FROM produit");
        $query->execute();
        $products[]=array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $cat=new CategoryDao();
            $c=$cat->selectById($row['idcat']);
            $products[]=new Product($row['idproduit'],$row['nomproduit'],$row['descriptionproduit'],$row['prixproduit'],$row['prix_offre'],$row['prix_achat'],$row['stockproduit'],$row['qantity_min'],$row['imageproduit'],$c);
        }
        return $products;  
    }
    public function selectById($id){
        $query = $this->db->prepare("SELECT * FROM produit WHERE idproduit = '$id'");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $cat=new CategoryDao();
            $c=$cat->selectById($row['idcat']);
            $product = new Product($row['idproduit'],$row['nomproduit'],$row['descriptionproduit'],$row['prixproduit'],$row['prix_offre'],$row['prix_achat'],$row['stockproduit'],$row['qantity_min'],$row['imageproduit'],$c);
        }
        return $product;
    }
    public function selectbyCategorie($category){
        $query = $this->db->prepare("SELECT * FROM produit WHERE idcat = '$category->getId()'");
        $query->execute();
        $products[]=array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $cat=new CategoryDao();
            $c=$cat->selectById($row['idcat']);
            $products[]=new Product($row['idproduit'],$row['nomproduit'],$row['descriptionproduit'],$row['prixproduit'],$row['prix_offre'],$row['prix_achat'],$row['stockproduit'],$row['qantity_min'],$row['imageproduit'],$c);
        }
        return $products;
    }
    public function insert($product){
        $query=$this->db->prepare("CALL insert_product(:name,:description,:price,:priceOffer,:price_achat,:stock,:qantity_min,:img,:category)");
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $priceOffer = $product->getPriceOffer();
        $price_achat = $product->getPrice_achat();
        $stock = $product->getStock();
        $qantity_min = $product->getQantity_min();
        $img = $product->getImg();
        $category = $product->getCategory()->getId();
        $query->bindParam(':name', $name);
        $query->bindParam(':description', $description);
        $query->bindParam(':price', $price);
        $query->bindParam(':priceOffer', $priceOffer);
        $query->bindParam(':price_achat', $price_achat);
        $query->bindParam(':stock', $stock);
        $query->bindParam(':qantity_min',$qantity_min);
        $query->bindParam(':img', $img);
        $query->bindParam(':category', $category);
        $query->execute();
    }
    public function update($product){
        $query = $this->db->prepare("UPDATE produit SET nomproduit=:name,descriptionproduit=:description,prixproduit=:price,prix_offre=:priceOffer,prix_achat=:price_achat,stockproduit=:stock,qantity_min=:qantity_min,imageproduit=:img,idcat=:category WHERE idproduit=:id");
        $name = $product->getName();
        $description = $product->getDescription();
        $price = $product->getPrice();
        $priceOffer = $product->getPriceOffer();
        $price_achat = $product->getPrice_achat();
        $stock = $product->getStock();
        $qantity_min = $product->getQantity_min();
        $img = $product->getImg();
        $category = $product->getCategory()->getId();
        $id=$product->getIdproduct();
        $query->bindParam(':name', $name);  
        $query->bindParam(':description', $description);
        $query->bindParam(':price', $price);
        $query->bindParam(':priceOffer', $priceOffer);
        $query->bindParam(':price_achat', $price_achat);
        $query->bindParam(':stock', $stock);
        $query->bindParam(':qantity_min', $qantity_min);
        $query->bindParam(':img', $img);
        $query->bindParam(':category', $category);
        $query->bindParam(':id', $id);
        $query->execute();

    }

    public function delete($product){
        $query = $this->db->prepare("DELETE FROM produit WHERE idproduit=:id");
        $id = $product->getIdproduct();                              
        $query->bindParam(':id',$id);
        $query->execute();
    }
}
$p=new ProductDao();
$c=new CategoryDao();



