<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    // obtener configuraciones específicas del sitio
    private static function getConfig( $config )
    {
        return new Zend_Config_Ini( APPLICATION_PATH . "/configs/{$config}.ini", APPLICATION_ENV );
    }

    // vista
    protected function _initView()
    {
        // obtener configuración global
        $sitio = $this::getConfig( 'sitio' );
        
        // inicializar vista
        $view = new Zend_View();

        // doctype
        $view->doctype( $sitio->doctype );
        
        // encoding
        $view->setEncoding( $sitio->encoding );
        
        // title
        $view->headTitle( $sitio->name )
             ->setSeparator(' | ')
             ->setIndent(8);
        
        // meta tags
        $view->headMeta()->setName( 'keywords', $sitio->keywords )
                         ->appendName( 'description', $sitio->description )
                         ->appendName( 'google-site-verification', $sitio->googleVerification )
                         ->setIndent( 8 );
        
        // stylesheets & feeds (headLinks)
        $view->headLink()->setStylesheet( '/css/reset.css', 'all' )
                         ->appendStylesheet( '/css/layout.css', 'all' )
                         ->appendStylesheet( '/css/skin.css', 'all' )
                         ->appendStylesheet( '/css/menu.css', 'all' )
                         ->headLink(
                             array(
                                'rel' => 'favicon',
                                'href' => '/images/favicon.ico'
                            ),
                            'PREPEND'
                        )
                         ->headLink(
                             array(
                                'rel' => 'shortcut icon',
                                'href' => '/images/favicon.ico'
                            ),
                            'PREPEND'
                         )
                         ->appendAlternate( '/feed/', 'application/rss+xml', 'News' )
                         ->setIndent( 8 );

        // jQuery y Javascript
        $view->addHelperPath( "ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper" );
        $view->jQuery()->enable()
                       ->uiEnable();

        $view->headScript()->appendFile( '/js/default.js', 'text/javascript', 
            array(
                'charset' => $sitio->encoding
            )
        )->setIndent( 8 );
        
        // agregarlo al ViewRenderer
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper( 'ViewRenderer' );
        $viewRenderer->setView( $view );
        
        // registrar viewRenderer
        Zend_Controller_Action_HelperBroker::addHelper( $viewRenderer );

        // return it, so that it can be stored by the bootstrap
        return $view;
    }

    // configuración del menú
    protected function _initMenu()
    {
        // obtener la configuración del menú (xml)
        $config = new Zend_Config_Xml( APPLICATION_PATH . '/models/menu.xml', 'nav' );

        // generar el contenedor
        $container = new Zend_Navigation( $config );

        // registrarlo
        Zend_Registry::set( 'Zend_Navigation', $container );
    }

    protected function _initSession()
    {
        // obtener configuraciones específicas del sitio
        $config = $this::getConfig( 'sessions' );
 
        Zend_Session::setOptions( $config->toArray() );
        
        // iniciar sesión
        Zend_Session::start();
    }
    
    // locale
    protected function _initLocale()
    {
        // obtener configuraciones específicas del sitio
        $config = $this::getConfig( 'sitio' );
        
        // definir el locale por default
        Zend_Locale::setDefault( $config->locale );
        
        // ponerlo en el registro
        $locale = new Zend_Locale( $config->locale );
        Zend_Registry::set( 'Zend_Locale', $locale );
    }

    // feed (rss)
    protected function _initFeed()
    {
        // configurar las opciones de cache
        $frontendOptions = array(
            'lifetime' => 86400,
            'automatic_serialization' => true
        );

        // definir el directorio de cache
        $backendOptions = array( 'cache_dir' => APPLICATION_PATH . '/../data/cache' );

        // configurar cache
        $cache = Zend_Cache::factory(
            'Core', 'File', $frontendOptions, $backendOptions
        );

        // configurar el feed para que use cache y httpConditionalGet
        Zend_Feed_Reader::setCache($cache);
        Zend_Feed_Reader::useHttpConditionalGet();
    }
}
