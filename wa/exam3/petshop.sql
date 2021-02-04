CREATE DATABASE `Petshop`;
USE `Petshop`;
CREATE TABLE `Pets`(
    `ID` INT NOT NULL AUTO_INCREMENT,
    `Age` INT,
    `NAME` VARCHAR(50),
    `Type` VARCHAR(50),
    `Race` VARCHAR(50),
    `Desc` VARCHAR(50),
PRIMARY KEY (`ID`)
)ENGINE=InnoDB;
CREATE TABLE `Users`(
    `ID` INT NOT NULL AUTO_INCREMENT,
    `Age` INT,
    `Name` VARCHAR(50),
    `Tel` VARCHAR(10),
    `City` VARCHAR(50),
    `Mail` VARCHAR(50),
    `Genre` VARCHAR(1),
    PRIMARY KEY(`ID`)
)ENGINE=InnoDB;
CREATE TABLE `Users_has_Pets`(
    `Users_ID` INT NOT NULL,
    `Pets_ID` INT NOT NULL,
    PRIMARY KEY (`Users_ID`, `Pets_ID`),
    FOREIGN KEY (`Users_ID`) REFERENCES `Users` (`ID`),
    FOREIGN KEY (`Pets_ID`) REFERENCES `Pets` (`ID`)
)ENGINE=InnoDB;
