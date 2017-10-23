<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name TheApplication\Components\ComponentSqlite 
 * @file component_sqlite.php v1.0.2
 * @date 19-09-2017 04:56 SPAIN
 * @observations
 */
namespace TheApplication\Components;

class ComponentSqlite 
{

    public function query($sSQL)
    {
        
        $sPath = TFW_PATH_APPLICATIONDS."db";
        $dir = "sqlite:$sPath/app.db";
        $dbh  = new \PDO($dir) or die("cannot open the database");
        $query =  "select * from _template";
        foreach ($dbh->query($query) as $row)
        {
            print_r($row);
        }        
    }
    
}//ComponentSqlite