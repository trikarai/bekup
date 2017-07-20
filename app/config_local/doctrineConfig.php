<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = true;
$paths = array(
    BASE_PATH . "/src/Superclass/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/City/Profile/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/City/Programme/Description/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Personnel/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Programme/Description/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Talent/Education/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Talent/Entrepreneurship/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Talent/Organizational/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Talent/Profile/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Talent/Skill/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Talent/Training/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Talent/WorkingExperience/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Team/Idea/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Team/Profile/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Team/Programme/Infrastructure/Persistence/DoctrineMapping",
    BASE_PATH . "/src/Track/Definition/Infrastructure/Persistence/DoctrineMapping",
);

$doctrineConfig = Setup::createXMLMetadataConfiguration($paths, $isDevMode);

$conn = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => 'root',
    'dbname' => 'bekup'
);

$entityManager = EntityManager::create($conn, $doctrineConfig);