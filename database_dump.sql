CREATE DATABASE  IF NOT EXISTS `urlshortsdb`;
USE `urlshortsdb`;
-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: localhost    Database: urlshortsdb
-- ------------------------------------------------------
-- Server version	8.0.19
--
-- Table structure for table `urls`
--

DROP TABLE IF EXISTS `urls`;
CREATE TABLE `urls` (
  `id` int NOT NULL AUTO_INCREMENT,
  `longUrl` varchar(400) NOT NULL,
  `shortUrl` varchar(45) NOT NULL,
  `hits` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
);

DELIMITER ;;
CREATE FUNCTION `fn_GetShortUrl`(p_url VARCHAR(200)) RETURNS char(6) 
    NO SQL
BEGIN
	SET @shortUrl = LEFT(MD5(p_url), 6);
RETURN @shortUrl;
END ;;
DELIMITER ;

DELIMITER ;;
CREATE PROCEDURE `sp_addShortUrl`(IN p_longUrl VARCHAR(200))
BEGIN

	/* Check if the longURL is already in the database */
	IF (NOT EXISTS(SELECT NULL FROM urls WHERE longUrl = p_longUrl)) THEN
		BEGIN
			/* Proceed with the INSERT */
			INSERT INTO urls(longUrl, shortUrl, created_at, updated_at) 
            VALUES(
				p_longUrl
                , fn_GetShortUrl(p_longUrl) /* Generates the short URL */
                , CURRENT_TIMESTAMP
                , CURRENT_TIMESTAMP);
		END;
	ELSE
		BEGIN
			/* If the longUrl is already in the database just update the date */
			UPDATE urls SET updated_at = current_timestamp() WHERE longUrl = p_longUrl;
        END;
    END IF;
    
    /* Returns data to the caller */
    SELECT shortUrl, longUrl, hits, created_at, updated_at FROM urls WHERE longUrl = p_longUrl;
    
END ;;
DELIMITER ;
-- Dump completed on 2021-01-14 19:20:51
