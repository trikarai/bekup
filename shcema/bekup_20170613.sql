-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2017 at 04:03 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

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
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_city`
--

INSERT INTO `bkp_city` (`id`, `is_removed`, `name`) VALUES
('00606344-44b3-4273-a9dc-7a8d8a5b227d', 0, 'Yogyakarta'),
('0536c23e-ad52-4af1-905b-3afa36d8b44f', 0, 'Solo'),
('0d710175-18f4-4fd8-963a-2ddfa98fe7dc', 1, 'Malangbong'),
('20092f0e-c694-424a-a36e-707e17d0b236', 1, 'cimahi'),
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
('8e36dd87-0104-4433-8772-a915ef0873b8', 1, 'cimahi_again'),
('986e18bf-5a94-44ed-881c-73ca91473a22', 0, 'Bandung'),
('9d5ebadb-c102-42d8-a8b1-d5059b70799b', 0, 'Pekanbaru'),
('9e9ae34e-e24e-4b39-b3a8-844416c8c64e', 0, 'Balikpapan'),
('c505407b-40e2-41f4-a31d-7685c3dd1e1f', 0, 'Medan'),
('f14b35a2-02f2-11e7-8256-001851f9fd39', 1, 'cimahi 2'),
('ff7745ef-2565-4122-bb86-3edec782c90c', 1, 'cimahi_again');

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
  `role` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)',
  `track_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '(DC2Type:guid)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_personnel`
--

INSERT INTO `bkp_personnel` (`id`, `is_removed`, `name`, `email`, `password`, `role`, `city_id`, `track_id`) VALUES
('471e1cb9-2c63-4847-9ea4-df006fefd17c', 0, 'indra', 'indra@mikti.org', '$2a$10$72GpT4m7hWQQft/MtcxExeV.2q5004hSpfYcbxN9n8blywzHtZ3gy', 'Director', NULL, NULL),
('6148e81d-399c-4225-99d9-b820b2dd3996', 1, 'asdfasd', 'asdfasdf@bara.id', '$2a$10$/CPnKVTDB8tlaqBYf403beY16E0QgDGuDgbXPCpNX4jq10aN4Jf6S', 'Tutor', '00606344-44b3-4273-a9dc-7a8d8a5b227d', '0f940036-abda-4dc3-aa5f-ebcc10213097'),
('6bccb8c4-e9ba-4f57-931a-3af6bfb42eb1', 1, 'troll', 'troll@email.org', '$2a$10$wTAtpy5hYjKBVDOiJSlza.8gNSOYxbnAIOvYVU5Loqb6Lhzn4L8hO', 'Tutor', '57153ce1-0133-4a1c-bd73-8e3e3c32952c', '3fde6f49-3859-4475-85b9-ea2e3ca67b92'),
('7059ba81-d4e8-4c03-bc92-01114e5c2a68', 0, 'Tri Sutrisno', 'mas.trisutrisno@gmail.com', '$2a$10$aJG7INEiFSo1yv81orWdkO0Pz.imVOgUDGm7D3VeS1ZOOEvsz/SYu', 'Koordinator Track', NULL, '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc'),
('712d9d18-bd43-488b-bda4-81420f1005e9', 0, 'sasasa', 'admin@admin.com', '$2a$10$SbEbz1M2DfGnVQcSErFd3e.GipGvg3pUcbG2jvALgg7tjwLppEXei', 'Direktur', NULL, NULL),
('917a6db6-db55-4c2d-89d1-155c2d1de625', 0, 'dedeh aip', 'arief@barapraja.com', '$2a$10$T2wu.Oikp1/PnhAMCEetbu1Q.zBF.Uu9IdCNZv/YFIEzyC/KjMZmC', 'Tutor', '806b2600-82e0-4b9a-9d62-3cd52b32723a', '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc'),
('f3e9f674-c98d-4db1-918c-1f30a465d283', 0, 'Tri Sutrisno', 'tri@barapraja.com', '$2a$10$iZ8NElAVyoOpZiQW.UuYzepAzC5A4.fjbc0jH2gevZCyu4bFZQsyO', 'Koordinator Wilayah', '806b2600-82e0-4b9a-9d62-3cd52b32723a', NULL),
('fa3fc850-834e-4811-a500-84383377efdc', 0, 'Indro Purnama', 'indra@barapraja.com', '$2a$10$efVES99F8M83sSP2Fq0EleZB9CogNtL6D..behiOOQW6wIPlZ6fV2', 'Direktur', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bkp_programme`
--

CREATE TABLE IF NOT EXISTS `bkp_programme` (
  `id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(256) NOT NULL,
  `operation_start_date` datetime NOT NULL,
  `operation_end_date` datetime NOT NULL,
  `registration_start_date` datetime NOT NULL,
  `registration_end_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bkp_skill`
--

CREATE TABLE IF NOT EXISTS `bkp_skill` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `track_id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_skill`
--

INSERT INTO `bkp_skill` (`id`, `name`, `track_id`, `is_removed`) VALUES
('153ff68d-72ab-490c-9a6c-194eb57e8918', 'php mvc', '0f940036-abda-4dc3-aa5f-ebcc10213097', 0),
('4ae9882a-4281-4656-80bd-b5a370edeb4e', 'asdfasdfsdf', '0f940036-abda-4dc3-aa5f-ebcc10213097', 1),
('55a8b407-45b8-4588-b64b-2e1bfea37012', 'ddd', '0f940036-abda-4dc3-aa5f-ebcc10213097', 0),
('6538d0cb-9119-4d4a-9745-d0bc98d1ec19', 'Android', '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 0),
('b8951e7c-9259-4998-86a0-d9c7d85e465b', 'wqerqerwer', '0f940036-abda-4dc3-aa5f-ebcc10213097', 1),
('c8386e27-0901-4762-bbc8-1f5dc232b8ca', '231adasdas', '4b51e103-2c76-4051-955b-fa2e4e731899', 1),
('f465ec72-35f5-43f6-b6d6-d26fa678e5fc', 'Adobe Photoshop', '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 1);

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
  `city_of_origin` varchar(255) COLLATE utf8_unicode_ci NOT NULL
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
('79534a24-0a9e-4782-8e7a-4be5d5f44c81', 'Tespurpose201703180813', 'testpurpose201703180813', 'testpurpose20170318tes0813@fakemail.com', '$2a$10$ao6EjaEhEB.eb.VR5cjPfemlyJG5O5vNpVuj90/qYV6om514QcVL.', '0836363637', '2017-03-07', 'c505407b-40e2-41f4-a31d-7685c3dd1e1f', 0, '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 'Cimahi'),
('894f0885-1ff5-11e7-9be2-001851f9fd39', 'test-d', 'test-d', 'test-d@test.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '123123', '2013-02-02', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', ''),
('894f1207-1ff5-11e7-9be2-001851f9fd39', 'test-e', 'test-e', 'test-e@test.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '345345', '2013-02-02', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', ''),
('894f191e-1ff5-11e7-9be2-001851f9fd39', 'test-f', 'test-f', 'test-f@test.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '345345', '2013-02-02', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', ''),
('8ba9ffe6-be0e-460e-84f6-8932c31b9d4f', 'FREDY', 'WINDANA', 'fredywind@gmail.com', '$2a$10$Q.8ZY0xVmfr/QyE7jyJ48OVBxOHKa9i4F6I.OAXXj1.Ke8Zb6FWIW', '085755848156', '1982-10-03', '590ecb8d-46dd-4dd4-b5d4-c020f2761955', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'Malang'),
('90887815-1ff4-11e7-9be2-001851f9fd39', 'test-a', 'test-a', 'test-a@test.com', '$2a$10$hQdLjvTsR95q8n/5AFUuLevLtrwmXkqp4r/0QjOuKEX2TsCeprggK', '123123123', '2012-02-02', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '4b51e103-2c76-4051-955b-fa2e4e731899', 'bandung'),
('97db5f09-ee54-4a2e-8be3-addec54ae8ee', 'Robert Chilingaryan', 'crobads', 'administrator@crobads.com', '$2a$10$EztO0PR6RzESdh2O3CHdUObjJvWZ.BOcovDRjsdEOkoiDACALigDi', '91901108', '1990-09-11', '0536c23e-ad52-4af1-905b-3afa36d8b44f', 0, 'c468d652-d961-4329-96f0-b2aab5d2249c', '0091'),
('a1b9f988-4ca2-4ee4-bd61-9b82b9a84785', 'Ahmad Jufri', 'ahmad4bekup', 'ahmad2009.q@gmail.com', '$2a$10$CaDlxGw64B8EwKe/XjgLFO4ikHSK32nEKVRIuzem8gjVMU3rQkBfq', '08564880362', '1981-01-15', '590ecb8d-46dd-4dd4-b5d4-c020f2761955', 0, 'c468d652-d961-4329-96f0-b2aab5d2249c', 'Malang'),
('a2d696f7-024a-453f-867d-db0d053b8d7c', 'adixx', 'apurtea', 'adi@email.org', '$2a$10$K9nmAjBQJWfYmGU0AiKOX.wCEtHkpxNzhsbJ9ONgB/QsYJjYLFANS', '081394306765', '1980-09-09', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0, '47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', ''),
('a76c17f4-7f34-4edf-a2f9-35a4acceaa88', 'sdfasdfa', 'asdfasdf', 'asdfasdf@barapraja.com', '$2a$10$POm94jaJve5JMLRtzuLim.ATM5pqqJWxWQ0KzJPHcrwVfjh7hPgWu', '21312313123', '1990-01-01', '00606344-44b3-4273-a9dc-7a8d8a5b227d', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'cimahi'),
('ac016a78-79bb-4b30-8240-fd8b21a53963', 'Arbiyanto Wijaya', 'arbiyanto', 'arbiyantowijaya17@gmail.com', '$2a$10$8FV7EGDF.qIDvm4dJOOtbOLspFe3xNMIR3QMHzVoXHU8NRfZcQ16m', '081280827770', '1999-08-16', '52f3c9f7-e69f-403b-8cbd-4fd527490606', 0, '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 'Jakarta'),
('bae40db3-416b-431f-a115-ec89bcea06a4', 'arief', 'maulan', 'arief@maulana.com', '$2a$10$86I6nLVbuXBwS5yVpsfHpO8uTnycEY/j5HPMzhyXF6.1LXbRDNCHy', '123123123', '2017-03-23', '986e18bf-5a94-44ed-881c-73ca91473a22', 0, '3fde6f49-3859-4475-85b9-ea2e3ca67b92', 'bandung'),
('c18979a5-fcfe-4873-821a-995f301d5899', 'aroef', 'testaroef', 'ar@ar.com', '$2a$10$tMjrJaZxTYz/SgAwK6JTROshKIu5eEVmLVzXNof4m6XOd9l1jgPJa', '123123123', '2017-02-26', '57153ce1-0133-4a1c-bd73-8e3e3c32952c', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'bogor'),
('c74a1ee9-dc96-49bb-add2-8f7e3716c5df', 'Mansour', 'Barahooi', 'mansour.barahooi@yahoo.com', '$2a$10$1ffW2lphc9t.UeWZVjrZ5egGjAq8ux/kATXgwgU2rv2WJVB3URqV6', '+923167101000', '1995-01-01', '3a636558-3c4f-453e-bc57-144a54c21e0f', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', '20'),
('c78ead03-787f-4765-8173-6e5429693ed7', 'adi ganteng', 'apur', 'adi@barapraja.com', '$2a$10$b1vryJZ2btI/yVzV3QnexuDNOMcQCZhQG3xIqvRCxax5XK/axQnGm', '0812312313', '1981-01-01', '986e18bf-5a94-44ed-881c-73ca91473a22', 0, '0f940036-abda-4dc3-aa5f-ebcc10213097', 'bandung'),
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
  `id` smallint(6) NOT NULL,
  `skill_score_id` smallint(6) NOT NULL,
  `name` varchar(256) NOT NULL,
  `organizer` varchar(256) NOT NULL,
  `valid_until` smallint(4) NOT NULL,
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent_education`
--

CREATE TABLE IF NOT EXISTS `bkp_talent_education` (
  `id` smallint(6) NOT NULL COMMENT '(DC2Type:guid)',
  `talent_id` char(36) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '(DC2Type:guid)',
  `phase` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `institution` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `major` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `start_year` int(4) NOT NULL,
  `end_year` int(4) DEFAULT NULL,
  `note` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_talent_education`
--

INSERT INTO `bkp_talent_education` (`id`, `talent_id`, `phase`, `institution`, `major`, `start_year`, `end_year`, `note`, `is_removed`) VALUES
(0, '1972245b-0bb5-4d1a-9d04-d8a0bd231f2b', 'S3', 'UNPAD', 'Physics', 1990, 2012, '', 0),
(1, 'c78ead03-787f-4765-8173-6e5429693ed7', 'SMA/SMK', 'SMA 3', 'IPA', 1995, 1998, '', 1),
(2, 'c78ead03-787f-4765-8173-6e5429693ed7', 'S1', 'itenas', 'EL', 2006, 2012, 'do deui', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent_skill_score`
--

CREATE TABLE IF NOT EXISTS `bkp_talent_skill_score` (
  `id` smallint(6) NOT NULL,
  `score` tinyint(4) NOT NULL,
  `is_removed` tinyint(1) NOT NULL,
  `skill_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `talent_id` char(36) NOT NULL COMMENT '(DC2Type:guid)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bkp_talent_skill_score`
--

INSERT INTO `bkp_talent_skill_score` (`id`, `score`, `is_removed`, `skill_id`, `talent_id`) VALUES
(1, 4, 1, '153ff68d-72ab-490c-9a6c-194eb57e8918', 'c78ead03-787f-4765-8173-6e5429693ed7'),
(2, 1, 0, '55a8b407-45b8-4588-b64b-2e1bfea37012', 'c78ead03-787f-4765-8173-6e5429693ed7'),
(3, 3, 0, '153ff68d-72ab-490c-9a6c-194eb57e8918', 'c78ead03-787f-4765-8173-6e5429693ed7');

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent_superhero`
--

CREATE TABLE IF NOT EXISTS `bkp_talent_superhero` (
  `id` smallint(6) NOT NULL,
  `talent_id` char(36) NOT NULL COMMENT '(DC2Type:guid)',
  `name` varchar(64) NOT NULL,
  `main_duty` varchar(256) NOT NULL,
  `special_ability` varchar(256) NOT NULL,
  `daily_activity` varchar(256) NOT NULL,
  `alternative_technology` varchar(256) NOT NULL,
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent_training`
--

CREATE TABLE IF NOT EXISTS `bkp_talent_training` (
  `id` smallint(6) NOT NULL,
  `talent_id` char(36) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '(DC2Type:guid)',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organizer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` int(4) NOT NULL,
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_talent_training`
--

INSERT INTO `bkp_talent_training` (`id`, `talent_id`, `name`, `organizer`, `time`, `is_removed`) VALUES
(1, 'c78ead03-787f-4765-8173-6e5429693ed7', 'PHP', 'php.net', 2014, 1),
(2, 'c78ead03-787f-4765-8173-6e5429693ed7', 'Phalcon MVC', 'phalcon.org', 2017, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bkp_talent_work_experience`
--

CREATE TABLE IF NOT EXISTS `bkp_talent_work_experience` (
  `id` smallint(6) NOT NULL,
  `talent_id` char(36) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '(DC2Type:guid)',
  `is_removed` tinyint(1) NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_year` int(4) NOT NULL,
  `end_year` int(4) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_talent_work_experience`
--

INSERT INTO `bkp_talent_work_experience` (`id`, `talent_id`, `is_removed`, `company_name`, `position`, `start_year`, `end_year`, `role`) VALUES
(0, 'a2d696f7-024a-453f-867d-db0d053b8d7c', 0, 'Bara Praja', 'programmer', 2006, 2012, 'programmer'),
(1, 'c78ead03-787f-4765-8173-6e5429693ed7', 1, 'bara praja', 'programmer', 2010, 2014, 'backend php'),
(2, 'c78ead03-787f-4765-8173-6e5429693ed7', 0, 'Conver Gain', 'programmer', 2000, 2010, 'php backend'),
(3, 'c78ead03-787f-4765-8173-6e5429693ed7', 0, 'Bara Praja', 'coder', 2010, 2017, 'php coder');

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
  `founder_agreement` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `city_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `is_removed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bkp_team`
--

INSERT INTO `bkp_team` (`id`, `name`, `vision`, `mission`, `culture`, `founder_agreement`, `city_id`, `is_removed`) VALUES
('0281638e-7e1d-4df0-8bfb-94efdaf1101c', 'tedt', '123', '321', '123', '321', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('038799b2-12e3-4f19-8dc7-c2677e10ec75', 'dfdfdhtht', 'dfdf', 'fdfdf', 'dfg', '', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('0b282bf1-a360-4bcf-ac39-bc63c06586d5', 'Dodol', 'Garut', 'Enak ', 'Pisan', 'CUYyyy', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('10a26cd9-2575-4fa4-ae97-74fd1885dccb', 'jingga', '12312312', '123123', '123123', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('13be66c8-3602-49a9-b512-11b2cb15243e', 'jjn', 'kjnkjn', 'kn', 'kjnknj', 'INTERNET BANKING MANDIRI - pulsa.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('1867df44-0fca-493f-990b-7518b2034cb4', 'yutyuty', 'utyutyu', 'utyu', 'tutyu', 'Panduan TA.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('1d4e3a44-6801-460f-90e9-322f43d58ff2', 'a team 1', 'visi', 'mission', 'sasala', '7fb3d8bdf68d6176b812def387a6d9ae-unable-to-transfer-files-from-my-pc-to-the-galaxy-tab-11649-lyvms5.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('23ae8a35-1655-4251-9ae0-3417f5a77037', 'A very long long long long long long long long team name', 'sdklfj\r\nsdkfjkls', 'sldkfj\r\nsdflkj', 'sdflkj\r\nsdlfkj', '1c896531b359ed922b2ea0f1b50bbbdd-15. Surat Penawaran Harga - GainMarketive versi 2.2 - Prodia Kudus.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('23cff4ce-cb75-4459-ab79-10768334a9f6', 'a test team a', 'visi', 'misi', 'culture', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('2941d233-a8c7-404c-b304-c7d70b4a8967', 'ababa', 'sababab', 'asasaj', 'sjaksjakj', 'askjkaj', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('3afcc25e-3a31-4509-a1af-ae516599fa7b', 'Astrajinggaaa', 'one', 'two', 'three', '234', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('3c7cb5e2-6080-4bc2-aec2-bc54460ee62f', 'SOLACE', 'asdklaskldj', 'askldjaklsjd', 'alksdjakljsd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('42fea0f2-9da7-45a2-8773-42038bec49ab', 'adaada', 'asd', 'asd', 'asd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('475d285b-2aee-45ae-a541-3a88d88f8264', 'Dudidamdam', 'asdasd\r\nasdasd', 'asdasd\r\nasdasd', 'asdasd\r\nasdasd', '', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('530666d3-dcfa-4b52-bc25-6968e033fceb', 'Test TEam', 'ada deh', 'ada ajah', 'gak teau', 'ga ada', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('56bd3071-5b2f-47e7-a606-3756d41cba6c', 'dudud', 'asdasdasd', 'asdasd', 'asdasd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('644eceef-a248-44b5-b9aa-0042eaa13053', 'svvdfgdf', 'hghj', 'jhb', 'bjk', 'bkjb', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0),
('7588f7f0-8207-4190-a708-4c8485095d66', 'logitec', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lor', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lor', 'Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lor', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('7827b3ba-3739-437e-818f-5385f42bd986', 'DODOLgarut', 'sfsdfsdf', 'sdfsdf', 'sdfsdf', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('782baa6a-4aa1-45ec-ab3c-44a88e49e8a1', 'halo', 'halo', 'halo', 'halo', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('8432aaff-7797-40a8-87bf-ebe964ff3dbc', 'jknjksdnfd', 'lnlkdfkldm', 'lmlkdmflkdm', 'klmklmlm', 'INTERNET BANKING MANDIRI - pulsa.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('90e10b3c-f312-4e64-b537-5cce1434eac1', 'fsdfdsfds', 'sdfsdfsdfsd', 'fsdfsdfsdf', 'sdfsdfsdfsd', 'sdfsfsdf', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0),
('96d318a4-80d4-4773-89a9-6140c77c9fd0', 'dsmsmdm', 'lmlmlm', 'm;l', 'm;lm;m', 'mhnmb', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0),
('997c5f26-339c-4607-b47d-8004e3a5fc0e', 'dwdw', 'dwdw', 'dwdwd', 'dwdwd', '4998d99379262c1091fc6ce0498ea898-15. Surat Penawaran Harga - GainMarketive versi 2.2 - Prodia Kudus.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('a4cd3645-80d7-499b-a63f-4f5e79f1268d', 'fefefef', 'fefef', 'efefe', 'fefef', 'fef', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0),
('a94d8559-62e0-4794-a214-b7eba7044a3b', '123213123123', 'asdfasdfas', 'sdfasdfsdff', 'sdfasdfasdfasd', 'sdfasdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('aef2cde8-eb4b-4490-8dbc-0605dee02377', 'sdsds', 'dsdsds', 'dsdsd', 'sdsds', 'sdsd', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0),
('b2735057-5844-4bf7-b3f9-40f4fff09536', 'oh my god', 'asdasd', 'asdasd', 'asdasd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('b60d7c27-7d30-4274-aec4-b626518aea5f', 'Astrajingga', 'one', 'two', 'three', 'for', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('bceeffac-73e5-4d2c-a92e-c691728c10ca', 'Team ABCD', 'ga ada', 'ada ajah', 'naon sih', 'ga ada', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('bdebbd4a-8c1e-48c7-9cd3-2b68db6c1f09', 'gty54tfh', 'fhfhfh', 'fhfjg', 'jfgjfjfg', 'jfgjfgjf', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0),
('bfb1fb39-3a94-4caf-97e3-dc241f2aefa8', 'my team', 'vision', 'mission', 'culture', '', '986e18bf-5a94-44ed-881c-73ca91473a22', 0),
('c208d611-9aff-4784-acc5-a93e4bc96587', 'Team ABC', 'ada deh', 'ada ajah', 'mau tau ajah', 'ga ada', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('cdff994f-bf32-4304-9656-888cbe30bad1', '2345', '123', '2323', '123', '123', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('d212eb73-70fb-4288-ade9-e6f3acd4aa7d', 'single team', 'vision', 'mission', 'culture', '5402db974f5ada615848567ae32cc702-usecases.pdf', '986e18bf-5a94-44ed-881c-73ca91473a22', 0),
('d38e668c-d7b6-408d-aacb-ea35b2b6e76d', 'team abcda', 'asd', 'asd', 'asd', 'asd', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('d59f1a12-30f7-4851-81b6-58adab75ab28', 'awtrytfhfg', 'hjhgj', 'gjghjghjgh', 'jhgkkg', 'kgkgh', '49a94e7d-0ddc-4528-af39-27fcec8ca67b', 0),
('d9543064-e9c0-48f9-adc0-19507365797c', 'Astra Jingga', 'one', 'two', 'three', 'four', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('db3fdae1-9719-470f-85f2-a09e5f00bfc7', '123123123123', '123', '123', '123', '123', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('dd903c06-56bd-4e90-8863-b091ae7d59e2', 'DOLARO', 'asdasdasdasd', 'asdasdasd', 'asdasdasd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('ddb4b083-b040-453c-bc59-1538ac702d62', 'Astrajinggaa', 'one', 'two', 'three', 'four', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('e0e7cd89-41ac-4c47-914e-0e10e6e31fc9', '678678768', '678678', '678', '678', '678', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('e55315a7-3e88-4ed6-8527-dda68f2faca0', 'ijk`ojmjo', 'oko', 'kok', 'okok', '/var/www/html/bekup/app/controllers/../../public/uploads/INTERNET BANKING MANDIRI - pulsa.pdf', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0),
('e7e1c423-8ece-4050-ad58-bacc5e4b040c', 'Durarim', '123', '123', '123asd', 'founder aggreement', '806b2600-82e0-4b9a-9d62-3cd52b32723a', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bkp_team_member`
--

CREATE TABLE IF NOT EXISTS `bkp_team_member` (
  `id` smallint(6) NOT NULL,
  `position` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `talent_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `team_id` char(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `is_admin` tinyint(1) NOT NULL,
  `is_creator` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bkp_team_member`
--

INSERT INTO `bkp_team_member` (`id`, `position`, `status`, `talent_id`, `team_id`, `is_admin`, `is_creator`) VALUES
(1, 'cro', 'active', 'c78ead03-787f-4765-8173-6e5429693ed7', 'bfb1fb39-3a94-4caf-97e3-dc241f2aefa8', 1, 1),
(1, 'cso', 'resign', 'c78ead03-787f-4765-8173-6e5429693ed7', 'd212eb73-70fb-4288-ade9-e6f3acd4aa7d', 1, 1),
(2, 'designer', 'invited', 'bae40db3-416b-431f-a115-ec89bcea06a4', 'bfb1fb39-3a94-4caf-97e3-dc241f2aefa8', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bkp_track`
--

CREATE TABLE IF NOT EXISTS `bkp_track` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `is_removed` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bkp_track`
--

INSERT INTO `bkp_track` (`id`, `is_removed`, `name`, `description`) VALUES
('0e717d5b-0a88-4842-b331-07cdc44ed1de', 1, 'new track', 'asdfasdfa\r\n'),
('0f940036-abda-4dc3-aa5f-ebcc10213097', 0, 'BEKUP Basic PHP', 'Pelatihan bahasa pemrograman PHP (hanya untuk peserta perorangan)'),
('2ae7b78c-b117-40db-80e9-f6b7eee742f6', 1, 'Track 3', 'Desc 3'),
('2c531143-15cb-4cb7-8f26-10104e91e767', 1, '234qwerqwerf', 'sadfasdfasdfasdfasdfsdfw3wresrw3r4w44'),
('3fde6f49-3859-4475-85b9-ea2e3ca67b92', 0, 'BEKUP Basic Creative', 'Pelatihan desain User Interface dan User Experience (hanya untuk peserta perorangan)'),
('47e34844-ccc5-4d36-81b7-a8dc98b0d9cc', 1, 'Track Name1x', 'Track Desc1x'),
('4b51e103-2c76-4051-955b-fa2e4e731899', 0, 'BEKUP Basic Android', 'Pelatihan bahasa pemrograman Android (hanya untuk peserta perorangan)'),
('5e57f63f-4a28-4721-ace5-f3b1b2edb925', 1, 'fastest track', 'fastest track description'),
('79998c0a-9ecb-4082-aaf1-aa8e8fe4a80d', 1, 'sasas', 'asasas'),
('c468d652-d961-4329-96f0-b2aab5d2249c', 1, 'BEKUP Start', 'Program pendampingan bisnis Startup (hanya untuk tim yang terdiri atas minimal 1 org teknis dan 1 org bisnis/desain)'),
('d5819752-7999-4ecf-862b-a83db35e3d34', 1, 'Trck A', 'Desc A'),
('f068d477-5395-4a3a-bfb3-3c84988fe80a', 1, 'djbjdj', 'hdhd'),
('fe1c311b-b912-41a0-8452-a5177750cbb1', 1, 'Name', 'najsasa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bkp_city`
--
ALTER TABLE `bkp_city`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bkp_personnel`
--
ALTER TABLE `bkp_personnel`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bkp_skill`
--
ALTER TABLE `bkp_skill`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bkp_talent`
--
ALTER TABLE `bkp_talent`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bkp_talent_certificate`
--
ALTER TABLE `bkp_talent_certificate`
 ADD PRIMARY KEY (`id`,`skill_score_id`);

--
-- Indexes for table `bkp_talent_education`
--
ALTER TABLE `bkp_talent_education`
 ADD PRIMARY KEY (`id`,`talent_id`);

--
-- Indexes for table `bkp_talent_skill_score`
--
ALTER TABLE `bkp_talent_skill_score`
 ADD PRIMARY KEY (`id`,`talent_id`);

--
-- Indexes for table `bkp_talent_superhero`
--
ALTER TABLE `bkp_talent_superhero`
 ADD PRIMARY KEY (`id`,`talent_id`), ADD KEY `talent_id` (`talent_id`);

--
-- Indexes for table `bkp_talent_training`
--
ALTER TABLE `bkp_talent_training`
 ADD PRIMARY KEY (`id`,`talent_id`);

--
-- Indexes for table `bkp_talent_work_experience`
--
ALTER TABLE `bkp_talent_work_experience`
 ADD PRIMARY KEY (`id`,`talent_id`), ADD KEY `IDX_571535D218777CEF` (`talent_id`);

--
-- Indexes for table `bkp_team`
--
ALTER TABLE `bkp_team`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bkp_team_member`
--
ALTER TABLE `bkp_team_member`
 ADD PRIMARY KEY (`id`,`team_id`);

--
-- Indexes for table `bkp_track`
--
ALTER TABLE `bkp_track`
 ADD PRIMARY KEY (`id`);

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
