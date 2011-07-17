<?php

class Application_Form_Productos extends Zend_Form
{
    public function init()
    {
    	$this->setName('producto');

    	$id = new Zend_Form_Element_Hidden( 'id' );
    	$id->addFilter( 'Int' );

    	$nombre = new Zend_Form_Element_Text( 'nombre' );
    	$nombre->setLabel( 'Artículo' )
               ->setRequired( 'true' )
               ->addFilter( 'StripTags' )
               ->addFilter( 'StringTrim' )
               ->addValidator( 'NotEmpty' );

    	$descripcion = new Zend_Form_Element_Text( 'descripcion' );
    	$descripcion->setLabel( 'Descripción' )
    	            ->setRequired( 'true' )
    	            ->addFilter( 'StripTags' )
    	            ->addFilter( 'StringTrim' )
    	            ->addValidator( 'NotEmpty' );

    	$precio = new Zend_Form_Element_Text( 'precio' );
    	$precio->setLabel( 'Precio' )
    	       ->setRequired( 'true' )
    	       ->addFilter( 'StripTags' )
    	       ->addFilter( 'StringTrim' )
    	       ->addValidator( 'NotEmpty' )
    	       ->addValidator( 'Float' );

    	$existencia = new Zend_Form_Element_Text( 'existencia' );
    	$existencia->setLabel( 'Existencia' )
    	           ->setRequired( 'true' )
    	           ->addFilter( 'StripTags' )
    	           ->addFilter( 'StringTrim' )
    	           ->addValidator( 'NotEmpty' );
    	
    	$enviar = new Zend_Form_Element_Submit( 'enviar' );
    	$enviar->setAttrib( 'id', 'botonEnviar' );

    	$this->addElements( 
    	    array( $id, $nombre, $descripcion, $precio, $existencia, $enviar ) 
    	);
    }
}
