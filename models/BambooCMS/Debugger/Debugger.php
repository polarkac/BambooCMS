<?php
namespace BambooCMS\Debugger;

final class Debugger {

    private static $isEnabled = false;

    final public function __construct() {
        throw new \BambooCMS\StaticClassException( 'You can not create an instance of static class.' );
    }

    public static function enableDebug() {
        if ( self::$isEnabled === false ) {
            set_error_handler( array( __CLASS__, 'errorHandler' ) );    
            set_exception_handler( array( __CLASS__, 'exceptionHandler' ) );
            register_shutdown_function( array ( __CLASS__, 'shutdownHandler' ) );
            self::$isEnabled = true;
        }
    }

    public static function errorHandler( $errorCode, $message, $file, $line, $context ) {
        $errorNames = array(
            E_WARNING => 'Warning',
            E_USER_WARNING => 'Warning',
            E_NOTICE => 'Notice',
            E_USER_NOTICE => 'Notice',
        );
        print( $errorNames[$errorCode] .' - '. $message .' on '. $line .' line in '. $file );

        exit( 254 );
    }

    public static function exceptionHandler( \Exception $e ) {
        print( $e->getMessage() );

        exit( 254 );
    }

    public static function shutdownHandler() {
        if ( !self::$isEnabled )
            return;

        $error = error_get_last();
        
        switch ( $error['type'] ) {
            case E_ERROR:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_PARSE:
                self::exceptionHandler( new \Exception( $error['message'], $error['type'], NULL ) );    
        }
    }

    public static function isDebugEnabled() {
        return self::$isEnabled;
    }
}
