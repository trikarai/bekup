<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$isDevMode = true;
$paths = array(
    __DIR__ . "/src/Managerial/Infrastructure/Persistence/Doctrine/Mapping/Personnel",
    __DIR__ . "/src/Managerial/Infrastructure/Persistence/Doctrine/Mapping/City",
    __DIR__ . "/src/Usage/Infrastructure/Persistence/Doctrine/Mapping/Talent",
    __DIR__ . "/src/Usage/Infrastructure/Persistence/Doctrine/Mapping/TalentJobHistory",
    __DIR__ . "/src/Usage/Infrastructure/Persistence/Doctrine/Mapping/City",
);
$config = Setup::createXMLMetadataConfiguration($paths, $isDevMode);

$conn = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => 'pr4jaB1',
    'dbname' => 'bekup'
);

$entityManager = EntityManager::create($conn, $config);

