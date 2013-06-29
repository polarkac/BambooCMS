<?php
    define( "WWW_DIR", __DIR__ );
    define( "APP_DIR", WWW_DIR .'/app' );

    include( APP_DIR .'/libs/BambooCMS/Configurator.php' );
    include( APP_DIR .'/libs/BambooCMS/Debugger/Debugger.php' );

    \BambooCMS\Debugger\Debugger::enableDebug();

    $settings = array(
        'baseDir' => WWW_DIR,
        'urlDir' => 'BambooCMS',
    );

    $configurator = new \BambooCMS\Configurator( $settings );

    $configurator->registerController( 'homepage', new HomepageController );
    $configurator->registerController( 'test', new TestController );

    $configurator->runApplication();
