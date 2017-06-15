<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = true;
$paths = array(
	BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/City",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/CityClass",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/Course",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/CourseClass",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/Personnel",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/Skill",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/Track",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/TeamClass",
    BASE_PATH . "/src/Managerial/Infrastructure/Persistence/DoctrineMapping/CityTeamClass",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Profile",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Certificate",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Education",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Skill",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/TalentClass",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Training",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Work",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Team",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/AsTeamMember",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/TeamClass",
    BASE_PATH . "/src/Talent/Infrastructure/Persistence/DoctrineMapping/Superhero",
    BASE_PATH . "/src/Region/Infrastructure/Persistence/DoctrineMapping/City",
    BASE_PATH . "/src/Region/Infrastructure/Persistence/DoctrineMapping/CityTeamClass",
    BASE_PATH . "/src/Region/Infrastructure/Persistence/DoctrineMapping/Team",
);

$doctrineConfig = Setup::createXMLMetadataConfiguration($paths, $isDevMode);

$conn = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => 'pr4jaB1',
    'dbname' => 'bekup'
);

$entityManager = EntityManager::create($conn, $doctrineConfig);