<?php
/**
 * @author Eduardo Acevedo Farje.
 * @link www.eduardoaf.com
 * @name TheApplication\Controllers\ControllerContact
 * @file controller_contact.php 
 * @version 1.0.0
 * @date 08-10-2017 08:44 (SPAIN)
 * @observations:
 * @requires  
 */
namespace TheApplication\Controllers;

use TheApplication\Controllers\TheApplicationController;

class ControllerContact extends TheApplicationController
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
}//ControllerContact