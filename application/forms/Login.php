<?php

class Application_Form_Login extends Zend_Form
{
    public function init()
    {
        $this->setName( "login" );
        $this->setMethod( 'post' );
             
        $this->addElement( 'text', 'usuario', 
            array(
                'filters'    => array( 'StringTrim', 'StringToLower' ),
                'validators' => 
                    array(
                        array( 'StringLength', false, array( 0, 50) ),
                    ),
            
                'required'   => true,
                'label'      => 'Usuario:',
            )
        );

        $this->addElement( 'password', 'clave', 
            array(
                'filters'    => array( 'StringTrim' ),
                'validators' => 
                    array(
                        array( 'StringLength', false, array( 0, 50 ) ),
                    ),
                
                'required'   => true,
                'label'      => 'Clave:',
            )
        );

        $this->addElement( 'submit', 'entrar', 
            array(
                'required' => false,
                'ignore'   => true,
                'label'    => 'Entrar',
            )
        );
    }
}
