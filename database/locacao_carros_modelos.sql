-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: locacao
-- ------------------------------------------------------
-- Server version	8.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carros_modelos`
--

DROP TABLE IF EXISTS `carros_modelos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carros_modelos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `categoria_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  KEY `fk_modelos_categorias` (`categoria_id`),
  CONSTRAINT `fk_modelos_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carros_modelos`
--

LOCK TABLES `carros_modelos` WRITE;
/*!40000 ALTER TABLE `carros_modelos` DISABLE KEYS */;
INSERT INTO `carros_modelos` VALUES (1,'Volkswagen Gol','Carro compacto da Volkswagen, conhecido por sua durabilidade e economia.',1),(2,'Chevrolet Onix','Modelo popular da Chevrolet, com boa relação custo-benefício.',1),(3,'Fiat Uno','Carro urbano da Fiat, compacto e versátil.',1),(4,'Ford Ka','Compacto da Ford, conhecido por sua dirigibilidade e economia.',1),(5,'Honda Civic','Sedan médio da Honda, reconhecido por seu conforto e desempenho.',2),(6,'Toyota Corolla','Carro líder de vendas da Toyota, conhecido por sua confiabilidade.',2),(7,'Hyundai HB20','Modelo popular da Hyundai, com design moderno e bom espaço interno.',1),(8,'Nissan Kicks','SUV compacto da Nissan, com estilo arrojado e boa dirigibilidade.',3),(9,'Jeep Renegade','SUV compacto da Jeep, com boa capacidade off-road.',3),(10,'Hyundai Creta','SUV compacto da Hyundai, com amplo espaço interno e conforto.',3);
/*!40000 ALTER TABLE `carros_modelos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-27 17:08:15
