<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name TheApplication\Controllers\TheApplicationController
 * @file controller_theapplication.php 
 * @version 1.0.0
 * @date 08-10-2017 08:44 (SPAIN)
 * @observations:
 * @requires  
 */
namespace TheApplication\Controllers;

use TheFramework\Main\TheFrameworkController;
use TheApplication\Components\ComponentLog;

class TheApplicationController extends TheFrameworkController
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function log_debug($sContent,$sTitle="")
    {
        if(!is_string($sContent)) 
            $sContent = var_export($sContent,1);
        $oLog = new ComponentLog();
        $oLog->set_subfolder("debug");
        $oLog->save($sContent,$sTitle);
    }
    
    protected function log_error($sContent,$sTitle="")
    {
        if(!is_string($sContent))
            $sContent = var_export($sContent,1);        
        $oLog = new ComponentLog();
        $oLog->set_subfolder("error");
        $oLog->save($sContent,$sTitle);
    }
    
    public function status_404()
    {
        header("HTTP/1.0 404 Not Found");
        include("views/status/404.php");
    }
}//TheApplicationController