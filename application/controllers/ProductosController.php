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
    			// asignar los valores de la forma a variables
    			$id = (int) $forma->getValue( 'id' );
    			$nombre = $forma->getValue( 'nombre' );
    			$descripcion = $forma->getValue( 'descripcion' );
    			$precio = $forma->getValue( 'precio' );
    			$existencia = $forma->getValue( 'existencia' );

    			// actualizar los datos
    			$productos = new Application_Model_DbTable_Productos();
    			$productos->updateProducto( $id, $nombre, $descripcion, $precio, $existencia );

    			// redirigir al index
    			$this->_helper->redirector( 'index' );
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
