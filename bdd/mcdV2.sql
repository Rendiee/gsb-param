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
# Table: habilitation
#------------------------------------------------------------

CREATE TABLE habilitation(
        h_id      Int NOT NULL ,
        h_libelle Varchar (100) NOT NULL
	,CONSTRAINT habilitation_PK PRIMARY KEY (h_id)
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
        ca_id         Int NOT NULL
	,CONSTRAINT produit_PK PRIMARY KEY (p_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: unite
#------------------------------------------------------------

CREATE TABLE unite(
        un_id      Int NOT NULL ,
        un_libelle Varchar (20) NOT NULL
	,CONSTRAINT unite_PK PRIMARY KEY (un_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contenant_produit
#------------------------------------------------------------

CREATE TABLE contenant_produit(
        p_id          Int NOT NULL ,
        con_volume    Int NOT NULL ,
        con_prixVente Float NOT NULL ,
        con_qteStock  Int NOT NULL ,
        un_id         Int NOT NULL
	,CONSTRAINT contenant_produit_PK PRIMARY KEY (p_id,con_volume)
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
        a_date        Date NOT NULL ,
        a_note        Int NOT NULL ,
        p_id          Int NOT NULL ,
        u_id          Int NOT NULL
	,CONSTRAINT avis_PK PRIMARY KEY (a_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commande
#------------------------------------------------------------

CREATE TABLE commande(
        com_id          Int NOT NULL ,
        com_dateComande Date NOT NULL ,
        com_totalPrix   Float NOT NULL ,
        u_id            Int NOT NULL
	,CONSTRAINT commande_PK PRIMARY KEY (com_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: login
#------------------------------------------------------------

CREATE TABLE login(
        l_id         Int NOT NULL ,
        l_motdepasse Varchar (255) NOT NULL ,
        u_id         Int NOT NULL
	,CONSTRAINT login_PK PRIMARY KEY (l_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        u_id      Int NOT NULL ,
        u_nom     Varchar (50) ,
        u_prenom  Varchar (50) ,
        u_adresse Varchar (100) ,
        u_cp      Varchar (100) ,
        u_ville   Varchar (100) ,
        u_email   Varchar (100) NOT NULL ,
        l_id      Int ,
        h_id      Int
	,CONSTRAINT utilisateur_PK PRIMARY KEY (u_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: commander
#------------------------------------------------------------

CREATE TABLE commander(
        p_id        Int NOT NULL ,
        con_volume  Int NOT NULL ,
        com_id      Int NOT NULL ,
        qte_produit Int NOT NULL
	,CONSTRAINT commander_PK PRIMARY KEY (p_id,con_volume,com_id)
)ENGINE=InnoDB;




ALTER TABLE produit
	ADD CONSTRAINT produit_categorie0_FK
	FOREIGN KEY (ca_id)
	REFERENCES categorie(ca_id);

ALTER TABLE contenant_produit
	ADD CONSTRAINT contenant_produit_produit0_FK
	FOREIGN KEY (p_id)
	REFERENCES produit(p_id);

ALTER TABLE contenant_produit
	ADD CONSTRAINT contenant_produit_unite1_FK
	FOREIGN KEY (un_id)
	REFERENCES unite(un_id);

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

ALTER TABLE commande
	ADD CONSTRAINT commande_utilisateur0_FK
	FOREIGN KEY (u_id)
	REFERENCES utilisateur(u_id);

ALTER TABLE login
	ADD CONSTRAINT login_utilisateur0_FK
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

ALTER TABLE commander
	ADD CONSTRAINT commander_contenant_produit0_FK
	FOREIGN KEY (p_id,con_volume)
	REFERENCES contenant_produit(p_id,con_volume);

ALTER TABLE commander
	ADD CONSTRAINT commander_commande1_FK
	FOREIGN KEY (com_id)
	REFERENCES commande(com_id);
