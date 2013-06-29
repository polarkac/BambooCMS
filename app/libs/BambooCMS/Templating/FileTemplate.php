<?php
namespace BambooCMS\Templating;

class FileTemplate extends Template {
    
    public function getTemplateData() {
        $rootData = '';
        $rootFilePath = APP_DIR .'/templates/root.template';
        $templateData = '';
        $templateFilePath = APP_DIR .'/templates/'. $this->templateFile .'.template';

        if ( is_file( $rootFilePath ) ) {
            $rootData = file_get_contents( $rootFilePath );
        }

        if ( is_file( $templateFilePath ) ) {
            $templateData = file_get_contents( $templateFilePath );
        }

        foreach ( $this->variables as $name => $value ) {
            $templateData = str_replace( '{'. $name .'}', $value, $templateData);
            $rootData = str_replace( '{'. $name .'}', $value, $rootData);        
        }

        $page = str_replace( '{include content}', $templateData, $rootData ); 
        $page = str_replace( '{baseURL}', $this->config->getUrlDir(), $page );

        return $page;
    }
}
