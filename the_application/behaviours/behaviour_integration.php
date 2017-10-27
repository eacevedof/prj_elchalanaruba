<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name BehaviourIntegration
 * @file behaviour_integration.php 
 * @version 1.0.0
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
            $this->oSqlite = new ComponentDbSqlite($arConfig["sqlite"]["db"],$arConfig["sqlite"]["pass"]
                ,$arConfig["sqlite"]["user"],$arConfig["sqlite"]["server"]);
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
    
    private function get_mysql_fields($sTable)
    {
        $sSQL = "
        SELECT LOWER(column_name) AS field_name
        ,LOWER(DATA_TYPE) AS field_type
        ,CASE COLUMN_KEY 
            WHEN 'PRI' THEN 'y'
            ELSE ''
        END AS is_pk
        ,LOWER(IS_NULLABLE) AS is_nullable
        ,character_maximum_length AS field_length
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
            $arLite[]="CREATE TABLE $sTable (";
            $arFields = $this->get_mysql_fields($sTable);
            foreach ($arFields as $arProp)
            {
                $sField = $arProp["field_name"];
                $sFieldType = $this->get_type_tr($arProp["field_type"],"mysql","sqlite");
                $isPk = $arProp["is_pk"];
                if($isPk) 
                {
                    $isPk="PRIMARY KEY";
                    $arLite[] = "$sField $sFieldType $isPk,";
                }
                else 
                {
                    $isNullable=$arProp["is_nullable"];
                    if($isNullable=="yes")
                        $isPk = "NOT NULL";
                    
                    $arLite[] = "$sField $sFieldType $isPk,";                
                }
            }           
        }
        bug($arLite);
    }
    
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
                ]
            ]
        ];
        return isset($arTypes[$sMotorSrc][$sType][$sMotorTrg])?$arTypes[$sMotorSrc][$sType][$sMotorTrg]:[];
    }//get_type_tr
    
}//BehaviourIntegration
