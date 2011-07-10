<?php

class ProductosController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$productos = new Application_Model_DbTable_Productos();
    	$this->view->productos = $productos->fetchAll();
    }

    public function editAction()
    {
        // action body
    }

    public function deleteAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
    }
}
