<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
        $this->flashMessenger = $this->_helper->FlashMessenger;
    }

    public function indexAction()
    {
    }
}
