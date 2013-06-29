<?php
namespace BambooCMS;

abstract class Object {

    public function __get( $variable ) {
        throw new \Exception( 'You can not get undefined variable \''. $variable .'\' from '. get_class( $this ) .' class.' );
    }

    public function __set( $variable, $args ) {
        throw new \Exception( 'You can not set undefined variable \''. $variable .'\' from '. get_class( $this ) .' class.' );
    }

}
