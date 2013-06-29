<?php
namespace BambooCMS;

include( __DIR__ .'/Object.php' );

class Configurator extends \BambooCMS\Object {

    private $baseDir;
    private $urlDir;
    private $controllers = array();
    
    public function __construct( array $settings ) {
        session_start();
        $this->baseDir = $settings['baseDir'];
        $this->urlDir = $settings['urlDir'];
        $this->registerAutoloader(); 

        error_reporting( E_ALL | E_STRICT );
    }

    private function registerAutoloader() {
        spl_autoload_register( array( $this, 'loadClass' ) ); 
    }

    public function loadClass( $name ) {
        $name = str_replace( '\\', '/', $name );
        $modelFile = $this->baseDir .'/app/models/'. $name .'.php';
        $controllerFile = $this->baseDir .'/app/'. $name .'.php';
        if ( is_file( $modelFile ) ) {
            include( $modelFile ); 
        } else {
            if ( is_file( $controllerFile ) ) {
                include( $controllerFile );
            } else {
                throw new \BambooCMS\Exceptions\ClassNotFoundException( 'Class '. $name .' is not exist.' );
            }
        }
    }

    public function runApplication() {
        $request = new Http\HttpRequest( $this );
        $app = new Application( $request, $this );

        $app->generatePage();
    }

    public function getBaseDir() {
        return $this->baseDir;
    }

    public function getUrlDir() {
        return '/'. $this->urlDir;
    }

    public function registerController( $name, \BambooCMS\Controller $controller ) {
        if ( !array_key_exists( $name, $this->controllers ) ) {
            $this->controllers[$name] = $controller;
            $this->controllers[$name]->setConfigurator( $this );
        } else {
            throw new \BambooCMS\Exceptions\ControllerAlreadyExists;
        }
    }

    public function getController( $name ) {
        if ( array_key_exists( $name, $this->controllers ) ) {
            return $this->controllers[$name];
        } else {
            throw new \Exception( 'Controller isnt registered.' );
        }
    }
}
