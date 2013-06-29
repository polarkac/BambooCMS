<?php
namespace BambooCMS\Templating;

class FileTemplate extends Template {
    
    public function getTemplateData() {
        $rootData = '';
        if ( is_file( WWW_DIR .'/app/templates/root.template' ) ) {
            $rootData = file_get_contents( WWW_DIR .'/app/templates/root.template' );
        }
        $data = file_get_contents( WWW_DIR .'/app/templates/'. $this->templateFile .'.template' );

        foreach ( $this->variables as $name => $value ) {
            $data = str_replace( '{'. $name .'}', $value, $data);
            $rootData = str_replace( '{'. $name .'}', $value, $rootData);        
        }

        $page = str_replace( '{include content}', $data, $rootData ); 
        $page = str_replace( '{baseURL}', $this->config->getUrlDir(), $page );

        return $page;
    }
}
