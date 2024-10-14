
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `dosages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dosages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dosage` varchar(255) NOT NULL COMMENT 'Дозировка',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `dosages` WRITE;
/*!40000 ALTER TABLE `dosages` DISABLE KEYS */;
INSERT INTO `dosages` VALUES (1,'10 г'),(2,'20 г'),(3,'100 г'),(4,'200 г'),(5,'400 г'),(6,'10 мл'),(7,'50 мл'),(8,'75 мл'),(9,'100 мл'),(10,'250 мл');
/*!40000 ALTER TABLE `dosages` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL COMMENT 'id заказа',
  `order_product_id` int DEFAULT NULL COMMENT 'id продукта',
  `quantity` int DEFAULT NULL COMMENT 'Количество товара',
  PRIMARY KEY (`id`),
  KEY `order_items_orders_id_fk` (`order_id`),
  KEY `order_items_products_id_fk` (`order_product_id`),
  CONSTRAINT `order_items_orders_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_items_products_id_fk` FOREIGN KEY (`order_product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,1,1),(2,2,2,2),(3,3,3,12),(4,4,4,32),(5,5,5,15),(6,6,6,23),(7,7,7,18),(8,8,8,89),(9,9,9,54),(10,10,10,2);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user_id` int DEFAULT NULL COMMENT 'id пользователя',
  `date` date NOT NULL COMMENT 'Дата заказа',
  PRIMARY KEY (`id`),
  KEY `orders_users_id_fk` (`user_id`),
  CONSTRAINT `orders_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,'2024-04-19'),(2,2,'2024-05-19'),(3,3,'2024-06-19'),(4,4,'2023-01-25'),(5,5,'2024-03-26'),(6,6,'2024-08-12'),(7,7,'2023-06-15'),(8,8,'2024-09-12'),(9,9,'2024-02-10'),(10,10,'2024-05-01');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `pharmacies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pharmacies` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) NOT NULL COMMENT 'Название аптеки',
  `address` varchar(255) NOT NULL COMMENT 'Адрес аптеки',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `pharmacies` WRITE;
/*!40000 ALTER TABLE `pharmacies` DISABLE KEYS */;
INSERT INTO `pharmacies` VALUES (1,'Здоровье','ул. Колотушкина 25'),(2,'Аптека','ул. Пушкина 15'),(3,'АптекаЗдоровья','ул. Советская 87'),(4,'БережнаяАптека','ул. Революции 77'),(5,'ФармЗдоровья','ул. Ключникова 66'),(6,'ФармАптека','ул. Забавная 42'),(7,'ФармОпт','ул. Весельчаков 2'),(8,'АптекаФармо','ул. Коновалова 42'),(9,'ФармоАптЗдоровья','ул. Загрядная 55'),(10,'ЛайфФарм','ул. Константинова 21');
/*!40000 ALTER TABLE `pharmacies` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT 'Торговое название',
  `name_world` varchar(255) NOT NULL COMMENT 'Международное название',
  `indications_id` int NOT NULL COMMENT 'id показания к применению',
  `form_id` int DEFAULT NULL COMMENT 'id формы выпуска',
  `dosage_id` int DEFAULT NULL COMMENT 'id дозировки',
  `price` int DEFAULT NULL COMMENT 'Цена',
  PRIMARY KEY (`id`),
  KEY `products_dosages_id_fk` (`dosage_id`),
  KEY `products_use_reccommendation_id_fk` (`indications_id`),
  KEY `products_releases_id_fk` (`form_id`),
  CONSTRAINT `products_dosages_id_fk` FOREIGN KEY (`dosage_id`) REFERENCES `dosages` (`id`),
  CONSTRAINT `products_releases_id_fk` FOREIGN KEY (`form_id`) REFERENCES `releases` (`id`),
  CONSTRAINT `products_use_reccommendation_id_fk` FOREIGN KEY (`indications_id`) REFERENCES `uses_reccommend` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Парацетамол','paratsetamol',1,2,3,150),(2,'Бромгексин','bromgeksin',9,4,3,215),(3,'Коделак','kodelak',8,4,4,654),(4,'Супрастин','suprastin',9,2,3,234),(5,'Кеторол','ketorol',1,2,2,765),(6,'Ибупрофен','ibuprofen',8,2,5,2345),(7,'Омез','omez',9,2,6,123),(8,'Парацетамол','paratsetamol',2,4,7,797),(9,'Лазолван','lazolvan',3,2,10,564),(10,'Терафлю','teraflu',2,4,7,896);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `release_forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `release_forms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_release` varchar(255) NOT NULL COMMENT 'Форма выпуска',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `release_forms` WRITE;
/*!40000 ALTER TABLE `release_forms` DISABLE KEYS */;
INSERT INTO `release_forms` VALUES (1,'Мазь'),(2,'Таблетки'),(3,'Сироп'),(4,'Спрей');
/*!40000 ALTER TABLE `release_forms` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `releases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `releases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `release_form_id` int NOT NULL,
  `dosage_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `releases_release_forms_id_fk` (`release_form_id`),
  KEY `releases_products_dosage_id_fk` (`dosage_id`),
  CONSTRAINT `product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `releases_products_dosage_id_fk` FOREIGN KEY (`dosage_id`) REFERENCES `products` (`dosage_id`),
  CONSTRAINT `releases_release_forms_id_fk` FOREIGN KEY (`release_form_id`) REFERENCES `release_forms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `releases` WRITE;
/*!40000 ALTER TABLE `releases` DISABLE KEYS */;
INSERT INTO `releases` VALUES (1,1,2,NULL),(2,2,2,NULL),(3,3,3,NULL),(4,4,4,NULL),(5,5,1,NULL),(6,6,2,NULL),(7,7,3,NULL),(8,8,4,NULL),(9,9,1,NULL),(10,10,2,NULL);
/*!40000 ALTER TABLE `releases` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stocks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` int DEFAULT NULL COMMENT 'Название препарата',
  `name_pharmacy` int DEFAULT NULL COMMENT 'Название аптеки',
  `quantity` int NOT NULL COMMENT 'Остаток товаров в аптеке',
  PRIMARY KEY (`id`),
  KEY `stocks_products_id_fk` (`name`),
  KEY `stocks_pharmacies_id_fk` (`name_pharmacy`),
  CONSTRAINT `stocks_pharmacies_id_fk` FOREIGN KEY (`name_pharmacy`) REFERENCES `pharmacies` (`id`),
  CONSTRAINT `stocks_products_id_fk` FOREIGN KEY (`name`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` VALUES (1,1,1,125),(2,2,2,54),(3,3,3,654),(4,4,4,435),(5,5,5,234),(6,6,6,987),(7,7,7,234),(8,8,8,4321),(9,9,9,565),(10,10,10,974);
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fio` varchar(255) NOT NULL COMMENT 'Имя пользователя',
  `email` varchar(255) NOT NULL COMMENT 'Почта',
  `password` varchar(40) DEFAULT NULL COMMENT 'Пароль',
  `role` int NOT NULL COMMENT 'Роль',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Пользователи';
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Петров Петр Петрович','petr@mail.com','65364',0),(2,'Иванов Иван Иванович','ivanov@mail.ru','65434',0),(3,'Кузнецов Игорь Михайлович','kuznetstov@mail.ru','7856',0),(4,'Иванов Алексей Игоревич','ivaleks@mail.ru','2345',0),(5,'Захаров Андрей Алексеевич','zaharov@mail.ru','8756678',0),(6,'Петров Алексей Андреевич','petaleks@mail.ru','235434',0),(7,'Сушков Владимир Александрович','suschkov@mail.ru','986978',0),(8,'Ижболдин Висимир Всеволодович','iznbld@mail.ru','234534',0),(9,'Скворцов Михаил Валентинович','skvar@mail.ru','76547',0),(10,'Воеводин Дмитрий Иванович','voevod@mail.ru','hgfgh',0),(11,'123','123@m.ru','123',1),(16,'21','464@ma.ru','21',1),(17,'564','564@ma.ru','564',1),(18,'123','123@m.ru','123',1),(19,'123','123@m.ru','123',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `uses_reccommend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uses_reccommend` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reccomend_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uses_reccommend_products_id_fk` (`product_id`),
  KEY `uses_reccommend_using_reccomendations_id_fk` (`reccomend_id`),
  CONSTRAINT `uses_reccommend_products_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `uses_reccommend_using_reccomendations_id_fk` FOREIGN KEY (`reccomend_id`) REFERENCES `using_reccomends` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `uses_reccommend` WRITE;
/*!40000 ALTER TABLE `uses_reccommend` DISABLE KEYS */;
INSERT INTO `uses_reccommend` VALUES (1,1,1),(2,2,2),(3,3,3),(4,4,4),(5,5,5),(6,6,6),(7,7,7),(8,8,8),(9,9,9),(10,10,10);
/*!40000 ALTER TABLE `uses_reccommend` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `using_reccomends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `using_reccomends` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_reccommendation` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Показания к применению';
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `using_reccomends` WRITE;
/*!40000 ALTER TABLE `using_reccomends` DISABLE KEYS */;
INSERT INTO `using_reccomends` VALUES (1,'Обезболивающее'),(2,'Метаболики'),(3,'Противовирусное'),(4,'Противовоспалительное'),(5,'Гормональное'),(6,'Противозачаточное'),(7,'Противогрибковые'),(8,'Антибиотики'),(9,'Антибактериальные'),(10,'Противоопухолевые');
/*!40000 ALTER TABLE `using_reccomends` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

