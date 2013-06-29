<?php
namespace BambooCMS;

class Application extends Object {

    private $request;
    private $config;

    public function __construct( Http\HttpRequest $request, Configurator $config ) {
        $this->request = $request;
        $this->config = $config;

        $path = $this->request->getPathInfo();
        if ( $path[0] === 'index.php' ) {
            header( 'Location: http://'. $this->request->getHost() .'/'. $this->config->getUrlDir() ); 
        }
    }

    public function generatePage() {
        $path = $this->request->getPathInfo();
        $cntName = !empty( $path[0] ) ? $path[0] : 'homepage';
        $action = !empty( $path[1] ) ? $path[1] : NULL;
        $controller = $this->config->getController( $cntName );
        $controller->prepare( $action );
        $controller->render( $action );

        $controller->writeOutput();
    }
}   
