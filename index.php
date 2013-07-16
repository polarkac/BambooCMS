<?php
    use \BambooCMS\Debugger\Debugger;

    define( "WWW_DIR", __DIR__ );
    define( "APP_DIR", WWW_DIR .'/app' );

    include( APP_DIR .'/libs/BambooCMS/Configurator.php' );
    include( APP_DIR .'/libs/BambooCMS/Debugger/Debugger.php' );

    Debugger::enableDebug();

    $settings = array(
        'baseDir' => WWW_DIR,
        'urlDir' => 'BambooCMS',
    );

    $configurator = new \BambooCMS\Configurator( $settings );

    $configurator->registerController( 'homepage', new HomepageController( $configurator ) );
    $configurator->registerController( 'test', new TestController($configurator) );

    $configurator->runApplication();
