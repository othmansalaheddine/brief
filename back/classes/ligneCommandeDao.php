<?php
require_once 'productDao.php';
require_once 'db_connection.php';
require_once 'ligneCommande.php';
require_once 'CommandeDao.php';

class ligneCommandeDao{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection(); 
    }
    public function select(){
        $query = $this->db->prepare("SELECT * FROM produit_commande");
        $query->execute();
        $ligneCommandes[]=array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $productDao=new ProductDao();
            $p=$productDao->selectById($row['idproduit']);
            $commandeDao=new CommandeDao();
            $c=$commandeDao->selectById($row['idcommande']);
            $ligneCommandes[]=new LigneCommand($p,$c,$row['qantity'],$row['prix_unitaire']);
        }
        return $ligneCommandes;
    }
    public function selectById($idp,$idc){
        $query = $this->db->prepare("SELECT * FROM produit_commande WHERE idproduit = '$idp' AND idcommande = '$idc'");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $productDao=new ProductDao();
            $p=$productDao->selectById($row['idproduit']);
            $commandeDao=new CommandeDao();
            $c=$commandeDao->selectById($row['idcommande']);
            $ligneCommand = new LigneCommand($p,$c,$row['qantity'],$row['prix_unitaire']);
        }
        return $ligneCommand;
    }
    public function insert($ligneCommand){
        $query=$this->db->prepare("CALL insertligneCommande(:idcommande,:idproduit,:prix,:quant);");
        $idcommande = $ligneCommand->getCommand()->getCommand();
        $idproduit = $ligneCommand->getProduct()->getIdproduct();
        $prix = $ligneCommand->getPrix();
        $quant = $ligneCommand->getQuantite();
        $query->bindParam(':idcommande', $idcommande);
        $query->bindParam(':idproduit', $idproduit);
        $query->bindParam(':prix', $prix);
        $query->bindParam(':quant', $quant);
        $query->execute();
    }
    public function delete($ligneCommand){
        $query = $this->db->prepare("DELETE FROM produit_commande WHERE idproduit=:id and idcommande=:idc");
        $idc=$ligneCommand->getCommand()->getCommand();
        $id = $ligneCommand->getProduct()->getIdproduct();                              
        $query->bindParam(':id',$id);
        $query->bindParam(':idc',$idc);
        $query->execute();
    }
    public function update($ligneCommand){
        $query = $this->db->prepare("UPDATE produit_commande SET idcommande=:idcommande,idproduit=:idproduit,prix=:prix,quant=:quant WHERE idproduit=:id and idcommande=:idc");
        $idc=$ligneCommand->getCommand()->getCommand();
        $id = $ligneCommand->getProduct()->getIdproduct();
        $prix = $ligneCommand->getPrix();
        $quant = $ligneCommand->getQuantite();
        $query->bindParam(':idcommande', $idc);
        $query->bindParam(':idproduit', $id);
        $query->bindParam(':prix', $prix);
        $query->bindParam(':quant', $quant);
        $query->bindParam(':idc', $idc);
        $query->bindParam(':id', $id);
        $query->execute();
    }
}

