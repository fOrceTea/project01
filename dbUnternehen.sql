drop database if exists dbUnternehmen;
create database dbUnternehmen;
use dbUnternehmen;

CREATE TABLE tblMitarbeiter (
    mbID INT auto_increment primary key,
    mbName VARCHAR(255) NOT NULL
);

INSERT INTO tblMitarbeiter(mbName) VALUES
    ('Mitarbeiter_1'),
    ('Mitarbeiter_2'),
    ('Mitarbeiter_3'),
    ('Mitarbeiter_4');


CREATE TABLE tblKunden (
    kdnID INT auto_increment primary key,
    kndName VARCHAR(255) NOT NULL
);

INSERT INTO tblKunden(kndName) VALUES
    ('Kunde_1'),
    ('Kunde_2'),
    ('Kunde_3'),
    ('Kunde_4');


CREATE TABLE tblProjekte (
    projektID INT auto_increment primary key,
    projektKndFID INT,
    projektName VARCHAR(255) NOT NULL,
    FOREIGN KEY (projektKndFID) REFERENCES tblKunden(kdnID)
);

INSERT INTO tblProjekte(projektKndFID, projektName) VALUES
    (1, 'Projektname_1'),
    (1, 'Projektname_2'),
    (2, 'Projektname_3'),
    (2, 'Projektname_4'),
    (3, 'Projektname_5'),
    (3, 'Projektname_6'),
    (4, 'Projektname_7'),
    (4, 'Projektname_8');


CREATE TABLE tblStunden (
    stndnID INT auto_increment primary key,
    stndnMbFID INT,
    stndnProjektFID INT,
    stndnStart datetime NOT NULL,
	stndnEnd datetime NOT NULL,
    FOREIGN KEY (stndnMbFID) REFERENCES tblMitarbeiter(mbID),
    FOREIGN KEY (stndnProjektFID) REFERENCES tblProjekte(projektID)
);

INSERT INTO tblStunden(stndnMbFID, stndnProjektFID, stndnStart, stndnEnd) VALUES
    (1, 1, '2024-02-02 09:00:00', '2024-02-02 10:00:00'),
    (1, 2, '2024-02-02 10:00:00', '2024-02-02 11:00:00'),
    (1, 3, '2024-02-02 14:00:00', '2024-02-02 15:00:00'),
    (2, 3, '2024-02-03 09:00:00', '2024-02-03 14:00:00'),
    (2, 4, '2024-02-03 09:00:00', '2024-02-03 12:00:00'),
    (4, 4, '2024-02-04 10:00:00', '2024-02-04 16:00:00'),
    (4, 1, '2024-02-04 09:00:00', '2024-02-04 18:00:00');


