<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name TheApplication\Components\ComponentDbSqlite 
 * @file component_db_sqlite.php v1.0.2
 * @date 19-09-2017 04:56 SPAIN
 * @observations
 */
namespace TheApplication\Components;

class ComponentDbSqlite 
{
    private static $oConn;
    private $sPathFolder;
    private $sDbName;
    
    private $isError;
    private $isPersistent;
    
    public function __construct($sPathFolder="",$sDbName="") 
    {
        $this->sPathFolder = $sPathFolder;
        $this->sDbName = $sDbName;
    }

    public function query($sSQL)
    {
        if(trim($sSQL))
        {
            $this->conn_open();
            if(self::$oConn->ping())
            {
                $oResult = self::$oConn->query($sSQL);
                $arRows = [];
                while($arRow = $oResult->fetch_assoc()) 
                    $arRows[] = $arRow;
                $oResult->free();
                return $arRows;
            }
            $this->conn_close();   
        }
        else 
        {
            $sMessage = "query.sql empty";
            $this->add_message($sMessage);
        }
        return [];
    }//query
    
    public function query($sSQL)
    {
        
        $sPath = TFW_PATH_APPLICATIONDS."dbapp";
        $dir = "sqlite:$sPath/app.db";
        $dbh  = new \PDO($dir) or die("cannot open the database");
        $query =  "select * from _template";
        foreach ($dbh->query($query) as $row)
        {
            print_r($row);
        }        
    }
    
    public function insert($sSQL)
    {
        $sPath = TFW_PATH_APPLICATIONDS."db";        
        $dir = "sqlite:$sPath/app.db";
        $dbh  = new \PDO($dir);
        $dbh->query($sSQL);
    }
    
    private function add_message($sMessage,$sType="error")
    {
        if($sType="error")
            $this->isError = TRUE;
        $this->arMessages[$sType][] = $sMessage;
    }    
}//ComponentDbSqlite