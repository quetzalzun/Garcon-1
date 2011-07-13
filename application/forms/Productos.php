<?php

class Application_Form_Productos extends Zend_Form
{
    public function init()
    {
    	$this->setName('producto');

    	$id = new Zend_Form_Element_Hidden( 'id' );
    	$id->addFilter( 'Int' );

    	$articulo = new Zend_Form_Element_Text( 'articulo' );
    	$articulo->setLabel( 'Artículo' )
                 ->setRequired( 'true' )
                 ->addFilter( 'StripTags' )
                 ->addFilter( 'StringTrim' )
                 ->addValidator( 'NotEmpty' );

    	$descripcion =

    	$precio =

    	$existencia =
    }
}
