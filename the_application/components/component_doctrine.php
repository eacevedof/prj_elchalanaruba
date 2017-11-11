<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name TheApplication\Components\ComponentDoctrine 
 * @file component_doctrine.php v1.0.0
 * @date 11-11-2017 14:33 SPAIN
 * @observations
 */
namespace TheApplication\Components;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class ComponentDoctrine 
{
    public function __construct() 
    {
        $arPaths = [TFW_PATH_APPLICATIONDS."appdb/db_elchalan.sqlite3"];
        $isDevMode = FALSE;
        $arDbParams = [
            "driver" => "pdo_sqlite",
            "user" => "test",
            "path" => TFW_PATH_APPLICATIONDS."appdb/db_elchalan.sqlite3",
            "charset" => "utf8",
        ];
        
        $oConfig = Setup::createAnnotationMetadataConfiguration($arPaths,$isDevMode);
        $oEntManager = EntityManager::create($arDbParams,$oConfig);
    }
    
}//ComponentDoctrine