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
        $request = $this->getRequest();

        if ( $request->isPost() ) {
            if ( $forma->isValid( $request->getPost() ) ) {
                if ( $this->_process( $forma->getValues() ) ) {
                    // We're authenticated! Redirect to the home page
                    $this->_helper->redirector('index', 'index');
                }
            }
        }

    	$this->view->forma = $forma;
    }

    protected function _process( $values )
    {
        // Get our authentication adapter and check credentials
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity( $values['email'] );
        $adapter->setCredential( $values['clave'] );

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate( $adapter );
        
        if ( $result->isValid() ) {
            $user = $adapter->getResultRowObject();
            $auth->getStorage()->write( $user );
            return true;
        }

        return false;
    }

    protected function _getAuthAdapter()
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable( $dbAdapter );

        $authAdapter->setTableName( 'clientes' )
                    ->setIdentityColumn( 'email' )
                    ->setCredentialColumn( 'clave' )
                    ->setCredentialTreatment( 'SHA1( CONCAT( ?, condimento ) )' );

        return $authAdapter;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector( 'index' );
    }
}
