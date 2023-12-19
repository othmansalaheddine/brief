<?php
require_once ('admin.php');
require_once ('db_connection.php');
class adminDao{
    private $db;
    public function __construct(){
        $this->db = Database::getInstance()->getConnection(); 
    }
    
    public function select(){
        $query = $this->db->prepare("SELECT * FROM adminstrator");
        $query->execute();
        $admins[]=array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $admins[]=new Admin($row['idadmin'],$row['nomadmin'],$row['adresseadmin'],$row['telephoneadmin'],$row['emailadmin'],$row['usernameadmin'],$row['passwordadmin']);
        }
        return $admins;  
    }

    public function selectById($id){
        $query = $this->db->prepare("SELECT * FROM adminstrator WHERE idadmin = '$id'");
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $admin = new Admin($row['idadmin'],$row['nomadmin'],$row['adresseadmin'],$row['telephoneadmin'],$row['emailadmin'],$row['usernameadmin'],$row['passwordadmin']);
            return $admin;
        }
        return null;
    }
    public static function authentification($username,$password,$db_conncect){
        $query = $db_conncect->prepare("SELECT * FROM adminstrator WHERE usernameadmin = '$username' AND passwordadmin = '$password'");
        $query->execute();
        if($row = $query->fetch(PDO::FETCH_ASSOC)){
            return 1;
        }
        return 0;
        
    }
    public function insert($admin){

        $query=$this->db->prepare("CALL insert_admin(:nomadmin,:username,:adress,:email,:phone,:passwordadmin)");
        $nomadmin = $admin->getName();
        $username = $admin->getUsername();
        $adress = $admin->getAdresse();
        $email = $admin->getEmail();
        $phone = $admin->getPhone();
        $passwordadmin = $admin->getPassword();
        $query->bindParam(':nomadmin', $nomadmin);
        $query->bindParam(':username', $username);
        $query->bindParam(':adress', $adress);
        $query->bindParam(':email', $email);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':passwordadmin', $passwordadmin);
        $query->execute();

    }
    public function update($admin){
        $query = $this->db->prepare("UPDATE adminstrator SET nomadmin=:name,emailadmin=:email,passwordadmin=:password,adresseadmin=:adresse,telephoneadmin=:phone,usernameadmin=:username WHERE idadmin=:id");
        $nomadmin = $admin->getName();
        $username = $admin->getUsername();
        $adress = $admin->getAdresse();
        $email = $admin->getEmail();
        $id=$admin->getId();
        $phone = $admin->getPhone();
        $passwordadmin = $admin->getPassword();
        $query->bindParam(':name', $nomadmin);
        $query->bindParam(':username', $username);
        $query->bindParam(':adresse', $adress);
        $query->bindParam(':email', $email);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':password', $passwordadmin);
        $query->bindParam(':id', $id);
        $query->execute();
    }
    public function delete($admin){
        $query = $this->db->prepare("DELETE FROM adminstrator WHERE idadmin=:id");
        $id = $admin->getId();                              
        $query->bindParam(':id',$id);
        $query->execute();
    }

}
// $a=new adminDao();

// // $a->insert($d);
// $d=$a->selectById(1);
// print_r($d);