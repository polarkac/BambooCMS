<?php
namespace BambooCMS\Templating;

use \BambooCMS\Object;

abstract class Template extends Object {
    
    protected $variables = array();
    protected $templateFile;
    protected $config;

    public function __construct( $fileName, $config ) {
        $this->templateFile = $fileName;
        $this->config = $config;
    }

    public function setTemplateFile( $fileName ) {
        $this->templateFile = $fileName;
    }

    public function addVariable( $name, $value ) {
        $this->variables[$name] = $value;
    }

    public function getVariable( $name ) {
        return $this->variables[$name];
    }

    public function getAllVariables() {
        return $this->variables;
    }

    abstract public function getTemplateData();
}
