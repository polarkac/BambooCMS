<?php
namespace BambooCMS;

class Application {

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

        if ( empty( $path[0] ) ) {
            $path = array( 'default' );
        }

        $content = '';

        if ( is_file( WWW_DIR .'/templates/'. $path[0] .'.template' ) ) {
            $content = file_get_contents( WWW_DIR .'/templates/'. $path[0] .'.template' );
        }
        $content = str_replace( '{urlDir}', $this->config->getUrlDir(), $content );
        $content = str_replace( '{testVariable}', 'hahahahaha', $content );

        print( $content );
    }
}   
