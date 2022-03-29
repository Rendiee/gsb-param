#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: categorie
#------------------------------------------------------------

CREATE TABLE categorie(
        ca_id       Int NOT NULL ,
        ca_libelle  Varchar (50) NOT NULL ,
        ca_acronyme Varchar (2) NOT NULL
	,CONSTRAINT categorie_PK PRIMARY KEY (ca_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: produit
#------------------------------------------------------------

CREATE TABLE produit(
        p_id          Int NOT NULL ,
        p_nom         Varchar (50) NOT NULL ,
        p_photo       Varchar (255) NOT NULL ,
        p_description Varchar (255) NOT NULL ,
        p_marque      Varchar (50) NOT NULL ,
        p_stock       Int NOT NULL ,
        ca_id         Int NOT NULL
	,CONSTRAINT produit_PK PRIMARY KEY (p_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contenance
#------------------------------------------------------------

CREATE TABLE contenance(
        co_id    Int NOT NULL ,
        co_qte   Int NOT NULL ,
        co_unite Varchar (5) NOT NULL
	,CONSTRAINT contenance_PK PRIMARY KEY (co_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: habilitation
#------------------------------------------------------------

CREATE TABLE habilitation(
        h_id      Int NOT NULL ,
        h_libelle Varchar (100) NOT NULL
	,CONSTRAINT habilitation_PK PRIMARY KEY (h_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: command_stock
#------------------------------------------------------------

CREATE TABLE command_stock(
        cs_id           Int NOT NULL ,
        cs_dateCommande Date NOT NULL
	,CONSTRAINT command_stock_PK PRIMARY KEY (cs_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: remplir
#------------------------------------------------------------

CREATE TABLE remplir(
        p_id          Int NOT NULL ,
        co_id         Int NOT NULL ,
        r_prixProduit Float NOT NULL
	,CONSTRAINT remplir_PK PRIMARY KEY (p_id,co_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: passer
#------------------------------------------------------------

CREATE TABLE passer(
        cs_id        Int NOT NULL ,
        p_id         Int NOT NULL ,
        cs_nbProduit Int NOT NULL
	,CONSTRAINT passer_PK PRIMARY KEY (cs_id,p_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: suggerer
#------------------------------------------------------------

CREATE TABLE suggerer(
        p_id         Int NOT NULL ,
        p_id_produit Int NOT NULL
	,CONSTRAINT suggerer_PK PRIMARY KEY (p_id,p_id_produit)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: avis
#------------------------------------------------------------

CREATE TABLE avis(
        a_id          Int NOT NULL ,
        a_description Varchar (255) NOT NULL ,
        p_id          Int NOT NULL ,
        u_id          Int NOT NULL
	,CONSTRAINT avis_PK PRIMARY KEY (a_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        u_id      Int NOT NULL ,
        u_nom     Varchar (50) NOT NULL ,
        u_prenom  Varchar (50) NOT NULL ,
        u_email   Varchar (100) NOT NULL ,
        u_ville   Varchar (100) NOT NULL ,
        u_adresse Varchar (100) NOT NULL ,
        u_cp      Varchar (100) NOT NULL ,
        l_id      Int NOT NULL ,
        h_id      Int NOT NULL
	,CONSTRAINT utilisateur_PK PRIMARY KEY (u_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: login
#------------------------------------------------------------

CREATE TABLE login(
        l_id          Int NOT NULL ,
        l_identifiant Varchar (20) NOT NULL ,
        l_motdepasse  Varchar (255) NOT NULL ,
        u_id          Int NOT NULL
	,CONSTRAINT login_PK PRIMARY KEY (l_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commande
#------------------------------------------------------------

CREATE TABLE commande(
        com_id          Int NOT NULL ,
        com_dateComande Date NOT NULL ,
        u_id            Int NOT NULL
	,CONSTRAINT commande_PK PRIMARY KEY (com_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contenir
#------------------------------------------------------------

CREATE TABLE contenir(
        p_id        Int NOT NULL ,
        com_id      Int NOT NULL ,
        qte_produit Int NOT NULL
	,CONSTRAINT contenir_PK PRIMARY KEY (p_id,com_id)
)ENGINE=InnoDB;




ALTER TABLE produit
	ADD CONSTRAINT produit_categorie0_FK
	FOREIGN KEY (ca_id)
	REFERENCES categorie(ca_id);

ALTER TABLE remplir
	ADD CONSTRAINT remplir_produit0_FK
	FOREIGN KEY (p_id)
	REFERENCES produit(p_id);

ALTER TABLE remplir
	ADD CONSTRAINT remplir_contenance1_FK
	FOREIGN KEY (co_id)
	REFERENCES contenance(co_id);

ALTER TABLE passer
	ADD CONSTRAINT passer_command_stock0_FK
	FOREIGN KEY (cs_id)
	REFERENCES command_stock(cs_id);

ALTER TABLE passer
	ADD CONSTRAINT passer_produit1_FK
	FOREIGN KEY (p_id)
	REFERENCES produit(p_id);

ALTER TABLE suggerer
	ADD CONSTRAINT suggerer_produit0_FK
	FOREIGN KEY (p_id)
	REFERENCES produit(p_id);

ALTER TABLE suggerer
	ADD CONSTRAINT suggerer_produit1_FK
	FOREIGN KEY (p_id_produit)
	REFERENCES produit(p_id);

ALTER TABLE avis
	ADD CONSTRAINT avis_produit0_FK
	FOREIGN KEY (p_id)
	REFERENCES produit(p_id);

ALTER TABLE avis
	ADD CONSTRAINT avis_utilisateur1_FK
	FOREIGN KEY (u_id)
	REFERENCES utilisateur(u_id);

ALTER TABLE utilisateur
	ADD CONSTRAINT utilisateur_login0_FK
	FOREIGN KEY (l_id)
	REFERENCES login(l_id);

ALTER TABLE utilisateur
	ADD CONSTRAINT utilisateur_habilitation1_FK
	FOREIGN KEY (h_id)
	REFERENCES habilitation(h_id);

ALTER TABLE utilisateur 
	ADD CONSTRAINT utilisateur_login0_AK 
	UNIQUE (l_id);

ALTER TABLE login
	ADD CONSTRAINT login_utilisateur0_FK
	FOREIGN KEY (u_id)
	REFERENCES utilisateur(u_id);

ALTER TABLE login 
	ADD CONSTRAINT login_utilisateur0_AK 
	UNIQUE (u_id);

ALTER TABLE commande
	ADD CONSTRAINT commande_utilisateur0_FK
	FOREIGN KEY (u_id)
	REFERENCES utilisateur(u_id);

ALTER TABLE contenir
	ADD CONSTRAINT contenir_produit0_FK
	FOREIGN KEY (p_id)
	REFERENCES produit(p_id);

ALTER TABLE contenir
	ADD CONSTRAINT contenir_commande1_FK
	FOREIGN KEY (com_id)
	REFERENCES commande(com_id);

INSERT INTO `categorie` (`ca_id`, `ca_libelle`, `ca_acronyme`) VALUES
(1, 'Cheveux', 'CH'),
(2, 'Sommeil', 'SM'),
(3, 'Visage', 'VG'),
(4, 'Maternité', 'MT'),
(5, 'Hygiène', 'HY'),
(6, 'Complément alimentaire', 'CA');
