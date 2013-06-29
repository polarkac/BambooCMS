<?php
namespace Controllers;

use \BambooCMS\Controller,
    \BambooCMS\Templating\FileTemplate;

class HomepageController extends Controller {
    
    public function prepare( $action ) {
        $this->template = new FileTemplate( 'homepage', $this->config );
    }

    public function render( $action ) {
        $this->template->addVariable( 'test', $action );
    }
}
