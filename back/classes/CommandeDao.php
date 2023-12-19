<?php
require_once 'db_connection.php';
require_once 'commande.php';
class CommandeDao{
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    public function select(){
        $query = $this->db->prepare("SELECT * FROM commande");
        $query->execute();
        $commandes[]=array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $commandes[]=new Commande($row['idcommande'],$row['montant'],$row['datecommande'],$row['dateenvoi'],$row['datelivraison'],$row['statutcommande'],$row['idclient']);
        }
       
        return $commandes;
    }
    
    public function selectById($id){
        $query = $this->db->prepare("SELECT * FROM commande WHERE idcommande = '$id'");
        $query->execute();
        $commande = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $commande = new Commande($row['idcommande'],$row['montant'],$row['datecommande'],$row['dateenvoi'],$row['datelivraison'],$row['statutcommande'],$row['idclient']);
        }
        return $commande;
    }

    
    public function insert($commande) {
        $sql = "CALL insertCommande(:client, :datecre, :dateliv, :dateenv, :mont, :stat)";
        $stmt = $this->db->prepare($sql);
        $client = $commande->getClient();
        $dateCreation = $commande->getDate_creation();
        $dateLivraison = $commande->getDate_livraison();
        $dateEnvoi = $commande->getDate_envoi();
        $montant = $commande->getPrix_total();
        $statut = $commande->getEtat();
        $stmt->bindParam(':client', $client);
        $stmt->bindParam(':datecre', $dateCreation);
        $stmt->bindParam(':dateliv', $dateLivraison);
        $stmt->bindParam(':dateenv', $dateEnvoi);
        $stmt->bindParam(':mont', $montant);
        $stmt->bindParam(':stat', $statut);
        $stmt->execute();
    }
    
        // CREATE TABLE commande(
    //     idcommande primary key auto_increment,
    //     idclient int,
    //     datecommande date,
    //     datelivraison date,
    //     dateenvoi date,
    //     montant float,
    //     statutcommande varchar(255),
    //     constraint fk_cl FOREIGN KEY (idclient) REFERENCES client(idclient),
    //     constraint ck_stat check statutcommande in ("encour","termine")
    
    // );
    public function update($commande){
        $query = $this->db->prepare("UPDATE commande SET datecommande=:date,datelivraison=:datliv,dateenvoi=:datenv,montant=:prix,statutcommande=:total WHERE idcommande=:id");
        $dateCreation = $commande->getDate_creation();
        $dateLivraison = $commande->getDate_livraison();
        $dateEnvoi = $commande->getDate_envoi();
        $montant = $commande->getPrix_total();
        $statut = $commande->getEtat();
        $id = $commande->getId();
        $query->bindParam(':date',$dateCreation);
        $query->bindParam(':datliv',$dateLivraison);
        $query->bindParam(':datenv',$dateEnvoi);
        $query->bindParam(':prix',$montant);
        $query->bindParam(':total',$statut);
        $query->bindParam(':id',$id);
        $query->execute();
    }
    public function delete($commande){
        $query = $this->db->prepare("DELETE FROM commande WHERE idcommande=:id");
        $id = $commande->getId();
        $query->bindParam(':id', $id);
        $query->execute();
    }

}


