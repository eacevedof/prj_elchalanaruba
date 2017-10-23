<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name TheApplication\Components\ComponentSqlite 
 * @file component_sqlite.php v1.0.0
 * @date 19-09-2017 04:56 SPAIN
 * @observations
 */
namespace TheApplication\Components;

class ComponentSqlite 
{

    public function query($sSQL)
    {
        $dir = "sqlite:/[YOUR-PATH]/combadd.sqlite";
        $dbh  = new PDO($dir) or die("cannot open the database");
        $query =  "SELECT * FROM combo_calcs WHERE options='easy'";
        foreach ($dbh->query($query) as $row)
        {
            echo $row[0];
        }        
    }
    
}//ComponentSqlite