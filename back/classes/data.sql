create table client(
    idclient  int primary key auto_increment,
    nomclient varchar(255),
    adresseclient varchar(255),
    telephoneclient varchar(255),
    emailclient varchar(255),
    usernameclient varchar(255),
    passwordclient varchar(255)
);
DELIMITER $$
create procedure insert_admin(nomadmin varchar(255),username varchar(255),adress varchar(255),email varchar(255),phone varchar(255),passwordadmin varchar(255))
begin 
    insert into adminstrator(nomadmin,adresseadmin,telephoneadmin,emailadmin,usernameadmin,passwordadmin) values(nomadmin,adress,phone,email,username,passwordadmin);
    end$$
    DELIMITER;
DELIMITER $$
CREATE table adminstrator(
    idadmin int primary key auto_increment,
    nomadmin varchar(255),
    adresseadmin varchar(255),
    telephoneadmin varchar(255),
    emailadmin varchar(255),
    usernameadmin varchar(255),
    passwordadmin varchar(255)
);
CREATE table categorie(
    idcategorie int primary key auto_increment,
    nomcategorie varchar(255),
    descriptioncategorie varchar(255),
    imagecategorie varchar(255)
);

CREATE TABLE produit(
    idproduit int primary key auto_increment,
    nomproduit varchar(255),
    descriptionproduit varchar(255),
    prixproduit float,
    prix_offre float,
    prix_achat float,
    stockproduit varchar(255),
    qantity_min int,
    imageproduit varchar(255),
    idcat int,
    FOREIGN KEY (idcat) REFERENCES categorie(idcategorie) on delete cascade,
);
DELIMITER $$
CREATE procedure insert_product(product varchar(250),descript varchar(250),prix float,prixof float,prixach float,stock float,min_stock int,photo varchar(250),idcat int)
begin 
insert into produit (nomproduit,descriptionproduit,prixproduit,prix_offre,prix_achat,stockproduit,qantity_min,imageproduit,idcat) values(product,descript,prix,prixof,prixach,stock,min_stock,photo,idcat);
end$$
    DELIMITER;
CREATE TABLE commande(
    idcommande primary key auto_increment,
    idclient int,
    datecommande date,
    datelivraison date,
    dateenvoi date,
    montant float,
    statutcommande varchar(255),
    constraint fk_cl FOREIGN KEY (idclient) REFERENCES client(idclient)
);

CREATE TABLE produit_commande(
    idproduit int,
    idcommande int,
    prix_unitaire FLOAT,
    qantity INT,
    PRIMARY KEY (idproduit, idcommande),
    FOREIGN KEY (idproduit) REFERENCES produit(idproduit) on delete cascade,
    FOREIGN KEY (idcommande) REFERENCES commande(idcommande) on delete cascade
);

DELIMITER $$

CREATE PROCEDURE insert_client(
    IN nom VARCHAR(255),
    IN username VARCHAR(255),
    IN adresse VARCHAR(255),
    IN telephone VARCHAR(255),
    IN email VARCHAR(255),
    IN passwordclient VARCHAR(255)
)
BEGIN
    INSERT INTO client(nomclient, adresseclient, telephoneclient, emailclient, usernameclient, passwordclient)
    VALUES (nom, adresse, telephone, email, username, passwordclient);
END $$

DELIMITER ;

create procedure insert_category(category varchar(250),descript varchar(250),photo varchar(250))
begin 
    insert into categorie(nomcategorie,descriptioncategorie,imagecategorie) values(category,descript,photo);
    end$$
     DELIMITER;

DELIMITER $$
create procedure insertCommande(client int,datec date,dateliv date,dateenv date,montant float,statut varchar(250))
begin
insert into commande (idclient,datecommande,datelivraison,dateenvoi,montant,statutcommande) values(client,datec,dateliv,dateenv,montant,statut);

end $$
DELIMITER ;

DELIMITER $$ 
create procedure insertligneCommande(idcom int,idprod int,prix float,qant int)
begin 
insert into produit_commande(idproduit,idcommande,prix_unitaire,qantity) values(idprod,idcom,prix,qant);
END $$

DELIMITER ;







DELIMITER $$
CREATE TRIGGER updateCommandeAfterInsert
AFTER INSERT ON produit_commande
FOR EACH ROW
BEGIN
    UPDATE commande SET montant = montant + NEW.prix_unitaire * NEW.qantity WHERE idcommande = NEW.idcommande;
    UPDATE produit SET stockproduit = stockproduit - NEW.qantity WHERE idproduit = NEW.idproduit;
END;
$$

CREATE TRIGGER updateCommandeAfterUpdate
AFTER UPDATE ON produit_commande
FOR EACH ROW
BEGIN
    UPDATE commande SET montant = montant + NEW.prix_unitaire * NEW.qantity WHERE idcommande = NEW.idcommande;
    UPDATE produit SET stockproduit = stockproduit - NEW.qantity WHERE idproduit = NEW.idproduit;
END;
$$
DELIMITER ;


DELIMITER $$
CREATE FUNCTION numberofClient()
returns integer
DECLARE n integer;
BEGIN
SELECT COUNT(*) INTO n FROM client;
return n; 
END $$
DELIMITER ;

DELIMITER $$
CREATE FUNCTION numberofClient()
RETURNS INTEGER
BEGIN
    DECLARE n INTEGER;
    SELECT COUNT(*) INTO n FROM client;
    RETURN n;
END $$;

DELIMITER ;