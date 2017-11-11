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

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Configuration;

class ComponentDoctrine 
{
    public function __construct() 
    {
        //http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/tutorials/getting-started.html#an-example-model-bug-tracker
        $arPaths = [TFW_PATH_APPLICATIONDS."appdb/db_elchalan.sqlite3"];
        $arConx = ["driver"=>"pdo_sqlite","memory"=>TRUE];
        $oConx = DriverManager::getConnection($arConx);
        
        $oConfig = new Configuration();
        $oConfig->setAutoGenerateProxyClasses(TRUE);
        
    }
    
}//ComponentDoctrine