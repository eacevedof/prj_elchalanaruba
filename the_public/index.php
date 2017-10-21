<?php
//index.php 2.0.1
//carga el loader de composer. Este loader solo tiene registrado el loader de helpers.
//C:\xampp\htdocs\wwwelchalan\the_public
$sPathPublic = dirname(__FILE__);
$sPathPublic = realpath($sPathPublic);
define("TFW_PATH_PUBLIC",$sPathPublic);
define("TFW_PATH_PUBLICDS",TFW_PATH_PUBLIC.DIRECTORY_SEPARATOR);
$sPathProject = realpath(TFW_PATH_PUBLICDS."..");
define("TFW_PATH_PROJECT",$sPathProject);
define("TFW_PATH_PROJECTDS",TFW_PATH_PROJECT.DIRECTORY_SEPARATOR);
define("TFW_PATH_APPLICATION",TFW_PATH_PROJECTDS."the_application");
define("TFW_PATH_APPLICATIONDS",TFW_PATH_APPLICATION.DIRECTORY_SEPARATOR);
define("TFW_PATH_VENDOR",TFW_PATH_PROJECTDS."the_vendor");
define("TFW_PATH_VENDORDS",TFW_PATH_VENDOR.DIRECTORY_SEPARATOR);

$arPaths = [
    get_include_path(),
    "$sPathProject",
    "$sPathProject/the_application",
    "$sPathProject/the_application/boot",
    "$sPathProject/the_application/behaviours",
    "$sPathProject/the_application/components",
    "$sPathProject/the_application/controllers",
    "$sPathProject/the_application/helpers",
    "$sPathProject/the_application/models",
    "$sPathProject/the_application/views",
    "$sPathProject/the_application/views/elements",
    "$sPathProject/the_application/views/reactjs",
    //VENDOR
//    "$sPathProject/the_vendor",//tiene el autoload de composer
//    "$sPathProject/the_vendor/fpdf", se cargara 
    ];
foreach($arPaths as $i=>$sPaths)
    if($i>0)
    {
        $sPathFix = realpath($sPaths);
        $arPaths[$i] = $sPathFix;
    }
//var_dump($arPaths);
$sPathInclude = implode(PATH_SEPARATOR,$arPaths);
set_include_path($sPathInclude);

require_once "the_vendor/bootstrap.php";//atuload para composer
require_once "boot/bootstrap.php";//the_application/boot/bootsrap.php

use TheApplication\Components\ComponentRouter;
$arRun = ComponentRouter::run();

if($arRun)
{
    //bug($sPathPublic,"pathpublic");
    $_POST["tfw_controller"] = $arRun["controller"];
    $_POST["tfw_method"] = $arRun["method"];
    
    $oTfwController = new $arRun["nscontroller"]();
    if(method_exists($oTfwController,$arRun["method"]))
        $oTfwController->{$arRun["method"]}();
    elseif(method_exists($oTfwController,"status_404"))
        $oTfwController->{"status_404"}();        
    else
    {
        header("HTTP/1.0 404 Not Found");
        die("Error 404 Not Found!!");
    }
}
