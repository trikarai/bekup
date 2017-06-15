-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 22, 2017 at 08:02 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bekup`
--

-- --------------------------------------------------------

--
-- Table structure for table `bkp_city`
--

CREATE TABLE IF NOT EXISTS `bkp_city` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `is_removed` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_city`
--

INSERT INTO `bkp_city` (`id`, `is_removed`, `name`) VALUES
('00606344-44b3-4273-a9dc-7a8d8a5b227d', 0, 'Yogyakarta'),
('0536c23e-ad52-4af1-905b-3afa36d8b44f', 0, 'Solo'),
('0d710175-18f4-4fd8-963a-2ddfa98fe7dc', 1, 'Malangbong'),
('218a8d54-02f3-11e7-8256-001851f9fd39', 1, 'Bandungx'),
('39779b48-7e10-4a41-9281-9ebb48eefa75', 0, 'Surabaya'),
('3a636558-3c4f-453e-bc57-144a54c21e0f', 0, 'Makassar'),
('3bf531e8-fe98-4403-8eb5-a2c78d2ad103', 0, 'Denpasar'),
('49a94e7d-0ddc-4528-af39-27fcec8ca67b', 1, 'Malang 2'),
('4a36228d-ede2-4492-ae9c-db98c5a566ee', 1, 'Malangbong'),
('52f3c9f7-e69f-403b-8cbd-4fd527490606', 0, 'Tangerang'),
('57153ce1-0133-4a1c-bd73-8e3e3c32952c', 0, 'Depok'),
('590ecb8d-46dd-4dd4-b5d4-c020f2761955', 0, 'Malang'),
('5ecaed53-65f1-427a-b198-136800e07e7d', 0, 'Banda Aceh'),
('71f7dc85-3277-4b5d-8eee-dde8912e6ad5', 0, 'Bogor'),
('7601a7d6-74f4-4733-b192-cce6814911b8', 0, 'Bekasi'),
('806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, 'Baracity'),
('8c1bca99-0fdd-4499-80af-8c457532015f', 0, 'Tangerang'),
('986e18bf-5a94-44ed-881c-73ca91473a22', 0, 'Bandung'),
('9d5ebadb-c102-42d8-a8b1-d5059b70799b', 0, 'Pekanbaru'),
('9e9ae34e-e24e-4b39-b3a8-844416c8c64e', 0, 'Balikpapan'),
('c505407b-40e2-41f4-a31d-7685c3dd1e1f', 0, 'Medan'),
('f14b35a2-02f2-11e7-8256-001851f9fd39', 1, 'cimahi 2');

-- --------------------------------------------------------

--
-- Table structure for table `bkp_city_class`
--

CREATE TABLE IF NOT EXISTS `bkp_city_class` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `course_class_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `city_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `is_removed` tinyint(1) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_city_class`
--

INSERT INTO `bkp_city_class` (`id`, `course_class_id`, `city_id`, `is_removed`, `type`) VALUES
('5508de40-1bea-4b4d-8297-f4cf875e7c25', '235ca7a8-c024-4dea-b873-389b848725b4', '8c1bca99-0fdd-4499-80af-8c457532015f', 0, 'online'),
('5fbeb875-e888-4937-9429-55623c4ff5c1', '235ca7a8-c024-4dea-b873-389b848725b4', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, 'online'),
('6b9cd5cc-2a86-441e-b982-7dbce71c3f5e', '0e76a514-35c9-45d8-b30e-fe23378439e4', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, 'online'),
('789c0858-a875-41bc-94d5-57db9221fff8', '93849a9b-d00a-4a00-a4a9-c597775120b0', '8c1bca99-0fdd-4499-80af-8c457532015f', 0, 'online'),
('95ff3315-4f31-4dd2-b90c-dada6b9d1fec', '0e76a514-35c9-45d8-b30e-fe23378439e4', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0, 'online'),
('a929799a-032c-4a5a-ac99-5000585e8152', '93849a9b-d00a-4a00-a4a9-c597775120b0', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0, 'online'),
('af32478b-b3c8-4d74-b6af-d7ae4426dee2', '93849a9b-d00a-4a00-a4a9-c597775120b0', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, 'online'),
('dd86021c-1b51-4ca7-b564-4f2a6d064055', '0e76a514-35c9-45d8-b30e-fe23378439e4', '8c1bca99-0fdd-4499-80af-8c457532015f', 0, 'online'),
('e1684bfc-e53d-48b0-a515-5328ea7ac0e9', '235ca7a8-c024-4dea-b873-389b848725b4', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0, 'online');

-- --------------------------------------------------------

--
-- Table structure for table `bkp_city_course_talent`
--

CREATE TABLE IF NOT EXISTS `bkp_city_course_talent` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `city_course_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `talent_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bkp_city_team_class`
--

CREATE TABLE IF NOT EXISTS `bkp_city_team_class` (
  `id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `team_class_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `is_removed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bkp_city_team_class`
--

INSERT INTO `bkp_city_team_class` (`id`, `team_class_id`, `city_id`, `is_removed`) VALUES
('07be8692-ef4c-435a-97c7-804e4f0a468f', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '71f7dc85-3277-4b5d-8eee-dde8912e6ad5', 0),
('0bc1a286-a5c7-4ad6-8f3f-e37fe17c8e69', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '39779b48-7e10-4a41-9281-9ebb48eefa75', 0),
('11a3d43d-657c-43fd-8c32-214b532714cf', '73822320-7471-4aa4-bbeb-6554d695a69c', '39779b48-7e10-4a41-9281-9ebb48eefa75', 0),
('12345b1c-79c4-4a71-b3e2-014328f6336c', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '00606344-44b3-4273-a9dc-7a8d8a5b227d', 0),
('162aa0ee-3d6e-4d39-b078-5416bf9dadf1', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '0536c23e-ad52-4af1-905b-3afa36d8b44f', 0),
('20fe8874-a166-4315-88a5-b14267a524da', '73822320-7471-4aa4-bbeb-6554d695a69c', '7601a7d6-74f4-4733-b192-cce6814911b8', 0),
('351d1c1d-0b8d-4ee9-8704-4671583a3c3e', '73822320-7471-4aa4-bbeb-6554d695a69c', '8c1bca99-0fdd-4499-80af-8c457532015f', 0),
('3f9a604f-0537-4c9c-b70b-b592f0ba5b61', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '7601a7d6-74f4-4733-b192-cce6814911b8', 0),
('4185d3a3-ea24-4e0b-88b8-a5cbb95d4da3', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '3a636558-3c4f-453e-bc57-144a54c21e0f', 0),
('41e1bad9-6897-4c88-9698-637ecfa0fd07', '73822320-7471-4aa4-bbeb-6554d695a69c', '71f7dc85-3277-4b5d-8eee-dde8912e6ad5', 0),
('4290d1dd-aa2e-481d-be0b-ce56139916ec', '73822320-7471-4aa4-bbeb-6554d695a69c', '3bf531e8-fe98-4403-8eb5-a2c78d2ad103', 0),
('42f8543b-5916-42b0-8279-9fbdcadb8955', '73822320-7471-4aa4-bbeb-6554d695a69c', '9e9ae34e-e24e-4b39-b3a8-844416c8c64e', 0),
('51a8db68-97a2-49c2-86c5-acad2d3b0ea3', '73822320-7471-4aa4-bbeb-6554d695a69c', '590ecb8d-46dd-4dd4-b5d4-c020f2761955', 0),
('6b71b764-fc3b-4c69-99be-f1495f4f92d3', '73822320-7471-4aa4-bbeb-6554d695a69c', '986e18bf-5a94-44ed-881c-73ca91473a22', 0),
('710064c2-1043-4e25-8703-44ea0708138a', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '986e18bf-5a94-44ed-881c-73ca91473a22', 0),
('85f7d9ba-782d-4318-a719-0fe44ec9fb29', '73822320-7471-4aa4-bbeb-6554d695a69c', '52f3c9f7-e69f-403b-8cbd-4fd527490606', 0),
('882c6836-dd85-4305-ae5a-3f31ab591521', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '52f3c9f7-e69f-403b-8cbd-4fd527490606', 0),
('8f3315ab-71d7-4638-b642-1edf0c743ffd', '73822320-7471-4aa4-bbeb-6554d695a69c', 'c505407b-40e2-41f4-a31d-7685c3dd1e1f', 0),
('95a206ef-c662-4fc7-a91b-2ae74ad3ccc5', '73822320-7471-4aa4-bbeb-6554d695a69c', '9d5ebadb-c102-42d8-a8b1-d5059b70799b', 0),
('979a9870-7e70-409a-8428-e6dbcb4f1dde', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '3bf531e8-fe98-4403-8eb5-a2c78d2ad103', 0),
('a8d83149-6e35-47b7-97fb-bdca5635d99e', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '9e9ae34e-e24e-4b39-b3a8-844416c8c64e', 0),
('b52dcbef-8f2f-48ff-a8f9-9fa2d6f9d177', '73822320-7471-4aa4-bbeb-6554d695a69c', '00606344-44b3-4273-a9dc-7a8d8a5b227d', 0),
('bba49665-04dc-4945-89da-aaab8c4c4e3c', '73822320-7471-4aa4-bbeb-6554d695a69c', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('bd805338-704d-4461-8181-d398d24d1b6c', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '5ecaed53-65f1-427a-b198-136800e07e7d', 0),
('be619363-2218-43a0-a3a5-15f61aa92da2', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '57153ce1-0133-4a1c-bd73-8e3e3c32952c', 0),
('cc23ef51-3413-4b4c-ac80-4a152f292829', '73822320-7471-4aa4-bbeb-6554d695a69c', '57153ce1-0133-4a1c-bd73-8e3e3c32952c', 0),
('ce9be264-4bdd-4ed7-8368-31cf7dffecdd', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', 'c505407b-40e2-41f4-a31d-7685c3dd1e1f', 0),
('d4660299-a3e9-40d5-874e-7ac2a31de865', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '9d5ebadb-c102-42d8-a8b1-d5059b70799b', 0),
('d4ccce8a-398c-429a-a020-77efa258992f', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('ecbdad4e-72d1-4dfb-858b-9762cd1cb901', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '8c1bca99-0fdd-4499-80af-8c457532015f', 0),
('ed00dcbe-c753-4810-95bb-c60443f417e7', 'b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', '590ecb8d-46dd-4dd4-b5d4-c020f2761955', 0),
('f0a64297-3fe8-4cf9-a62f-ba9697d827a1', '73822320-7471-4aa4-bbeb-6554d695a69c', '5ecaed53-65f1-427a-b198-136800e07e7d', 0),
('fc7e6cc6-2156-4d9e-bc37-43321b528b69', '73822320-7471-4aa4-bbeb-6554d695a69c', '3a636558-3c4f-453e-bc57-144a54c21e0f', 0),
('fea359b7-e85b-4a19-8bd6-26a8e0f415e8', '73822320-7471-4aa4-bbeb-6554d695a69c', '0536c23e-ad52-4af1-905b-3afa36d8b44f', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bkp_class_student`
--

CREATE TABLE IF NOT EXISTS `bkp_class_student` (
  `id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `status` char(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `talent_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `city_class_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bkp_class_student`
--

INSERT INTO `bkp_class_student` (`id`, `status`, `talent_id`, `city_class_id`) VALUES
('0755c782-ba05-45c1-90d6-f9f808289694', 'canceled', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '6b9cd5cc-2a86-441e-b982-7dbce71c3f5e'),
('221089fb-5841-4321-b93a-674a7903e07a', 'canceled', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'af32478b-b3c8-4d74-b6af-d7ae4426dee2'),
('e98834b3-d6e8-4ebe-9320-39e9b89c04d2', 'canceled', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '5fbeb875-e888-4937-9429-55623c4ff5c1');

-- --------------------------------------------------------

--
-- Table structure for table `bkp_course`
--

CREATE TABLE IF NOT EXISTS `bkp_course` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `track_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `is_removed` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_course`
--

INSERT INTO `bkp_course` (`id`, `track_id`, `is_removed`, `name`) VALUES
('2569c70d-955c-4a06-8384-452c33fddf7d', '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', 1, 'aaaa'),
('33a5eff6-fa21-4b77-8da0-6cb73cfc781d', '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', 1, 'asasa 2'),
('34d39770-545f-4adf-9c1e-6623912a18d6', '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', 1, 'hghg'),
('44da5498-1ca5-48f8-ae3b-c0eeb15dfe88', '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', 1, 'Test Subject'),
('602334c9-4e20-433f-a3d0-34b240615120', '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', 0, 'sasasa'),
('bc69cd05-b891-43a0-a7b7-ea4531c57ea9', '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', 1, 'ewew 2'),
('c607a649-74fa-44c8-88ee-722868546e2e', '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', 0, 'Subject 3'),
('d73c96e6-8143-4064-b3dd-eeb0e7b4fcb9', '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', 1, 'ssd'),
('dc256d23-7e28-4db5-bc78-43e2283f9b87', '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', 1, 'hs');

-- --------------------------------------------------------

--
-- Table structure for table `bkp_course_class`
--

CREATE TABLE IF NOT EXISTS `bkp_course_class` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `course_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `is_removed` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `operation_start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `operation_end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registration_start_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registration_end_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_course_class`
--

INSERT INTO `bkp_course_class` (`id`, `course_id`, `is_removed`, `name`, `operation_start_date`, `operation_end_date`, `registration_start_date`, `registration_end_date`) VALUES
('0e76a514-35c9-45d8-b30e-fe23378439e4', 'c607a649-74fa-44c8-88ee-722868546e2e', 0, '2132313123123', '2017-03-16', '2017-03-30', '2017-03-01', '2017-03-04'),
('235ca7a8-c024-4dea-b873-389b848725b4', 'c607a649-74fa-44c8-88ee-722868546e2e', 0, 'Course 2', '2017-03-22', '2017-03-22', '2017-03-15', '2017-03-16'),
('93849a9b-d00a-4a00-a4a9-c597775120b0', 'c607a649-74fa-44c8-88ee-722868546e2e', 1, 'asdfasfasdfasf', '2017-03-17', '2017-03-30', '2017-03-01', '2017-03-04'),
('a26ff5c7-b780-4cbc-955c-66caf9099c27', 'c607a649-74fa-44c8-88ee-722868546e2e', 1, 'sdfasdfsdf', '2017-03-10', '2017-03-24', '2017-03-02', '2017-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `bkp_personnel`
--

CREATE TABLE IF NOT EXISTS `bkp_personnel` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `is_removed` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `track_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_personnel`
--

INSERT INTO `bkp_personnel` (`id`, `is_removed`, `name`, `email`, `password`, `role_name`, `city_id`, `track_id`) VALUES
('471e1cb9-2c63-4847-9ea4-df006fefd17c', 0, 'indra', 'indra@mikti.org', '$2a$10$72GpT4m7hWQQft/MtcxExeV.2q5004hSpfYcbxN9n8blywzHtZ3gy', 'Direktur', NULL, NULL),
('7059ba81-d4e8-4c03-bc92-01114e5c2a68', 0, 'Tri Sutrisno', 'mas.trisutrisno@gmail.com', '$2a$10$aJG7INEiFSo1yv81orWdkO0Pz.imVOgUDGm7D3VeS1ZOOEvsz/SYu', 'Koordinator Track', NULL, '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc'),
('712d9d18-bd43-488b-bda4-81420f1005e9', 0, 'sasasa', 'admin@admin.com', '$2a$10$SbEbz1M2DfGnVQcSErFd3e.GipGvg3pUcbG2jvALgg7tjwLppEXei', 'Direktur', NULL, NULL),
('917a6db6-db55-4c2d-89d1-155c2d1de625', 0, 'dedeh aip', 'arief@barapraja.com', '$2a$10$T2wu.Oikp1/PnhAMCEetbu1Q.zBF.Uu9IdCNZv/YFIEzyC/KjMZmC', 'Tutor', '806b2600-82e0-4b9a-9d62-3cd52b32723a', '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc'),
('f3e9f674-c98d-4db1-918c-1f30a465d283', 0, 'Tri Sutrisno', 'tri@barapraja.com', '$2a$10$iZ8NElAVyoOpZiQW.UuYzepAzC5A4.fjbc0jH2gevZCyu4bFZQsyO', 'Koordinator Wilayah', '806b2600-82e0-4b9a-9d62-3cd52b32723a', NULL),
('fa3fc850-834e-4811-a500-84383377efdc', 0, 'Indro Purnama', 'indra@barapraja.com', '$2a$10$efVES99F8M83sSP2Fq0EleZB9CogNtL6D..behiOOQW6wIPlZ6fV2', 'Direktur', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bkp_skill`
--

CREATE TABLE IF NOT EXISTS `bkp_skill` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_skill`
--

INSERT INTO `bkp_skill` (`id`, `name`, `type`, `is_removed`) VALUES
('6538d0cb-9119-4d4a-9745-d0bc98d1ec19', 'Android', 'Technical', 0),
('f465ec72-35f5-43f6-b6d6-d26fa678e5fc', 'Adobe Photoshop', 'Design', 1),
('153ff68d-72ab-490c-9a6c-194eb57e8918', 'Adobe Photoshop', 'Design', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent`
--

CREATE TABLE IF NOT EXISTS `bkp_talent` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `dilo_id` int(11) NOT NULL,
  `track_id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `city_of_origin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_talent`
--

INSERT INTO `bkp_talent` (`id`, `name`, `username`, `email`, `password`, `phone`, `birth_date`, `city_id`, `dilo_id`, `track_id`, `city_of_origin`) VALUES
('076ff717-3f44-4e71-a1a9-c8fb494daba3', 'Danni Yoga Pratama', 'dannpa0', 'yogadanni0@gmail.com', '$2a$10$rXiYZmOi0ZMVYYmqJFb56u2owzM83M3t8JBIX.PP2McO5sNqpnhpG', '083877667813', '2017-03-23', '57153ce1-0133-4a1c-bd73-8e3e3c32952c', 0, '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 'Jakarta'),
('1056a314-aa90-4480-b9a7-b1b11a6c95ed', 'Muhammad Hasbi alfaridzi', 'Hasbi CL', 'alfa06cl@gmail.com', '$2a$10$suqf3sM4bf1YFsoZipMXCumHMLCnPIMF1JYmGpk2g5lRMEhjJJxXK', '085719393230', '1999-06-15', '71f7dc85-3277-4b5d-8eee-dde8912e6ad5', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'bogor'),
('19399ea8-1ff5-11e7-9be2-001851f9fd39', 'test-b', 'test-b', 'test-b@test.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '123123123', '2012-02-02', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', 'bandung'),
('1939a848-1ff5-11e7-9be2-001851f9fd39', 'test-c', 'test-c', 'test-c@test.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '123123', '2012-02-02', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', ''),
('1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'Tri Sutrisno2', 'trisss', 'trisutrisno@yahoo.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '08562298839', '2000-02-01', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 6690, '4b51e103-2c76-4051-955b-fa2e4e731899', 'Cimahi'),
('45a227d8-78c6-4ee6-a470-b067412bc74d', 'arief', 'ariefdoang2', '123123@12323.com', '$2a$10$yC.zbFvkpOZfLDNvv35FMeMH5aA2B9paORB/0kOTHVLLTExYYa08O', '123123123', '2017-02-26', '57153ce1-0133-4a1c-bd73-8e3e3c32952c', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'bandung'),
('4a52988c-ac5d-40da-8b04-6a6dd16b34f3', 'Iskandar Idris', 'iskandaridris', 'iskandar.idris.developer@gmail.com', '$2a$10$FvABdvpTuNbdEgGht6dBzOIRS4tiHZtyP4tqP/CHEKAV4fdehHhEm', '085883529978', '1985-10-30', '57153ce1-0133-4a1c-bd73-8e3e3c32952c', 0, 'c468d652-d961-4329-96f0-b2aab5d2249c', 'Depok'),
('51747d24-0335-47ab-8e8f-ca1e8ca197cb', 'Maulana Jibril', 'maulanajibril', 'maulana.uicci@gmail.com', '$2a$10$55pQX9ptAqsGtgc4W0szkeuNj3TG/GU046uTBQSzqWQzxfAIIsMDy', '081317967859', '1996-10-04', '57153ce1-0133-4a1c-bd73-8e3e3c32952c', 0, '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 'Jakarta Selatan'),
('5f5c1238-0cb5-4237-a9ce-eac798f980d9', 'Test purpose', 'testpurpose20170318', 'testpurpose20170318@fakemail.com', '$2a$10$QtfoHVwXmWbTmNTD9cIJ0eFhT4WcgB/Y2RCKLS3di/Mk1NyZWyKKe', '0826263738', '2017-03-01', '986e18bf-5a94-44ed-881c-73ca91473a22', 0, 'c468d652-d961-4329-96f0-b2aab5d2249c', 'Cimahi'),
('63720f89-9fc1-412d-bd37-86ffb9c15b9f', 'Sari Asih Rahmawati', 'sariarahmawati', 'sariarahmawati@gmail.com', '$2a$10$ntbIAL4WxXOyJWTNSTpqfOkYkWp9ia4IHWlfxbYpRYa9S3WOiKz4i', '085720284342', '1989-05-20', '986e18bf-5a94-44ed-881c-73ca91473a22', 0, 'c468d652-d961-4329-96f0-b2aab5d2249c', 'Bandung'),
('6b578683-403f-488e-8f8f-71907b977196', 'arief', 'testngasalajah01', 'purnama.adi@gmail.com', '$2a$10$7oGl0eGgvTaH.poAsogkNuHC/Xpu8ehHTnT3ka2mIXG7tteyU9sWa', '123123123', '2016-12-25', '3bf531e8-fe98-4403-8eb5-a2c78d2ad103', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'bandung'),
('6b7254cc-1cc3-4f7a-8860-78e814e93763', 'ariefajahdoang', 'dodolipret', 'ada@ada.ajah', '$2a$10$QRxC8TlxStW7DILrztbc7OoEwLwqmEJJNy5s0b6nLGtYQleRS6sDa', '1231231', '2000-02-01', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', 'bandung'),
('7587af8e-4395-469d-b9ed-c02ee85ceb92', 'Adi Purnama', 'apur', 'adi@barapraja.com', '$2a$10$khBivS4qVD/9IPQS/w0F8OG9SNJGeJhbOaXGxvulSRpEgZeBz2uWy', '0982321', '2017-03-01', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0, '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', ''),
('79534a24-0a9e-4782-8e7a-4be5d5f44c81', 'Tespurpose201703180813', 'testpurpose201703180813', 'testpurpose20170318tes0813@fakemail.com', '$2a$10$ao6EjaEhEB.eb.VR5cjPfemlyJG5O5vNpVuj90/qYV6om514QcVL.', '0836363637', '2017-03-07', 'c505407b-40e2-41f4-a31d-7685c3dd1e1f', 0, '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 'Cimahi'),
('894f0885-1ff5-11e7-9be2-001851f9fd39', 'test-d', 'test-d', 'test-d@test.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '123123', '2013-02-02', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', ''),
('894f1207-1ff5-11e7-9be2-001851f9fd39', 'test-e', 'test-e', 'test-e@test.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '345345', '2013-02-02', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', ''),
('894f191e-1ff5-11e7-9be2-001851f9fd39', 'test-f', 'test-f', 'test-f@test.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '345345', '2013-02-02', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', ''),
('8ba9ffe6-be0e-460e-84f6-8932c31b9d4f', 'FREDY', 'WINDANA', 'fredywind@gmail.com', '$2a$10$Q.8ZY0xVmfr/QyE7jyJ48OVBxOHKa9i4F6I.OAXXj1.Ke8Zb6FWIW', '085755848156', '1982-10-03', '590ecb8d-46dd-4dd4-b5d4-c020f2761955', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'Malang'),
('90887815-1ff4-11e7-9be2-001851f9fd39', 'test-a', 'test-a', 'test-a@test.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '123123123', '2012-02-02', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', 'bandung'),
('91ec2abf-ed1f-4636-8622-bf6ae819bdbd', 'apur ganteng', 'apur', 'adi@barapraja.com', '$2a$10$EJx0LZUoFuKENazeyP/H0Op.8jOA.dBEy5XrlnyaE2SVnEojiRehG', '8213123', '2017-03-01', '5ecaed53-65f1-427a-b198-136800e07e7d', 0, 'c468d652-d961-4329-96f0-b2aab5d2249c', 'bandung'),
('97db5f09-ee54-4a2e-8be3-addec54ae8ee', 'Robert Chilingaryan', 'crobads', 'administrator@crobads.com', '$2a$10$EztO0PR6RzESdh2O3CHdUObjJvWZ.BOcovDRjsdEOkoiDACALigDi', '91901108', '1990-09-11', '0536c23e-ad52-4af1-905b-3afa36d8b44f', 0, 'c468d652-d961-4329-96f0-b2aab5d2249c', '0091'),
('a1b9f988-4ca2-4ee4-bd61-9b82b9a84785', 'Ahmad Jufri', 'ahmad4bekup', 'ahmad2009.q@gmail.com', '$2a$10$CaDlxGw64B8EwKe/XjgLFO4ikHSK32nEKVRIuzem8gjVMU3rQkBfq', '08564880362', '1981-01-15', '590ecb8d-46dd-4dd4-b5d4-c020f2761955', 0, 'c468d652-d961-4329-96f0-b2aab5d2249c', 'Malang'),
('a2d696f7-024a-453f-867d-db0d053b8d7c', 'adixx', 'apurtea', 'adi@email.org', '$2a$10$K9nmAjBQJWfYmGU0AiKOX.wCEtHkpxNzhsbJ9ONgB/QsYJjYLFANS', '081394306765', '1980-09-09', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', ''),
('ac016a78-79bb-4b30-8240-fd8b21a53963', 'Arbiyanto Wijaya', 'arbiyanto', 'arbiyantowijaya17@gmail.com', '$2a$10$8FV7EGDF.qIDvm4dJOOtbOLspFe3xNMIR3QMHzVoXHU8NRfZcQ16m', '081280827770', '1999-08-16', '52f3c9f7-e69f-403b-8cbd-4fd527490606', 0, '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 'Jakarta'),
('bae40db3-416b-431f-a115-ec89bcea06a4', 'arief', 'maulan', 'arief@maulana.com', '$2a$10$86I6nLVbuXBwS5yVpsfHpO8uTnycEY/j5HPMzhyXF6.1LXbRDNCHy', '123123123', '2017-03-23', '986e18bf-5a94-44ed-881c-73ca91473a22', 0, '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 'bandung'),
('c18979a5-fcfe-4873-821a-995f301d5899', 'aroef', 'testaroef', 'ar@ar.com', '$2a$10$tMjrJaZxTYz/SgAwK6JTROshKIu5eEVmLVzXNof4m6XOd9l1jgPJa', '123123123', '2017-02-26', '57153ce1-0133-4a1c-bd73-8e3e3c32952c', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'bogor'),
('c74a1ee9-dc96-49bb-add2-8f7e3716c5df', 'Mansour', 'Barahooi', 'mansour.barahooi@yahoo.com', '$2a$10$1ffW2lphc9t.UeWZVjrZ5egGjAq8ux/kATXgwgU2rv2WJVB3URqV6', '+923167101000', '1995-01-01', '3a636558-3c4f-453e-bc57-144a54c21e0f', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', '20'),
('c8c895b7-8053-4e82-b354-6cbf7ce301b6', 'Indra Purnama', 'indrabayur', 'indra@barapraja.com', '$2a$10$Y3Vrl20WDXPIBmQdGcV18OT7vSjo1Q/1O./JaF8xmEmT5D94xIQcy', '028321', '2017-03-01', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0, '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', ''),
('d3260a28-a9c7-4be8-8ce4-9ce0cf463c35', 'testarief', 'dodolipret2017', 'ada@ada.ajah.cmo', '$2a$10$OxpGpQVQ56GWH3hb7zudG.BYWReh2BLdOLDd.7Q/uNU7yv9uzsKci', '123123', '2017-04-06', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'tasik'),
('d402db51-bbc1-491e-bb6b-53f8e4c658a6', 'Bintang Paula Putra', 'Bintang', 'just.bintang@gmail.com', '$2a$10$nP7UVa2BGx4ljgKgN/DN8e8YnuIXW/.irek0UvhC9Xb73eaYaHShq', '081281715770', '1979-02-21', '57153ce1-0133-4a1c-bd73-8e3e3c32952c', 0, 'c468d652-d961-4329-96f0-b2aab5d2249c', 'Depok'),
('eb54d271-1370-4fe8-aad1-913ce3831f58', 'arief kasep', 'tapiboong', 'arieffakemail@dilo.com', '$2a$10$PkDCUC5hjYvaPVIB6RVive46eZLBoHaB46fZAkOnPhE6sAN8TkWiu', '1923781982731927', '2017-03-02', '71f7dc85-3277-4b5d-8eee-dde8912e6ad5', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', 'bandung'),
('ecaaa96f-6a9a-4a34-b72e-1aeb9703191f', 'semelekete', 'seme', 'dudud@dudud.com', '$2a$10$2eDDZGZI1ThRwu76TVRs5.JF4QHUFn8IcbiKfG9gNBm.ktCm/GiEK', '123123', '2017-03-29', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'bandung'),
('f1bf6403-fa5b-44fc-b869-c6520baebb15', 'hatta rukmana', 'hattarukmana', 'hattarukmana@gmail.com', '$2a$10$iTg3zcU28cOzsK7Ci3bWDefkR92.dlOSVRY8XByDke3NEJ0mdCDK6', '85641165385', '1992-01-14', '57153ce1-0133-4a1c-bd73-8e3e3c32952c', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', 'Jakarta Timur'),
('f1c54bc4-8e8e-4bd8-8f66-fd135c6804c8', 'Dafik Nurfatah', 'DafikNF', 'dafik.nf@gmail.com', '$2a$10$bB37bXJeiF20806xpgij9uhXJ/KvYqBDYIBN6Z0wOCW7Tux76SrRS', '0896 0308 5155', '1999-07-04', '52f3c9f7-e69f-403b-8cbd-4fd527490606', 0, '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 'Tangerang'),
('f4a1de26-3893-43b1-b57f-8b644d1b57fa', 'Novita Heni Purwandani Putri', 'novita_pepe', 'novita.pepe.np@gmail.com', '$2a$10$Ix9tRLdoEScja0Y85WX6k.dmHNK8RNjQzOqGTOoLM4xx14NfEV2z6', '081559788807', '1996-11-14', '590ecb8d-46dd-4dd4-b5d4-c020f2761955', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', 'Malang'),
('f6ef01d9-8b9a-4136-938c-ae66070f0641', 'Ade Fathur Rohman', 'adefa', 'skyout02@gmail.com', '$2a$10$.s7t9E79pemRZuJZFEklcOyz8JMxT63m.b6bTgCYSCpCi0p.Lzw/y', '082216848102', '2017-04-10', '00606344-44b3-4273-a9dc-7a8d8a5b227d', 0, '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 'Yogyakarta'),
('f9852fe4-d82f-4021-8533-2c73b7fe0041', 'Indra', 'iin', 'indra.purnama@gmail.com', '$2a$10$wB4XQy4CMaCJ3UzrZFlphu1fBschie/iytENPiFAksatpoMABFaC2', '08112228898', '1980-09-01', '986e18bf-5a94-44ed-881c-73ca91473a22', 0, 'c468d652-d961-4329-96f0-b2aab5d2249c', 'Bandung'),
('fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'Inandar Wiguna', 'igun', 'inandar@barapraja.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '03834329', '2017-03-01', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '79998c0a-9ecb-4082-aaf1-aa8e8fe4a80d', 'bandung'),
('ff6243ed-8979-472c-a13c-7431700f755f', 'Arief Kurniawan', 'kuerbaiii', 'arief.kurniawan.adransyah@gmail.com', '$2a$10$dYDcEyG891LEllFgzdfVyeiQ.E4bHTpCANmbGgKnhd01XfTlabC4G', '081333017789', '1995-04-17', '590ecb8d-46dd-4dd4-b5d4-c020f2761955', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'Pagar Alam'),
('ffc446d7-b20d-4b46-bc7f-d01736da93db', 'FREDY WINDANA', 'fredylearn', 'frd_dna@yahoo.co.id', '$2a$10$WU7CqvVV6BQALkPDZe/zaOuXgF65dM26e7isrF5Sv9shDfvOxZfAa', '085755848156', '1982-10-03', '590ecb8d-46dd-4dd4-b5d4-c020f2761955', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'Malang');

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent_certificate`
--

CREATE TABLE IF NOT EXISTS `bkp_talent_certificate` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `talent_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organizer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent_education`
--

CREATE TABLE IF NOT EXISTS `bkp_talent_education` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `talent_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `phase` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `institution` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `major` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `start_year` int(11) NOT NULL,
  `end_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_talent_education`
--

INSERT INTO `bkp_talent_education` (`id`, `talent_id`, `phase`, `institution`, `major`, `start_year`, `end_year`) VALUES
('dfd759ca-d389-4567-afb1-b514174b5b99', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'S3', 'UNPAD', 'Physics', 1990, 2012);

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent_skill`
--

CREATE TABLE IF NOT EXISTS `bkp_talent_skill` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `talent_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `score` int(11) NOT NULL,
  `skill_id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent_superhero`
--

CREATE TABLE IF NOT EXISTS `bkp_talent_superhero` (
  `id` tinyint(4) NOT NULL,
  `talent_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(64) NOT NULL,
  `maind_duty` varchar(256) NOT NULL,
  `special_ability` varchar(256) NOT NULL,
  `daily_activity` varchar(256) NOT NULL,
  `alternative_technology` varchar(256) NOT NULL,
  `is_removed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`,`talent_id`),
  KEY `talent_id` (`talent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent_training`
--

CREATE TABLE IF NOT EXISTS `bkp_talent_training` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `talent_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organizer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent_work_experience`
--

CREATE TABLE IF NOT EXISTS `bkp_talent_work_experience` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `talent_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `is_removed` tinyint(1) NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_working_year` int(11) NOT NULL,
  `end_working_year` int(11) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_571535D218777CEF` (`talent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_talent_work_experience`
--

INSERT INTO `bkp_talent_work_experience` (`id`, `talent_id`, `is_removed`, `company_name`, `position`, `start_working_year`, `end_working_year`, `role`) VALUES
('fa191d91-e67a-40ea-8725-8928f9c3f674', 'a2d696f7-024a-453f-867d-db0d053b8d7c', 0, 'Bara Praja', 'programmer', 2006, 2012, 'programmer');

-- --------------------------------------------------------

--
-- Table structure for table `bkp_team`
--

CREATE TABLE IF NOT EXISTS `bkp_team` (
  `id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` char(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vision` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mission` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `culture` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `founder_agreement` varchar(512) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `city_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bkp_team`
--

INSERT INTO `bkp_team` (`id`, `name`, `vision`, `mission`, `culture`, `founder_agreement`, `city_id`) VALUES
('0281638e-7e1d-4df0-8bfb-94efdaf1101c', 'tedt', '123', '321', '123', '321', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('038799b2-12e3-4f19-8dc7-c2677e10ec75', 'dfdfdhtht', 'dfdf', 'fdfdf', 'dfg', '', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('0b282bf1-a360-4bcf-ac39-bc63c06586d5', 'Dodol', 'Garut', 'Enak ', 'Pisan', 'CUYyyy', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('10a26cd9-2575-4fa4-ae97-74fd1885dccb', 'jingga', '12312312', '123123', '123123', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('13be66c8-3602-49a9-b512-11b2cb15243e', 'jjn', 'kjnkjn', 'kn', 'kjnknj', 'INTERNET BANKING MANDIRI - pulsa.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('1867df44-0fca-493f-990b-7518b2034cb4', 'yutyuty', 'utyutyu', 'utyu', 'tutyu', 'Panduan TA.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('1d4e3a44-6801-460f-90e9-322f43d58ff2', 'a team 1', 'visi', 'mission', 'sasala', '7fb3d8bdf68d6176b812def387a6d9ae-unable-to-transfer-files-from-my-pc-to-the-galaxy-tab-11649-lyvms5.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('23ae8a35-1655-4251-9ae0-3417f5a77037', 'fklgjdklfj', 'sdklfj\r\nsdkfjkls', 'sldkfj\r\nsdflkj', 'sdflkj\r\nsdlfkj', '1c896531b359ed922b2ea0f1b50bbbdd-15. Surat Penawaran Harga - GainMarketive versi 2.2 - Prodia Kudus.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('23cff4ce-cb75-4459-ab79-10768334a9f6', 'a test team a', 'visi', 'misi', 'culture', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('2941d233-a8c7-404c-b304-c7d70b4a8967', 'ababa', 'sababab', 'asasaj', 'sjaksjakj', 'askjkaj', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('3afcc25e-3a31-4509-a1af-ae516599fa7b', 'Astrajinggaaa', 'one', 'two', 'three', '234', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('3c7cb5e2-6080-4bc2-aec2-bc54460ee62f', 'SOLACE', 'asdklaskldj', 'askldjaklsjd', 'alksdjakljsd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('42fea0f2-9da7-45a2-8773-42038bec49ab', 'adaada', 'asd', 'asd', 'asd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('475d285b-2aee-45ae-a541-3a88d88f8264', 'Dudidamdam', 'asdasd\r\nasdasd', 'asdasd\r\nasdasd', 'asdasd\r\nasdasd', '', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('530666d3-dcfa-4b52-bc25-6968e033fceb', 'Test TEam', 'ada deh', 'ada ajah', 'gak teau', 'ga ada', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('56bd3071-5b2f-47e7-a606-3756d41cba6c', 'dudud', 'asdasdasd', 'asdasd', 'asdasd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('644eceef-a248-44b5-b9aa-0042eaa13053', 'svvdfgdf', 'hghj', 'jhb', 'bjk', 'bkjb', '49a94e7d-0ddc-4528-af39-27fcec8ca67b'),
('7588f7f0-8207-4190-a708-4c8485095d66', 'logitec', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lor', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lor', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lor', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('7827b3ba-3739-437e-818f-5385f42bd986', 'DODOLgarut', 'sfsdfsdf', 'sdfsdf', 'sdfsdf', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('782baa6a-4aa1-45ec-ab3c-44a88e49e8a1', 'halo', 'halo', 'halo', 'halo', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('8432aaff-7797-40a8-87bf-ebe964ff3dbc', 'jknjksdnfd', 'lnlkdfkldm', 'lmlkdmflkdm', 'klmklmlm', 'INTERNET BANKING MANDIRI - pulsa.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('90e10b3c-f312-4e64-b537-5cce1434eac1', 'fsdfdsfds', 'sdfsdfsdfsd', 'fsdfsdfsdf', 'sdfsdfsdfsd', 'sdfsfsdf', '49a94e7d-0ddc-4528-af39-27fcec8ca67b'),
('96d318a4-80d4-4773-89a9-6140c77c9fd0', 'dsmsmdm', 'lmlmlm', 'm;l', 'm;lm;m', 'mhnmb', '49a94e7d-0ddc-4528-af39-27fcec8ca67b'),
('997c5f26-339c-4607-b47d-8004e3a5fc0e', 'dwdw', 'dwdw', 'dwdwd', 'dwdwd', '4998d99379262c1091fc6ce0498ea898-15. Surat Penawaran Harga - GainMarketive versi 2.2 - Prodia Kudus.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('a4cd3645-80d7-499b-a63f-4f5e79f1268d', 'fefefef', 'fefef', 'efefe', 'fefef', 'fef', '49a94e7d-0ddc-4528-af39-27fcec8ca67b'),
('a94d8559-62e0-4794-a214-b7eba7044a3b', '123213123123', 'asdfasdfas', 'sdfasdfsdff', 'sdfasdfasdfasd', 'sdfasdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('aef2cde8-eb4b-4490-8dbc-0605dee02377', 'sdsds', 'dsdsds', 'dsdsd', 'sdsds', 'sdsd', '49a94e7d-0ddc-4528-af39-27fcec8ca67b'),
('b2735057-5844-4bf7-b3f9-40f4fff09536', 'oh my god', 'asdasd', 'asdasd', 'asdasd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('b60d7c27-7d30-4274-aec4-b626518aea5f', 'Astrajingga', 'one', 'two', 'three', 'for', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('bceeffac-73e5-4d2c-a92e-c691728c10ca', 'Team ABCD', 'ga ada', 'ada ajah', 'naon sih', 'ga ada', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('bdebbd4a-8c1e-48c7-9cd3-2b68db6c1f09', 'gty54tfh', 'fhfhfh', 'fhfjg', 'jfgjfjfg', 'jfgjfgjf', '49a94e7d-0ddc-4528-af39-27fcec8ca67b'),
('c208d611-9aff-4784-acc5-a93e4bc96587', 'Team ABC', 'ada deh', 'ada ajah', 'mau tau ajah', 'ga ada', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('cdff994f-bf32-4304-9656-888cbe30bad1', '2345', '123', '2323', '123', '123', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('d38e668c-d7b6-408d-aacb-ea35b2b6e76d', 'team abcda', 'asd', 'asd', 'asd', 'asd', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('d59f1a12-30f7-4851-81b6-58adab75ab28', 'awtrytfhfg', 'hjhgj', 'gjghjghjgh', 'jhgkkg', 'kgkgh', '49a94e7d-0ddc-4528-af39-27fcec8ca67b'),
('d9543064-e9c0-48f9-adc0-19507365797c', 'Astra Jingga', 'one', 'two', 'three', 'four', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('db3fdae1-9719-470f-85f2-a09e5f00bfc7', '123123123123', '123', '123', '123', '123', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('dd903c06-56bd-4e90-8863-b091ae7d59e2', 'DOLARO', 'asdasdasdasd', 'asdasdasd', 'asdasdasd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('ddb4b083-b040-453c-bc59-1538ac702d62', 'Astrajinggaa', 'one', 'two', 'three', 'four', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('e0e7cd89-41ac-4c47-914e-0e10e6e31fc9', '678678768', '678678', '678', '678', '678', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('e55315a7-3e88-4ed6-8527-dda68f2faca0', 'ijk`ojmjo', 'oko', 'kok', 'okok', '/var/www/html/bekup/app/controllers/../../public/uploads/INTERNET BANKING MANDIRI - pulsa.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a'),
('e7e1c423-8ece-4050-ad58-bacc5e4b040c', 'Durarim', '123', '123', '123asd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a');

-- --------------------------------------------------------

--
-- Table structure for table `bkp_team_class`
--

CREATE TABLE IF NOT EXISTS `bkp_team_class` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(256) NOT NULL,
  `operation_start_date` varchar(10) NOT NULL,
  `operation_end_date` varchar(10) NOT NULL,
  `registration_start_date` varchar(10) NOT NULL,
  `registration_end_date` varchar(10) NOT NULL,
  `is_removed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bkp_team_class`
--

INSERT INTO `bkp_team_class` (`id`, `name`, `operation_start_date`, `operation_end_date`, `registration_start_date`, `registration_end_date`, `is_removed`) VALUES
('73822320-7471-4aa4-bbeb-6554d695a69c', 'sasa1', '2017-04-23', '2017-04-29', '2017-04-19', '2017-04-21', 1),
('b1f256d2-f4d3-4d38-a70c-5bff04f4c06f', 'sasa', '2017-04-23', '2017-04-29', '2017-04-19', '2017-04-21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bkp_team_class_mapping`
--

CREATE TABLE IF NOT EXISTS `bkp_team_class_mapping` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `city_team_class_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `team_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `status` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bkp_team_class_track`
--

CREATE TABLE IF NOT EXISTS `bkp_team_class_track` (
  `id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `team_class_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `track_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bkp_team_member`
--

CREATE TABLE IF NOT EXISTS `bkp_team_member` (
  `id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `position` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `talent_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `team_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bkp_team_member`
--

INSERT INTO `bkp_team_member` (`id`, `position`, `status`, `talent_id`, `team_id`) VALUES
('002cfde4-c163-4248-80fb-103ff4107db9', 'Undefined', 'cancelled', 'a2d696f7-024a-453f-867d-db0d053b8d7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('00f7f0d1-7ed1-4d24-9d2c-11614ee19f4f', 'asD', 'cancelled', '6b7254cc-1cc3-4f7a-8860-78e814e93763', 'dd903c06-56bd-4e90-8863-b091ae7d59e2'),
('043f0f60-e6ce-4ba2-a140-801bc26321f3', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '530666d3-dcfa-4b52-bc25-6968e033fceb'),
('06d04551-94f7-49eb-8e2e-b5e3ce562f63', 'CEO', 'invited', '6b7254cc-1cc3-4f7a-8860-78e814e93763', 'e7e1c423-8ece-4050-ad58-bacc5e4b040c'),
('07f91e61-bb74-4644-8327-af4321b83dc4', 'rtrtrtr', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '038799b2-12e3-4f19-8dc7-c2677e10ec75'),
('09fa3b27-8eef-4d15-b77d-b4796818bc85', 'Undefined', 'cancelled', 'a2d696f7-024a-453f-867d-db0d053b8d7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('0df44640-acab-470a-8cec-0905c4715dae', 'CTO', 'cancelled', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('124c95e6-578b-4586-8772-07f2106651c4', 'Undefined', 'cancelled', 'a2d696f7-024a-453f-867d-db0d053b8d7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('128fcdb6-9bab-474a-bea4-491c666585ae', '123', 'to_be_dropped', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'cdff994f-bf32-4304-9656-888cbe30bad1'),
('12fc2362-9230-4b01-b6b3-473982b39c93', 'Undefined', 'cancelled', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('143e47fc-8367-4086-be50-3e096fe1f227', 'CEO', 'resign', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', '0b282bf1-a360-4bcf-ac39-bc63c06586d5'),
('1f0aaac8-cbd4-48b4-8204-362963d14482', 'Undefined', 'cancelled', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '0b282bf1-a360-4bcf-ac39-bc63c06586d5'),
('1fa88109-b538-4001-9a91-c0a7eff1411e', 'sds', 'resign', '7587af8e-4395-469d-b9ed-c02ee85ceb92', 'aef2cde8-eb4b-4490-8dbc-0605dee02377'),
('2482724e-e40e-48cd-b9af-08c703f735b6', 'COE', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '2941d233-a8c7-404c-b304-c7d70b4a8967'),
('25d2331a-1bd7-4ec8-82a3-29749213a460', 'jbjb', 'resign', '7587af8e-4395-469d-b9ed-c02ee85ceb92', '96d318a4-80d4-4773-89a9-6140c77c9fd0'),
('25ea5426-65a2-4bd2-b778-2d8c94637788', 'add', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '475d285b-2aee-45ae-a541-3a88d88f8264'),
('27b9d97c-ca07-4214-99b6-c78d15dea74a', 'Undefined', 'cancelled', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'cdff994f-bf32-4304-9656-888cbe30bad1'),
('287153ac-acb8-4d9f-a2fc-ccfca82c1429', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'd38e668c-d7b6-408d-aacb-ea35b2b6e76d'),
('2a6bff17-9518-4be0-9144-107700f13242', 'Undefined', 'cancelled', 'a2d696f7-024a-453f-867d-db0d053b8d7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('2ab1c164-a0a6-4003-b804-1d0e58ee8c1c', 'CEO', 'invited', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'd9543064-e9c0-48f9-adc0-19507365797c'),
('2cc15da6-8d22-4067-a611-fcf0a410670b', 'Undefined', 'refuse', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('3dbe7a4b-b5da-4d10-9f89-f49598cce856', 'sdfsd', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '7827b3ba-3739-437e-818f-5385f42bd986'),
('3f3ecc89-6493-47a5-a756-d0c34975737d', 'Undefined', 'cancelled', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'cdff994f-bf32-4304-9656-888cbe30bad1'),
('437162ea-b940-4fbb-9ea4-8aea49ab93f5', 'ccc', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('4d7490af-7472-4184-93be-0017689f189e', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '7588f7f0-8207-4190-a708-4c8485095d66'),
('50191de2-6e1c-4a42-9a3a-7e7538bfaa08', 'qw', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '8432aaff-7797-40a8-87bf-ebe964ff3dbc'),
('502393b5-e59d-4f7e-a64b-32d84f52c096', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'b60d7c27-7d30-4274-aec4-b626518aea5f'),
('519c472b-ad25-4f34-96c5-785a41223d35', 'Undefined', 'cancelled', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('52a8e9d1-2d3d-4317-b69b-2f54391969ae', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '3c7cb5e2-6080-4bc2-aec2-bc54460ee62f'),
('58201131-8962-411f-b4e5-7db9b5789a27', 'Undefined', 'resign', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'cdff994f-bf32-4304-9656-888cbe30bad1'),
('5bf800e8-0a42-4e33-a878-5e624eac9dc2', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '782baa6a-4aa1-45ec-ab3c-44a88e49e8a1'),
('5eb622d4-bd2c-4653-a4dc-d24660fc09bd', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '3afcc25e-3a31-4509-a1af-ae516599fa7b'),
('604e0f43-2411-4f7f-a077-037c04d44ca2', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '56bd3071-5b2f-47e7-a606-3756d41cba6c'),
('60e53e87-510a-409e-b096-c9c58a970eaf', 'Undefined', 'cancelled', 'a2d696f7-024a-453f-867d-db0d053b8d7c', '2941d233-a8c7-404c-b304-c7d70b4a8967'),
('61c9e896-cc10-4987-887d-189e69de486e', 'ssd', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '13be66c8-3602-49a9-b512-11b2cb15243e'),
('6496417d-cdc9-4ece-b29e-f224336a9511', 'Undefined', 'refuse', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', '2941d233-a8c7-404c-b304-c7d70b4a8967'),
('6831f057-2ca8-4b90-b046-5d515a7c6da1', 'CTO', 'cancelled', 'a2d696f7-024a-453f-867d-db0d053b8d7c', 'dd903c06-56bd-4e90-8863-b091ae7d59e2'),
('6a5b8ebc-bfaf-4dc6-8c02-a5a18fa481e4', 'Undefined', 'cancelled', 'a2d696f7-024a-453f-867d-db0d053b8d7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('6ffc1922-41e1-4429-a4b4-8a037d57bb5f', 'CEO', 'cancelled', 'a2d696f7-024a-453f-867d-db0d053b8d7c', 'd9543064-e9c0-48f9-adc0-19507365797c'),
('77de30e0-c49f-4337-8566-1bda066ba9e4', 'kb', 'resign', '7587af8e-4395-469d-b9ed-c02ee85ceb92', '644eceef-a248-44b5-b9aa-0042eaa13053'),
('7d145371-6de1-4aa0-8b30-94e3bf3d4307', 'asdasd', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'dd903c06-56bd-4e90-8863-b091ae7d59e2'),
('7d674176-cfe7-442b-9ffa-47459bcb774d', 'CEO', 'invited', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', '7588f7f0-8207-4190-a708-4c8485095d66'),
('7d67c928-7d05-4e06-b676-bf24b8e97efb', 'CEO', 'cancelled', '6b7254cc-1cc3-4f7a-8860-78e814e93763', 'dd903c06-56bd-4e90-8863-b091ae7d59e2'),
('7e0cea24-70fb-465f-8a7f-68f2ae7ea9a4', '678', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'e0e7cd89-41ac-4c47-914e-0e10e6e31fc9'),
('7fda6963-c8f0-403e-8001-40bddb34dd52', 'CTO', 'cancelled', 'd3260a28-a9c7-4be8-8ce4-9ce0cf463c35', 'dd903c06-56bd-4e90-8863-b091ae7d59e2'),
('84425f79-0215-4e90-bccc-1e06022beaf2', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'e7e1c423-8ece-4050-ad58-bacc5e4b040c'),
('86380131-4d40-47be-ae88-91ae87cdfa58', 'CEO', 'cancelled', '6b7254cc-1cc3-4f7a-8860-78e814e93763', '1d4e3a44-6801-460f-90e9-322f43d58ff2'),
('8a2083b6-a1c0-443a-bdbc-24132a06c97d', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'bceeffac-73e5-4d2c-a92e-c691728c10ca'),
('8b1f27c0-d9e9-430e-8324-6c4ad1dda477', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'd9543064-e9c0-48f9-adc0-19507365797c'),
('8b2aa703-6ffb-48a3-b9dd-809350717053', 'pos', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '1867df44-0fca-493f-990b-7518b2034cb4'),
('9a487dea-cdde-4266-8632-944cc727fef8', 'ghkgh', 'resign', '7587af8e-4395-469d-b9ed-c02ee85ceb92', 'd59f1a12-30f7-4851-81b6-58adab75ab28'),
('a403fb2f-22b8-459d-836d-8a1453914b53', '123', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'db3fdae1-9719-470f-85f2-a09e5f00bfc7'),
('af7ddb2f-940c-417a-9b5f-b5c5d29deeee', 'fefe', 'resign', '7587af8e-4395-469d-b9ed-c02ee85ceb92', 'a4cd3645-80d7-499b-a63f-4f5e79f1268d'),
('b3ea4256-d47f-4c23-a86f-cee19a2b4450', 'CEO', 'cancelled', 'd3260a28-a9c7-4be8-8ce4-9ce0cf463c35', 'dd903c06-56bd-4e90-8863-b091ae7d59e2'),
('b543e9d5-eab5-4a6b-a566-52626d100d56', 'CTO', 'cancelled', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('b66839c4-e0aa-4653-9104-b0b40a8991c6', 'gjfgjf', 'resign', '7587af8e-4395-469d-b9ed-c02ee85ceb92', 'bdebbd4a-8c1e-48c7-9cd3-2b68db6c1f09'),
('bad46d36-f39d-45bd-a4e8-f45e7157645c', 'dada', 'cancelled', '894f0885-1ff5-11e7-9be2-001851f9fd39', 'e7e1c423-8ece-4050-ad58-bacc5e4b040c'),
('bca2d9a0-1cab-40ac-9a22-e6bbb27d3fcf', 'asd', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '42fea0f2-9da7-45a2-8773-42038bec49ab'),
('bd8395e1-6166-4652-80d2-8f82be94dd97', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'c208d611-9aff-4784-acc5-a93e4bc96587'),
('bfcde5d0-8d57-42cd-8d9d-798d40175c93', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'ddb4b083-b040-453c-bc59-1538ac702d62'),
('c192a6bf-f6ae-415d-9b0b-ad67db24c980', 'qw', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'e55315a7-3e88-4ed6-8527-dda68f2faca0'),
('c620c970-e093-4aa3-97b4-97571b04f722', 'asdasd', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'b2735057-5844-4bf7-b3f9-40f4fff09536'),
('c64a2590-0108-48ea-bec8-dabcc841ca03', 'Undefined', 'refuse', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('cd6e8328-58ea-40c5-b553-160859012e5d', 'Undefined', 'resign', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', '2941d233-a8c7-404c-b304-c7d70b4a8967'),
('d1b4a7c6-f199-4cc5-b20a-c58015f948c9', 'CTO', 'resign', 'a2d696f7-024a-453f-867d-db0d053b8d7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('d805dbc3-eb62-4af9-a40c-7d9b5b977efd', 'Front end', 'cancelled', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'dd903c06-56bd-4e90-8863-b091ae7d59e2'),
('d8949471-9929-45fd-a7da-47597542b1ef', 'Undefined', 'invited', 'a2d696f7-024a-453f-867d-db0d053b8d7c', '0b282bf1-a360-4bcf-ac39-bc63c06586d5'),
('da33bde1-d506-4954-ae66-94c4de357717', 'CEO', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '0281638e-7e1d-4df0-8bfb-94efdaf1101c'),
('dada6fa3-4826-4e13-9178-550ac15f61f1', 'Undefined', 'resign', 'a2d696f7-024a-453f-867d-db0d053b8d7c', 'cdff994f-bf32-4304-9656-888cbe30bad1'),
('e337c6d8-3bcf-4bb3-b667-e3596ab9cddb', 'pos', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '23cff4ce-cb75-4459-ab79-10768334a9f6'),
('e5cff646-bcb7-44d5-bee1-675de891bb4a', 'sfsdfds', 'resign', '7587af8e-4395-469d-b9ed-c02ee85ceb92', '90e10b3c-f312-4e64-b537-5cce1434eac1'),
('ec4ccb4a-8a1b-49e6-8df1-2d3d1c6ea665', 'Undefined', 'cancelled', 'fe2275e7-d602-49fc-9a58-b453d1d3bd7c', 'a94d8559-62e0-4794-a214-b7eba7044a3b'),
('f6e36df8-a60e-4b09-8405-c54f244d4e87', 'ew', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '997c5f26-339c-4607-b47d-8004e3a5fc0e'),
('f73cf70d-9041-4201-ab6a-0825e53e2289', 'CEO', 'cancelled', '6b7254cc-1cc3-4f7a-8860-78e814e93763', 'dd903c06-56bd-4e90-8863-b091ae7d59e2'),
('f876421b-46af-463d-8968-ab13e912a8d8', '123', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '10a26cd9-2575-4fa4-ae97-74fd1885dccb'),
('f8be98ed-139a-420e-93e9-fe8cccf7daeb', 'asa', 'resign', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '1d4e3a44-6801-460f-90e9-322f43d58ff2'),
('fee3d2da-7edf-4cd9-b425-f2873d3c5000', 'asdasd', 'active', '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', '23ae8a35-1655-4251-9ae0-3417f5a77037');

-- --------------------------------------------------------

--
-- Table structure for table `bkp_track`
--

CREATE TABLE IF NOT EXISTS `bkp_track` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `is_removed` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_track`
--

INSERT INTO `bkp_track` (`id`, `is_removed`, `name`, `description`) VALUES
('0f940036-abda-4dc3-aa5f-ebcc10213097', 0, 'BEKUP Basic PHP', 'Pelatihan bahasa pemrograman PHP (hanya untuk peserta perorangan)'),
('2ae7b78c-b117-40db-80e9-f6b7eee742f6', 1, 'Track 3', 'Desc 3'),
('3fde6f49-3859-4475-85b9-ea2e3ca67b92', 0, 'BEKUP Basic Creative', 'Pelatihan desain User Interface dan User Experience (hanya untuk peserta perorangan)'),
('47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', 1, 'Track Name1x', 'Track Desc1x'),
('4b51e103-2c76-4051-955b-fa2e4e731899', 0, 'BEKUP Basic Android', 'Pelatihan bahasa pemrograman Android (hanya untuk peserta perorangan)'),
('79998c0a-9ecb-4082-aaf1-aa8e8fe4a80d', 1, 'sasas', 'asasas'),
('c468d652-d961-4329-96f0-b2aab5d2249c', 0, 'BEKUP Start', 'Program pendampingan bisnis Startup (hanya untuk tim yang terdiri atas minimal 1 org teknis dan 1 org bisnis/desain)'),
('d5819752-7999-4ecf-862b-a83db35e3d34', 1, 'Trck A', 'Desc A'),
('f068d477-5395-4a3a-bfb3-3c84988fe80a', 1, 'djbjdj', 'hdhd'),
('fe1c311b-b912-41a0-8452-a5177750cbb1', 1, 'Name', 'najsasa');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bkp_talent_work_experience`
--
ALTER TABLE `bkp_talent_work_experience`
  ADD CONSTRAINT `FK_571535D218777CEF` FOREIGN KEY (`talent_id`) REFERENCES `bkp_talent` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
