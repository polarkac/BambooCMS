<?php
namespace BambooCMS\Exceptions;

class ControllerAlreadyExists extends \Exception {

    public function __construct() {
        parent::__construct( 'Controller is already registered.' );
    }
}
