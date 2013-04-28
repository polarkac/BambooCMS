<?php
    error_reporting( E_ALL | E_STRICT );
    define( "WWW_DIR", __DIR__ );

    include( WWW_DIR .'/models/BambooCMS/Configurator.php' );

    $settings = array(
        'baseDir' => WWW_DIR,
        'urlDir' => 'BambooCMS',
    );

    $configurator = new \BambooCMS\Configurator( $settings );
    $configurator->runApplication();

