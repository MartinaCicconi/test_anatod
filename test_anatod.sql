/*
 Navicat MySQL Data Transfer

 Source Server         : anatod_test
 Source Server Type    : MySQL
 Source Server Version : 80021
 Source Host           : anatod-test.c75o4mima6rb.us-east-1.rds.amazonaws.com:3306
 Source Schema         : test_anatod

 Target Server Type    : MySQL
 Target Server Version : 80021
 File Encoding         : 65001

 Date: 26/01/2021 11:47:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for clientes
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `cliente_id` int NOT NULL AUTO_INCREMENT,
  `cliente_nombre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cliente_dni` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cliente_localidad` int NOT NULL,
  PRIMARY KEY (`cliente_id`),
  UNIQUE KEY `cliente_dni` (`cliente_dni`),
  KEY `cliente_localidad` (`cliente_localidad`),
  CONSTRAINT `cliente_localidad` FOREIGN KEY (`cliente_localidad`) REFERENCES `localidades` (`localidad_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of clientes
-- ----------------------------
BEGIN;
INSERT INTO `clientes` VALUES (28, 'Oren', '41600448', 4);
INSERT INTO `clientes` VALUES (85, 'Juancito', '33344455', 2);
INSERT INTO `clientes` VALUES (89, 'Juanita', '40403030', 4);
INSERT INTO `clientes` VALUES (100, 'Roman', '3948374', 3);
INSERT INTO `clientes` VALUES (101, 'Martin', '88559944', 2);
INSERT INTO `clientes` VALUES (107, 'Julian', '30483555', 2);
INSERT INTO `clientes` VALUES (111, 'AAAAAAAA', '3232', 4);
INSERT INTO `clientes` VALUES (115, 'Test', '123456789', 3);
INSERT INTO `clientes` VALUES (117, 'Marito', '123', 2);
INSERT INTO `clientes` VALUES (118, 'ariel', '124578', 4);
COMMIT;

-- ----------------------------
-- Table structure for localidades
-- ----------------------------
DROP TABLE IF EXISTS `localidades`;
CREATE TABLE `localidades` (
  `localidad_id` int NOT NULL AUTO_INCREMENT,
  `localidad_nombre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `localidad_provincia` int NOT NULL,
  PRIMARY KEY (`localidad_id`),
  KEY `localidad_provincia` (`localidad_provincia`),
  CONSTRAINT `localidad_provincia` FOREIGN KEY (`localidad_provincia`) REFERENCES `provincias` (`provincia_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of localidades
-- ----------------------------
BEGIN;
INSERT INTO `localidades` VALUES (1, 'Localidad 1', 1);
INSERT INTO `localidades` VALUES (2, 'Bahia Blanca', 2);
INSERT INTO `localidades` VALUES (3, 'Monte Hermoso', 2);
INSERT INTO `localidades` VALUES (4, 'Bariloche', 3);
COMMIT;

-- ----------------------------
-- Table structure for provincias
-- ----------------------------
DROP TABLE IF EXISTS `provincias`;
CREATE TABLE `provincias` (
  `provincia_id` int NOT NULL AUTO_INCREMENT,
  `provincia_nombre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`provincia_id`),
  UNIQUE KEY `provincia_nombre` (`provincia_nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of provincias
-- ----------------------------
BEGIN;
INSERT INTO `provincias` VALUES (2, 'Buenos Aires');
INSERT INTO `provincias` VALUES (1, 'Provincia 1');
INSERT INTO `provincias` VALUES (3, 'Rio Negro');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
