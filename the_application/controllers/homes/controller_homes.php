<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name TheApplication\Controllers\ControllerHomes
 * @file controller_homes.php 
 * @version 1.0.0
 * @date 08-10-2017 08:44 (SPAIN)
 * @observations:
 * @requires  
 */
namespace TheApplication\Controllers;

use TheApplication\Controllers\TheApplicationController;

class ControllerHomes extends TheApplicationController
{
    public function __construct()
    {
        ;
    }
    
    //
    public function index()
    {
        include("views/homes/view_index.php");
    }
    
    public function sqlite()
    {
        $oSqlite = new \TheApplication\Components\ComponentSqlite();
        $oSqlite->query("");
    }
}//ControllerHomes