<?php
    define( "WWW_DIR", __DIR__ );

    include( WWW_DIR .'/models/BambooCMS/Configurator.php' );
    include( WWW_DIR .'/models/BambooCMS/Debugger/Debugger.php' );

    \BambooCMS\Debugger\Debugger::enableDebug();

    $settings = array(
        'baseDir' => WWW_DIR,
        'urlDir' => 'BambooCMS',
    );

    $configurator = new \BambooCMS\Configurator( $settings );

    include( WWW_DIR .'/controllers/HomepageController.php' );
    $configurator->registerController( 'homepage', new \Controllers\HomepageController );

    $configurator->runApplication();
