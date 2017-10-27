<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name TheApplication\Controllers\ControllerTests
 * @file controller_contact.php 
 * @version 1.0.0
 * @date 08-10-2017 08:44 (SPAIN)
 * @observations:
 * @requires  
 */
namespace TheApplication\Controllers;

use TheApplication\Controllers\TheApplicationController;
use TheApplication\Behaviours\BehaviourIntegration;

class ControllerTests extends TheApplicationController
{
    public function __construct()
    {
        ;
    }
    
    //
    public function index()
    {
        $arConfig["mysql"]["db"] = "db_killme";
        $arConfig["mysql"]["user"] = "root";
        $arConfig["mysql"]["pass"] = "";
        $arConfig["mysql"]["server"] = "localhost";
        
        $oInteg = new BehaviourIntegration($arConfig);
        $oInteg->get_lite_schema();
    }
}//ControllerTests