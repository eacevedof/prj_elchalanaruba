<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name BehaviourIntegration
 * @file behaviour_integration.php 
 * @version 1.0.1
 * @date 22-06-2017 20:41 (SPAIN)
 * @observations:
 * @requires
 */
namespace TheApplication\Behaviours;

use TheApplication\Components\ComponentDbMysql;
use TheApplication\Components\ComponentDbSqlite;
use TheApplication\Components\ComponentDbSqlserver;

class BehaviourIntegration
{
    private $oMysql;
    private $oSqlite;
    private $oSqlsrv;
    private $arConfig;

    public function __construct($arConfig=[])
    {
        $this->arConfig = $arConfig;
        if(isset($arConfig["mysql"]))
        {
            $this->oMysql = new ComponentDbMysql($arConfig["mysql"]["db"],$arConfig["mysql"]["pass"]
                ,$arConfig["mysql"]["user"],$arConfig["mysql"]["server"]);
        }
        //bug($this->oMysql);die;
        
        if(isset($arConfig["sqlite"]))
        {
            $this->oSqlite = new ComponentDbSqlite($arConfig["sqlite"]["folder"],$arConfig["sqlite"]["db"]);
        }        
    }//__construct
  
    private function get_mysql_tables()
    {
        $sSQL = "
        SELECT DISTINCT table_name
        FROM information_schema.columns 
        WHERE 1=1
        AND table_schema='{$this->arConfig["mysql"]["db"]}'
        ORDER BY table_name,ordinal_position ASC";
        $arRows = $this->oMysql->query($sSQL);
        return $arRows;
    }
    
    private function get_mysql_fields($sTable,$isMin=0)
    {
        $sSQL = "
        SELECT LOWER(column_name) AS field_name
        ,LOWER(DATA_TYPE) AS field_type
        ,CASE COLUMN_KEY 
            WHEN 'PRI' THEN 'y'
            ELSE ''
        END AS is_pk
        ,LOWER(IS_NULLABLE) AS is_nullable
        ,COLUMN_DEFAULT AS by_default
        ,character_maximum_length AS field_length
        FROM information_schema.columns 
        WHERE 1=1
        AND table_name = '$sTable'
        AND table_schema='{$this->arConfig["mysql"]["db"]}'
        ORDER BY ordinal_position ASC";
        
        if($isMin)
            $sSQL = "
            SELECT LOWER(column_name) AS field_name
            FROM information_schema.columns 
            WHERE 1=1
            AND table_name = '$sTable'
            AND table_schema='{$this->arConfig["mysql"]["db"]}'
            ORDER BY ordinal_position ASC";
        
        $arRows = $this->oMysql->query($sSQL);
        return $arRows;        
    }
    
    /*CREATE TABLE contacts (
 contact_id integer PRIMARY KEY,
 first_name text NOT NULL,
 last_name text NOT NULL,
 email text NOT NULL UNIQUE,
 phone text NOT NULL UNIQUE
);*/
    public function get_lite_schema()
    {
        $arTables = $this->get_mysql_tables();
        //pr($arTables);die;
        $arLite = [];
        foreach($arTables as $arTable)
        {
            $sTable = $arTable["table_name"];
            $arLite[] = "DROP TABLE IF EXISTS $sTable;";
            $arLite[] = "CREATE TABLE $sTable (";
            $arFields = $this->get_mysql_fields($sTable);
            $arEndField = end($arFields);
            foreach ($arFields as $arField)
            {
                $sField = $arField["field_name"];
                $sFieldType = $this->get_type_tr($arField["field_type"],"mysql","sqlite");
                if(is_array($sFieldType))
                {
                    bug($arField);
                    pr($sFieldType);
                    die();
                }
                $isPk = $arField["is_pk"];
                if($isPk) 
                {
                    $isPk="PRIMARY KEY ";
                }
                else 
                {
                    $isNullable=$arField["is_nullable"];
                    if($isNullable=="no")
                        $isPk = "NOT NULL ";            
                }
                $sSQLSchema = "$sField $sFieldType $isPk";
                if($arField["by_default"])
                    $sSQLSchema .= "DEFAULT '{$arField["by_default"]}'";
                
                if($arField!==$arEndField) $sSQLSchema .= ",";
                $arLite[] = $sSQLSchema;
            }//foreach
            $arLite[]=");";
        }
        $sSQLSchema = implode("\n",$arLite);
        return $sSQLSchema;
    }//get_lite_schema
    
    public function get_lite_inserts()
    {
        $arTables = $this->get_mysql_tables();
        //pr($arTables);die;
        $arLite = [];
        foreach($arTables as $arTable)
        {
            $sTable = $arTable["table_name"];
            if(strstr($sTable,"vapp")) continue;

            $arFields = $this->get_mysql_fields($sTable,1);
            $arSelect = [];
            foreach($arFields as $arField)
                $arSelect[] = $arField["field_name"];

            $sOrderBy = "1";
            if(in_array("id",$arSelect)) $sOrderBy = "id";
            if(in_array("idn",$arSelect)) $sOrderBy = "idn";
            
            $sSelect = implode("`,`",$arSelect);
            $sSelect = "`$sSelect`";
            
            $sSQL = "SELECT $sSelect FROM $sTable ORDER BY $sOrderBy ASC";
            //bug($sSQL);
            $arRows = $this->oMysql->query($sSQL);
            if($arRows)
            {
                $arLite[] = "DELETE FROM $sTable;";
                $arLite[] = "INSERT INTO $sTable ($sSelect)"; 
                $arLite[] = " VALUES";
                
                $sInsert = "";
                $arEnd = end($arRows);
                foreach($arRows as $arRow)
                {
                    $sInsert = "(";
                    $arIns = [];
                    foreach($arSelect as $sField)
                    {
                        $sValue = $arRow[$sField];
                        $sValue = str_replace("'","''",$sValue);
                        $arIns[] = "'$sValue'";
                    }
                    $sInsert.= implode(",",$arIns);
                    $sInsert .= ")";
                    if($arEnd==$arRow) $sInsert .= ";";
                    else $sInsert .= ",";
                    
                    $arLite[] = $sInsert;
                }//foreach
            }//if arRows
        }//foreach tables
        $sLite = implode("\n",$arLite);
        return $sLite;      
    }//get_lite_inserts
    
    public function to_sqlite()
    {
        $sSQLSchema = $this->get_lite_schema();
        //pr($sSQLSchema);die;
        $this->oSqlite->execute($sSQLSchema);
        if($this->oSqlite->is_error())
            pr($this->oSqlite->get_errors(),"arErrors");

        pr($this->oSqlite->get_debug(),"debug schema");
        $sSQLInsert = $this->get_lite_inserts();
        $this->oSqlite->execute($sSQLInsert);
        if($this->oSqlite->is_error())
            pr($this->oSqlite->get_errors(),"arErrors");
    }//bulk_lite_schema
    
    public function bulk_lite_insert()
    {
        $arTables = $this->get_mysql_tables();
        //pr($arTables);die;
        $arLite = [];
        foreach($arTables as $arTable)
        {
            $sTable = $arTable["table_name"];
            if(strstr($sTable,"vapp")) continue;

            $arFields = $this->get_mysql_fields($sTable,1);
            $arSelect = [];
            foreach($arFields as $arField)
                $arSelect[] = $arField["field_name"];

            $sOrderBy = "1";
            if(in_array("id",$arSelect)) $sOrderBy = "id";
            if(in_array("idn",$arSelect)) $sOrderBy = "idn";
            
            $sSelect = implode("`,`",$arSelect);
            $sSelect = "`$sSelect`";
            
            $sSQL = "SELECT $sSelect FROM $sTable ORDER BY $sOrderBy ASC";
            //bug($sSQL);
            $arRows = $this->oMysql->query($sSQL);
            if($arRows)
            {
                $oLite = new ComponentDbSqlite();
                $sSQL = "DELETE FROM $sTable;";
                $oLite->insert($sSQL);
                $arLite[] = "INSERT INTO $sTable ($sSelect)"; 
                $arLite[] = " VALUES";
                
                $sInsert = "";
                $arEnd = end($arRows);
                foreach($arRows as $arRow)
                {
                    $sInsert = "(";
                    $arIns = [];
                    foreach($arSelect as $sField)
                    {
                        $sValue = $arRow[$sField];
                        $sValue = str_replace("'","''",$sValue);
                        $arIns[] = "'$sValue'";
                    }
                    $sInsert.= implode(",",$arIns);
                    $sInsert .= ")";
                    if($arEnd==$arRow) $sInsert .= ";";
                    else $sInsert .= ",";
                    
                    $arLite[] = $sInsert;
                }//foreach
            }//if arRows
        }//foreach tables
        $sLite = implode("\n",$arLite);
        return $sLite;        
    }//bulk_lite_insert    
    
    private function get_type_tr($sType,$sMotorSrc,$sMotorTrg)
    {
        $arTypes = [
            "mysql"=>[
                "int"=>[
                    "sqlite"=>"INTEGER",
                    "sqlserver"=>"INT"
                    ],
                "tinyint"=>[
                    "sqlite"=>"INTEGER",
                    "sqlserver"=>"INT"
                    ],
                "smallint"=>[
                    "sqlite"=>"INTEGER",
                    "sqlserver"=>"INT"
                    ],                
                "varchar"=>[
                    "sqlite"=>"TEXT",
                    "sqlserver"=>"VARCHAR"
                ],
                "char"=>[
                    "sqlite"=>"TEXT",
                    "sqlserver"=>"CHAR"
                ],        
                "text"=>[
                    "sqlite"=>"TEXT",
                    "sqlserver"=>"TEXT"
                ], 
                "datetime"=>[
                    "sqlite"=>"TEXT",
                    "sqlserver"=>"VARCHAR"
                ],                 
                "decimal"=>[
                    "sqlite"=>"REAL",
                    "sqlserver"=>"NUMERIC"
                ],
                "float"=>[
                    "sqlite"=>"REAL",
                    "sqlserver"=>"NUMERIC"
                ]
                
            ]
        ];
        return isset($arTypes[$sMotorSrc][$sType][$sMotorTrg])?$arTypes[$sMotorSrc][$sType][$sMotorTrg]:[];
    }//get_type_tr
    
   
    
}//BehaviourIntegration
