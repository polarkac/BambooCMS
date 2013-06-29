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
        if ( !empty( $this->template ) ) {
            print( $this->template->getTemplateData() );
        } else {
            throw new \BambooCMS\Exceptions\ControllerHasNoTemplateException( 'Template file is not set up for this controller ('. get_class( $this ) .').' );
        }
    }

}
