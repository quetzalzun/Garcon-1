<?php

class Zend_View_Helper_GetControllerName extends Zend_View_Helper_Abstract 
{
    public function getControllerName ()
    {    
        // setting the controller and action name as title segments:
        $request = Zend_Controller_Front::getInstance()->getRequest();
        return ucwords( $request->getControllerName() );
    }
}
