drop database if exists dbUnternehmen;
create database dbUnternehmen;
use dbUnternehmen;

CREATE TABLE tblMitarbeiter (
    mbID INT auto_increment primary key,
    mbVorname VARCHAR(255) NOT NULL,
    mbNachname VARCHAR(255) NOT NULL
);

CREATE TABLE tblKunden (
    kdnID INT auto_increment primary key,
    kndName VARCHAR(255) NOT NULL,
    kndStrasse VARCHAR(255) NOT NULL,
    kndPlz VARCHAR(255) NOT NULL,
    kndOrt VARCHAR(255) NOT NULL
);

CREATE TABLE tblProjekte (
    projektID INT auto_increment primary key,
    projektKndFID INT,
    projektName VARCHAR(255) NOT NULL,
    FOREIGN KEY (projektKndFID) REFERENCES tblKunden(kdnID)
);

CREATE TABLE tblStunden (
    stndnID INT auto_increment primary key,
    stndnMbFID INT,
    stndnProjektFID INT,
    stndnStart datetime NOT NULL,
	stndnEnd datetime NOT NULL,
    FOREIGN KEY (stndnMbFID) REFERENCES tblMitarbeiter(mbID),
    FOREIGN KEY (stndnProjektFID) REFERENCES tblProjekte(projektID)
);

