<?php
namespace BambooCMS;

abstract class Controller extends Object {

    protected $template;
    protected $config;

    public function setConfigurator( \BambooCMS\Configurator $config ) {
        $this->config = $config;
    }

    public function prepare( $action ) {

    }

    public function render( $action ) {

    }

    public function writeOutput() {
        print( $this->template->getTemplateData() );
    }

}
