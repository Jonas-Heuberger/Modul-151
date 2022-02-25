CREATE DATABASE todoDatabase;

USE todoDatabase;

CREATE TABLE Users (
	idUsers INT primary key auto_increment not null,
	username varchar(45) not null,
	firstname varchar(45) not null,
	lastname varchar(45) not null,
	password varchar(45) not null
);

CREATE TABLE Kategorien (
	idKategorien INT primary key auto_increment not null,
	name varchar(45) not null
);

CREATE TABLE Todos(
	idTodos INT primary key auto_increment not null,
	prioritaet TINYINT(3) not null,
	kategorie varchar(45) not null,
	was varchar(45) not null,
	erstellt DATETIME not null,
	faellig DATETIME not null,
	status TINYINT(100) not null,
	archiv TINYINT(1) not null,
	Users_idUsers INT NOT NULL,
  	Kategorien_idKategorien INT NOT NULL,

CONSTRAINT fk_ Todos_Users1
    FOREIGN KEY (Users_idUsers)
    REFERENCES todoDatabase.Users (idUsers)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
CONSTRAINT fk_ Todos_Kategorien1
    FOREIGN KEY (Kategorien_idKategorien)
    REFERENCES todoDatabase.Kategorien (idKategorien)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);

CREATE TABLE Users_has_Kategorien (
  Users_idUsers INT NOT NULL,
  Kategorien_idKategorien INT NOT NULL,
  PRIMARY KEY (Users_idUsers, Kategorien_idKategorien),
  CONSTRAINT fk_Users_has_Kategorien_Users1
    FOREIGN KEY (Users_idUsers)
    REFERENCES mydb.Users (idUsers)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Users_has_Kategorien_Kategorien1
    FOREIGN KEY (Kategorien_idKategorien)
    REFERENCES mydb.Kategorien (idKategorien)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
	);



CREATE TABLE IF NOT EXISTS Todos(
  id Todos INT NOT NULL AUTO_INCREMENT,
  prioritaet TINYINT(3) NOT NULL,
  kategorie VARCHAR(255) NOT NULL,
  aufgabe VARCHAR(45) NOT NULL,
  erstellt DATETIME NOT NULL,
  faellig DATETIME NOT NULL,
  status TINYINT(100) NOT NULL,
  archiv TINYINT(1) NOT NULL,
  Users_idUsers INT NOT NULL,
  Kategorien_idKategorien INT NOT NULL,
  PRIMARY KEY (id Todos),
  
  CONSTRAINT fk_ Todos_Users1
    FOREIGN KEY (Users_idUsers)
    REFERENCES Users (idUsers)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_ Todos_Kategorien1
    FOREIGN KEY (Kategorien_idKategorien)
    REFERENCES Kategorien (idKategorien)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);



CREATE TABLE IF NOT EXISTS todoDatabase.Users_has_Kategorien (
  Users_idUsers INT NOT NULL,
  Kategorien_idKategorien INT NOT NULL,
  PRIMARY KEY (Users_idUsers, Kategorien_idKategorien),
  CONSTRAINT fk_Users_has_Kategorien_Users1
    FOREIGN KEY (Users_idUsers)
    REFERENCES todoDatabase.Users (idUsers)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_Users_has_Kategorien_Kategorien1
    FOREIGN KEY (Kategorien_idKategorien)
    REFERENCES todoDatabase.Kategorien (idKategorien)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
	);

	CREATE USER 'Administrator'@'localhost' IDENTIFIED BY 'c2Q`(_FV9vL}Bx)d';
		GRANT ALL PRIVILEGES ON todoDatabase . * TO 'Administrator'@'localhost';
	
	CREATE USER 'Benutzer'@'localhost' IDENTIFIED BY '\(7/ep9~=?HmU8BH';
		GRANT ON todoDatabase. TO 'Benutzer'@'localhost';

    FLUSH PRIVILEGES;

    ALTER TABLE Users DROP COLUMN password;
    ALTER TABLE Users ADD COLUMN password VARCHAR(255) NOT NULL ;

    ALTER TABLE Users DROP COLUMN role;
    ALTER TABLE Users ADD COLUMN role TINYINT(1) NOT NULL;

    ALTER TABLE Users ALTER role SET DEFAULT 0;

    DELETE FROM Users;

    ALTER TABLE Todos DROP COLUMN was;

    ALTER TABLE Todos DROP COLUMN was;

    ALTER TABLE Todos ADD COLUMN aufgabe VARCHAR(45) NOT NULL; 

    Rename TABLE ' Todos' Rename 'Todos';


	ALTER TABLE Todos
MODIFY COLUMN erstellt TIMESTAMP;

ALTER TABLE Todos
MODIFY COLUMN prioritaet TINYINT(5) NOT NULL;
                        
  
UPDATE Users SET role = 1 WHERE idUsers = 12;

INSERT INTO Todos (prioritaet, kategorie, aufgabe, faellig, status, archiv, Users_idUsers, Kategorien_idKategorien) VALUES (1,'Schule', 'Socken waschen', '2022-12-17', 20, 0, 1, 1);