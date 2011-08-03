<?php

class AutentificacionController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$forma = new Application_Form_Login();
    	$this->view->forma = $forma;
    }


}

