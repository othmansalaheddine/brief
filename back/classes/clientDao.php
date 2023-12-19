<?php
require_once 'db_connection.php';
require_once 'client.php';

class clientDao{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection(); 
    }
    public function select(){
        $query = $this->db->prepare("SELECT * FROM client");
        $query->execute();
        $clients[]=array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $clients[]=new Client($row['idclient'],$row['nomclient'],$row['adresseclient'],$row['telephoneclient'],$row['emailclient'],$row['usernameclient'],$row['passwordclient']);
        }
        return $clients;  
    
    }
    public function selectById($id){
        $query = $this->db->prepare("SELECT * FROM client WHERE idclient = '$id'");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $client = new Client($row['idclient'],$row['nomclient'],$row['adresseclient'],$row['telephoneclient'],$row['emailclient'],$row['usernameclient'],$row['passwordclient']);
        }
        return $client;
    }
    public static function authentification($username,$password,$db_connect){
        $query = $db_connect->prepare("SELECT * FROM client WHERE usernameclient = '$username' AND passwordclient = '$password'");
        $query->execute();
        if($row = $query->fetch(PDO::FETCH_ASSOC)){
            return 1;
        }
        return 0;
        
    }
    
    public function insert($client){
        $query=$this->db->prepare("CALL insert_client(:nomclient,:usernameclient,:adresseclient,:telephoneclient,:emailclient,:passwordclient)");
        $nomclient = $client->getName();
        $usernameclient = $client->getUsername();
        $adresseclient = $client->getAdresse();
        $telephoneclient = $client->getTelephone();
        $emailclient = $client->getEmail();
        $passwordclient = $client->getPassword();
        $query->bindParam(':nomclient', $nomclient);
        $query->bindParam(':usernameclient', $usernameclient);
        $query->bindParam(':adresseclient', $adresseclient);
        $query->bindParam(':telephoneclient', $telephoneclient);
        $query->bindParam(':emailclient', $emailclient);
        $query->bindParam(':passwordclient', $passwordclient);
        $query->execute();
    }
    public function update($client){
        $query = $this->db->prepare("UPDATE client SET nomclient=:name,emailclient=:email,passwordclient=:password,adresseclient=:adresse,telephoneclient=:phone,usernameclient=:username WHERE idclient=:id");
        $nomclient = $client->getName();
        $usernameclient = $client->getUsername();
        $adresseclient = $client->getAdresse();
        $emailclient = $client->getEmail();
        $id=$client->getId();
        $telephoneclient = $client->getTelephone();
        $passwordclient = $client->getPassword();
        $query->bindParam(':name', $nomclient);
        $query->bindParam(':username', $usernameclient);
        $query->bindParam(':adresse', $adresseclient);
        $query->bindParam(':email', $emailclient);
        $query->bindParam(':phone', $telephoneclient);
        $query->bindParam(':password', $passwordclient);
        $query->bindParam(':id', $id);
        $query->execute();
    }
    public function delete($client){
        $query = $this->db->prepare("DELETE FROM client WHERE idclient=:id");
        $id = $client->getId();                              
        $query->bindParam(':id',$id);
        $query->execute();
    }
}


