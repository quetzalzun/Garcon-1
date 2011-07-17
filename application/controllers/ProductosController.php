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
    	// Agregar forma y ponerle un botón de guardar.
    	$forma = new Application_Form_Productos();
    	$forma->enviar->setLabel( 'Guardar' );
    	$this->view->forma = $forma;

    	if ( $this->getRequest()->isPost() ) {
    		$datos = $this->getRequest()->getPost();

    		if ( $forma->isValid($datos) ) {
            } else {
            	$form->populate( $datos );
            }
        } else {
        	$id = $this->_getParam( 'id', 0 );
        	if ( $id > 0 ) {
        		$productos = new Application_Model_DbTable_Productos();
        		$forma->populate( $productos->getProducto( $id ) );
            }
        }
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
