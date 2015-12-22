<?php

namespace simpleChat\Utility;

/**
 * Description of JsTemplater
 *
 * Extends Templater so it will be able to
 * load all javascript files and sent it to the browser as one file
 * 
 * @author mlin
 */
class JsTemplater extends Templater
{
    /*
     * Load all files from classes folder and one explicitly specified file
     * 
     * @param string @template - name of a file
     * @param string @extension - alternatively extension of this file
     */
    public function __construct($template = '', $extension = '.js')
    {
        $this->extension = $extension;
        
        $this->template = '';
        
        $this->loadAll();
        
        if ($template !== '')
        {
            $this->load($template);
        }
    }
    
    /*
     * Load all files from classes folder
     * 
     * @return void
     */
    protected function loadAll()
    {
        $files = array_diff(
                    scandir(JS_PATH . 'classes/'),
                    array('..', '.')
                );
        
        foreach($files as $file)
        {
            $this->template .= file_get_contents(JS_PATH . 'classes/' . $file);
        }
    }
    
    /*
     * Load file as template
     * 
     * @param string $template - name of a file
     * 
     * @return void
     */
    public function load($template)
    {
        $this->template .= file_get_contents(JS_PATH . $template . $this->extension);
    }
}
