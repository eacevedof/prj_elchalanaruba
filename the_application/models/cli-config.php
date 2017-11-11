<?php
// bootstrap.php
//die(__DIR__);
require_once "../../the_vendor/autoload.php";

//require_once '../../the_vendor/doctrine-common/lib/Doctrine/Common/ClassLoader.php';
//$sPathDrivers = realpath(__DIR__ . '/../../lib');


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$isDevMode = TRUE;

$sDriverPath = "../../the_vendor/doctrine/annotations/lib/Doctrine/Common/Annotations";
$sDriverPath = realpath($sDriverPath);
$config = Setup::createAnnotationMetadataConfiguration([$sDriverPath],$isDevMode);

$conn = array(
    "driver" => "pdo_sqlite",
    "path" => "C:/xampp/htdocs/prj_elchalanaruba/the_application/appdb/db_elchalan.sqlite3",
);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);  

return ConsoleRunner::createHelperSet($entityManager);