<?php
namespace BambooCMS;

class Configurator {

    private $baseDir;
    private $urlDir;
    
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
        if ( is_file( $this->baseDir .'/models/'. $name .'.php' ) ) {
            include( $this->baseDir .'/models/'. $name .'.php' ); 
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
        return $this->urlDir;
    }
}
