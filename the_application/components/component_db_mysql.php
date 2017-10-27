<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name TheApplication\Components\ComponentDbMysql 
 * @file component_db_mysql.php v1.0.0
 * @date 19-09-2017 04:56 SPAIN
 * @observations
 */
namespace TheApplication\Components;

class ComponentDbMysql 
{
    private $sDbServer;
    private $sDbUser;
    private $sDbPassword;
    private $sDbName;
    private static $oConn;
    private $arMessages;


    public function __construct($sDbName,$sDbUser="root",$sDbPass,$sDbServer="localhost") 
    {
        $this->sDbServer = $sDbServer;
        $this->sDbUser = $sDbUser;
        $this->sDbPassword = $sDbPass;
        $this->sDbName = $sDbName;
        $this->arMessages = [];
    }
    
    private function is_configok()
    {
        $isOk = TRUE;
        $isOk = ($isOk && $this->sDbServer);
        $isOk = ($isOk && $this->sDbUser);
        $isOk = ($isOk && $this->sDbName);
        return $isOk;
    }
    
    private function conn_open()
    {
        try
        {
            if(!mysqli_ping(self::$oConn))
                self::$oConn = mysqli_connect($this->sDbServer
                    ,$this->sDbUser, $this->sDbPassword, $this->sDbName);
            
            if(mysqli_connect_errno())
                $this->arMessages["error"][] = "conn_open.mysqli_connect error:".mysqli_connect_error();
        }
        catch (mysqli_sql_exception $oE)
        {
            $this->arMessages["error"][] = "Exception:".$oE->getMessage();
        }
    }
    
    private function conn_close()
    {
        if(mysqli_ping(self::$oConn))
            mysqli_close(self::$oConn);
    }
    
    public function query($sSQL)
    {
        $this->conn_open();
        if(self::$oConn)
        {
            $iResult = mysqli_query(self::$oConn,$sSQL);
        }
        $this->conn_close();   
    }
    
    public function set_server($sValue){$this->sDbServer=$sValue;}
    public function set_user($sValue){$this->sDbUser=$sValue;}
    public function set_password($sValue){$this->sDbPassword=$sValue;}
    public function set_dbname($sValue){$this->sDbName=$sValue;}
    
}//ComponentDbMysql