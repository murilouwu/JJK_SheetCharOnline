CREATE DATABASE jujurpg;
USE jujurpg;

CREATE TABLE host(
    cd INT PRIMARY KEY AUTO_INCREMENT,
    nameGame VARCHAR(200),
    nameMaster VARCHAR(200),
    pass CHAR(200),
    stDono TINYINT(1) DEFAULT 0;
    idCod CHAR(10),
    img LONGTEXT
);