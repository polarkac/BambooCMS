<?php
namespace BambooCMS\Http;

class HttpRequest {
    
    private $config;
    private $urlParts;

    public function __construct( \BambooCMS\Configurator $config ) {
        $this->config = $config;

        $fullURL = 'http://';
        $fullURL .= $_SERVER['SERVER_NAME'];
        $fullURL .= $_SERVER['REQUEST_URI'];

        $this->urlParts = parse_url( $fullURL );
        $this->urlParts['pathInfo'] = '';

        $urlParts = explode( $this->config->getUrlDir(), $this->getPath() );
        $urlParts = preg_replace( '/^\//', '', $urlParts[1] );
        $this->urlParts['pathInfo'] = explode( '/', $urlParts );
    }

    public function getHost() {
        return $this->urlParts['host'];
    }

    public function getPath() {
        return $this->urlParts['path'];
    }

    public function getPathInfo() {
        return $this->urlParts['pathInfo'];
    }
}
